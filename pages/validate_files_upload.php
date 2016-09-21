<?php
	if(session_status()==PHP_SESSION_NONE)
	{
		session_start();
	}
	//include 'redirect.php';
	$target_dir_saving = "../images/OfficialUploads/";
	$target_file_saving = $target_dir_saving . basename($_FILES["file"]["name"]); //for saving
	
	$target_dir = "./images/OfficialUploads/";
	$target_file = $target_dir . basename($_FILES["file"]["name"]); //for displaying
	
	$uploadOk = 1;
	$imageFileType = pathinfo($target_file_saving,PATHINFO_EXTENSION);
	
	move_uploaded_file($_FILES["file"]["tmp_name"], $target_file_saving);
	
	include 'dbconfig.php'; //connects to db
	
	$postId = $_SESSION['postid'];
	$sql = "UPDATE officialfiles SET filePath = '".$target_file."' WHERE id = '".$postId."'";
	//echo $sql;
	$result = $conn->query($sql);
	//return false;
	
	$conn->close();
	
	
	echo "$postId";
?>