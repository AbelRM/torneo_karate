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
              <h6 class="m-0 font-weight-bold text-primary">Grupos</h6>
            </div>
            <div class="card-body">
              <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                  <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">
                    <div class="font-weight-bold text-danger">Equipo rojo</div>
                  </a>
                </li>
                <li class="nav-item" role="presentation">
                  <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">
                    <div class="font-weight-bold text-primary">Equipo azul</div>
                  </a>
                </li>
              </ul>
              <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active m-2" id="home" role="tabpanel" aria-labelledby="home-tab">
                  <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                      <thead>
                        <tr>
                          <th style="display: none;">id</th>
                          <th>N°</th>
                          <th>Concursante</th>
                          <th>DNI</th>
                          <th>Categoria</th>
                          <th>Estado puntaje</th>
                          <th>Estado concursante</th>
                          <th>Acciones</th>

                        </tr>
                      </thead>

                      <tbody>
                        <?php
                        $sql = "SELECT * FROM detalle_torneo 
                        INNER JOIN participante ON detalle_torneo.detalle_torneo_idparticipante = participante.idparticipante
                        INNER JOIN categoria ON  detalle_torneo.detalle_torneo_idcate = categoria.idcategoria
                        WHERE detalle_torneo_idcate = '$idcate'";
                        $i = 1;
                        $query = mysqli_query($con, $sql);
                        while ($row = MySQLI_fetch_array($query)) {
                        ?>
                          <tr>
                            <td style="display: none;"><?php echo $row['iddetalle_torneo'] ?></td>
                            <td><?php echo $i ?></td>
                            <td style="font-size: 14px;"><?php echo $row['nombres'] . ' ' . $row['apellidos'] ?></td>
                            <td style="font-size: 14px;"><?php echo $row['dni'] ?></td>
                            <td style="font-size: 14px;"><?php echo $row['nomb_categoria'] ?></td>
                            <td style="font-size: 14px;">
                              <?php if ($row['estado_detalle'] == 'CON PUNTAJE') {
                                echo '<small style="font-size: 16px;" class="badge badge-primary font-weight-bold">' . $row["estado_detalle"] . '</small>';
                              } elseif ($row['estado_detalle'] == 'SIN PUNTAJE') {
                                echo '<small style="font-size: 16px;" class="badge badge-danger font-weight-bold">' . $row["estado_detalle"] . '</small>';
                              } else {
                                echo '<small style="font-size: 16px;" class="badge badge-warning text-dark font-weight-bold">' . $row["estado_detalle"] . '</small>';
                              } ?>
                            </td>
                            <td style="font-size: 14px;">
                              <?php if ($row['estado_resultado'] == 'PARTICIPANDO') {
                                echo '<small style="font-size: 16px;" class="badge badge-primary font-weight-bold">' . $row["estado_resultado"] . '</small>';
                              } elseif ($row['estado_resultado'] == 'ELIMINADO') {
                                echo '<small style="font-size: 16px;" class="badge badge-danger font-weight-bold">' . $row["estado_resultado"] . '</small>';
                              } else {
                                echo '<small style="font-size: 16px;" class="badge badge-warning text-dark font-weight-bold">' . $row["estado_resultado"] . '</small>';
                              } ?>
                            </td>
                            <td>
                              <a href="agregar_puntaje.php?iddetalle=<?php echo $row['iddetalle_torneo']; ?>&idcate=<?php echo $idcate ?>" class="btn btn-primary"><i class="far fa-plus-square"></i> puntaje</a>
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
                <div class="tab-pane fade m-2" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                  <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable_2" width="100%" cellspacing="0">
                      <thead>
                        <tr>
                          <th style="display: none;">id</th>
                          <th>N°</th>
                          <th>N° convocatoria</th>
                          <th>Fecha Inicio</th>
                          <th>Fecha Fin</th>
                          <th>Estado convocatoria</th>
                          <th>Acciones</th>

                        </tr>
                      </thead>
                      <tbody>
                        <?php

                        $sql = "SELECT * FROM practicas";
                        $i = 1;
                        $query = mysqli_query($con, $sql);
                        while ($row = MySQLI_fetch_array($query)) {
                        ?>
                          <tr>
                            <td style="display: none;"><?php echo $row['idpracticas'] ?></td>
                            <td><?php echo $i ?></td>
                            <td style="font-size: 14px;"><?php echo $row['num_convoc'] . '-' . $row['anio_convoc'] ?></td>
                            <td style="font-size: 14px;"><?php echo $row['fech_inicio'] ?></td>
                            <td style="font-size: 14px;"><?php echo $row['fech_termino'] ?></td>
                            <td style="font-size: 14px;">
                              <?php if ($row['estado_con'] == 'ACTIVO') {
                                echo '<small style="font-size: 16px;" class="badge badge-primary font-weight-bold">' . $row["estado_con"] . '</small>';
                              } elseif ($row['estado_con'] == 'SUSPENDIDO') {
                                echo '<small style="font-size: 16px;" class="badge badge-danger font-weight-bold">' . $row["estado_con"] . '</small>';
                              } else {
                                echo '<small style="font-size: 16px;" class="badge badge-warning text-dark font-weight-bold">' . $row["estado_con"] . '</small>';
                              } ?>
                            </td>

                            <td>
                              <div class="row d-flex justify-content-center">
                                <a href="verconvocprac.php?practicas_idcon=<?php echo $row['idpracticas'] ?>"><button type="button" class="btn btn-warning m-1" id="editar"><i class="fa fa-eye"></i></button></a>
                                <a href="editar_convocatoria_prac.php?idpracticas=<?php echo $row['idpracticas'] ?>" type="button" class="btn btn-success m-1"><i class="fa fa-edit"></i></a>
                                <a href="#delete_prac_<?php echo $row['idpracticas']; ?>" class="btn btn-danger m-1" data-toggle="modal"><i class="fa fa-times-circle"></i></a>
                              </div>
                            </td>
                            <?php include('EditarModalPrac.php'); ?>
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
              <div class="row m-3 d-flex justify-content-center">
                <!-- <div class="col-md-12"> -->
                <a href="elegir_categoria.php" type="button" class="btn btn-secondary"><i class="fas fa-arrow-circle-left"></i> Retroceder</a>
                <!-- </div> -->
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