<?php

require_once '../models/Diagnosis.php';
require_once '../config/db.php';

class DiagnosisController {
    private $diagnosisModel;

    public function __construct($pdo) {
        $this->diagnosisModel = new Diagnosis($pdo);
    }

    // Tambahkan diagnosis baru
    public function createDiagnosis() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = json_decode(file_get_contents("php://input"));

            // Validasi input
            if (!isset($data->consultation_id) || !isset($data->pet_id) || !isset($data->notes) || !isset($data->prescription)) {
                echo json_encode(['error' => 'Missing required fields']);
                return;
            }

            $isCreated = $this->diagnosisModel->createDiagnosis(
                $data->consultation_id,
                $data->pet_id,
                $data->notes,
                $data->prescription
            );

            if ($isCreated) {
                echo json_encode(['message' => 'Diagnosis created successfully']);
            } else {
                echo json_encode(['error' => 'Failed to create diagnosis']);
            }
        }
    }

    // Ambil diagnosis berdasarkan ID diagnosis
    public function getDiagnosisById($diagnosis_id) {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $diagnosis = $this->diagnosisModel->getDiagnosisById($diagnosis_id);

            if ($diagnosis) {
                echo json_encode($diagnosis);
            } else {
                echo json_encode(['error' => 'Diagnosis not found']);
            }
        }
    }

    // Ambil diagnosis berdasarkan ID konsultasi
    public function getDiagnosesByConsultationId($consultation_id) {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $diagnoses = $this->diagnosisModel->getDiagnosesByConsultationId($consultation_id);

            if ($diagnoses) {
                echo json_encode($diagnoses);
            } else {
                echo json_encode(['error' => 'No diagnoses found']);
            }
        }
    }

    // Perbarui diagnosis
    public function updateDiagnosis($diagnosis_id) {
        if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
            $data = json_decode(file_get_contents("php://input"));

            // Validasi input
            if (!isset($data->notes) || !isset($data->prescription)) {
                echo json_encode(['error' => 'Missing required fields']);
                return;
            }

            $isUpdated = $this->diagnosisModel->updateDiagnosis(
                $diagnosis_id,
                $data->notes,
                $data->prescription
            );

            if ($isUpdated) {
                echo json_encode(['message' => 'Diagnosis updated successfully']);
            } else {
                echo json_encode(['error' => 'Failed to update diagnosis']);
            }
        }
    }

    // Hapus diagnosis
    public function deleteDiagnosis($diagnosis_id) {
        if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
            $isDeleted = $this->diagnosisModel->deleteDiagnosis($diagnosis_id);

            if ($isDeleted) {
                echo json_encode(['message' => 'Diagnosis deleted successfully']);
            } else {
                echo json_encode(['error' => 'Failed to delete diagnosis']);
            }
        }
    }
}
