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
<html lang="es">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" type="image/png" href="img/icons/icon_ipd.ico" />
  <title>Listado de club interesados</title>

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

          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Listado de Club's interesados</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th style="display: none;">id</th>
                      <th>N°</th>
                      <th>Nombre del Club</th>
                      <th>Correo</th>
                      <th>Nro. contacto</th>
                      <th>Fecha solicitud</th>
                      <th>Estado solicitud</th>
                      <th>Acciones</th>

                    </tr>
                  </thead>

                  <tbody>
                    <?php
                    $sql = "SELECT * FROM solicitud_club";
                    $i = 1;
                    $query = mysqli_query($con, $sql);
                    while ($row = MySQLI_fetch_array($query)) {
                    ?>
                      <tr>
                        <td style="display: none;"><?php echo $row['idsolicitud'] ?></td>
                        <td><?php echo $i ?></td>
                        <td style="font-size: 14px;"><?php echo $row['nombre_club'] ?></td>
                        <td style="font-size: 14px;"><?php echo $row['correo'] ?></td>
                        <td style="font-size: 14px;"><?php echo $row['numero'] ?></td>
                        <td style="font-size: 14px;"><?php echo $row['fecha_solicitud'] ?></td>
                        <td style="font-size: 14px;">
                          <?php if ($row['estado_solicitud'] == 'ATENDIDO') {
                            echo '<small style="font-size: 16px;" class="badge badge-primary font-weight-bold">' . $row["estado_solicitud"] . '</small>';
                          } elseif ($row['estado_solicitud'] == 'VENCIDO') {
                            echo '<small style="font-size: 16px;" class="badge badge-danger font-weight-bold">' . $row["estado_solicitud"] . '</small>';
                          } else {
                            echo '<small style="font-size: 16px;" class="badge badge-warning text-dark font-weight-bold">' . $row["estado_solicitud"] . '</small>';
                          } ?>
                        </td>
                        <td>
                          <a class="btn btn-primary deleteBtn1"><i class="fa fa-edit"></i></button></a>
                        </td>
                      </tr>

                    <?php
                      $i++;
                    }
                    ?>
                  </tbody>
                </table>
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