<?php
	//if(session_status()==PHP_SESSION_NONE)
	//{
		session_start();
	//}
	//include 'redirect.php';
	$wg = $_POST["wgName"];
	$postID = $_SESSION['postid'];
	
	include 'dbconfig.php'; //connects to db
	
	$sql = prepare("SELECT * FROM workgrouptypes WHERE workgroup = ?"); 
	$sql->bind_param("s", $wg);
    $sql->execute();
    $test = $sql->get_result();
	while ($row = $test->fetch_assoc())
	{
		$wgID = $row["id"];
	}
	
	if ($_POST)
	{
		$sql2 = prepare("INSERT INTO eventworkgroups (wgID, eventID) VALUES (?,?)");
		$sql2->bind_param("ii", $wgID, $postID);
    	$sql2->execute();
	}
	
	$conn->close();
	
	echo "Done";
	//echo $_SESSION['postid'];

?>