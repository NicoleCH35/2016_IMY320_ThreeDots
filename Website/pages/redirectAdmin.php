<?php

	include "dbconfig.php";
	$userID= $_SESSION['userId'];
	$sql = $conn->prepare("SELECT admin from members where id = ?");
	$sql->bind_param("i", $userID);
    $sql->execute();
    $results = $sql->get_result();
	
	$row=$results->fetch_assoc();
	$admin = $row['admin'];
	
	if(isset($_SESSION['sessionId']) && !$admin)//try access admin page and  logged in and  not admin page when logged in
	{
		header('Location: ../index.php');
	}
	
	
?>