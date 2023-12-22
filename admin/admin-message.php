<?php 
    session_start();

        include("../PHP/connection.php");
        include("admin-connection.php");
        
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin MukbangMama</title>
    <link rel="stylesheet" type="text/css" href="admin-messages.css">
</head>
<body>

        <header class="navbar">
            <h1>Admin Panel</h1>
                    <ul class="navlinks">
                        <li><a href="admin-rating.php">Rating</a></li>
                        <li class="h-active"><a href="admin-message.php"></a>Messages</li>
                        <li><a href="admin-reserve.php">Reservations</a></li>
                        <li><a href="admin-user.php">Users</a></li>
                    </ul>
                <a href="/website/PHP/home.php" target="_blank" class="ctn">Visit Website</a>
       </header>
    
    <div class="container">
        <table id="reservationTable">
            <thead>
                <tr>
                    <th>Message ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Subject</th>
                    <th>Message</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
              <?php include("./admin-messages.php"); 
              ?>
            </tbody>
        </table>
    </div>

    <form method="POST" action="">
    <button type="submit" name="logout" class="logout-btn" ><a href="admin-logout.php">Logout</a></button>
    </form>
</body>
</html>