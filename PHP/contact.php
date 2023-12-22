<?php 
    session_start();

    include("connection.php");
    include("functions.php");

    // Check if the user is logged in
    $user_data = check_login($conn);
?>

<?php
    include("contact-connection.php");
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review</title>
    <link rel="stylesheet" href="../CSS/contact.css">
    <link rel="shortcut icon" type="image/png" href="../img/logoSD_V2.png">
</head>
<body>
    <header class="navbar">
        <a href="home.php"><img src="../img/logoSD_V2.png" class="logo"></a>
        <div class="toggle-btn" onclick="toggleNavLinks()">=</div>
        <ul class="navlinks">
            <li><a href="home.php">Home</a></li>
            <li><a href="menu.php">Menu</a></li>
            <li><a href="location.php">Location</a></li>
            <li class="c-active"><a href="contact.php"></a>Review</li>
            <li><a href="mytable.php">My Table</a></li>
        </ul>
        <div class="overlay" onclick="toggleNavLinks()"></div>
        <a href="reservation.php" class="ctn">Reservation</a>
    </header>

    <section class="contact">
        <div class="contact-form">
            <h1>Tell Your <span>Stories</span></h1>
            <p>Hungry for more than just food? Let us know how we can make your dining experience even better</p>
            
            <form action="contact-connection.php" method="POST">
                <input type="text" name="Name" id="name" placeholder="Your Name" required>
                <input type="email" name="Email" id="email" placeholder="E-mail" required>
                <input type="text" name="Subject" id="subject" placeholder="Write a Subject" required>
                <textarea name="Message" id="message" cols="30" rows="10" placeholder="Your Message" oninput="checkMessageLength(this)" required></textarea>
                <div class="word-count"><span id="messageLength">100 words remaining</span></div>
                <input type="submit" value="Submit" class="btn">
            </form>
        </div>

        <div class="contact-img">
            <img src="../img/contacts.gif">
        </div>
    </section>

    <div id="popup" class="popup-message">
    <h2>Your message was sent successfully</h2>
    <p>Rate your experience:</p>
    <div class="rating">
        <input type="radio" id="star1" name="rating" value="1 Star">
        <label for="star1" title="1 stars"></label>
        <input type="radio" id="star2" name="rating" value="2 Star">
        <label for="star2" title="2 stars"></label>
        <input type="radio" id="star3" name="rating" value="3 Star">
        <label for="star3" title="3 stars"></label>
        <input type="radio" id="star4" name="rating" value="4 Star">
        <label for="star4" title="4 stars"></label>
        <input type="radio" id="star5" name="rating" value="5 Star">
        <label for="star5" title="5 star"></label>
    </div>
    <div id="thankyouMessage" class="popup-message">
        <h2>Thank you for your feedback</h2>
    </div>
</div>

    <script src="../JavaScript/navoption.js"></script>
    <script src="../JavaScript/contact.js"></script>


</body>
</html>
