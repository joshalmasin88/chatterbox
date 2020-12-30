<?php
require('./vendor/autoload.php');
session_start();

use App\Classes\Post;
$post = new Post();

if(isset($_GET['id'])){
    $deletePost = $post->deletePost($_GET['id'], $_SESSION['email']);
    header("Location: home.php");
}
