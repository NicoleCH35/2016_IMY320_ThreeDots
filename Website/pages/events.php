<?php
	if(session_status()==PHP_SESSION_NONE)
	{
		session_start();
	}
	include 'dbconfig.php';

?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>South African NPO</title>
		<meta charset="utf-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1"/>
		<!--[if lte IE 8]>
		<script src="../assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="../assets/css/main.css"/>
		<link rel="stylesheet" href="calenderStyle.css"/>
		<link rel="stylesheet" href="cal_modal_style.css" />
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
								$sql = "SELECT admin FROM members WHERE id='$uid'";
								$result = mysqli_query($conn, $sql);
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
								echo'<li><a href="signup.php">Become a Member</a></li>';
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
								$sql = "SELECT admin FROM members WHERE id='$uid'";
								$result = mysqli_query($conn, $sql);
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
				<form id="cal_form" name="cal_form" method="POST" action="calender.php">
					Please select a month: <input id="cal_month" list="month">
						<datalist id="month">
							<option value="January"/>
							<option value="February"/>
							<option value="March"/>
							<option value="April"/>
							<option value="May"/>
							<option value="June"/>
							<option value="July"/>
							<option value="August"/>
							<option value="September"/>
							<option value="October"/>
							<option value="November"/>
							<option value="December"/>
						</datalist>
					<input type="submit" name="cal_submit" id="cal_submit" value="View"/>
				</form>
				
				<div id="calender_spot">
				</div>
				
				<div id="calender_modal" class="modal">
				</div>
				
				<!-- Post -->
				<!--Display this information in a modal when a user clicks on an event on the calendar -->
				<?php

					//~ $sql = "SELECT * FROM events ORDER BY id DESC"; //finds stories
					//~ $test = $conn->query($sql);
					
					//~ while($row = $test->fetch_assoc())
					//~ {
						//~ $eventID = $row['id'];
						//~ $eventName = $row['eventName'];
						//~ $location = $row['location'];
						//~ $desc = $row['description'];
						//~ $startDate = $row['startDateTime'];
						//~ $endDate = $row['endDateTime'];
						//~ $image = $row['photo'];
						//~ $postedBy = $row['postedBy'];

						//~ $sql = "SELECT * FROM members WHERE id = '" . $postedBy . "'"; //finding the user
						//~ $test2 = $conn->query($sql);
						//~ while($row2 = $test2->fetch_assoc())
						//~ {
							//~ $user = $row2['username'];
							//~ $userImage = $row2['image'];
						//~ }

						//~ echo '<article class="mini-post">';
						//~ echo '<header>';
						//~ echo '<h3><a href="#">' . $eventName . '</a></h3>';
						//~ echo '<div class="published"><time  datetime="' . $startDate . '">' . $startDate . '</time> - <time  datetime="' . $endDate . '">' . $endDate . '</time></div>';
						//~ echo '<a href="#" class="author"><img src="' . $userImage . '" alt="" /></a>';
						//~ echo '<p>' . $desc . '</p>';
						//~ echo '</header>';
						//~ echo '<img src="../images/Events/' . $image . '" alt="" width="351" height="176" />';
						//~ echo '</article>';
					//~ }
				?>

			</div>

			<!-- Scripts -->
			<script src="../assets/js/jquery.min.js"></script>
			<script src="../assets/js/skel.min.js"></script>
			<script src="../assets/js/util.js"></script>
			<script src="../assets/js/login.js"></script>
			<!--[if lte IE 8]>
			<script src="../assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="../assets/js/main.js"></script>
			<script type="text/javascript" src="../jquery-2.1.4.min.js"></script>
			<script src="js_calender.js"></script>
	</body>
</html>