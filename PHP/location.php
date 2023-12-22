<?php 
    session_start();

        include("connection.php");
        include("functions.php");

        //check if the user is logged in//
        $user_data = check_login($conn);

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset = "UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Location</title>
        <link rel ="stylesheet" href="../CSS/location.css">
        <link rel="shorcut icon" type="img/png" href="../img/logoSD_V2.png">
    </head>
    <body>
       <header class="navbar">
            <a href="home.php"><img src="../img/logoSD_V2.png" class="logo"></a>
            <div class="toggle-btn" onclick="toggleNavLinks()">=</div>       
            <ul class="navlinks">
                        <li><a href="home.php">Home</a></li>
                        <li><a href="menu.php">Menu</a></li>
                        <li class="l-active"><a href="location.php"></a>Location</li>
                        <li><a href="contact.php">Review</a></li>
                        <li><a href="mytable.php">My Table</a></li>
                    </ul>
                    <div class="overlay" onclick="toggleNavLinks()"></div>
                <a href="reservation.php" class="ctn">Reservation</a>
       </header>
        
        <section class="mapping">
            <div class="whole-m">
                <h1>Having a hard time finding us?</h1>
                <div class="line"></div>
                <h2>We'll help you get there</h2> 
                 <p class="map">
                     <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7721.110244192647!2d120.95406108210273!3d14.624400714356705!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397b5c5a891b169%3A0x6860580b68b28131!2sMukbangMama%20Unli%20Samgyup%2C%20Chicken%2C%20and%20Beef!5e0!3m2!1sen!2sph!4v1681892644251!5m2!1sen!2sph" width="1200" height="600" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe> </p>
            </div>
        </section>

        <section class="address">
            <div class="loc">
                <h1>Mark us now at</h1>
                <h2>427 Blk. 6 Española Street, Tondo, Manila, Philippines</h2>
            </div>
        </div>
      
        <script src="../JavaScript/navoption.js"></script>
    </body>
</html>