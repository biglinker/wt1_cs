<?php 
session_start();
$pdo = new PDO('mysql:host=localhost;dbname=Agricola', 'agricola', 'IBZ@Agri@2017@Web');
 
if(isset($_GET['login'])) {
 $email = $_POST['B_email'];
 $passwort = $_POST['B_passwort'];
 
 $statement = $pdo->prepare("SELECT * FROM users WHERE B_email = :B_email");
 $result = $statement->execute(array('B_email' => $email));
 $user = $statement->fetch();
 
 //Überprüfung des Passworts
 if ($user !== false && password_verify($passwort, $user['B_passwort'])) {
 $_SESSION['userid'] = $user['B_id'];
 die('Login erfolgreich. Weiter zu <a href="geheim.php">internen Bereich</a>');
 } else {
 $errorMessage = "E-Mail oder Passwort war ungültig<br>";
 }
 
}
?>

<!DOCTYPE html> 
<html> 
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
		
			<img src="src/png/logo.png" alt="Agricola-Trade" class="logo"></img>
	
				<form action="?login=1" method="post" class="form-signin">
				<h2 class="form-signin-heading"> Login </h2><br>
				E-Mail:<br>
				<input type="email" size="40" maxlength="250" name="B_email" class="form-control"><br><br>
			 
				Dein Passwort:<br>
				<input type="password" size="40"  maxlength="250" name="B_passwort" class="form-control"><br>
			 
				<input type="submit" value="Login" class="btn btn-lg btn-primary btn-block">
				
				<a href="pwreset.php" role="button" class="btn btn-lg btn-block btn-danger">Passwort vergessen</a>
			</form> 
			 
		
        </div>
      </div>
   </div>

	<footer>
      <div class="container">
        <p class="text-muted">Place sticky footer content here.</p>
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