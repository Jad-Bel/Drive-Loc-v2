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

    public function modArticle ($art_id, $title, $content, $date, $thm_id, $status, $user_id) {
        try {
            $query = "UPDATE articles SET :id = $art_id, :title = $title, :content = $content, :date = $date, :thm_id = $thm_id, :user = $user_id";
            $stmt = $this->conn->prepare($query);
    
            $param = [
                    ":id" => $art_id,
                    ":title" => $title,
                    ':content' => $content,
                    ':date' => $date,
                    ':thm_id' => $thm_id,
                    ':status' => $status,
                    ':user_id'=> $user_id
                     ];
    
            $result = $stmt->execute($param);
            return $result;
        } catch (Exception $e) {
            throw new Exception("Erreur de modifier cette article" . $e);
        }
    }
}

$article = new article();

$result = $article->affArticle();

if ($result) {
        var_dump($result);
}   else {
    echo 2;
}