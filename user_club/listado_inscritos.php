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
<html lang="es">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" constent="">
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
    $idclub = $fila['club_idclub'];

    $idtorneo = $_GET['idtorneo'];
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
              <h6 class="m-0 font-weight-bold text-primary">Listado de inscritos</h6>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-12 d-flex justify-content-end">
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#agregar_participante"><i class="fas fa-plus"></i> Nuevo inscrito</button>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12 p-2">
                  <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                      <thead>
                        <tr class="bg-primary" style="text-align:center; color:#000; font-size:0.813em;">
                          <th>N°</th>
                          <th style="display: none;">ID</th>
                          <th>Nombre inscrito</th>
                          <th>Sexo</th>
                          <th>Grado</th>
                          <th>Peso</th>
                          <th>Categoria KATA</th>
                          <th>Acciones</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $consulta = "SELECT * FROM detalle_torneo 
                        INNER JOIN participante ON detalle_torneo.detalle_torneo_idparticipante = participante.idparticipante
                        INNER JOIN categoria ON detalle_torneo.detalle_torneo_idcate_kata = categoria.idcategoria 
                        INNER JOIN torneo ON detalle_torneo.detalle_torneo_idtorneo = torneo.idtorneo
                        WHERE detalle_torneo_idtorneo = '$idtorneo'";
                        $i = 1;
                        $query = mysqli_query($con, $consulta);
                        if (mysqli_num_rows($query) > 0) {
                          while ($row3 = MySQLI_fetch_array($query)) {
                        ?>
                            <tr>
                              <td style="font-size: 13px;"><?php echo $i ?></td>
                              <td style="font-size: 13px; display: none"><?php echo $row3['iddetalle_torneo']; ?></td>
                              <td style="font-size: 13px;"><?php echo $row3['nombres'] . ' ' . $row3['apellidos']; ?></td>
                              <td style="font-size: 13px;"><?php echo $row3['sexo']; ?></td>
                              <td style="font-size: 13px;"><?php echo $row3['grado']; ?></td>
                              <td style="font-size: 13px;"><?php echo $row3['peso']; ?></td>
                              <td style="font-size: 13px;"><?php echo $row3['nomb_categoria'] ?><br></td>
                              <td>
                                <a href="editar_inscrito.php?iddetalle=<?php echo $row3['iddetalle_torneo']; ?>" class="btn btn-success btn-sm m-1"><i class="fa fa-edit"></i></a>
                                <button class="btn btn-danger btn-sm m-1 deleteBtn1"><i class="fa fa-times-circle"></i></button>
                              </td>
                            </tr>
                        <?php
                            $i++;
                          }
                        } else {
                          echo "<tr><td colspan='9' class='text-center text-danger font-weight-bold'>NO HAY CONCURSANTES REGISTRADOS</td></tr>";
                        }
                        ?>
                      </tbody>
                    </table>
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