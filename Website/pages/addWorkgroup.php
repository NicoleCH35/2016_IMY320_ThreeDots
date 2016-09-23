<?php
	if(session_status()==PHP_SESSION_NONE)
	{
		session_start();
	}
	include 'dbconfig.php';

	$group = $_POST["groupType"];

	echo $group;
	$sql2 = $conn->prepare("INSERT INTO workgrouptypes(workgroup) VALUES(?)");
	$sql->bind_param("s", $group);
	$result=$sql->execute();
	//$result2 = mysqli_query($conn, $sql2);


?>