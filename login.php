 <!DOCTYPE html>
<html lang="de">
<?php 
include "session_mgmt.php";
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
		$errormessage = 'Bitte eine gültige E-Mail-Adresse eingeben<br>';
		$error = true;
	} 
 
	if(!$error) {

		$sql = "SELECT * FROM Benutzer WHERE B_email = '$email'"; // AND WHERE B_Password ='$passwort_hash'";
		$result = mysqli_query($conn, $sql);
		if(mysqli_num_rows($result) == 1) {
			while($row = mysqli_fetch_assoc($result)) {
				$password_db = $row['B_password'];
				$user_id = $row['B_id'];
			}
		} 
		else
		{
			$errormessage = 'Fehler beim Login, Konto nicht vorhanden!<br>';
			$error = true;			
		}
		
		//Passwort prüfen
		IF( password_verify($passwort, $password_db) ) {
			//Wenn Passwort gültig, Session Variable setzen
			
			$_SESSION['B_id'] = $user_id;
			$_SESSION['time'] = time();
			
			$successMessage = "Login erfolgreich.";
			
			IF( isset($_GET['fwd']) ) {
				$location_fwd = $_GET['fwd'];
				//Umleitung bei erfolgreichem Login
				echo "<meta http-equiv='refresh' content='1; url=$location_fwd'>";
				//exit();
				
			}
			else
			{
				//Wenn kein Weiterleitungsparameter mitgeben wurde, auf Hauptseite weiterleiten
				echo "<meta http-equiv='refresh' content='1; url=main.php'>";
				//exit();
			}
			
		}
		else
		{
			//Falsches Passwort
			$errorMessage = "Passworteingabe ungültig";
		}		
	
	} 
	else {
		$errorMessage = "E-Mail ist ungültig<br>";
	}
 
  
	//Aktuell werden nur die 2 Felder Email und Passwort Hash in die Datenbank gespeichert
		 
	if($result) { 
		$successMessage = 'Du wurdest erfolgreich angemeldet.';
	} 
	else {
			$errorMessage = 'Beim Anmelden ist leider ein Fehler aufgetreten<br>';
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
	
	<!-- Page Header -->
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h1>Login</h1>
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
	
<!-- Page Content NEW -->
    <div class="container">		
      <div class="row">
        <div class="col-md-6 col-md-offset-3">
					
			<p><img src="src/png/logo.png" alt="Agricola-Trade" class="logo"><br><br></p>
					
				<form class="form-horizontal" action="login.php<?php IF(isset($_GET['fwd'])) { echo "?fwd=".$_GET['fwd']; }  ?>" method="post">
					<div class="form-group">						
						<label class="control-label col-sm-3" for="B_email">E-Mail</label>
						<div class="col-sm-9">
							<input type="email" class="form-control input-lg" size="40" maxlength="250" name="B_email" placeholder="name@domain.ch">
						</div>
					</div>		
						
					<div class="form-group">				
						<label class="control-label col-sm-3" for="A_preis">Passwort</label>
						<div class="col-sm-9">
							<input type="password" class="form-control input-lg" size="40"  maxlength="250" name="B_passwort">
						</div>
					</div>
															
					<div class="form-group">	
						<div class="col-sm-offset-3 col-sm-9">
							<input type="submit" value="Login" class="btn btn-lg btn-success btn-block">
							<br>
							<a href="pwreset.php" role="button" class="btn btn-lg btn-block btn-info">Passwort vergessen</a>
						</div>
					</div>	
				</form> 
				
				<div class="col-sm-offset-3 col-sm-9">
					<h2><a href="register.php"><span class="glyphicon glyphicon-user"></span></a>  
						<a href="register.php">Noch kein Login?</a></h2>
				</div>
        </div>
      </div>
   </div>	
	
   <?php include "footer.php"; ?>
   
    <!-- Bootstrap core JavaScript -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="res/bootstrap/js/bootstrap.min.js"></script>
    <script src="res/bootstrap/js/docs.min.js"></script>
</body>
</html>