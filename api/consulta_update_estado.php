<?php
require '../config/db.php';

$data = json_decode(file_get_contents('php://input'), true);

$id     = $data['id'] ?? null;
$estado = $data['estado'] ?? null;

$permitidos = ['nueva','revisada','respondida'];

if (!is_numeric($id) || !in_array($estado, $permitidos)) {
    http_response_code(400);
    exit;
}

$sql = "UPDATE consulta SET estado = ? WHERE consulta_id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$estado, $id]);

echo json_encode(['ok' => true]);
