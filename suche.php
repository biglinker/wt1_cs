<?php 
include("session_mgmt.php");
include("db_connection.php");

	//Code während Entwicklung
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
	
		<div class="row">
			<div class="col-md-12">
				<h1>Inserate Suchen</h1>
				<h2>Such-Parameter</h2>
<form class="form-horizontal" action="suche.php" method="get">

					<div class="form-group">					
						<label class="control-label col-sm-2" for="search">Suchen nach</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" size="40" maxlength="250" name="search" value="<?php if(isset($_GET['search'])){ echo $_GET['search'];}?>" placeholder="Suchbegriffe eingeben">
						</div>
					</div>
	
					<div class="form-group">	
						    <div class="col-sm-offset-2 col-sm-10">
								<button type="submit" class="btn btn-default">Suchen</button>
							</div>
					</div>	
				</form> 
				
			</div>
		</div>
		

	
	</div>	
 
 
	<!-- Search Content -->
	<div class="container">
		<div class="row">
			<div class="col-md-12">
    				<h2>Ergebnisse</h2>
				</div>
			</div>
 
 
 <?php
	if(isset($_GET['search'])){
		$search = $_GET['search'];
	
	
	//Case
	
	
	
	
	
	//query  the database table
	$sql="SELECT * FROM Nachfrage WHERE N_gueltig_bis > NOW() AND N_geloescht = 0 AND N_titel LIKE '%" . $search ."%' OR N_beschreibung LIKE '" . $search ."'  ORDER BY `Nachfrage`.`N_erstellt` DESC";
  
	//run  the query against the mysql query function
	$result=mysqli_query($conn, $sql);
  
	IF( mysqli_num_rows($result) < 2 ){
	    //Ersetze im Search-Query die Leerzeichen durch % um mehr Treffer zu erzielen
		$search = str_replace(" ","%", $search);
		$sql="SELECT * FROM Nachfrage WHERE N_gueltig_bis > NOW() AND N_geloescht = 0 AND N_titel LIKE '%" . $search ."%' OR N_beschreibung LIKE '" . $search ."'  ORDER BY `Nachfrage`.`N_erstellt` DESC";
 
		$result=mysqli_query($conn, $sql);
	}
  
 
 if ($counts = mysqli_num_rows($result) > 0) {
	// output data of each row
    while($row = mysqli_fetch_array($result)) {

	$titel = $row['N_titel'];
	$text =  substr($row['N_beschreibung'], 0,200);
	$id = $row['N_id'];
	$datum_erstellt = date("j.n.Y", strtotime($row['N_erstellt']));
	
 ?>
 
 

					
      <div class="row">
        <div class="col-md-12">
          <h3><?php echo $titel; ?></h3>
          <p> <?php echo $text; ?></p>
		  <p><small><strong>Inseriert am: </strong> <?php echo $datum_erstellt; ?></small></p>
          <p><a class="btn btn-default" href="inserat.php?nr=<?php echo $id; ?>" role="button">Inserat anzeigen &raquo;</a></p>
        </div>
	  </div>
	 
	  
<?php
		}
	} else {
?>

      <div class="row">
        <div class="col-md-12">
          <h3>Leider nichts gefunden</h3>
          <p>Wir haben keine passenden Einträge in der Datenbank gefunden.</p>
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

	<!-- Footer -->
	<?php include "footer.php"; ?>

    <!-- Bootstrap core JavaScript -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="res/bootstrap/js/bootstrap.min.js"></script>
    <script src="res/bootstrap/js/docs.min.js"></script>
</body>
</html>



