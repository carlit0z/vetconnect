<?php

require_once '../config/db.php';

class Pet {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Menambahkan hewan baru
    public function createPet($user_id, $name, $species, $age) {
        $sql = "INSERT INTO pets (user_id, name, species, age) VALUES (?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$user_id, $name, $species, $age]);
        return $this->pdo->lastInsertId();
    }

    // Mendapatkan semua hewan milik user
    public function getPetsByUserId($user_id) {
        $sql = "SELECT * FROM pets WHERE user_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$user_id]);
        return $stmt->fetchAll();
    }

    // Mendapatkan data hewan berdasarkan ID
    public function getPetById($pet_id) {
        $sql = "SELECT * FROM pets WHERE pet_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$pet_id]);
        return $stmt->fetch();
    }

    // Mengupdate data hewan
    public function updatePet($pet_id, $name, $species, $age) {
        $sql = "UPDATE pets SET name = ?, species = ?, age = ? WHERE pet_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$name, $species, $age, $pet_id]);
        return $stmt->rowCount();
    }

    // Menghapus hewan
    public function deletePet($pet_id) {
        $sql = "DELETE FROM pets WHERE pet_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$pet_id]);
        return $stmt->rowCount();
    }
}
?>
