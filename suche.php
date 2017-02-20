<?php 
include("session_mgmt.php");
//include("db_connection.php");




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
	
	
<?php
  if(isset($_POST['submit'])){
// if(isset($_GET['go'])){
 // if(preg_match("/^[  a-zA-Z]+/", $_POST['name'])){
  $name=$_POST['name'];
  
  
  //connect  to the database 
	$db=mysql_connect  ("localhost", "root",  "") or die ('I cannot connect to the database  because: ' . mysql_error());  
	//-select  the database to use 
	$mydb=mysql_select_db("agricola"); 
  
 // include("db_connection.php");
  
  //-query  the database table
  $sql="SELECT N_titel, N_bescheibung, N_qualitaet, N_menge, N_id FROM Nachfrage  WHERE N_titel LIKE '%" . $name ."%'";
  //-run  the query against the mysql query function
  $result=mysql_query($sql);
  //-create  while loop and loop through result set
	  while($row=mysql_fetch_array($result)){
				  $titel  			=$row['N_titel'];
				  $beschreibung		=$row['N_bescheibung'];
				  $qualitaet		=$row['N_qualitaet'];
				  $menge			=$row['N_menge'];
				  $id				=$row['N_id'];
		  //-display the result of the array
		  echo "<ul>\n";
		  echo "<li>" . "<a  href=\"search.php?N_id=$id\">"   .$titel . " " . $beschreibung .  " " . $qualitaet .  " " . $menge .  "</a></li>\n";
		  echo "</ul>";
	  }
  //}
  //else{
		echo  "<p>Please enter a search query</p>";
  //}
  //}
  }
?>


      <div class="container">
       
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



