 <!DOCTYPE html>
<html lang="de">
<?php 
include 'session_mgmt.php';
include "db_connection.php";

//Only for development
ini_set("display_errors", 1);
error_reporting(E_ALL & ~E_NOTICE);


if(isset($_POST['B_email'])) {
	$error = false;
	$email = strtolower($_POST['B_email']);
	$passwort = $_POST['B_passwort'];
	$passwort_hash = password_hash($passwort, PASSWORD_DEFAULT);
  
	if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		echo 'Bitte eine gültige E-Mail-Adresse eingeben<br>';
		$error = true;
	} 
 
	if(!$error) {

		
		$sql = "SELECT * FROM Benutzer WHERE B_email = '$email'"; // AND WHERE B_Password ='$passwort_hash'";
		$result = mysqli_query($conn, $sql);
		if(mysqli_num_rows($result) == 1) {
			while($row = mysqli_fetch_assoc($result)) {
				var_dump($row);
				echo "<br>";
				
				echo "HALT!". $row['B_password'];
				$password_db = $row['B_password'];
				$user_id = $row['B_id'];
			}
		} 
		else
		{
			echo 'Fehler beim Login, Konto nicht vorhanden!<br>';
			$error = true;			
		}
		echo "<p>Passwort aus DB" . $password_db . "</p>";
		echo "<p>Passwort aus Eingabe" . $passwort_hash . "</p>";
		
		//Passwort prüfen
		IF( password_verify($passwort, $password_db) ) {
			echo "<p>Das Passwort scheint gültig zu sein</p>";
			//Wenn Passwort gültig, Session Variable setzen
			
			$_SESSION['B_id'] = $user_id;
			$_SESSION['time'] = time();
			
			IF( isset($_GET['fwd']) ) {
				$location_fwd = $_GET['fwd'];
				echo "<meta http-equiv='refresh' content='0; url=$location_fwd'>";
				//header("Location: $location_fwd");
				exit();
				
			}
			else
			{
				//Wenn kein Weiterleitungsparameter mitgeben wurde, auf Hauptseite weiterleiten
				echo "<meta http-equiv='refresh' content='0; url=main.php'>";
				//header("Location: $location_fwd");
				exit();
			}
			
			
		}
		else
		{
			//Falsches Passwort
			echo "<p>Passworteingabe ungültig</p>";
			
		}
		
		
		//echo $sql;
		//var_dump($result);

		//die('Login erfolgreich. Weiter zu <a href="geheim.php">internen Bereich</a>');
		
		
	} 
 
	else {
		$errorMessage = "E-Mail ist ungültig<br>";
	}
 
			
// $statement = $pdo->prepare("SELECT * FROM users WHERE B_email = :B_email");
// $result = $statement->execute(array('B_email' => $email));
// $user = $statement->fetch();
 
//Überprüfung des Passworts
//if ($user !== false && password_verify($passwort, $user['B_passwort'])) {
//$_SESSION['userid'] = $user['B_id'];
// die('Login erfolgreich. Weiter zu <a href="geheim.php">internen Bereich</a>');
// } else 
//{
	 
  
	//Aktuell werden nur die 2 Felder Email und Passwort Hash in die Datenbank gespeichert
	
 
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
	} 
	else {
			echo 'Beim Anmelden ist leider ein Fehler aufgetreten<br>';
	}
	
}
?>
<head>
  <title>Login Agricola-Trade</title> 
  
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
			<h1>Login</h1>
		
		
		<!-- HTML Code für Login -->
				
		
			<img src="src/png/logo.png" alt="Agricola-Trade" class="logo">
	
			<form action="login.php<?php IF(isset($_GET['fwd'])) { echo "?fwd=".$_GET['fwd']; }
			  ?>
			" method="post" class="form-signin">
				<h2 class="form-signin-heading"> Login </h2><br>
				E-Mail:<br>
				<input type="email" class="form-control" size="40" maxlength="250" name="B_email" ><br><br>
			 
				Dein Passwort:<br>
				<input type="password" class="form-control" size="40"  maxlength="250" name="B_passwort" ><br>
			 
				<input type="submit" value="Login" class="btn btn-lg btn-success btn-block">
				
				<a href="pwreset.php" role="button" class="btn btn-lg btn-block btn-info">Passwort vergessen</a>
			</form> 
			
			<center><h2>
			<a href="register.php"><span class="glyphicon glyphicon-user"></span></a>  
			<a href="register.php">Noch kein Login?</a> </h2></center>
			
		<!-- HTML Code für Login  -->
			 
		
        </div>
      </div>
   </div>

	<footer>
      <div class="container">
        <p class="text-muted">Place sticky footer content here.</p>
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