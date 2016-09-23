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
						
						<div class="container">
							<ul class="nav nav-tabs">
								<li class="active"><a data-toggle="tab" href="#story">Story</a></li>
								<li><a data-toggle="tab" href="#event">Event</a></li>
								<li><a data-toggle="tab" href="#news">News</a></li>
								<li><a data-toggle="tab" href="#files">Files</a></li>
								<li><a data-toggle="tab" href="#workgroup">Workgroups</a></li>
								<li><a data-toggle="tab" href="#member">Members</a></li>
								<li><a data-toggle="tab" href="#message">Messages</a></li>
								<!--<li><a data-toggle="tab" href="#menu4">Friend Requests</a></li>
								<li><a data-toggle="tab" href="#menu5" id="msgTab">Messages</a></li>-->
							</ul>
						
							<div class="tab-content">

								<div id="story" class="tab-pane fade in active v">
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
													
													$sql = $conn->prepare("SELECT DISTINCT workgroup FROM workgrouptypes"); 
													// $sql->bind_param("ss", $user, $pass);
											        $sql->execute();
											        $test = $sql->get_result();
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
								
								<div id="files" class="tab-pane fade">
									<div class="item fixedSize">
										</br>
										<h1 class="text-center">Store and download official files, documents and music here</h1>
										<hr>
										
										<form role="form" class="centerAlign formSize" id="form_files" name="form_files" method="POST" enctype="multipart/form-data" action="validate_files.php; return false;">
											<div class="form-group textInCent">
												<label for="type_files">Type:</label>
												<input type="text" class="form-control" id="type_files" name="type_files">
											</div>
											<div class="form-group textInCent">
												<label for="name_files">Name:</label>
												<input type="text" class="form-control" id="name_files" name="name_files">
											</div>
											<div class="form-group textInCent">
												<label for="file_files">Upload File:</label>
												<input type="file" class="form-control" id="file_files" name="file_files">
												</br>
											</div>
											<span id="errorMsg_files"></span><br/><br/>
											<button type="submit" class="btn btn-default" id="submit_files" name="submit_files">Save!</button>
										</form>
										<br/>
										<h1 class="text-center">Files currently stored</h1>
										<hr>
										<div class="container">
											<?php
												
												include 'dbconfig.php';
												
												$sql = $conn->prepare("SELECT * FROM officialfiles"); 
												// $sql->bind_param("ss", $user, $pass);
										        $sql->execute();
										        $test = $sql->get_result();
												while ($row = $test->fetch_assoc())
												{
													$fileID = $row["id"];
													$fileType = $row["type"];
													$fileName = $row["name"];
													$filePath = $row["filePath"];
													$fileDate = $row["dateUploaded"];
													
													//<a href="download.php?file='.$filePath.'">Download</a>
													
													echo '<h6>'.$fileName.'</h6><span>Uploaded on: '.$fileDate.'     </span><a href=".'.$filePath.'" download="'.$fileName.'">Download</a>';
													echo '<br/>';
													echo '<br/>';
												}
												
											?>
										</div>
									</div>
								</div>

								<div id="message" class="tab-pane fade">
									<div class="item fixedSize">
										<ul class="nav nav-tabs">
											<li class="active"><a data-toggle="tab" href="#indi">Individual</a></li>
											<li><a data-toggle="tab" href="#wg">Work Group</a></li>
											<li><a data-toggle="tab" href="#eventM">Event Team</a></li>
										</ul>

										<div class="tab-content">

											<div id="indi" class="tab-pane fade in active">
												</br>
												<h1 class="text-center">Send a Message to an Individual</h1>
												<hr>

												<form role="form" class="centerAlign formSize" id="form_iMessage" name="form_iMessage" method="POST" enctype="multipart/form-data" action="#">

													<div class="form-group textInCent">
														<label for="to">Recipient:</label>
														<select class="form-control" id="userSelect">
															<option value="Recipient" disabled selected>Please Select Recipient</option>
															<?php
																$sql = "SELECT username,id FROM members";
																$result = mysqli_query($conn, $sql);
																$name = "";
																$id=0;
																while($row = $result->fetch_assoc())
																{
																	$name = $row["username"];
																	$id = $row["id"];
																	echo"<option value='$id'>$name</option>";
																}
																echo "\n \n Kind Regards \n $name"
															?>
														</select>

													</div>

													<div class="form-group textInCent">
														<label for="subjI">Subject:</label>
														<input type="text" class="form-control" id="subjI" name="subjI">
													</div>
													<div class="form-group textInCent">
														<label for="bodyI">Message</label>
														<textarea rows="4" cols="10" placeholder="Message" class="form-control" id="bodyI" name="bodyI">
															<?php
																$uid=$_SESSION['userId'];
																$sql = $conn->prepare("SELECT username FROM members WHERE id=?");
																$sql->bind_param("i", $uid);
														        $sql->execute();
														        $result = $sql->get_result();
																$name = "";
																while($row = $result->fetch_assoc())
																{
																	$name = $row["username"];
																}
																echo "\n \n Kind Regards \n $name"
															?>
														</textarea>
													</div>

													<span id="errorMsg_iMessage"></span><br/><br/>
													<button type="submit" class="btn btn-default" id="iMessage" name="iMessage">Send!</button>
												</form>
											</div>




											<div id="wg" class="tab-pane fade">
												</br>
												<h1 class="text-center">Send a Message to a Work Group</h1>
												<hr>

												<form role="form" class="centerAlign formSize" id="form_wgMessage" name="form_wgMessage" method="POST" enctype="multipart/form-data" action="#">

													<div class="form-group textInCent">
														<label>Recipient:</label>
														<?php
															$sql = "SELECT id, workgroup FROM workgrouptypes";
															$result = mysqli_query($conn, $sql);
															$name = "";
															$id=0;
															while($row = $result->fetch_assoc())
															{
																$name = $row["workgroup"];
																$id = $row["id"];
																echo"<input class='WGTeams' type='radio' name='workgroup' value='$id'/>$name<br>";
															}
														?>
													</div>

													<div class="form-group textInCent">
														<label for="subjW">Subject:</label>
														<input type="text" class="form-control" id="subjW" name="subjW">
													</div>
													<div class="form-group textInCent">
														<label for="bodyW">Message</label>
														<textarea rows="4" cols="10" placeholder="Message" class="form-control" id="bodyW" name="bodyW">
															<?php
																$uid=$_SESSION['userId'];
																$sql = $conn->prepare("SELECT username FROM members WHERE id=?");
																$sql->bind_param("i", $uid);
														        $sql->execute();
														        $result = $sql->get_result();
																$name = "";
																while($row = $result->fetch_assoc())
																{
																	$name = $row["username"];
																}
																echo "\n \n Kind Regards \n $name"
															?>
														</textarea>
													</div>

													<span id="errorMsg_wMessage"></span><br/><br/>
													<button type="submit" class="btn btn-default" id="wgMessage" name="wgMessage">Send!</button>
												</form>
											</div>


											<div id="eventM" class="tab-pane fade">
												</br>
												<h1 class="text-center">Send a Message to an Event Team</h1>
												<hr>

												<form role="form" class="centerAlign formSize" id="form_eMessage" name="form_eMessage" method="POST" enctype="multipart/form-data" action="#">

													<div class="form-group textInCent">
														<label for="eventSelect">Event:</label>
														<select class="form-control" id="eventSelect" name="eventSelect">
															<option value="event" disabled selected>Please Select Event</option>
															<?php
																$sql = "SELECT eventName,startDateTime,endDateTime,id FROM events";
																$result = mysqli_query($conn, $sql);
																$name = "";
																$id=0;
																$endDate;
																$startDate;
																while($row = $result->fetch_assoc())
																{
																	$name = $row["eventName"];
																	$id = $row["id"];
																	$endDate = $row["endDateTime"];
																	$startDate = $row["startDateTime"];
																	echo"<option class='eventOptions' value='$id'>$name ($startDate - $endDate)</option>";
																}
															?>
														</select>
														<label>Team:</label>
														<?php
															$sql = "SELECT id, workgroup FROM workgrouptypes";
															$result = mysqli_query($conn, $sql);
															$name = "";
															$id=0;
															while($row = $result->fetch_assoc())
															{
																$name = $row["workgroup"];
																$id = $row["id"];
																echo"<input class='EventTeams' type='radio' name='EventTeams' value='$id'/>$name<br>";
															}
														?>


													</div>

													<div class="form-group textInCent">
														<label for="subj">Subject:</label>
														<input type="text" class="form-control" id="subjE" name="subj">
													</div>

													<div class="form-group textInCent">
														<label for="bodyE">Message</label>
														<textarea rows="4" cols="10" placeholder="Message" class="form-control" id="bodyE" name="bodyE">
															<?php
																$uid=$_SESSION['userId'];
																$sql = $conn->prepare("SELECT username FROM members WHERE ?");
																$sql->bind_param("i", $uid);
														        $sql->execute();
														        $result = $sql->get_result();
																$name = "";
																while($row = $result->fetch_assoc())
																{
																	$name = $row["username"];
																}
																echo "\n\nKind Regards\n$name";
															?>
														</textarea>
													</div>

													<span id="errorMsg_eMessage"></span><br/><br/>
													<button type="submit" class="btn btn-default" id="eMessage" name="eMessage">Send!</button>
												</form>
											</div>
										</div>
									</div>
								</div>

								<div id="member" class="tab-pane fade">
									<div class="item active fixedSize">
										</br>
										<h1 class="text-center">Manage Members</h1>
										<hr>

										<form role="form" class="centerAlign formSize" id="form_members" name="form_members" method="POST" enctype="multipart/form-data" action="#">

											<select class="form-control" id="memberSelect" name="memberSelect">
												<option value="event" disabled selected>Please Select Member</option>
												<?php
													$sql = "SELECT id,username FROM members";
													$result = mysqli_query($conn, $sql);
													$name = "";
													$id=0;
													while($row = $result->fetch_assoc())
													{
														$name = $row["username"];
														$id = $row["id"];
														echo"<option class='eventOptions' value='$id'>$name</option>";
													}

												?>
											</select>
											<br/>
												<?php
													$sql = "SELECT id,username,admin FROM members";
													$result = mysqli_query($conn, $sql);
													$name = "";
													$id=0;
													while($row = $result->fetch_assoc())
													{
														$name = $row["username"];
														$id = $row["id"];
														$admin = $row["admin"];
														$divID = $id . "div";
														//echo $divID;
														echo "
														<div id='$divID' class='hideDivs'>
															<h2>$name</h2>
														";
														$adminID = $id."isAdmin";
														if($admin)
														{
															echo"<input class='isAdmin' type='checkbox' name='isAdmin' id='$adminID' value='$id' checked/>admin<br>";
														}
														else
														{
															echo"<input class='isAdmin' type='checkbox' name='isAdmin' id='$adminID' value='$id'/>admin<br>";
														}

														$sql2 = $conn->prepare("SELECT typeID FROM workgroups WHERE userID = ?");
														$sql2->bind_param("i", $id);
														$sql2->execute();
														$result2 = $sql2->get_result();
														$memberID = $id."memberTeamSelect";
														echo "<select class='form-control' id='$memberID' name='memberTeamSelect'>";

														if(mysqli_num_rows($result2) > 0)
														{
															echo "<option class='memberTeamOptions' value='none' disabled>Select a workgroup</option>";

															while($row2 = $result2->fetch_assoc())
															{
																$typeID = $row2["typeID"];

																$sql3 = "SELECT workgroup,id FROM workgrouptypes";
																$result3 = mysqli_query($conn, $sql3);

																while($row3 = $result3->fetch_assoc())
																{
																	$grouptype = $row3["workgroup"];
																	$groupID = $row3["id"];
																	if($row3["id"] == $typeID)//if it is their currently active group
																	{
																		echo "<option class='memberTeamOptions' value='$groupID' selected>$grouptype</option>";
																	}
																	else
																	{
																		echo "<option class='memberTeamOptions' value='$groupID'>$grouptype</option>";
																	}

																}


															}
														}
														else
														{
															echo "<option class='memberTeamOptions' value='none' selected disabled>Select a workgroup</option>";
															$sql3 = "SELECT workgroup,id FROM workgrouptypes";
															$result3 = mysqli_query($conn, $sql3);

															while($row3 = $result3->fetch_assoc())
															{
																$grouptype = $row3["workgroup"];
																$groupID = $row3["id"];
																echo "<option class='memberTeamOptions' value='$groupID'>$grouptype</option>";
															}
														}
														echo "</select>";
														echo"</div>";
													}

												?>


											<span id="errorMsg_story"></span><br/><br/>
											<button type="submit" class="btn btn-default" id="submit_Change" name="submit_Change">Update!</button>
										</form>
									</div>
								</div>

								<div id="workgroup" class="tab-pane fade">
									<div class="item fixedSize">
										</br>
										<h1 class="text-center">Add a workgroup</h1>
										<hr>
										<h3 class="centerAlign">Current Work Groups</h3>
										<ul class="centerAlign">
											<?php
												$sql = "SELECT workgroup FROM workgrouptypes ";
												$result = mysqli_query($conn, $sql);

												while($row = $result->fetch_assoc())
												{
													$wgName = $row["workgroup"];
													echo"<li  style='list-style: none;'>$wgName</li>";
												}
											?>
										</ul>
										<br>
										<form role="form" class="centerAlign formSize" id="form_workgroups" name="form_workgroups" method="POST" enctype="multipart/form-data" action="#">

											<div class="form-group textInCent">
												<label for="wgName" class="align-left">New Workgroup:</label>
												<input type="text" class="form-control" id="wgName" name="wgName">
											</div>
											<span id="errorMsg_news"></span><br/><br/>
											<button type="submit" class="btn btn-default" id="submit_workgroups" name="submit_workgroups">Add!</button>
										</form>
									</div>
								</div>

							</div>
						</div>
					</div>
			</div>
			
		<!-- Scripts -->


			<script src="../assets/js/jquery.min.js"></script>
			<script type="text/javascript" src="../bootstrap-3.3.4-dist/js/bootstrap.min.js"></script>
			<script src="../assets/js/skel.min.js"></script>
			<script src="../assets/js/util.js"></script>
			<!--[if lte IE 8]><script src="../assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="../assets/js/main.js"></script>
			<script type="text/javascript" src="../jquery-2.1.4.min.js"></script>
			<script type="text/javascript" src="js_validate_story.js"></script>
			<script type="text/javascript" src="js_validate_event.js"></script>
			<script type="text/javascript" src="js_validate_news.js"></script>
			<script type="text/javascript" src="js_validate_files.js"></script>
			<script type="text/javascript" src="../assets/js/validateMessages.js"></script>
			<script type="text/javascript" src="../assets/js/validateMembers.js"></script>

	</body>
</html>