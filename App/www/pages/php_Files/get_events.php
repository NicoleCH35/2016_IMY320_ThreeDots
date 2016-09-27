<?php

	include "../dbconfig.php";
	
	$sql = "SELECT * FROM events ORDER BY id DESC"; //finds stories
	$test = $conn->query($sql);
	$result = '';
	
	while($row = $test->fetch_assoc())
	{
		$eventID = $row['id'];
		$eventName = $row['eventName'];
		$location = $row['location'];
		$desc = $row['description'];
		$startDate = $row['startDateTime'];
		$endDate = $row['endDateTime'];
		$image = $row['photo'];
		$postedBy = $row['postedBy'];

		$sql = "SELECT * FROM members WHERE id = '" . $postedBy . "'"; //finding the user
		$test2 = $conn->query($sql);
		while($row2 = $test2->fetch_assoc())
		{
			$userImage = $row2['image'];
			$userName = $row2['username'];
		}

		$result .= '<article class="mini-post">';
		$result .= '<header>';
		$result .= '<h3>' . $eventName . '</h3>';
		$result .= '<div class="published"><time  datetime="' . $startDate . '">' . $startDate . '</time> - <time  datetime="' . $endDate . '">' . $endDate . '</time></div>';
		$result .= '<a href="#" class="author"><img src="http://threedots.site88.net/' . $userImage . '" alt="' . $userName . '" /></a>';
		$result .= '</header>';
		$result .= '<a href="#" class="image"><img src="http://threedots.site88.net/' . $image . '" alt="' . $desc . '" /></a>';
		$result .= '</article>';
	}
	
	echo $result;
?>