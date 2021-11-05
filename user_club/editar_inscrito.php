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
              <h6 class="m-0 font-weight-bold text-primary">Editar inscritos</h6>
            </div>
            <div class="card-body">
              <form action="procesos/update_parti.php" enctype="multipart/form-data" method="POST">
                <?php
                $consulta = "SELECT * FROM detalle_torneo 
                INNER JOIN participante ON detalle_torneo.detalle_torneo_idparticipante = participante.idparticipante
                INNER JOIN categoria ON detalle_torneo.detalle_torneo_idcate_kata = categoria.idcategoria 
                INNER JOIN torneo ON detalle_torneo.detalle_torneo_idtorneo = torneo.idtorneo
                WHERE iddetalle_torneo = '$iddetalle'";
                $datos = mysqli_query($con, $consulta);
                $row = mysqli_fetch_array($datos);
                ?>
                <div class="row">
                  <div class="col-lg-12 ol-md-12 col-sm-12 form-group">
                    <p class="text-danger font-weight-bold">NOTA:</p>
                    <ol class="text-danger font-weight-bold">
                      <li>(*) Indica un campo obligatorio.</li>
                    </ol>
                  </div>
                  <input type="hidden" name="iddetalle" value="<?php echo $iddetalle ?>">
                  <input type="hidden" name="idparticipante" value="<?php echo $row['detalle_torneo_idparticipante'] ?>">
                  <input type="hidden" name="idtorneo" value="<?php echo $row['detalle_torneo_idtorneo'] ?>">
                  <div class="col-lg-6 ol-md-6 col-sm-12 form-group">
                    <label for="title">(*) Nombres del competidor</label>
                    <input type="text" style="text-transform: uppercase; " name="nom_competidor" class="form-control" maxlength="65" value="<?php echo $row['nombres'] ?>" required>
                  </div>
                  <div class="col-lg-6 ol-md-6 col-sm-12 form-group">
                    <label for="title">(*) Apellidos del competidor</label>
                    <input type="text" style="text-transform: uppercase; " name="ape_competidor" class="form-control" maxlength="65" value="<?php echo $row['apellidos'] ?>" required>
                  </div>
                  <div class="col-lg-4 col-md-5 col-sm-6 form-group">
                    <label for="title">(*) D.N.I.</label>
                    <input type="number" value="<?php echo $row['dni'] ?>" name="dni" class="form-control" required>
                  </div>
                  <div class="col-lg-3 ol-md-4 col-sm-6 form-group">
                    <label for="title">(*) Fecha nacimiento</label>
                    <input type="date" name="fech_nacimiento" value="<?php echo $row['fech_nacimiento'] ?>" class="form-control" required>
                  </div>
                  <div class="col-lg-2 col-md-4 col-sm-6 form-group" id="div_nivel_estudio">
                    <label for="title">(*) Sexo</label>
                    <?php $sexo = $row['sexo'] ?>
                    <select name="sexo" id="sexo" style="font-weight:700;" class="form-control">
                      <option disabled>Elegir...</option>
                      <option value="Masculino">Masculino</option>
                      <option value="Femenino">Femenino</option>
                    </select>
                  </div>
                  <div class="col-lg-3 col-md-4 col-sm-6 form-group" id="div_nivel_estudio">
                    <label for="title">(*) Grado</label>
                    <?php $grado = $row['grado'] ?>
                    <select name="grado" id="grado" style="font-weight:700;" class="form-control">
                      <option disabled>Elegir...</option>
                      <option value="3 Kyu">3 Kyu</option>
                      <option value="4 Kyu">4 Kyu</option>
                      <option value="5 Kyu">5 Kyu</option>
                      <option value="6 Kyu">6 Kyu</option>
                      <option value="7 Kyu">7 Kyu</option>
                      <option value="8 Kyu">8 Kyu</option>
                      <option value="9 Kyu">9 Kyu</option>
                      <option value="1 Dan">1 Dan</option>
                      <option value="2 Dan">2 Dan</option>
                    </select>
                  </div>
                  <div class="col-lg-4 col-md-5 col-sm-6 form-group">
                    <label for="title">(*) Peso participante (Kg.)</label>
                    <input type="number" name="peso" value="<?php echo $row['peso'] ?>" class="form-control" required>
                  </div>
                  <div class="col-lg-8 col-md-8 col-sm-12 form-group">
                    <label for="title">(*) Modalidad a participar:</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <label class="input-group-text" for="categoria_kata">KATA</label>
                      </div>
                      <?php $detalle_torneo_idcate_kata = $row['detalle_torneo_idcate_kata'] ?>
                      <select class="form-control" name="categoria_kata" id="detalle_torneo_idcate_kata" required>
                        <option value="1" class="font-weigh-bold" selected>No participa</option>
                        <?php
                        $query = $con->query("SELECT * FROM categoria WHERE tipo_modalidad = 'KATA'");
                        while ($valores = mysqli_fetch_array($query)) {
                          echo '<option value="' . $valores['idcategoria'] . '">' . $valores['nomb_categoria'] . '</option>';
                        }
                        ?>
                      </select>
                      <div class="input-group-prepend">
                        <?php $detalle_torneo_idcate_kumite = $row['detalle_torneo_idcate_kumite'] ?>
                        <label class="input-group-text" for="categoria_kumi">KUMITE</label>
                      </div>
                      <select class="form-control" name="categoria_kumi" id="detalle_torneo_idcate_kumite" required>
                        <option value="1">No participar</option>
                        <option value="Participar">Participar</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-lg-4 col-md-6 col-sm-6 form-group" id="agregar_kata">
                    <label for="title">(*) Primer KATA a realizar</label>
                    <input type="number" name="kata" class="form-control" value="<?php echo $row['nro_kata'] ?>" placeholder="Ingrese el nro.">
                  </div>
                  <div class="col-lg-4 col-md-6 col-sm-6 form-group" id="agregar_kumite">
                    <label for="title">(*) Código KUMITE</label>
                    <input type="text" name="codigo_kumite" style="text-transform: uppercase;" class="form-control" value="<?php echo $row['codigo_kumite'] ?>" placeholder="Ejemplo: B9">
                  </div>
                  <div class="col-lg-4 col-md-6 col-sm-6 form-group">

                  </div>
                  <div class="col-lg-4 col-md-6 col-sm-6 form-group">
                    <label for=" title">(*) Foto del participante:</label>
                    <img src="fotos/<?php echo $row['dni'] ?>/<?php echo $row['foto'] ?>" alt="Foto del participante" width="50%" height="auto">
                  </div>
                  <div class="col-lg-8 col-md-6 col-sm-6 form-group">
                    <label for=" title">(*) Actualizar foto del participante: <small class="text-small text-danger">Ignorar sino desea actualizar.</small></label>
                    <input type="file" name="foto_update" accept="image/*" class="form-control" />
                  </div>
                </div>
                <div class="modal-footer">
                  <a type="button" href="listado_inscritos.php?idtorneo=<?php echo $row['detalle_torneo_idtorneo'] ?>" class="btn btn-secondary">Retroceder</a>
                  <button type="submit" class="btn btn-primary" name="actualizar_participante"><i class="fas fa-save"></i> Actualizar</button>
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
  <script>
    $(document).ready(function() {
      $('#sexo > option[value="<?php echo $sexo ?>"]').attr('selected', 'selected');
      $('#grado > option[value="<?php echo $grado ?>"]').attr('selected', 'selected');
      $('#detalle_torneo_idcate_kata > option[value="<?php echo $detalle_torneo_idcate_kata ?>"]').attr('selected', 'selected');
      $('#detalle_torneo_idcate_kumite > option[value="<?php echo $detalle_torneo_idcate_kumite ?>"]').attr('selected', 'selected');
    });
  </script>

</body>

</html>