<?php
	//if(session_status()==PHP_SESSION_NONE)
	//{
		session_start();
	//}
	include '../dbconfig.php';
	if(isset($_SESSION['sessionId']))
	{
		$uid=$_SESSION['userId'];
		$sql = "SELECT admin FROM members WHERE id=$uid";
		$result = $conn->query($sql);

		while($row = $result->fetch_assoc())
		{
			$admin = $row["admin"];
		}
		if($admin)
		{
			echo'<li><a href="admin.html">Admin</a></li>';
		}
		echo'<li><a href="messages.html">Messages</a></li>';
		echo'<li><a href="logout.html">Logout</a></li>';
	}
	else
	{
		echo'<li><a href="login.html">Login</a></li>
			<li><a href="signup.html">Become a Member</a></li>';
	}
?>