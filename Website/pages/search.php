<?php
	
	include 'dbconfig.php';
	//if(session_status()==PHP_SESSION_NONE)
	//{
		session_start();
	//}
	
	$desc = $_GET["query"];

	$i = 0;
	$j = 0;
	$k = 0;

	$eventID = array();
	$eventLoc = array();
	$eventDesc = array();
	$eventName = array();
	$eventStart = array();
	$eventEnd = array();
	$eventImage = array();
	$eventUser = array();

	$newsID = array();
	$newsTitle = array();
	$newsNews = array();
	$newsDate = array();
	$newsLink = array();
	$newsImage = array();
	$newsUser = array();


	$storiesID = array();
	$storiesTitle = array();
	$storiesDescription = array();
	$storiesStory = array();
	$storiesDate = array();
	$storiesUserId = array();
	$storiesImage = array();
	$storiesLikes = array();

	///////////////////////////////////////////////////////////////EVENTS//////////////////////////////////////////////////////

	//Search event Name
	$sql = $conn->prepare("SELECT * FROM events WHERE eventName LIKE ?");
	$eNamLike = '%'.$desc.'%';
	$sql->bind_param("s", $eNamLike);
    $sql->execute();
    $result = $sql->get_result();
	while($row = $result->fetch_assoc())
	{
		$eventID[$i] = $row['id'];
		$eventLoc[$i] = $row['location'];
		$eventDesc[$i] = $row['description'];
		$eventName[$i] = $row['eventName'];
		$eventStart[$i] = $row['startDateTime'];
		$eventEnd[$i] = $row['endDateTime'];
		$eventImage[$i] = $row['photo'];
		$eventUser[$i] = $row['postedBy'];

		$i++;

	}


	//search event location
	$sql = $conn->prepare("SELECT * FROM events WHERE location LIKE ?");
	$eNamLike = '%'.$desc.'%';
	$sql->bind_param("s", $eNamLike);
    $sql->execute();
    $result = $sql->get_result();
	while($row = $result->fetch_assoc())
	{
		$tempID = $row['id'];

		if(!in_array($tempID, $eventID))
		{
			$eventID[$i] = $tempID;
			$eventLoc[$i] = $row['location'];
			$eventDesc[$i] = $row['description'];
			$eventName[$i] = $row['eventName'];
			$eventStart[$i] = $row['startDateTime'];
			$eventEnd[$i] = $row['endDateTime'];
			$eventImage[$i] = $row['photo'];
			$eventUser[$i] = $row['postedBy'];
			$i++;
		}
	}

	//search event description
	$sql = $sql = $conn->prepare("SELECT * FROM events WHERE description LIKE ?");
	$eNamLike = '%'.$desc.'%';
	$sql->bind_param("s", $eNamLike);
    $sql->execute();
    $result = $sql->get_result();
	while($row = $result->fetch_assoc())
	{
		$tempID = $row['id'];

		if(!in_array($tempID, $eventID))
		{
			$eventID[$i] = $tempID;
			$eventLoc[$i] = $row['location'];
			$eventDesc[$i] = $row['description'];
			$eventName[$i] = $row['eventName'];
			$eventStart[$i] = $row['startDateTime'];
			$eventEnd[$i] = $row['endDateTime'];
			$eventImage[$i] = $row['photo'];
			$eventUser[$i] = $row['postedBy'];
			$i++;
		}

	}

	///////////////////////////////////////////////////////////////NEWS//////////////////////////////////////////////////////
	//search news title
	$sql = $conn->prepare("SELECT * FROM news WHERE title LIKE ?");
	$eNamLike = '%'.$desc.'%';
	$sql->bind_param("s", $eNamLike);
    $sql->execute();
    $result = $sql->get_result();
	while($row = $result->fetch_assoc())
	{
		$newsID[$j] = $row['id'];
		$newsTitle[$j] = $row['title'];
		$newsNews[$j] = $row['news'];
		$newsDate[$j] = $row['date'];
		$newsLink[$j] = $row['link'];
		$newsImage[$j] = $row['image'];
		$newsUser[$j] = $row['postedBy'];
		$j++;
	}

	//search news news
	$sql = $conn->prepare("SELECT * FROM news WHERE news LIKE ?");
	$eNamLike = '%'.$desc.'%';
	$sql->bind_param("s", $eNamLike);
    $sql->execute();
    $result = $sql->get_result();
	while($row = $result->fetch_assoc())
	{
		$tempID = $row['id'];

		if(!in_array($tempID, $newsID))
		{
			$newsID[$j] = $row['id'];
			$newsTitle[$j] = $row['title'];
			$newsNews[$j] = $row['news'];
			$newsDate[$j] = $row['date'];
			$newsLink[$j] = $row['link'];
			$newsImage[$j] = $row['image'];
			$newsUser[$j] = $row['postedBy'];
			$j++;
		}
	}

	///////////////////////////////////////////////////////////////STORIES//////////////////////////////////////////////////////
	//search Stories title
	$sql = $conn->prepare("SELECT * FROM stories WHERE title LIKE ?");
	$eNamLike = '%'.$desc.'%';
	$sql->bind_param("s", $eNamLike);
    $sql->execute();
    $result = $sql->get_result();
	while($row = $result->fetch_assoc())
	{
		$storiesID[$k] = $row['id'];
		$storiesTitle[$k] = $row['title'];
		$storiesDescription[$k] = $row['description'];
		$storiesStory[$k] = $row['story'];
		$storiesDate[$k] = $row['date'];
		$storiesUserId[$k] = $row['postedBy'];
		$storiesImage[$k] = $row['image'];
		$storiesLikes[$k] = $row['numLikes'];
		$k++;
	}

	//search Stories description
	$sql = $conn->prepare("SELECT * FROM stories WHERE description LIKE ?");
	$eNamLike = '%'.$desc.'%';
	$sql->bind_param("s", $eNamLike);
    $sql->execute();
    $result = $sql->get_result();
	while($row = $result->fetch_assoc())
	{
		$tempID = $row['id'];

		if(!in_array($tempID, $storiesID))
		{
			$storiesID[$k] = $tempID;
			$storiesTitle[$k] = $row['title'];
			$storiesDescription[$k] = $row['description'];
			$storiesStory[$k] = $row['story'];
			$storiesDate[$k] = $row['date'];
			$storiesUserId[$k] = $row['postedBy'];
			$storiesImage[$k] = $row['image'];
			$storiesLikes[$k] = $row['numLikes'];
			$k++;
		}
	}

	//search Stories story
	$sql = $conn->prepare("SELECT * FROM stories WHERE story LIKE ?");
	$eNamLike = '%'.$desc.'%';
	$sql->bind_param("s", $eNamLike);
    $sql->execute();
    $result = $sql->get_result();
	while($row = $result->fetch_assoc())
	{
		$tempID = $row['id'];

		if(!in_array($tempID, $storiesID))
		{
			$storiesID[$k] = $tempID;
			$storiesTitle[$k] = $row['title'];
			$storiesDescription[$k] = $row['description'];
			$storiesStory[$k] = $row['story'];
			$storiesDate[$k] = $row['date'];
			$storiesUserId[$k] = $row['postedBy'];
			$storiesImage[$k] = $row['image'];
			$storiesLikes[$k] = $row['numLikes'];
			$k++;
		}
	}


?>
<!DOCTYPE HTML>
<!--
	Future Imperfect by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>South African NPO</title>
		<meta charset="utf-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1"/>
		<!--[if lte IE 8]>
		<script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="../assets/css/main.css"/>
		<!--[if lte IE 9]>
		<link rel="stylesheet" href="../assets/css/ie9.css"/><![endif]-->
		<!--[if lte IE 8]>
		<link rel="stylesheet" href="../assets/css/ie8.css"/><![endif]-->
	</head>
	<body>

		<!-- Wrapper -->
		<div id="wrapper">

			<!-- Header -->
			<header id="header">
				<h1><a href="../index.php">Fireflies</a></h1>
				<nav class="links">
					<ul>
						<li><a href="about.php">About us</a></li>
						<li><a href="events.php">Events</a></li>
						<li><a href="stories.php">Stories</a></li>
						<li><a href="news.php">News</a></li>
						<?php
							if(isset($_SESSION['sessionId']))
							{
								$uid=$_SESSION['userId'];
								$sql = $conn->prepare("SELECT admin FROM members WHERE id=?");
								$sql->bind_param("i", $uid);
						        $sql->execute();
						        $result = $sql->get_result();
								$admin = false;
								while($row = $result->fetch_assoc())
								{
									$admin = $row["admin"];
								}
								if($admin)
								{
									echo'<li><a href="admin.php">Admin</a></li>';

								}
								echo'<li><a href="logout.php">Logout</a></li>';
							}
							else
							{
								echo'<li><a href="pages/signup.php">Become a Member</a></li>';
							}

						?>
					</ul>
				</nav>
				<nav class="main">
					<ul>
						<li class="search">
							<a class="fa-search" href="#search">Search</a>
							<form id="search" method="get" action="search.php">
								<input type="text" name="query" placeholder="Search"/>
							</form>
						</li>
						<li class="menu">
							<a class="fa-bars" href="#menu">Menu</a>
						</li>
					</ul>
				</nav>
			</header>

			<!-- Menu -->
			<section id="menu">

				<!-- Search -->
				<section>
					<form class="search" method="get" action="search.php">
						<input type="text" name="query" placeholder="Search"/>
					</form>
				</section>

				<!-- Links -->
				<section>
					<ul class="links">
						<li>
							<a href="about.php">
								<h3>About us</h3>
								<p>Find out what we do and how you can contact us</p>
							</a>
						</li>
						<li>
							<a href="events.php">
								<h3>Events</h3>
								<p>Check out our calender to find out what events we have planned for this month</p>
							</a>
						</li>
						<li>
							<a href="stories.php">
								<h3>Stories</h3>
								<p>See what we have done to make a difference in the lives of those who need it</p>
							</a>
						</li>
						<li>
							<a href="news.php">
								<h3>News</h3>
								<p>Find out what's happening in the world around you</p>
							</a>
						</li>
						<?php
							if(isset($_SESSION['sessionId']))
							{
								$uid=$_SESSION['userId'];
								$sql = $conn->prepare("SELECT admin FROM members WHERE id=?");
								$sql->bind_param("i", $uid);
						        $sql->execute();
						        $result = $sql->get_result();
								$admin = false;
								while($row = $result->fetch_assoc())
								{
									$admin = $row["admin"];
								}
								if($admin)
								{
									echo'<li><a href="admin.php"><h3>Admin</h3><p>Manage Site</p></a></li>';
								}

							}
							else
							{
								echo'<li><a href="signup.php"><h3>Become a member</h3><p>Join us today in helping the people who need it most</p></a></li>';
							}

						?>
					</ul>
				</section>

				<!-- Actions -->


				<section>
					<?php
						if(isset($_SESSION['sessionId']))
						{
							echo'<ul class="actions vertical">
									<li><a href="logout.php" class="button big fit">Logout</a></li>
								</ul>';
						}
						else
						{
							echo'<form method="post" action="login.php" onsubmit="return validateLogin()">
									<h1>Log in</h1>
									<label for="username">Username: </label>
									<input type="text" name="username" id="username" class="Linput"/><br/>
			
									<label for="password">Password: </label>
									<input type="password" name="password" id="password" class="Linput"/><br/>
			
									<input type="submit" name="submit" value="Log in">
									<input type="hidden" name="hidden">
								</form>';
						}

					?>

				</section>

			</section>

			<!-- Main -->
			<div id="main">

				<!-- Post -->
				<!--STORIES-->
				<?php

					if(count($storiesID)>0)
					{
						echo"<h2>Results from Stories</h2>";
					}
					for($i = 0; $i < count($storiesID); $i++)
					{

						$sql = $conn->prepare("SELECT * FROM members WHERE id = ?"); //finding the user
						$sql->bind_param("i", $storiesUserId[$i]);
				        $sql->execute();
				        $test2 = $sql->get_result();
						while($row2 = $test2->fetch_assoc())
						{
							$user = $row2['username'];
							$profile = $row2['image'];
						}

						echo '<article class="post">';
						echo '<header>';
						echo '<div class="title">';
						echo '<h2><a href="#">' . $storiesTitle[$i] . '</a></h2>';
						echo '<p>' . $storiesDescription[$i] . '</p>';
						echo '</div>';
						echo '<div class="meta">';
						echo '<time class="published" datetime="' . $storiesDate[$i] . '">' . $storiesDate[$i] . '</time>';
						echo '<span class="author"><span class="name">' . $user . '</span><img src="../' . $profile . '" alt="" /></span>';
						echo '</div>';
						echo '</header>';
						echo '<a href="#" class="image featured"><img src="../' . $storiesImage[$i] . '" alt="" /></a>';
						echo '<p>' . $storiesStory[$i] . '</p>';

						echo '<footer>';
						echo '<ul class="stats">';
						echo '<li><a href="#">General</a></li>';
						echo '<li><a href="#" class="icon fa-heart">' . $storiesLikes[$i] . '</a></li>';
						echo '<li><a href="#" class="icon fa-comment">128</a></li>';
						echo '</ul>';
						echo '</footer>';
						echo '</article>';
					}
				?>
				<!--EVENTS-->
				<?php
					if(count($eventID)>0)
					{
						echo"<h2>Results from Events</h2>";
					}
					for($i = 0; $i < count($eventID); $i++)
					{
						$sql = $conn->prepare("SELECT * FROM members WHERE id = ?"); //finding the user
						$sql->bind_param("i", $eventUser[$i]);
				        $sql->execute();
				        $test2 = $sql->get_result();
						while($row2 = $test2->fetch_assoc())
						{
							$userImage = $row2['image'];
						}

						echo '<article class="post">';
						echo '<header>';
						echo '<div class="title">';
						echo '<h2><a href="#">' . $eventName[$i] . '</a></h2>';
						echo '</div>';
						echo '<div class="meta">';
						echo '<div class="published"><span>Start: </span><time  datetime="' . $eventStart[$i] . '">' . $eventStart[$i] . '</time></span><br>';
						echo '<span>End: <time  datetime="' . $eventEnd[$i] . '">' . $eventEnd[$i] . '</time></span></div>';
						echo '<span class="author"><img src="../' . $userImage . '" alt="" /></span>';
						echo '</div>';
						echo '</header>';
						echo '<a href="#" class="image featured"><img src="../' . $eventImage[$i] . '" alt="" /></a>';

					}
				?>
				<!--NEWS-->
				<?php

					if(count($newsID)>0)
					{
						echo"<h2>Results from news</h2>";
					}

					for($i = 0; $i < count($newsID); $i++)
					{
						$sql = $conn->prepare("SELECT * FROM members WHERE id = ?"); //finding the user
						$sql->bind_param("i", $newsID[$i]);
				        $sql->execute();
				        $test2 = $sql->get_result();
						while($row2 = $test2->fetch_assoc())
						{
							$userName = $row2['username'];
							$userImage = $row2['image'];
						}

						echo '<article class="post">';
						echo '<header>';
						echo '<div class="title">';
						echo '<h2><a href="#">' . $newsTitle[$i] . '</a></h2>';
						echo '</div>';
						echo '<div class="meta">';
						echo '<time class="published" datetime="' . $newsDate[$i] . '">' . $newsDate[$i] . '</time>';
						echo '<span class="author"><span class="name">' . $userName . '</span><img src="../' . $userImage . '" alt="" /></span>';
						echo '</div>';
						echo '</header>';
						echo '<a href="#" class="image featured"><img src="../' . $newsImage[$i] . '" alt="" /></a>';
						echo '<p>' . $newsNews[$i] . '</p>';

					}
				?>

				<?php
					if(count($newsID)==0 && count($eventID)==0 && count($storiesID)==0)
					{
						echo "<h2>Your search '$desc' did not match any Stories, Events or News.</h2>";
						echo "<h4>Suggestions:</h4><ul><li>Make sure all words are spelled correctly.</li><li>Try different, more general or fewer keywords.</li><li>turn it off and on again</li></ul>";
					}
				?>
				<!-- Pagination -->
				<!--<ul class="actions pagination">
					<li><a href="" class="disabled button big previous">Previous Page</a></li>
					<li><a href="#" class="button big next">Next Page</a></li>
				</ul>
				-->
			</div>

			<!-- Sidebar -->
			<section id="sidebar">

				<!-- Intro -->
				<section id="intro">
					<a href="#" class="logo"><img src="../images/sa_flag.gif" alt=""/></a>
					<header>
						<h2>South African NPO</h2>
					</header>
				</section>

				<!-- About -->
				<section class="blurb">
					<h2>About</h2>
					<p>Mauris neque quam, fermentum ut nisl vitae, convallis maximus nisl. Sed mattis nunc id lorem
						euismod amet placerat. Vivamus porttitor magna enim, ac accumsan tortor cursus at phasellus sed
						ultricies.</p>
					<ul class="actions">
						<li><a href="#" class="button">Learn More</a></li>
					</ul>
				</section>

				<!-- Footer -->
				<section id="footer">
					<ul class="icons">
						<li><a href="#" class="fa-twitter"><span class="label">Twitter</span></a></li>
						<li><a href="#" class="fa-facebook"><span class="label">Facebook</span></a></li>
						<li><a href="#" class="fa-instagram"><span class="label">Instagram</span></a></li>
						<li><a href="#" class="fa-rss"><span class="label">RSS</span></a></li>
						<li><a href="#" class="fa-envelope"><span class="label">Email</span></a></li>
					</ul>
					<p class="copyright">&copy; Untitled. Design: <a href="http://html5up.net">HTML5 UP</a>. Images: <a
							href="http://unsplash.com">Unsplash</a>.</p>
				</section>

			</section>

		</div>

		<!-- Scripts -->
		<script src="../assets/js/jquery.min.js"></script>
		<script src="../assets/js/skel.min.js"></script>
		<script src="../assets/js/util.js"></script>
		<script src="../assets/js/login.js"></script>
		<!--[if lte IE 8]>
		<script src="../assets/js/ie/respond.min.js"></script><![endif]-->
		<script src="../assets/js/main.js"></script>

	</body>
</html>
