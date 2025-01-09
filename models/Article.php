<?php
// include "../../../config/connect.php";

class Article {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getdatabase();
    }

    public function getAllArticles() {
        try {
            $query = "SELECT * FROM articles";
            $stmt = $this->conn->prepare($query);

            $stmt->execute();

            $articles = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $articles;
        } catch (Exception $e) {
            throw new Error("Cannot get articles: " . $e->getMessage());
        }
    }

    public function getArticleById($art_id) {
        try {
            $query = "SELECT a.art_id, a.title, creation_date, content, CONCAT(u.user_name, ' ', u.user_last) AS author_name
                      FROM articles a
                      JOIN users u ON a.user_id = u.user_id
                      WHERE a.art_id = :art_id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":art_id", $art_id, PDO::PARAM_INT);

            $stmt->execute();

            $articles = $stmt->fetch(PDO::FETCH_ASSOC);
            return $articles ?? [];
        } catch (Exception $e) {
            throw new Error("Cannot get articles: " . $e->getMessage());
        }
    }

    public function addArticle($title, $content, $user_id, $thm_id) {
        try {
            $query = "INSERT INTO articles (title, content, user_id, creation_date, thm_id, status) 
                      VALUES (:title, :content, :user_id, NOW(), :thm_id, 0)";
            $stmt = $this->conn->prepare($query);

            $param = [
                ":title" => $title,
                ":content" => $content,
                ":user_id" => $user_id,
                ":thm_id" => $thm_id
            ];
            
            $stmt->execute($param);
            return $this->conn->lastInsertId();
        } catch (Exception $e) {
            throw new Error("Cannot add article: " . $e->getMessage());
        }
    }

    public function deleteArticle($art_id) {
        try {
            $id = htmlspecialchars(intval($art_id));
            $query = "DELETE FROM articles WHERE art_id = :id";
            $stmt = $this->conn->prepare($query);

            $param = [":id" => $id];

            $stmt->execute($param);
        } catch (Exception $e) {
            throw new Error("Cannot delete article: " . $e->getMessage());
        }
    }

    public function updateArticle($art_id, $title, $content, $thm_id, $status) {
        try {
            $query = "UPDATE articles SET title = :title, content = :content, thm_id = :thm_id, status = :status 
                      WHERE art_id = :id";
            $stmt = $this->conn->prepare($query);

            $param = [
                ":id" => $art_id,
                ":title" => $title,
                ":content" => $content,
                ":thm_id" => $thm_id,
                ":status" => $status
            ];

            $stmt->execute($param);
        } catch (Exception $e) {
            throw new Error("Cannot update article: " . $e->getMessage());
        }
    }

    public function getArticlesByTheme($thm_id) {
        try {
            $query = "SELECT * FROM articles WHERE thm_id = :thm_id";
            $stmt = $this->conn->prepare($query);

            $param = [":thm_id" => $thm_id];

            $stmt->execute($param);

            $articles = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $articles;
        } catch (Exception $e) {
            throw new Error("Cannot get articles by theme: " . $e->getMessage());
        }
    }

    public function getLatestArticle ($user_id) {
        try {
            $stmt = $this->conn->prepare("
            SELECT a.art_id, a.title, a.content, a.creation_date
            FROM articles a
            WHERE a.user_id = :user_id
            ORDER BY a.creation_date DESC
            LIMIT 1
            ");
            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            throw new Exception('Erreur fetching last articles posted ' . $e);
        }
    }

}

