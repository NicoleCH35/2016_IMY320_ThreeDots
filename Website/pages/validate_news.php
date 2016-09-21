<?php
	if(session_status()==PHP_SESSION_NONE)
	{
		session_start();
	}
	//include 'redirect.php';
	$title = $_POST["title"];
	$news = $_POST["news"];
	$date = date("Y-m-d H:i:s");
	$link= $_POST["link"];
	//$image = $_POST["postImage"];
	
	include 'dbconfig.php'; //connects to db
	
	$user = $_SESSION['userId'];
	//$user = 1;
	
	if ($_POST)
	{
		
		$sql = "INSERT INTO news (title, news, date, link, postedBy) VALUES ('".$title."', '".$news."', '".$date."', '".$link."', '".$user."')";
		$result = $conn->query($sql);
		
		$sql = "SELECT * FROM news WHERE title = '".$title."' AND news = '".$news."'"; 
		$test = $conn->query($sql);
		while ($row = $test->fetch_assoc())
		{
			$postId = $row["id"];
		}
		$_SESSION['postid'] = $postId;
	}
	//return false;
	
	$conn->close();
	
	//echo 'title= ' . $title;
	echo $_SESSION['postid'];

?>