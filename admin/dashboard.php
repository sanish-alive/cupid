<?php

session_start();


if(!isset($_SESSION['adminAuth']) && $_SESSION['admin']!="true" && !isset($_COOKIE['authAdmin']) && $_COOKIE['authAdmin']!="true"){
	header("location: index.php");
}


require_once $_SERVER['DOCUMENT_ROOT']."/cupid/db_base/connect-db.php";


$query = "SELECT COUNT(CASE WHEN gender='Male' THEN 1 END) AS male, 
		COUNT(CASE WHEN gender='Female' THEN 1 END) AS female,
		COUNT(CASE WHEN block='blocked' THEN 1 END) AS blocked,
		COUNT(*) AS total FROM user_tb";

$matchQuery = "SELECT COUNT(CASE WHEN matches='matched' THEN 1 END) AS userMatch FROM user_match";
$retval = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($retval);

$matchRetvel = mysqli_query($conn, $matchQuery);
$matchData = mysqli_fetch_assoc($matchRetvel);

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="styleadmin.css">
	<title>Admin</title>
</head>
<body>

<div class="navbar">
	<a id="navlogo" href="">Cupid</a>
	<a href="adminlogout.php?logout='1'">Logout</a>
	<a href="Dashboard.php">Dashboard</a>
</div>
<div class="search-container">
    <form action="/action_page.php" method="get">
      <input type="text" placeholder="Search.." name="search">
      <button type="submit">Submit</button>
    </form>
</div>
<div class="dashboard-main">
	<div onclick="location.href=`adminPage.php`">
		<p>Total User <?php echo $data['total'] ?></p>
	</div>
	<div onclick="location.href=`adminPage.php?type=male`">
		<p>Male <?php echo $data['male'] ?></p>
	</div>
	<div onclick="location.href=`adminPage.php?type=female`">
		<p>Female <?php echo $data['female'] ?></p>
	</div>
	<div onclick="location.href=`adminPage.php?type=block`">
		<p>Blocked <?php echo $data['blocked'] ?></p>
	</div>
</div>
<!-- <div class="dashboard-main">
	<div onclick="location.href=`adminPage.php?type=match`">
		<p>Match <?php echo $matchData['userMatch'] ?></p>
	</div>
	<div onclick="location.href=`adminPage.php?type=block`">
		<p>Blocked <?php echo $data['blocked'] ?></p>
	</div>
</div> -->


</body>
</html>