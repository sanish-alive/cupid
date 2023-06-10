<?php
  //profile image name.
  if($_SERVER["REQUEST_METHOD"]=="POST"){
    if(isset($_POST["submit"])){
      $firstname=$_POST["firstname"];
      $lastname=$_POST["lastname"];
      $email=$_POST["email"];
      $pass=$_POST["pass"];
      $gender=$_POST["gender"];
      $age=$_POST["age"];
      $bio=$_POST["bio"];

      //profileimg handling.
      $temp = explode(".", $_FILES["file"]["name"]);
      $newfilename = round(microtime(true)) . '.' . end($temp);
      move_uploaded_file($_FILES["file"]["tmp_name"], "uploads/" . $newfilename);


      //database connection
      include "conn.php";

      //uploads to database-->
      
      $sql = "INSERT INTO user_tb (firstname, lastname, email, pass, gender, age, bio, profileImg) VALUES ('$firstname', '$lastname', '$email', '$pass', '$gender', $age, '$bio', '$newfilename')";

      if(mysqli_query($conn, $sql)){
        echo '<h1>Account successfully created.</h1><br><a href="index.php">Login</a>';
        //header("Location:index.php");
        //exit();
      }
      else{
        echo "Error: ".mysqli_error($conn);
      }
      mysqli_close($conn);
    }
  }
?>
