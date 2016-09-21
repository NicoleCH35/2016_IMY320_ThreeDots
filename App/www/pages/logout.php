<?php
	if(session_status()==PHP_SESSION_NONE)
	{
		session_start();
	}
	session_destroy();
	//session_unset();
	unset($_SESSION['userId']);
	unset($_SESSION['sessionId']);
	unset($_SESSION['postid']);

	header('Location: ../index.php');
?>