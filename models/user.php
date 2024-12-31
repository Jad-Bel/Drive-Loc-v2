<?php

require_once "../config/connect.php";

class user {
    protected $conn;
    protected $email;
    protected $password;
    protected $name;
    protected $last;
    protected $role;


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


class client extends user {

    public function __construct() {
        parent::__construct();
    }
    
    public function register($name, $last, $email, $password) {
        $this->name = htmlspecialchars($name);
        $this->last = htmlspecialchars($last);
        $this->email = htmlspecialchars($email);
        $this->password = md5($password);

        $query = "INSERT INTO users (user_name, user_last, user_email, user_pw, role_id) VALUE (:name, :last, :email, :password, 1)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":last", $this->last);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":password", $this->password);

        $stmt->execute();
    }
}

$data = new client();

$result = $data->register("John", "Doe", "john@gmail.com", "hitler");

if ($result) {
    echo 1;
} else {
    echo 0;
}
?>

<img src="../" alt="">