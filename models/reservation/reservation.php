<?php 
include "../../config/connect.php";

class reservation {
    private $conn;

    public function __construct () {
        $db = new Database();
        $this->conn = $db->getdatabase();
    }
}