<?php
require_once $_SERVER['DOCUMENT_ROOT']."/cupid/controller/userAuth.php";
require_once  $_SERVER['DOCUMENT_ROOT']."/cupid/db_base/insertData.php";
require_once  $_SERVER['DOCUMENT_ROOT']."/cupid/db_base/extractData.php";

session_start();



if(isset($_COOKIE['auth']) && $_COOKIE['auth']=="true" && isset($_COOKIE['email']) && $_COOKIE['oldSession']){
	$old_session_id = $_COOKIE['oldSession'];
	if($_COOKIE['PHPSESSID'] == $_COOKIE['oldSession']){
		$email = $_COOKIE['email'];
		$b = new UserAuthentication();
		if($b->sessionAuth($old_session_id, $email)){
			$_SESSION['loggedIn'] = "true";
			$_SESSION['email'] = $email;
			$_SESSION['id'] = session_id();
			$g = new InsertData();
			$g->insertNewSession(session_id(), $email);
			$h = new ExtractData();
			$data = $h->extAll($email);
			$_SESSION['loggedIn'] = "true";
			$_SESSION['userid'] = $data['userid'];
			$_SESSION['email'] = $data['email'];
			$_SESSION['id'] = session_id();
			$_SESSION['firstname'] = $data['firstname'];
			$_SESSION['lastname'] = $data['lastname'];
			$_SESSION['gender'] = $data['gender'];
			$_SESSION['height'] = $data['height'];
			$_SESSION['bio'] = $data['bio'];
			$_SESSION['age'] = $data['age'];
			$_SESSION['profileImg'] = $data['profileImg'];
			$_SESSION['alreadyvisited'] = $data['alreadyvisited'];
			setcookie('auth', 'true', time()+3000);
			setcookie('email',$email,time()+3000);
			setcookie('oldSession',session_id(), time()+3000);
			header("location: templates/myProfile.php");
		}
	}
}


if($_SERVER["REQUEST_METHOD"]=="POST"){
	if(isset($_POST['submit'])){
		$email = $_POST['email'];
		$pass = $_POST['pass'];
		$pwd = md5($pass);
		$a = new UserAuthentication();
		if($a->loginAuth($email, $pwd)){
			$f = new InsertData();
			$f->insertNewSession(session_id(), $email);
			$g = new ExtractData();
			$data = $g->extAll($email);
			$_SESSION['loggedIn'] = true;
			$_SESSION['userid'] = $data['userid'];
			$_SESSION['email'] = $email;
			$_SESSION['id'] = session_id();
			$_SESSION['firstname'] = $data['firstname'];
			$_SESSION['lastname'] = $data['lastname'];
			$_SESSION['gender'] = $data['gender'];
			$_SESSION['height'] = $data['height'];
			$_SESSION['bio'] = $data['bio'];
			$_SESSION['age'] = $data['age'];
			$_SESSION['profileImg'] = $data['profileImg'];
			$_SESSION['alreadyvisited'] = $data['alreadyvisited'];
			setcookie('auth', 'true', time()+3000);
			setcookie('email',$email,time()+3000);
			setcookie('oldSession',session_id(), time()+3000);
			header("location: templates/myProfile.php");

		}
		else{
			echo "<script>alert('Invalid Input')</script>";
		}

	}
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="templates/css/styles.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
	<section>
		<div class="imgBx">
			<img src="bg.jpg">
			<div class="text-img">
				<h1><b>Welcome To Cupid</b></h1><br>
				<p>Find Your Partner</p>
			</div>
		</div>
		<div class="contentBx">
			<div class="formBx">
				<h2>Login</h2>
				<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
					<div class="inputBx">
						<span>Email</span>
						<input type="email" name="email">
					</div>
					<div class="inputBx">
						<span>Password</span>
						<div style="display: flex;">
							<input type="password" name="pass" id="pwd"><p id="eye" style="margin-left: -2em;margin-top: 1em;" onclick="return passhow()" class="fa fa-fw fa-eye"></p>
						</div>
					</div>
					
					<div class="inputBx">
						<input type="submit" value="Sign In" name="submit">
					</div>
					<div class="inputBx">
						<p>Don't have an account? <a href="templates/registrate.php">Sign up</a></p>
					</div>
				</form>
				<h3>Vist Our Social Media</h3>
				<ul class="sci">
					<li><i class="fa fa-facebook"></i></li>
					<li><i class="fa fa-twitter"></i></li>
					<li><i class="fa fa-instagram"></i></li>
				</ul>
			</div>
		</div>
		
	</section>


<script>
	function passhow(){
		var input = document.getElementById("pwd");
		if(input.type == "password"){
			input.type = "text";
			document.getElementById("eye").className = "fa fa-fw fa-eye-slash";
		}else{
			input.type = "password";
			document.getElementById("eye").className = "fa fa-fw fa-eye";
		}
	}
</script>

</body>
</html>
