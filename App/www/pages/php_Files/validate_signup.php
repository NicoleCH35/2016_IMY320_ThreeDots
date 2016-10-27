<?php

//	if(session_status()==PHP_SESSION_NONE)
//	{
		session_start();
	//}

	include '../dbconfig.php';

	$user = $_POST['username'];
	$email = $_POST['email'];
	$pass = $_POST['password'];
	//$pass = hash("sha256", $pass);


	$sql = "SELECT * FROM members WHERE email='$email''";
	$result = $conn->query($sql);

	if(mysqli_num_rows($result) > 0) //the email is in database
	{
		echo "emailF";
	}
	else
	{
		$sql2 = "SELECT * FROM members WHERE username='$user'";
		$result2 = $conn->query($sql2);

		if(mysqli_num_rows($result2) > 0) //the email is in database
		{
			echo "usernameF";
		}
		else
		{
			// session_start();
			$sql = "INSERT INTO members(username ,email, password,image) VALUES ('$user','$email','$pass','../images/profiles/unknown.png')";

			$sql = "SELECT * FROM members WHERE email='$email'";
			$result = $conn->query($sql);

			while($row = $result->fetch_assoc())
			{
				$id_v = $row["ID"];
			}


			$_SESSION['userId'] = $id_v;
			$_SESSION['sessionId'] = session_id();

			echo "success";
		}
	}

	mysqli_close($conn);
?>