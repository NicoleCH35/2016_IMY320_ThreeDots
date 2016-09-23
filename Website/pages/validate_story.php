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
	
	$user = $_SESSION['userId'];
	//$user = 1;
	
	if ($_POST)
	{
		
		$sql = prepare("INSERT INTO stories (title, description, story, date, postedBy, numLikes) VALUES (?,?,?,?,?, '0')");
		//echo $sql;
		$sql->bind_param("ssssi", $title, $desc, $story, $date, $user);
        $sql->execute();
		
		$sql = prepare("SELECT * FROM stories WHERE title = ? AND description = ?"); 
		$sql->bind_param("ss", $title, $desc);
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