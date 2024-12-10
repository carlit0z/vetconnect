<?php
// backend/controllers/UserController.php

require_once '../models/User.php';
require_once '../config/db.php';
require_once '../helpers/JwtHelper.php';


class UserController
{
    private $userModel;

    public function __construct($pdo)
    {
        $this->userModel = new User($pdo);
    }

    // Register user baru
    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = json_decode(file_get_contents("php://input"));

            if (!isset($data->username) || !isset($data->email) || !isset($data->password) || !isset($data->role)) {
                echo json_encode(['error' => 'Missing required fields']);
                return;
            }

            // Hash password sebelum disimpan
            $password = password_hash($data->password, PASSWORD_DEFAULT);

            $result = $this->userModel->createUser($data->username, $data->email, $password, $data->role);
            if ($result) {
                echo json_encode(['message' => 'User registered successfully']);
            } else {
                echo json_encode(['error' => 'User registration failed']);
            }
        }
    }

    // Login user dan mendapatkan JWT
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = json_decode(file_get_contents("php://input"));

            // Validasi input
            if (empty($data->email) || empty($data->password)) {
                echo json_encode(["message" => "Email and password are required."]);
                return;
            }

            // Cek apakah email ada
            $user = $this->userModel->getUserByEmail($data->email);
            if ($user && password_verify($data->password, $user['password'])) {
                // Menghasilkan JWT
                $jwt = JwtHelper::encode(['user_id' => $user['user_id'], 'role' => $user['role']]);
                echo json_encode(['message' => 'Login successful', 'jwt' => $jwt]);
            } else {
                echo json_encode(["message" => "Invalid credentials."]);
            }
        }
    }
}
