<?php
include('../conexion.php');

if (isset($_POST['deleteData4'])) {
  $iddetalle_torneo = $_POST['iddetalle_torneo'];

  $consulta = "SELECT * FROM detalle_torneo WHERE iddetalle_torneo='$iddetalle_torneo'";
  $resultado = mysqli_query($con, $consulta);
  $row = MySQLI_fetch_array($resultado);
  $idparticipante = $row['detalle_torneo_idparticipante'];
  $idtorneo = $row['detalle_torneo_idtorneo'];

  $sql = "DELETE FROM detalle_torneo WHERE iddetalle_torneo = '" . $iddetalle_torneo . "' ";
  $result = mysqli_query($con, $sql);

  if ($result) {

    $sql2 = "DELETE FROM participante WHERE idparticipante = '" . $idparticipante . "' ";
    $result2 = mysqli_query($con, $sql2);
    if ($result2) {
      header('Location: ../listado_inscritos.php?idtorneo=' . $idtorneo);
    } else {
      echo '<script> alert("Error al eliminar registro del participante."); </script>';
      echo "<script type=\"text/javascript\">history.go(-1);</script>";
    }
  } else {
    echo '<script> alert("Error al eliminar registro del detalle torneo."); </script>';
    echo "<script type=\"text/javascript\">history.go(-1);</script>";
  }
}
