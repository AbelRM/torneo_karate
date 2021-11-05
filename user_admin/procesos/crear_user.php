<?php

include "../conexion.php";
date_default_timezone_set('America/Lima');
$fecha_atencion = date('Y-m-d H:i:s');


if (isset($_POST['agregar_user'])) {
  $nombres = $_POST['nombres'];
  $apellidos = $_POST['apellidos'];
  $user = $_POST['user'];
  $pass = $_POST['pass'];
  $tipo_user = $_POST['tipo_user'];

  $sql3 = "INSERT INTO usuarios (nombres, apellidos, user, clave, ren_clave, tipo_usuario_idtipo_usuario) 
      VALUES ('$nombres','" . $apellidos . "','3','$id')";
  $inser_user = mysqli_query($con, $sql3);
  if ($inser_user == TRUE) {
    echo '<script>alert("SE ENVIO CORRECTAMENTE TU SOLICITUD.");
        window.location = "../index.php";</script>';
  } else {
    echo '<script>alert("Error al ingresar los datos de usuario, intente de nuevo.");
        window.location = "../solicitar_inscripcion.php";</script>';
  }
}
