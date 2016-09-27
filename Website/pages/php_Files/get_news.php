<?php

	include "../dbconfig.php";
	
	$sql = "SELECT * FROM news ORDER BY id DESC";
	$test = $conn->query($sql);
	$result = '';

	while($row = $test->fetch_assoc())
	{
		$newsID = $row['id'];
		$title = $row['title'];
		$news = $row['news'];
		$date = $row['date'];
		$link = $row['link'];
		$image = $row['image'];
		$postedBy = $row['postedBy'];
		
		//$result = $title;

		$sql = "SELECT * FROM members WHERE id = '" . $postedBy . "'"; //finding the user
		$test2 = $conn->query($sql);
		while($row2 = $test2->fetch_assoc())
		{
			$userImage = $row2['image'];
		}

		$result .= '<article class="mini-post">';
		$result .= '<header>';
		$result .= '<h2>' . $title . '</h2>';
		if($link != "")
		{
			$fullLink = "window.open('$link', '_system');";
			$result .= '<p>Read more <a href="#" onclick="'.$fullLink.'"><b>here</b></a>';
		}
		$result .= '<time class="published" datetime="' . $date . '">' . $date . '</time></p>';
		$result .= '<span class="image"><img src="http://threedots.site88.net/' . $image . '" alt="" width="10%"/></span>';
		$result .= '<br/>';
		$result .= '<p>' . $news . '</p>';	
		$result .= '</header>';
		$result .= '</article>';
	}
	
	echo $result;

?>