<?php

require_once './models/Pet.php';
require_once './models/User.php'; // Tambahkan ini untuk model User

class PetController
{
    private $petModel;
    private $userModel; // Tambahkan properti untuk User model

    public function __construct($pdo)
    {
        $this->petModel = new Pet($pdo);
        $this->userModel = new User($pdo); // Inisialisasi User model
    }

    public function createPet()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = json_decode(file_get_contents("php://input"), true);

            if (empty($data['username']) || empty($data['name']) || empty($data['species']) || empty($data['age']) || empty($data['gender'])) {
                http_response_code(400);
                echo json_encode(['error' => 'All fields are required']);
                return;
            }

            // Ambil user_id berdasarkan username
            $user = $this->userModel->getUserByUsername($data['username']);
            if (!$user) {
                http_response_code(404);
                echo json_encode(['error' => 'User not found']);
                return;
            }

            $userId = $user['user_id']; // Ambil user_id dari data user

            $result = $this->petModel->createPet(
                $userId,
                $data['name'],
                $data['species'],
                $data['age'],
                $data['gender']
            );

            if ($result) {
                http_response_code(201);
                echo json_encode(['message' => 'Pet created successfully']);
            } else {
                http_response_code(500);
                echo json_encode(['error' => 'Failed to create pet']);
            }
        }
    }



    public function getPetsByUserId($user_id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $pets = $this->petModel->getPetsByUserId($user_id);
            echo json_encode($pets);
        }
    }

    public function updatePet($pet_id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
            $data = json_decode(file_get_contents("php://input"), true);

            $result = $this->petModel->updatePet($pet_id, $data['name'], $data['species'], $data['age']);

            echo json_encode($result ? ['message' => 'Pet updated successfully'] : ['error' => 'Failed to update pet']);
        }
    }

    public function deletePet($pet_id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
            $result = $this->petModel->deletePet($pet_id);

            echo json_encode($result ? ['message' => 'Pet deleted successfully'] : ['error' => 'Failed to delete pet']);
        }
    }
}
