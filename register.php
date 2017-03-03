<?php 
include("session_mgmt.php");
include("db_connection.php");

//Only for development
ini_set("display_errors", 1);
error_reporting(E_ALL & ~E_NOTICE);


?>

<?php
//var_dump($_POST);
 
if(isset($_GET['register'])) {
	$error = false;
 
	$email = strtolower($_POST['B_email']);
	$passwort = $_POST['B_passwort'];
 
	$B_firma = trim(htmlentities($_POST["B_firma"], ENT_QUOTES));
	$B_name = trim(htmlentities($_POST["B_name"], ENT_QUOTES));
	$B_vname = trim(htmlentities($_POST["B_vname"], ENT_QUOTES));
	$B_strasse = trim(htmlentities($_POST["B_strasse"], ENT_QUOTES));
	$B_strasse_nr = trim(htmlentities($_POST["B_strasse_nr"], ENT_QUOTES));
	$B_plz = trim(htmlentities($_POST["B_plz"], ENT_QUOTES));
	$B_ort = trim(htmlentities($_POST["B_ort"], ENT_QUOTES));
 
  
 if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
	$errorMessage = 'Bitte eine gültige E-Mail-Adresse eingeben<br>';
	$error = true;
 } 
 
 if(strlen($passwort) == 0) {
	$errorMessage = 'Bitte ein Passwort angeben<br>';
	$error = true;
 }
  
 //Überprüfe, dass die E-Mail-Adresse noch nicht registriert wurde
 if(!$error) { 
 	$sql = "SELECT * FROM Benutzer WHERE B_email = '$email'";
	$result = mysqli_query($conn, $sql);
	//echo $sql;
	//var_dump($result);
//	$statement = $pdo->prepare("SELECT * FROM Benutzer WHERE B_email = :B_email");
//	$result = $statement->execute(array('B_email' => $email));
//	$user = $statement->fetch();
 
	if(mysqli_num_rows($result) > 0) {
		$errorMessage = 'Diese E-Mail-Adresse ist bereits vergeben<br>';
		$error = true;
	} 
 }
 
 //Keine Fehler, wir können den Nutzer registrieren
 if(!$error) { 
	$passwort_hash = password_hash($passwort, PASSWORD_DEFAULT);
 
	//Aktuell werden nur die 2 Felder Email und Passwort Hash in die Datenbank gespeichert	
	$sql = "INSERT INTO Benutzer (B_email, B_password, B_firma, B_name, B_vname, B_strasse, B_strasse_nr, B_plz, B_ort)
		VALUES ('$email','$passwort_hash','$B_firma','$B_name','$B_vname','$B_strasse','$B_strasse_nr','$B_plz','$B_ort')";	
		
 	$result = mysqli_query($conn, $sql);
 
 
 
	//$statement = $pdo->prepare("INSERT INTO Benutzer (B_email, B_passwort, B_firma, B_name, B_vname, B_strasse, B_strasse_nr, B_plz, B_ort) 
	//VALUES (:B_email, :B_passwort, :B_firma, :B_name, :B_vname, :B_strasse, :B_strasse_nr, :B_plz, :B_ort)");
 
 //$result = $statement->

 /*execute(array(
 'B_email' => $email, 
 'B_passwort' => $passwort_hash, 
 'B_firma' => $firma, 
 'B_name' => $name, 
 'B_vname' => $vname,
 'B_strasse' => $strasse,
 'B_strasse_nr' => $strasse_nr,
 'B_plz' => $plz,
 'B_ort' => $ort,  
 ));*/
 
 //Ausgabe während der Entwicklungsphase für Fehlersuche
 /*echo "<p>SQL Fehler anzeigen</p>";
 echo mysqli_error($conn);
 echo "<br><br>"; 
 
 echo "<p>Variable db SQL</p>";
 var_dump($sql);
 echo "<br><br>";
 
 echo "<p>Variable db Result</p>";
 var_dump($result);
 echo "<br><br>";
 
 echo "<p>Variable db Statement</p>";
 var_dump($statement);
 echo "<br><br>";*/
 
 //-------------
 
 if($result) { 
	$successMessage = 'Du wurdest erfolgreich registriert. <a href="login.php">Zum Login</a>';

 } else {
	$errorMessage = 'Beim Abspeichern ist leider ein Fehler aufgetreten<br>';
 }
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
  
	<!-- Include Navigation Bar -->
	<div class="container">
		<?php include("navigation.php"); ?>
	</div>
 
	<!-- Page Header -->
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h1>Registrieren</h1>
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
				<form class="form-horizontal" action="?register=1" method="post">

					<div class="form-group">					
						<label class="control-label col-sm-2" for="B_email">E-Mail</label>
						<div class="col-sm-10">
							<input type="email" class="form-control input-lg" size="40" maxlength="250" name="B_email" placeholder="E-Mail">
						</div>
					</div>

					<div class="form-group">	
						<label class="control-label col-sm-2" for="B_passwort">Passwort</label>
						<div class="col-sm-10">
							<input type="password" class="form-control input-lg" size="40"  maxlength="250" name="B_passwort">
						</div>
					</div>

					<div class="form-group">						
						<label class="control-label col-sm-2" for="B_firma">Firmenname</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" size="40" maxlength="250" name="B_firma" placeholder="Firmenname">						
						</div>
					</div>

					<div class="form-group">						
						<label class="control-label col-sm-2" for="B_name">Name</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" size="40" maxlength="250" name="B_name" placeholder="Name">						
						</div>
					</div>
					
					<div class="form-group">						
						<label class="control-label col-sm-2" for="B_vname">Vorname</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" size="40" maxlength="250" name="B_vname" placeholder="Vorname">						
						</div>
					</div>
					
					<div class="form-group">						
						<label class="control-label col-sm-2" for="B_strasse">Strasse</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" size="40" maxlength="250" name="B_strasse" placeholder="Strasse">							
						</div>
					</div>
					
					<div class="form-group">						
						<label class="control-label col-sm-2" for="B_strasse_nr">Strassennr</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" size="40" maxlength="50" name="B_strasse_nr" placeholder="Strassennr">					
						</div>
					</div>

					<div class="form-group">						
						<label class="control-label col-sm-2" for="B_plz">PLZ</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" size="40" maxlength="250" name="B_plz" placeholder="Postleitzahl">					
						</div>
					</div>	

					<div class="form-group">						
						<label class="control-label col-sm-2" for="B_ort">Ort</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" size="40" maxlength="250" name="B_ort" placeholder="Ort">					
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
   
   

	<!-- Footer -->
	<?php include "footer.php" ?>
	

</div>

    <!-- Bootstrap core JavaScript -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="res/bootstrap/js/bootstrap.min.js"></script>
    <script src="res/bootstrap/js/docs.min.js"></script>
</body>
</html>