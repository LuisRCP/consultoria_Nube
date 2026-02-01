<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require __DIR__ . '/../config/db.php';
require __DIR__ . '/../lib/PHPMailer/Exception.php';
require __DIR__ . '/../lib/PHPMailer/PHPMailer.php';
require __DIR__ . '/../lib/PHPMailer/SMTP.php';

$data = json_decode(file_get_contents('php://input'), true);

$nombre  = trim($data['nombre'] ?? '');
$email   = trim($data['email'] ?? '');
$asunto  = trim($data['asunto'] ?? '');
$mensaje = trim($data['mensaje'] ?? '');

if ($nombre === '' || $email === '' || $mensaje === '') {
    http_response_code(400);
    echo json_encode(['ok' => false]);
    exit;
}

$sql = "INSERT INTO consulta
(nombre_remitente, email_remitente, asunto, mensaje)
VALUES (?, ?, ?, ?)";

$stmt = $pdo->prepare($sql);
$stmt->execute([$nombre, $email, $asunto, $mensaje]);

$mail = new PHPMailer\PHPMailer\PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host = 'smtp.hostinger.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'soporteLRCP@ruxxcluster.online';
    $mail->Password = '4yd+K@F|f';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    $mail->setFrom('soporteLRCP@ruxxcluster.online', 'RuxxCluster');
    $mail->addAddress($email, $nombre);

    $mail->isHTML(true);
    $mail->Subject = 'Hemos recibido tu mensaje RuxxCluster';
    $mail->Body = "
        <!DOCTYPE html>
        <html lang='es'>
        <head>
          <meta charset='UTF-8'>
          <title>RuxxCluster</title>
        </head>
        <body style='margin:0; padding:0; background:#0b0f19;'>
        
          <table width='100%' cellpadding='0' cellspacing='0' style='background:#0b0f19; padding:30px 0;'>
            <tr>
              <td align='center'>
        
                <!-- CARD -->
                <table width='100%' cellpadding='0' cellspacing='0'
                       style='max-width:600px; background:#111827; border-radius:16px;
                              border:1px solid rgba(99,102,241,.25);
                              box-shadow:0 20px 60px rgba(0,0,0,.6);
                              font-family:Arial, sans-serif; color:#e5e7eb;'>
        
                  <!-- HEADER -->
                  <tr>
                    <td style='padding:30px; text-align:center;'>
                      <h1 style='margin:0; font-size:26px; color:#6366f1;'>
                        Ruxx<span style='color:#e5e7eb;'>Cluster</span>
                      </h1>
                      <p style='margin-top:8px; font-size:14px; color:#9ca3af;'>
                        Consultoría Tecnológica
                      </p>
                    </td>
                  </tr>
        
                  <!-- BODY -->
                  <tr>
                    <td style='padding:0 30px 30px 30px;'>
                      <p style='font-size:15px; line-height:1.6;'>
                        Hola <strong>{$nombre}</strong>,
                      </p>
        
                      <p style='font-size:15px; line-height:1.6;'>
                        Gracias por ponerte en contacto con nosotros.
                        Hemos recibido tu mensaje correctamente y uno de nuestros asesores
                        se pondrá en contacto contigo a la brevedad.
                      </p>
        
                      <!-- HORARIOS -->
                      <div style='margin:25px 0; padding:20px;
                                  background:#020617; border-radius:12px;
                                  border:1px solid rgba(99,102,241,.15);'>
        
                        <h3 style='margin-top:0; color:#c7d2fe; font-size:16px;'>
                          Horarios de atención
                        </h3>
        
                        <ul style='padding-left:18px; margin:0; font-size:14px; line-height:1.6;'>
                          <li><strong>Lunes a viernes:</strong> 8:00 – 19:00</li>
                          <li><strong>Sábado:</strong> 9:00 – 17:00</li>
                          <li><strong>Domingo:</strong> no se atienden consultas</li>
                        </ul>
                      </div>
        
                      <p style='font-size:14px; line-height:1.6; color:#9ca3af;'>
                        Si enviaste este mensaje fuera del horario de atención,
                        te responderemos en el siguiente horario hábil.
                      </p>
        
                      <p style='margin-top:25px; font-size:15px;'>
                        Saludos,<br>
                        <strong>Equipo RuxxCluster</strong>
                      </p>
                    </td>
                  </tr>
        
                  <!-- FOOTER -->
                  <tr>
                    <td style='padding:20px; text-align:center;
                               font-size:12px; color:#9ca3af;
                               border-top:1px solid rgba(255,255,255,.05);'>
                      © 2026 RuxxCluster · ruxxcluster.online<br>
                      Este es un mensaje automático, por favor no respondas a este correo.
                    </td>
                  </tr>
        
                </table>
                <!-- END CARD -->
        
              </td>
            </tr>
          </table>
        
        </body>
        </html>
        ";

    $mail->send();
} catch (Exception $e) {
}

echo json_encode(['ok' => true]);
