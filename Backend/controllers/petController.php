<?php
// backend/controllers/PetController.php

require_once '../models/Pet.php';
require_once '../config/db.php';

class PetController {
    private $petModel;

    public function __construct($pdo) {
        $this->petModel = new Pet($pdo);
    }

    // Menambahkan data hewan peliharaan
    public function createPet() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = json_decode(file_get_contents("php://input"));

            if (empty($data->user_id) || empty($data->name) || empty($data->species) || empty($data->age)) {
                echo json_encode(["message" => "All fields are required."]);
                return;
            }

            $isCreated = $this->petModel->createPet($data->user_id, $data->name, $data->species, $data->age);

            if ($isCreated) {
                echo json_encode(["message" => "Pet added successfully."]);
            } else {
                echo json_encode(["message" => "Failed to add pet."]);
            }
        }
    }

    // Mendapatkan data hewan berdasarkan user_id
    public function getPetsByUserId($user_id) {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $pets = $this->petModel->getPetsByUserId($user_id);
            echo json_encode($pets);
        }
    }
}
?>
