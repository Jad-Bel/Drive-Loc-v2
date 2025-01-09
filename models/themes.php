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
        try {
            $id = htmlspecialchars(intval($thm_id));
            $query = "DELETE FROM themes WHERE thm_id = :id";
            $stmt = $this->conn->prepare($query);

            $param = [":id" => $id];

            $stmt->execute($param);
        } catch (Exception $e) {
            throw new Error("Cannot delete theme: " . $e->getMessage());
        }
    }

    public function updateTheme($thm_id, $nom) {
        try {
            $query = "UPDATE themes SET thm_nom = :nom WHERE thm_id = :id";
            $stmt = $this->conn->prepare($query);

            $param = [
                ":id" => $thm_id,
                ":nom" => $nom
            ];

            $stmt->execute($param);
        } catch (Exception $e) {
            throw new Error("Cannot update theme: " . $e->getMessage());
        }
    }
}

