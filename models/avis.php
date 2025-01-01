<?php 
include "../config/connect.php";
class avis {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getdatabase();
    }

    public function affAllAvis () {
        $query = "SELECT * FROM avis";
        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        $avis = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $avis;
    }

    public function affichierAvis () {
        $query = "SELECT * FROM avis WHERE ";
    }

    public function ajouterAvis ($user_id, $vehicule_id, $avis) {
        try {
            $avis = htmlspecialchars($avis);
            $query = "INSERT INTO avis (user_id, vehicule_id, avis) VALUE (:user_id, :vehicule_id, :avis)";
            $stmt = $this->conn->prepare($query);
    
            $param = [
                        ":user_id" => $user_id,
                        ":vehicule_id" => $vehicule_id,
                        ":avis" => $avis];
    
            $stmt->execute($param);
        } catch (Exception $e) {
            throw new Error("cannot add avis:" . $e->getMessage());
        }
    }

    public function modifierAvis ($avis_id, $user_id, $vehicule_id, $avis) {
        try {
            $id = htmlspecialchars(intval($avis_id));
            $query = "UPDATE avis SET user_id = :user_id, vehicule_id = :vehicule_id, avis = :avis WHERE avis_id = :id";
            $stmt = $this->conn->prepare($query);

            $param = [
                        ":user_id" => $user_id,
                        ":vehicule_id" => $vehicule_id,
                        ":avis" => $avis,
                        ":id" => $id];

            $stmt->execute($param);
        } catch (Exception $e) {
            throw new Error("cannot update avis:" . $e->getMessage());
        }

    }

    public function suppAvis ($avis_id) {
        try {
            $id = htmlspecialchars(intval($avis_id));
            $query = "DELETE FROM avis WHERE avis_id = :id";
            $stmt = $this->conn->prepare($query);
            $param = [":id" => $id];

            $stmt->execute($param);
        } catch (Exception $e) {
            throw new Error("cannot delete avis:" . $e->getMessage());
        }
    }
}

// $data = new avis();
// $result = $data->modifierAvis(8, 8, 3, "une voiture très bien");
// if ($result) {
//     echo "Avis ajouté";
// } else {
//     echo "Erreur";
// }