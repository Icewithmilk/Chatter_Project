<?php  
require 'config/config.php';
include("includes/classes/User.php");
include("includes/classes/Post.php");

if(isset($_SESSION['username'])) {
    $userLoggedIn = $_SESSION['username'];
    $user_details_query = mysqli_query($con, "SELECT * FROM users WHERE username='$userLoggedIn'");
    $user = mysqli_fetch_array($user_details_query);
}
else {
    header("Location: register.php");
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Welcome to Chatter!</title>

    <!--Javascript-->
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://code.jquery.com/jquery-migrate-3.4.1.js"></script>
    <script src="assets/js/bootstrap.js"></script>
    <script src="assets/js/bootbox.min.js"></script>
    <script src="https://kit.fontawesome.com/f627e83990.js" crossorigin="anonymous"></script>
    <script src="assets/js/chatter.js"></script>
    
    

    <!--CSS-->
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>
<body>

<div class="top_bar">
    <div class="logo">
        <a href="index.php">Chatter!</a>
    </div>

    <div class="search">
        <form action="search.php" method="GET" name="search_form">
            <input type="text" onkeyup="getLiveSearchUsers(this.value, '<?php echo $userLoggedIn; ?>')" name="q" placeholder="Search..." autocomplete="off" id="search_text_input">

            <div class="button_holder">
                <img src="assets/images/icons/magnifying_glass.png">
            </div>
        </form>

        <div class="search_results"></div> 

        <div class="search_results_footer_empty"></div>      

    </div>

    <nav>
        <a href="<?php echo $userLoggedIn; ?>">
            <?php echo $user['first_name'];   ?>
        </a>
        <a href="index.php">
        <i class="fa-solid fa-house fa-lg"></i>
        </a>
        <a href="requests.php">
        <i class="fa-solid fa-user-group fa-lg"></i>
        </a>
        <a href="includes/handlers/logout.php">
        <i class="fa-solid fa-arrow-right-from-bracket"></i>
        </a>
    </nav>

</div>

<div class="wrapper">


   