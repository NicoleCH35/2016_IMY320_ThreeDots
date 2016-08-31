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
								<li><a href="#">Events</a></li>
								<li><a href="stories.php">Stories</a></li>
								<li><a href="news.php">News</a></li>
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
						<!--Display this information in a modal when a user clicks on an event on the calendar -->
						<?php
							
							$sql = "SELECT * FROM events ORDER BY id DESC"; //finds stories
							$test = $conn->query($sql);
							
							while ($row = $test->fetch_assoc())
							{
								$eventID = $row['id'];
								$eventName = $row['eventName'];
								$location = $row['location'];
								$desc = $row['description'];
								$startDate = $row['startDateTime'];
								$endDate = $row['endDateTime'];
								$image = $row['photo'];
								$postedBy = $row['postedBy'];
								
								$sql = "SELECT * FROM members WHERE id = '".$postedBy."'"; //finding the user
								$test2 = $conn->query($sql);
								while ($row2 = $test2->fetch_assoc())
								{
									$userImage = $row2['image'];
								}
							
								echo '<article class="mini-post">';
									echo '<header>';
										echo '<h3><a href="#">'.$eventName.'</a></h3>';
										echo '<div class="published"><time  datetime="'.$startDate.'">'.$startDate.'</time> - <time  datetime="'.$endDate.'">'.$endDate.'</time></div>';
										echo '<a href="#" class="author"><img src="'.$userImage.'" alt="" /></a>';
									echo '</header>';
									echo '<a href="#" class="image"><img src="'.$image.'" alt="" /></a>';
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