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

$query = "SELECT block FROM user_tb WHERE userid='$userid'";
$retval = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($retval);
if($data['block']=="blocked"){
	$query1 = "UPDATE user_tb SET block='block' WHERE userid='$userid'";
}else{
	$query1 = "UPDATE user_tb SET block='blocked' WHERE userid='$userid'";
}
if(mysqli_query($conn, $query1)){
	header('Location: '.$_SERVER['HTTP_REFERER']);
	exit();
}
?>