<?php 
include "../../config/connect.php";
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
        $query = "INSERT INTO avis (user_id, vehicule_id, avis) VALUE (:user_id, :vehicule_id, :avis)";
        $stmt = $this->conn->prepare($query);

        $param = [
                    ":user_id" => $user_id,
                    ":vehicule_id" => $vehicule_id,
                    ":avis" => $avis];

        $stmt->execute($param);
    }
}

$data = new avis();
$result = $data->ajouterAvis(7, 2, "test");
if ($result) {
    echo "Avis ajouté";
} else {
    echo "Erreur";
}