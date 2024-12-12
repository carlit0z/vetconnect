<?php

class Pet {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function createPet($user_id, $name, $species, $age) {
        $sql = "INSERT INTO pets (user_id, name, species, age) VALUES (?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$user_id, $name, $species, $age]);
    }

    public function getPetsByUserId($user_id) {
        $sql = "SELECT * FROM pets WHERE user_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$user_id]);
        return $stmt->fetchAll();
    }

    public function getPetById($pet_id) {
        $sql = "SELECT * FROM pets WHERE pet_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$pet_id]);
        return $stmt->fetch();
    }
    public function updatePet($pet_id, $name, $species, $age) {
        $sql = "UPDATE pets SET name = ?, species = ?, age = ? WHERE pet_id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$name, $species, $age, $pet_id]);
    }

    public function deletePet($pet_id) {
        $sql = "DELETE FROM pets WHERE pet_id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$pet_id]);
    }
}
