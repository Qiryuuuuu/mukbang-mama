<?php
session_start();
include("connection.php");
include("functions.php");

// Check if the user is logged in
$user_data = check_login($conn);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $rating = $_POST['rating'];

    // Save the rating to the database
    $sql = "INSERT INTO rating (ratings) VALUES ('$rating')";
    mysqli_query($conn, $sql);

    // Get the inserted ID
    $id = mysqli_insert_id($conn);

    // Send the inserted ID as the response
    echo $id;
}
?>
