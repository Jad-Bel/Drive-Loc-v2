<?php 

class Database {
    private $host = "localhost";
    private $db_name = "driveLoc";
    private $username = "root";
    private $password = "Hitler20.";
    private $conn;

    public function getdatabase() {
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host={$this->host};dbname={$this->db_name}", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $e) {
            throw new Error("Connection error: " . $e->getMessage());
        }
        return $this->conn;
    }
}

// $connect = new Database();
// $result = $connect->getdatabase();
// if ($result) {
//     echo 1;
// } else {
//     echo 0;
// }