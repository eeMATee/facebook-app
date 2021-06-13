
<?php 
    session_start();

//checking if user is logged in, if so then variable will be availble to all pages
if(isset($_SESSION['username'])) {
    $userLoggedIn = $_SESSION['username'];
    $user_details_query = "SELECT * FROM users WHERE username='$userLoggedIn'";
    $user_details = mysqli_query($con, $user_details_query);
    $user = mysqli_fetch_array($user_details); // return arrray with values form DB
} else {
    
    header("Location: register.php");
}

?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faceshit</title>

<!-- CSS -->
    <script src="https://kit.fontawesome.com/f2e02efb3d.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/css/header.css">

<!-- Javascripts -->
    <script
			  src="https://code.jquery.com/jquery-3.5.1.min.js"
			  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
              crossorigin="anonymous">
    </script>
    <script src="../assets/js/bootstrap.js"></script>


</head>
<body>


    <div class="top-bar">
        <div class="logo">
            <a href="index.php">Faceshit</a>
        </div>

        <nav>
            <a href="<?= $userLoggedIn ?>">
            <!-- ERRRRRRRRRRRRRRRRRROOOOOOOOOOOOOOOORRRRRRRRRRR -->
            <!-- Something with session username in login_handler -->
                <?php echo $user['first_name']; ?>  
            </a>
            <a href="#"><i class="fas fa-home fa-2x"></i></a>
            <a href="#"><i class="far fa-envelope fa-2x"></i></a>
            <a href="#"><i class="fas fa-user-cog fa-2x"></i></a>
            <a href="#"><i class="fas fa-user-cog fa-2x"></i></a>
            <a href="includes/handlers/logout.php"><i class="fa fa-sign-out fa-2x"></i></a>
        </nav>
    </div>

    <!-- Rest of this div in index.php -->
    <div class="wrapper">

