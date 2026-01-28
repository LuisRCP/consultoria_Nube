<?php
require '../config/db.php';

$data = json_decode(file_get_contents('php://input'), true);

$sql = "INSERT INTO consulta
(nombre_remitente, email_remitente, asunto, mensaje)
VALUES (:nombre, :email, :asunto, :mensaje)";

$stmt = $pdo->prepare($sql);
$stmt->execute([
    ':nombre' => $data['nombre'],
    ':email'  => $data['email'],
    ':asunto' => $data['asunto'],
    ':mensaje'=> $data['mensaje']
]);

echo json_encode(['ok' => true]);
