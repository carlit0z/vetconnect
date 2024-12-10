<?php

require_once '../config/db.php';

class Consultation {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function createConsultation($owner_id, $vet_id, $date, $status) {
        $query = "INSERT INTO consultations (owner_id, vet_id, date, status) 
                    VALUES (:owner_id, :vet_id, :date, :status)";
        $stmt = $this->pdo->prepare($query);

        $stmt->bindParam(':owner_id', $owner_id, PDO::PARAM_INT);
        $stmt->bindParam(':vet_id', $vet_id, PDO::PARAM_INT);
        $stmt->bindParam(':date', $date, PDO::PARAM_STR);
        $stmt->bindParam(':status', $status, PDO::PARAM_STR);

        return $stmt->execute();
    }

    public function getConsultationsByOwnerId($owner_id) {
        $query = "SELECT c.*, u.username as vet_name 
                    FROM consultations c
                    JOIN users u ON c.vet_id = u.user_id
                    WHERE c.owner_id = :owner_id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':owner_id', $owner_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllConsultations() {
        $query = "SELECT * FROM consultations";
        $stmt = $this->pdo->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
