<?php
	if(session_status()==PHP_SESSION_NONE)
	{
		session_start();
	}
	
	include 'redirectLS.php';
	
	$_SESSION["failed1"] = false;
	$_SESSION["failed2"] = false;
	$message = "The Email Address you entered is in use. Please use another Email Address.";
	$message2 = "The username you entered is in use. Please choose a different username.";

	if(isset($_POST["submits"]))
	{
		signupUser();
	}

	function signupUser()
	{
		include 'dbconfig.php';

		$user = $_POST['usernames'];
		$email = $_POST['email'];
		$pass = $_POST['passwords'];
		$pass = hash("sha256", $pass);


		$sql = $conn->prepare("SELECT * FROM members WHERE email=?");
		$sql->bind_param("s", $email);
		$sql->execute();
		$result = $sql->get_result();

		if(mysqli_num_rows($result) > 0) //the email is in database
		{
			$_SESSION["failed1"] = true;
		} else
		{
			$sql2 = $conn->prepare("SELECT * FROM members WHERE username=?");
			$sql2->bind_param("s", $user);
			$sql2->execute();
			$result2 = $sql2->get_result();

			if(mysqli_num_rows($result2) > 0) //the email is in database
			{
				$_SESSION["failed2"] = true;
			} else
			{
				// session_start();
				$sql = $conn->prepare("INSERT INTO members(username ,email, password,image) VALUES (?,?,?,'images/profiles/unknown.png')");
				$sql->bind_param("sss", $user,$email,$pass);
				$sql->execute();


				$sql = $conn->prepare("SELECT * FROM members WHERE email=?");
				$sql->bind_param("s", $email);
		        $sql->execute();
		        $result = $sql->get_result();

				while($row = $result->fetch_assoc())
				{
					$id_v = $row["ID"];
				}


				$_SESSION['userId'] = $id_v;
				$_SESSION['sessionId'] = session_id();

				header('Location: ../index.php');
			}
		}

		mysqli_close($conn);

	}

?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>South African NPO - Login</title>
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
		<div id="wrapper">

			<header id="header">
				<h1><a href="../index.php">Fireflies</a></h1>
				<nav class="links">
					<ul>
						<li><a href="about.php">About us</a></li>
						<li><a href="events.php">Events</a></li>
						<li><a href="stories.php">Stories</a></li>
						<li><a href="news.php">News</a></li>
						<li><a href="signup.php">Become a Member</a></li>
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
						<li>
							<a href="signup.php">
								<h3>Become a member</h3>
								<p>Join us today in helping the people who need it most</p>
							</a>
						</li>
					</ul>
				</section>

				<!-- Actions -->
				<section>
					<form method="post" action="login.php" onsubmit="return validateLogin()">
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

			<div id="main">
				<form method="post" action="signup.php" onsubmit="return validateSignup()">
					<h1>Signup</h1>

					<label for="username">Username: </label>
					<input type="text" name="usernames" id="usernames" class="SUinput"
						<?php
							if(isset($_POST["submits"]))
							{
								if(!$_SESSION["failed2"])
								{
									echo "value='" . $_POST['usernames'] . "'";
								}
							}
						?>
					/><br/>

					<label for="email">Email: </label>
					<input type="email" name="email" id="email" class="SUinput"
						<?php
							if(isset($_POST["submits"]))
							{
								if(!$_SESSION["failed1"])
								{
									echo "value='" . $_POST['email'] . "'";
								}
							}
						?>
					/><br/>

					<label for="password">Password: </label>
					<input type="password" name="passwords" id="passwords" class="SUinput"/><br/>

					<label for="password">Confirm Password: </label>
					<input type="password" id="passwordC" class="SUinput"/><br/>

					<?php
						if(isset($_POST["submits"]))
						{
							if(!$_SESSION["failed1"])
							{
								echo "<h4>$message2</h4>";
							}

							if(!$_SESSION["failed2"])
							{
								echo "<h4>$message</h4>";
							}
						}
					?>

					<input type="submit" name="submits" value="Signup">
				</form>

				<a href="login.php" class="button big fit">Already a member - log in</a>
			</div>
		</div>


		<!-- Scripts -->
		<script src="../assets/js/jquery.min.js"></script>
		<script src="../assets/js/skel.min.js"></script>
		<script src="../assets/js/util.js"></script>
		<script src="../assets/js/signup.js"></script>
		<script src="../assets/js/login.js"></script>
		<!--[if lte IE 8]>
		<script src="../assets/js/ie/respond.min.js"></script><![endif]-->
		<script src="../assets/js/main.js"></script>
	</body>
</html>