<?php

require_once '../config/db.php';

class User {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Membuat pengguna baru
    public function createUser($username, $email, $password, $role) {
        $sql = "INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$username, $email, password_hash($password, PASSWORD_DEFAULT), $role]);
        return $this->pdo->lastInsertId();
    }

    // Mendapatkan pengguna berdasarkan ID
    public function getUserById($user_id) {
        $sql = "SELECT * FROM users WHERE user_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$user_id]);
        return $stmt->fetch();
    }

    // Mendapatkan pengguna berdasarkan email (untuk login)
    public function getUserByEmail($email) {
        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$email]);
        return $stmt->fetch();
    }

    // Mengupdate data pengguna
    public function updateUser($user_id, $username, $email, $role) {
        $sql = "UPDATE users SET username = ?, email = ?, role = ? WHERE user_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$username, $email, $role, $user_id]);
        return $stmt->rowCount();
    }

    // Menghapus pengguna
    public function deleteUser($user_id) {
        $sql = "DELETE FROM users WHERE user_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$user_id]);
        return $stmt->rowCount();
    }
}
?>
