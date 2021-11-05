<?php
include 'conexion.php';
// server should keep session data for AT LEAST 1 hour 
ini_set('session.gc_maxlifetime', 3600);
// each client should remember their session id for EXACTLY 1 hour 
session_set_cookie_params(3600);

session_start();
// session_regenerate_id(true); 

$dni = $_SESSION['user'];
$tipo_user = $_SESSION['rol'];
if (empty($_SESSION['active'])) {
  header("Location: ../index.php");
} elseif ($tipo_user != 'CLUB') {
  header("Location: ../index.php");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" type="image/png" href="img/icons/icon_ipd.ico" />
  <title>Usuario Club</title>

  <?php include 'header.php'; ?>
</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">
    <?php
    $sql = "SELECT * FROM usuarios where user='$dni'";
    $datos = mysqli_query($con, $sql);
    $fila = mysqli_fetch_array($datos);
    ?>

    <!-- Sidebar -->
    <?php include_once 'menu.php'; ?>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <?php include_once 'nav.php'; ?>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title text-danger text-center font-weight-bold">¡BIENVENIDO AL SISTEMA - USUARIO CLUB</h5>
              <p class="card-text">Para la primera etapa de esta sección:</p>
              <dl class="row">
                <dt class="col-sm-1 text-center">1.</dt>
                <dd class="col-sm-11">Si desea registrar a un participante debe hacer lo siguiente, dando clic a
                  <span class="text-danger font-weight-bold">"Inscribir"</span> y seleccionar
                  <span class="text-success font-weight-bold">"Elegir torneo"</span>.
                </dd>
                <dt class="col-sm-1 text-center">2.</dt>
                <dd class="col-sm-11">En esta sección nos saldra el torneo actual, debemos dar clic en
                  <span class="text-danger font-weight-bold">"Listado de inscritos"</span>
                  <ul>
                    <li type="square">Para <span class="text-success font-weight-bold">"ingresar un nuevo participante"</span> debe dar clic en el boton de "Nuevo inscrito".
                    </li>
                  </ul>
                </dd>

              </dl>
              <div class="row d-flex justify-content-center">
                <a href="elegir_torneo.php?dni=<?php echo $dni ?>" class="btn btn-primary">EMPEZAR</a>
              </div>
            </div>
          </div>


        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <?php include_once 'foot.php' ?>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <?php include 'modal_cerrar_sesion.php'; ?>

  <?php include 'script.php'; ?>

</body>

</html>