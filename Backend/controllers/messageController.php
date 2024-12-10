<?php
// backend/controllers/MessageController.php

require_once '../models/Message.php';
require_once '../config/db.php';

class MessageController {
    private $messageModel;

    public function __construct($pdo) {
        $this->messageModel = new Message($pdo);
    }

    // Mengirim pesan baru
    public function createMessage() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = json_decode(file_get_contents("php://input"));

            if (empty($data->consultation_id) || empty($data->sender_id) || empty($data->message_content)) {
                echo json_encode(["message" => "All fields are required."]);
                return;
            }

            $isCreated = $this->messageModel->createMessage($data->consultation_id, $data->sender_id, $data->message_content);

            if ($isCreated) {
                echo json_encode(["message" => "Message sent successfully."]);
            } else {
                echo json_encode(["message" => "Failed to send message."]);
            }
        }
    }

    // Mengambil pesan berdasarkan consultation_id
    public function getMessagesByConsultation($consultation_id) {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $messages = $this->messageModel->getMessagesByConsultation($consultation_id);
            echo json_encode($messages);
        }
    }
}
?>
