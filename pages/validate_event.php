<?php
	
	session_start();
	
	$name = $_POST["eventName"];
	$desc = $_POST["descEvent"];
	$location= $_POST["locationEvent"];
	$startD = $_POST["startDEvent"];
	$startT = $_POST["startTEvent"];
	$endD = $_POST["endDEvent"];
	$endT = $_POST["endTEvent"];
	$date = date("Y-m-d");
	//$image = $_POST["postImage"];
	$startDT = $startD + $startT;
	$endDT = $endD + $endT;
	
	include 'dbconfig.php'; //connects to db
	
	//~ $sql = "SELECT * FROM members WHERE id = '".$_SESSION['userid']."'"
	//~ $result = $conn->query($sql);
	//~ while ($row = $test->fetch_assoc())
	//~ {
		//~ $user = $row["id"];
	//~ }
	
	//$user = $_SESSION['userid'];
	$user = 1;
	
	if ($_POST)
	{
		
		$sql = "INSERT INTO events (eventName, location, description, startDateTime, endDateTime, postedBy) VALUES ('".$name."', '".$location."', '".$desc."', '".$startDT."', '".$endDT."', '0')";
		//echo $sql;
		$result = $conn->query($sql);
		
		$sql = "SELECT * FROM events WHERE eventName = '".$title."' AND description = '".$desc."'"; 
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