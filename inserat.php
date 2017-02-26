﻿<?php
include("session_mgmt.php");
include("db_connection.php");

//Code während Entwicklung
	var_dump($_POST);
	ini_set("display_errors", 1);
	error_reporting(E_ALL & ~E_NOTICE);
	//-----------------


	$nr = $_GET['nr'];



	$sql = "SELECT * FROM Nachfrage WHERE N_id = $nr LIMIT 1";
	//echo $sql;
	$result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($result) > 0) {
	echo "<p>Ausgabe der Datenbank Nachfrage</p>";
    // output data of each row
    while($row = mysqli_fetch_array($result)) {
		var_dump($row);
		
		$titel = $row['N_titel'];
		$text = $row['N_beschreibung'];
		$quali = $row['N_qualitaet'];
		$datum_erstellt = date("j.n.Y", strtotime($row['N_erstellt']));
		$datum_ablauf = date("j.n.Y",strtotime($row['N_gueltig_bis']));
		$menge = number_format($row['N_menge']);
		$menge_einheit = $row['N_menge_einheit'];
		
    }
} else {
    echo "<p>0 results in DB Nachfrage</p>";
}


mysqli_close($conn);
?>

<!DOCTYPE html> 
<html> 
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
				<h1>Inserat Anzeigen</h1>
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
				<p><strong>gewünschte Menge: </strong> <?php echo $menge . " " . $menge_einheit ?></p>
				<p><strong>Lieferzeitpunkt: </strong> <?php echo $datum_ablauf ?></p>
				<p>Inserat-Nr <?php echo $nr;  ?></p>
			</div>
			
			<div class="col-md-4">
				<h2>Angebot erfassen #für eingeloggte User</h2>
				
				<form class="form-horizontal" action="#" method="post">
					<div class="form-group">	
						<label class="control-label col-sm-3" for="A_nachricht">Nachricht</label>
						<div class="col-sm-9">
							<textarea class="form-control" rows="5" id="A_nachricht" name="A_nachricht"></textarea>
						</div>
					</div>

					<div class="form-group">						
						<label class="control-label col-sm-3" for="A_menge">Menge</label>
						<div class="col-sm-9">
							<input type="text" class="form-control" size="40" maxlength="250" name="N_menge" placeholder="Menge">
						</div>
					</div>		
						
					<div class="form-group">				
						<label class="control-label col-sm-3" for="A_preis">Preis</label>
						<div class="col-sm-9">
							<input type="date" class="form-control" size="40" maxlength="250" id="A_preis" name="A_preis" placeholder="5750.99">
						</div>
					</div>
					
					<div class="form-group">
						<div class="col-sm-offset-3 col-sm-9">
							<div class="checkbox">
								<label><input type="checkbox">AGB von Agricola-Trade akzeptieren</label>
							</div>
						</div>
					</div>
						
					<div class="form-group">	
						    <div class="col-sm-offset-3 col-sm-9">
								<button type="submit" class="btn btn-default">Angebot platzieren</button>
							</div>
					</div>	
				</form> 
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