<?php
/*
	Diese Funktion sendet eine eMail mit einem oder mehreren Anhängen an den Empfänger
*/
function mail_att($to, $subject, $message, $sender, $sender_email, $reply_email, $dateien = NULL) {   
	$mime_boundary = "-----=" . md5(uniqid(microtime(), true));
 
	$header  ="From:".$sender."<".$sender_email.">\n";
	$header .= "Reply-To: ".$reply_email."\n";
	$header .= "MIME-Version: 1.0\r\n";
	$header .= "Content-Type: multipart/mixed;\r\n";
	$header .= " boundary=\"".$mime_boundary."\"\r\n";
	$encoding = mb_detect_encoding($message, "utf-8, iso-8859-1, cp-1252");
	$content = "This is a multi-part message in MIME format.\n\n";
	$content .= "--".$mime_boundary."\n";
	$content .= "Content-Type: text/html; charset=\"$encoding\"\n";
	$content .= "Content-Transfer-Encoding: 8bit\n";
	$content .= "Content-Disposition: inline\r\n";
	$content .= $message."\r\n";
	//Anhang
	IF( !empty($dateien) ) {
		if(!is_array($dateien)) {
			$dateien = array($dateien);
		} 
		$attachments = array();
		foreach($dateien AS $key => $val) {
			if(is_int($key)) {
				$datei = $val;
				$name = basename($datei);
			} else {
				$datei = $key;
				$name = basename($val);
			}
		 
		$size = filesize($datei);
		$data = file_get_contents($datei);
		$type = mime_content_type($datei);
		$attachments[] = array("name"=>$name, "size"=>$size, "type"=>$type, "data"=>$data);
		}
		//$anhang ist ein Mehrdimensionals Array
		//$anhang enthält mehrere Dateien
		foreach($attachments AS $dat) {
			$data = chunk_split(base64_encode($dat['data']),76, "\n");
			$content.= "--".$mime_boundary."\n";
			$content.= "Content-Type: ".$dat['type']."; name=\"".$dat['name']."\"\n";
			$content.= "Content-Transfer-Encoding: base64\n";	
			$content .= "Content-Disposition: attachment; filename=". $dat['name'] . "\n\n";		 
			$content.= "\n" . $data."\n";
			}
		$content .= "--".$mime_boundary."--"; 		
	}
   
   return mail($to, $subject, $content, $header);
}