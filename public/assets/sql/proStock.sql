DELIMITER $$

CREATE PROCEDURE BookReservation(
    IN userId INT,
    IN vehiculeId INT,
    IN dateRsv DATE,
    IN datePickup DATE,
    IN dateReturn DATE,
    IN lieuPickup VARCHAR(255),
    IN lieuReturn VARCHAR(255)
)
BEGIN
    IF NOT EXISTS (SELECT 1 FROM vehicules WHERE vehicule_id = vehiculeId) THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Le véhicule spécifié n\'existe pas';
    END IF;

    -- Validate dates
    IF datePickup >= dateReturn THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'La date de retour doit être après la date de retrait';
    END IF;

    IF datePickup < CURRENT_DATE THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'La date de retrait ne peut pas être dans le passé';
    END IF;

    -- Insert reservation
    INSERT INTO reservation (
        user_id,
        vehicule_id,
        date_rsv,
        date_pickup,
        date_return,
        lieu_pickup,
        lieu_return
    ) VALUES (
        userId,
        vehiculeId,
        dateRsv,
        datePickup,
        dateReturn,
        lieuPickup,
        lieuReturn
    );
END$$

DELIMITER ;


DELIMITER $$

CREATE PROCEDURE ModifyReservation(
    IN rsvId INT,
    IN userId INT,
    IN vehiculeId INT,
    IN dateRsv DATE,
    IN datePickup DATE,
    IN dateReturn DATE,
    IN lieuPickup VARCHAR(255),
    IN lieuReturn VARCHAR(255)
)
BEGIN
    -- Validate if reservation exists
    IF NOT EXISTS (SELECT 1 FROM reservation WHERE rsv_id = rsvId) THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'La réservation spécifiée n\'existe pas';
    END IF;

    IF NOT EXISTS (SELECT 1 FROM vehicules WHERE vehicule_id = vehiculeId) THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Le véhicule spécifié n\'existe pas';
    END IF;

    -- Validate dates
    IF datePickup >= dateReturn THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'La date de retour doit être après la date de retrait';
    END IF;

    IF datePickup < CURRENT_DATE THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'La date de retrait ne peut pas être dans le passé';
    END IF;

    -- Update reservation
    UPDATE reservation
    SET
        user_id = userId,
        vehicule_id = vehiculeId,
        date_rsv = dateRsv,
        date_pickup = datePickup,
        date_return = dateReturn,
        lieu_pickup = lieuPickup,
        lieu_return = lieuReturn
    WHERE rsv_id = rsvId;
END$$

DELIMITER ;


DELIMITER $$

CREATE PROCEDURE CancelReservation(
    IN rsvId INT
)
BEGIN
    -- Validate if reservation exists
    IF NOT EXISTS (SELECT 1 FROM reservation WHERE rsv_id = rsvId) THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'La réservation spécifiée n\'existe pas';
    END IF;

    DELETE FROM reservation WHERE rsv_id = rsvId;
END$$

DELIMITER ;

CALL BookReservation(
    9,              
    3,              
    '2024-12-30',   
    '2025-01-05',   
    '2025-01-10',   
    'Casablanca',   
    'Rabat'         
);

