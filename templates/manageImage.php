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
		$query = "DELETE FROM user_img WHERE imageid = '$imageno' ";
		if(mysqli_query($conn, $query) && unlink($_SERVER['DOCUMENT_ROOT']."/cupid/images/".$imagename)){
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
					$query = "INSERT INTO user_img(userid, image) VALUES('$user_id', '$newFileName')";
					if(mysqli_query($conn, $query)){
						header("location: manageImage.php");
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
		$retval = $a->extImages($user_id);
		if(mysqli_num_rows($retval)>0){
		while($row=mysqli_fetch_array($retval)){

		?>
		
				<div class="img_container">
					<img src='<?php echo "../images/".$row['image'] ?>'>
					<div style="width: 100%" class="imgaction">
						<form style="width: 100%" action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
							<input type="hidden" name="imagename" value="<?php echo $row['image']; ?>">
							<input type="hidden" name="imageno" value="<?php echo $row['imageid'] ?>">
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
