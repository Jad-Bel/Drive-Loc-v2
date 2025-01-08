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

    public function ajouterVeh($marque, $disponibilite, $prix, $description, $vhc_image, $mileage, $model, $transmition, $vhc_name) {
        // $categorie_id = htmlspecialchars($categorie_id);
        $marque = htmlspecialchars($marque);
        $disponibilite = htmlspecialchars($disponibilite);
        $prix = htmlspecialchars($prix);
        $description = htmlspecialchars($description);
        $vhc_image = $vhc_image;
        $mileage = htmlspecialchars($mileage);
        $model = htmlspecialchars($model);
        $transmition = htmlspecialchars($transmition);
        $vhc_name = htmlspecialchars($vhc_name);

        $query = "INSERT INTO vehicules (marque, disponibilite, prix, description, vhc_image, mileage, model, transmition, vhc_name) 
                  VALUES (:marque, :disponibilite, :prix, :description, :vhc_image, :mileage, :model, :transmition, :vhc_name)";
        $stmt = $this->conn->prepare($query);

        $param = [
            // ":categorie_id" => $categorie_id,
            ":marque" => $marque,
            ":disponibilite" => $disponibilite,
            ":prix" => $prix,
            ":description" => $description,
            ":vhc_image" => $vhc_image,
            ":mileage" => $mileage,
            ":model" => $model,
            ":transmition" => $transmition,
            ":vhc_name" => $vhc_name
        ];

        $stmt->execute($param);
    }


    public function modifierVeh($vehicule_id, $marque, $disponibilite, $prix, $description, $vhc_image, $mileage, $model, $transmition, $vhc_name) {
        $vehicule_id = htmlspecialchars(intval($vehicule_id));
        $vehicule_id = htmlspecialchars(intval($vehicule_id));
        // $categorie_id = htmlspecialchars($categorie_id);
        $marque = htmlspecialchars($marque);
        $disponibilite = htmlspecialchars($disponibilite);
        $prix = htmlspecialchars($prix);
        $description = htmlspecialchars($description);
        $vhc_image = htmlspecialchars($vhc_image);
        $mileage = htmlspecialchars($mileage);
        $model = htmlspecialchars($model);
        $transmition = htmlspecialchars($transmition);
        $vhc_name = htmlspecialchars($vhc_name);

        $query = "UPDATE vehicules SET 
                  marque = :marque, disponibilite = :disponibilite, 
                  prix = :prix, description = :description, vhc_image = :vhc_image, 
                  mileage = :mileage, model = :model, transmition = :transmition, vhc_name = :vhc_name 
                  WHERE vehicule_id = :vehicule_id";
        $stmt = $this->conn->prepare($query);

        $param = [
            ":vehicule_id" => $vehicule_id,
            // ":categorie_id" => $categorie_id,
            ":marque" => $marque,
            ":disponibilite" => $disponibilite,
            ":prix" => $prix,
            ":description" => $description,
            ":vhc_image" => $vhc_image,
            ":mileage" => $mileage,
            ":model" => $model,
            ":transmition" => $transmition,
            ":vhc_name" => $vhc_name
        ];
    
        $stmt->execute($param);
    }


    public function supprimerVeh ($vehicule_id) {
        $id = intval($vehicule_id);

        $stmt = $this->conn->prepare("DELETE FROM avis WHERE vehicule_id = :vehicule_id");
        $stmt->execute(['vehicule_id' => $id]);

        $stmt = $this->conn->prepare("DELETE FROM vehicules WHERE vehicule_id = :vehicule_id");
        $stmt->execute(['vehicule_id' => $id]);

        return true;

        if (!$result) {
            echo "Record deleted successfully";
        } else {
            echo "Error deleting record";
        }


    }


    public function countVeh () {
        $query = "SELECT COUNT(*) AS total FROM vehicules";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $count = $stmt->fetch(PDO::FETCH_ASSOC);
        return $count['total'];
    }
}

class vehiculeList {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getdatabase();
    }

    public function countVehicules ($search = '') {
        try {
            $query = "SELECT COUNT(*) as total FROM vehicules WHERE vhc_name LIKE :search";
            $stmt = $this->conn->prepare($query);
            $stmt->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return (int) $result['total'];
        } catch (Exception $e) {
            throw new Error ("Erreur de conter les vehicules: " . $e->getMessage());
        }
    }

    public function getVehiclesByPage ($limit, $offset, $search = '') {
        try {
            $query = "SELECT * FROM vehicules WHERE vhc_name LIKE :search LIMIT :limit OFFSET :offset";
            $stmt = $this->conn->prepare($query);
            $stmt->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);
            $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
            $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (Exception $e) {
            throw new Error("Cannot get vehicles: " . $e->getMessage());
        }

    }



    public function getVehiculesByCategorie($categorie_id) {
        try {
            if (empty($categorie_id)) {
                $query = "SELECT * FROM vehicules";
                $stmt = $this->conn->prepare($query);
                $stmt->execute();
            } 
            else {
                $query = "SELECT * FROM vehicules WHERE categorie_id = :categorie_id";
                $stmt = $this->conn->prepare($query);
                $stmt->execute([':categorie_id' => $categorie_id]);
            }
        } catch (Exception $e) {
            throw new Error("Cannot get vehicles: " . $e->getMessage());
        }
    }

    public function getVehBySearch ($search) {
        try {
            $query = "SELECT * FROM vehicules WHERE marque LIKE :search OR vhc_name LIKE :search";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([':search' => '%' . $search]);
            $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if ($row > 0) {
                return $row;
            } else {
                echo "<h6 class='text-danger text-center mt-3'>No vehicule found</h6>";
            }
        } catch (Exception $e) {
            throw new Error("Cannot get vehicles: " . $e->getMessage());
        } catch (Exception $e) {

        }
    }
}
