<?php

include "../conexion.php";

if (isset($_POST['crear_torneo'])) {
  $nomb_torneo = $_POST['nomb_torneo'];
  $descripcion = $_POST['descripcion'];
  $estado = 'ACTUAL';

  $fech_ini = $_POST['fech_ini'];
  $fech_fin = $_POST['fech_fin'];
  $fech_ini_inscripcion = $_POST['fech_ini_inscripcion'];
  $fech_fin_inscripcion = $_POST['fech_fin_inscripcion'];


  $sql = "INSERT INTO torneo (nomb_torneo, descripcion, estado_torneo, fecha_ini, fecha_fin, fech_ini_inscripcion, fech_fin_inscripcion) VALUES ('" . $nomb_torneo . "', '" . $descripcion . "', 'ACTUAL', '" . $fech_ini . "', '" . $fech_fin . "', '" . $fech_ini_inscripcion . "', '" . $fech_fin_inscripcion . "')";

  if ($con->query($sql) == TRUE) {
    header('Location: ../listado_torneos.php');
  } else {
    $con->close();
    echo '<script>alert("Error al crear el torneo.");
          window.location = "../crear_torneo.php";</script>';
  }
}
