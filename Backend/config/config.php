<?php
define('DB_HOST', 'localhost');      // Host database (misalnya, localhost)
define('DB_NAME', 'vetconnect');     // Nama database
define('DB_USER', 'root');           // Username database
define('DB_PASS', '');               // Password database (kosongkan jika tidak ada)

define('DB_CHARSET', 'utf8mb4');     // Pengaturan charset untuk mendukung karakter multibahasa
define('DB_DSN', 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHARSET);

// Pengaturan lainnya
define('BASE_URL', 'http://localhost/project-root');  // Sesuaikan dengan URL project jika sudah online
