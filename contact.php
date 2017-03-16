<?php 
include("session_mgmt.php");

require_once "function_sendmail.php";

//Parameter
$bearbeiter = "ps@582.ch";  //Diese Mail-Adresse ist verwantwortlich für die Bearbeitung der Anfragen via Kontaktformular

IF( !empty($_POST) ){
	//Variabeln umwandeln
	$C_email = trim(htmlentities($_POST["C_email"], ENT_QUOTES));
	$C_name = trim(htmlentities($_POST["C_name"], ENT_QUOTES));
	$C_nachricht = nl2br(htmlentities($_POST["C_nachricht"], ENT_QUOTES));
	
	$datum = date("d.m.Y H:i:s",time());
	
	$betreff = "Kontaktformular Agricola";
	$from = "From: Webseite agricola <webmaster@582.ch>\n";
	$from .= "Reply-To: $C_email\n";
	$from .= "Content-Type: text/html\n";
	$text = "$C_nachricht";
 
	$return = mail($bearbeiter, $betreff, $text, $from);
				
	IF( $return == true ){
		$successMessage = "Mail wurde verschickt!";
	}
	else {
		$errorMessage = "Es gab Probleme!";
	}
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
				<h1>Kontakt</h1>
				<p>Nehmen Sie mit uns über das untenstehende Kontaktformular Kontakt auf.</p>
			</div>
		</div>
	</div>
 
   <!-- Page Content -->
    <div class="container">
		<div class="row">
			<div class="col-md-12">
				<form class="form-horizontal" action="contact.php" method="post">

					<div class="form-group">					
						<label class="control-label col-sm-2" for="C_email">E-Mail</label>
						<div class="col-sm-10">
							<input type="email" class="form-control" size="40" maxlength="250" name="C_email" placeholder="E-Mail">
						</div>
					</div>

					<div class="form-group">						
						<label class="control-label col-sm-2" for="C_name">Firma / Name</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" size="40" maxlength="250" name="C_name" placeholder="Name">						
						</div>
					</div>
					
					<div class="form-group">						
						<label class="control-label col-sm-2" for="C_nachricht">Nachricht</label>
						<div class="col-sm-10">
							<textarea class="form-control" rows="5" id="C_nachricht" name="C_nachricht"></textarea>					
						</div>
					</div>					
					
					<div class="form-group">	
						    <div class="col-sm-offset-2 col-sm-10">
								<button type="submit" class="btn btn-default">Abschicken</button>
							</div>
					</div>	
				</form> 
			</div>
		</div>
	</div>
   
	<!-- Footer -->
	<?php include "footer.php" ?>


    <!-- Bootstrap core JavaScript -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="res/bootstrap/js/bootstrap.min.js"></script>
    <script src="res/bootstrap/js/docs.min.js"></script>
</body>
</html>