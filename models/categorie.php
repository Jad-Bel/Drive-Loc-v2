<?php 
// include "../../../config/connect.php";

class categorie {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getdatabase();
    }

    public function getAllCategories() {
        try {
            $query = "SELECT * FROM categorie ORDER BY ctg_name";
            $stmt = $this->conn->prepare($query);

            $stmt->execute();

            $categorie = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $categorie;
        } catch (Exception $e) {
            throw new Error("cannot get categorie:" . $e->getMessage());
        }
    }

    public function ajouterCat ($ctg_name) {
        try {
            $ctg_name = htmlspecialchars($ctg_name);
            $query = "INSERT INTO categorie (ctg_name) VALUES (:ctg)";
            $stmt = $this->conn->prepare($query);

            $param = [":ctg" => $ctg_name];

            $stmt->execute($param);
        } catch (Exception $e) {
            throw new Error("cannot add categorie:" . $e->getMessage());
        }
    }
    
    public function modifierCat ($categorie_id, $ctg_name) {
        try {
            $ctg_name = htmlspecialchars($ctg_name);
            $query = "UPDATE categorie SET ctg_name = :ctg WHERE categorie_id = :id";

            $stmt = $this->conn->prepare($query);
            $param = [":ctg" => $ctg_name, ":id" => $categorie_id];

            $stmt->execute($param);
        } catch (Exception $e) {
            throw new Error("cannot update categorie:" . $e->getMessage());
        }
    }

    public function suppCat ($ctg_id) {
        try {
            $id = htmlspecialchars(intval($ctg_id));
            $query = "DELETE FROM categorie WHERE categorie_id = :id";
            $stmt = $this->conn->prepare($query);

            $param = [":id" => $id];

            $stmt->execute($param);
        } catch (Exception $e) {
            throw new Error("cannot delete categorie:" . $e->getMessage());
        }
    }

}


// $ctg = new categorie();
// $result = $ctg->suppCat(1);

// if ($result) {
//     echo "categorie ajouté";
// } else {
//     echo "erreur";
// }