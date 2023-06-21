<?php

session_start();

if(!isset($_SESSION['loggedIn']) && $_SESSION['loggedIn']!="true" && !isset($_COOKIE['auth']) && $_COOKIE['auth']!="true") {
    header("location: ../index.php");
}

$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => 'localhost:5000/cosine',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => 'lastname=shrestha&age=21&height=181&gender=Female&bio=i%20am%20a%20software%20engineer%20with%20a%20passion%20for%20coding',
    CURLOPT_HTTPHEADER => array(
    'Content-Type: application/x-www-form-urlencoded'
    ),
));

$response = curl_exec($curl);

curl_close($curl);

// Decode the response JSON
$data = json_decode($response, true);
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
if ($data !== null) {
    foreach ($data as $item) {
        if(!isset($item['age'])) continue;
?>
        <a href="userinfo.php?matchid=<?php echo $item['id']; ?>"><div class = "userprofile">
	
            <div class=usercard>
                <img src="../uploads/<?php echo $item['profileImg'] ?>">
                <div class="infocontainer">
                    <p><b>Name: </b><?php echo $item['firstname']." ".$item['lastname']; ?></p>
                    <p><b>Age: </b><?php echo $item['age']; ?></p>
                    <p><b>Height: </b><?php echo $item['height']; ?></p>
                    <p><?php echo $item['bio']; ?></p></a>

                    <center><button id='<?php echo $item['id']; ?>' onclick = "userliked('<?php echo $item['id']; ?>','<?php echo $item['id']; ?>')">	&#9829;</button><center>
                </div>
            </div>
        </div></a>
<?php
    }
}
?>
        
<center>
<div style="margin-top: 20px; margin-bottom: 20px;">

	<a style='text-decoration: none; color: white; background-color: rgb(255, 69, 132, 1); padding: 10px 40px; border-radius:5px' id='nextfeed' href='#'>Next</a>
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
