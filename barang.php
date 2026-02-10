<?php
require_once 'db.php';
header('Content-Type: application/json; charset=utf-8');

$stmt = $pdo->query(
    "SELECT id, merk, model, harga_jual, stok
     FROM barang
     ORDER BY id DESC"
);

echo json_encode($stmt->fetchAll());
