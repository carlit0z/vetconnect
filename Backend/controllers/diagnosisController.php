<?php

require_once '../models/Diagnosis.php';

class DiagnosisController {
    private $diagnosisModel;

    public function __construct($pdo) {
        $this->diagnosisModel = new Diagnosis($pdo);
    }

    // Tambahkan diagnosis baru
    public function createDiagnosis() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = json_decode(file_get_contents("php://input"));

            if (!isset($data->consultation_id, $data->pet_id, $data->notes, $data->prescription)) {
                echo json_encode(['error' => 'Missing required fields']);
                return;
            }

            $result = $this->diagnosisModel->createDiagnosis(
                $data->consultation_id,
                $data->pet_id,
                $data->notes,
                $data->prescription
            );

            echo json_encode($result ? ['message' => 'Diagnosis added successfully'] : ['error' => 'Failed to add diagnosis']);
        }
    }

    // Ambil diagnosis berdasarkan ID konsultasi
    public function getDiagnosesByConsultationId($consultation_id) {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            if (!$consultation_id) {
                echo json_encode(['error' => 'Missing consultation_id']);
                return;
            }

            $diagnoses = $this->diagnosisModel->getDiagnosesByConsultationId($consultation_id);
            echo json_encode($diagnoses);
        }
    }

    // Ambil diagnosis berdasarkan ID diagnosis
    public function getDiagnosisById($diagnosis_id) {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            if (!$diagnosis_id) {
                echo json_encode(['error' => 'Missing diagnosis_id']);
                return;
            }

            $diagnosis = $this->diagnosisModel->getDiagnosisById($diagnosis_id);
            echo json_encode($diagnosis ? $diagnosis : ['error' => 'Diagnosis not found']);
        }
    }

    // Perbarui diagnosis
    public function updateDiagnosis($diagnosis_id) {
        if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
            $data = json_decode(file_get_contents("php://input"));

            if (!isset($data->notes, $data->prescription)) {
                echo json_encode(['error' => 'Missing required fields']);
                return;
            }

            $result = $this->diagnosisModel->updateDiagnosis(
                $diagnosis_id,
                $data->notes,
                $data->prescription
            );

            echo json_encode($result ? ['message' => 'Diagnosis updated successfully'] : ['error' => 'Failed to update diagnosis']);
        }
    }

    // Hapus diagnosis
    public function deleteDiagnosis($diagnosis_id) {
        if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
            if (!$diagnosis_id) {
                echo json_encode(['error' => 'Missing diagnosis_id']);
                return;
            }

            $result = $this->diagnosisModel->deleteDiagnosis($diagnosis_id);
            echo json_encode($result ? ['message' => 'Diagnosis deleted successfully'] : ['error' => 'Failed to delete diagnosis']);
        }
    }
}
