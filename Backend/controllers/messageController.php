<?php

require_once '../models/Message.php';
require_once '../config/db.php';

class MessageController {
    private $messageModel;

    public function __construct($pdo) {
        $this->messageModel = new Message($pdo);
    }

    // Kirim pesan
    public function sendMessage() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = json_decode(file_get_contents("php://input"));

            // Validasi input
            if (!isset($data->consultation_id) || !isset($data->sender_id) || !isset($data->message_content)) {
                echo json_encode(['error' => 'Missing required fields']);
                return;
            }

            $isSent = $this->messageModel->createMessage($data->consultation_id, $data->sender_id, $data->message_content);

            if ($isSent) {
                echo json_encode(['message' => 'Message sent successfully']);
            } else {
                echo json_encode(['error' => 'Failed to send message']);
            }
        }
    }

    // Ambil pesan berdasarkan ID konsultasi
    public function getMessagesByConsultation($consultation_id) {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $messages = $this->messageModel->getMessagesByConsultation($consultation_id);

            if ($messages) {
                echo json_encode($messages);
            } else {
                echo json_encode(['error' => 'No messages found']);
            }
        }
    }
}
