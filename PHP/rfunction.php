<?php
class Reservation {
    private $pdo;
    private $stmt;
    public $error;

    function __construct() {
        $this->pdo = new PDO(
            "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET,
            DB_USER, DB_PASSWORD, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_NAMED
        ]);
    }

    function __destruct() {
        $this->pdo = null;
        $this->stmt = null;
    }

    function query($sql, $data = null): void {
        $this->stmt = $this->pdo->prepare($sql);
        $this->stmt->execute($data);
    }

    function saveReservation($date, $time, $name, $contact, $head, $email) {
        if ($this->checkUserEmail($contact, $email)) {
            $this->query(
                "INSERT INTO `reservation` (`date`, `time`, `name`, `contact`, `head`) VALUES (?,?,?,?,?)",
                [$date, $time, $name, $contact, $head]
            );

            $reservationID = $this->pdo->lastInsertId();
            return $reservationID;
        } else {
            $this->error = "Reservation failed. Email address does not match the logged-in user.";
            return false;
        }
    }

    function checkUserEmail($contact, $email) {
        $this->query("SELECT `email` FROM `registrationform` WHERE `email`=?", [$contact]);
        $result = $this->stmt->fetch(PDO::FETCH_ASSOC);

        if ($result && $result['email'] === $email) {
            return true;
        }

        return false;
    }

    function getReservationsByEmail($contact) {
        $this->query("SELECT * FROM `reservation` WHERE `contact`=?", [$contact]);
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    

}

define("DB_HOST", "localhost");
define("DB_NAME", "signupforms");
define("DB_CHARSET", "utf8mb4");
define("DB_USER", "root");
define("DB_PASSWORD", "");

$_RSV = new Reservation();
?>
