<?php 
include("session_mgmt.php");
include("db_connection.php");

include("login_req.php");


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
				<h1>XML -Export</h1>
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