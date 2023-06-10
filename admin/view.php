<?php

require $_SERVER['DOCUMENT_ROOT']."/cupid/db_base/connect-db.php";
require_once $_SERVER['DOCUMENT_ROOT']."/cupid/db_base/extractData.php";

session_start();


if(!isset($_SESSION['adminAuth']) && $_SESSION['admin']!="true" && !isset($_COOKIE['authAdmin']) && $_COOKIE['authAdmin']!="true"){
	header("location: index.php");
}


if(isset($_GET['userid'])){
	$matchid = $_GET['userid'];
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
	<link rel="stylesheet" href="../templates/css/userinfo.css">
	<link rel="stylesheet" type="text/css" href="adminstyle.css">
	<style type="text/css">
		.matchCont h1, h2, b{
			color: #ff4584;
		}

		.matchCont a{
			color: black;
			text-decoration: none;
		}

		.card{
			margin-top: 10px;
			margin-bottom: 2em;
			width: 45%;
			transition: 0.3;
			box-shadow: 0 6px 10px 0 rgba(0, 0, 0, .2);
		}

		.card:hover{
			box-shadow: 0 8px 16px 0 rgba(0, 0, 0, .2);
		}

		.cardContainer{
			padding: 2px 1px;
			
		}
		.cardContainer p{
			text-align: left;
			padding-left: 20px;
		}

	</style>

	<title>Admin</title>
</head>
<body>

<div class="navbar">
	<a id="navlogo" href="">Cupid</a>
	<a href="adminLogout.php">Logout</a>
	<a href="adminPage.php">Home</a>
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
	    	<br><br>
	    	<h1>User Image</h1>

	    	<?php



			for($i=1;$i<6;$i++){
				$dbimagename = "image".$i;
				$dbimagename = strval($dbimagename);

				$data = $a->extImages($matchid);

				if($data[$dbimagename]!='0'){

		?>
		
				<div class="img_container">
					<img src='<?php echo "../images/".$data[$dbimagename] ?>'>
				</div>

		<?php
			}
		}
		?>

	    </div>

	    <div class="matchCont">
	    	<br><br>
			<h1>User Match</h1>
			<hr>
				<br>

				<?php
				$a = new ExtractData();
				$retval = $a->extMyMatch($matchid);
				$data = mysqli_num_rows($retval);

				if($data>0){
					while($row=mysqli_fetch_array($retval)){
						#print_r($row);
						if($row['user1']!=$matchid){
							$matchid = $row['user1'];
						}else{
							$matchid = $row['user2'];
						}
						$matchinfo = $a->extMatchId($matchid);

					?>	
						
						<div class="card">
							<a href="view.php?userid=<?php echo $matchid; ?>">
								<img src="../uploads/<?php echo $matchinfo['profileImg']; ?>" style="width:100%">
								<div class="cardContainer">
									<p><b>Name: </b><?php echo $matchinfo['firstname']." ".$matchinfo['lastname']; ?></p>
									<p><b>Age: </b><?php echo $matchinfo['age']; ?></p>
									<p><b>Height: </b><?php echo $matchinfo['height']; ?></p>
									<p><b>Email: </b><?php echo $matchinfo['email']; ?></p>
									<p><?php echo $matchinfo['bio']; ?></p>
								</div>
							</a>
						</div>
						

					<?php
					}
				}?>
			<br>
		</div>
	</center>

</body>
</html>
