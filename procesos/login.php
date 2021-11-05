<?php
// server should keep session data for AT LEAST 1 hour 
ini_set('session.gc_maxlifetime', 3600);
// each client should remember their session id for EXACTLY 1 hour 
session_set_cookie_params(3600);

session_start();
// session_regenerate_id(true); 

require_once "../conexion.php";

if (!empty($_SESSION['active'])) {
  if ($_SESSION['rol'] == ' ADMINISTRADOR') {
    $dni = $_SESSION['user'];
    header("Location: ../user_admin/index.php");
  } elseif ($_SESSION['rol'] == 'JUEZ') {
    $dni = $_SESSION['user'];
    header("Location: ../user_juez/index.php");
  } elseif ($_SESSION['rol'] == 'CLUB') {
    $dni = $_SESSION['user'];
    header("Location: ../user_club/index.php");
  } else {
    $dni = $_SESSION['user'];
    // echo json_encode(array("statusCode" => 200, 'dni' => $dni, 'rol' => 'ESTUDIANTE', 'link' => 1));
    header("Location: ../index.php");
  }
} else {
  if (empty($_POST['user']) || empty($_POST['clave'])) {
    echo json_encode(array("statusCode" => 201, 'mensaje' => "Ingrese su DNI y la clave."));
  } else {

    $dni = mysqli_real_escape_string($con, $_POST['user']);
    $clave = mysqli_real_escape_string($con, $_POST['clave']);

    $query = mysqli_query($con, "SELECT * FROM usuarios_t WHERE user='$dni'");
    $result = mysqli_num_rows($query);
    if ($result > 0) {
      $query_2 = mysqli_query($con, "SELECT * FROM usuarios_t WHERE user='$dni' AND clave='$clave'");
      $result_2 = mysqli_num_rows($query_2);
      if ($result_2 > 0) {
        $data = mysqli_fetch_array($query_2);

        $query2 = mysqli_query($con, "SELECT * FROM usuarios_t WHERE user='$dni' AND tipo_usuario='ADMINISTRADOR'");
        $resultado = mysqli_num_rows($query2);

        if ($resultado > 0) {

          $_SESSION['active'] = true;
          $_SESSION['idUser'] = $data['idusuarios'];
          $_SESSION['user'] = $data['user'];
          $_SESSION['rol'] = $data['tipo_usuario'];
          echo json_encode(array("statusCode" => 200, 'user' => $dni, 'rol' => 'ADMINISTRADOR', 'link' => 1));
        } else {
          $query3 = mysqli_query($con, "SELECT * FROM usuarios_t WHERE user='$dni' AND tipo_usuario='JUEZ'");
          $resultado2 = mysqli_num_rows($query3);
          if ($resultado2 > 0) {
            $data2 = mysqli_fetch_array($query3);
            $_SESSION['active'] = true;
            $_SESSION['idUser'] = $data2['idusuarios'];
            $_SESSION['user'] = $data2['user'];
            $_SESSION['rol'] = $data2['tipo_usuario'];

            echo json_encode(array("statusCode" => 200, 'user' => $dni, 'rol' => 'JUEZ', 'link' => 2));
          } else {
            $query4 = mysqli_query($con, "SELECT * FROM usuarios_t WHERE user='$dni' AND tipo_usuario='CLUB'");
            $resultado3 = mysqli_num_rows($query4);
            if ($resultado3 > 0) {
              $data3 = mysqli_fetch_array($query4);
              $_SESSION['active'] = true;
              $_SESSION['idUser'] = $data3['idusuarios'];
              $_SESSION['user'] = $data3['user'];
              $_SESSION['rol'] = $data3['tipo_usuario'];
              echo json_encode(array("statusCode" => 200, 'user' => $dni, 'rol' => 'CLUB', 'link' => 3));
            } else {
              session_destroy();
              echo json_encode(array("statusCode" => 201, 'mensaje' => "No existe un usuario para su cuenta."));
            }
          }
        }
      } else {
        session_destroy();
        echo json_encode(array("statusCode" => 202, 'mensaje' => "Contraseña incorrecta, ingrese de nuevo."));
      }
    } else {
      session_destroy();
      echo json_encode(array("statusCode" => 201, 'mensaje' => "Usuario incorrecto o no existe."));
    }
  }
}
