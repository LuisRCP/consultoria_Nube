<?php
require '../config/db.php';

$sql = "SELECT 
          consulta_id,
          nombre_remitente,
          email_remitente,
          asunto,
          estado,
          fecha_creado
        FROM consulta
        ORDER BY fecha_creado DESC";

$stmt = $pdo->query($sql);

echo json_encode($stmt->fetchAll());
