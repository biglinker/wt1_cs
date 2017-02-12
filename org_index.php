<?php 
session_start();
$pdo = new PDO('mysql:host=localhost;dbname=Agricola', 'agricola', 'IBZ@Agri@2017@Web');
 
if(isset($_GET['login'])) {
 $email = $_POST['email'];
 $passwort = $_POST['passwort'];
 
 $statement = $pdo->prepare("SELECT * FROM users WHERE email = :email");
 $result = $statement->execute(array('email' => $email));
 $user = $statement->fetch();
 
 //Überprüfung des Passworts
 if ($user !== false && password_verify($passwort, $user['passwort'])) {
 $_SESSION['userid'] = $user['id'];
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
  
  <link href="res/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="dev/login.css" rel="stylesheet">
</head> 

<body>
 
<?php 
if(isset($errorMessage)) {
 echo $errorMessage;
}
?>
 
 
 <div class="container">
 <img src="src/png/logo.png" alt="Agricola-Trade" class="logo"></img>
	
	<form action="?login=1" method="post" class="form-signin">
	<h2 class="form-signin-heading"> Login </h2><br>
	E-Mail:<br>
	<input type="email" size="40" maxlength="250" name="email" class="form-control"><br><br>
 
	Dein Passwort:<br>
	<input type="password" size="40"  maxlength="250" name="passwort" class="form-control"><br>
 
	<input type="submit" value="Login" class="btn btn-lg btn-primary btn-block">
</form> 

<footer>
<h5>2017 @ IBZ Agricola-Trade developed by Philipp Schelbert, Daniel Staub</h5>
</footer>

</div>
</body>
</html>