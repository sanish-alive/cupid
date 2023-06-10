<?php

session_start();
require_once $_SERVER['DOCUMENT_ROOT']."/cupid/db_base/connect-db.php";


if(!isset($_SESSION['adminAuth']) && $_SESSION['admin
	']!="true" ){
	header("location: index.php");
}


if($_SERVER['REQUEST_METHOD']=="GET"){
	if(!isset($_GET['userid']) or $_GET['userid']==""){
		header("location: adminPage.php");
	}
}

$userid = $_GET['userid'];

if($_SERVER['REQUEST_METHOD']=="POST"){
	if(isset($_POST['submit'])){
		$query1 = "DELETE FROM user_tb WHERE userid = '$userid'";
		$query2 = "DELETE FROM user_img WHERE userid = '$userid'";
		$query3 = "DELETE FROM user_match WHERE user1 = '$userid' OR user2 ='$userid'";
		if(mysqli_query($conn, $query1) && mysqli_query($conn, $query2) && mysqli_query($conn, $query3)){
			header("location: adminPage.php");
		}
	}
}



?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="css" href="styleadmin.css">
	<link rel="stylesheet" type="text/css" href="../templates/css/profile.css">
	<title>Admin</title>
</head>
<body>

<!--<div class="navbar">
	<a id="navlogo" href="">Cupid</a>
	<a href="adminLogout.php">Logout</a>
	<a href="adminPage.php">Home</a>
</div>-->

<center>
	<div class="edit_profile">
		<h1>Delete Account</h1>
		<form action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
			<table>
					<td colspan="2"><p>Are you sure you want to delete User Id <?php echo $userid; ?></p><input type="submit" name="submit" value="Yes">
					</td>
				</tr>
			</table>
		</form>
	</div>
</center>


</body>
</html>

