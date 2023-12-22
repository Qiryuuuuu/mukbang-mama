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
    $mssgID = $_POST['delete']; // Change the variable name to 'mssgID'
    $deleteStmt = $conn->prepare("DELETE FROM `contacts` WHERE `mssg_ID` = :mssgID"); // the table name to 'mssg_ID'
    $deleteStmt->bindParam(':mssgID', $mssgID); // the parameter name to 'mssgID'
    $deleteStmt->execute();
}

// (D) FETCH USER DATA
$stmt = $conn->query("SELECT * FROM `contacts`"); 
$users = $stmt->fetchAll();

if (!empty($users)) {
    foreach ($users as $user) {
        echo "<tr>";
        echo "<td>" . $user['mssg_ID'] . "</td>";
        echo "<td>" . $user['name'] . "</td>"; 
        echo "<td>" . $user['email'] . "</td>";
        echo "<td>" . $user['subject'] . "</td>";
        echo "<td>" . $user['message'] . "</td>";
        echo "<td>" . $user['date'] . "</td>";
        echo "<td>";
        echo "<form method='POST'>";
        echo "<input type='hidden' name='delete' value='" . $user['mssg_ID'] . "' />";
        echo "<button class='update-btn' type='submit'>Delete</button>";
        echo "</form>";
        echo "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='7'>No Message Found</td></tr>";
}

echo "</table>";

$conn = null; // Close the database connection
?>
