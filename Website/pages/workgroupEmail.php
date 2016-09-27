<?php
	//if(session_status()==PHP_SESSION_NONE)
	//{
		session_start();
	//}
	include 'dbconfig.php';

	$subject = $_POST["subject"];
	$body = $_POST["body"];
	$group = $_POST["groupID"];
	$userIDS = array();
	$headers = 'From: keziakoko2@gmail.com' . "\r\n" .
		'Reply-To: keziakoko2@gmail.com' . "\r\n" .
		'X-Mailer: PHP/' . phpversion();

	$sql = $conn->prepare("SELECT userID FROM workgroups WHERE typeID = ?");
	$sql->bind_param("i", $group);
    $sql->execute();
    $result = $sql->get_result();
	$i=0;
	while($row = $result->fetch_assoc())
	{
		$userIDS[$i] = $row["userID"];
		$i++;
	}

	for($j=0; $j<$i;$j++)
	{
		$sql = $conn->prepare("SELECT email FROM members WHERE id = ?");
		$sql->bind_param("i", $userIDS[$j]);
        $sql->execute();
        $result = $sql->get_result();

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