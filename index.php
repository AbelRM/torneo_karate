<?php

// server should keep session data for AT LEAST 1 hour 
ini_set('session.gc_maxlifetime', 7000);
// each client should remember their session id for EXACTLY 1 hour 
session_set_cookie_params(7000);

session_start();
// session_regenerate_id(true); 

if (!empty($_SESSION['active'])) {
  if ($_SESSION['rol'] == 'ADMINISTRADOR') {
    $dni = $_SESSION['dni'];
    header("Location: user_admin/index.php");
  } elseif ($_SESSION['rol'] == 'JUEZ') {
    header("Location: user_juez/index.php");
  } else {

    session_destroy();
    // header("Location: index.php");
  }
}
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Hugo 0.84.0">
  <title>Inicio de Sesión</title>

  <link rel="icon" type="image/png" href="img/icon_ipd.ico" />
  <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/sign-in/">
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">



  <!-- Bootstrap core CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">

  <style>
    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      user-select: none;
    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }
  </style>


  <!-- Custom styles for this template -->
  <link href="css/signin.css" rel="stylesheet">
</head>

<body class="text-center">

  <main class="form-signin">
    <form id="login">
      <img class="mb-4" src="img/logo_ipd.svg" alt="" width="100">
      <h1 class="h3 mb-3 fw-normal">Instituto Peruano del Deporte - Tacna</h1>

      <div class="form-floating">
        <input type="text" class="form-control" name="user" id="dni">
        <label for="floatingInput">Ingresar usuario...</label>
      </div>
      <div class="form-floating">
        <input type="password" class="form-control" name="clave" id="clave">
        <label for="floatingPassword">Ingresar contraseña...</label>
      </div>
    </form>
    <button class="w-100 btn btn-lg text-light" style="background-color: rgb(203, 47, 29);" type="submit" id="iniciar_sesion">Iniciar
      sesión</button>
    <hr>
    <a href="solicitar_inscripcion.php" class="mt-5 mb-3 fw-bolder"><i class="fas fa-user-plus"></i> Solicitar inscripción</a>
  </main>
  
    <div class="modal fade" id="comunicado" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">CAMPEONATO METROPOLITANO 2021</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <img src="img/torneo_karate.jpg" alt="Comunicado para el ingreso obligatorio de datos al sistema." width="100%" height="auto">
          </div>
        </div>
      </div>
    </div>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  <script src="js/jquery.js"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    $(document).on('click', '#iniciar_sesion', function(e) {
      var data = $("#login").serialize();
      $.ajax({
        data: data,
        type: "post",
        url: "procesos/login.php",
        success: function(dataResult) {
          var dataResult = JSON.parse(dataResult);
          if (dataResult.statusCode == 200) {
            if (dataResult.link == 1) {
              window.location = "user_admin/index.php";
            } else if (dataResult.link == 2) {
              window.location = "user_juez/index.php";
            } else if (dataResult.link == 3) {
              window.location = "user_club/index.php";
            }
          } else if (dataResult.statusCode == 201) {
            Swal.fire({
              title: 'ERROR AL INICIAR SESIÓN',
              text: dataResult.mensaje,
              icon: 'error',
              confirmButtonText: 'Aceptar',
            }).then(function() {
              $('#dni').val('');
              $('#clave').val('');
              $("#dni").css("border", "2px solid red");
              $("#dni").focus();
              return false;

            });
          } else if (dataResult.statusCode == 202) {
            Swal.fire({
              title: 'ERROR AL INICIAR SESIÓN',
              text: dataResult.mensaje,
              icon: 'error',
              confirmButtonText: 'Aceptar',
            }).then(function() {
              $('#clave').val('');
              $("#clave").css("border", "2px solid red");
              return false;

            });
          }
        }

      });
    });
  </script>
  <script>
    $( document ).ready(function() {
        $('#comunicado').modal('toggle')
    });
  </script>


</body>

</html>