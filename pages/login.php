<?php
	if(session_status()==PHP_SESSION_NONE)
	{
		session_start();
	}

	$failed = false;
	if(isset($_POST["submit"]) || isset($_POST["hidden"]))
	{
		//echo"working";
		loginUser();
	}

	function loginUser()
	{
		//echo "in";
		include 'dbconfig.php';

		$user = $_POST['username'];
		$pass = $_POST['password'];



		$sql = "SELECT * FROM members WHERE username='$user' AND password ='$pass'";
		$result = mysqli_query($conn, $sql);

		if(mysqli_num_rows($result) > 0)
		{
			echo"in";
			session_start();
			while($row = $result->fetch_assoc())
			{
				$id_v = $row["id"];
				$admin = $row["admin"];
			}

			$_SESSION['userId'] = $id_v;
			$_SESSION['sessionId'] = session_id();

			if($admin)
			{
				header('Location: admin.php');
			}
			else
			{
				header('Location: ../index.php');
			}

		} else
		{
			$failed = true;
		}
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
				<h1><a href="../index.php">South African NPO</a></h1>
				<nav class="links">
					<ul>
						<li><a href="#">About us</a></li>
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
							<a href="#">
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

				<form method="post" action="login.php" onsubmit="return validateLogin2()">
					<h1>Log in</h1>
					<label for="username">Username: </label>
					<input type="text" name="username" id="username" class="Linput2"
						<?php
							if(isset($_POST["submit"]))
							{
								if(!$failed)
								{
									echo "value='" . $_POST['username'] . "'";
								}
							}
						?>
					/><br/>

					<label for="password">Password: </label>
					<input type="password" name="password" id="password" class="Linput2"/><br/>

					<?php
						if(isset($_POST["submit"]))
						{
							if(!$failed)
							{
								echo "<h4>The Username and Password you entered do not match</h4>";
							}
						}
					?>
					<input type="submit" name="submit" value="Log in">
				</form>

				<a href="signup.php" class="button big fit">Not a member yet - Register</a>


			</div>
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