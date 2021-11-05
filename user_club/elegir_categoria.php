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
  <title>Usuario Administrador</title>

  <?php include 'header.php'; ?>
</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">
    <?php
    $sql = "SELECT * FROM usuarios where dni=$dni";
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

          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">LISTADO DE CATEGORIAS</h6>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-3 col-sm-6 mt-2">
                  <div class="card border-primary">
                    <a href="concursantes.php?idcate=1" class="text-decoration-none">
                      <div class="card-body text-center">
                        <h5 class="card-title">Categoria</h5>
                        <h3 class="card-subtitle mb-2 text-muted">A1</h3>
                        <p class="card-text text-dark">Individual Masculino 12 - 13 años</p>
                        <a href="concursantes.php?idcate=1" class="btn btn-primary mt-3">Ver concursantes</a>
                      </div>
                    </a>
                  </div>
                </div>
                <div class="col-md-3 col-sm-6 mt-2">
                  <div class="card border-primary">
                    <a href="concursante.php" class="text-decoration-none">
                      <div class="card-body text-center">
                        <h5 class="card-title">Categoria</h5>
                        <h3 class="card-subtitle mb-2 text-muted">A2</h3>
                        <p class="card-text text-dark">Individual Femenino 12 - 13 años </p>
                        <a href="concursante.php" class="btn btn-primary mt-3">Ver concursantes</a>
                      </div>
                    </a>
                  </div>
                </div>
                <div class="col-md-3 col-sm-6 mt-2">
                  <div class="card border-primary">
                    <a href="concursante.php" class="text-decoration-none">
                      <div class="card-body text-center">
                        <h5 class="card-title">Categoria</h5>
                        <h3 class="card-subtitle mb-2 text-muted">A3</h3>
                        <p class="card-text text-dark">Individual Masculino 14 - 15 años </p>
                        <a href="concursante.php" class="btn btn-primary mt-3">Ver concursantes</a>
                      </div>
                    </a>
                  </div>
                </div>
                <div class="col-md-3 col-sm-6 mt-2">
                  <div class="card border-primary">
                    <a href="concursante.php" class="text-decoration-none">
                      <div class="card-body text-center">
                        <h5 class="card-title">Categoria</h5>
                        <h3 class="card-subtitle mb-2 text-muted">A4</h3>
                        <p class="card-text text-dark">Individual Femenino 14 - 15 años </p>
                        <a href="concursante.php" class="btn btn-primary mt-3">Ver concursantes</a>
                      </div>
                    </a>
                  </div>
                </div>

                <div class="col-md-3 col-sm-6 mt-2">
                  <div class="card border-success">
                    <a href="concursante.php" class="text-decoration-none">
                      <div class="card-body text-center">
                        <h5 class="card-title">Categoria</h5>
                        <h3 class="card-subtitle mb-2 text-muted">A5</h3>
                        <p class="card-text text-dark">Individual Masculino 16 - 17 años </p>
                        <a href="concursante.php" class="btn btn-success mt-3">Ver concursantes</a>
                      </div>
                    </a>
                  </div>
                </div>
                <div class="col-md-3 col-sm-6 mt-2">
                  <div class="card border-success">
                    <a href="concursante.php" class="text-decoration-none">
                      <div class="card-body text-center">
                        <h5 class="card-title">Categoria</h5>
                        <h3 class="card-subtitle mb-2 text-muted">A6</h3>
                        <p class="card-text text-dark">Individual Femenino 16 - 17 años </p>
                        <a href="concursante.php" class="btn btn-success mt-3">Ver concursantes</a>
                      </div>
                    </a>
                  </div>
                </div>
                <div class="col-md-3 col-sm-6 mt-2">
                  <div class="card border-danger">
                    <a href="concursante.php" class="text-decoration-none">
                      <div class="card-body text-center">
                        <h5 class="card-title">Categoria</h5>
                        <h3 class="card-subtitle mb-2 text-muted">A7</h3>
                        <p class="card-text text-dark">Individual Masculino 18 - 20 años </p>
                        <a href="concursante.php" class="btn btn-danger mt-3">Ver concursantes</a>
                      </div>
                    </a>
                  </div>
                </div>
                <div class="col-md-3 col-sm-6 mt-2">
                  <div class="card border-danger">
                    <a href="concursante.php" class="text-decoration-none">
                      <div class="card-body text-center">
                        <h5 class="card-title">Categoria</h5>
                        <h3 class="card-subtitle mb-2 text-muted">A8</h3>
                        <p class="card-text text-dark">Individual Femenino 18 - 20 años </p>
                        <a href="concursante.php" class="btn btn-danger mt-3">Ver concursantes</a>
                      </div>
                    </a>
                  </div>
                </div>

                <div class="col-md-3 col-sm-6 mt-2">
                  <div class="card border-dark">
                    <a href="concursante.php" class="text-decoration-none">
                      <div class="card-body text-center">
                        <h5 class="card-title">Categoria</h5>
                        <h3 class="card-subtitle mb-2 text-muted">A9</h3>
                        <p class="card-text text-dark">Individual Masculino 16 años a más (Cinturon Negro)</p>
                        <a href="concursante.php" class="btn btn-dark mt-3">Ver concursantes</a>
                      </div>
                    </a>
                  </div>
                </div>
                <div class="col-md-3 col-sm-6 mt-2">
                  <div class="card border-dark">
                    <a href="concursante.php" class="text-decoration-none">
                      <div class="card-body text-center">
                        <h5 class="card-title">Categoria</h5>
                        <h3 class="card-subtitle mb-2 text-muted">A10</h3>
                        <p class="card-text text-dark">Individual Femenino 16 años a más (Cinturon Negro)</p>
                        <a href="concursante.php" class="btn btn-dark mt-3">Ver concursantes</a>
                      </div>
                    </a>
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