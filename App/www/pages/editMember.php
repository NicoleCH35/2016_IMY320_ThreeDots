<?php
	if(session_status()==PHP_SESSION_NONE)
	{
		session_start();
	}
	include 'dbconfig.php';

	$user = $_POST["userID"];
	$group = $_POST["groupType"];
	$admin = $_POST["admin"];

	if($group == "none")//just update admin
	{
		$sql = "UPDATE members SET admin=$admin WHERE id=$user";
		$result = mysqli_query($conn, $sql);
	}
	else//update both
	{
		$sql = "UPDATE members SET admin=$admin WHERE id=$user";
		$result = mysqli_query($conn, $sql);

		$sql = "SELECT id FROM workgroups WHERE userID=$user";
		$result = mysqli_query($conn, $sql);

		if(mysqli_num_rows($result) > 0)//if in the table update
		{
			$sql2 = "UPDATE workgroups SET typeID=$group WHERE userID=$user";
			$result2 = mysqli_query($conn, $sql2);
		}
		else//insert
		{
			$sql2 = "INSERT INTO workgroups (typeID,userID) VALUES($group,$user)";
			$result2 = mysqli_query($conn, $sql2);
		}


	}

?>