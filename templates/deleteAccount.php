<?php
require "profile.php";
require  $_SERVER['DOCUMENT_ROOT']."/cupid/db_base/connect-db.php";
require_once  $_SERVER['DOCUMENT_ROOT']."/cupid/controller/userAuth.php";

$pinvalid = "";

if($_SERVER['REQUEST_METHOD']=="POST"){
	if(isset($_POST['submit']) && isset($_POST['delete'])){

		$email = $_SESSION['email'];
		$pwd = md5($_POST['delete']);
		$a = new UserAuthentication();
		if($a->loginAuth($email, $pwd)){

			$email = $_SESSION['email'];
			$sessid = $_COOKIE['oldSession'];

			$query = "DELETE FROM user_tb WHERE email='$email' AND oldSession='$sessid'";

			if(mysqli_query($conn, $query)){
				session_unset();
				session_destroy();
				setcookie("auth", null, time()-86400, "/login", "");
				setcookie('email', null, time()-86400, "/login", "");
				setcookie('oldSession', null, time()-86400, "/login", "");
				header("location: ../index.php");
			}
		}
		else{
			$pinvalid = "Incorrect Password";
		}
	}
}

?>

<article>
	<div class="edit_profile">
		<h1>Delete Account</h1>
		<form action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
			<table>
				<tr>
					<label>
						<td>Password:</td>
						<td><input type="password" name="delete" placeholder="<?php echo $pinvalid; ?>"></td>
					</label>
				</tr>
				<tr>

					<td colspan="2"><p>Are you sure you want to delete your account?</p><input type="submit" name="submit" value="Yes">

					</td>
				</tr>
			</table>
		</form>
	</div>
</article>
</section>
</body>
</html>