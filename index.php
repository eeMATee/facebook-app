

<!-- Header php -->
    <?php 
        require 'config/config.php';
        include("includes/header.php");
        include("includes/classes/User.php");
        include("includes/classes/Post.php");


//  Adding post on button pressed
    if(isset($_POST['post'])) {
        $post = new Post($con, $userLoggedIn);
        $post->submitPost($_POST['post_text'], 'none');
        // none becouse its on our own profile posted
        header("Location: index.php");
        //preventing form resubmitting posts after refresh
    }

?>
<!--X Header php X-->


        <div class="user_details column">
            <a href="<?= $userLoggedIn ?>"><img src=" <?= $user['profile_pic'];?> " alt="profile_picture"></a>

            <div class="user_details_left_right">
                <a href="<?= $userLoggedIn ?>">
                    <?php
                    echo $user['first_name'] . " " . $user['last_name'] . "<br>";
                    ?>
                </a>
                <?php echo "Posts: " . $user['num_posts'] . "<br>" .
                        "Likes: " . $user['num_likes'] ; 
                ?>
            </div>  <!-- Div End || user_details_left_right ||  -->
        </div> <!-- Div End || user_details column ||  -->


        <div class="main_column column">
            <form action="index.php" class="post_form" method="POST">
            <textarea name="post_text" id="post_text" 
                placeholder="Co tam? Jak tam?"></textarea>
            <input type="submit" value="Dodaj" name="post" id="post_button">
            <hr>
            </form>


            <?php 
                $post = new Post($con, $userLoggedIn);
                $post->loadPostsFriends();
            ?>


        </div> <!-- Div End || main_column column ||  -->



    
    </div>  <!-- Div End || wrapper || header.php -->
</body>
</html>