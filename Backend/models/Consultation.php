<?php

class Consultation {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Tambahkan konsultasi baru
    public function createConsultation($owner_id, $vet_id, $date, $status) {
        $sql = "INSERT INTO consultations (owner_id, vet_id, date, status) VALUES (?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$owner_id, $vet_id, $date, $status]);
        return $this->pdo->lastInsertId();
    }

    // Ambil konsultasi berdasarkan ID
    public function getConsultationById($consultation_id) {
        $sql = "SELECT * FROM consultations WHERE consultation_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$consultation_id]);
        return $stmt->fetch();
    }

    // Ambil konsultasi berdasarkan ID pengguna (owner atau vet)
    public function getConsultationsByUserId($user_id) {
        $sql = "SELECT * FROM consultations WHERE owner_id = ? OR vet_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$user_id, $user_id]);
        return $stmt->fetchAll();
    }

    // Perbarui status konsultasi
    public function updateConsultation($consultation_id, $status) {
        $sql = "UPDATE consultations SET status = ? WHERE consultation_id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$status, $consultation_id]);
    }

    // Hapus konsultasi
    public function deleteConsultation($consultation_id) {
        $sql = "DELETE FROM consultations WHERE consultation_id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$consultation_id]);
    }
}
