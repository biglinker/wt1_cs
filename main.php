 <!DOCTYPE html>
<html lang="de">
<?php 
require_once "session_mgmt.php";
include("db_connection.php");

//Only for development
ini_set("display_errors", 1);
error_reporting(E_ALL & ~E_NOTICE);




	$nr = $_GET['nr'];



	$sql = "SELECT * FROM Nachfrage WHERE N_id = 1 LIMIT 1";
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
}


mysqli_close($conn);
?>
?>
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
 
	<!-- Page Header -->
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h1>Willkommen bei Agricola-Trade!</h1>
				<h2>Der B2B Plattform für den Schweizer Agrar-Bereich</h2>
				
				<!-- Horizontale Linie -->
				<hr style="border:#000000 1px; background-color:#000000;height:1px;width:75%;" align="left">
			</div>
		</div>
	</div>
  
 <!-- Page Content -->
    <div class="container">
      <!-- Example row of columns -->
      <div class="row">
        <div class="col-md-4">
          <h2><?php echo $titel;  ?></h2>
          
				<p><?php echo $text;  ?></p>
				<p><strong>gewünschte Qualität:</strong> <?php echo $quali;  ?></p>
				<p><strong>gewünschte Menge: </strong> <?php echo $menge . " " . $menge_einheit ?></p>
				<p><strong>Lieferzeitpunkt: </strong> <?php echo $datum_ablauf ?></p>
				<p>Inserat-Nr <?php echo $nr;  ?></p>
          <p><a class="btn btn-default" href="inserat.php?nr=1" role="button">View details &raquo;</a></p>
        </div>
        <div class="col-md-4">
          <h2>Top Inserat 2</h2>
          <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
          <p><a class="btn btn-default" href="inserat.php?nr=2" role="button">View details &raquo;</a></p>
       </div>
        <div class="col-md-4">
          <h2>Top Inserat 3</h2>
          <p>Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
          <p><a class="btn btn-default" href="inserat.php?nr=3" role="button">View details &raquo;</a></p>
        </div>
      </div>
	  
 	
	<div class="row">
        <div class="col-md-6">
          <h2>1</h2>
          <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
          <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>
        </div>
		
        <div class="col-md-6">
          <h2>2</h2>
          <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
          <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>
        </div>		
	</div>
	
	<!-- Brauchts möglicherweise gar nicht.
	
	    <div class="row">
        <div class="col-md-6">
          <h2>Registrieren/Mitmachen</h2>
          <p>Anmeldebereich für Neue Mitglieder </p>
          <p><a class="btn btn-default" href="register.php" role="button">Registrieren &raquo;</a></p>
        </div>
		
        <div class="col-md-6">
          <h2>Login</h2>
          <p>Hier gehts zum Login. Logge dich zuerst ein bevor du ein neues Insereat erfasst </p>
          <p><a class="btn btn-default" href="login.php" role="button">Login &raquo;</a></p>
        </div> 
	-->		
	
	<br>
	<br>
	</div>
	
   </div>
 
 
 
 
 
 
 <!--
 <img src="src/png/logo.png" alt="Agricola-Trade" class="logo"></img>
	
	<form action="?login=1" method="post" class="form-signin">
	<h2 class="form-signin-heading"> Login </h2><br>
	E-Mail:<br>
	<input type="email" size="40" maxlength="250" name="email" class="form-control"><br><br>
 
	Dein Passwort:<br>
	<input type="password" size="40"  maxlength="250" name="passwort" class="form-control"><br>
 
	<input type="submit" value="Login" class="btn btn-lg btn-primary btn-block">
</form> 

-->

<footer>
      <div class="container">
        <p class="text-muted">Place sticky footer content here.</p>
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