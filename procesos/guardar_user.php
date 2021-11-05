<?php
require '../conexion.php';

// define("RECAPTCHA_V3_SECRET_KEY", '6LeVwMQZAAAAAHefDg1_0gUgPLg08Oto7rYLKSaF');

$nombres = $con->real_escape_string(strtoupper($_POST['nombres']));
$dni = $con->real_escape_string($_POST['dni']);
$clave = $con->real_escape_string($_POST['clave']);
$confi_clave = $con->real_escape_string($_POST['confi_clave']);
$recuperar_contra = 0;


if ($clave != $confi_clave) {
  echo '<script>
          alert("La CONTRASEÑA ingresada no es igual a CONFIRMAR CONTRASE脩A, intente de nuevo.");
          window.location = "../registrar.php";
        </script>';
}

// $pass_hash=hashPassword($clave);
date_default_timezone_set('America/Lima');
$creacion_user = date('Y-m-d H:i:s');


$sql = "INSERT INTO usuarios (nombres,apellidos,dni,clave,ren_clave,tipo_usuario_idtipo_usuario) 
        VALUES ('" . $nombres . "','" . $apellidos . "','" . $dni . "','" . $clave . "','" . $confi_clave . "','1')";

$verificar_dni = mysqli_query($con, "SELECT * FROM usuarios WHERE dni='$dni'");
if (mysqli_num_rows($verificar_dni) > 0) {
  echo '<script>alert("El usuario con el DNI ya existe, intente de nuevo.");
  window.location = "../registrar.php";</script>';
  $con->close();
} else {
  if ($con->query($sql) == TRUE) {
    header('Location: ../index.php');
  } else {
    $con->close();
    echo '<script>
              alert("Error al ingresar los datos, intente de nuevo.");
              window.location = "../register.php";
            </script>';
  }
}
