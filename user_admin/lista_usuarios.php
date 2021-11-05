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
  <title>Listado de usuarios</title>

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
              <h6 class="m-0 font-weight-bold text-primary">Listado de usuarios registrados</h6>
            </div>
            <div class="card-body">
              <div class="row m-2">
                <div class="col-md-12 d-flex justify-content-end">
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#agregar_usuario"><i class="fas fa-plus"></i> Nuevo usuario</button>
                </div>
              </div>
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th style="display: none;">id</th>
                      <th>N°</th>
                      <th>Nombre del usuario</th>
                      <th>Usuario</th>
                      <th>Contraseña</th>
                      <th>Estado solicitud</th>
                      <th>Acciones</th>

                    </tr>
                  </thead>

                  <tbody>
                    <?php
                    $sql = "SELECT * FROM usuarios_t";
                    $i = 1;
                    $query = mysqli_query($con, $sql);
                    while ($row = MySQLI_fetch_array($query)) {
                    ?>
                      <tr>
                        <td style="display: none;"><?php echo $row['idusuarios'] ?></td>
                        <td><?php echo $i ?></td>
                        <td style="font-size: 14px;"><?php echo $row['nombres'] . ' ' . $row['apellidos']; ?></td>
                        <td style="font-size: 14px;"><?php echo $row['user']; ?></td>
                        <td style="font-size: 14px;"><?php echo $row['clave'] ?></td>
                        <td style="font-size: 14px;">
                          <?php if ($row['tipo_usuario'] == 'ADMINISTRADOR') {
                            echo '<small style="font-size: 16px;" class="badge badge-primary font-weight-bold">' . $row["tipo_usuario"] . '</small>';
                          } elseif ($row['tipo_usuario'] == 'JUEZ') {
                            echo '<small style="font-size: 16px;" class="badge badge-success font-weight-bold">' . $row["tipo_usuario"] . '</small>';
                          } else {
                            echo '<small style="font-size: 16px;" class="badge badge-warning text-dark font-weight-bold">' . $row["tipo_usuario"] . '</small>';
                          } ?>
                        </td>
                        <td>
                          <a href="editar_usuario.php?idusuario=<?php echo $row['idusuarios'] ?>" class="btn btn-primary"><i class="fa fa-edit"></i></button></a>
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