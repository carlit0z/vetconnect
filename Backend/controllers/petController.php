<?php

require_once '../models/Pet.php';
require_once '../config/db.php';

class PetController {
    private $petModel;

    public function __construct($pdo) {
        $this->petModel = new Pet($pdo);
    }

    // Tambahkan hewan baru
    public function createPet() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = json_decode(file_get_contents("php://input"));

            // Validasi input
            if (!isset($data->user_id) || !isset($data->name) || !isset($data->species) || !isset($data->gender) || !isset($data->age)) {
                echo json_encode(['error' => 'Missing required fields']);
                return;
            }

            $isCreated = $this->petModel->createPet($data->user_id, $data->name, $data->species, $data->gender, $data->age);

            if ($isCreated) {
                echo json_encode(['message' => 'Pet added successfully']);
            } else {
                echo json_encode(['error' => 'Failed to add pet']);
            }
        }
    }

    // Ambil data hewan berdasarkan user_id
    public function getPetsByUser($user_id) {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $pets = $this->petModel->getPetsByUserId($user_id);

            if ($pets) {
                echo json_encode($pets);
            } else {
                echo json_encode(['error' => 'No pets found']);
            }
        }
    }
}
