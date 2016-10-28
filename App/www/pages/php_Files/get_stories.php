<?php

	$commentsID = array();
	$comments = array();
	$commentsUser = array();
	$commentsDate = array();
	
	include "../dbconfig.php";
	
	$result = "";
	
	$sql = "SELECT * FROM stories ORDER BY id DESC"; //finds stories
	$test = $conn->query($sql);

	while($row = $test->fetch_assoc())
	{
		$postID = $row['id'];
		$title = $row['title'];
		$desc = $row['description'];
		$story = $row['story'];
		$date = $row['date'];
		$userID = $row['postedBy'];
		$image = $row['image'];
		$numLikes = $row['numLikes'];

		$sql = "SELECT * FROM members WHERE id = '" . $userID . "'"; //finding the user
		$test2 = $conn->query($sql);
		while($row2 = $test2->fetch_assoc())
		{
			$user = $row2['username'];
			$profile = $row2['image'];
		}

		$sql = "SELECT * FROM comments WHERE storyID = '" . $postID . "'"; //finding the comments
		$test2 = $conn->query($sql);
		$c=0;
		$numComments = mysqli_num_rows($test2);
		while($row2 = $test2->fetch_assoc())
		{
			$commentsID[$c] = $row2['id'];
			$comments[$c] = $row2['comment'];
			$commentsUser[$c] = $row2['postedBy'];
			$commentsDate[$c] = $row2['datePosted'];
			$c++;
		}



		$divName = $postID."commentDiv";

		$result .= '<article class="post">';
		$result .= '<header>';
		$result .= '<div class="title">';
		$result .= '<h2><span>' . $title . '</span></h2>';
		$result .= '<p>' . $desc . '</p>';
		$result .= '</div>';
		$result .= '<div class="meta">';
		$result .= '<time class="published" datetime="' . $date . '">' . $date . '</time>';
		$result .= '<span href="#" class="author"><span class="name">' . $user . '</span><img src="http://threedots.site88.net/.' . $profile . '" alt="" /></span>';
		$result .= '</div>';
		$result .= '</header>';
		$result .= '<span class="image featured"><img src="http://threedots.site88.net/.' . $image . '" alt="' . $desc . '" /></span>';
		$result .= '<p>' . $story . '</p>';

		$result .= '<footer>';
		$result .= '<ul class="stats">';
		$result .= '<li class="icon fa-heart likes">' . $numLikes . '</li>';
		$result .= '<li class="icon fa-comment comments">'.$numComments.'</li>';
		$result .= '</ul>';
		$result .= '</footer>';
		$result .= "<div class='commentsDiv' id='$divName'>";

		for($a=0;$a<$c;$a++)
		{
			if($commentsUser[$a]==0)//unknown user
			{
				$result .="<h6 style='font-size: 8pt;' data-id='$commentsID[$a]'>$comments[$a] - Unknown $commentsDate[$a]</h6>";
			}
			else
			{
				$sql = "SELECT username FROM members WHERE id = '" .$commentsUser[$a]. "'"; //finding the comments
				$test3 = $conn->query($sql);
				while($row3 = $test3->fetch_assoc())
				{
					$commentedUser = $row3['username'];
					$result .="<h6 style='font-size: 8pt;' data-id='$commentsID[$a]'>$comments[$a] - $commentedUser $commentsDate[$a]</h6>";
				}
			}

		}
		$result .= "</div>";
		$result .= '</article>';
	}
	
	echo $result;
?>