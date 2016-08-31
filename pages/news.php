<?php

	session_start();
	include 'dbconfig.php';

?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>South African NPO</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="../assets/css/main.css" />
		<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
	</head>
	<body>
	
		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Header -->
					<header id="header">
						<h1><a href="../index.php">South African NPO</a></h1>
						<nav class="links">
							<ul>
								<li><a href="#">About us</a></li>
								<li><a href="events.php">Events</a></li>
								<li><a href="stories.php">Stories</a></li>
								<li><a href="#">News</a></li>
								<li><a href="#">Become a Member</a></li>
							</ul>
						</nav>
						<nav class="main">
							<ul>
								<li class="search">
									<a class="fa-search" href="#search">Search</a>
									<form id="search" method="get" action="#">
										<input type="text" name="query" placeholder="Search" />
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
									<input type="text" name="query" placeholder="Search" />
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
										<a href="#">
											<h3>Events</h3>
											<p>Check out our calender to find out what events we have planned for this month</p>
										</a>
									</li>
									<li>
										<a href="#">
											<h3>Stories</h3>
											<p>See what we have done to make a difference in the lives of those who need it</p>
										</a>
									</li>
									<li>
										<a href="#">
											<h3>News</h3>
											<p>Find out what's happening in the world around you</p>
										</a>
									</li>
									<li>
										<a href="#">
											<h3>Become a member</h3>
											<p>Join us today in helping the people who need it most</p>
										</a>
									</li>
								</ul>
							</section>

						<!-- Actions -->
							<section>
								<ul class="actions vertical">
									<li><a href="#" class="button big fit">Log In</a></li>
								</ul>
							</section>

					</section>

				<!-- Main -->
					<div id="main">

						<!-- Post -->
						
						<?php
							
							$sql = "SELECT * FROM news ORDER BY id DESC"; //finds stories
							$test = $conn->query($sql);
							
							while ($row = $test->fetch_assoc())
							{
								$newsID = $row['id'];
								$title = $row['title'];
								$news = $row['news'];
								$date = $row['date'];
								$link = $row['link'];
								$image = $row['image'];
								$postedBy = $row['postedBy'];
								
								$sql = "SELECT * FROM members WHERE id = '".$postedBy."'"; //finding the user
								$test2 = $conn->query($sql);
								while ($row2 = $test2->fetch_assoc())
								{
									$userImage = $row2['image'];
								}
								
								echo '<article class="post">';
									echo '<header>';
										echo '<div class="title">';
											echo '<h2><a href="#">'.$title.'</a></h2>';
										echo '</div>';
											
										echo '<div class="meta">';
											if ($link != "")
											{
												echo '<p>Read more <a href="'.$link.'">here</a></p>';
											}
											echo '<a href="#" class="image"><img src="../'.$image.'" alt="" /></a>';
											echo '<time class="published" datetime="'.$date.'">'.$date.'</time>';
										echo '</div>';
									echo '</header>';
									
									echo '<p>'.$news.'</p>';
									
								echo '</article>';
							}
						?>

						<!-- Pagination -->
							<ul class="actions pagination">
								<li><a href="" class="disabled button big previous">Previous Page</a></li>
								<li><a href="#" class="button big next">Next Page</a></li>
							</ul>

					</div>
		
		<!-- Scripts -->
			<script src="../assets/js/jquery.min.js"></script>
			<script src="../assets/js/skel.min.js"></script>
			<script src="../assets/js/util.js"></script>
			<!--[if lte IE 8]><script src="../assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="../assets/js/main.js"></script>
	</body>
</html>