<?php

session_start();

require_once $_SERVER['DOCUMENT_ROOT']."/cupid/db_base/connect-db.php";

require_once  $_SERVER['DOCUMENT_ROOT']."/cupid/db_base/extractData.php";

global $conn;



if($_SESSION['gender']=='Male'){
	$opgender = "Female";
}else if($_SESSION['gender']=='Female'){
	$opgender = "Male";
}else{
	echo "gender error";
}


$a = new ExtractData();
$av = $a->extAlreadyVisited($_SESSION['email']);
$alreayvisited = 0; #$av['alreadyvisited'];
$alreayvisited = (int) $alreayvisited;
$_SESSION['alreadyvisited'] = $alreayvisited; 





$a = new ExtractData();

for($i=0;$i<10;$i++){
	$alreayvisited++;
	$data = $a->extFeed($opgender, $alreayvisited);
	$row = mysqli_fetch_array($data);
	if(isset($row)){
		if($row['gender']==$opgender){
			echo $row['firstname'];


			###
		}else{
			$i--;
		}
	}else{
		echo "not found";
	}

}


?>