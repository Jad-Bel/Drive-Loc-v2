<?php 
include "../../../../config/connect.php";

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

    public function bookRes ($user_id, $vehicule_id, $date_rsv, $date_pickup, $date_return, $lieu_pickup, $lieu_return) {
        try {
            $query = "INSERT INTO reservation (user_id, vehicule_id, date_rsv, date_pickup, date_return, lieu_pickup, lieu_return) VALUE (:user_id, :vehicule_id, :date_rsv, :date_pickup, :date_return, :lieu_pickup, :lieu_return)";
            $stmt = $this->conn->prepare($query);

            $param = [
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
            throw new Error("cannot book reservation:" . $e->getMessage());
        }

    }

    public function cancelRes ($rsv_id) {
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
}

// $rsv = new reservation();
// $res = $rsv->modifierRes(2, 8, 3, "2021-06-01", "2021-06-02", "2021-06-03", "Paris", "Lyon");