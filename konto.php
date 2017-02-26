 <!DOCTYPE html> 
<html lang="de"> 
<?php
include("session_mgmt.php");
include("db_connection.php");

//include("login_req.php");

//Code während Entwicklung
	var_dump($_POST);
	ini_set("display_errors", 1);
	error_reporting(E_ALL & ~E_NOTICE);
	//-----------------


	$nr = $_GET['nr'];



	$sql = "SELECT * FROM Nachfrage LIMIT 1";
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
}


mysqli_close($conn);
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
				<p>Inserate anzeigen / löschen</p>
				<p>Benutzerangaben ändern </p>
				<p>Angebote zu inseraten als xml File per Mail</p>
				<p>Später: Passwort ändern</p>
			</div>
		</div>
	</div>	
	
	<!-- Page Content -->
	<div class="container">
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