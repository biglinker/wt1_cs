 <!DOCTYPE html>
<html lang="de">
<?php 
require_once "session_mgmt.php";
include("db_connection.php");

//Only for development
ini_set("display_errors", 1);
error_reporting(E_ALL & ~E_NOTICE);


	$nr = $_GET['nr'];


/*	$sql = "SELECT * FROM Nachfrage WHERE N_id = 1 LIMIT 1";
	//echo $sql;
	$result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($result) > 0) {
	echo "<p>Ausgabe der Datenbank Nachfrage</p>";
    // output data of each row
    while($row = mysqli_fetch_array($result)) {
		var_dump($row);
		
		$titel = $row['N_titel'];
		$text = $row['N_bescheibung'];
		$quali = $row['N_qualitaet'];
		$datum_erstellt = date("j.n.Y", strtotime($row['N_erstellt']));
		$datum_ablauf = date("j.n.Y",strtotime($row['N_gueltig_bis']));
		$menge = number_format($row['N_menge']);
		$menge_einheit = $row['N_menge_einheit'];
		
    }
} else {
    echo "<p>0 results in DB Nachfrage</p>";
}*/


//mysqli_close($conn);
?>
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
			<div class="col-md-3">
				<p><img src="src/png/logo.png" alt="Agricola-Trade" style="max-height:250px" class="img-responsive"></p>
				<br>
			</div>
			<div class="col-md-9">
				<h1>Willkommen bei Agricola-Trade!</h1>
				<h2>Der B2B Plattform für den Schweizer Agrar-Bereich</h2>
				<!-- Horizontale Linie -->
				<hr style="border:#333 1px; background-color:#333;height:1px;width:75%;" align="left">
				<p>Wir bringen Händler, Produzenten, Hersteller aus der Agro-Branche näher zusammen. Wir erweitern gleichzeitig für Produzenten die Anzahl Abnehmer, sowie für Abnehmer und Händler die Anzahl Lieferanten. Einfacher Kaufen und Verkaufen, B2B mit Agricola-Trade.</p>
			</div>

		</div>
	</div>
  
	<!-- Page Content -->
    <div class="container">
		<div class="row">
			<div class="col-md-12"><h3>Die neusten 3 Nachfragen</h3></div>				
		</div>
	
      <div class="row">
		

		
			<?php   
	//query  the database table
	$sql="SELECT * FROM Nachfrage WHERE 1 ORDER BY `Nachfrage`.`N_erstellt` DESC LIMIT 3";
  
	//run  the query against the mysql query function
	$result=mysqli_query($conn, $sql);
    
 
 if (mysqli_num_rows($result) > 0) {
	// output data of each row
    while($row = mysqli_fetch_array($result)) {

	$titel = $row['N_titel'];
	$text =  substr($row['N_beschreibung'], 0,200);
	$id = $row['N_id'];
	$datum_erstellt = date("j.n.Y", strtotime($row['N_erstellt']));
	
 ?>
 

        <div class="col-md-4">
          <h3><?php echo $titel; ?></h3>
          <p> <?php echo $text; ?></p>
		  <p><small><strong>Inseriert am: </strong> <?php echo $datum_erstellt; ?></small></p>
          <p><a class="btn btn-default" href="inserat.php?nr=<?php echo $id; ?>" role="button">Inserat anzeigen &raquo;</a></p>
        </div>
		
 <?php  }}  ?>	
        </div>
		
		<div class="row">
			<div class="col-md-12">
				<h3>3 Nachfragen ohne Angebote</h3>
			</div>
		</div>	

		<div class="row">		
		
		<?php   
	//query  the database table
  	//$sql = "SELECT *, (SELECT COUNT(Angebot.N_id) FROM Angebot WHERE Angebot.N_id = Nachfrage.N_id) AS AngebotCount FROM Nachfrage WHERE 'AngebotCount' = 0 ORDER BY `Nachfrage`.`N_erstellt` DESC LIMIT 3 ";
	//$sql = "SELECT Nachfrage.N_id, N_beschreibung, N_titel, N_erstellt FROM Nachfrage LEFT JOIN Angebot ON Nachfrage.N_id = Angebot.N_id WHERE Angebot.A_id IS NULL ORDER BY `Nachfrage`.`N_erstellt` DESC LIMIT 3";
	$sql = "SELECT Nachfrage.N_id, N_beschreibung, N_titel, N_erstellt FROM Nachfrage LEFT JOIN Angebot ON Nachfrage.N_id = Angebot.N_id WHERE Angebot.A_id IS NULL ORDER BY `Nachfrage`.`N_erstellt` DESC LIMIT 3";
	//run  the query against the mysql query function
	$result=mysqli_query($conn, $sql);
    
 
 if (mysqli_num_rows($result) > 0) {
	// output data of each row
    while($row = mysqli_fetch_array($result)) {
	//	var_dump($row);

	$titel = $row['N_titel'];
	$text =  substr($row['N_beschreibung'], 0,200);
	$id = $row['N_id'];
	$datum_erstellt = date("j.n.Y", strtotime($row['N_erstellt']));
	
 ?>	

        <div class="col-md-4">
          <h3><?php echo $titel; ?></h3>
          <p> <?php echo $text; ?></p>
		  <p><small><strong>Inseriert am: </strong> <?php echo $datum_erstellt; ?></small></p>
          <p><a class="btn btn-default" href="inserat.php?nr=<?php echo $id; ?>" role="button">Inserat anzeigen &raquo;</a></p>
        </div>
		
 <?php  }}  ?> 
	</div>
	
	
		<div class="row">
			<div class="col-md-12">
				<h3>3 zufällige Inserate</h3>
			</div>
		</div>	

		<div class="row">		
		
		<?php   
	//query  the database table
  	$sql = "SELECT * FROM Nachfrage WHERE 1 ORDER BY RAND() LIMIT 3 ";
	//run  the query against the mysql query function
	$result=mysqli_query($conn, $sql);
    
 
	if (mysqli_num_rows($result) > 0) {
	// output data of each row
    while($row = mysqli_fetch_array($result)) {

	$titel = $row['N_titel'];
	$text =  substr($row['N_beschreibung'], 0,200);
	$id = $row['N_id'];
	$datum_erstellt = date("j.n.Y", strtotime($row['N_erstellt']));
	
 ?>	

        <div class="col-md-4">
          <h3><?php echo $titel; ?></h3>
          <p> <?php echo $text; ?></p>
		  <p><small><strong>Inseriert am: </strong> <?php echo $datum_erstellt; ?></small></p>
          <p><a class="btn btn-default" href="inserat.php?nr=<?php echo $id; ?>" role="button">Inserat anzeigen &raquo;</a></p>
        </div>
		
 <?php  }}  ?> 
	</div>
	
		
		
		
		
		
	  
 	
		<div class="row">
				
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