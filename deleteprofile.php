<?php

require('./vendor/autoload.php');
session_start();

use App\Classes\User;

$user = new User();

$user->deleteUser($_SESSION['email']);
session_unset($_SESSION['userActive']);
session_unset($_SESSION['email']);
session_unset($_SESSION['userId']);
session_destroy();
header("Location: index.php");