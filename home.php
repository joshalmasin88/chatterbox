<?php
require('./vendor/autoload.php');
$title = 'Home';
include('./src/Templates/header.php');

use App\Classes\Post;
use App\Classes\Validation;

$userPost = new Post();

if(isset($_POST['messagepost'])) {
    $post = Validation::validate($_POST['msg']);
    $newPost = $userPost->insertPost($post,$_SESSION['email']);
}

?>
<style>
    #sideBar {
        height: 100vh;
        border-right: 1px solid #c8cbcf;
    }

</style>
<div class="container-fluid">
    <div class="row mt-5">
        <div id="sideBar" class="col-md-4">
            <h3><?php echo $_SESSION['email'] ?></h3>
        </div>
        <div class="col-md-8">
            <div class="container">
                <div class="row">
                    <div class="col-md">
                        <form method="post" class="text-right">
                            <div class="form-group">
                                <input type="text" name="msg" class="form-control">
                            </div>
                            <input type="submit" name="messagepost" class="btn btn-primary" value="Post">
                        </form>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">

                        <?php
                            $allPosts = $userPost->viewAll();
                            foreach($allPosts as $post):
                        ?>
                        <div class="card mt-5">
                            <div class="card-header">
                                <span class="text-right">
                                    <img style="height:50px; width:50px;" src="https://www.bootdey.com/img/Content/avatar/avatar1.png" alt="">
                                </span>
                                <span><?= $post['email']; ?></span>
                            </div>
                            <div class="card-body">
                                <p><?= $post['post']; ?></p>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<?php include('./src/Templates/footer.php'); ?>
