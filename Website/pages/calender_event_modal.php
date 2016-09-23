<?php
	//The Modal
	//<div id="myModal" class="modal">
	
	include 'dbconfig.php';
	
	$y = $_POST['year'];
	$m = date('m', strtotime($_POST["month"]));
	$d = $_POST['day'];
	
	$result = '';
	
	$sql = $conn->prepare("SELECT * FROM events WHERE startDateTime LIKE ?");
	$sDT = $y.'-'.$m.'-'.$d.' %';
	$sql->bind_param("s", $sDT);
    $sql->execute();
    $test = $sql->get_result();
	// $test = $conn->query($sql);
	
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

			$sql2 = $conn->prepare("SELECT * FROM members WHERE id = ?"); //finding the user
			$sql2->bind_param("i", $postedBy);
		    $sql2->execute();
		    $test2 = $sql2->get_result();
			while($row2 = $test2->fetch_assoc())
			{
				$user = $row2['username'];
				$userImage = $row2['image'];
			}
			
			$result .= '<div class="modal-content">';
				$result .= '<span class="close">x</span>';
				$result .= '<article class="mini-post">';
					$result .= '<header>';
						$result .= '<img src=".' . $image . '" alt="" width="351" height="176" />';
						$result .= '<h3><a href="#">' . $eventName . '</a></h3>';
						$result .= '<div class="published"><time  datetime="' . $startDate . '">' . $startDate . '</time> - <time  datetime="' . $endDate . '">' . $endDate . '</time></div>';
						$result .= '<a href="#" class="author"><img src=".' . $userImage . '" alt="" /></a>';
						$result .= '<br/>';
						
						$result .= '<p>' . $desc . '</p>';
						$result .= '<p>Workgroups involved: ';
							$sql3 = $conn->prepare("SELECT * FROM eventworkgroups WHERE eventID = ?");
							$sql3->bind_param("i", $eventID);
						    $sql3->execute();
						    $test3 = $sql3->get_result();
							// $test3 = $conn->query($sql3);
							while($row3 = $test3->fetch_assoc())
							{
								$wgID = $row3['wgID'];
							
								$sql4 = $conn->prepare("SELECT * FROM workgrouptypes WHERE id = ?");
								$sql4->bind_param("i", $wgID);
							    $sql4->execute();
							    $test4 = $sql4->get_result();
								// $test4 = $conn->query($sql4);
								while($row4 = $test4->fetch_assoc())
								{
									$wgType = $row4['workgroup'];
									
									$result .= $wgType . ', ';
								}	
								$sql4->free_result();	
							}
						$result .= '</p>';
					$result .= '</header>';
				$result .= '</article>';
			$result .= '</div>';
			$sql3->free_result();
			$sql2->free_result();
			
			echo $result;
		}
		$sql->free_result();
	}
	else
	{
		echo 'No';
	}
?>