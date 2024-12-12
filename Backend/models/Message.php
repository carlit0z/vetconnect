<?php

class Message {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Kirim pesan baru
    public function createMessage($consultation_id, $sender_id, $message_content) {
        $sql = "INSERT INTO chat_messages (consultation_id, sender_id, message_content, timestamp) VALUES (?, ?, ?, NOW())";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$consultation_id, $sender_id, $message_content]);
    }

    // Ambil semua pesan berdasarkan ID konsultasi
    public function getMessagesByConsultation($consultation_id) {
        $sql = "SELECT * FROM chat_messages WHERE consultation_id = ? ORDER BY timestamp ASC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$consultation_id]);
        return $stmt->fetchAll();
    }

    // Hapus pesan berdasarkan ID
    public function deleteMessage($message_id) {
        $sql = "DELETE FROM chat_messages WHERE message_id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$message_id]);
    }
}
