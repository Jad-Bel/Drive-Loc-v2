<?php
// include "../../../config/connect.php";

class Tag {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getdatabase();
    }

    public function getAllTags() {
        try {
            $query = "SELECT * FROM tags";
            $stmt = $this->conn->prepare($query);

            $stmt->execute();

            $tags = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $tags;
        } catch (Exception $e) {
            throw new Error("Cannot get tags: " . $e->getMessage());
        }
    }

    public function addTag($nom) {
        try {
            $query = "INSERT INTO tags (nom) VALUES (:nom)";
            $stmt = $this->conn->prepare($query);

            $param = [":nom" => $nom];
            
            $stmt->execute($param);
            return $this->conn->lastInsertId();
        } catch (Exception $e) {
            throw new Error("Cannot add tag: " . $e->getMessage());
        }
    }

    public function deleteTag($tag_id) {
        try {
            $id = htmlspecialchars(intval($tag_id));
            $query = "DELETE FROM tags WHERE tag_id = :id";
            $stmt = $this->conn->prepare($query);

            $param = [":id" => $id];

            $stmt->execute($param);
        } catch (Exception $e) {
            throw new Error("Cannot delete tag: " . $e->getMessage());
        }
    }

    public function updateTag($tag_id, $nom) {
        try {
            $query = "UPDATE tags SET nom = :nom WHERE tag_id = :id";
            $stmt = $this->conn->prepare($query);

            $param = [
                ":id" => $tag_id,
                ":nom" => $nom
            ];

            $stmt->execute($param);
        } catch (Exception $e) {
            throw new Error("Cannot update tag: " . $e->getMessage());
        }
    }

    public function getTagsForArticle($art_id) {
        try {
            $query = "SELECT t.* FROM tags t 
                      JOIN article_tags at ON t.tag_id = at.tag_id 
                      WHERE at.art_id = :art_id";
            $stmt = $this->conn->prepare($query);

            $param = [":art_id" => $art_id];

            $stmt->execute($param);

            $tags = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $tags;
        } catch (Exception $e) {
            throw new Error("Cannot get tags for article: " . $e->getMessage());
        }
    }

    public function addTagToArticle($tag_id, $art_id) {
        try {
            $query = "INSERT INTO article_tags (art_id, tag_id) VALUES (:art_id, :tag_id)";
            $stmt = $this->conn->prepare($query);

            $param = [
                ":art_id" => $art_id,
                ":tag_id" => $tag_id
            ];
            
            $stmt->execute($param);
        } catch (Exception $e) {
            throw new Error("Cannot add tag to article: " . $e->getMessage());
        }
    }

    public function removeTagFromArticle($tag_id, $art_id) {
        try {
            $query = "DELETE FROM article_tags WHERE art_id = :art_id AND tag_id = :tag_id";
            $stmt = $this->conn->prepare($query);

            $param = [
                ":art_id" => $art_id,
                ":tag_id" => $tag_id
            ];

            $stmt->execute($param);
        } catch (Exception $e) {
            throw new Error("Cannot remove tag from article: " . $e->getMessage());
        }
    }
}

