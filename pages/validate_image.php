<?php

	session_start();
	$target_dir_saving = "../images/Stories/";
	$target_file_saving = $target_dir_saving . basename($_FILES["image"]["name"]); //for saving
	
	$target_dir = "./images/Stories/";
	$target_file = $target_dir . basename($_FILES["image"]["name"]); //for displaying
	
	$uploadOk = 1;
	$imageFileType = pathinfo($target_file_saving,PATHINFO_EXTENSION);
	
	move_uploaded_file($_FILES["image"]["tmp_name"], $target_file_saving);
	
	include 'dbconfig.php'; //connects to db
	
	$postId = $_SESSION['postid'];
	$sql = "UPDATE stories SET image = '".$target_file."' WHERE id = '".$postId."'";
	//echo $sql;
	$result = $conn->query($sql);
	//return false;
	
	$conn->close();
	
	
	echo "$postId";
?>