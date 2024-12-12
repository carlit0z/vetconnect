<?php

class Diagnosis {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Tambahkan diagnosis baru
    public function createDiagnosis($consultation_id, $pet_id, $notes, $prescription) {
        $sql = "INSERT INTO diagnoses (consultation_id, pet_id, notes, prescription) VALUES (?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$consultation_id, $pet_id, $notes, $prescription]);
    }

    // Ambil diagnosis berdasarkan ID diagnosis
    public function getDiagnosisById($diagnosis_id) {
        $sql = "SELECT * FROM diagnoses WHERE diagnosis_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$diagnosis_id]);
        return $stmt->fetch();
    }

    // Ambil diagnosis berdasarkan ID konsultasi
    public function getDiagnosesByConsultationId($consultation_id) {
        $sql = "SELECT * FROM diagnoses WHERE consultation_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$consultation_id]);
        return $stmt->fetchAll();
    }

    // Perbarui diagnosis
    public function updateDiagnosis($diagnosis_id, $notes, $prescription) {
        $sql = "UPDATE diagnoses SET notes = ?, prescription = ? WHERE diagnosis_id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$notes, $prescription, $diagnosis_id]);
    }

    // Hapus diagnosis berdasarkan ID diagnosis
    public function deleteDiagnosis($diagnosis_id) {
        $sql = "DELETE FROM diagnoses WHERE diagnosis_id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$diagnosis_id]);
    }
}
