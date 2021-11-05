<?php
include 'conexion.php';
// server should keep session data for AT LEAST 1 hour 
ini_set('session.gc_maxlifetime', 3600);
// each client should remember their session id for EXACTLY 1 hour 
session_set_cookie_params(3600);

session_start();
// session_regenerate_id(true); 

$dni = $_SESSION['dni'];
$tipo_user = $_SESSION['rol'];
if (empty($_SESSION['active'])) {
  header("Location: ../index.php");
} elseif ($tipo_user != 'JUEZ') {
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
  <title>Usuario Juez</title>

  <?php include 'header.php'; ?>
</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">
    <?php
    $sql = "SELECT * FROM usuarios where dni=$dni";
    $datos = mysqli_query($con, $sql);
    $fila = mysqli_fetch_array($datos);

    $idcate = $_GET['idcate'];
    $iddetalle = $_GET['iddetalle'];
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

          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Agregar puntaje</h6>
            </div>
            <div class="card-body">
              <form action="procesos/agregar_puntaje.php" method="post">
                <input type="hidden" name="iddetalle" value="<?php echo $iddetalle ?>">
                <input type="hidden" name="idcate" value="<?php echo $idcate ?>">
                <div class="row d-flex align-items-center mb-3 justify-content-center">
                  <div class="col-xl-4 col-md-6 col-sm-12">
                    <div class="card border-left-primary">
                      <div class="card-body text-center">
                        <h3 class="card-title text-dark font-weight-bolder">ASPECTO TÉCNICO</h3>
                        <div class="row d-flex justify-content-center">
                          <div class="col-xl-5 col-md-6 col-sm-12">
                            <select name="entero_tec" class="form-control form-control-lg font-weight-bolder text-white bg-primary" style="font-size: 40px;">
                              <!-- <option disabled class="font-weight-bolder">Elegir...</option> -->
                              <option value="0" class="font-weight-bolder" style="font-size: 25px;">0</option>
                              <option value="10" class="font-weight-bolder" style="font-size: 25px;">10</option>
                              <option value="9" class="font-weight-bolder" style="font-size: 25px;">9</option>
                              <option value="8" class="font-weight-bolder" style="font-size: 25px;">8</option>
                              <option value="7" class="font-weight-bolder" style="font-size: 25px;">7</option>
                              <option value="6" class="font-weight-bolder" style="font-size: 25px;">6</option>
                              <option value="5" class="font-weight-bolder" style="font-size: 25px;">5</option>

                            </select>
                          </div>
                          <div class="col-xl-5 col-md-6 col-sm-12">
                            <select name="decimal_tec" class="form-control form-control-lg font-weight-bolder text-white bg-primary" style="font-size: 40px;">
                              <!-- <option disabled>Elegir...</option> -->
                              <option value=".0" class="font-weight-bolder" style="font-size: 25px;">.0</option>
                              <option value=".2" class="font-weight-bolder" style="font-size: 25px;">.2</option>
                              <option value=".4" class="font-weight-bolder" style="font-size: 25px;">.4</option>
                              <option value=".6" class="font-weight-bolder" style="font-size: 25px;">.6</option>
                              <option value=".8" class="font-weight-bolder" style="font-size: 25px;">.8</option>
                            </select>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-4 col-md-6 col-sm-12 mt-3">
                    <div class="card border-left-success">
                      <div class="card-body text-center">
                        <h3 class="card-title text-dark font-weight-bolder">ASPECTO FÍSICO</h3>
                        <div class="row d-flex justify-content-center">
                          <div class="col-xl-5 col-md-6 col-sm-12">
                            <select name="entero_fis" class="form-control form-control-lg font-weight-bolder text-white bg-success" style="font-size: 40px;">
                              <option value="0" class="font-weight-bolder" style="font-size: 25px;">0</option>
                              <option value="10" class="font-weight-bolder" style="font-size: 25px;">10</option>
                              <option value="9" class="font-weight-bolder" style="font-size: 25px;">9</option>
                              <option value="8" class="font-weight-bolder" style="font-size: 25px;">8</option>
                              <option value="7" class="font-weight-bolder" style="font-size: 25px;">7</option>
                              <option value="6" class="font-weight-bolder" style="font-size: 25px;">6</option>
                              <option value="5" class="font-weight-bolder" style="font-size: 25px;">5</option>

                            </select>
                          </div>
                          <div class="col-xl-5 col-md-6 col-sm-12">
                            <select name="decimal_fis" class="form-control form-control-lg font-weight-bolder text-white bg-success" style="font-size: 40px;">
                              <!-- <option disabled>Elegir...</option> -->
                              <option value=".0" class="font-weight-bolder" style="font-size: 25px;">.0</option>
                              <option value=".2" class="font-weight-bolder" style="font-size: 25px;">.2</option>
                              <option value=".4" class="font-weight-bolder" style="font-size: 25px;">.4</option>
                              <option value=".6" class="font-weight-bolder" style="font-size: 25px;">.6</option>
                              <option value=".8" class="font-weight-bolder" style="font-size: 25px;">.8</option>
                            </select>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6 mt-3 d-flex justify-content-end">
                    <a href="elegir_categoria.php" type="button" class="btn btn-secondary"><i class="fas fa-arrow-circle-left"></i> Retroceder</a>

                  </div>
                  <div class="col-md-6 mt-3">
                    <button type="submit" class="btn btn-success"><i class="far fa-check-circle"></i> Confirmar</button>
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