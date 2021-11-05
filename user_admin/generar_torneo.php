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
            $idtorneo = $fila2['idtorneo'];
            ?>
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-7 col-md-12 mb-4">
              <div class="card mb-3">
                <div class="row no-gutters">
                  <div class="col-lg-5 col-md-4">
                    <img src="img/torneo/torneo_actual.jpg" width="100%" height="auto" alt="Tmagen del torneo actual">
                  </div>
                  <div class="col-lg-7 col-md-8">
                    <div class="card-body">
                      <h5 class="card-title"><?php echo $fila2['nomb_torneo']; ?></h5>
                      <div class="text-center mt-4">
                          <h6>Estado de generación:</h6>
                          <?php if ($fila2['estado_gene'] == 'GENERADO') {
                            echo '<small style="font-size: 16px;" class="badge badge-primary font-weight-bold">' . $fila2["estado_gene"] . '</small>';
                          } elseif ($fila2['estado_gene'] == 'NO GENERADO') {
                            echo '<small style="font-size: 16px;" class="badge badge-danger font-weight-bold">' . $fila2["estado_gene"] . '</small>';
                          } else {
                            echo '<small style="font-size: 16px;" class="badge badge-warning text-dark font-weight-bold">' . $fila2["estado_gene"] . '</small>';
                          } ?>
                      </div>
                      <div class="text-center mt-4">
                          <h6>Intento (Max. 3):</h6>
                        <h2 class="font-weight-bolder text-center" style="font-size: 3.125em"><?php echo $fila2['intento']; ?></h2>
                      </div>
                      
                      <div class="d-flex justify-content-center mt-4">
                        <form method="POST" action="procesos/generar_torneo.php">
                            <input type="hidden" class="form-control" name="idtorneo" value="<?php echo $idtorneo ?>">
                            <button class="btn btn-primary btn-lg" type="submit"><i class="fas fa-clipboard-list"></i> Generar Torneo</button>
                        </form>
                      </div>
                      
                      
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