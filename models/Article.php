<?php 

require_once "../config/connect.php";

class article {
    private $conn;

    public function __construct() {
        $db = new Database;
        $this->conn =  $db->getdatabase();
    }
    
    public function affArticle () {
        $query = "SELECT * FROM article";
        $stmt = $this->conn->prepare($query);

        $stmt->execute();
    }

    public function ajjArticle ($title, $content, $date, $thm_id, $status, $user_id) {
        try {
            $query = "INSERT INTO article (title, content, creation_date, thm_id, status, user_id) Values (:title, :content, :date, :thm_id, :status, :user_id)";
            $stmt = $this->conn->prepare($query);
            $param = [':title' => $title,
                    ':content' => $content,
                    ':date' => $date,
                    ':thm_id' => $thm_id,
                    ':status' => $status,
                    ':user_id'=> $user_id];

            $result = $stmt->execute($param);
            if ($result) {
                echo "Errer d'execution";
            } 

            return $result;
        } catch (Exception $e) {
            throw new Exception("errur d'ajouter un article" . $e);
        }
    }
}