<?php 

class categorie {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getdatabase();
    }

    public function affAllCategorie() {
        $query = "SELECT * FROM categorie";
        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        $categorie = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $categorie;
    }
}