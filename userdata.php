<?php 
include("session_mgmt.php");
include("db_connection.php");

include "login_req.php";

//Only for development
ini_set("display_errors", 1);
error_reporting(E_ALL & ~E_NOTICE);

	//Parameter
	$userid = $_SESSION['B_id'];


?>

<?php
//var_dump($_POST);
 
IF( isset($_POST["btn-save"]) ) {
	//echo "Drückt";
	$error = false;
 
	//$email = strtolower($_POST['B_email']);
 
	$B_firma = trim(htmlentities($_POST["B_firma"], ENT_QUOTES));
	$B_name = trim(htmlentities($_POST["B_name"], ENT_QUOTES));
	$B_vname = trim(htmlentities($_POST["B_vname"], ENT_QUOTES));
	$B_strasse = trim(htmlentities($_POST["B_strasse"], ENT_QUOTES));
	$B_strasse_nr = trim(htmlentities($_POST["B_strasse_nr"], ENT_QUOTES));
	$B_plz = trim(htmlentities($_POST["B_plz"], ENT_QUOTES));
	$B_ort = trim(htmlentities($_POST["B_ort"], ENT_QUOTES));
	$B_update = date("Y-m-d H:i:s",time());
	date("j.n.Y",strtotime($row['N_gueltig_bis']));
  
   
	//Keine Fehler, die Daten ändern
	if(!$error) { 
 
	//Aktuell werden nur die 2 Felder Email und Passwort Hash in die Datenbank gespeichert	
	$sql = "UPDATE Benutzer SET B_update = '$B_update', B_firma= '$B_firma', B_name = '$B_name', B_vname = '$B_vname', B_strasse = '$B_strasse', B_strasse_nr = '$B_strasse_nr', B_plz = '$B_plz', B_ort = '$B_ort' WHERE B_id = '$userid'";	
 	$result = mysqli_query($conn, $sql);
 
	if($result) { 
		$successMessage = 'Die Daten wurden erfolgreich geändert. <a href="konto.php">Zum Konto</a>';

		} else {
			$errorMessage = 'Beim Ändern der Daten ist etwas schiefgelaufen';
		}
	} 
}


	// Die aktuellen Daten aus der Datenbank holen
	$sql = "SELECT * FROM Benutzer WHERE B_id = '$userid' LIMIT 1";
	$result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($result) > 0) {
	//echo "<p>Ausgabe der Datenbank Nachfrage</p>";
    // output data of each row
    while($row = mysqli_fetch_array($result)) {
		$B_email = $row['B_email'];
		$B_firma = $row['B_firma'];
		$B_name = $row['B_name'];
		$B_vname = $row['B_vname'];
		$B_strasse = $row['B_strasse'];
		$B_strasse_nr = $row['B_strasse_nr'];
		$B_plz = $row['B_plz'];
		$B_ort = $row['B_ort'];
    }
} else {
    $errorMessage = "Keine Resultate mit dieser Nummer</p>";
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
				<h1>Daten ändern</h1>
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
				<form class="form-horizontal" action="" method="post">

					<div class="form-group">					
						<label class="control-label col-sm-2" for="B_email">E-Mail</label>
						<div class="col-sm-10">
							<input type="email" class="form-control input-lg" size="40" maxlength="250" name="B_email" value="<?php echo $B_email; ?>" readonly>
						</div>
					</div>

					<div class="form-group">						
						<label class="control-label col-sm-2" for="B_firma">Firmenname</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" size="40" maxlength="250" name="B_firma" value="<?php echo $B_firma; ?>">						
						</div>
					</div>

					<div class="form-group">						
						<label class="control-label col-sm-2" for="B_name">Name</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" size="40" maxlength="250" name="B_name" value="<?php echo $B_name; ?>">					
						</div>
					</div>
					
					<div class="form-group">						
						<label class="control-label col-sm-2" for="B_vname">Vorname</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" size="40" maxlength="250" name="B_vname" value="<?php echo $B_vname; ?>">					
						</div>
					</div>
					
					<div class="form-group">						
						<label class="control-label col-sm-2" for="B_strasse">Strasse</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" size="40" maxlength="250" name="B_strasse" value="<?php echo $B_strasse; ?>">							
						</div>
					</div>
					
					<div class="form-group">						
						<label class="control-label col-sm-2" for="B_strasse_nr">Strassennr</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" size="40" maxlength="50" name="B_strasse_nr" value="<?php echo $B_strasse_nr; ?>">				
						</div>
					</div>

					<div class="form-group">						
						<label class="control-label col-sm-2" for="B_plz">PLZ</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" size="40" maxlength="250" name="B_plz" value="<?php echo $B_plz; ?>">				
						</div>
					</div>	

					<div class="form-group">						
						<label class="control-label col-sm-2" for="B_ort">Ort</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" size="40" maxlength="250" name="B_ort" value="<?php echo $B_ort; ?>">					
						</div>
					</div>					
											
					<div class="form-group">	
						    <div class="col-sm-offset-2 col-sm-10">
								<button type="submit" class="btn btn-default" name="btn-save">Speichern</button>
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