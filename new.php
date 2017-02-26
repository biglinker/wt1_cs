<?php 
include("session_mgmt.php");
include("db_connection.php");

include("login_req.php");


IF( !empty($_POST) ) {
	//echo "<p>Es wurden Daten übermitteln!</p>";
	
	//var_dump($_POST);
	
	$error = false;
 
	$N_titel = trim(htmlentities($_POST["N_titel"], ENT_QUOTES));
	$N_bezeichnung = trim(htmlentities($_POST["N_bezeichnung"], ENT_QUOTES));
	$N_qualitat = trim(htmlentities($_POST["N_qualitat"], ENT_QUOTES));
	$N_menge = trim(htmlentities($_POST["N_menge"], ENT_QUOTES));
	$N_menge_einheit = trim(htmlentities($_POST["N_menge_einheit"], ENT_QUOTES));
	$N_lieferzeitpunkt = trim(htmlentities($_POST["N_lieferzeitpunkt"], ENT_QUOTES));
	$B_id = $_SESSION["B_id"];
	
	
	//sind alle Felder ausgefüllt worden ?
	IF( empty($N_titel) OR empty($N_bezeichnung) OR empty($N_qualitat) OR empty($N_menge) OR empty($N_menge_einheit) OR empty($N_lieferzeitpunkt) ) {
		$error = true;
		$errorMessage = "Bitte alle Felder ausfüllen.";	
	}
	
	//Lieferzeitpunkt in Datum konvertieren!
	IF( !$N_gueltigbis = date("Y-m-d H:i:s",strtotime($N_lieferzeitpunkt , time())) ) {
		$errorMessage = "Eingegebenes Datum ist ungültig.";
	}
			
//Daten in Datenbank einfügen
	 if(!$error) { 
		
		$sql = "INSERT INTO Nachfrage (B_id, N_erstellt, N_titel, N_beschreibung, N_qualitaet, N_gueltig_bis, N_menge, N_menge_einheit) VALUES ('$B_id', CURRENT_TIMESTAMP, '$N_titel', '$N_bezeichnung', '$N_qualitat', '$N_gueltigbis', '$N_menge', '$N_menge_einheit')";

		//echo $sql;
		IF( $result = mysqli_query($conn, $sql) ) {
			$successMessage = "Inserat in DB eingefügt";
		}
		else
		{
			$errorMessage = "Beim einfügen in die Datenbank ist etwas schiefgelaufen.";		
			
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
  
	<!-- Custom CSS -->
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
				<h1>Nachfrage-Inserat erfassen (Produktsuche)</h1>
			</div>
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

	<!-- Page Content -->
    <div class="container">
		<div class="row">
			<div class="col-md-12">
			<!--	<form class="form-horizontal" action="new.php" method="post">-->
				<form class="form-horizontal"   action="new.php" method="post">

					<div class="form-group">					
						<label class="control-label col-sm-2" for="N_titel">Titel</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" size="40" maxlength="250" name="N_titel" placeholder="Inseratetitel">
						</div>
					</div>

					<div class="form-group">	
						<label class="control-label col-sm-2" for="N_bezeichnung">Bezeichnung</label>
						<div class="col-sm-10">
							<textarea class="form-control" rows="5" id="N_bezeichnung" name="N_bezeichnung"></textarea>
						</div>
					</div>

					<div class="form-group">						
						<label class="control-label col-sm-2" for="N_qualitat">Qualität</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" size="40"  maxlength="250" name="N_qualitat" placeholder="gewünschte Qualität spezifizeren">
						</div>
					</div>

					<div class="form-group">						
						<label class="control-label col-sm-2" for="N_qualitat">Menge</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" size="40" maxlength="250" name="N_menge" placeholder="Benötigte Menge">
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-sm-2" for="N_menge_einheit">Mengeneinheit</label>
						<div class="col-sm-10">
							<select class="form-control" name="N_menge_einheit">
								<option value="Stk">Stk</option>
								<option value="g">g</option>
								<option value="kg">kg</option>
								<option value="Tonnen">Tonnen</option>
								<option value="mm">mm</option>
								<option value="m">m</option>
								<option value="km">km</option>							
							</select>
						</div>
					</div>			
						
					<div class="form-group">				
						<label class="control-label col-sm-2" for="N_lieferzeitpunkt">Lieferdatum</label>
						<div class="col-sm-10">
							<input type="date" class="form-control" size="40" maxlength="250" id="N_lieferzeitpunkt" name="N_lieferzeitpunkt" placeholder="<?php echo date("d.m.Y",time()+1814400); ?>">
						</div>
					</div>
					
					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
							<div class="checkbox">
								<label><input type="checkbox">AGB von Agricola-Trade akzeptieren</label>
							</div>
						</div>
					</div>
						
					<div class="form-group">	
						    <div class="col-sm-offset-2 col-sm-10">
								<button type="submit" class="btn btn-default">Erfassen</button>
							</div>
					</div>	
				</form> 
			</div>
		</div>
	</div>

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