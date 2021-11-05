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

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-3"><strong>TORNEO </strong> ACTUAL</h1>
          </div>

          <!-- Content Row -->
          <div class="row d-flex justify-content-center">
            <?php
            $sql2 = "SELECT * FROM torneo where estado_torneo='ACTUAL'";
            $datos2 = mysqli_query($con, $sql2);
            $fila2 = mysqli_fetch_array($datos2);
            ?>
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-6 col-md-6 mb-4">
              <div class="card mb-3">
                <div class="row no-gutters">
                  <div class="col-md-4">
                    <img src="img/torneo/torneo_actual.jpg" width="100%" height="auto" alt="Tmagen del torneo actual">
                  </div>
                  <div class="col-md-8">
                    <div class="card-body">
                      <h5 class="card-title"><?php echo $fila2['nomb_torneo']; ?></h5>
                      <p class="card-text"><?php echo $fila2['descripcion']; ?>.</p>
                      <p class="card-text"><small class="text-muted">24 y 25 de Julio</small></p>
                      <a href="listado_inscritos.php?idtorneo=<?php echo $fila2['idtorneo']; ?>" class="btn btn-primary btn-lg">Listado inscritos</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Divider -->
          <hr class="sidebar-divider">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h5 class="h5 mb-3"><strong>HISTORIAL DE </strong> TORNEOS</h5>
          </div>
          <div class="row">
            <div class="col-xl-6 col-md-6 mb-4">
              <div class="card mb-3">
                <div class="row no-gutters">
                  <div class="col-md-4">
                    <img src="img/torneo/torneo_1.jpg" width="100%" height="auto" alt="Tmagen del torneo actual">
                  </div>
                  <div class="col-md-8">
                    <div class="card-body">
                      <h5 class="card-title">Torneo de Kata en Tacna</h5>
                      <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                      <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-6 col-md-6 mb-4">
              <div class="card mb-3">
                <div class="row no-gutters">
                  <div class="col-md-4">
                    <img src="img/torneo/torneo_2.jpg" width="100%" height="auto" alt="Tmagen del torneo actual">
                  </div>
                  <div class="col-md-8">
                    <div class="card-body">
                      <h5 class="card-title">Torneo de Kata en Arequipa</h5>
                      <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                      <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                    </div>
                  </div>
                </div>
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