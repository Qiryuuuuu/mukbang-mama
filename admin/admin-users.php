<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/XAMPP/htdocs/website/PHP/connection.php';  // Adjust the path if needed

// (A) INCLUDE DATABASE CONNECTION SETTINGS
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'signupforms';

// (B) ESTABLISH DATABASE CONNECTION
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8mb4", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// (C) HANDLE DELETE REQUEST
if (isset($_POST['delete'])) {
    $userID = $_POST['delete'];
    $deleteStmt = $conn->prepare("DELETE FROM `registrationform` WHERE `user_id` = :userID");
    $deleteStmt->bindParam(':userID', $userID);
    $deleteStmt->execute();
}

// (D) FETCH USER DATA
$stmt = $conn->query("SELECT * FROM `registrationform`");
$users = $stmt->fetchAll();



if (!empty($users)) {
    foreach ($users as $user) {
        echo "<tr>";
        echo "<td>" . $user['user_id'] . "</td>";
        echo "<td>" . $user['email'] . "</td>";
     
        echo "<td>" . $user['date'] . "</td>";
        echo "<td>";
        echo "<form method='POST'>";
        echo "<input type='hidden' name='delete' value='" . $user['user_id'] . "' />";
        echo "<button class='update-btn' type='submit'>Delete</button>";
        echo "</form>";
        echo "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='4'>No users found</td></tr>";
}

echo "</table>";

$conn = null; // Close the database connection
?>
