<?php
session_start();

    // Check if a status update or reservation deletion has occurred and display a pop-up message
    if (isset($_SESSION['status_update']) && $_SESSION['status_update'] === true) {
        $popupText = "The status of your reservation has been updated.";

        // Check if the reservation was deleted by the admin
        if (isset($_SESSION['reservation_deleted']) && $_SESSION['reservation_deleted'] === true) {
            $popupText = "Your reservation was deleted.";
            unset($_SESSION['reservation_deleted']);
        }

        echo "<div class='popup'>";
        echo "<span class='close-btn' onclick='this.parentElement.style.display=\"none\"'>X</span>";
        echo "<p>$popupText</p>";
        echo "</div>";

        unset($_SESSION['status_update']);
    } elseif (isset($_SESSION['reservation_deleted']) && $_SESSION['reservation_deleted'] === true) {
        $popupText = "Your reservation was deleted.";

        echo "<div class='popup'>";
        echo "<span class='close-btn' onclick='this.parentElement.style.display=\"none\"'>X</span>";
        echo "<p>$popupText</p>";
        echo "</div>";

        unset($_SESSION['reservation_deleted']);
    }


include("connection.php");
include("functions.php");
include("rfunction.php");

// Check if the user is logged in
$user_data = check_login($conn);

// Retrieve the reservations for the user's email
$reservations = $_RSV->getReservationsByEmail($user_data['email']);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Table</title>
    <link rel="stylesheet" href="../CSS/mytable.css">
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
            <li><a href="contact.php">Review</a></li>
            <li class="c-active"><a href="mytable.php"></a>My Table</li>
        </ul>
        <div class="overlay" onclick="toggleNavLinks()"></div>
        <a href="reservation.php" class="ctn">Reservation</a>
    </header>

           
        

    <div class="container">
        <div class="tags">
            <h1>Your Table Awaits You</h1>
            <div class="line"></div>
            <h2>We are excited to meet you!</h2>
        </div>
            
        <table id="reservationTable">
            <thead>
                <tr>
                    <th>Reservation ID</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Head</th>
                    <th>Status</th>
                </tr>
            </thead>

            <tbody>
            <?php foreach ($reservations as $reservation) { ?>
                <tr>
                    <td><?php echo $reservation['res_ID']; ?></td>
                    <td><?php echo $reservation['date']; ?></td>
                    <td><?php echo $reservation['time']; ?></td>
                    <td><?php echo $reservation['name']; ?></td>
                    <td><?php echo $reservation['contact']; ?></td>
                    <td><?php echo $reservation['head']; ?></td>
                    <td><?php echo $reservation['status'] ? $reservation['status'] : 'PENDING'; ?></td>

                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>

    <script src="../JavaScript/navoption.js"></script>
    <script src="../JavaScript/reservation.js"></script>
</body>
</html>
