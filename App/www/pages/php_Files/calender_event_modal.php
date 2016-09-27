<?php
	//The Modal
	//<div id="myModal" class="modal">
	
	include '../dbconfig.php';
	
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
				$result .= '<span class="close">  x</span>';
				//$result .= '<article class="mini-post">';
					
					$result .= '<img src="http://threedots.site88.net/.' . $image . '" alt="" width="211" height="106" />';
					$result .= '<header>';
						$result .= '<h3>' . $eventName . '</h3>';
						$result .= '<div class="published"><time  datetime="' . $startDate . '">' . $startDate . '</time> - <time  datetime="' . $endDate . '">' . $endDate . '</time></div>';
						$result .= '<a href="#" class="author"><img src="http://threedots.site88.net/.' . $userImage . '" alt="" /></a>';
						$result .= '<br/>';
						
						$result .= '<p>' . $desc . '</p>';
						$result .= '<p>Workgroups involved: ';
							$sql3 = "SELECT * FROM eventworkgroups WHERE eventID = '" . $eventID . "'";
							$test3 = $conn->query($sql3);
							while($row3 = $test3->fetch_assoc())
							{
								$wgID = $row3['wgID'];
							
								$sql4 = "SELECT * FROM workgrouptypes WHERE id = '" . $wgID . "'";
								$test4 = $conn->query($sql4);
								while($row4 = $test4->fetch_assoc())
								{
									$wgType = $row4['workgroup'];
									
									$result .= $wgType . ', ';
								}	
							}
						$result .= '</p>';
					$result .= '</header>';
				//$result .= '</article>';
			$result .= '</div>';
			
			echo $result;
		}
	}
	else
	{
		echo 'No';
	}
?>