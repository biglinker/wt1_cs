<?php 
include("session_mgmt.php");
include("db_connection.php");

include("login_req.php");

	//Code während Entwicklung
	ini_set("display_errors", 1);
	error_reporting(E_ALL & ~E_NOTICE);

	//Parameter	
	$user = $_SESSION["B_id"];


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
				<h1>XML Export</h1>
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
				<h2>Optionen</h2>
		
 
 
 <?php
   
	//query  the database table
	$sql="SELECT * FROM Nachfrage JOIN Angebot ON Nachfrage.N_id = Angebot.N_id WHERE Nachfrage.B_id = '$user' ";
  
	//echo $sql;
	//run  the query against the mysql query function
	$result=mysqli_query($conn, $sql);

	//echo "<br>";
	//var_dump($result);
  
  
  
	//Create file name to save
	$filename = "export_" . $user . "_" . date("Ymd_Hi",time()) . "_" . mt_rand(10,99) . ".xml";
  
	//Create new document 
	$dom = new DOMDocument;
	$dom->preserveWhiteSpace = FALSE;

	//add table in document 
	$table = $dom->appendChild($dom->createElement('table'));

	//add row in document 
	foreach($result as $row) {

		$data = $dom->createElement('row');
		$table->appendChild($data);

		//add column in document 
		foreach($row as $name => $value) {
			$value_xml = html_entity_decode($value,ENT_QUOTES);	

			$col = $dom->createElement('column', $value_xml);

			$data->appendChild($col);
			$colattribute = $dom->createAttribute('name');
			// Value for the created attribute
			$colattribute->value = $name;
			$col->appendChild($colattribute);           
		}
	}

/*
** insert more nodes
*/

$dom->formatOutput = true; // set the formatOutput attribute of domDocument to true 
$dom->save('xml/'.$filename); 
// save XML as string or file 
//$test1 = $dom->saveXML(); // put string in test1
//$dom->save($filename); // save as file


//shortlink
$link="xml/$filename";

//Output with Link
echo "<br> ";


?>
	<p>Die Inserate und Angebote wurden als XML Daten exportiert</p>
	<p><a href="<?php echo $link; ?>">XML Daten ansehen</a></p>
	<p><a href="<?php echo $link; ?>" type="button" role="button" class="btn btn-success" download>Download XML File</a></p>			
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