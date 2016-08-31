<?php
	
	$servername = "localhost";
	$username = "root"; //root	
	$passwordDB = ""; //blank	
	$db = "SANPO"; //point members
	
	$conn = new mysqli($servername, $username, $passwordDB, $db);
	
	if ($conn->connect_error)
	{
		die("Connection failed: " . $conn->connect_error);
	}
	
?>