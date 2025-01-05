<?php 
include "../../../config/connect.php";

class reservation {
    private $conn;

    public function __construct () {
        $db = new Database();
        $this->conn = $db->getdatabase();
    }

    public function affAllReservation () {
        try {
            $query = "SELECT * FROM reservation";
            $stmt = $this->conn->prepare($query);

            $stmt->execute();

            $reservation = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $reservation;
        } catch (Exception $e) {
            throw new Error("cannot get reservation:" . $e->getMessage());
        }
    }

    public function bookRes ($user_id, $vehicule_id, $date_rsv, $date_pickup, $date_return, $lieu_pickup, $lieu_return, $prix) {
        try {
            $query = "INSERT INTO reservation (user_id, vehicule_id, date_rsv, date_pickup, date_return, lieu_pickup, lieu_return, prix) VALUE (:user_id, :vehicule_id, :date_rsv, :date_pickup, :date_return, :lieu_pickup, :lieu_return, :price)";
            $stmt = $this->conn->prepare($query);

            $param = [
                        ":user_id" => $user_id,
                        ":vehicule_id" => $vehicule_id,
                        ":date_rsv" => $date_rsv,
                        ":date_pickup" => $date_pickup,
                        ":date_return" => $date_return, 
                        ":lieu_pickup" => $lieu_pickup, 
                        ":lieu_return" => $lieu_return,
                        ":price" => $prix
                        ];
            
            $stmt->execute($param);
        } catch (Exception $e) {
            throw new Error("cannot book reservation:" . $e->getMessage());
        }

    }

    public function deleteRes ($rsv_id) {
        try {
            $id = htmlspecialchars(intval($rsv_id));
            $query = "DELETE FROM reservation WHERE rsv_id = :id";
            $stmt = $this->conn->prepare($query);

            $param = [":id" => $id];

            $stmt->execute($param);
        } catch (Exception $e) {
            throw new Error("cannot cancel reservation:" . $e->getMessage());
        }
    }

    public function modifierRes ($rsv_id, $user_id, $vehicule_id, $date_rsv, $date_pickup, $date_return, $lieu_pickup, $lieu_return) {
        try {
            $query = "UPDATE reservation SET rsv_id = :rsv_id, user_id = :user_id, vehicule_id = :vehicule_id, date_rsv = :date_rsv, date_pickup = :date_pickup, date_return = :date_return, lieu_pickup = :lieu_pickup, lieu_return = :lieu_return";
            $stmt = $this->conn->prepare($query);

            $param = [
                        ":rsv_id" => $rsv_id,
                        ":user_id" => $user_id,
                        ":vehicule_id" => $vehicule_id,
                        ":date_rsv" => $date_rsv,
                        ":date_pickup" => $date_pickup,
                        ":date_return" => $date_return, 
                        ":lieu_pickup" => $lieu_pickup, 
                        ":lieu_return" => $lieu_return
                        ];

            $stmt->execute($param);
        } catch (Exception $e) {
            throw new Error("cannot update reservation:" . $e->getMessage());
        }
    }

    public function activeRsv () {
        try {
            $query = "SELECT * FROM reservation WHERE date_rsv > NOW()";
            $stmt = $this->conn->prepare($query);

            $stmt->execute();

            $reservation = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return (int)$reservation;
        } catch (Exception $e) {
            throw new Error("cannot get active reservation:" . $e->getMessage());
        }
    }

    public function accRes ($rsv_id) {
        try {
            $query = "UPDATE reservation SET status = 1 WHERE rsv_id = :rsv_id";
            $stmt = $this->conn->prepare($query);

            $param = [":rsv_id" => $rsv_id];

            $stmt->execute($param);
        } catch (Exception $e) {
            throw new Error("cannot accept reservation:" . $e->getMessage());
        }
    }

    public function decRes ($rsv_id) {
        try {
            $query = "UPDATE reservation SET status = 0 WHERE rsv_id = :rsv_id";
            $stmt = $this->conn->prepare($query);

            $param = [":rsv_id" => $rsv_id];

            $stmt->execute($param);
        } catch (Exception $e) {
            throw new Error("cannot decline reservation:" . $e->getMessage());
        }
    }
}


