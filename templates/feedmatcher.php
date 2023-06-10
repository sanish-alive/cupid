<?php
session_start();

if(!isset($_SESSION['loggedIn']) && $_SESSION['loggedIn']!="true" && !isset($_COOKIE['auth']) && $_COOKIE['auth']!="true"){
	header("location: ../index.php");
}


require $_SERVER['DOCUMENT_ROOT']."/cupid/db-base/connect-db.php";


if($_SERVER["REQUEST_METHOD"]=="GET"){
	if(isset($_GET['matchid'])){
		$matchid = $_GET['matchid'];
		$userid = $_SESSION['userid'];
		echo $userid;

		$query = "SELECT * FROM user_match WHERE user1='$matchid' AND user2 = '$userid'";
		$retval = mysqli_query($conn, $query);
		$data = mysqli_fetch_array($retval);
		if(isset($data)){
			$query = "UPDATE user_match SET matches='matched' WHERE user1='$matchid' AND user2 = '$userid'";
			echo $matchid;
			if($r = mysqli_query($conn, $query)){
				echo "hello";
			}else{
				echo mysqli_error($conn);
			}
		}
		else{
			$query = "SELECT * FROM user_match WHERE user1='$userid' AND user2 = '$matchid'";
			$retvall = mysqli_query($conn, $query);
			$data = mysqli_fetch_array($retvall);
			if(!isset($data)){
				$query = "INSERT INTO user_match(user1, user2) VALUES ('$userid', '$matchid')";
				mysqli_query($conn, $query);
			}
		}
	}
}