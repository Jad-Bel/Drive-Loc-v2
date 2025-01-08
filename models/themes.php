<?php 

require_once "../config/connect.php";

class theme {
    private $conn;

    public function __construct() {
        $db = new Database;
        $this->conn =  $db->getdatabase();
    }
    
    public function affTheme () {
        $query = "SELECT * FROM themes";
        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function ajjTheme ($thm_nom) {
        try {
            $query = "INSERT INTO themes (thm_nom) Values (:nom)";
            $stmt = $this->conn->prepare($query);
            
            $param = [':nom' => $thm_nom];

            $result = $stmt->execute($param);
            
            return $result;
        } catch (Exception $e) {
            throw new Exception("errur d'ajouter un themes" . $e);
        }
    }

    public function modTheme ($thm_nom, $thm_id) {
        try {
            $query = "UPDATE themes SET thm_nom = :thm_nom WHERE thm_id = :id";
            $stmt = $this->conn->prepare($query);
    
            $param = [
                ":id" => $thm_id,
                ":thm_nom" => $thm_nom
            ];
    
            $result = $stmt->execute($param);
            return $result;
        } catch (Exception $e) {
            throw new Exception("Erreur de modifier ce themes" . $e);
        }
    }

    public function suppTheme ($thm_id) {
        try {
            $query = "DELETE FROM themes WHERE thm_id = :id";
            $stmt = $this->conn->prepare($query);
            $param = ["id" => $thm_id];
            
            $result = $stmt->execute($param);
            return $result;

            if ($result) {
                echo "Suppresion avec succes";
            } 
        } catch (Exception $e) {
            throw new Exception("Erreur de supprimer ce themes" . $e);
        }
    }
}

$article = new theme();

$result = $article->suppTheme(11);

if ($result) {
        var_dump($result);
}   else {
    echo 2;
}