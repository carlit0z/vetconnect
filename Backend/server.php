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

// Memuat file konfigurasi, helper, dan controller
require_once 'config/db.php';
require_once 'helpers/JwtHelper.php';
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

// Middleware autentikasi
function authenticate() {
    $headers = apache_request_headers();
    if (!isset($headers['Authorization'])) {
        http_response_code(401);
        echo json_encode(['error' => 'Unauthorized']);
        exit;
    }

    $token = str_replace('Bearer ', '', $headers['Authorization']);
    try {
        return JwtHelper::decode($token); // Mengembalikan data dari token (misalnya user_id, role)
    } catch (Exception $e) {
        http_response_code(401);
        echo json_encode(['error' => 'Invalid or expired token']);
        exit;
    }
}

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

    // Pet Routes (Proteksi Auth untuk Owner)
    case 'pets':
        $authUser = authenticate(); // Periksa autentikasi
        if ($method === 'POST') {
            if ($authUser->role !== 'owner') {
                http_response_code(403);
                echo json_encode(['error' => 'Forbidden']);
                exit;
            }
            $petController->createPet();
        }
        if ($method === 'GET') {
            $petController->getPetsByUserId($authUser->user_id); // Ambil pets berdasarkan user_id dari token
        }
        if ($method === 'PUT') $petController->updatePet($_GET['pet_id'] ?? null);
        if ($method === 'DELETE') $petController->deletePet($_GET['pet_id'] ?? null);
        break;

    // Consultation Routes (Proteksi Auth untuk Owner dan Vet)
    case 'consultations':
        $authUser = authenticate(); // Periksa autentikasi
        if ($method === 'POST') {
            if ($authUser->role !== 'owner') {
                http_response_code(403);
                echo json_encode(['error' => 'Forbidden']);
                exit;
            }
            $consultationController->createConsultation();
        }
        if ($method === 'GET') {
            if ($authUser->role === 'owner') {
                $consultationController->getConsultationsByUserId($authUser->user_id);
            } elseif ($authUser->role === 'vet') {
                $consultationController->getConsultationsByUserId($authUser->user_id);
            } else {
                http_response_code(403);
                echo json_encode(['error' => 'Forbidden']);
            }
        }
        if ($method === 'PUT') $consultationController->updateConsultation($_GET['consultation_id'] ?? null);
        if ($method === 'DELETE') $consultationController->deleteConsultation($_GET['consultation_id'] ?? null);
        break;

    // Diagnosis Routes (Proteksi Auth untuk Vet)
    case 'diagnoses':
        $authUser = authenticate(); // Periksa autentikasi
        if ($method === 'POST') {
            if ($authUser->role !== 'vet') {
                http_response_code(403);
                echo json_encode(['error' => 'Forbidden']);
                exit;
            }
            $diagnosisController->createDiagnosis();
        }
        if ($method === 'GET') {
            $diagnosisController->getDiagnosesByConsultationId($_GET['consultation_id'] ?? null);
        }
        if ($method === 'PUT') $diagnosisController->updateDiagnosis($_GET['diagnosis_id'] ?? null);
        if ($method === 'DELETE') $diagnosisController->deleteDiagnosis($_GET['diagnosis_id'] ?? null);
        break;

    // Message Routes (Proteksi Auth untuk Owner dan Vet)
    case 'messages':
        $authUser = authenticate(); // Periksa autentikasi
        if ($method === 'POST') $messageController->createMessage();
        if ($method === 'GET') $messageController->getMessagesByConsultationId($_GET['consultation_id'] ?? null);
        break;

    // Jika endpoint tidak ditemukan
    default:
        http_response_code(404);
        echo json_encode(['error' => 'Endpoint not found']);
        break;
}
