<?php
	include ( "dbconfig.inc.php");
	$connection = @new mysqli($dbhost , $dbuser, $dbpassword , $dbname);

	if ($connection->connect_error) {
		die("Fatal user error: " . $connection->connect_error);
	}
	$connection->set_charset("utf8");
?>
