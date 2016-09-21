<?php
	if(session_status()==PHP_SESSION_NONE)
	{
		session_start();
	}

	error_reporting(E_ALL);
	ini_set('error_reporting', E_ALL);

	include 'dbconfig.php';
	//include 'redirect.php';

	$commentID = $_POST['cid'];

	$sql = "DELETE FROM comments WHERE id = $commentID";
	$result = $conn->query($sql);


	$conn->close();
?>