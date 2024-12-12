<?php

require_once '../models/Consultation.php';
require_once '../config/db.php';

class ConsultationController {
    private $consultationModel;

    public function __construct($pdo) {
        $this->consultationModel = new Consultation($pdo);
    }

    // Tambahkan konsultasi baru
    public function createConsultation() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = json_decode(file_get_contents("php://input"));

            // Validasi input
            if (!isset($data->owner_id) || !isset($data->vet_id) || !isset($data->date) || !isset($data->status)) {
                echo json_encode(['error' => 'Missing required fields']);
                return;
            }

            $consultationId = $this->consultationModel->createConsultation($data->owner_id, $data->vet_id, $data->date, $data->status);

            echo json_encode(['message' => 'Consultation created successfully', 'consultation_id' => $consultationId]);
        }
    }

    // Ambil konsultasi berdasarkan ID
    public function getConsultationById($consultation_id) {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $consultation = $this->consultationModel->getConsultationById($consultation_id);

            if ($consultation) {
                echo json_encode($consultation);
            } else {
                echo json_encode(['error' => 'Consultation not found']);
            }
        }
    }

    // Perbarui status konsultasi
    public function updateConsultationStatus($consultation_id) {
        if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
            $data = json_decode(file_get_contents("php://input"));

            if (!isset($data->status)) {
                echo json_encode(['error' => 'Missing status']);
                return;
            }

            $updated = $this->consultationModel->updateConsultation($consultation_id, $data->status);

            if ($updated) {
                echo json_encode(['message' => 'Consultation updated successfully']);
            } else {
                echo json_encode(['error' => 'Failed to update consultation']);
            }
        }
    }
}
