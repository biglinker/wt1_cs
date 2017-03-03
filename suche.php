<?php 
include("session_mgmt.php");
include("db_connection.php");


//Code während Entwicklung
	var_dump($_POST);
	ini_set("display_errors", 1);
	error_reporting(E_ALL & ~E_NOTICE);
	//-----------------
	


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
				<h1>Inserate Suchen</h1>
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
 
 
 <!-- Search Content -->
	<div class="container">
		
 
 
 <?php
   if(isset($_POST['name'])){
  $name = $_POST['name'];
   
  //query  the database table
  $sql="SELECT N_titel, N_beschreibung, N_qualitaet, N_menge, N_id FROM Nachfrage  WHERE N_titel LIKE '%" . $name ."%'";
  
  //echo $sql;
  //run  the query against the mysql query function
  $result=mysqli_query($conn, $sql);
	
  
 
 if (mysqli_num_rows($result) > 0) {
	// output data of each row
    while($row = mysqli_fetch_array($result)) {

	$titel = $row['N_titel'];
	$text =  substr($row['N_beschreibung'], 0,200);
	$id = $row['N_id'];
	
 ?>
 
 
    
      <div class="row">
        <div class="col-md-12">
          <h2><?php echo $titel; ?></h2>
          <p> <?php echo $text; ?></p>
          <p><a class="btn btn-default" href="inserat.php?nr=<?php echo $id; ?>" role="button">Inserat anzeigen &raquo;</a></p>
        </div>
	  </div>
	 
	  
<?php
		}
	} else {
?>

      <div class="row">
        <div class="col-md-12">
          <h2>Leider nichts gefunden</h2>
          <p>Wir haben keine passenden Einträge in der Datenbank gefunden</p>
        </div>
	  </div>

<?php  }	





}
else
{
//Keine Eingabe über das Suchfeld
echo "<p>Benutzen Sie das Suchfeld um nach Inseraten zu suchen</p>";
	
	
}

?>
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



