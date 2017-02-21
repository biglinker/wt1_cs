﻿<?php 
session_start();

//Only for development
ini_set("display_errors", 1);
error_reporting(E_ALL & ~E_NOTICE);

include("session_mgmt.php");
include("db_connection.php");






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
			<h1>Passwort zurücksetzen</h1>
		
				<form action="pwreset_submit.php" method="post" class="form-signin">
				<h2 class="form-signin-heading"> Passwort anfordern </h2><br>
				E-Mail:<br>
				<input type="email" class="form-control" size="40" maxlength="250" name="B_email" ><br><br>
			 			 
				<input type="submit" value="Zurücksetzen" class="btn btn-lg btn-success btn-block">
				
				
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