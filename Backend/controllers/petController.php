<?php

require_once '../models/Pet.php';

class PetController {
    private $petModel;

    public function __construct($pdo) {
        $this->petModel = new Pet($pdo);
    }

    // Tambah hewan baru
    public function createPet() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = json_decode(file_get_contents("php://input"));

            if (!isset($data->user_id, $data->name, $data->species, $data->age)) {
                echo json_encode(['error' => 'Missing required fields']);
                return;
            }

            $result = $this->petModel->createPet($data->user_id, $data->name, $data->species, $data->age);

            echo json_encode($result ? ['message' => 'Pet added successfully'] : ['error' => 'Failed to add pet']);
        }
    }

    // Ambil semua hewan berdasarkan ID pengguna
    public function getPetsByUserId($user_id) {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $pets = $this->petModel->getPetsByUserId($user_id);
            echo json_encode($pets);
        }
    }

    // Update data hewan
    public function updatePet($pet_id) {
        if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
            $data = json_decode(file_get_contents("php://input"));

            $result = $this->petModel->updatePet($pet_id, $data->name, $data->species, $data->age);

            echo json_encode($result ? ['message' => 'Pet updated successfully'] : ['error' => 'Failed to update pet']);
        }
    }

    // Hapus hewan
    public function deletePet($pet_id) {
        if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
            $result = $this->petModel->deletePet($pet_id);

            echo json_encode($result ? ['message' => 'Pet deleted successfully'] : ['error' => 'Failed to delete pet']);
        }
    }
}
