<?php
include("connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["Name"];
    $email = $_POST["Email"];
    $subject = $_POST["Subject"];
    $message = $_POST["Message"];
    $date = date("Y-m-d"); // current date

    $sql = "INSERT INTO contacts (name, email, subject, message, date) VALUES ('$name', '$email', '$subject', '$message', '$date')";

    if ($conn->query($sql) === TRUE) {
        echo '<script>window.location.href = "contact.php";</script>'; // Redirect back to contact.php
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
