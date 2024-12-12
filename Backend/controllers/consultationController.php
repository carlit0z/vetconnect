<?php

require_once '../models/Consultation.php';

class ConsultationController {
    private $consultationModel;

    public function __construct($pdo) {
        $this->consultationModel = new Consultation($pdo);
    }

    // Tambah konsultasi
    public function createConsultation() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = json_decode(file_get_contents("php://input"));

            if (!isset($data->owner_id, $data->vet_id, $data->date, $data->status)) {
                echo json_encode(['error' => 'Missing required fields']);
                return;
            }

            $result = $this->consultationModel->createConsultation($data->owner_id, $data->vet_id, $data->date, $data->status);

            echo json_encode($result ? ['message' => 'Consultation created successfully'] : ['error' => 'Failed to create consultation']);
        }
    }

    // Ambil konsultasi berdasarkan ID pengguna
    public function getConsultationsByUserId($user_id) {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $consultations = $this->consultationModel->getConsultationsByUserId($user_id);
            echo json_encode($consultations);
        }
    }

    // Update status konsultasi
    public function updateConsultation($consultation_id) {
        if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
            $data = json_decode(file_get_contents("php://input"));

            $result = $this->consultationModel->updateConsultation($consultation_id, $data->status);

            echo json_encode($result ? ['message' => 'Consultation updated successfully'] : ['error' => 'Failed to update consultation']);
        }
    }

    // Hapus konsultasi
    public function deleteConsultation($consultation_id) {
        if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
            $result = $this->consultationModel->deleteConsultation($consultation_id);

            echo json_encode($result ? ['message' => 'Consultation deleted successfully'] : ['error' => 'Failed to delete consultation']);
        }
    }
}
