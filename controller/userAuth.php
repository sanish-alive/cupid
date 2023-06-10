<?php
 require  $_SERVER['DOCUMENT_ROOT']."/cupid/db_base/connect-db.php";
 require_once  $_SERVER['DOCUMENT_ROOT']."/cupid/db_base/extractData.php";
 require_once  $_SERVER['DOCUMENT_ROOT']."/cupid/db_base/insertData.php";

class UserAuthentication{
	/*this class use for user authentication */
	function loginAuth($email, $pwd){
		/* this function is use for login authentication */
		
		$e = new ExtractData();
		$data = $e->extEmlPwd($email, $pwd);
		if(isset($data)){
			if($email==$data['email'] && $pwd==$data['pass'] && "blocked"!=$data['block']){
				return true;
			}
		}
		return false;
			
	}


	function sessionAuth($session_id, $email){
		/* this function authenticate user using session */
		$e = new ExtractData();
		$data = $e->extOldSession($email);
		echo $data['oldSession'];
		if($session_id == $data['oldSession']){
			return true;
			
		}
		return false;
		
	}


	function adminAuth($email, $pwd){

		global $conn;

		$query = "select * from admin_tb where email='$email' AND pwd='$pwd'";

		$retval = mysqli_query($conn, $query);

		$data = mysqli_fetch_array($retval);

		if($data['email']==$email && $data['pwd']==$pwd){
			return true;
		}
		return false;
	}
}



?>