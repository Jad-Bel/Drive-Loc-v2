<?php
// include "../../../config/connect.php";

class vehicule {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getdatabase();
    }

    public function affAllVehicule() {
        $db = new Database();
        $this->conn = $db->getdatabase();

        
        
        $query = "SELECT * FROM vehicules";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();


        $vehicule = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $vehicule;
    } 

    public function getVehiculeById($id) {
        try {
            $query = "SELECT * FROM vehicules WHERE vehicule_id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([':id' => $id]);
            
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            throw new Error("Cannot get vehicle: " . $e->getMessage());
        }
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

    public function supprimerVeh ($vehicule_id) {
        $id = htmlspecialchars(intval($vehicule_id));

        $query = "DELETE FROM vehicule WHERE vehicule_id = :id";
        $stmt = $this->conn->prepare($query);

        $param = [":id" => $vehicule_id];
        $result = $stmt->execute($param);

        if (!$result) {
            echo "Record deleted successfully";
        } else {
            echo "Error deleting record";
        }


    }
}

class vehiculeList {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getdatabase();
    }

    public function countVehicules () {
        try {
            $query = "SELECT COUNT(*) AS total FROM vehicules";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();

            $count = $stmt->fetch(PDO::FETCH_ASSOC);
            return $count['total'];
        } catch (Exception $e) {
            throw new Error ("Erreur de conter les vehicules: " . $e->getMessage());
        }
    }

    public function getVehiclesByPage ($limit = 5, $startIndex = 0) {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM vehicules LIMIT :limit OFFSET :startIndex");
            $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
            $stmt->bindParam(':startIndex', $startIndex, PDO::PARAM_INT);
            $stmt->execute();
            $vehicule = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
            return $vehicule;
        } catch (Exception $e) {
            throw new Error("query failed: " . $e->getMessage());
        }
    }
}
// $data = new vehiculeList();
// $result = $data->getVehiclesByPage();
// var_dump($result);

// if (!$result) {
//     echo "Record inserted successfully";
// } else {
//     echo "Error inserting record";
// }

?>

<img src="" alt="">