<?php
	//if(session_status()==PHP_SESSION_NONE)
	//{
		session_start();
	//}
	//include 'redirect.php';
	$name = $_POST["eventName"];
	$desc = $_POST["descEvent"];
	$location= $_POST["locationEvent"];
	$startD = $_POST["startDEvent"];
	$startT = $_POST["startTEvent"];
	$endD = $_POST["endDEvent"];
	$endT = $_POST["endTEvent"];
	$date = date("Y-m-d");
	//$image = $_POST["postImage"];
	
	$startDTs = $startD . ' ' . $startT;
	$startDTt = strtotime($startDTs);
	$startDT = date('Y-m-d H:i:s', $startDTt);
	
	//echo $startDT;
	
	$endDTs = $endD . ' ' . $endT;
	$endDTt = strtotime($endDTs);
	$endDT = date('Y-m-d H:i:s', $endDTt);
	
	include 'dbconfig.php'; //connects to db
	
	//~ $sql = "SELECT * FROM members WHERE id = '".$_SESSION['userid']."'"
	//~ $result = $conn->query($sql);
	//~ while ($row = $test->fetch_assoc())
	//~ {
		//~ $user = $row["id"];
	//~ }
	
	$user = $_SESSION['userId'];
	//$user = 1;
	
	if ($_POST)
	{
		
		$sql = $conn->prepare("INSERT INTO events (eventName, location, description, startDateTime, endDateTime, postedBy) VALUES (?,?,?,?,?,?)");
		$sql->bind_param("sssssi", $name, $location, $desc, $startDT, $endDT, $user);
        $sql->execute();
		
		$sql = $conn->prepare("SELECT * FROM events WHERE eventName = ? AND description = ?"); 
		$sql->bind_param("ss", $name, $desc);
        $sql->execute();
        $test = $sql->get_result();
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