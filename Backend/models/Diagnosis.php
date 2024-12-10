<?php

require_once '../config/db.php';

class Diagnosis {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Menambahkan diagnosis
    public function createDiagnosis($consultation_id, $pet_id, $notes, $prescription) {
        $sql = "INSERT INTO diagnoses (consultation_id, pet_id, notes, prescription) VALUES (?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$consultation_id, $pet_id, $notes, $prescription]);
        return $this->pdo->lastInsertId();
    }

    // Mendapatkan diagnosis berdasarkan ID
    public function getDiagnosisById($diagnosis_id) {
        $sql = "SELECT * FROM diagnoses WHERE diagnosis_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$diagnosis_id]);
        return $stmt->fetch();
    }

    // Mendapatkan diagnosis berdasarkan konsultasi
    public function getDiagnosisByConsultationId($consultation_id) {
        $sql = "SELECT * FROM diagnoses WHERE consultation_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$consultation_id]);
        return $stmt->fetchAll();
    }

    // Mengupdate diagnosis
    public function updateDiagnosis($diagnosis_id, $notes, $prescription) {
        $sql = "UPDATE diagnoses SET notes = ?, prescription = ? WHERE diagnosis_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$notes, $prescription, $diagnosis_id]);
        return $stmt->rowCount();
    }

    // Menghapus diagnosis
    public function deleteDiagnosis($diagnosis_id) {
        $sql = "DELETE FROM diagnoses WHERE diagnosis_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$diagnosis_id]);
        return $stmt->rowCount();
    }
}
?>
