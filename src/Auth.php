<?php

if (!isset($_SESSION['userActive']) || $_SESSION['userActive'] == '')
{
    header('Location: index.php');
}