<?php
require_once '../../config/connect.php';

class vehicule {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getdatabase();
    }

    public function ajouterVehicule() {
        
    }
}

?>

<img src="" alt="">