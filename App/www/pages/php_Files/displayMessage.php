<?php
	session_start();

	include "../dbconfig.php";
	$sql = "SELECT * FROM notifications ORDER BY dateSent DESC";
	$result = $conn->query($sql);

	if(mysqli_num_rows($result) > 0) //the email is in database
	{
		while($row = $result->fetch_assoc())
		{
			$subject = $row['subject'];
			$message = $row['notification'];
			$datePosted = $row['dateSent'];

			echo"<div><article class='post'><header><div class='title'><h3>$subject</h3></div><div class='meta'>$datePosted</div></header><p>$message</p></article></div>";
		}
	}
	else
	{
		echo"<h2>No Messages to Display.</h2>";
	}

?>