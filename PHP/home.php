<?php
session_start();

// Connect to the database
include("connection.php");
include("functions.php");

// Check if the user is logged in
$user_data = check_login($conn, array('home.php', 'signup.php'));
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MUKBANGMAMA</title>
    <link rel="stylesheet" href="../CSS/home.css">
    <link rel="shortcut icon" type="image/png" href="../img/logoSD_V2.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
</head>
<body>
    <header class="navbar">
        <a href="home.php"><img src="../img/logoSD_V2.png" class="logo"></a>

        <div class="toggle-btn" onclick="toggleNavLinks()">=</div>
        <ul class="navlinks" id="navlinks">
            <li class="h-active"><a href="home.php"></a>Home</li>
            <li><a href="menu.php">Menu</a></li>
            <li><a href="location.php">Location</a></li>
            <li><a href="contact.php">Review</a></li>
            <li><a href="mytable.php">My Table</a></li>
        </ul>
        <div class="overlay" onclick="toggleNavLinks()"></div>
        <a href="reservation.php" class="ctn">Reservation</a>
    </header>

    <section class="land">
        <div class="landing-content">
            <h1>MUKBANGMAMA</h1>
            <h2>UNLI SAMGYUPSAL AND UNLI CHICKEN WINGS</h2>
            <!-- Modify the h3 content based on user login -->
            <?php if (isset($user_data)) { ?>
                <h3>Welcome back, <?php echo $user_data['email']; ?></h3>
            <?php } else { ?>
                <h3>Sign up to book a reservation. Be the first to know of our latest menu, events, and promotions.</h3>
            <?php } ?>
            <!-- change the sign-in button to log out if the user is logged in -->
            <?php if (isset($user_data)) { ?>
                <div class="sign">
                    <a href="logout.php" class="ctn book">Log out</a>
                </div>
            <?php } else { ?>
                <div class="sign">
                    <a href="signup.php" class="ctn book">Sign Up</a>
                </div>
            <?php } ?>
        </div>
        <a href="https://www.facebook.com/profile.php?id=100080632060723" target="_blank"><i class="fa-brands fa-facebook"></i></a>
    </section>

    <script src="../JavaScript/navoption.js"></script>
</body>
</html>
