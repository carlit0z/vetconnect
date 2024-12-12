<?php

require_once '../models/User.php';
require_once '../helpers/JwtHelper.php';
require_once '../config/db.php';

class UserController {
    private $userModel;

    public function __construct($pdo) {
        $this->userModel = new User($pdo);
    }

    // Register pengguna baru
    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = json_decode(file_get_contents("php://input"));

            // Validasi input
            if (!isset($data->username) || !isset($data->email) || !isset($data->password) || !isset($data->role)) {
                echo json_encode(['error' => 'Missing required fields']);
                return;
            }

            // Hash password
            $hashedPassword = password_hash($data->password, PASSWORD_DEFAULT);

            // Tambahkan pengguna baru
            $isCreated = $this->userModel->createUser($data->username, $data->email, $hashedPassword, $data->role);

            if ($isCreated) {
                echo json_encode(['message' => 'User registered successfully']);
            } else {
                echo json_encode(['error' => 'Failed to register user']);
            }
        }
    }

    // Login pengguna
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = json_decode(file_get_contents("php://input"));

            // Validasi input
            if (!isset($data->email) || !isset($data->password)) {
                echo json_encode(['error' => 'Missing required fields']);
                return;
            }

            $user = $this->userModel->getUserByEmail($data->email);
            if ($user && password_verify($data->password, $user['password'])) {
                $jwt = JwtHelper::encode(['user_id' => $user['user_id'], 'role' => $user['role']]);
                echo json_encode(['message' => 'Login successful', 'token' => $jwt]);
            } else {
                echo json_encode(['error' => 'Invalid email or password']);
            }
        }
    }

    // Logout pengguna (opsional untuk hapus token dari client)
    public function logout() {
        echo json_encode(['message' => 'Logout successful']);
    }
}
