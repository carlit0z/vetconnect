<?php

class Pet {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Tambahkan hewan peliharaan
    public function createPet($user_id, $name, $species, $gender, $age) {
        $sql = "INSERT INTO pets (user_id, name, species, gender, age) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$user_id, $name, $species, $gender, $age]);
    }

    // Ambil semua hewan berdasarkan ID pengguna
    public function getPetsByUserId($user_id) {
        $sql = "SELECT * FROM pets WHERE user_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$user_id]);
        return $stmt->fetchAll();
    }

    // Ambil data hewan berdasarkan ID hewan
    public function getPetById($pet_id) {
        $sql = "SELECT * FROM pets WHERE pet_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$pet_id]);
        return $stmt->fetch();
    }

    // Perbarui data hewan
    public function updatePet($pet_id, $name, $species, $gender, $age) {
        $sql = "UPDATE pets SET name = ?, species = ?, gender = ?, age = ? WHERE pet_id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$name, $species, $gender, $age, $pet_id]);
    }

    // Hapus hewan peliharaan
    public function deletePet($pet_id) {
        $sql = "DELETE FROM pets WHERE pet_id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$pet_id]);
    }
}
