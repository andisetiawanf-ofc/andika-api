<?php
require_once 'db.php';
header('Content-Type: application/json; charset=utf-8');

$data = json_decode(file_get_contents("php://input"), true);

$username = $data['username'] ?? '';
$password = $data['password'] ?? '';

if ($username === '' || $password === '') {
    echo json_encode([
        "status" => "error",
        "message" => "Username atau password kosong"
    ]);
    exit;
}

$stmt = $pdo->prepare(
    "SELECT id, username
     FROM users
     WHERE username = ?
       AND password = ?
       AND role = 'kasir'
     LIMIT 1"
);
$stmt->execute([$username, $password]);
$user = $stmt->fetch();

if ($user) {
    echo json_encode([
        "status" => "ok",
        "user_id" => (int)$user['id'],
        "username" => $user['username']
    ]);
} else {
    echo json_encode([
        "status" => "error",
        "message" => "Username atau password salah"
    ]);
}
