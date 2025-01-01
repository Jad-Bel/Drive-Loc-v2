<?php

include "../config/connect.php";

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

    public function __construct() {
        parent::__construct();
    }
    
    public function register($name, $last, $email, $password, $role = 1) {
        $name = htmlspecialchars($name);
        $last = htmlspecialchars($last);
        $email = htmlspecialchars($email);
        
        $password = password_hash($password, PASSWORD_BCRYPT);

        $query = "INSERT INTO users (user_name, user_last, user_email, user_pw, role_id)
                    VALUE (:name, :last, :email, :password, :role)";
        $stmt = $this->conn->prepare($query);

        $param = [":name" => $name,
                  ":last" => $last,
                  ":email" => $email,
                  ":password" => $password,
                  ":role" => $role];
        $stmt->execute($param);
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