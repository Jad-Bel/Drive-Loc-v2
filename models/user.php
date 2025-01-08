<?php

include "../../../config/connect.php";

class User {
    protected $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getdatabase();
    }

    public function register($firstName, $lastName, $email, $password, $role) {
        try {
            $firstName = htmlspecialchars($firstName);
            $lastName = htmlspecialchars($lastName);
            $email = htmlspecialchars($email);
            $hashedPassword = md5($password); 
            $password = htmlspecialchars($password);
            
            $query = "INSERT INTO users (user_name, user_last, user_email, user_pw, role_id)
                      VALUES (:firstName, :lastName, :email, :password, :role)";
            $stmt = $this->conn->prepare($query);

            $params = [
                ":firstName" => $firstName,
                ":lastName" => $lastName,
                ":email" => $email,
                ":password" => $hashedPassword,
                ":role" => $role
            ];

            $result = $stmt->execute($params);
            if (!$result) {
                throw new Exception("Failed to register user");
            }
            return true;
        } catch (Exception $e) {
            throw new Exception("Database error: " . $e->getMessage());
        }
    }

    public function login($email, $password) {
        try {
            $query = "SELECT * FROM users WHERE user_email = :email";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([":email" => $email]);

            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user) {
                $hashedPassword = md5($password);

                if ($hashedPassword === $user['user_pw']) {
                // if ($password === $user['user_pw']) {
                    session_start();
                    $_SESSION['user_id'] = $user['user_id'];
                    $_SESSION['user_name'] = $user['user_name'];
                    $_SESSION['user_role'] = $user['role_id'];

                    if ($user['role_id'] == 1) {
                        header("Location: ../../partials/dashboard/adminDash.php");
                    } elseif ($user['role_id'] == 2) {
                        header("Location: ../../layouts/main.php");
                    }
                    exit;
                } else {
                    throw new Exception("Invalid credentials");
                }
            } else {
                throw new Exception("User not found");
            }
        } catch (Exception $e) {
            error_log("Database error: " . $e->getMessage());
            throw new Exception("An error occurred, please try again later.");
            // echo 1;
        }
    }

    public function affUsers () {
        $query = "SELECT * FROM users";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $users;
    }

    public function countUsers () {
        $query = "SELECT COUNT(*) FROM users";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        $count = $stmt->fetchColumn();
        return $count;
    }

    public function supprimerUser($user_id) {
        try {
            $stmt = $this->conn->prepare("DELETE FROM avis WHERE user_id = :user_id");
            $stmt->execute(['user_id' => $user_id]);
            
            $stmt = $this->conn->prepare("DELETE FROM reservation WHERE user_id = :user_id");
            $stmt->execute(['user_id' => $user_id]);
    
            $stmt = $this->conn->prepare("DELETE FROM users WHERE user_id = :user_id");
            $stmt->execute(['user_id' => $user_id]);
    
            return true;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
}
// echo 1;

// $email = "jadbelassiria@admin.com";
// $password = 'jadbelassiria2';
// // $hashedPassword = md5($password);
// $db = new user();
// // $register = $db->login($email,$password);
// $register = $db->register('jad', 'belasiria', $email, $password, 1);

// // $connect = new Database();
// // $result = $connect->getdatabase();
// if ($register) {
//     echo 1;
// } else {
//     echo 0;
// }