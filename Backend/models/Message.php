<?php

class Message {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function createMessage($consultation_id, $sender_id, $message_content) {
        $sql = "INSERT INTO chat_messages (consultation_id, sender_id, message_content, timestamp) VALUES (?, ?, ?, NOW())";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$consultation_id, $sender_id, $message_content]);
    }

    public function getMessagesByConsultationId($consultation_id) {
        $sql = "SELECT * FROM chat_messages WHERE consultation_id = ? ORDER BY timestamp ASC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$consultation_id]);
        return $stmt->fetchAll();
    }

    public function getMessageById($message_id) {
        $sql = "SELECT * FROM chat_messages WHERE message_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$message_id]);
        return $stmt->fetch();
    }

    // Perbarui pesan
    public function updateMessage($message_id, $message_content) {
        $sql = "UPDATE chat_messages SET message_content = ? WHERE message_id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$message_content, $message_id]);
    }

    // Hapus pesan berdasarkan ID pesan
    public function deleteMessage($message_id) {
        $sql = "DELETE FROM chat_messages WHERE message_id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$message_id]);
    }

    // Hapus semua pesan berdasarkan ID konsultasi
    public function deleteMessagesByConsultationId($consultation_id) {
        $sql = "DELETE FROM chat_messages WHERE consultation_id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$consultation_id]);
    }
}
