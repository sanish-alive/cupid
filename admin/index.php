<?php
session_start();

require_once $_SERVER['DOCUMENT_ROOT']."/cupid/controller/userAuth.php";

if(isset($_SESSION['adminAuth']) && $_SESSION['admin']="true" && isset($_COOKIE['authAdmin']) && $_COOKIE['authAdmin']=="true"){
	header("location: adminPage.php");
}

if($_SERVER['REQUEST_METHOD']=="POST"){
	if(isset($_POST['submit'])){
		$email = $_POST['email'];
		$pwd = $_POST['pwd'];
		echo $pwd;
		$a = new UserAuthentication();
		if($a->adminAuth($email, $pwd)){
			$_SESSION['email'] = $email;
			$_SESSION['adminAuth'] = 'true';
			echo $email;
			setcookie('adminAuth', 'true', time()+3000);
			setcookie('email', $email, time());

			header("location: adminPage.php");

		}else{
			echo "<script>alert('Invalid Input')</script>";
		}
	}
}

?>



<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Admin</title>
	<style type="text/css">
		*{
			margin: 0;
			padding: 0;
			font-family: sans-serif;
		}

		h1{
			text-align: center;
			color: #ff4584;
		}

		body{
			background-color: #7762aa;
		}

		tr input{
			margin: 5px;
			height: 20px;
		}

		.center{
			position: absolute;
			top: 50%;
			left: 50%;
			transform: translate(-50%, -50%);
		}

		#sbm{
			border: none;
			background-color: #ff4584;
			color: white;
			height: 30px;
			width: 80px;
		}

		
	</style>
</head>
<body>

<div class='center'>
	<h1>Admin Login</h1><hr>
	<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method='post'>
		<table>
			<tr>
				<td style="color: #ff4584"><b>Email</b></td>
				<td><input type="text" name="email"></td>
			</tr>
			<tr>
				<td style="color: #ff4584"><b>Password</b></td>
				<td><input type="password" name="pwd"></td>
			</tr>
			<tr>
				<td></td>
				<td  style="float: right;"><input id="sbm" type="submit" name="submit"></td>
			</tr>
		</table>
		
	</form>
</div>

</body>
</html>