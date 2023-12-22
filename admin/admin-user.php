<?php 
    session_start();

        include("../PHP/connection.php");
        include("admin-connection.php");

?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin MukbangMama</title>
    <link rel="stylesheet" type="text/css" href="admin-user.css">
</head>
<body>

<header class="navbar">
    <h1>Admin Panel</h1>
    <ul class="navlinks">
        <li><a href="admin-rating.php">Rating</a></li>
        <li><a href="admin-message.php">Messages</a></li>
        <li><a href="admin-reserve.php">Reservations</a></li>
        <li class="h-active"><a href="admin-user.php"></a>Users</li>
    </ul>
   
    <a href="/website/PHP/home.php" class="ctn">Visit Website</a>
</header>

<div class="container">
    <table id="reservationTable">
        <thead>
        <tr>
            <th>User ID</th>
            <th>Email</th>
            
            <th>Date</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php include("admin-users.php"); 
        ?>
        </tbody>
    </table>
</div>

<div class="container">
    <table id="AdminTable">
        <thead>
        <tr>
            <th>Admin ID</th>
            <th>Email</th>
            
            <th>Date</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php include("admin-form.php"); 
        ?>
        </tbody>
    </table>
</div>

<form method="POST" action="">
<button type="submit" name="logout" class="logout-btn" ><a href="admin-logout.php">Logout</a></button>
    </form>
</body>
</html>
