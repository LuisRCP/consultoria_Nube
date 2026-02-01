<?php
session_set_cookie_params([
    'path' => '/',
    'httponly' => true,
    'samesite' => 'Lax'
]);
session_start();
require '../config/db.php';

$data = json_decode(file_get_contents('php://input'), true);

$username = $data['username'] ?? '';
$clave    = $data['clave'] ?? '';

if ($username === '' || $clave === '') {
    http_response_code(400);
    echo json_encode(['ok' => false, 'msg' => 'Datos incompletos']);
    exit;
}

/* Buscar usuario */
$sql = "SELECT usuario_Id, username, clave 
        FROM usuario 
        WHERE username = ? 
        LIMIT 1";

$stmt = $pdo->prepare($sql);
$stmt->execute([$username]);
$user = $stmt->fetch();

if (!$user) {
    http_response_code(401);
    echo json_encode(['ok' => false, 'msg' => 'Credenciales inválidas']);
    exit;
}

/* Verificar contraseña */
if (!password_verify($clave, $user['clave'])) {
    http_response_code(401);
    echo json_encode(['ok' => false, 'msg' => 'Credenciales inválidas']);
    exit;
}

/* Login correcto → crear sesión */
$_SESSION['admin_id'] = $user['usuario_Id'];
$_SESSION['admin_user'] = $user['username'];

echo json_encode(['ok' => true]);
