<?php

session_start();

require_once  $_SERVER['DOCUMENT_ROOT']."/cupid/db_base/extractData.php";
require_once  $_SERVER['DOCUMENT_ROOT']."/cupid/db_base/insertData.php";


if(!isset($_SESSION['loggedIn']) && $_SESSION['loggedIn']!="true" && !isset($_COOKIE['auth']) && $_COOKIE['auth']!="true"){
	header("location: ../index.php");
}




if($_SESSION['gender']=='Male'){
	$opgender = "Female";
}else if($_SESSION['gender']=='Female'){
	$opgender = "Male";
}else{
	echo "gender error";
}


$a = new ExtractData();
$av = $a->extAlreadyVisited($_SESSION['email']);
$alreayvisited = $av['alreadyvisited'];
$alreayvisited = (int) $alreayvisited;
$_SESSION['alreadyvisited'] = $alreayvisited; 

$age = $_SESSION['age'];


?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="js/jquery.js"></script>
	<link rel="stylesheet" type="text/css" href="css/feedstyle.css">
	<title>Feed</title>
</head>
<body>

<div class="navbar">
		<a id="navlogo" href="">Cupid</a>
		<a href="logout.php">Logout</a>
		<a href="myMatch.php">My Match</a>
		<a href="myProfile.php">Profile</a>
		<a href="feed.php">Feed</a>
</div>


<div class="usercontainer">
	<?php

	for($i=0;$i<20;$i++){
		$alreayvisited++;

		$row = $a->extFeed($opgender, $alreayvisited, $age);
		#mysqli_fetch_array($data);
		if(isset($row)){
			if($row['gender']==$opgender){
	?>
			
				<a href="userinfo.php?matchid=<?php echo $row['userid']; ?>"><div class = "userprofile">
	
					<div class=usercard>
						<img src="../uploads/<?php echo $row['profileImg'] ?>">
						<div class="infocontainer">
							<p><b>Name: </b><?php echo $row['firstname']." ".$row['lastname']; ?></p>
							<p><b>Age: </b><?php echo $row['age']; ?></p>
							<p><b>Height: </b><?php echo $row['height']; ?></p>
							<p><?php echo $row['bio']; ?></p></a>

							<center><button id='<?php echo $i ?>' onclick = "userliked('<?php echo $row['userid']; ?>','<?php echo $i ?>')">	&#9829;</button><center>
						</div>
					</div>
				</div>

				<?php
				$updatevisited = $row['userid'];

			}else{
				$i--;
			}
		}

	}


	?>	

</div>

<center>
<div style="margin-top: 20px; margin-bottom: 20px;">

	<?php

	$b = new InsertData();


		if(isset($updatevisited)){
			$b->insertAlreadyVisited($_SESSION['email'], $updatevisited);
			echo "<a style='text-decoration: none; color: white; background-color: rgb(255, 69, 132, 1); padding: 10px 40px; border-radius:5px' id='nextfeed' href='".htmlspecialchars($_SERVER['PHP_SELF'])."'>Next</a>";
		}else{
			echo "<h1>Try Next Time</h1>";
			$b->insertAlreadyVisited($_SESSION['email'], 0);#delete this
		}

	?>
</div>
</center>


<script>
	function userliked(likedid, iduser){
		document.getElementById(iduser).style.color = '#ff4584';
		document.getElementById(iduser).style.backgroundColor = '#7762aa';
		var xhttp = new XMLHttpRequest();
		xhttp.open("GET", "feedmatcher.php?matchid="+likedid, true);
		xhttp.send("matchid="+likedid);

		

	}

	

	
		

		


	
</script>

</body>
</html>


