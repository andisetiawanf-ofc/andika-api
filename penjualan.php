<?php
require_once 'db.php';
header('Content-Type: application/json; charset=utf-8');

$data = json_decode(file_get_contents("php://input"), true);

$barang_id = $data['barang_id'] ?? 0;
$qty       = $data['qty'] ?? 0;
$user_id   = $data['user_id'] ?? 0;

$stmt = $pdo->prepare("SELECT stok, harga_jual FROM barang WHERE id=?");
$stmt->execute([$barang_id]);
$barang = $stmt->fetch();

if (!$barang || $barang['stok'] < $qty) {
    echo json_encode(["status" => "error"]);
    exit;
}

$total = $barang['harga_jual'] * $qty;

$pdo->prepare(
    "INSERT INTO penjualan (total, created_by)
     VALUES (?, ?)"
)->execute([$total, $user_id]);

$pdo->prepare(
    "UPDATE barang SET stok = stok - ? WHERE id=?"
)->execute([$qty, $barang_id]);

echo json_encode(["status" => "ok"]);
