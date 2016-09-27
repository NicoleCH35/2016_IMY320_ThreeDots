<?php
	//if(session_status()==PHP_SESSION_NONE)
	//{
		session_start();
	//}
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

				<?php

					$commentsID = array();
					$comments = array();
					$commentsUser = array();
					$commentsDate = array();

					$sql = $conn->prepare("SELECT * FROM stories ORDER BY id DESC"); //finds stories
					// $sql->bind_param("ss", $user, $pass);
			        $sql->execute();
			        $test = $sql->get_result();

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

						$sql = $conn->prepare("SELECT * FROM members WHERE id = ?"); //finding the user
						$sql->bind_param("i", $userID);
				        $sql->execute();
				        $test2 = $sql->get_result();
						while($row2 = $test2->fetch_assoc())
						{
							$user = $row2['username'];
							$profile = $row2['image'];
						}

						$sql = $conn->prepare("SELECT * FROM comments WHERE storyID = ?"); //finding the comments
						$sql->bind_param("i", $postID);
				        $sql->execute();
				        $test2 = $sql->get_result();
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
						echo '<h2><span>' . $title . '</span></h2>';
						echo '<p>' . $desc . '</p>';
						echo '</div>';
						echo '<div class="meta">';
						echo '<time class="published" datetime="' . $date . '">' . $date . '</time>';
						echo '<span href="#" class="author"><span class="name">' . $user . '</span><img src=".' . $profile . '" alt="" /></span>';
						echo '</div>';
						echo '</header>';
						echo '<span class="image featured"><img src=".' . $image . '" alt="' . $desc . '" /></span>';
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
							$sql = $conn->prepare("SELECT admin FROM members WHERE id=?");
							$sql->bind_param("i", $uid);
					        $sql->execute();
					        $result = $sql->get_result();

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
									$sql = $conn->prepare("SELECT username FROM members WHERE id = ?"); //finding the comments
									$sql->bind_param("i", $commentsUser[$a]);
							        $sql->execute();
							        $test3 = $sql->get_result();
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
									$sql = "SELECT username FROM members WHERE id = ?"; //finding the comments
									$sql->bind_param("i", $commentsUser[$a]);
							        $sql->execute();
							        $test3 = $sql->get_result();
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

			<!-- Scripts -->
			<script src="../assets/js/jquery.min.js"></script>
			<script src="../assets/js/skel.min.js"></script>
			<script src="../assets/js/util.js"></script>
			<script src="../assets/js/login.js"></script>
			<script src="../assets/js/storiesLikes.js"></script>
			<!--[if lte IE 8]>
			<script src="../assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="../assets/js/main.js"></script>
	</body>
</html>