<?php
	if(session_status()==PHP_SESSION_NONE)
	{
		session_start();
	}
	//include 'redirect.php';
	$wg = $_POST["wgName"];
	$postID = $_SESSION['postid'];
	
	include 'dbconfig.php'; //connects to db
	
	$sql = "SELECT * FROM workgrouptypes WHERE workgroup = '".$wg."'"; 
	$test = $conn->query($sql);
	while ($row = $test->fetch_assoc())
	{
		$wgID = $row["id"];
	}
	
	if ($_POST)
	{
		$sql2 = "INSERT INTO eventworkgroups (wgID, eventID) VALUES ('".$wgID."', '".$postID."')";
		$result2= $conn->query($sql2);
	}
	
	$conn->close();
	
	echo "Done";
	//echo $_SESSION['postid'];

?>