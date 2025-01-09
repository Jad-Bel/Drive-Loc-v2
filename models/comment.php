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
            $query = "SELECT c.content, c.creation_date, c.comm_id, 
                             CONCAT(u.user_name, ' ', u.user_last) AS author_name
                      FROM commentaires c
                      JOIN users u ON c.user_id = u.user_id
                      WHERE c.art_id = :art_id
                      ORDER BY c.creation_date DESC";
            $stmt = $this->conn->prepare($query);
    
            $param = [":art_id" => $art_id];
    
            $stmt->execute($param);
    
            $comments = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $comments;
        } catch (Exception $e) {
            throw new Error("Cannot get comments: " . $e->getMessage());
        }
    }
    

    public function addComment($content, $art_id, $user_id) {
        try {
            $query = "INSERT INTO commentaires (content, art_id, user_id, creation_date) 
                  VALUES (:content, :art_id, :user_id, NOW())";
            $stmt = $this->conn->prepare($query);
    
            $param = [
                ":content" => $content,
                ":art_id" => $art_id,
                ":user_id" => $user_id
            ];
            
            $result = $stmt->execute($param);
            return $result;
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

    public function countComm ($art_id) {
        try {
            $query = "SELECT COUNT(*) AS total_comments FROM commentaires WHERE art_id = :art_id";
            
            $stmt = $this->conn->prepare($query);
            
            $stmt->execute([":art_id" => $art_id]);
            
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
            return $result['total_comments'];
        } catch (PDOException $e) {
            error_log("Error counting comments: " . $e->getMessage());
            return 0;
        }
    }
}

