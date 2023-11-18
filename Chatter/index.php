<!DOCTYPE html>
<?php
include_once("includes/header.php");
include_once("includes/classes/User.php");
include_once("includes/classes/Post.php");

if (isset($_POST['post'])) {
    $post = new Post($con, $userLoggedIn);
    $post->submitPost($_POST['post_text'], 'none');
    header("Location: index.php");
}
?>
<div class="row">
    <div class="col-sm-3 user_details column">
        <a href="<?php echo $userLoggedIn; ?>"> <img src="<?php echo $user['profile_pic']; ?>"> </a>

        <div class="user_details_left_right">
            <a href="<?php echo $userLoggedIn; ?>">
                <?php
                echo $user['first_name'] . " " . $user['last_name'];
                ?>
            </a>
            <br>
            <?php
            echo "Posts: " . $user['num_posts'] . "<br>";
            echo "Likes: " . $user['num_likes'];
            ?>
        </div>
        <hr class="d-sm-none">
    </div>
    <div class="col-sm-9 main_column column">

 <div class="row">
            <div class="col">
                <form class="post_form" action="index.php" method="POST">
                <!-- Text Area -->
                <textarea class="form-control mb-2" name="post_text" id="post_text" placeholder="Got something on your mind?" rows="3"></textarea>
                <!-- Centered Button -->
                <div class="text-center">
                   <input type="submit" name="post" id="post_button" class="btn btn-success" value="Post">
                </div>
                </form>
            </div>
        </div>
<hr>
        <div class="posts_area"></div>
        <img id="#loading" src="assets/images/icons/loading.gif">


    </div>
</div>
</div>
<div class="mt-5 p-4 bg-dark text-white text-center fixed-footer">
    <p>&copy; 2023 Chatter</p>
</div>
<script>
    $(function () {

        var userLoggedIn = '<?php echo $userLoggedIn; ?>';
        var inProgress = false;
        loadPosts(); //Load first posts

        $(window).on('scroll', function () {
            var bottomElement = $(".status_post").last();
            var noMorePosts = $('.posts_area').find('.noMorePosts').val();

            // isElementInViewport uses getBoundingClientRect(), which requires the HTML DOM object, not the jQuery object. The jQuery equivalent is using [0] as shown below.
            if (isElementInView(bottomElement[0]) && noMorePosts == 'false') {
                loadPosts();
            }
        });

        function loadPosts() {
            if (inProgress) { //If it is already in the process of loading some posts, just return
                return;
            }

            inProgress = true;
            $('#loading').show();
            var page = $('.posts_area').find('.nextPage').val() || 1; //If .nextPage couldn't be found, it must not be on the page yet (it must be the first time loading posts), so use the value '1'

            $.ajax({

                url: "includes/handlers/ajax_load_posts.php",
                type: "POST",
                data: "page=" + page + "&userLoggedIn=" + userLoggedIn,
                cache: false,
                success: function (response) {

                    $('.posts_area').find('.nextPage').remove(); //Removes current .nextpage
                    $('.posts_area').find('.noMorePosts').remove(); //Removes current .nextpage
                    $('.posts_area').find('.noMorePostsText').remove(); //Removes current .nextpage
                    $('#loading').hide();
                    $(".posts_area").append(response);
                    inProgress = false;

                }

            });
        }


        //Check if the element is in view
        function isElementInView(el) {
            if (el == null) {
                return;
            }
            var rect = el.getBoundingClientRect();
            return (
                    rect.top >= 0 &&
                    rect.left >= 0 &&
                    rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) && //* or $(window).height()
                    rect.right <= (window.innerWidth || document.documentElement.clientWidth) //* or $(window).width()
                    );
        }
    });
</script>

</body>
</html>