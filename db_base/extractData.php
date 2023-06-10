<?php

require_once $_SERVER['DOCUMENT_ROOT']."/cupid/db_base/connect-db.php";



class ExtractData{
	/*This class will extract data from database.*/

	

	function extAll($email){
		/* this function all data stored in database*/

		global $conn;

		$query = "SELECT * FROM user_tb WHERE email='$email'";
		$retval = mysqli_query($conn, $query);
		$data = mysqli_fetch_array($retval);
		return $data;
	}

	function extEmlPwd($email, $pwd){
		/*it will extract email and password form database*/

		global $conn;

		$query = "SELECT email, pass, block FROM user_tb WHERE email='$email' AND pass='$pwd'";
		$retval = mysqli_query($conn, $query);
		$data = mysqli_fetch_array($retval);
		return $data;

	}


	function extOldSession($email){
		/* this function will extract old session id from database*/

		global $conn;

		$query = "SELECT oldSession FROM user_tb WHERE email='$email'";

		$retval = mysqli_query($conn, $query);
		$data = mysqli_fetch_array($retval);
		if($data){
			return $data;
		}
	}


	function extUserId($email){

		global $conn;

		$query = "SELECT userid FROM user_tb WHERE email='$email'";
		$retval = mysqli_query($conn, $query);
		$data = mysqli_fetch_array($retval);
		return $data['userid'];

	}

	function extEmail($email){
		/* this function extract email from database*/

		global $conn;

		$query = "SELECT email FROM user_tb WHERE email='$email'";
		$retval = mysqli_query($conn, $query);
		$data = mysqli_fetch_array($retval);
		if($data){
			return true;
		}else{
			return false;
		}

	}

	function extAlreadyVisited($email){

		/*this function will extract alreadyvisited user*/

		global $conn;

		$query = "SELECT alreadyvisited FROM user_tb WHERE email='$email'";



		$retval = mysqli_query($conn, $query);

		$data = mysqli_fetch_array($retval);
		return $data;

	}


	function extImages($user_id){
		/* this function will extract images */
		global $conn;

		$query = "SELECT userid, image1, image2, image3, image4, image5 FROM user_img WHERE userid = '$user_id'";

		$retval = mysqli_query($conn, $query);

		$data = mysqli_fetch_array($retval);

		return $data;
	}


	function extFeed($opgender, $wantvisit, $age){
		/* this function is provided to show in feed section*/

		global $conn;

		$min_age = $age - 5;
		$max_age = $age + 5;

		$query = "SELECT firstname, lastname, age, gender, height, bio, userid, profileImg FROM user_tb WHERE gender='$opgender' AND userid='$wantvisit' AND age BETWEEN $min_age AND $max_age";


		$retval = mysqli_query($conn, $query);

		$data = mysqli_fetch_array($retval);

		return $data;

	}


	function extMyMatch($userid){
		global $conn;

		$query = "SELECT * FROM user_match WHERE (user1='$userid' OR user2='$userid') AND matches = 'matched'";

		$retval = mysqli_query($conn, $query);

		#$data = mysqli_fetch_array($retval);

		return $retval;

	}

	function extMatchId($matchid){
		/* this function all data stored in database*/

		global $conn;

		$query = "SELECT * FROM user_tb WHERE userid='$matchid'";
		$retval = mysqli_query($conn, $query);
		$data = mysqli_fetch_array($retval);
		return $data;
	}


}



?>