<?php
	//if(session_status()==PHP_SESSION_NONE)
	//{
		session_start();
	//}
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
		
		$sql = $conn->prepare("INSERT INTO news (title, news, date, link, postedBy) VALUES (?, ?, ?, ?, ?)");
		$sql->bind_param("ssssi", $title, $news,$date,$link, $user);
        $sql->execute();
		
		$sql = $conn->prepare("SELECT * FROM news WHERE title = ? AND news = ?"); 
		$sql->bind_param("ss", $title, $news);
        $sql->execute();
        $test = $sql->get_result();
		while ($row = $test->fetch_assoc())
		{
			$postId = $row["id"];
		}
		$_SESSION['postid'] = $postId;
		$sql->free_result();
	}
	//return false;
	
	$conn->close();
	
	//echo 'title= ' . $title;
	echo $_SESSION['postid'];

?>