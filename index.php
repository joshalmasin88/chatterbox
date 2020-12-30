<?php

require('./vendor/autoload.php');
$title = 'Register';
include('./src/Templates/header.php');

use App\Classes\User;
use App\Classes\Validation;

$user = new User();

if(isset($_POST['register'])){
    $target_dir = $target_dir = 'assets/profile/imgs/';
    $target_file = $target_dir . basename($_FILES['profileImg']['name']);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    $email = Validation::validate($_POST['email']);
    $password = Validation::validate($_POST['password']);

    // Check if image file is real
    $check = getimagesize($_FILES['profileImg']['tmp_name']);
    if($check !== false) {
        // Check image size
        if($_FILES['profileImg']['size'] < 500000) {
            if (move_uploaded_file($_FILES["profileImg"]["tmp_name"], $target_file)) {
                $result = $user->register($email, $password,$target_file);
                if($result){
                    header("Location: login.php");
                }
            }
        }
    } else {
        $_SESSION['registerErrors'] = "Sorry this is not a image";

    }


}
?>

<link rel="stylesheet" href="<?php ROOT ?>/assets/css/signin.css">
<body class="text-center">
  <form method="post" class="form-signin" enctype="multipart/form-data">
    <h1 class="h3 mb-3 font-weight-normal">Register</h1>
    <?php if(isset($_SESSION['registerErrors'])){
            echo "<div class='alert alert-danger'>". $_SESSION['registerErrors'] ."</div>";
            unset($_SESSION['registerErrors']);
        }
    ?>
    <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
    <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
    <input name="profileImg" type="file" class="form-control">

    <input name="register" class="btn btn-lg btn-primary btn-block" type="submit" value="Register">
    <p class="mt-5 mb-3 text-muted">&copy; 2017-2020</p>
</form>