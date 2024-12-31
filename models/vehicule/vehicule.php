<?php
require_once '../../config/connect.php';

class vehicule {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getdatabase();
    }

    public function affAllVehicule() {
        $db = new Database();
        $this->conn = $db->getdatabase();

        $query = "SELECT * FROM vehicule";
        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        $vehicule = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $vehicule;
    } 

    public function ajouterVeh ($marque, $categorie, $disponibilite, $prix, $desc) {
        $marque = htmlspecialchars($marque);
        $categorie = htmlspecialchars($categorie);
        $disponibilite = htmlspecialchars($disponibilite);
        $prix = htmlspecialchars($prix);
        $desc = htmlspecialchars($desc);

        $query = "INSERT INTO vehicule (marque, disponibilite, prix, description) VALUES (:marque, :disp, :prix, :desc)";
        $stmt = $this->conn->prepare($query);

        $param = [":marque" => $marque,
                    ":disp" => $disponibilite,
                    ":prix" => $prix,
                    ":desc" => $desc];

        $stmt->execute($param);
    }

    public function modifierVeh ($vehicule_id, $marque, $categorie, $disponibilite, $prix, $desc) {
        $id = htmlspecialchars(intval($vehicule_id));
        $marque = htmlspecialchars($marque);
        $categorie = htmlspecialchars($categorie);
        $disponibilite = htmlspecialchars($disponibilite);
        $prix = htmlspecialchars($prix);
        $desc = htmlspecialchars($desc);

        $query = "UPDATE vehicule SET marque = :marque, disponibilite = :disp, prix = :prix, description = :desc WHERE vehicule_id = :id";
        $stmt = $this->conn->prepare($query);

        $param = [":id" => $vehicule_id,
                ":marque" => $marque,
                ":disp" => $disponibilite,
                ":prix" => $prix,
                ":desc" => $desc];

        $result = $stmt->execute($param);
        if (!$result) {
            echo "Record updated successfully";
        } else {
            echo "Error updating record";
        }
    }

    
}

$data = new vehicule();
$result = $data->ajouterVeh("Toyota", "1", 100, "Voiture de luxe");

if (!$result) {
    echo "Record inserted successfully";
} else {
    echo "Error inserting record";
}

?>

<img src="" alt="">