<?php 

require_once "../config/connect.php";

class article {
    private $conn;

    public function __construct() {
        $db = new Database;
        $this->conn =  $db->getdatabase();
    }
    
    public function affArticle () {
        $query = "SELECT * FROM articles";
        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function ajjArticle ($title, $content, $date, $thm_id, $status, $user_id) {
        try {
            $query = "INSERT INTO articles (title, content, creation_date, thm_id, status, user_id) Values (:title, :content, :date, :thm_id, :status, :user_id)";
            $stmt = $this->conn->prepare($query);
            
            $param = [':title' => $title,
                    ':content' => $content,
                    ':date' => $date,
                    ':thm_id' => $thm_id,
                    ':status' => $status,
                    ':user_id'=> $user_id];

            $result = $stmt->execute($param);
            
            return $result;
        } catch (Exception $e) {
            throw new Exception("errur d'ajouter un article" . $e);
        }
    }

    public function modArticle ($title, $content, $date, $thm_id, $status, $user_id, $art_id) {
        try {
            $query = "UPDATE articles SET art_id = :id, title = :title, content = :content, creation_date = :date, thm_id = :thm_id, status = :status, user_id = :user_id WHERE art_id = :id";
            $stmt = $this->conn->prepare($query);
    
            $param = [
                ":id" => $art_id,
                ":title" => $title,
                ":content" => $content,
                ":date" => $date,
                ":thm_id" => $thm_id,
                ":status" => $status,
                ":user_id" => $user_id
            ];
    
            $result = $stmt->execute($param);
            return $result;
        } catch (Exception $e) {
            throw new Exception("Erreur de modifier cette article" . $e);
        }
    }

    public function suppArticle ($art_id) {
        try {
            $query = "DELETE FROM articles WHERE art_id = :id";
            $stmt = $this->conn->prepare($query);
            $param = ["id" => $art_id];
            
            $result = $stmt->execute($param);
            return $result;

            if ($result) {
                echo "Suppresion avec succes";
            } 
        } catch (Exception $e) {
            throw new Exception("Erreur de supprimer cette article" . $e);
        }
    }
}

// $article = new article();

// $result = $article->modArticle("test1", "test1", "2025-12-12", 2, 1, 7, 1);

// if ($result) {
//         var_dump($result);
// }   else {
//     echo 2;
// }