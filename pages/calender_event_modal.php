<?php
	//The Modal
	//<div id="myModal" class="modal">
	
	include 'dbconfig.php';
	
	$y = $_POST['year'];
	$m = date('m', strtotime($_POST["month"]));
	$d = $_POST['day'];
	
	$result = '';
	
	$sql = "SELECT * FROM events WHERE startDateTime LIKE '$y-$m-$d %'";
	$test = $conn->query($sql);
	
	if ($test->num_rows > 0)
	{
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
				$user = $row2['username'];
				$userImage = $row2['image'];
			}
			
			$result .= '<div class="modal-content">';
				$result .= '<span class="close">x</span>';
				$result .= '<article class="mini-post">';
					$result .= '<header>';
						$result .= '<h3><a href="#">' . $eventName . '</a></h3>';
						$result .= '<div class="published"><time  datetime="' . $startDate . '">' . $startDate . '</time> - <time  datetime="' . $endDate . '">' . $endDate . '</time></div>';
						$result .= '<a href="#" class="author"><img src="' . $userImage . '" alt="" /></a>';
						$result .= '<p>' . $desc . '</p>';
					$result .= '</header>';
					$result .= '<img src="../images/Events/' . $image . '" alt="" width="351" height="176" />';
				$result .= '</article>';
			$result .= '</div>';
			
			echo $result;
		}
	}
	else
	{
		echo 'No';
	}
?>