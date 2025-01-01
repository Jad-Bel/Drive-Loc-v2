<?php 

class categorie {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getdatabase();
    }
}