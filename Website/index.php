<?php

	include 'pages/dbconfig.php';

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
		<link rel="stylesheet" href="assets/css/main.css"/>
		<!--[if lte IE 9]>
		<link rel="stylesheet" href="assets/css/ie9.css"/><![endif]-->
		<!--[if lte IE 8]>
		<link rel="stylesheet" href="assets/css/ie8.css"/><![endif]-->
	</head>
	<body>

		<!-- Wrapper -->
		<div id="wrapper">

			<!-- Header -->
			<header id="header">
				<h1><a href="index.php">Fireflies</a></h1>
				
				<nav class="links">
					<ul>
						<li><a href="pages/about.php">About us</a></li>
						<li><a href="pages/events.php">Events</a></li>
						<li><a href="pages/stories.php">Stories</a></li>
						<li><a href="pages/news.php">News</a></li>
						<?php
							if(isset($_SESSION['sessionId']))
							{
								//echo "in";
								$uid=$_SESSION['userId'];
								$sql = "SELECT admin FROM members WHERE id='$uid'";
								$result = mysqli_query($conn, $sql);
								$admin = false;
								while($row = $result->fetch_assoc())
								{
									$admin = $row["admin"];
								}
								if($admin)
								{
									echo'<li><a href="pages/admin.php">Admin</a></li>';
									
								}
								echo'<li><a href="pages/logout.php">Logout</a></li>';
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
							<form id="search" method="get" action="pages/search.php">
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
					<form class="search" method="get" action="pages/search.php">
						<input type="text" name="query" placeholder="Search"/>
					</form>
				</section>

				<!-- Links -->
				<section>
					<ul class="links">
						<li>
							<a href="pages/about.php">
								<h3>About us</h3>
								<p>Find out what we do and how you can contact us</p>
							</a>
						</li>
						<li>
							<a href="pages/events.php">
								<h3>Events</h3>
								<p>Check out our calender to find out what events we have planned for this month</p>
							</a>
						</li>
						<li>
							<a href="pages/stories.php">
								<h3>Stories</h3>
								<p>See what we have done to make a difference in the lives of those who need it</p>
							</a>
						</li>
						<li>
							<a href="pages/news.php">
								<h3>News</h3>
								<p>Find out what's happening in the world around you</p>
							</a>
						</li>

						<?php
							if(isset($_SESSION['sessionId']))
							{
								$uid=$_SESSION['userId'];
								$sql = "SELECT admin FROM members WHERE id='$uid'";
								$result = mysqli_query($conn, $sql);
								$admin = false;
								while($row = $result->fetch_assoc())
								{
									$admin = $row["admin"];
								}
								if($admin)
								{
									echo'<li><a href="pages/admin.php"><h3>Admin</h3><p>Manage Site</p></a></li>';
								}

							}
							else
							{
								echo'<li><a href="pages/signup.php"><h3>Become a member</h3><p>Join us today in helping the people who need it most</p></a></li>';
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
									<li><a href="pages/logout.php" class="button big fit">Logout</a></li>
								</ul>';
						}
						else
						{
							echo'<form method="post" action="pages/login.php" onsubmit="return validateLogin()">
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

				<?php

					$commentsID = array();
					$comments = array();
					$commentsUser = array();
					$commentsDate = array();

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

						echo '<article class="post">';
						echo '<header>';
						echo '<div class="title">';
						echo '<h2><a href="pages/stories.php">' . $title . '</a></h2>';
						echo '<p>' . $desc . '</p>';
						echo '</div>';
						echo '<div class="meta">';
						echo '<time class="published" datetime="' . $date . '">' . $date . '</time>';
						echo '<span href="#" class="author"><span class="name">' . $user . '</span><img src="' . $profile . '" alt="" /></span>';
						echo '</div>';
						echo '</header>';
						echo '<span class="image featured"><img src="' . $image . '" alt="' . $desc . '" /></span>';
						echo '<p>' . $story . '</p>';

						echo '<footer>';
						echo '<ul class="stats">';
						echo '<li><a href="#" class="icon fa-heart likes" data-id="'.$postID.'">' . $numLikes . '</a></li>';
						echo '<li><a href="#" class="icon fa-comment comments" data-id="'.$divName.'">'.$numComments.'</a></li>';
						echo '</ul>';
						echo '</footer>';
						echo "<div class='commentsDiv' id='$divName'>";
						$admin = false;
						if(isset($_SESSION['sessionId']))
						{
							$uid=$_SESSION['userId'];
							$sql = "SELECT admin FROM members WHERE id='$uid'";
							$result = mysqli_query($conn, $sql);

							while($row = $result->fetch_assoc())
							{
								$admin = $row["admin"];
							}
						}

						for($a=0;$a<$c;$a++)
						{
							if($admin)
							{
								if($commentsUser[$a]==0)//unknown user
								{

									echo"<h6 style='font-size: 8pt;' data-id='$commentsID[$a]'>$comments[$a] - Unknown $commentsDate[$a] <a class='icon fa-remove deleteComment' data-id='$commentsID[$a]'></a></h6>";
								}
								else
								{
									$sql = "SELECT username FROM members WHERE id = '" .$commentsUser[$a]. "'"; //finding the comments
									$test3 = $conn->query($sql);
									while($row3 = $test3->fetch_assoc())
									{
										$commentedUser = $row3['username'];
										echo"<h6 style='font-size: 8pt;' data-id='$commentsID[$a]'>$comments[$a] - $commentedUser $commentsDate[$a]<a class='icon fa-remove deleteComment' data-id='$commentsID[$a]'></a></h6>";
									}
								}
							}
							else
							{
								if($commentsUser[$a]==0)//unknown user
								{

									echo"<h6 style='font-size: 8pt;' data-id='$commentsID[$a]'>$comments[$a] - Unknown $commentsDate[$a]</h6>";
								}
								else
								{
									$sql = "SELECT username FROM members WHERE id = '" .$commentsUser[$a]. "'"; //finding the comments
									$test3 = $conn->query($sql);
									while($row3 = $test3->fetch_assoc())
									{
										$commentedUser = $row3['username'];
										echo"<h6 style='font-size: 8pt;' data-id='$commentsID[$a]'>$comments[$a] - $commentedUser $commentsDate[$a]</h6>";
									}
								}
							}

						}
						$FID = $postID."commentForm";
						$UIDF = $postID."userID";
						$CT = $postID."commentText";
						if(isset($_SESSION['sessionId']))
						{
							$uid2=$_SESSION['userId'];
							echo"<form class='commentForm' id='$FID' data-id='$postID'>
								<input type='hidden' value='$uid2' id='$UIDF'>
								<textarea cols='5' rows='1' style='font-size: 12pt;' id='$CT'></textarea>
								<input type='submit' value='Comment' class='pull-right postComment' data-id='$FID'>
							</form>";
						}
						else
						{
							echo"<form class='commentForm' id='$FID' data-id='$postID'>
								<input type='hidden' value='0' id='$UIDF'>
								<textarea cols='5' rows='1' style='font-size: 12pt;' id='$CT'></textarea>
								<input type='submit' value='Comment' class='pull-right postComment' data-id='$FID'>
							</form>";
						}

						echo "</div>";
						echo '</article>';


					}
				?>

			</div>

			<!-- Sidebar -->
			<section id="sidebar">

				<!-- Intro -->
				<section id="intro">
					<a href="index.php"><img src="images/FireflyLogo.png" alt="" width="110px" /></a>
					<header>
						<h1>Fireflies</h1>
						<h3>South African NPO</h3>
					</header>
				</section>

				<!-- Events -->
				<section>
					<div class="mini-posts">

						<?php

							$sql = "SELECT * FROM events ORDER BY id DESC"; //finds stories
							$test = $conn->query($sql);

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

								echo '<article class="mini-post">';
								echo '<header>';
								echo '<h3><a href="pages/events.php">' . $eventName . '</a></h3>';
								echo '<div class="published"><time  datetime="' . $startDate . '">' . $startDate . '</time> - <time  datetime="' . $endDate . '">' . $endDate . '</time></div>';
								echo '<a href="#" class="author"><img src="' . $userImage . '" alt="' . $userName . '" /></a>';
								echo '</header>';
								echo '<a href="#" class="image"><img src="' . $image . '" alt="' . $desc . '" /></a>';
								echo '</article>';
							}
						?>

					</div>
				</section>

				<!-- Posts List -->
				<section>
					<ul class="posts">

						<?php

							$sql = "SELECT * FROM news ORDER BY id DESC"; //finds stories
							$test = $conn->query($sql);

							while($row = $test->fetch_assoc())
							{
								$newsID = $row['id'];
								$title = $row['title'];
								$news = $row['news'];
								$date = $row['date'];
								$link = $row['link'];
								$image = $row['image'];
								$postedBy = $row['postedBy'];

								$sql = "SELECT * FROM members WHERE id = '" . $postedBy . "'"; //finding the user
								$test2 = $conn->query($sql);
								while($row2 = $test2->fetch_assoc())
								{
									$userImage = $row2['image'];
								}

								echo '<li>';
								echo '<article>';
								echo '<header>';
								echo '<h3><a href="pages/news.php">' . $title . '</a></h3>';
								echo '<time class="published" datetime="' . $date . '">' . $date . '</time>';
								echo '</header>';
								echo '<a href="#" class="image"><img src="' . $image . '" alt="' . $news . '" /></a>';
								echo '</article>';
								echo '</li>';
							}
						?>

					</ul>
				</section>

				<!-- About -->
				<section class="blurb">
					<h2>About</h2>
					<p>We are a South African non-profit organisation that aims to fund raise for schools in need.</p>
					<ul class="actions">
						<li><a href="pages/about.php" class="button">Learn More</a></li>
					</ul>
				</section>

				<!-- Footer -->
				<section id="footer">
					<ul class="icons">
						<li><a href="http://www.twitter.com" class="fa-twitter"><span class="label">Twitter</span></a></li>
						<li><a href="http://www.facebook.com" class="fa-facebook"><span class="label">Facebook</span></a></li>
						<li><a href="http://www.instagram.com" class="fa-instagram"><span class="label">Instagram</span></a></li>
						<li><a href="pages/about.php" class="fa-envelope"><span class="label">Contact Us</span></a></li>
					</ul>
					<p class="copyright">&copy; ThreeDots. This is a demo site. No information on this site should be taken seriously. Design: <a href="http://html5up.net">HTML5 UP</a>. Images: <a
							href="http://unsplash.com">Unsplash</a>.</p>
				</section>

			</section>

		</div>

		<!-- Scripts -->

		<script src="assets/js/jquery.min.js"></script>
		<script src="assets/js/skel.min.js"></script>
		<script src="assets/js/util.js"></script>
		<script src="assets/js/likes.js"></script>
		<script src="assets/js/login.js"></script>

		<!--[if lte IE 8]>
		<script src="assets/js/ie/respond.min.js"></script><![endif]-->
		<script src="assets/js/main.js"></script>
		<script type="text/javascript" src="jquery-2.1.4.min.js"></script>

	</body>
</html>