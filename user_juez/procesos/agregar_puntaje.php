<?php
include '../conexion.php';
$iddetalle = $_POST['iddetalle'];
$idcate = $_POST['idcate'];

$entero_tec = $_POST['entero_tec'];
$decimal_tec = $_POST['decimal_tec'];
$entero_fis = $_POST['entero_fis'];
$decimal_fis = $_POST['decimal_fis'];

$puntaje_tecnico = $entero_tec . $decimal_tec;
$puntaje_fisico = $entero_fis . $decimal_fis;


$sql = "INSERT INTO puntaje (puntaje_tecnico,puntaje_fisico) VALUES ('" . $puntaje_tecnico . "','" . $puntaje_fisico . "')";
$insert = mysqli_query($con, $sql);

$query = mysqli_query($con, "SELECT @@identity AS idpuntaje");
if ($row = mysqli_fetch_row($query)) {
  $id = trim($row[0]);
}

if ($insert == TRUE) {
  $sql2 = "UPDATE detalle_torneo SET detalle_torneo_idpuntaje = '$id', estado_detalle = 'CON PUNTAJE' WHERE iddetalle_torneo = '$iddetalle'";
  $update = mysqli_query($con, $sql2);
  if ($update == TRUE) {
    header("Location: ../concursantes.php?idcate=$idcate");
  } else {
    echo "ERROR AL ACTUALIZAR DATOS DE DETALLE TORNEO";
  }
} else {
  echo "ERROR AL INSERTAR DATOS DE PUNTAJE";
}
