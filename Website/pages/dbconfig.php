<?php
	//if(session_status()==PHP_SESSION_NONE)
	//{
		session_start();
	//}
	
	$servername = "localhost";
	$username = "root"; //root	
	$passwordDB = ""; //blank	
	$db = "sanpo"; //point members

	$conn = new mysqli($servername, $username, $passwordDB, $db);

	if($conn->connect_error)
	{
		die("Connection failed: " . $conn->connect_error);
	}

?>