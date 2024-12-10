<?php

require_once '../config/db.php';

class Consultation {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Menjadwalkan konsultasi
    public function createConsultation($owner_id, $vet_id, $date, $status) {
        $sql = "INSERT INTO consultations (owner_id, vet_id, date, status) VALUES (?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$owner_id, $vet_id, $date, $status]);
        return $this->pdo->lastInsertId();
    }

    // Mendapatkan konsultasi berdasarkan ID
    public function getConsultationById($consultation_id) {
        $sql = "SELECT * FROM consultations WHERE consultation_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$consultation_id]);
        return $stmt->fetch();
    }

    // Mendapatkan konsultasi berdasarkan pemilik atau dokter
    public function getConsultationsByUserId($user_id) {
        $sql = "SELECT * FROM consultations WHERE owner_id = ? OR vet_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$user_id, $user_id]);
        return $stmt->fetchAll();
    }

    // Mengupdate status konsultasi
    public function updateConsultation($consultation_id, $status) {
        $sql = "UPDATE consultations SET status = ? WHERE consultation_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$status, $consultation_id]);
        return $stmt->rowCount();
    }

    // Menghapus konsultasi
    public function deleteConsultation($consultation_id) {
        $sql = "DELETE FROM consultations WHERE consultation_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$consultation_id]);
        return $stmt->rowCount();
    }
}
?>
