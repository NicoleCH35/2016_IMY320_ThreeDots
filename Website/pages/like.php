<?php
	//if(session_status()==PHP_SESSION_NONE)
	//{
		session_start();
	//}
	
	error_reporting(E_ALL);
	ini_set('error_reporting', E_ALL);
	
	include 'dbconfig.php';
	//include 'redirect.php';

	$pid = $_POST['pid'];

	//~ $sql = "UPDATE stories SET numLikes = '5' WHERE id = '".$pid."' ";
	//~ $result = mysqli_query($conn, $sql);
	
	$sql = $conn->prepare("UPDATE stories SET numLikes = numlikes+1 WHERE id = ?");
	//echo $sql;
	$sql->bind_param("i", $pid);
    $sql->execute();

	
	$conn->close();
	
	//echo "postID = $pid";
?>