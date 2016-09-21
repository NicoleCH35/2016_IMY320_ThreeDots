<?php

	include "dbconfig.php";
	$userID= $_SESSION['userId'];
	$sql = "SELECT admin from members where id = $userID";
	$results = mysqli_query($conn,$sql);
	
	$row=$results->fetch_assoc();
	$admin = $row['admin'];
	
	if(isset($_SESSION['sessionId']) && !$admin)//try access admin page and  logged in and  not admin page when logged in
	{
		header('Location: ../index.php');
	}
	
	
?>