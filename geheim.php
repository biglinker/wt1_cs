<?php
session_start();

include("session_mgmt.php");


IF( isset($_SESSION['B_id']) )
{
	echo "<p>Sie dürfen diese Seite betreten</p>";
	
	echo "<p>eingeloggt als User: " . $_SESSION['B_id'] . "</p>";
	
	
}
else
{
	echo "<p>Bitte zuerst einloggen</p>";
	
	echo "<p><a href='login.php'>Login-Seite</<a></p>";
	
	
	
}

?>