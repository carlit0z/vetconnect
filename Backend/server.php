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
require_once './helper/JWTHelper.php';
require_once './controllers/UserController.php';
require_once './controllers/PetController.php';
require_once './controllers/ConsultationController.php';
require_once './controllers/DiagnosisController.php';
require_once './controllers/MessageController.php';

$userController = new UserController($pdo);
$petController = new PetController($pdo);
$consultationController = new ConsultationController($pdo);
$diagnosisController = new DiagnosisController($pdo);
$messageController = new MessageController($pdo);

function authenticate()
{
    $headers = apache_request_headers();
    if (!isset($headers['Authorization'])) {
        http_response_code(401);
        echo json_encode(['error' => 'Unauthorized']);
        exit;
    }

    $token = str_replace('Bearer ', '', $headers['Authorization']);
    try {
        return JwtHelper::decode($token);
    } catch (Exception $e) {
        http_response_code(401);
        echo json_encode(['error' => 'Invalid or expired token']);
        exit;
    }
}

$method = $_SERVER['REQUEST_METHOD'];
$endpoint = $_GET['endpoint'] ?? null;

switch ($endpoint) {
    case 'user/register':
        if ($method === 'POST') $userController->register();
        break;
    case 'user/login':
        if ($method === 'POST') $userController->login();
        break;
    case 'users':
        $authUser = authenticate();
        if ($method === 'GET') $userController->getAllUsers();
        break;
    case 'pets':
        $authUser = authenticate(); 
        if ($method === 'POST') {
            if ($authUser->role !== 'owner') {
                http_response_code(403);
                echo json_encode(['error' => 'Forbidden']);
                exit;
            }
            $petController->createPet();
        }
        if ($method === 'GET') {
            $petController->getPetsByUserId($authUser->user_id); 
        }
        if ($method === 'PUT') $petController->updatePet($_GET['pet_id'] ?? null);
        if ($method === 'DELETE') $petController->deletePet($_GET['pet_id'] ?? null);
        break;

    case 'consultations':
        $authUser = authenticate(); 
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

    case 'diagnoses':
        $authUser = authenticate(); 
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

    case 'messages':
        $authUser = authenticate(); // Periksa autentikasi
        if ($method === 'POST') $messageController->createMessage();
        if ($method === 'GET') $messageController->getMessagesByConsultationId($_GET['consultation_id'] ?? null);
        break;

    default:
        http_response_code(404);
        echo json_encode(['error' => 'Endpoint not found']);
        break;
}
