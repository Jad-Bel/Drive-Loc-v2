<?php
// include "../../../config/connect.php";

class Comment {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getdatabase();
    }

    public function getCommentsByArticle($art_id) {
        try {
            $query = "SELECT * FROM commentaires WHERE art_id = :art_id ORDER BY creation_date DESC";
            $stmt = $this->conn->prepare($query);

            $param = [":art_id" => $art_id];

            $stmt->execute($param);

            $comments = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $comments;
        } catch (Exception $e) {
            throw new Error("Cannot get comments: " . $e->getMessage());
        }
    }

    public function addComment($content, $art_id) {
        try {
            $query = "INSERT INTO commentaires (content, creation_date, art_id) VALUES (:content, NOW(), :art_id)";
            $stmt = $this->conn->prepare($query);

            $param = [
                ":content" => $content,
                ":art_id" => $art_id
            ];
            
            $stmt->execute($param);
            return $this->conn->lastInsertId();
        } catch (Exception $e) {
            throw new Error("Cannot add comment: " . $e->getMessage());
        }
    }

    public function deleteComment($comm_id) {
        try {
            $id = htmlspecialchars(intval($comm_id));
            $query = "DELETE FROM commentaires WHERE comm_id = :id";
            $stmt = $this->conn->prepare($query);

            $param = [":id" => $id];

            $stmt->execute($param);
        } catch (Exception $e) {
            throw new Error("Cannot delete comment: " . $e->getMessage());
        }
    }

    public function updateComment($comm_id, $content) {
        try {
            $query = "UPDATE commentaires SET content = :content WHERE comm_id = :id";
            $stmt = $this->conn->prepare($query);

            $param = [
                ":id" => $comm_id,
                ":content" => $content
            ];

            $stmt->execute($param);
        } catch (Exception $e) {
            throw new Error("Cannot update comment: " . $e->getMessage());
        }
    }
}

