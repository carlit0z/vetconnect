<?php

require_once '../models/Message.php';

class MessageController {
    private $messageModel;

    public function __construct($pdo) {
        $this->messageModel = new Message($pdo);
    }

    public function createMessage() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = json_decode(file_get_contents("php://input"));

            if (!isset($data->consultation_id, $data->sender_id, $data->message_content)) {
                echo json_encode(['error' => 'Missing required fields']);
                return;
            }

            $result = $this->messageModel->createMessage($data->consultation_id, $data->sender_id, $data->message_content);

            echo json_encode($result ? ['message' => 'Message sent successfully'] : ['error' => 'Failed to send message']);
        }
    }

    public function getMessagesByConsultationId($consultation_id) {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            if (!$consultation_id) {
                echo json_encode(['error' => 'Missing consultation_id']);
                return;
            }

            $messages = $this->messageModel->getMessagesByConsultationId($consultation_id);

            if ($messages) {
                echo json_encode($messages);
            } else {
                echo json_encode(['error' => 'No messages found for the given consultation_id']);
            }
        }
    }
}
