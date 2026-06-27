<?php
$host = 'localhost';
$user = 'root';
$password = '';
database_setup();

function get_db_connection() {
    global $host, $user, $password;
    $conn = new mysqli($host, $user, $password, 'dogs_db');
    if ($conn->connect_error) {
        die('Database connection failed: ' . $conn->connect_error);
    }
    return $conn;
}

function database_setup() {
    global $host, $user, $password;

    $conn = new mysqli($host, $user, $password);
    if ($conn->connect_error) {
        die('MySQL connection failed: ' . $conn->connect_error);
    }

    $conn->query("CREATE DATABASE IF NOT EXISTS dogs_db CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci");
    $conn->select_db('dogs_db');

    $createTableSql = "CREATE TABLE IF NOT EXISTS dogs (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100) NOT NULL,
        breed VARCHAR(100) NOT NULL,
        age INT NOT NULL,
        address VARCHAR(255) NOT NULL,
        color VARCHAR(100) NOT NULL,
        height VARCHAR(50) NOT NULL,
        weight VARCHAR(50) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
    $conn->query($createTableSql);

    $conn->close();
}
