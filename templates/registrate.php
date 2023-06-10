<?php
$finvalid = "";
$linvalid = "";
$einvalid = "";
$pinvalid = "";
$ginvalid = "";
$hinvalid = "";

$firstname = "";

$lastname= "";
$email= "";
$height= "";
$age= "";
$bio= "";
$pwd = "";
require $_SERVER['DOCUMENT_ROOT']."/cupid/controller/formvalidate.php";


?>


<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Register Form</title>
    <link rel="stylesheet" href="css/registration.css">
  </head>
  <body>
    <form class="signup-form" action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">

      <!-- form header -->
      <div class="form-header">
        <h1>Create Account</h1>
      </div>

      <!-- form body -->
      <div class="form-body">

        <!-- Firstname and Lastname -->
        <div class="horizontal-group">
          <div class="form-group left">
            <label for="firstname" class="label-title">First name *</label><span style="color: red"><?php echo $finvalid; ?></span>
            <input type="text" id="firstname" name="firstname" class="form-input" placeholder="Enter your first name" value="<?php echo $firstname; ?>"/>
          </div>
          <div class="form-group right">
            <label for="lastname" class="label-title">Last name</label><span style="color: red"><?php echo $linvalid; ?></span>
            <input type="text" id="lastname" name="lastname" class="form-input" placeholder="Enter your last name" value="<?php echo $lastname; ?>"/>
          </div>
        </div>

        <!-- Email -->
        <div class="form-group">
          <label for="email" class="label-title">Email*</label><span style="color: red"><?php echo $einvalid; ?></span>
          <input type="text" id="email" name="email" class="form-input" placeholder="Enter your email" value="<?php echo $email; ?>">
        </div>

        <!-- Passwrod and confirm password -->
        <div class="horizontal-group">
          <div class="form-group left">
            <label for="password" class="label-title">Password *</label><span style="color: red"><?php echo $pinvalid; ?></span>
            <input type="password" name="pass" id="password" class="form-input" placeholder="enter your password" value="<?php echo $pwd; ?>">
          </div>
          <div class="form-group right">
            <label for="confirm-password" class="label-title">Confirm Password *</label>
            <input type="password" name="cpass" class="form-input" id="confirm-password" placeholder="enter your password again">
          </div>
        </div>

        <!-- Gender and Height -->
        <div class="horizontal-group">
          <div class="form-group left">
            <label class="label-title">Gender:</label><span style="color: red"><?php echo $ginvalid; ?></span>
            <div class="input-group">
              <label for="male"><input type="radio" name="gender" value="Male" id="male" checked> Male</label>
              <label for="female"><input type="radio" name="gender" value="Female" id="female"> Female</label>
            </div>
          </div>
          <div class="form-group right">
            <label for="experience" class="label-title">Height(in cm)</label><span style="color: red"><?php echo $hinvalid; ?></span>
            <input type="text" name="height"  class="form-input" value="<?php echo $height; ?>">
          </div>
        </div>

        <!-- Profile picture and Age -->
        <div class="horizontal-group">
          <div class="form-group left" >
            <label class="label-title">Upload Profile Picture</label>
            <input type="file" name='file' size="80">
          </div>
          <div class="form-group right">
            <label for="experience" class="label-title">Age</label>
            <input type="number" min="18" max="80" name="age" value="<?php echo $age; ?>" class="form-input">
          </div>
        </div>

        <!-- Bio -->
        <div class="form-group">
          <label for="choose-file" class="label-title">Bio</label>
          <textarea class="form-input" name="bio" rows="4" cols="50" style="height:auto"><?php echo $bio; ?></textarea>
        </div>
      </div>

      <!-- form-footer -->
      <div class="form-footer">
        <input type="submit" value="Create" name="submit" class="btn">
      </div>

    </form>

  </body>
</html>