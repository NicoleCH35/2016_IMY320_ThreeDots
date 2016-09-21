<?php

	if(isset($_SESSION['sessionId']))//try access login or signup page when you are already logged in
	{
		header('Location: ../index.php');
	}
	
	
?>