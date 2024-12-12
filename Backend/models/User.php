<?php

class User {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Tambahkan pengguna baru
    public function createUser($username, $email, $password, $role) {
        $sql = "INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$username, $email, $password, $role]);
    }

    // Ambil pengguna berdasarkan email
    public function getUserByEmail($email) {
        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$email]);
        return $stmt->fetch();
    }

    // Ambil pengguna berdasarkan ID
    public function getUserById($user_id) {
        $sql = "SELECT * FROM users WHERE user_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$user_id]);
        return $stmt->fetch();
    }

    // Perbarui data pengguna
    public function updateUser($user_id, $username, $email, $password, $role) {
        $sql = "UPDATE users SET username = ?, email = ?, password = ?, role = ? WHERE user_id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$username, $email, $password, $role, $user_id]);
    }

    // Hapus pengguna
    public function deleteUser($user_id) {
        $sql = "DELETE FROM users WHERE user_id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$user_id]);
    }
}
