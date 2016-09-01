<?php
	if(session_status()==PHP_SESSION_NONE)
	{
		session_start();
	}
	include 'dbconfig.php';
	//include 'redirect.php';

	$pid = $_POST['pid'];

	$sql = "UPDATE stories SET numLikes=5 WHERE id= $pid";
	$result = mysqli_query($conn, $sql);
	//echo "in";
?>