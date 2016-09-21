<?php
	if(session_status()==PHP_SESSION_NONE)
	{
		session_start();
	}
	include 'dbconfig.php';

	$subject = $_POST["subject"];
	$body = $_POST["body"];
	$group = $_POST["groupID"];
	$userIDS = array();
	$headers = 'From: keziakoko2@gmail.com' . "\r\n" .
		'Reply-To: keziakoko2@gmail.com' . "\r\n" .
		'X-Mailer: PHP/' . phpversion();

	$sql = "SELECT userID FROM workgroups WHERE typeID = $group";
	$result = mysqli_query($conn, $sql);
	$i=0;
	while($row = $result->fetch_assoc())
	{
		$userIDS[$i] = $row["userID"];
		$i++;
	}

	for($j=0; $j<$i;$j++)
	{
		$sql = "SELECT email FROM members WHERE id = $userIDS[$j]";
		$result = mysqli_query($conn, $sql);

		while($row = $result->fetch_assoc())
		{
			if(mail($row["email"], $subject, $body, $headers))
			{
				echo "sent";
			}
			else
			{
				echo "failed";
			}

		}
	}

?>