<?php
session_start();

include("connection.php");
include("functions.php");
include("rfunction.php");

// Check if the user is logged in
$user_data = check_login($conn);

$reservationID = null;
$emailMatch = true;

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["date"])) {
    // Check if the email confirmation matches the logged-in email
    if ($_POST["contact"] !== $user_data['email']) {
        $emailMatch = false;
    } else {
        $reservationID = $_RSV->saveReservation(
            $_POST["date"], $_POST["time"], $_POST["name"],
            $_POST["contact"], $_POST["head"], $user_data['email']
        );
    }
}

// Fetch reserved time slots
$reservedSlots = $_RSV->getReservationsByEmail($user_data['email']);
$reservedTimes = array();

foreach ($reservedSlots as $slot) {
    $reservedTimes[$slot['date']][] = $slot['time'];
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation</title>
    <link rel="stylesheet" href="../CSS/reservation.css">
    <link rel="shorcut icon" type="img/png" href="../img/logoSD_V2.png">
    
    <script>
        function blockReservedTimes() {
            var dateSelect = document.getElementById('dateSelect');
            var timeSelect = document.getElementById('timeSelect');
            var selectedDate = dateSelect.value;

            // Clear existing options
            timeSelect.innerHTML = '';

            // Fetch reserved times for selected date
            var reservedTimes = <?php echo json_encode($reservedTimes); ?>;

            // Add available time options
            var times = [
                '3:00PM',
                '4:00PM',
                '5:00PM',
                '6:00PM',
                '7:00PM',
                '8:00PM',
                '9:00PM',
                '10:00PM'
            ];

            times.forEach(function(time) {
                var option = document.createElement('option');
                option.value = time;
                option.innerText = time;

                if (reservedTimes[selectedDate] && reservedTimes[selectedDate].includes(time)) {
                    option.disabled = true;
                }

                timeSelect.appendChild(option);
            });
        }
    </script>
</head>
<body>
    <header class="navbar">
        <a href="home.php"><img src="../img/logoSD_V2.png" class="logo"></a>
        
        <div class="toggle-btn" onclick="toggleNavLinks()">=</div>
        <ul class="navlinks">
            <li><a href="home.php">Home</a></li>
            <li><a href="menu.php">Menu</a></li>
            <li><a href="location.php">Location</a></li>
            <li><a href="contact.php">Contact Us</a></li>
            <li><a href="mytable.php">My Table</a></li>
        </ul>
        <div class="overlay" onclick="toggleNavLinks()"></div>
        <a href="reservation.php" class="reserve ctn">Reservation</a>
    </header>

    <section class="banner">
        <h1>Secure Your Table</h1>
        <div class="line"></div>
        <h2>Beat the rush - make a reservation now</h2>
        <div class="card-container">
            <div class="card-img">
                
            </div>

            <div class="card-content">
                <h3>Reservation</h3>
                <form method="post" onsubmit="return validateForm()">
                    <div class="form-row">
                        <input type="date" name="date" id="dateSelect" onchange="blockReservedTimes()" placeholder="Select Date" min="<?php echo date('Y-m-d'); ?>" required>
                        <select name="time" id="timeSelect" required>
                            <option value="hour-select">Select Time</option>
                        </select>
                    </div>

                    <div class="form-row">
                        <input type="text" name="name" placeholder="Full Name" required>
                        <input type="email" name="contact" placeholder="Confirm Email" required>
                    </div>

                    <div class="form-row">
                        <input type="number" name="head" id="head" placeholder="How Many Persons?" min="1" max="15" required>
                        <input type="submit" value="Book Table">
                    </div>

                    <?php if (isset($_POST["date"]) && !$reservationID && !$emailMatch) { ?>
                        <p class="error center-text">Failed to submit reservation. Email confirmation does not match your logged-in email.</p>
                    <?php } ?>
                    
                    <p class="agreement">By submitting this form you agree to our <span class="log"><a href="agreement.php" target="_blank"><br>
                    Terms and Agreement</br></a></span></p>
                </form>
                
                <?php if (isset($_POST["date"]) && $reservationID) { ?>
                    <div id="successMessage" class="note">
                        <span class="close" onclick="closeMessage()">X</span>
                        Take a screenshot of your reservation ID as this will serve as your identification<br>
                        <span class="rsaved">Reservation saved. Your Reservation ID is: <?php echo $reservationID; ?></span>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>

    <script src="../JavaScript/reservation.js"></script>
    <script src="../JavaScript/navoption.js"></script>
</body>
</html>
