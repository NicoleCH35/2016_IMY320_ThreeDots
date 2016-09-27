<?php
	
	
	//if(session_status()==PHP_SESSION_NONE)
	//{
		session_start();
	//}
	
	if(!isset($_SESSION['sessionId']) || $_SESSION['sessionId'] != session_id())//try access any page when logged in
	{
		header('Location: ../index.php');
	}
	
	
?>