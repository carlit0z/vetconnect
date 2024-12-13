<?php

require_once './models/User.php';

require_once './helper/JwtHelper.php';

class UserController
{
    private $userModel;

    public function __construct($pdo)
    {
        $this->userModel = new User($pdo);
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = json_decode(file_get_contents("php://input"));

            if (!isset($data->username, $data->email, $data->password, $data->role)) {
                echo json_encode(['error' => 'Missing required fields']);
                return;
            }

            $password = password_hash($data->password, PASSWORD_DEFAULT);
            $result = $this->userModel->createUser($data->username, $data->email, $password, $data->role);

            echo json_encode($result ? ['message' => 'User registered successfully'] : ['error' => 'Failed to register user']);
        }
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = json_decode(file_get_contents("php://input"));

            $user = $this->userModel->getUserByEmail($data->email);
            if ($user && password_verify($data->password, $user['password'])) {
                $token = JwtHelper::encode(['user_id' => $user['user_id'], 'role' => $user['role']]);
                echo json_encode(['message' => 'Login successful', 'token' => $token]);
            } else {
                echo json_encode(['error' => 'Invalid credentials']);
            }
        }
    }

    public function getAllUsers()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $users = $this->userModel->getAllUsers();
            echo json_encode($users);
        }
    }

    public function updateUser($user_id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
            $data = json_decode(file_get_contents("php://input"));

            $password = isset($data->password) ? password_hash($data->password, PASSWORD_DEFAULT) : null;
            $result = $this->userModel->updateUser($user_id, $data->username, $data->email,  $data->role, $password);

            echo json_encode($result ? ['message' => 'User updated successfully'] : ['error' => 'Failed to update user']);
        }
    }

    public function deleteUser($user_id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
            $result = $this->userModel->deleteUser($user_id);

            echo json_encode($result ? ['message' => 'User deleted successfully'] : ['error' => 'Failed to delete user']);
        }
    }
}
