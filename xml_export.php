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


			<?php
//Create file name to save
$filename = "export_xml_".date("Y-m-d_H-i",time()).".xml";


$mysql = new Mysqli('localhost', 'agricola', 'IBZ@Agri@2017@Web', 'Agricola');
if ($mysql->connect_errno) {
    throw new Exception(sprintf("Mysqli: (%d): %s", $mysql->connect_errno, $mysql->connect_error));
}

//Extract data to export to XML
$sqlQuery = 'SELECT * FROM Nachfrage';
if (!$result = $mysql->query($sqlQuery)) {
    throw new Exception(sprintf('Mysqli: (%d): %s', $mysql->errno, $mysql->error));
}

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

        $col = $dom->createElement('column', $value);
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
// save XML as string or file 
$test1 = $dom->saveXML(); // put string in test1
$dom->save($filename); // save as file
$dom->save('xml/'.$filename); 

//shortlink
$link="http://localhost/agricola/xml/$filename";

//Output with Link
echo "<br> <h2> Die Daten wurden als XML nach <br><a href=\"$link\"> $filename </a> <br> exportiert</h2>";
echo "<a href=\"$link\" type=\"button\" role=\"button\" class=\"btn btn-success\">Download XML File</a> "



?>

					
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