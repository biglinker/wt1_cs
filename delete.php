 <!DOCTYPE html> 
<html lang="de"> 
<?php
include "session_mgmt.php";
include "db_connection.php";

include "login_req.php";

	//Code während Entwicklung
	ini_set("display_errors", 1);
	error_reporting(E_ALL & ~E_NOTICE);

	$nr = $_GET['nr'];

	$userid = $_SESSION['B_id'];
	$del = $_GET['del'];
	
	IF(isset($_GET['del']) AND ( $_GET['confirm'] ) ){
		$del = $_GET['del'];
		$confirm = $_GET['confirm'];
		
		IF( $confirm == "yes"){
			//query  the database table
			$sql = "UPDATE Nachfrage SET N_geloescht = 1 WHERE N_id = $del";

			//run the query against the mysql query function
			$result = mysqli_query($conn, $sql);	
			
			echo "<meta http-equiv='refresh' content='0; url=konto.php'>";			
		}
		
	}
	
	

?>
<head>
  <title>Agricola-Trade</title> 
  
  <!-- Boostrap CSS -->
  <link href="res/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="res/bootstrap/css/bootstrap-theme.min.css" rel="stylesheet">
  
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
				<h1>Inserat löschen</h1>
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
	</div>
			
	<!-- Page Connet -->
	<div class="container">
		<div class="row">
			<div class="col-md-12">	

 <?php  
 	IF(isset($_GET['del']) ){
		$del = $_GET['del'];
		
		//query  the database table
		$sql = "SELECT * FROM Nachfrage WHERE N_id = $del";
	
		//run  the query against the mysql query function
		$result = mysqli_query($conn, $sql);
		
		while($row = mysqli_fetch_array($result)) {

			$titel = substr($row['N_titel'], 0,30);
			$text = substr($row['N_beschreibung'], 0,60);
			
		}
		
	?>
		<h3>Soll das Nachfrage-Inserat <?php echo $del; ?> wirklich gelöscht werden?</h3>	
		<h5><?php echo $titel;?></h5>
		<p><?php echo $text;?></p>
		<p><a href='konto.php' role='button' class='btn btn-success'>Nein</a>
		<a href="delete.php?del=<?php echo $del;?>&confirm=yes" role='button' class='btn btn-danger'>Ja</a></p>
		
	<?php

	}
 
 ?>
 
	  		</div>
		</div>
	</div>	
	
	<!-- Footer -->	
	<?php include "footer.php"; ?>
	
    <!-- Bootstrap core JavaScript -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="res/bootstrap/js/bootstrap.min.js"></script>
    <script src="res/bootstrap/js/docs.min.js"></script>
</body>
</html>