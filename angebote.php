 <!DOCTYPE html> 
<html lang="de"> 
<?php
require_once "session_mgmt.php";
require_once "db_connection.php";
require_once "function_sendmail.php";

include "login_req.php";

	//Code während Entwicklung
	ini_set("display_errors", 1);
	error_reporting(E_ALL & ~E_NOTICE);

	$nr = $_GET['nr'];

	$userid = $_SESSION['B_id'];
	
	IF( isset($_GET['accept']) )
	{
		$A_id = $_GET['accept'];
		//echo "<p>Es wurde auf einen Accept Knopf gedrückt</p>";
		
		
		
		//1. Email-Adresse vom Nachfrager auslesen
		$sql = "SELECT B_email FROM Benutzer WHERE B_id = $userid";		
		//echo "<p>$sql</p>";
		$result = mysqli_query($conn, $sql);
		while($row = mysqli_fetch_array($result)) {
			$B_email_nachfrager =  $row['B_email'];
			//echo "<p>Email-Nachfrager: $B_email_nachfrager</p>";
		}
		
		
		//2. XML generieren
		$sql = "SELECT N_titel,	N_beschreibung, N_qualitaet, N_gueltig_bis,	N_preis, N_menge, N_menge_einheit, B_email, B_firma, B_name, B_vname, B_strasse, B_strasse_nr,	B_plz,	B_ort FROM `Nachfrage` JOIN Benutzer ON Nachfrage.B_id = Benutzer.B_id WHERE Nachfrage.N_id = 71";
		//echo "<p>$sql</p>";
		$result = mysqli_query($conn, $sql);
	
		$B_anz_inserate = mysqli_num_rows($result);
		//echo "<p>Zusage mit XML an diesen Anbieter schicken</p>";
		if (mysqli_num_rows($result) > 0) {
			
			//XML generieren mit Inserat und Adresse des Anbieters
			//Create file name to save
			
			$filename = "export_" . $userid . "_" . date("Ymd_Hi",time()) . "_" . mt_rand(10,99) . ".xml";
		  
			//Create new document 
			
			$dom = new DOMDocument;
			
			$dom->preserveWhiteSpace = FALSE;

			//add table in document 
			$table = $dom->appendChild($dom->createElement('table'));

			//add row in document 
			foreach($result as $row) {

				$data = $dom->createElement('row');
				$table->appendChild($data);

				//add column in document 
				foreach($row as $name => $value) {
					$value_xml = html_entity_decode($value,ENT_QUOTES);	

					$col = $dom->createElement('column', $value_xml);

					$data->appendChild($col);
					$colattribute = $dom->createAttribute('name');
					// Value for the created attribute
					$colattribute->value = $name;
					$col->appendChild($colattribute);           
				}
			}
			$dom->formatOutput = true; // set the formatOutput attribute of domDocument to true 
			$dom->save('xml/'.$filename); 
		}		
		
		//3. XML an Anbieter schicken
		$sql = "SELECT * FROM `Nachfrage` JOIN Angebot ON Nachfrage.N_id = Angebot.N_id JOIN Benutzer ON Angebot.B_id = Benutzer.B_id WHERE Nachfrage.N_id = $nr AND Angebot.A_id = $A_id AND N_geloescht = 0";		
		//echo "<p>$sql</p>";
		$result = mysqli_query($conn, $sql);
	
		$B_anz_inserate = mysqli_num_rows($result);
		//echo "<p>Zusage mit XML an diesen Anbieter schicken</p>";
		if (mysqli_num_rows($result) > 0) {

			while($row = mysqli_fetch_array($result)) {
				$B_email_anbieter = $row['B_email'];
				//echo "<p>Anbieter-Mail-Adresse:" . $B_email_anbieter . "</p>";
				
				//Aufruf der Funktion, Versand von 1 Datei
				//mail_att("empfaenger@domain.de", "Betreff Agricola", "Euer Nachrichtentext", "Absendername", "absender@domain.de", "antwortadresse@domain.de", "datei.zip");
				//mail_att("ps@582.ch", "Betreff Agricola", "Euer Nachrichtentext", "webmaster@582.ch", "webmaster@582.ch", "webmaster@582.ch");
				//Mail-Adresse anpassen!!!!   $B_email_nachfrager
				mail_att("$B_email_nachfrager", "Zuschlag erhalten", "Nachricht von Agricola, Sie haben den Zuschlag zum liefern erhalten", "Automailer Agricola", "webmaster@082.ch", "$B_email_nachfrager", "xml/$filename");
				
			}
		}
		
		
		
		
		//4. Angebot auf Zusage setzen
		$sql = "UPDATE  `Nachfrage` JOIN Angebot ON Nachfrage.N_id = Angebot.N_id JOIN Benutzer ON Angebot.B_id = Benutzer.B_id SET Angebot.A_trade = 1 WHERE Nachfrage.N_id = $nr AND Angebot.A_id = $A_id AND N_geloescht = 0";
		//echo "<p>$sql</p>";
		$result = mysqli_query($conn, $sql);
		
		
		
		
		//5. Absagen versenden
		$sql = "SELECT * FROM `Nachfrage` JOIN Angebot ON Nachfrage.N_id = Angebot.N_id JOIN Benutzer ON Angebot.B_id = Benutzer.B_id WHERE Nachfrage.N_id = $nr AND Angebot.A_id <> $A_id AND N_geloescht = 0";		
		//echo "<p>$sql</p>";
		$result = mysqli_query($conn, $sql);
	
		$B_anz_inserate = mysqli_num_rows($result);
		//echo "<p>Absage an diesen Anbieter schicken</p>";
		if (mysqli_num_rows($result) > 0) {

			while($row = mysqli_fetch_array($result)) {
				$B_email_anbieter = $row['B_email'];
				//echo "<p>Anbieter-Mail-Adresse:" . $B_email_anbieter . "</p>";
				
				//Aufruf der Funktion, Versand von 1 Datei
				//mail_att("empfaenger@domain.de", "Betreff Agricola", "Euer Nachrichtentext", "Absendername", "absender@domain.de", "antwortadresse@domain.de", "datei.zip");
				//mail_att("ps@582.ch", "Betreff Agricola", "Euer Nachrichtentext", "webmaster@582.ch", "webmaster@582.ch", "webmaster@582.ch");
				//Mail-Adresse anpassen!!!!   $B_email_nachfrager
				mail_att("$B_email_anbieter", "Absage vom Nachfrager", "Nachricht von Agricola, Sie haben den Zuschlag nicht erhalten", "Automailer Agricola", "webmaster@082.ch", "webmaster@082.ch", NULL);
				
			}
		}
		
		
		
		
		//6. Angebote auf Absage setzen
		$sql = "UPDATE  `Nachfrage` JOIN Angebot ON Nachfrage.N_id = Angebot.N_id JOIN Benutzer ON Angebot.B_id = Benutzer.B_id SET Angebot.A_trade = 0 WHERE Nachfrage.N_id = $nr AND Angebot.A_id <> $A_id AND N_geloescht = 0";
		//echo "<p>$sql</p>";
		$result = mysqli_query($conn, $sql);		
		
		
		
		
		//7. Inserat deaktivieren, auf gelöscht setzen
		$sql = "UPDATE  `Nachfrage` SET Nachfrage.N_geloescht = 1 WHERE Nachfrage.N_id = $nr";
		//echo "<p>$sql</p>";
		$result = mysqli_query($conn, $sql);		
			
		
		

		
		echo "<meta http-equiv='refresh' content='0; url=konto.php'>";
	}
	
	
	
?>
<head>
  <title>Agricola-Trade</title> 
  
  <!-- Boostrap CSS -->
  <link href="res/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="res/bootstrap/css/bootstrap-theme.min.css" rel="stylesheet">
  
  <link href="dev/login.css" rel="stylesheet">
</head> 

<body>
 
	<!-- Navigation Bar -->
	<div class="container">
		<?php include("navigation.php"); ?>
	</div>
	
	<!-- Page Header -->
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h1>Angebote </h1>
			</div>

		<!-- Fehler Ausgabe -->
		<?php 
			if(isset($errorMessage)) {
		?>	
		<div class="alert alert-danger">
			<strong>Fehler! </strong><?php echo $errorMessage; ?>
		</div>
		<?php		} 	?>	
		
		<!-- Erfolgsmeldung -->
		<?php 
			if(isset($successMessage)) {
		?>	
		<div class="alert alert-success">
			<strong>Erfolg! </strong><?php echo $successMessage; ?>
		</div>
		<?php		} 	?>	
	
	</div>	
	</div>
	
		
	<!-- Page Connet -->
	<div class="container">
		
		<div class="row">
			<div class="col-md-12">	
				<h2>Übersicht zu Inserat <?php echo $nr; ?></h2>	
	
	
 <?php  
  //query  the database table
	$sql = "SELECT * FROM `Nachfrage` JOIN Angebot ON Nachfrage.N_id = Angebot.N_id WHERE Nachfrage.N_id = $nr AND Nachfrage.B_id = $userid AND N_geloescht = 0 ORDER BY A_Preis ASC";
  
  //echo $sql;
  //run  the query against the mysql query function
  $result = mysqli_query($conn, $sql);
	
  $B_anz_inserate = mysqli_num_rows($result);
 
?>
<h3>Sie haben zurzeit <?php echo $B_anz_inserate; ?> Angebote</h3>

<?php
	
	
	if (mysqli_num_rows($result) > 0) {
		
		?>
		<div class="table-responsive">
			<table class="table table-striped">
			<tr>
				<th>Titel</th>
				<th>Nachricht vom Anbieter</th>
				<th>Menge</th>
				<th>Preis</th>
				<th>Aktion</th>
			</tr>
		<?php
			
	// output data of each row
    while($row = mysqli_fetch_array($result)) {
		$A_id = $row['A_id'];
		$N_id = $row['N_id'];
		$titel = substr($row['N_titel'], 0,30);
		$text = $row['A_nachricht'];
		$menge = $row['A_menge'] . " " . $row['N_menge_einheit'];
		$preis = $row['A_preis'];

?>
<tr>
<td><?php echo $titel; ?></td>
<td><?php echo $text; ?></td>
<td><?php echo $menge; ?></td>
<td><?php echo $preis; ?></td>
<td><a href="angebote.php?nr=<?php echo $N_id;?>&accept=<?php echo $A_id;?>" role="button" class="btn btn-info">Angebot akzeptieren</a></td>
</tr>


<?php
		
	}
	echo "</table></div>";
 }
 else {
	

	
 ?>
 
 
 

      <div class="row">
        <div class="col-md-12">
          <h2>Leider nichts gefunden</h2>
          <p>Wir haben keine passenden Einträge in der Datenbank gefunden.</p>
		  <p><a href="new.php" class="btn btn-primary" role="button">Jetzt Nachfrage-Inserat erstellen &raquo;</a></p>
        </div>
	  </div>
	  
	  		</div>
		</div>
	</div>	

	
<?php	}
?>
	
	<!-- Footer -->	
	<?php include "footer.php"; ?>
	
    <!-- Bootstrap core JavaScript -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="res/bootstrap/js/bootstrap.min.js"></script>
    <script src="res/bootstrap/js/docs.min.js"></script>
</body>
</html>