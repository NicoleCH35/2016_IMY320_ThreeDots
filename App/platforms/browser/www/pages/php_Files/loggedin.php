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
			echo'<li><a href="admin.html"><h3>Admin</h3><p>Broadcast an Announcement</p></a></li>';
		}
		
		echo'<li><a href="logout.html"><h3>Logout</h3></a></li>';
	}
	else
	{
		echo'<li><a href="login.html"><h3>Already a member?</h3><p>Login to view account</p></a></li>
			<li><a href="signup.html"><h3>Become a member</h3><p>Join us today in helping the people who need it most</p></a></li>';
	}
?>