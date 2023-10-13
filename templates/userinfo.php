<?php

require $_SERVER['DOCUMENT_ROOT']."/cupid/db_base/connect-db.php";
require_once $_SERVER['DOCUMENT_ROOT']."/cupid/db_base/extractData.php";

session_start();

if(!isset($_SESSION['loggedIn']) && $_SESSION['loggedIn']!="true" && !isset($_COOKIE['auth']) && $_COOKIE['auth']!="true"){
	header("location: ../index.php");
}


if(isset($_GET['matchid'])){
	$matchid = $_GET['matchid'];
	$a = new ExtractData();
	$data = $a->extMatchId($matchid);
}else{
	header("location: ../index.php");
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/userinfo.css">
	<link rel="stylesheet" href="css/profile.css">
	

</head>
<body>


	<div class="navbar">
		<a id="navlogo" href="">Cupid</a>
		<a href="myMatch.php">My Match</a>
		<a href="myProfile.php">Profile</a>
		<a href="feed.php">Feed</a>
	</div>

	<center>
		<div class="user_info">
			<h1>Profile</h1>
			<img src="../uploads/<?php echo $data['profileImg']; ?>" alt="Avatar">
	
	    	<div style="margin-top: 45px;">
		    	<h2 style="color: #ff4584;">User Profile</h2>
		    	<table>
		    		<tr>
		    			<td>Full Name:</td>
		    			<td><?php echo $data['firstname']." ".$data['lastname']; ?></td>
		    		</tr>
		    		<tr>
		    			<td>Email:</td>
		    			<td><?php echo $data['email']; ?></td>
		    		</tr>
		    		<tr>
		    			<td>Age:</td>
		    			<td><?php echo $data['age']; ?></td>
		    		</tr>
		    		<tr>
		    			<td>Gender:</td>
		    			<td><?php echo $data['gender']; ?></td>
		    		</tr>
		    		<tr>
		    			<td>Height:</td>
		    			<td><?php echo $data['height']." cm"; ?></td>
		    		</tr>
		    		<tr>
		    			<td>Bio:</td>
		    			<td><?php echo $data['bio']; ?></td>
		    		</tr>
		    	</table>
	    	</div>

	    </div>


	    <div class="manage_img">

	    	<?php
				$retval = $a->extImages($data['userid']);
				if(mysqli_num_rows($retval)>0){
				while($row=mysqli_fetch_array($retval)){

		?>
		
				<div class="img_container">
					<img src='<?php echo "../images/".$row['image'] ?>'>
				</div>

		<?php
			}
		}
		?>

	    </div>
	</center>

</body>
</html>
