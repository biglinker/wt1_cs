<?php	


require_once "function_sendmail.php";
			
//mail_att(TO: Mail-Adresse, "Betreff: TEXT", "Nachricht: Text", "Absender: text", "webmaster@582.ch", "webmaster@582.ch", "xml/export_27_20170312_1152_98.xml");			
mail_att("daniel.staub@student.ibz.ch", "Betreff Agricola", "Nachricht von Agricola ", "Agricola Mailer", "webmaster@582.ch", "ps@582.ch", "xml/export_27_20170312_1152_98.xml");


?>