<?php
$host = "sql302.infinityfree.com";
$db   = "if0_41111052_konter_hp";
$user = "if0_41111052";
$pass = "2506Andika";

try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$db;charset=utf8mb4",
        $user,
        $pass,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]
    );
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        "status" => "error",
        "message" => "DB connection failed"
    ]);
    exit;
}
