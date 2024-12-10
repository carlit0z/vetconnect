<?php

require_once '../config/db.php';

class Message {
    private $pdo;

    // Konstruktor untuk menginisialisasi koneksi PDO
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // **CREATE**: Menambahkan pesan baru ke dalam database
    public function createMessage($consultation_id, $sender_id, $message_content) {
        $query = "INSERT INTO chat_messages (consultation_id, sender_id, message_content, timestamp) 
                VALUES (:consultation_id, :sender_id, :message_content, NOW())";
        $stmt = $this->pdo->prepare($query);
        
        $stmt->bindParam(':consultation_id', $consultation_id, PDO::PARAM_INT);
        $stmt->bindParam(':sender_id', $sender_id, PDO::PARAM_INT);
        $stmt->bindParam(':message_content', $message_content, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // **READ**: Mengambil semua pesan untuk konsultasi tertentu
    public function getMessagesByConsultation($consultation_id) {
        $query = "SELECT * FROM chat_messages WHERE consultation_id = :consultation_id ORDER BY timestamp ASC";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':consultation_id', $consultation_id, PDO::PARAM_INT);
        
        $stmt->execute();
        return $stmt->fetchAll(); // Mengembalikan semua pesan dalam bentuk array
    }

    // **UPDATE**: Memperbarui isi pesan
    public function updateMessage($message_id, $message_content) {
        $query = "UPDATE chat_messages SET message_content = :message_content WHERE message_id = :message_id";
        $stmt = $this->pdo->prepare($query);
        
        $stmt->bindParam(':message_id', $message_id, PDO::PARAM_INT);
        $stmt->bindParam(':message_content', $message_content, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // **DELETE**: Menghapus pesan berdasarkan message_id
    public function deleteMessage($message_id) {
        $query = "DELETE FROM chat_messages WHERE message_id = :message_id";
        $stmt = $this->pdo->prepare($query);
        
        $stmt->bindParam(':message_id', $message_id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
?>
