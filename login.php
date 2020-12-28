<?php

require('./vendor/autoload.php');
$title = 'Register';
include('./src/Templates/header.php');

use App\Classes\User;

?>

<link rel="stylesheet" href="<?php ROOT ?>/assets/css/signin.css">
<body class="text-center">
<form class="form-signin">
    <h1 class="h3 mb-3 font-weight-normal">Sign In</h1>
    <label for="inputEmail" class="sr-only">Email address</label>
    <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
    <label for="inputPassword" class="sr-only">Password</label>
    <input type="password" id="inputPassword" class="form-control" placeholder="Password" required>
    <div class="checkbox mb-3">
        <label>
            <input type="checkbox" value="remember-me"> Remember me
        </label>
    </div>
    <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
    <p class="mt-5 mb-3 text-muted">&copy; 2017-2020</p>
</form>