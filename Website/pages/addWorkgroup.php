<?php
	if(session_status()==PHP_SESSION_NONE)
	{
		session_start();
	}
	include 'dbconfig.php';

	$group = $_POST["groupType"];

	echo $group;
	$sql2 = "INSERT INTO workgrouptypes(workgroup) VALUES('$group')";
	$result2 = mysqli_query($conn, $sql2);


?>