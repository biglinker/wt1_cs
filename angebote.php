 <!DOCTYPE html> 
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
	
	IF( isset($_GET['accept']) )
	{
		echo "<p>Es wurde auf einen Accept Knopf gedrückt</p>";
		
		//Anbieter suchen für Zusage
		//SQL Abfrage Inserat NR 72, Angebot = 92, 
		$sql = "SELECT * FROM `Nachfrage` JOIN Angebot ON Nachfrage.N_id = Angebot.N_id WHERE Nachfrage.N_id = $nr AND Nachfrage.B_id = $userid AND N_geloescht = 0 ORDER BY A_Preis DESC";		
		
		//2 mal JOIN
		//SELECT * FROM `Nachfrage` JOIN Angebot ON Nachfrage.N_id = Angebot.N_id JOIN Benutzer ON Angebot.B_id = Benutzer.B_id WHERE Nachfrage.N_id = 71 AND Nachfrage.B_id = 27 AND N_geloescht = 0 
		
		//+SQL Update
		
		//SQL Abfrage Inserat NR 72, Angebot <> 92
		//Anbieter suchen für Absage
		//+SQL Update
		
		//Inserat deaktivieren
		//SQL Update Insart auf gelöscht stellen
		
		
		
		
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
	$sql = "SELECT * FROM `Nachfrage` JOIN Angebot ON Nachfrage.N_id = Angebot.N_id WHERE Nachfrage.N_id = $nr AND Nachfrage.B_id = $userid AND N_geloescht = 0 ORDER BY A_Preis DESC";
  
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