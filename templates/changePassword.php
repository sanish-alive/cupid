<?php
require "profile.php";
 require_once  $_SERVER['DOCUMENT_ROOT']."/cupid/db_base/insertData.php";
  require_once  $_SERVER['DOCUMENT_ROOT']."/cupid/controller/userAuth.php";

$ninvalid = "";
$pinvalid = "";

if($_SERVER['REQUEST_METHOD']=="POST"){
	if(isset($_POST['submit']) && isset($_POST['pwd']) && isset($_POST['npwd'])){
		$email = $_SESSION['email'];
		$pwd = $_POST['pwd'];
		$npwd = $_POST['npwd'];
		$cpwd = $_POST['cpwd'];
		$ninvalid = "";
		$pinvalid = "";

		if($npwd==$cpwd){
			$pwd = md5($pwd);
			$a = new UserAuthentication();
			if($a->loginAuth($email, $pwd)){
				$b = new InsertData();

				if($b->insertPassword($email, md5($npwd))){
					session_destroy();
					session_destroy();
					setcookie("auth", null, time()-86400, "/login", "");
					setcookie('email', null, time()-86400, "/login", "");
					setcookie('oldSession', null, time()-86400, "/login", "");
					header("location: ../index.php");
				}
			}
			else{
				$error = 1;
				$pinvalid = "Incorrect Password";
			}
		}
		else{
			$ninvalid = "Does not match.";
		}
	}
}
?>

<article>
	<div class=edit_profile>
		<h1>Change Password</h1>
		<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
			<table>
				<tr>
					<label>
						<td>Password</td>
						<td><input type="password" name="pwd" placeholder="<?php echo $pinvalid; ?>"></td>
					</label>
				</tr>
				<tr>
					<label>
						<td>New Password</td>
						<td><input type="password" name="npwd" placeholder="<?php echo $ninvalid; ?>"></td>
					</label>
				</tr>
				<tr>
					<label>
						<td>Retype New Password</td>
						<td><input type="password" name="cpwd" placeholder="<?php echo $ninvalid; ?>"></td>
					</label>
				</tr>
				<tr>
					<td colspan="2"><input type="submit" name="submit">

					</td>
				</tr>
			</table>
		</form>
	</div>
</article>
