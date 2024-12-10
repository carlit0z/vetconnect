<?php
// backend/controllers/DiagnosisController.php

require_once '../models/Diagnosis.php';
require_once '../config/db.php';

class DiagnosisController {
    private $diagnosisModel;

    public function __construct($pdo) {
        $this->diagnosisModel = new Diagnosis($pdo);
    }

    // Menambahkan diagnosis
    public function createDiagnosis() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = json_decode(file_get_contents("php://input"));

            if (empty($data->consultation_id) || empty($data->pet_id) || empty($data->notes) || empty($data->prescription)) {
                echo json_encode(["message" => "All fields are required."]);
                return;
            }

            $isCreated = $this->diagnosisModel->createDiagnosis($data->consultation_id, $data->pet_id, $data->notes, $data->prescription);

            if ($isCreated) {
                echo json_encode(["message" => "Diagnosis added successfully."]);
            } else {
                echo json_encode(["message" => "Failed to add diagnosis."]);
            }
        }
    }
}
?>
