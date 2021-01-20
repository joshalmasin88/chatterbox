<?php
require('./vendor/autoload.php');
$title = 'Home';
include('./src/Templates/header.php');
require('./src/Auth.php');

use App\Classes\User;
use App\Classes\Post;
use App\Classes\Validation;

$user = new User();
$userPost = new Post();

if(isset($_POST['messagepost'])) {
    $post = Validation::validate($_POST['msg']);
    $newPost = $userPost->insertPost($post,$_SESSION['email']);
}
$currentuser = $user->getUser($_SESSION['email']);

?>


<div class="row py-5 px-4">
    <div class="col-xl-4 col-md-6 col-sm-10 mx-auto">

        <!-- Profile widget -->
        <div class="bg-white shadow rounded overflow-hidden">
            <div class="px-4 pt-0 pb-4 bg-light">
                <div class="media align-items-end profile-header">
                    <div class="profile mr-3"><img src="<?= $currentuser['profileImg'] ?>" alt="..." width="150" class="rounded mb-2 mt-3 img-thumbnail">
                        <a href="deleteprofile.php" class="btn btn-outline-dark btn-sm btn-block">Delete Profile</a>
                        <a href="logout.php" class="btn btn-outline-dark btn-sm btn-block">Logout</a>
                    </div>
                    <div class="media-body mb-5 text-dark">
                        <strong class="mt-0 mb-0"><?= $_SESSION['email']; ?></strong>
                    </div>
                </div>
            </div>

            <div class="py-4 px-4">
                <div>
                    <div class="mb-2 mt-1">
                        <h5>Whats on your mind?</h5>
                    </div>
                   <form method="post" class="text-right">
                        <div class="form-group">
                            <input type="text" name="msg" class="form-control">
                        </div>
                        <input type="submit" name="messagepost" class="btn btn-dark" value="Post">
                    </form>
                </div>
                <h5 class="mb-3">Recent posts</h5>
                <?php
                   $allPosts = $userPost->viewAll();

                   foreach($allPosts as $post):
                ?>
                <div class="py-4">
                    <div class="p-4 bg-light rounded shadow-sm">
                        <div>
                            <?php if($_SESSION['email'] === $post['email']) : ?>
                            <div class="text-right">
                                <a href="delete.php?id=<?= $post['post_id']; ?>" class="btn btn-sm btn-danger">X</a>
                            </div>
                            <?php endif; ?>
                        </div>
                        <img style="height:50px; width:50px;" src="<?= $post['profileImg']; ?>" alt="">
                        <strong><?= $post['email']; ?></strong>
                        <br><br>
                        <p class="font-italic mb-0"><?= $post['post']; ?></p>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div><!-- End profile widget -->

    </div>
</div>



<?php include('./src/Templates/footer.php'); ?>
