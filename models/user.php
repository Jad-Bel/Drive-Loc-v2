<?php

include "../../config/connect.php";

class user {
    protected $conn;
    protected $email;
    protected $password;


    public function __construct() {
        $db = new Database();
        $this->conn = $db->getdatabase();
    }

    public function login($email, $password) {
        $query = "SELECT * FROM users WHERE user_email = :email AND user_pw = :password";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([":email", $email, ":password", $password]);

        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user) {
            if (password_verify($password,$user['user_pw'])) {
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
            }
        } 
    } 
}


class client extends user {
    protected $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getdatabase();
    }
    
    public function register($firstName, $lastName, $email, $password, $role = 1) {
        $firstName = htmlspecialchars($firstName);
        $lastName = htmlspecialchars($lastName);
        $email = htmlspecialchars($email);
        
        
        $query = "INSERT INTO users (user_name, user_last, user_email, user_pw, role_id)
                    VALUES (:firstName, :lastName, :email, :password, :role)";
        $stmt = $this->conn->prepare($query);

        $params = [
            ":firstName" => $firstName,
            ":lastName" => $lastName,
            ":email" => $email,
            ":password" => $password,
            ":role" => $role
        ];
        
        return $stmt->execute($params);
    }
}

class admin extends user {

    public function __construct() {
        parent::__construct();
    }
}

// $data = new client();

// $result = $data->register("John", "Doe", "john@gmail.com", "jadjadjad");

// if ($result == true) {
//     echo 1;
// } else {
//     echo 0;
// }
?>

<img src="../" alt="">