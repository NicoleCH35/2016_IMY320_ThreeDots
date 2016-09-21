<?php
	if(session_status()==PHP_SESSION_NONE)
	{
		session_start();
	}
	include 'dbconfig.php';

	$subject = $_POST["subject"];
	$body = $_POST["body"];
	$user = $_POST["userID"];
	$headers = 'From: keziakoko2@gmail.com' . "\r\n" .
		'Reply-To: keziakoko2@gmail.com' . "\r\n" .
		'X-Mailer: PHP/' . phpversion();

	$sql = "SELECT email FROM members WHERE id = $user";
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

?>