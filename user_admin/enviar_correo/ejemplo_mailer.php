<?php
include '../conexion.php';
date_default_timezone_set('America/Lima');
$fecha_atencion = date('Y-m-d H:i:s');

$idsolicitud = $_POST['idsolicitud'];
$user = $_POST['user'];
$pass = $_POST['pass'];

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

$sql = "SELECT * FROM club WHERE club_idsolicitud = '$idsolicitud'";
$datos = mysqli_query($con, $sql);
$fila = mysqli_fetch_array($datos);
$idclub = $fila['idclub'];
$correo = $fila['correo'];
$nomb_club = $fila['nomb_club'];

$sql2 = "SELECT * FROM usuarios WHERE club_idclub = '$idclub'";
$datos2 = mysqli_query($con, $sql2);
$fila2 = mysqli_fetch_array($datos2);
$idusuarios = $fila2['idusuarios'];

$sql = "UPDATE solicitud_club SET estado_solicitud = 'ATENDIDO', fecha_atendido = '$fecha_atencion'
WHERE idsolicitud = '$idsolicitud'";
        
if ($con->query($sql) == TRUE){
    $sql2 = "UPDATE usuarios SET user = '$user', clave = '$pass', ren_clave = '$pass'
    WHERE idusuarios = '$idusuarios'";
    
    if ($con->query($sql2) == TRUE) {
        // Instantiation and passing `true` enables exceptions
        $mail = new PHPMailer(true);
        
        try {
            
          //Server settings
          $mail->SMTPDebug = 0;                      // Enable verbose debug output
          $mail->isSMTP();                                            // Send using SMTP
          $mail->Host       = 'nano.hostinglabs.net';                    // Set the SMTP server to send through
          $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
          $mail->Username   = 'federacion_karate@torneokarate.amsoftperu.com';                     // SMTP username
          $mail->Password   = 'bocasuelta123';                               // SMTP password
          $mail->SMTPSecure = 'ssl';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
          $mail->Port       = 465;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
        
          //Recipients
          $mail->setFrom($correo, utf8_decode('Credenciales para inicio de sesion - FPK'));
          $mail->addAddress($correo, $nomb_club);
        
          // Content
          $mail->isHTML(true);                                  // Set email format to HTML
          $mail->Subject = utf8_decode('Credenciales de usuario.');
          $mail->Body    = utf8_decode('Hola, le saluda la Federecion Peruana de Karate.<br>
          Usted solicito sus credenciales para el registro al sistema de los participantes
          que se encuentra en el siguiente <b> enlace:</b><br> 
          <a href="http://torneokarate.amsoftperu.com/index.php">Inicio de sesion</a><br>
          <h3>USUARIO:'.$user.'</h3><br>
          <h3>CONTRASENA:'.$pass.'</h3>');
          $mail->send();
          
        } catch (Exception $e) {
            $con->close();
            echo '<script>alert("Hubo un error al enviar el mensaje: {$mail->ErrorInfo}");
            window.history.back();</script>';
        } finally {
            header('Location: ../listado_club_interesados.php');
        }
        
    }else{
        $con->close();
        echo '<script>alert("Error al agregar credenciales.");
        window.history.back();</script>';
    }
}else{
    $con->close();
    echo '<script>alert("Error al actualizar datos de solicitud de club.");
         window.history.back();</script>';
}

