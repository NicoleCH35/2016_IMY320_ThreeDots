<?php
	if(session_status()==PHP_SESSION_NONE)
	{
		session_start();
	}
	//include 'redirect.php';
	$target_dir_saving = "../images/Events/";
	$target_file_saving = $target_dir_saving . basename($_FILES["image"]["name"]); //for saving
	
	$target_dir = "./images/Events/";
	$target_file = $target_dir . basename($_FILES["image"]["name"]); //for displaying
	
	$uploadOk = 1;
	$imageFileType = pathinfo($target_file_saving,PATHINFO_EXTENSION);
	
	move_uploaded_file($_FILES["image"]["tmp_name"], $target_file_saving);
	
	include 'dbconfig.php'; //connects to db
	
	$postId = $_SESSION['postid'];
	$sql = "UPDATE events SET photo = '".$target_file."' WHERE id = '".$postId."'";
	//echo $sql;
	$result = $conn->query($sql);
	//return false;
	
	$conn->close();
	
	
	echo "$postId";
?>