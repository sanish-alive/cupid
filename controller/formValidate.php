<?php
require $_SERVER['DOCUMENT_ROOT']."/cupid/db_base/connect-db.php";
require_once $_SERVER['DOCUMENT_ROOT']."/cupid/db_base/extractData.php";
require_once $_SERVER['DOCUMENT_ROOT']."/cupid/db_base/insertData.php";

if($_SERVER["REQUEST_METHOD"]=="POST"){
	if(isset($_POST["submit"])){
		$firstname=$_POST["firstname"];
		$lastname=$_POST["lastname"];
		$email=$_POST["email"];
		$pwd=$_POST["pass"];
		$cpwd = $_POST["cpass"];
		$gender=$_POST["gender"];
		$height=$_POST["height"];
		$age=$_POST["age"];
		$bio=$_POST["bio"];


		$temp = explode(".", $_FILES["file"]["name"]);
		$newfilename = round(microtime(true)).".".end($temp);
		$fileType = end($temp);
		$allowTypes = array('jpg','png','jpeg');
		$error = 0;



		if(!preg_match("/^([a-zA-Z' ]+)$/", $firstname)){
			$finvalid = "Invalid First name";
			$error = 1;

		}

		if(!preg_match("/^([a-zA-Z\.' ]+)$/", $lastname)){
			$linvalid = "Invalid Last name";
			$error = 1;
		}



		if(!preg_match("/^\\S+@\\S+\\.\\S+$/", $email)){
			$einvalid = "Invalid Email";
			$error = 1;
		}

		$a = new ExtractData();
		if($a->extEmail($email)){
			$einvalid = "Already exist";
			$error = 1;
		}

		if($pwd!=$cpwd){
			$pinvalid = "password invalid";
			$error = 1;
		}

		if(!isset($gender)){
			$ginvalid = "select gender";
			$error = 1;
		}

		if(!preg_match("/^[0-9]+$/", $height)){
			$hinvalid = "Invalid Height";
			$error = 1;
		}


		if(in_array($fileType, $allowTypes)){
			if(!move_uploaded_file($_FILES["file"]["tmp_name"], $_SERVER['DOCUMENT_ROOT']."/login/uploads/" . $newfilename)){
				$error = 1;
			}
		}else{
			$error = 1;
		}








		if($error==0){

			/*$temp = explode(".", $_FILES["file"]["name"]);
			$newfilename = round(microtime(true)).".".end($temp);
			move_uploaded_file($_FILES["file"]["tmp_name"], $_SERVER['DOCUMENT_ROOT']."/login/uploads/" . $newfilename);*/

			$pwd = md5($pwd);

			$b = new InsertData();

			if($b->insertRegisration($firstname, $lastname, $email, $pwd, $gender, $age, $height, $bio, $newfilename)){
				$c = new ExtractData();
				$userid = $c->extUserId($email);
				$insert_img_query = "INSERT INTO user_img(userid, image1, image2, image3, image4, image5) VALUES ('$userid', '0', '0','0', '0', '0')";
				mysqli_query($conn, $insert_img_query);
				header("location: ../index.php");
			}
			else{
				echo "account not created";
			}

			mysqli_close($conn);
		}


	}
}



?>