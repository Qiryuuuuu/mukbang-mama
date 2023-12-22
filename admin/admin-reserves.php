<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/XAMPP/htdocs/website/PHP/rfunction.php';

try {
    $conn = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4", DB_USER, DB_PASSWORD);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

if (isset($_POST['delete'])) {
    $resID = $_POST['delete'];
    $deleteStmt = $conn->prepare("DELETE FROM `reservation` WHERE `res_ID` = :resID");
    $deleteStmt->bindParam(':resID', $resID);
    $deleteStmt->execute();

    // Set a session variable to indicate the reservation was deleted
    $_SESSION['reservation_deleted'] = true;
}

if (isset($_POST['status'])) {
    $resID = $_POST['resID'];
    $status = $_POST['status'];

    $updateStmt = $conn->prepare("UPDATE `reservation` SET `status` = :status WHERE `res_ID` = :resID");
    $updateStmt->bindParam(':status', $status);
    $updateStmt->bindParam(':resID', $resID);
    $updateStmt->execute();

    // Set a session variable to indicate the status update
    $_SESSION['status_update'] = true;
}

$stmt = $conn->query("SELECT * FROM `reservation`");
$reservations = $stmt->fetchAll();

if (!empty($reservations)) {
    foreach ($reservations as $reservation) {

        // Set the default status to "Pending" if no status is provided
        $status = $reservation['status'] ? $reservation['status'] : 'pending';

        echo "<tr>";
        echo "<td>" . $reservation['res_ID'] . "</td>";
        echo "<td>" . $reservation['date'] . "</td>";
        echo "<td>" . $reservation['time'] . "</td>";
        echo "<td>" . $reservation['name'] . "</td>";
        echo "<td>" . $reservation['contact'] . "</td>";
        echo "<td>" . $reservation['head'] . "</td>";
        echo "<td>" . getStatusLabel($status, $reservation['res_ID']) . "</td>"; // Display the status label with the form
        echo "<td>";
        echo "<form method='POST'>";
        echo "<input type='hidden' name='resID' value='" . $reservation['res_ID'] . "'>"; // Add hidden input field for reservation ID
        echo "<button type='submit' class='update-btn' name='delete' value='" . $reservation['res_ID'] . "'>Delete</button>";
        echo "</form>";
        echo "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='8'>No reservations found</td></tr>";
}


$conn = null;

function getStatusLabel($status, $resID)
{
    $pendingSelected = "";
    $approvedSelected = "";
    $declinedSelected = "";
    $canceledSelected = "";
    $completeSelected = ""; // Add new variable for "Complete" status

    switch ($status) {
        case 'PENDING':
            $pendingSelected = "selected";
            break;
        case 'APPROVED':
            $approvedSelected = "selected";
            break;
        case 'DECLINED':
            $declinedSelected = "selected";
            break;
        case 'CANCELLED':
            $canceledSelected = "selected";
            break;
        case 'COMPLETED': // Handle "Complete" status
            $completeSelected = "selected";
            break;
        default:
            break;
    }

    $label = "<form method='POST'>";
    $label .= "<input type='hidden' name='resID' value='" . $resID . "'>";
    $label .= "<select name='status' class='status-select'>";
    $label .= "<option value='PENDING' " . $pendingSelected . ">PENDING</option>";
    $label .= "<option value='APPROVED' " . $approvedSelected . ">APPROVED</option>";
    $label .= "<option value='DECLINED' " . $declinedSelected . ">DECLINED</option>";
    $label .= "<option value='CANCELLED' " . $canceledSelected . ">CANCELLED</option>";
    $label .= "<option value='COMPLETED' " . $completeSelected . ">COMPLETED</option>"; 
    $label .= "</select>";
    $label .= "<button type='submit' class='update-btn-small'>Update</button>";
    $label .= "</form>";

    return $label;
}

?>
