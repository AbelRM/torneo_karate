<?php
require '../conexion.php';

// define("RECAPTCHA_V3_SECRET_KEY", '6LeVwMQZAAAAAHefDg1_0gUgPLg08Oto7rYLKSaF');

$nombres = strtoupper($_POST['nombres']);
$region = strtoupper($_POST['region']);
$delegado = $_POST['delegado'];
$correo = $_POST['correo'];
$celular = $_POST['celular'];

// $pass_hash=hashPassword($clave);
date_default_timezone_set('America/Lima');
$fecha_solicitud = date('Y-m-d H:i:s');


$sql = "INSERT INTO solicitud_club (nombre_club,correo,numero,delegado,estado_solicitud,fecha_solicitud) 
VALUES ('$nombres','$correo','$celular ','$delegado','PENDIENTE','$fecha_solicitud')";
$inser_soli = mysqli_query($con, $sql);

$query = mysqli_query($con, "SELECT @@identity AS idsolicitud");
if ($row = mysqli_fetch_row($query)) {
  $idsolicitud = trim($row[0]);
}

if ($inser_soli == TRUE) {
  $sql2 = "INSERT INTO club (nomb_club, ciudad_origen, correo, celular, delegado, estado_club, club_idsolicitud) 
    VALUES ('$nombres','$region','$correo ','$celular','$delegado','ACTIVO', '$idsolicitud')";
  $inser_club = mysqli_query($con, $sql2);

  $query = mysqli_query($con, "SELECT @@identity AS idclub");
  if ($row = mysqli_fetch_row($query)) {
    $idclub = trim($row[0]);
  }

  if ($inser_club == TRUE) {
    $sql3 = "INSERT INTO usuarios (nombres, apellidos, tipo_usuario_idtipo_usuario, club_idclub) 
      VALUES ('CLUB','" . $nombres . "','3','$idclub')";
    $inser_user = mysqli_query($con, $sql3);
    if ($inser_user == TRUE) {

      echo '<script>alert("SE ENVIO CORRECTAMENTE TU SOLICITUD.");
      window.location = "../index.php";</script>';
    } else {
      echo '<script>alert("Error al ingresar los datos de usuario, intente de nuevo.");
        window.location = "../solicitar_inscripcion.php";</script>';
    }
  } else {

    echo '<script>alert("Error al ingresar los datos de club, intente de nuevo.");
      window.location = "../solicitar_inscripcion.php";</script>';
  }
} else {

  echo '<script>alert("Error al ingresar los datos de solicitud, intente de nuevo.");
  window.location = "../solicitar_inscripcion.php";</script>';
}
