<?php
session_start();
if(!isset($_SESSION['adminAuth']) && $_SESSION['admin
	']!="true" ){
	header("location: index.php");
}

if(!isset($_SESSION['adminAuth']) && $_SESSION['admin']!="true" && !isset($_COOKIE['authAdmin']) && $_COOKIE['authAdmin']!="true"){
	header("location: index.php");
}


require_once $_SERVER['DOCUMENT_ROOT']."/cupid/db_base/connect-db.php";

if($_SERVER["REQUEST_METHOD"]=="GET"){
    if(isset($_GET['type']) && $_GET['type']=='male'){
        $query = "SELECT * FROM user_tb WHERE gender='Male'";
        $retval = mysqli_query($conn, $query);
        $data = mysqli_num_rows($retval);
    }
    else if(isset($_GET['type']) && $_GET['type']=='female'){
        $query = "SELECT * FROM user_tb WHERE gender='Female'";
        $retval = mysqli_query($conn, $query);
        $data = mysqli_num_rows($retval);
    }
    else if(isset($_GET['type']) && $_GET['type']=='block'){
        $query = "SELECT * FROM user_tb WHERE block='blocked'";
        $retval = mysqli_query($conn, $query);
        $data = mysqli_num_rows($retval);
    }
    if(isset($_GET['search'])) {
        $search = htmlspecialchars($_GET['search']);
        $query = "SELECT * FROM user_tb WHERE 
        (`firstname` LIKE '%".$search."%')
        OR (`lastname` LIKE '%".$search."%')
        OR (`email` LIKE '%".$search."%')
        OR (`gender` LIKE '%".$search."%')
        OR (`height` LIKE '%".$search."%')
        OR (`age` LIKE '%".$search."%')
        OR (`bio` LIKE '%".$search."%')";
        $retval = mysqli_query($conn, $query);
        $data = mysqli_num_rows($retval);
    }
    else {
        $query = "SELECT * FROM user_tb";
        $retval = mysqli_query($conn, $query);
        $data = mysqli_num_rows($retval);
    }
    
}
?>