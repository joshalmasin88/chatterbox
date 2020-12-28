<?php

require('./vendor/autoload.php');
$title = 'Register';
include('./src/Templates/header.php');

use App\Classes\User;
use App\Classes\Validation;

$user = new User();

if(isset($_POST['register'])){
    $email = Validation::validate($_POST['email']);
    $password = Validation::validate($_POST['password']);

    $result = $user->register($email, $password);
    if($result){
        header("Location: login.php");
    }
}
?>

<link rel="stylesheet" href="<?php ROOT ?>/assets/css/signin.css">
<body class="text-center">
<form method="post" class="form-signin">
    <h1 class="h3 mb-3 font-weight-normal">Register</h1>
    <?php if(isset($_SESSION['registerErrors'])){
            echo "<div class='alert alert-danger'>". $_SESSION['registerErrors'] ."</div>";
            unset($_SESSION['registerErrors']);
        }
    ?>
    <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
    <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
    <div class="checkbox mb-3">
        <label>
            <input type="checkbox" value="remember-me"> Remember me
        </label>
    </div>
    <input name="register" class="btn btn-lg btn-primary btn-block" type="submit" value="Register">
    <p class="mt-5 mb-3 text-muted">&copy; 2017-2020</p>
</form>