<?php

class User
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function createUser($username, $email, $password, $role)
    {
        $sql = "INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$username, $email, $password, $role]);
    }

    public function getUserByEmail($email)
    {
        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$email]);
        return $stmt->fetch();
    }

    public function getUserById($user_id)
    {
        $sql = "SELECT * FROM users WHERE user_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$user_id]);
        return $stmt->fetch();
    }
    public function getUserByUsername($username)
    {
        $sql = "SELECT user_id FROM users WHERE username = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$username]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getAllUsers()
    {

        $stmt = $this->pdo->prepare("SELECT * FROM users");

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateUser($user_id, $username, $email, $role, $password = null,)
    {
        $sql = "UPDATE users SET username = ?, email = ?, role = ?" . ($password ? ", password = ?" : "") . " WHERE user_id = ?";
        $params = $password ? [$username, $email, $password, $role, $user_id] : [$username, $email, $role, $user_id];
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($params);
    }

    public function deleteUser($user_id)
    {
        $sql = "DELETE FROM users WHERE user_id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$user_id]);
    }
}
