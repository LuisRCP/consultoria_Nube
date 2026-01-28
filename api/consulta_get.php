<?php
require '../config/db.php';

$id = $_GET['id'] ?? null;

if (!$id || !is_numeric($id)) {
    http_response_code(400);
    exit;
}

$sql = "SELECT * FROM consulta WHERE consulta_id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);

$consulta = $stmt->fetch();

if (!$consulta) {
    http_response_code(404);
    exit;
}

echo json_encode($consulta);
