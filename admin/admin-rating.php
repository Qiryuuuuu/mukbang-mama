<?php 
    session_start();

    include("../PHP/connection.php");
    include("admin-connection.php");

?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin MukbangMama</title>
    <link rel="stylesheet" type="text/css" href="admin-rating.css">
</head>
<body>

        <header class="navbar">
            <h1>Admin Panel</h1>
                    <ul class="navlinks">
                        <li class="h-active"><a href="admin-user.php">Rating</a></li>
                        <li><a href="admin-message.php">Messages</a></li>
                        <li><a href="admin-reserve.php">Reservations</a></li>
                        <li><a href="admin-user.php">Users</a></li>
                    </ul>
                <a href="/website/PHP/home.php" target="_blank" class="ctn">Visit Website</a>
       </header>
    


    <div class="container">
        <table id="rating">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Rating</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php include("admin-ratings.php");     
                ?>
            </tbody>
        </table>
    </div>

    <form method="POST" action="">
        <button type="submit" name="logout" class="logout-btn" ><a href="admin-logout.php">Logout</a></button>
    </form>
</body>
</html>