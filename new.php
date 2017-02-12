﻿<?php 





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
      <!-- Example row of columns -->
      <div class="row">
        <div class="col-md-12">
			<h1>Produktsuche erfassen</h1>
				
				
				<form class="form-horizontal" action="?new=1" method="post">
				
				<br>
				<input type="text" class="form-control" size="40" maxlength="250" name="N_titel" placeholder="Titel:">
				<br>
				<div class="form-group"> 
				 <label for="N_bezeichnung">Bezeichnung:</label>
					<textarea class="form-control" rows="5" id="N_bezeichnung" name="N_bezeichnung">
					</textarea>
				</div>
				<br>
				<input type="text" class="form-control" size="40"  maxlength="250" name="N_qualitat" placeholder="Qualität:">
				<br>
				<input type="text" class="form-control" size="40" maxlength="250" name="N_menge" placeholder="Angebotene Einheiten:">
				<br>
				
				<br>
				<input type="text" class="form-control" size="40" maxlength="250" name="N_preis" placeholder="Preis pro Einheit in CHF:">
				<br>
				
				<div class="form-group">
				<label for="N_lieferzeitpunkt">Lieferdatum:</label>
				<input type="date" class="form-control" size="40" maxlength="250" id="N_lieferzeitpunkt" name="N_lieferzeitpunkt">
				</div>
				
				
				
				
				<input class="btn btn-default" type="submit" value="Erfassen">
			</form>
			<p>Benötigt werden mindestens die Felder, Titel, Bezeichnung, Preis, Lieferzeitpunkt, Menge, Qualität</p>
				
        </div>
      </div>
   </div>

	<footer>
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