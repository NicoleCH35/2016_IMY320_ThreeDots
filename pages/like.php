<?php
	include 'dbconfig.php';


	$pid = $_POST['pid'];

	$sql = "UPDATE stories SET numLikes=5 WHERE id= $pid";
	$result = mysqli_query($conn, $sql);
	echo "in";
?>