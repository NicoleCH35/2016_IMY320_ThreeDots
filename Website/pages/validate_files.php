<?php
	if(session_status()==PHP_SESSION_NONE)
	{
		session_start();
	}
	
	$type = $_POST["type"];
	$name = $_POST["name"];
	$date = date("Y-m-d");
	
	include 'dbconfig.php'; //connects to db
	
	//$user = $_SESSION['userId'];
	
	if ($_POST)
	{
		
		$sql = "INSERT INTO officialfiles (type, name, dateUploaded) VALUES ('".$type."', '".$name."', '".$date."')";
		//echo $sql;
		$result = $conn->query($sql);
		
		$sql = "SELECT * FROM officialfiles WHERE type = '".$type."' AND name = '".$name."' AND dateUploaded = '".$date."'"; 
		$test = $conn->query($sql);
		while ($row = $test->fetch_assoc())
		{
			$postId = $row["id"];
		}
		$_SESSION['postid'] = $postId;
	}
	//return false;
	
	$conn->close();
	
	
	echo $_SESSION['postid'];

?>