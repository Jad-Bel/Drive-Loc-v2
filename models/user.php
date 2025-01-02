<?php


include "../../config/connect.php";

class User {
    protected $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getdatabase();
    }

    // public function login($email, $password) {
    //     try {
    //         $query = "SELECT * FROM users WHERE user_email = :email";
    //         $stmt = $this->conn->prepare($query);
    //         $result = $stmt->execute([":email" => $email]);

    //         if (!$result) {
    //             throw new Exception("Failed to fetch user");
    //             die;
    //         }

    //         $user = $stmt->fetch(PDO::FETCH_ASSOC);

    //         if ($user && password_verify($password, $user['user_pw'])) {
    //             session_start();
    //             $_SESSION['user_id'] = $user['user_id'];
    //             $_SESSION['user_name'] = $user['user_name'];
    //             $_SESSION['user_role'] = $user['role_id'];

    //             if ($user['role_id'] == 1) {
    //                 header("Location: ../views/admin/dashboard.php");
    //             } elseif ($user['role_id'] == 2) {
    //                 header("Location: ../views/layouts/main.php");
    //             }
    //             exit;
    //         } 
    //         // var_dump($result);
    //     } catch (Exception $e) {
    //         // var_dump($result);
    //         throw new Exception("Database error: " . $e->getMessage());
    //     }
    // }

    public function login($email, $password) {
        try {
            $query = "SELECT * FROM users WHERE user_email = :email";
            $stmt = $this->conn->prepare($query);
            $result = $stmt->execute([":email" => $email]);

            if (!$result) {
                error_log("Failed to execute query: " . implode(", ", $stmt->errorInfo()));
                throw new Exception("Failed to fetch user");
            }

            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($password, $user['user_pw'])) {
                session_start();
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['user_name'] = $user['user_name'];
                $_SESSION['user_role'] = $user['role_id'];

                // $redirectUrl = ($user['role_id'] == 1) 
                //     ? "/views/admin/dashboard.php" 
                //     : "/views/layouts/main.php";

                if ($user['role_id'] == 1) {
                    return header("location: /views/admin/dashboard.php");
                    exit;
                } elseif ($user['role_id'] == 2) {
                    return header('location: /views/layouts/main.php');
                    exit;
                }

                // error_log("User authenticated. Redirecting to: " . $redirectUrl);
            } else {
                error_log("Authentication failed for email: " . $email);
                return [
                    'success' => false,
                    'message' => 'Invalid email or password'
                ];
            }
        } catch (Exception $e) {
            error_log("Login error: " . $e->getMessage());
            return [
                'success' => false,
                'message' => "An error occurred during login. Please try again."
            ];
        }
    }

    // public function register($firstName, $lastName, $email, $password, $role) {
    //     try {
    //         $firstName = htmlspecialchars($firstName);
    //         $lastName = htmlspecialchars($lastName);
    //         $email = htmlspecialchars($email);
    //         $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            
    //         $query = "INSERT INTO users (user_name, user_last, user_email, user_pw, role_id)
    //                     VALUES (:firstName, :lastName, :email, :password, :role)";
    //         $stmt = $this->conn->prepare($query);

    //         $params = [
    //             ":firstName" => $firstName,
    //             ":lastName" => $lastName,
    //             ":email" => $email,
    //             ":password" => $hashedPassword,
    //             ":role" => $role
    //         ];
            
    //         $result = $stmt->execute($params);
    //         if (!$result) {
    //             throw new Exception("Failed to register user");
    //         }

    //         echo "1";
    //         var_dump($result);
    //     } catch (Exception $e) {
    //         echo "<br>";
    //         var_dump($result);
    //         throw new Exception("Database error: " . $e->getMessage());
    //     }

    // }
// }
public function register($firstName, $lastName, $email, $password, $role) {
    try {
        // Hash the password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $query = "INSERT INTO users (user_name, user_last, user_email, user_pw, role_id) 
                  VALUES (:firstName, :lastName, :email, :password, :role)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':firstName', $firstName);
        $stmt->bindParam(':lastName', $lastName);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashedPassword);
        $stmt->bindParam(':role', $role);

        return $stmt->execute();
    } catch (PDOException $e) {
        // Log the error and throw a generic exception
        error_log("Registration error: " . $e->getMessage());
        throw new Exception("An error occurred during registration. Please try again.");
    }
}
}



// $data = new user();

// $result = $data->register("John", "Doe", "john@gmail.com", "jadjadjad");

// if ($result == true) {
//     echo 1;
// } else {
//     echo 0;
// }
?>