<?php
session_start();

if(!isset($_SESSION['loggedIn']) && $_SESSION['loggedIn']!="true" && !isset($_COOKIE['auth']) && $_COOKIE['auth']!="true"){
	header("location: ../index.php");
}


echo $_SESSION['loggedIn'];
?>

<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/profile.css">
	<link rel="stylesheet" type="text/css" href="css/extraa.css">
	<title>Profile</title>
</head>
<body>

	<!-- navigation bar -->
	<div class="navbar">
		<a id="navlogo" href="#">Cupid</a>
		<a href="logout.php">Logout</a>
		<a href="myMatch.php">My Match</a>
		<a href="myProfile.php">Profile</a>
		<a href="feed.php">Feed</a>
	</div>

	<section>
		<nav>
			<div class="proNav">
				<ul>
					<li><h1>Profile</h1></li>
					<li><a href="myProfile.php">My Profile</a></li>
					<li><a href="myMatch.php">My Match</a></li>
					<li><a href="editProfile.php">Edit Profile</a></li>
					<li><a href="changePassword.php">Change Password</a></li>
					<li><a href="manageImage.php">Manage Images</a></li>
					<li><a href="deleteAccount.php">Delete Account</a></li>
					<li><a href="logout.php">logout</a></li>
				</ul>
			</div>
		</nav>
