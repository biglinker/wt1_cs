﻿ <!DOCTYPE html> 
<html lang="de"> 
<?php
include "session_mgmt.php";
include "db_connection.php";

include "login_req.php";

	//Code während Entwicklung
	ini_set("display_errors", 1);
	error_reporting(E_ALL & ~E_NOTICE);

	$nr = $_GET['nr'];

	$userid = $_SESSION['B_id'];

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
				<h1>Konto Übersicht</h1>
				
				<h3>Hallo User <?php echo $userid; ?> </h3>
				<!--<p>Inserate anzeigen / löschen</p>
				<p>Benutzerangaben ändern </p>
				<p>Angebote zu inseraten als xml File per Mail</p>
				<p>Später: Passwort ändern</p>-->
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
			<div class="col-md-4">
				<h1>Inserat hinzufügen</h1>
				<p>Erstellen Sie jetzt ein neues Nachfrage-Inserat, worauf Ihnen potenzielle Lieferanen individuelle Angebot präsentieren können.</p>
				<p><a class="btn btn-default" href="new.php" role="button">Inserat erstellen &raquo;</a></p>
			</div>
			
			<div class="col-md-4">
				<h1>Benutzerangaben anpassen</h1>
				<p>Ändern Sie hier Ihre persönlichen Angaben wie z.B. Ihre Firmen-Adresse, Email-Adresse, etc.</p>
				<p><a class="btn btn-default" href="userdata.php" role="button">Meine Daten bearbeiten &raquo;</a></p>
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
	
	
	
 <?php  
  //query  the database table
	$sql = "SELECT *, (SELECT COUNT(Angebot.N_id) FROM Angebot WHERE Angebot.N_id = Nachfrage.N_id) AS AngebotCount FROM Nachfrage WHERE N_geloescht = 0 AND Nachfrage.B_id = '$userid'";
  
  //echo $sql;
  //run  the query against the mysql query function
  $result = mysqli_query($conn, $sql);
	
  $B_anz_inserate = mysqli_num_rows($result);
 
?>
<h3>Sie haben zurzeit <?php echo $B_anz_inserate; ?> Inserate</h2>	
<?php
	
	
	if (mysqli_num_rows($result) > 0) {
		
		?>
		<div class="table-responsive">
			<table class="table table-striped">
			<tr>
				<th>Nr</th>
				<th>Titel</th>
				<th>Beschreibung</th>
				<th>Lieferdatum</th>
				<th>Angebote</th>
				<th>Löschen</th>
			</tr>
		<?php
			
		
		
		
		
	// output data of each row
    while($row = mysqli_fetch_array($result)) {

		$titel = substr($row['N_titel'], 0,30);
		$text = substr($row['N_beschreibung'], 0,60);
		$id = $row['N_id'];
		$anz_angebote = $row['AngebotCount'];
		
		$frist = $row['N_gueltig_bis'];
		$frist = date("j.n.Y", strtotime($row['N_gueltig_bis']));
		


?>
<tr>
<td>  <a href="inserat.php?nr=<?php echo $id;?>" role="button" class="btn btn-info"><?php echo $id; ?></a> </td>
<td><?php echo $titel; ?></td>
<td><?php echo $text; ?></td>
<td><?php echo $frist; ?></td>
<td><?php IF($anz_angebote == 0){
	echo "Keine";
}
else {
	echo "<a href='angebote.php?nr=$id' role='button' class='btn btn-success'>$anz_angebote Angebote</a>";
}
?></td>
<td><a href="delete.php?del=<?php echo $id;?>" role="button" class="btn btn-danger">Löschen</a></td>
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
          <p>Wir haben keine passenden Einträge in der Datenbank gefunden, erfassen sie doch gleich in Insarat</p>
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