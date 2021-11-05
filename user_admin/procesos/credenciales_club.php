<?php

include "../conexion.php";
date_default_timezone_set('America/Lima');
$fecha_atencion = date('Y-m-d H:i:s');

if (isset($_POST['actualizar_participante'])) {
  $idsolicitud = $_POST['idsolicitud'];
  $user = $_POST['user'];
  $pass = $_POST['pass'];

  $sql = "SELECT * FROM club WHERE club_idsolicitud = '$idsolicitud'";
  $datos = mysqli_query($con, $sql);
  $fila = mysqli_fetch_array($datos);
  $idclub = $fila['idclub'];

  $sql2 = "SELECT * FROM usuarios WHERE club_idclub = '$idclub'";
  $datos2 = mysqli_query($con, $sql2);
  $fila2 = mysqli_fetch_array($datos2);
  $idusuarios = $fila2['idusuarios'];

  $sql = "UPDATE solicitud_club SET estado_solicitud = 'ATENDIDO', fecha_atendido = '$fecha_atencion'
  WHERE idsolicitud = '$idsolicitud'";

  if ($con->query($sql) == TRUE) {
    $sql2 = "UPDATE usuarios SET user = '$user', clave = '$pass', ren_clave = '$pass'
    WHERE idusuarios = '$idusuarios'";

    if ($con->query($sql2) == TRUE) {

      header('Location: ../listado_club_interesados.php');
    } else {
      $con->close();
      echo '<script>alert("Error al agregar credenciales.");
         window.history.back();</script>';
    }
  } else {
    $con->close();
    echo '<script>alert("Error al actualizar datos de solicitud de club.");
         window.history.back();</script>';
  }
}
