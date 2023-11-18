<?php
require 'config/config.php';
include("includes/classes/User.php");
include("includes/classes/Post.php");

if (isset($_SESSION['username'])) {
    $userLoggedIn = $_SESSION['username'];
    $user_details_query = mysqli_query($con, "SELECT * FROM users WHERE username='$userLoggedIn'");
    $user = mysqli_fetch_array($user_details_query);
} else {
    header("Location: register.php");
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Bootstrap 5 Website Example</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link href="assets/css/bootstrap.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
                <link rel="stylesheet" type="text/css" href="assets/css/style.css">



        <!--Javascript-->
        <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
        <script src="https://code.jquery.com/jquery-migrate-3.4.1.js"></script>
        <script src="assets/js/bootstrap.js"></script>
        <script src="assets/js/bootbox.min.js"></script>
        <script src="https://kit.fontawesome.com/f627e83990.js" crossorigin="anonymous"></script>
        <script src="assets/js/chatter.js"></script>
  
    </head>
    <body>

        <nav class="navbar navbar-expand-lg" data-bs-theme="dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="#"><img src="assets/images/logos/chatter_logo.png" style="max-width: 50px; border-radius: 20%; margin-top: 10px;" class="responsiveImg" alt=""/></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarColor01">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link active" href="index.php">Home
                                <span class="visually-hidden">(current)</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="requests.php">Requests</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="includes/handlers/logout.php">Logout</a>
                        </li>

                    </ul>
    
                    <div class="search">
                        <form action="search.php" method="GET" name="search_form">
                            <input type="text" class="form-control me-sm-2" onkeyup="getLiveSearchUsers(this.value, '<?php echo $userLoggedIn; ?>')" name="q" placeholder="Search..." autocomplete="off" id="search_text_input">

        
                        </form>



                    </div>
                    
                </div>
                
            </div>
        </nav>
        <div id="search_results_container">
        <div class="search_results"></div> 

        <div class="search_results_footer_empty"></div>   
        </div>
        <div class="container mt-5">


