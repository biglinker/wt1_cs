<?php
session_start();
session_destroy();

echo "<p>Sie wurden erfolgreich abgemeldet</p>";
echo "<p><a href='index.php'>Zur Hauptseite</a>";
echo "<meta http-equiv='refresh' content='0; url=main.php'>";


?>