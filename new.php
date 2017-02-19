<?php 
include("session_mgmt.php");
include("db_connection.php");


include("login_req.php");





IF( !empty($_POST) ) {
	echo "<p>Es wurden Daten übermitteln!</p>";
	
	var_dump($_POST);
	
	$error = false;
 
	$N_titel = trim(htmlentities($_POST["N_titel"], ENT_QUOTES));
	$N_bezeichnung = trim(htmlentities($_POST["N_bezeichnung"], ENT_QUOTES));
	$N_qualitat = trim(htmlentities($_POST["N_qualitat"], ENT_QUOTES));
	$N_menge = trim(htmlentities($_POST["N_menge"], ENT_QUOTES));
	$N_lieferzeitpunkt = trim(htmlentities($_POST["N_lieferzeitpunkt"], ENT_QUOTES));
	$B_id = $_SESSION["B_id"];
	
	//sind alle Felder ausgefüllt worden ?
	IF( empty($N_titel) OR empty($N_bezeichnung) OR empty($N_qualitat) OR empty($N_menge) OR empty($N_lieferzeitpunkt) ) {
		$error = true;
		echo "<p>Bitte alle Felder ausfüllen</p>";	
	}
	
	//Lieferzeitpunkt in Datum konvertieren!
	IF( !$N_gueltigbis = date("Y-m-d H:i:s",strtotime($N_lieferzeitpunkt , time())) ) {
		echo "<p>Datum ungültig</p>";
	}
			
//Daten in Datenbank einfügen
	 if(!$error) { 
		
		$sql = "INSERT INTO Nachfrage (B_id, N_erstellt, N_titel, N_bescheibung, N_qualitaet, N_gueltig_bis, N_menge) VALUES ('$B_id', CURRENT_TIMESTAMP, '$N_titel', '$N_bezeichnung', '$N_qualitat', '$N_gueltigbis', '$N_menge')";

		echo $sql;
		IF( $result = mysqli_query($conn, $sql) ) {
			echo "<p>Inserat in DB eingefügt</p>";
		}
		else
		{
			echo "<p>Beim einfügen in die Datenbank ist etwas schiefgelaufen.</p>";		
			
		}
		
		//var_dump($result);
	}
	
}

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
 
	<!-- Include Navigation Bar -->
	<div class="container">
		<?php include("navigation.php"); ?>
	</div>
 
 <!-- Page Content -->
    <div class="container">
      <!-- Example row of columns -->
      <div class="row">
        <div class="col-md-12">
			<h1>Nachfrage-Inserat erfassen (Produktsuche)</h1>
				<div class="form-group">
					<form class="form-horizontal" action="new.php" method="post">
						<label for="N_titel">Titel</label>
						<input type="text" class="form-control" size="40" maxlength="250" name="N_titel" placeholder="Inseratetitel">
						<br>
						<label for="N_bezeichnung">Bezeichnung</label>
						<textarea class="form-control" rows="5" id="N_bezeichnung" name="N_bezeichnung"></textarea>
						<br>
						<label for="N_qualitat">Qualität</label>
						<input type="text" class="form-control" size="40"  maxlength="250" name="N_qualitat" placeholder="gewünschte Qualität spezifizeren">
						<br>
						<label for="N_qualitat">Menge</label>
						<input type="text" class="form-control" size="40" maxlength="250" name="N_menge" placeholder="Benötigte Menge">
						<br>
						
						<!--
						<label for="N_preis">Preis</label>						
						<input type="text" class="form-control" size="40" maxlength="250" name="N_preis" placeholder="Preis pro Einheit in CHF:">
						<br>-->
				
						<label for="N_lieferzeitpunkt">Lieferdatum</label>
						<input type="date" class="form-control" size="40" maxlength="250" id="N_lieferzeitpunkt" name="N_lieferzeitpunkt">
				  
						<br>
						<div class="checkbox">
							<label>
								<input type="checkbox">AGB von Agricola akzeptieren
							</label>
						</div>
						<br>
						<button type="submit" class="btn btn-default">Erfassen</button>
					</form>
				</div>
				  				
        </div>
      </div>
   </div>

	<footer>
      <div class="container">
 
		<h5>2017 @ IBZ Agricola-Trade developed by Philipp Schelbert, Daniel Staub</h5>
      </div>

	</footer>

</div>

    <!-- Bootstrap core JavaScript -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="res/bootstrap/js/bootstrap.min.js"></script>
    <script src="res/bootstrap/js/docs.min.js"></script>
</body>
</html>