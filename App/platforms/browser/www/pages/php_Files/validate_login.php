<?php

	//if(session_status()==PHP_SESSION_NONE)
	//{
		session_start();
	//}
	include "../dbconfig.php";

	$username = $_POST['username'];
	$password = $_POST['password'];

	//$password = hash("sha256", $password);


	$sql = "SELECT * FROM members WHERE username='$username' AND password ='$password'";
	$result = $conn->query($sql);

	if(mysqli_num_rows($result) > 0)
	{
		session_start();
		while($row = $result->fetch_assoc())
		{
			$id_v = $row["id"];
			$admin = $row["admin"];
		}

		$_SESSION['userId'] = $id_v;
		$_SESSION['sessionId'] = session_id();

		if($admin)
		{
			echo "admin";
		}
		else
		{
			echo "user";
		}
	}
	else
	{
		echo "error";
	}

	?>