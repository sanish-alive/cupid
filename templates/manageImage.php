<?php

require $_SERVER['DOCUMENT_ROOT']."/cupid/db_base/connect-db.php";

require_once  $_SERVER['DOCUMENT_ROOT']."/cupid/db_base/insertData.php";
require_once  $_SERVER['DOCUMENT_ROOT']."/cupid/db_base/extractData.php";
require "profile.php";

$imginvalid = "";
$user_email = $_SESSION['email'];
$user_id = $_SESSION['userid'];

$a=new ExtractData();

if($_SERVER['REQUEST_METHOD']=="POST"){

	if(isset($_POST['delete'])){

		$imageno = $_POST['imageno'];
		$imagename = $_POST['imagename'];
		$query = "UPDATE user_img SET $imageno = '0' WHERE userid = '$user_id' ";
		if(mysqli_query($conn, $query) && unlink($_SERVER['DOCUMENT_ROOT']."/login/images/".$imagename)){
			;
			header("location: manageImage.php");
		}

	}

	if(isset($_POST['submit'])){		

		if($_FILES['file']['name']!=""){
			$temp = explode(".", $_FILES["file"]["name"]);
			$newFileName =  round(microtime(true)).".".end($temp);
			$fileType = end($temp);

			$allowTypes = array('jpg','png','jpeg');

			if(in_array($fileType, $allowTypes)){
				if(move_uploaded_file($_FILES['file']['tmp_name'], "../images/".$newFileName)){


					for($i=1;$i<6;$i++){
						$dbimagename = "image".$i;
						$dbimagename = strval($dbimagename);

						$data = $a->extImages($user_id); 

						if($data[$dbimagename]=='0'){
							$query = "UPDATE user_img SET $dbimagename='$newFileName' WHERE userid = '$user_id'";
							if(mysqli_query($conn, $query)){
								header("location: manageImage.php");
								break;
							}
						}


					}
				}else{
					$imginvalid = "error on uploading";
				}

			}else{
				$imginvalid = "only allows jpg, png, jpeg";
			}

		}else{
			$imginvalid = "please select image to upload";
		}
	}
}




?>


<article>
	<div class="manage_img">
		<h1>My Images</h1><hr>

		<form action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post" enctype="multipart/form-data">
			<p style="color: #ff4584;">Upload image <span style="color: red;">: <?php echo $imginvalid; ?></span></p>
			<input style="background-color: #ff4584; color:white; border:none; border-radius: 5px; padding: 10px 20px;" type="file" name="file" >
			<input id="manageUpImg" type="submit" name="submit" value="upload">
			
		</form>

		<?php
		
		for($i=1;$i<6;$i++){
			$dbimagename = "image".$i;
			$dbimagename = strval($dbimagename);

			$data = $a->extImages($user_id);

			if($data[$dbimagename]!='0'){

		?>
		
				<div class="img_container">
					<img src='<?php echo "../images/".$data[$dbimagename] ?>'>
					<div style="width: 100%" class="imgaction">
						<form style="width: 100%" action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
							<input type="hidden" name="imagename" value="<?php echo $data[$dbimagename]; ?>">
							<input type="hidden" name="imageno" value="<?php echo $dbimagename; ?>">
							<input id="manageDelImg" type="submit" name="delete" value="Delete">
						</form>
					</div>
				</div>

		<?php
			}
		}
		?>

			
	</div>
</article>
</section>


</body>
</html>
