<?php
	if(session_status()==PHP_SESSION_NONE)
	{
		session_start();
	}
	include 'dbconfig.php';

	$user = $_POST["userID"];
	$group = $_POST["groupType"];
	$admin = $_POST["admin"];
        echo "<script>alert('booga');</script>";
	//echo "<script>alert($admin);</script>";

	if($group == "none")//just update admin
	{
		$sql = $conn->prepare("UPDATE members SET admin=$admin WHERE id=?");
		$sql->bind_param("i", $user);
        $res=$sql->execute();
		// $result = mysqli_query($conn, $sql);
	}
	else//update both
	{
		$sql = $conn->prepare("UPDATE members SET admin=$admin WHERE id=?");
		$sql->bind_param("i", $user);
        $res =$sql->execute();


		$sql = $conn->prepare("SELECT id FROM workgroups WHERE userID=?");
		$sql->bind_param("i", $user);
        $sql->execute();
        $result = $sql->get_result();

		if($result->num_rows > 0)//if in the table update
		{
			//echo "string";
			$sql2 = $conn->prepare("UPDATE workgroups SET typeID=? WHERE userID=?");
			$sql2->bind_param("ii", $group,$user);
        	$sql2->execute();
		}
		else//insert
		{
			$sql2 = $conn->prepare("INSERT INTO workgroups (typeID,userID) VALUES(?,?)");
			$sql2->bind_param("ii", $group,$user);
        	$sql2->execute();
		}


	}

?>