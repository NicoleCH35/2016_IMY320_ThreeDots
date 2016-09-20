<?php
	//~ if(session_status()==PHP_SESSION_NONE)
	//~ {
		//~ session_start();
	//~ }
	//include 'redirect.php';
	include 'dbconfig.php';
	include 'redirect.php';
	include 'redirectAdmin.php';

?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>South African NPO</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="../bootstrap-3.3.4-dist/css/bootstrap.min.css"/>
		<link rel="stylesheet" href="style.css" />
		<link rel="stylesheet" href="../assets/css/main.css" />
			<script type="text/javascript" src="../jquery-2.1.4.min.js"></script>
			<script type="text/javascript" src="js_validate_story.js"></script>
		<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
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
						
						<div class="container">
							<ul class="nav nav-tabs">
								<li class="active"><a data-toggle="tab" href="#story">Story</a></li>
								<li><a data-toggle="tab" href="#event">Event</a></li>
								<li><a data-toggle="tab" href="#news">News</a></li>
								<!--<li><a data-toggle="tab" href="#menu3">Posts you've shared</a></li>
								<li><a data-toggle="tab" href="#menu4">Friend Requests</a></li>
								<li><a data-toggle="tab" href="#menu5" id="msgTab">Messages</a></li>-->
							</ul>
						
							<div class="tab-content">
				
								<div id="story" class="tab-pane fade in active">
									<div class="item active fixedSize">
										</br>
										<h1 class="text-center">Create a Story</h1>
										<hr>
										
										<form role="form" class="centerAlign formSize" id="form_story" name="form_story" method="POST" enctype="multipart/form-data" action="validate_story.php; return false;">
											<div class="form-group textInCent">
												<label for="title_story">Title:</label>
												<input type="text" class="form-control" id="title_story" name="title_story">
											</div>
											<div class="form-group textInCent">
												<label for="desc_story">Short Description:</label>
												<input type="text" class="form-control" id="desc_story" name="desc_story">
											</div>
											<div class="form-group textInCent">
												<label for="story">Story:</label>
												<input type="text" class="form-control" id="story_story" name="story_story" style="height:100px;">
											</div>
											<div class="form-group textInCent">
												<label for="image_story">Image:</label>
												<input type="file" class="form-control" id="image_story" name="image_story">
												</br>
												<!--<div class="thumbnail">
													<div class="image">
														<img id="prevImagePost_story" class="prevImageSmall"/>
													</div>
												</div>-->
											</div>
											<span id="errorMsg_story"></span><br/><br/>
											<button type="submit" class="btn btn-default" id="submit_story" name="submit_story">Create!</button>
										</form>
									</div>
								</div>
								
								<div id="event" class="tab-pane fade">
									<div class="item fixedSize">
										</br>
										<h1 class="text-center">Create an Event</h1>
										<hr>
										
										<form role="form" class="centerAlign formSize" id="form_event" name="form_event" method="POST" enctype="multipart/form-data" action="validate_event.php; return false;">
											<div class="form-group textInCent">
												<label for="name_event">Event Name:</label>
												<input type="text" class="form-control" id="name_event" name="name_event">
											</div>
											<div class="form-group textInCent">
												<label for="desc_event">Description:</label>
												<input type="text" class="form-control" id="desc_event" name="desc_event">
											</div>
											<div class="form-group textInCent">
												<label for="location_event">Location:</label>
												<input type="text" class="form-control" id="location_event" name="location_event">
											</div>
											<div class="form-group textInCent">
												<label for="start_D_event">Start Date:</label>
												<input type="date" class="form-control" id="start_D_event" name="start_D_event">
											</div>
											<div class="form-group textInCent">
												<label for="start_T_event">Start Time:</label>
												<input type="time" class="form-control" id="start_T_event" name="start_T_event">
											</div>
											<div class="form-group textInCent">
												<label for="end_D_event">End Date:</label>
												<input type="date" class="form-control" id="end_D_event" name="end_D_event">
											</div>
											<div class="form-group textInCent">
												<label for="start_T_event">End Time:</label>
												<input type="time" class="form-control" id="end_T_event" name="end_T_event">
											</div>
											<div class="form-group textInCent">
												<label for="workgroups">Workgroups required:</label>
												<?php
													include 'dbconfig.php'; //connects to db
													
													$sql = "SELECT DISTINCT workgroup FROM workgrouptypes"; 
													$test = $conn->query($sql);
													while ($row = $test->fetch_assoc())
													{
														echo '<input type="checkbox" class="form-control workgroups" name="workgroups" value="'.$row["workgroup"].'">'.$row["workgroup"].'</input>';
														echo '<br/>';
														//echo $row["type"];
													}
												?>
											</div>
											<div class="form-group textInCent">
												<label for="image_event">Event Image:</label>
												<input type="file" class="form-control" id="image_event" name="image_event">
												</br>
												<!--<div class="thumbnail">
													<div class="image">
														<img id="prevImagePost_event" class="prevImageSmall"/>
													</div>
												</div>-->
											</div>
											<span id="errorMsg_event"></span><br/><br/>
											<button type="submit" class="btn btn-default" id="submit_event" name="submit_event">Create!</button>
										</form>
									</div>
								</div>
								
								<div id="news" class="tab-pane fade">
									<div class="item fixedSize">
										</br>
										<h1 class="text-center">Create News</h1>
										<hr>
										
										<form role="form" class="centerAlign formSize" id="form_news" name="form_news" method="POST" enctype="multipart/form-data" action="validate_news.php; return false;">
											<div class="form-group textInCent">
												<label for="title_news">Title:</label>
												<input type="text" class="form-control" id="title_news" name="title_news">
											</div>
											<div class="form-group textInCent">
												<label for="news">News:</label>
												<input type="text" class="form-control" id="news_news" name="news">
											</div>
											<div class="form-group textInCent">
												<label for="link_news">Link:</label>
												<input type="URL" class="form-control" id="link_news" name="link_news">
											</div>
											<div class="form-group textInCent">
												<label for="image_news">News Image:</label>
												<input type="file" class="form-control" id="image_news" name="image_news">
												</br>
												<!--<div class="thumbnail">
													<div class="image">
														<img id="prevImagePost_news" class="prevImageSmall"/>
													</div>
												</div>-->
											</div>
											<span id="errorMsg_news"></span><br/><br/>
											<button type="submit" class="btn btn-default" id="submit_news" name="submit_news">Create!</button>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
			</div>
			
		<!-- Scripts -->
			<script src="../assets/js/jquery.min.js"></script>
			<script src="../assets/js/skel.min.js"></script>
			<script src="../assets/js/util.js"></script>
			<!--[if lte IE 8]><script src="../assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="../assets/js/main.js"></script>
			<script type="text/javascript" src="../bootstrap-3.3.4-dist/js/bootstrap.min.js"></script>
			<script type="text/javascript" src="js_validate_event.js"></script>
			<script type="text/javascript" src="js_validate_news.js"></script>
	</body>
</html>