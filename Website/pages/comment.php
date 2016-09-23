<?php
	if(session_status()==PHP_SESSION_NONE)
	{
		session_start();
	}

	error_reporting(E_ALL);
	ini_set('error_reporting', E_ALL);

	include 'dbconfig.php';
	//include 'redirect.php';

	$pid = $_POST['pid'];
	$uid = $_POST['uid'];
	$comment = $_POST['cid'];

	//~ $sql = "UPDATE stories SET numLikes = '5' WHERE id = '".$pid."' ";
	//~ $result = mysqli_query($conn, $sql);
	$cDate = date("Y-m-d H:i:s",time());
	$sql = $conn->prepare("INSERT INTO comments(storyID, comment, postedBy, datePosted) VALUES(?,?,?,?)");
	$sql->bind_param("isss", $pid,$comment,$uid,$cDate);
	$result=$sql->execute();
	// $result = $conn->query($sql);

	//echo $cDate;
	$conn->close();

	//echo "postID = $pid";
?>