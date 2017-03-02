 <!DOCTYPE html> 
<html lang="de"> 
<?php
include "session_mgmt.php";
include "db_connection.php";

include "login_req.php";

//Code während Entwicklung
	ini_set("display_errors", 1);
	error_reporting(E_ALL & ~E_NOTICE);
	//-----------------


	$nr = $_GET['nr'];

	$userid = $_SESSION['B_id'];

	/*$sql = "SELECT * FROM Nachfrage WHERE B_id = '$userid' LIMIT 1";
	//echo $sql;
	$result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($result) > 0) {
	echo "<p>Ausgabe der Datenbank Nachfrage</p>";
    // output data of each row
    while($row = mysqli_fetch_array($result)) {
		var_dump($row);
		
		$titel = $row['N_titel'];
		$text = $row['N_bescheibung'];
		$quali = $row['N_qualitaet'];
		$datum_erstellt = date("j.n.Y", $row['N_erstellt']);
		$datum_ablauf = date("j.n.Y",$row['N_gueltig_bis']);
		$menge = $row['N_menge'];
		
    }
} else {
    echo "<p>0 results in DB Nachfrage</p>";
}*/


//mysqli_close($conn);
?>
<head>
  <title>Agricola-Trade</title> 
  
  <!-- Boostrap CSS -->
  <link href="res/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="res/bootstrap/css/bootstrap-theme.min.css" rel="stylesheet">
  
  <link href="dev/login.css" rel="stylesheet">
</head> 

<body>

<?php 
if(isset($errorMessage)) {
 echo $errorMessage;
}
?>
 
	<!-- Navigation Bar -->
	<div class="container">
		<?php include("navigation.php"); ?>
	</div>
	
	<!-- Page Header -->
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h1>Konto Übersicht</h1>
				
				<h3>Hallo User <?php echo $userid; ?> </h3>
				<p>Inserate anzeigen / löschen</p>
				<p>Benutzerangaben ändern </p>
				<p>Angebote zu inseraten als xml File per Mail</p>
				<p>Später: Passwort ändern</p>
			</div>
		</div>
		
		<div class="row">
			<div class="col-md-4">
				<h1>Inserat hinzufügen</h1>
				<p>Erstellen Sie jetzt ein neues Nachfrage-Inserat, worauf Ihnen potenzielle Lieferanen individuelle Angebot präsentieren können.</p>
				<p><a class="btn btn-default" href="new.php" role="button">Inserat erstellen &raquo;</a></p>
			</div>
			
			<div class="col-md-4">
				<h1>Benutzerangaben anpassen</h1>
				<p>Ändern Sie hier Ihre persönlichen Angaben wie z.B. Ihre Firmen-Adresse, Email-Adresse, etc.</p>
				<p><a class="btn btn-default" href="#" role="button">Meine Daten bearbeiten &raquo;</a></p>
			</div>
			
			<div class="col-md-4">
				<h1>iX-eM-eL Export</h1>
				<p>Exportieren Sie die Angebote zu Ihren Inseraten bequem als XML-Datei. Damit können sie das perfekt in ihre bestehende ERM Software einbinden.</p>
				<p><a class="btn btn-default" href="xml_export.php" role="button">XML-Export starten &raquo;</a></p>
			</div>
		</div>
		
		<div class="row">
			<div class="col-md-4">
				<h1>-</h1>
				<p>-</p>
				<p><a class="btn btn-default" href="#" role="button">x &raquo;</a></p>
			</div>
			
			<div class="col-md-4">
				<h1>-</h1>
				<p>-</p>
				<p><a class="btn btn-default" href="#" role="button">x &raquo;</a></p>
			</div>
			
			<div class="col-md-4">
				<h1>Logout</h1>
				<p>Sie haben für heute fertig und möchten sich jetzt sicher abmelden</p>
				<p><a class="btn btn-default" href="logout.php" role="button">Logout &raquo;</a></p>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12">	
				<h1>Übersicht über Ihre aktuellen Inserate</h1>	
			</div>
		</div>
	</div>	
	
	
	<div class="container">
 <?php  
  //query  the database table
	$sql = "SELECT *, (SELECT COUNT(Angebot.N_id) FROM Angebot WHERE Angebot.N_id = Nachfrage.N_id) AS AngebotCount FROM Nachfrage WHERE Nachfrage.B_id = '$userid'";
  
  echo $sql;
  //run  the query against the mysql query function
  $result = mysqli_query($conn, $sql);
	
  
 
 if (mysqli_num_rows($result) > 0) {
	// output data of each row
    while($row = mysqli_fetch_array($result)) {
	var_dump($row);
	$titel = $row['N_titel'];
	$text =  substr($row['N_beschreibung'], 0,200);
	$id = $row['N_id'];
	
	
 ?>
 
 
    
      <div class="row">
        <div class="col-md-12">
          <h2><?php echo $titel; ?></h2>
          <p> <?php echo $text; ?></p>
          <p><a class="btn btn-default" href="inserat.php?nr=<?php echo $id; ?>" role="button">Inserat anzeigen &raquo;</a></p>
        </div>
	  </div>
	 
	  
<?php
		}
	} else {
?>

      <div class="row">
        <div class="col-md-12">
          <h2>Leider nichts gefunden</h2>
          <p>Wir haben keine passenden Einträge in der Datenbank gefunden</p>
        </div>
	  </div>

<?php  }	
?>
	
	
	
	
	
	
	<!-- Page Content -->
	<div class="container">
		<div class="row">
			<div class="col-md-8">
				<h1>Übersicht über Ihre aktuellen Inserate</h1>
				
				
			
				<h2><?php echo $titel;  ?></h2>
				<p><?php echo $text;  ?></p>
				<p><strong>gewünschte Qualität:</strong> <?php echo $quali;  ?></p>
				<p><strong>gewünschte Menge: </strong> <?php echo $menge  ?></p>
				<p><strong>Lieferzeitpunkt: </strong> <?php echo $datum_ablauf ?></p>
				<p>Inserat-Nr <?php echo $nr;  ?></p>
			</div>
		</div>	
	
	
		<div class="row">
			<div class="col-md-8">
				<h2><?php echo $titel;  ?></h2>
				<p><?php echo $text;  ?></p>
				<p><strong>gewünschte Qualität:</strong> <?php echo $quali;  ?></p>
				<p><strong>gewünschte Menge: </strong> <?php echo $menge  ?></p>
				<p><strong>Lieferzeitpunkt: </strong> <?php echo $datum_ablauf ?></p>
				<p>Inserat-Nr <?php echo $nr;  ?></p>
			</div>
		</div>		
	</div>
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	<!-- Footer -->	
	
	<footer>
      <div class="container">
		<h5>2017 @ IBZ Agricola-Trade developed by Philipp Schelbert, Daniel Staub</h5>
      </div>
	</footer>

    <!-- Bootstrap core JavaScript -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="res/bootstrap/js/bootstrap.min.js"></script>
    <script src="res/bootstrap/js/docs.min.js"></script>
</body>
</html>