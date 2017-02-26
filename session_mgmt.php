<?php
	session_start();
	/*
		Erstellt: 16.2.2017
		Geändert: 19.2.2017
		
		Beschreibung: Diese Datei ist verantwortlich für das Session Management auf der Seite und soll nach einer gewissen Zeit das Session
		Cookie wieder löschen.

	*/

	//Parameter
	$timeout = 60*45;   //45 Minuten   

	//Ansicht während Entwicklung
	//echo "<p>Session-Inhalt</p>";
	//var_dump($_SESSION);


	IF ( isset($_SESSION["time"]) )
	{
		
		//Timestamp abfragen
		//Wenn timestamp kleiner als 30-60 min, Timestamp anpassen, andernfalls Session löschen.
		IF(time() > ($_SESSION['time'] + $timeout) ) {
			//Session abmelden Timeout
			session_destroy();
			echo "<p>Session wurde gelöscht<p>";
			
		}
		else {
			//Session time verlängern
			$_SESSION['time'] = time();
			
		}
	}

?>