<?php
	if(session_status()==PHP_SESSION_NONE)
	{
		session_start();
	}
	//include 'redirect.php';
	
	$title = $_POST["titleStory"];
	$desc = $_POST["descStory"];
	$story = $_POST["storyText"];
	$date = date("Y-m-d");
	//$image = $_POST["postImage"];
	
	include 'dbconfig.php'; //connects to db
	
	//~ $sql = "SELECT * FROM members WHERE id = '".$_SESSION['userid']."'"
	//~ $result = $conn->query($sql);
	//~ while ($row = $test->fetch_assoc())
	//~ {
		//~ $user = $row["id"];
	//~ }
	
	$user = $_SESSION['userid'];
	//$user = 1;
	
	if ($_POST)
	{
		
		$sql = "INSERT INTO stories (title, description, story, date, postedBy, numLikes) VALUES ('".$title."', '".$desc."', '".$story."', '".$date."', '".$user."', '0')";
		//echo $sql;
		$result = $conn->query($sql);
		
		$sql = "SELECT * FROM stories WHERE title = '".$title."' AND description = '".$desc."'"; 
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