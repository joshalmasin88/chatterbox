<?php

require('./vendor/autoload.php');
session_start();
session_unset('userActive');
session_unset('email');
session_unset('userId');

session_destroy();
header('Location: login.php');
