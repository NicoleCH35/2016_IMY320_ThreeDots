<?php
	if(session_status()==PHP_SESSION_NONE)
	{
		session_start();
	}
	include 'dbconfig.php';
	
	$subject = $_POST["subject"];
	$body = $_POST["body"];
	$event = $_POST["eventID"];
	$group = $_POST["groupID"];
	$userIDS = array();
	$headers = 'From: keziakoko2@gmail.com' . "\r\n" .
		'Reply-To: keziakoko2@gmail.com' . "\r\n" .
		'X-Mailer: PHP/' . phpversion();


	$sql = $conn->prepare("SELECT id FROM eventworkgroups WHERE wgID=? AND eventID = ?");
	$sql->bind_param("ii", $group, $event);
    $sql->execute();
    $result = $sql->get_result();


	if(mysqli_num_rows($result) > 0)//if in the table update
	{
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
			// $result = mysqli_query($conn, $sql);

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
	}


//	$sql = "SELECT userID FROM workgroups WHERE eventID = $event AND typeID = $group";
//	$result = mysqli_query($conn, $sql);
//	$i=0;
//	while($row = $result->fetch_assoc())
//	{
//		$userIDS[$i] = $row["userID"];
//		$i++;
//	}
//
//	for($j=0; $j<$i;$j++)
//	{
//		$sql = "SELECT email FROM members WHERE id = $userIDS[$j]";
//		$result = mysqli_query($conn, $sql);
//
//		while($row = $result->fetch_assoc())
//		{
//			if(mail($row["email"], $subject, $body, $headers))
//			{
//				echo "sent";
//			}
//			else
//			{
//				echo "failed";
//			}
//
//		}
//	}

?>