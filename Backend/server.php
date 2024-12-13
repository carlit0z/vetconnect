<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");

// Tangani preflight request (OPTIONS)
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

require_once 'config/db.php';
require_once './controllers/UserController.php';
require_once './controllers/PetController.php';
require_once './controllers/ConsultationController.php';
require_once './controllers/DiagnosisController.php';
require_once './controllers/MessageController.php';

// Inisialisasi Controller
$userController = new UserController($pdo);
$petController = new PetController($pdo);
$consultationController = new ConsultationController($pdo);
$diagnosisController = new DiagnosisController($pdo);
$messageController = new MessageController($pdo);

// Tangani Endpoint dan Metode
$method = $_SERVER['REQUEST_METHOD'];
$endpoint = $_GET['endpoint'] ?? null;

// function authenticate()
// {
//     $headers = getallheaders();
//     if (!isset($headers['Authorization'])) {
//         http_response_code(401);
//         echo json_encode(['error' => 'Unauthorized: Missing token']);
//         exit;
//     }

//     $token = str_replace('Bearer ', '', $headers['Authorization']);
//     try {
//         $decoded = JwtHelper::decode($token); // Decode token menggunakan JwtHelper
//         return (object) $decoded; // Mengembalikan data pengguna dari token
//     } catch (Exception $e) {
//         http_response_code(401);
//         echo json_encode(['error' => 'Unauthorized: Invalid token']);
//         exit;
//     }
// }

switch ($endpoint) {
    case 'user/register':
        if ($method === 'POST') $userController->register();
        break;

    case 'user/login':
        if ($method === 'POST') $userController->login();
        break;

    case 'users':
        if ($method === 'GET') $userController->getAllUsers();
        break;

        case 'pets':
            if ($method === 'POST') {
                $petController->createPet(); 
            }
            if ($method === 'GET') {
                $petController->getPetsByUserId($_GET['user_id'] ?? null); // Dapatkan daftar pet
            }
            if ($method === 'PUT') {
                $petController->updatePet($_GET['pet_id'] ?? null); // Update pet
            }
            if ($method === 'DELETE') {
                $petController->deletePet($_GET['pet_id'] ?? null); // Hapus pet
            }
            break;
        

    case 'consultations':
        if ($method === 'POST') {
            $consultationController->createConsultation();
        }
        if ($method === 'GET') {
            $consultationController->getConsultationsByUserId($_GET['user_id'] ?? null);
        }
        if ($method === 'PUT') {
            $consultationController->updateConsultation($_GET['consultation_id'] ?? null);
        }
        if ($method === 'DELETE') {
            $consultationController->deleteConsultation($_GET['consultation_id'] ?? null);
        }
        break;

    case 'diagnoses':
        if ($method === 'POST') {
            $diagnosisController->createDiagnosis();
        }
        if ($method === 'GET') {
            $diagnosisController->getDiagnosesByConsultationId($_GET['consultation_id'] ?? null);
        }
        if ($method === 'PUT') {
            $diagnosisController->updateDiagnosis($_GET['diagnosis_id'] ?? null);
        }
        if ($method === 'DELETE') {
            $diagnosisController->deleteDiagnosis($_GET['diagnosis_id'] ?? null);
        }
        break;

    case 'messages':
        if ($method === 'POST') {
            $messageController->createMessage();
        }
        if ($method === 'GET') {
            $messageController->getMessagesByConsultationId($_GET['consultation_id'] ?? null);
        }
        break;

    default:
        http_response_code(404);
        echo json_encode(['error' => 'Endpoint not found']);
        break;
}
