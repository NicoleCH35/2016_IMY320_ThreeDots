<?php

	session_start();
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
				<h1><a href="index.php">South African NPO</a></h1>
				<nav class="links">
					<ul>
						<li><a href="#">About us</a></li>
						<li><a href="pages/events.php">Events</a></li>
						<li><a href="pages/stories.php">Stories</a></li>
						<li><a href="pages/news.php">News</a></li>
						<li><a href="pages/signup.php">Become a Member</a></li>
								<!-- If user is an admin display this -->
								<li><a href="pages/admin.php">Admin</a></li>
					</ul>
				</nav>
				<nav class="main">
					<ul>
						<li class="search">
							<a class="fa-search" href="#search">Search</a>
							<form id="search" method="get" action="#">
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
					<form class="search" method="get" action="#">
						<input type="text" name="query" placeholder="Search"/>
					</form>
				</section>

				<!-- Links -->
				<section>
					<ul class="links">
						<li>
							<a href="#">
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
						<li>
							<a href="pages/signup.php">
								<h3>Become a member</h3>
								<p>Join us today in helping the people who need it most</p>
							</a>
						</li>
					</ul>
				</section>

				<!-- Actions -->
				<section>
					<form method="post" action="pages/login.php" onsubmit="return validateLogin()">
						<h1>Log in</h1>
						<label for="username">Username: </label>
						<input type="text" name="username" id="username" class="Linput"/><br/>

						<label for="password">Password: </label>
						<input type="password" name="password" id="password" class="Linput"/><br/>

						<input type="submit" name="submit" value="Log in">
						<input type="hidden" name="hidden">
					</form>
				</section>

			</section>

			<!-- Main -->
			<div id="main">

				<!-- Post -->

				<?php

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

						echo '<article class="post">';
						echo '<header>';
						echo '<div class="title">';
						echo '<h2><a href="#">' . $title . '</a></h2>';
						echo '<p>' . $desc . '</p>';
						echo '</div>';
						echo '<div class="meta">';
						echo '<time class="published" datetime="' . $date . '">' . $date . '</time>';
						echo '<a href="#" class="author"><span class="name">' . $user . '</span><img src="' . $profile . '" alt="" /></a>';
						echo '</div>';
						echo '</header>';
						echo '<a href="#" class="image featured"><img src="' . $image . '" alt="" /></a>';
						echo '<p>' . $story . '</p>';

						echo '<footer>';
						echo '<ul class="stats">';
						echo '<li><a href="#">General</a></li>';
						echo '<li><a href="#" class="icon fa-heart">' . $numLikes . '</a></li>';
						echo '<li><a href="#" class="icon fa-comment">128</a></li>';
						echo '</ul>';
						echo '</footer>';
						echo '</article>';
					}
				?>

				<!-- Pagination -->
				<ul class="actions pagination">
					<li><a href="" class="disabled button big previous">Previous Page</a></li>
					<li><a href="#" class="button big next">Next Page</a></li>
				</ul>

			</div>

			<!-- Sidebar -->
			<section id="sidebar">

				<!-- Intro -->
				<section id="intro">
					<a href="#" class="logo"><img src="images/sa_flag.gif" alt=""/></a>
					<header>
						<h2>South African NPO</h2>
						<p>Another fine responsive site template by <a href="http://html5up.net">HTML5 UP</a></p>
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
								}

								echo '<article class="mini-post">';
								echo '<header>';
								echo '<h3><a href="#">' . $eventName . '</a></h3>';
								echo '<div class="published"><time  datetime="' . $startDate . '">' . $startDate . '</time> - <time  datetime="' . $endDate . '">' . $endDate . '</time></div>';
								echo '<a href="#" class="author"><img src="' . $userImage . '" alt="" /></a>';
								echo '</header>';
								echo '<a href="#" class="image"><img src="' . $image . '" alt="" /></a>';
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
								echo '<h3><a href="#">' . $title . '</a></h3>';
								echo '<time class="published" datetime="' . $date . '">' . $date . '</time>';
								echo '</header>';
								echo '<a href="#" class="image"><img src="' . $image . '" alt="" /></a>';
								echo '</article>';
								echo '</li>';
							}
						?>

					</ul>
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
		<script src="assets/js/jquery.min.js"></script>
		<script src="assets/js/skel.min.js"></script>
		<script src="assets/js/util.js"></script>
		<script src="assets/js/login.js"></script>
		<!--[if lte IE 8]>
		<script src="assets/js/ie/respond.min.js"></script><![endif]-->
		<script src="assets/js/main.js"></script>

	</body>
</html>