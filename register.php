<?php 
session_start();


//Only for development
ini_set("display_errors", 1);
error_reporting(E_ALL & ~E_NOTICE);

include("db_connection.php");
//PDO ist doof, kommentar von PS
//$pdo = new PDO('mysql:host=localhost;dbname=Agricola', 'agricola', 'IBZ@Agri@2017@Web');
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
			<h1>Registrieren</h1>
			
			
<!-- Loginskript von php-einfach.de -->			

<?php
 
if(isset($_GET['register'])) {
 $error = false;
 
 $email = $_POST['B_email'];
 $passwort = $_POST['B_passwort'];
 $firma = $_POST['B_firma'];
 $name = $_POST['B_name'];
 $vname = $_POST['B_vname'];
 $strasse = $_POST['B_strasse'];
 $strasse_nr = $_POST['B_strasse_nr'];
 $plz = $_POST['B_plz'];
 $ort = $_POST['B_ort'];

  
 if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
	echo 'Bitte eine gültige E-Mail-Adresse eingeben<br>';
	$error = true;
 } 
 
 if(strlen($passwort) == 0) {
	echo 'Bitte ein Passwort angeben<br>';
	$error = true;
 }
 
// if($passwort != $passwort2) {
//echo 'Die Passwörter müssen übereinstimmen<br>';
//$error = true;
// }
 
 //Überprüfe, dass die E-Mail-Adresse noch nicht registriert wurde
 if(!$error) { 
 	$sql = "SELECT * FROM Benutzer WHERE B_email = '$email'";
	$result = mysqli_query($conn, $sql);
	echo $sql;
	var_dump($result);
//	$statement = $pdo->prepare("SELECT * FROM Benutzer WHERE B_email = :B_email");
//	$result = $statement->execute(array('B_email' => $email));
//	$user = $statement->fetch();
 
	if(mysqli_num_rows($result) > 0) {
	echo 'Diese E-Mail-Adresse ist bereits vergeben<br>';
	$error = true;
	} 
 }
 
 //Keine Fehler, wir können den Nutzer registrieren
 if(!$error) { 
	$passwort_hash = password_hash($passwort, PASSWORD_DEFAULT);
 
	//Aktuell werden nur die 2 Felder Email und Passwort Hash in die Datenbank gespeichert
 	$sql = "INSERT INTO Benutzer (B_email, B_password)
		VALUES ('$email','$passwort_hash')";	
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
 echo "<p>SQL Fehler anzeigen</p>";
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
 echo "<br><br>";
 
 //-------------
 
 if($result) { 
 echo 'Du wurdest erfolgreich registriert. <a href="login.php">Zum Login</a>';

 } else {
 echo 'Beim Abspeichern ist leider ein Fehler aufgetreten<br>';
 }
 } 
}
?>			
			
			
			
			<p>
			
			<form class="form-horizontal" action="?register=1" method="post">
				
				<br>
				<input type="email" class="form-control" size="40" maxlength="250" name="B_email" placeholder="E-Mail:">
				<br><br>
				 
				Dein Passwort:
				<br>
				<input type="password" class="form-control" size="40"  maxlength="250" name="B_passwort">
				<br>				
				<input type="text" class="form-control" size="40" maxlength="250" name="B_firma" placeholder="Firmennamen:">
				<br>
				<input type="text" class="form-control" size="40" maxlength="250" name="B_name" placeholder="Name:">
				<br>			
				<input type="text" class="form-control" size="40" maxlength="250" name="B_vname" placeholder="Vorname:">
				<br>
				<input type="text" class="form-control" size="40" maxlength="250" name="B_strasse" placeholder="Strasse:">
				<br>
				<input type="text" class="form-control" size="40" maxlength="50" name="B_strasse_nr" placeholder="Strassennr:">
				<br>
				<input type="text" class="form-control" size="40" maxlength="250" name="B_plz" placeholder="Postleitzahl:">
				<br>
				<input type="text" class="form-control" size="40" maxlength="250" name="B_ort" placeholder="Ort:">
				<br>
				<input class="btn btn-default" type="submit" value="Registrieren">
			</form>

</p>



</p>
			
		
		
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