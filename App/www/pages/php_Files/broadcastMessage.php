<?php

	session_start();

	include "../dbconfig.php";

	$subj = $_POST['subject'];
	$message = $_POST['message'];

	$cDate = date("Y-m-d H:i:s",time());
	
	$sql = "INSERT INTO notifications(subject,notification,dateSent) VALUES('$subj','$message','$cDate')";
	$result = $conn->query($sql);

?>