<?php

require_once "config/connect.php";

class user {
    private $conn;
    private $email;
    private $password;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getdatabase();
    }

    public function login($email, $password) {
        $query = "SELECT * FROM users WHERE user_email = :email AND user_pw = :password";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":password", $password);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user) {
            if ($password == $user['user_pw']) {
                session_start();
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['user_name'] = $user['user_name'];
                $_SESSION['user_role'] = $user['user_role'];

                if ($user['user_role'] == 1) {
                    header("Location: ../views/admin.php");
                } elseif ($user['user_role'] == 2) {
                    header("Location: ../views/user.php");
                }
                exit;
            } else {
                echo "<script>alert('Invalid email or password.');</script>";
            }
        } else {
            echo "<script>alert('No user found with this email.');</script>";
        }
    } 
}


