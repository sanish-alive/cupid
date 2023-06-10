<?php
session_start();
if(isset($_GET['logout'])){
	session_unset();
	session_destroy();
	setcookie('adminAuth', null, time()-86400, "/admin", "");
	setcookie('email', null, time()-86400, "/admin", "");
	setcookie('PHPSESSID', null, time()-86400, "/", "");
	header("location: index.php");
}


