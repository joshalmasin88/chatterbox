<?php

require('./vendor/autoload.php');
$title = 'Login';
include('./src/Templates/header.php');

use App\Classes\User;
use App\Classes\Validation;

if(isset($_POST['login'])){
    $email = Validation::validate($_POST['email']);
    $password = Validation::validate($_POST['password']);
    $user = new User();
    $result = $user->login($email, $password);
}
?>

<link rel="stylesheet" href="<?php ROOT ?>/assets/css/signin.css">
<body class="text-center">
<form method="post" class="form-signin">
    <h1 class="h3 mb-3 font-weight-normal">Sign In</h1>
    <?php if(isset($_SESSION['loginErrors'])){
        echo "<div class='alert alert-danger'>". $_SESSION['loginErrors'] ."</div>";
        unset($_SESSION['loginErrors']);
    }
    ?>
    <label for="inputEmail" class="sr-only">Email address</label>
    <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
    <label for="inputPassword" class="sr-only">Password</label>
    <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
    <div class="checkbox mb-3">
        <label>
            <input type="checkbox" value="remember-me"> Remember me
        </label>
    </div>
    <input class="btn btn-lg btn-primary btn-block" type="submit" name="login" value="Login" />
    <p class="mt-5 mb-3 text-muted">&copy; 2017-2020</p>
</form>