<?php
include "../../../config/connect.php";

class Theme {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getdatabase();
    }

    public function getAllThemes() {
        try {
            $query = "SELECT * FROM themes";
            $stmt = $this->conn->prepare($query);

            $stmt->execute();

            $themes = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $themes;
        } catch (Exception $e) {
            throw new Error("Cannot get themes: " . $e->getMessage());
        }
    }

    public function addTheme($nom) {
        try {
            $query = "INSERT INTO themes (thm_nom) VALUES (:nom)";
            $stmt = $this->conn->prepare($query);

            $param = [":nom" => $nom];
            
            $stmt->execute($param);
            return $this->conn->lastInsertId();
        } catch (Exception $e) {
            throw new Error("Cannot add theme: " . $e->getMessage());
        }
    }

    public function deleteTheme($thm_id) {
        if (!is_numeric($thm_id) || $thm_id <= 0) {
            throw new Exception("Invalid theme ID");
        }
    
        try {
            $query = "DELETE FROM themes WHERE thm_id = :id";
            $stmt = $this->conn->prepare($query);
            $param = [":id" => $thm_id];
            $stmt->execute($param);
            return true; 
        } catch (PDOException $e) {
            error_log("Error deleting theme: " . $e->getMessage());
            return false;
        }
    }

    public function updateTheme($thm_nom, $thm_id) {
        try {
            $query = "UPDATE themes SET thm_nom = :nom WHERE thm_id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':nom', $thm_nom, PDO::PARAM_STR);
            $stmt->bindParam(':id', $thm_id, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            throw new Error("Cannot update theme: " . $e->getMessage());
            return false;
        }
    }
}

