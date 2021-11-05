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
} elseif ($tipo_user != 'ADMINISTRADOR') {
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
  <title>Usuario administrador</title>

  <?php include 'header.php'; ?>
</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">
    <?php
    $sql = "SELECT * FROM usuarios where user=$dni";
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

          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">NUEVO TORNEO</h6>
            </div>
            <div class="card-body">
              <form action="procesos/crear_torneo.php" class="needs-validation" method="POST">
                <div class="form-group">
                  <h6 class="m-0 font-weight-bold text-danger">Datos del torneo</h6>
                  <hr class="sidebar-divider">
                </div>
                <div class="form-row">
                  <div class="form-group col-lg-6 col-md-6 col-sm-12">
                    <label for="nomb_torneo">Nombre del torneo</label>
                    <input type="text" class="form-control" name="nomb_torneo" required>
                  </div>
                  <div class="form-group col-lg-6 col-md-6 col-sm-12">
                    <label for="descripcion">Descripción</label>
                    <input type="text" class="form-control" name="descripcion" required>
                  </div>
                  <div class="form-group col-lg-3 col-md-4 col-sm-6">
                    <label for="fech_ini">Fecha de inicio</label>
                    <input type="date" name="fech_ini" id="fech_ini" class="form-control" required>
                  </div>
                  <div class="form-group col-lg-3 col-md-4 col-sm-6">
                    <label for="fech_fin">Fecha de termino</label>
                    <input type="date" name="fech_fin" id="fech_fin" class="form-control" required>
                  </div>
                  <div class="form-group col-lg-3 col-md-4 col-sm-6">
                    <label for="fech_ini_inscripcion">Fecha de inicio de inscripción</label>
                    <input type="date" name="fech_ini_inscripcion" class="form-control" required>
                  </div>
                  <div class="form-group col-lg-3 col-md-4 col-sm-6">
                    <label for="fech_fin_inscripcion">Fecha de termino de inscripción</label>
                    <input type="date" name="fech_fin_inscripcion" class="form-control" required>
                  </div>
                </div>
                <div class="row m-3">
                  <div class="col-md-12 d-flex justify-content-end">
                    <button type="submit" name="crear_torneo" class="btn btn-danger">Crear torneo <i class="fas fa-arrow-circle-right"></i></button>
                  </div>
                </div>
              </form>
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