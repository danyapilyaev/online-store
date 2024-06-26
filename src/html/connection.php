<?php

$host = 'localhost';
$db_name = 'auth';
$db_user = 'root';
$db_pass = 'mysql';
$charset = 'utf8mb4';
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
];

try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$db_name;charset=$charset", $db_user, $db_pass, $options
    );
} catch (PDOException $e) {
    die("Ошибка подключения к базе данных: " . $e->getMessage()); 
}
?>