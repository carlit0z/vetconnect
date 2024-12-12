<?php
// File: config/db.php

$host = 'localhost'; // Host database
$dbname = 'vetconnect'; // Nama database
$username = 'root'; // Username database
$password = ''; // Password database (sesuaikan jika ada)

try {
    // Membuat koneksi ke database menggunakan PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Menangani error
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC); // Default mode fetch
} catch (PDOException $e) {
    // Jika koneksi gagal
    die("Database isn`t connect: " . $e->getMessage());
}
