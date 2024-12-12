<?php
// Konfigurasi CORS
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");

// Tangani preflight request (OPTIONS)
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

// Memuat file konfigurasi dan controller
require_once 'config/db.php';
require_once 'controllers/UserController.php';
require_once 'controllers/PetController.php';
require_once 'controllers/ConsultationController.php';
require_once 'controllers/DiagnosisController.php';
require_once 'controllers/MessageController.php';

// Inisialisasi controller
$userController = new UserController($pdo);
$petController = new PetController($pdo);
$consultationController = new ConsultationController($pdo);
$diagnosisController = new DiagnosisController($pdo);
$messageController = new MessageController($pdo);

// Middleware Routing
$method = $_SERVER['REQUEST_METHOD'];
$endpoint = $_GET['endpoint'] ?? null;

switch ($endpoint) {
    // User Routes
    case 'user/register':
        if ($method === 'POST') $userController->register();
        break;
    case 'user/login':
        if ($method === 'POST') $userController->login();
        break;
    case 'users':
        if ($method === 'GET') $userController->getAllUsers();
        if ($method === 'PUT') $userController->updateUser($_GET['user_id'] ?? null);
        if ($method === 'DELETE') $userController->deleteUser($_GET['user_id'] ?? null);
        break;

    // Pet Routes
    case 'pets':
        if ($method === 'POST') $petController->createPet();
        if ($method === 'GET') $petController->getPetsByUserId($_GET['user_id'] ?? null);
        if ($method === 'PUT') $petController->updatePet($_GET['pet_id'] ?? null);
        if ($method === 'DELETE') $petController->deletePet($_GET['pet_id'] ?? null);
        break;

    // Consultation Routes
    case 'consultations':
        if ($method === 'POST') $consultationController->createConsultation();
        if ($method === 'GET') $consultationController->getConsultationsByUserId($_GET['user_id'] ?? null);
        if ($method === 'PUT') $consultationController->updateConsultation($_GET['consultation_id'] ?? null);
        if ($method === 'DELETE') $consultationController->deleteConsultation($_GET['consultation_id'] ?? null);
        break;

    // Diagnosis Routes
    case 'diagnoses':
        if ($method === 'POST') $diagnosisController->createDiagnosis();
        if ($method === 'GET' && isset($_GET['consultation_id'])) {
            $diagnosisController->getDiagnosesByConsultationId($_GET['consultation_id']);
        }
        if ($method === 'GET' && isset($_GET['diagnosis_id'])) {
            $diagnosisController->getDiagnosisById($_GET['diagnosis_id']);
        }
        if ($method === 'PUT') $diagnosisController->updateDiagnosis($_GET['diagnosis_id'] ?? null);
        if ($method === 'DELETE') $diagnosisController->deleteDiagnosis($_GET['diagnosis_id'] ?? null);
        break;

    // Message Routes
    case 'messages':
        if ($method === 'POST') $messageController->createMessage();
        if ($method === 'GET') $messageController->getMessagesByConsultationId($_GET['consultation_id'] ?? null);
        break;

    // Jika endpoint tidak ditemukan
    default:
        http_response_code(404);
        echo json_encode(['error' => 'Endpoint not found']);
        break;
}
