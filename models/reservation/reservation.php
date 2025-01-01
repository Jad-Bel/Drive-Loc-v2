<?php 
include "../../config/connect.php";

class reservation {
    private $conn;

    public function __construct () {
        $db = new Database();
        $this->conn = $db->getdatabase();
    }

    public function affAllReservation () {
        $query = "SELECT * FROM reservation";
        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        $reservation = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $reservation;
    }
}