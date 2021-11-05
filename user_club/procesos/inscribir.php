<?php

include "../conexion.php";

if (isset($_POST['guardar_participante'])) {
  $nom_competidor = $_POST['nom_competidor'];
  $ape_competidor = $_POST['ape_competidor'];
  $fech_nacimiento = $_POST['fech_nacimiento'];
  $dni = $_POST['dni'];
  $grado = $_POST['grado'];
  $sexo = $_POST['sexo'];
  $peso = $_POST['peso'];

  $idclub = $_POST['idclub'];
  $idtorneo = $_POST['idtorneo'];

  $categoria_kata = $_POST['categoria_kata'];
  $categoria_kumi = $_POST['categoria_kumi'];

  //crear carpeta
  $micarpeta = '../fotos/' . $dni . '/';
  if (!file_exists($micarpeta)) {
    mkdir($micarpeta, 0777, true);
  }
  //datos del arhivo
  $nombre_archivo = $_FILES['foto']['name'];
  $tipo_archivo = $_FILES['foto']['type'];
  $tamano_archivo = $_FILES['foto']['size'];

  $new_nombre = "foto1.jpg";

  if (!(strpos($tipo_archivo, "image/*") && ($tamano_archivo <= 5000000))) {
    echo '<script> alert("El archivo supera los 5MB máximos, o no es un tipo imagen."); </script>';
    echo "<script type=\"text/javascript\">history.go(-1);</script>";
  } else {
    if (move_uploaded_file($_FILES['foto']['tmp_name'], $micarpeta . $new_nombre)) {
      $sql = "INSERT INTO participante (nombres, apellidos, fech_nacimiento, dni, estado_parti, sexo, grado, peso, foto, club_idclub) VALUES ('" . $nom_competidor . "', '" . $ape_competidor . "', '$fech_nacimiento', '$dni', 'Participando','" . $sexo . "', '" . $grado . "', '" . $peso . "', '$new_nombre','" . $idclub . "')";

      if ($con->query($sql) == TRUE) {
        $query = mysqli_query($con, "SELECT @@identity AS idparticipante");
        if ($row = mysqli_fetch_row($query)) {
          $idparticipante = trim($row[0]);
        }

        if ($categoria_kata == 'Participar') {
          $kata = $_POST['kata'];

          $fecha_nacimiento = new DateTime($fech_nacimiento);
          $hoy = new DateTime(date("Y-m-d"));
          $edad_cal = $hoy->diff($fecha_nacimiento);
          $edad = $edad_cal->format('%y');

          if ($edad >= 16 and ($grado == "1 Dan" or $grado == "2 Dan") and $sexo == "Masculino") {
            $idcategoria_kata = 10;
          } elseif ($edad >= 16 and ($grado == "1 Dan" or $grado == "2 Dan") and $sexo == "Femenino") {
            $idcategoria_kata = 11;
          } else {
            $consulta = "SELECT * FROM categoria where (edad_ini <= $edad and edad_fin >= $edad) AND sexo = '$sexo' AND tipo_modalidad = 'KATA'";
            $resul = mysqli_query($con, $consulta);
            $row = MySQLI_fetch_array($resul);
            $idcategoria_kata = $row['idcategoria'];
          }

          if ($categoria_kumi == 'Participar') {
            $codigo_kumite = strtoupper($_POST['codigo_kumite']);

            $sql2 = "INSERT INTO detalle_torneo (detalle_torneo_idparticipante, detalle_torneo_idcate_kata, detalle_torneo_idcate_kumite, codigo_kumite, detalle_torneo_idtorneo, estado_detalle, estado_resultado, nro_kata) 
            VALUES ('" . $idparticipante . "', '$idcategoria_kata', '$categoria_kumi', '$codigo_kumite','$idtorneo', 'Participando','Participando', '$kata')";

            if ($con->query($sql2) == TRUE) {
              header('Location: ../listado_inscritos.php?idtorneo=' . $idtorneo);
            } else {
              $con->close();
              echo '<script>alert("Error al agregar detalle del torneo.");
              window.history.back();</script>';
            }
          } else {
            $sql2 = "INSERT INTO detalle_torneo (detalle_torneo_idparticipante, detalle_torneo_idcate_kata, detalle_torneo_idcate_kumite, detalle_torneo_idtorneo, estado_detalle, estado_resultado, nro_kata) 
            VALUES ('" . $idparticipante . "', '$idcategoria_kata', '$categoria_kumi', '$idtorneo', 'Participando','Participando', '$kata')";

            if ($con->query($sql2) == TRUE) {
              header('Location: ../listado_inscritos.php?idtorneo=' . $idtorneo);
            } else {
              $con->close();
              echo '<script>alert("Error al agregar detalle del torneo.");
              </script>';
              // window . history . back();
            }
          }
        } else {
          if ($categoria_kumi == 'Participar') {
            $codigo_kumite = strtoupper($_POST['codigo_kumite']);

            $sql2 = "INSERT INTO detalle_torneo (detalle_torneo_idparticipante, detalle_torneo_idcate_kata, detalle_torneo_idcate_kumite, codigo_kumite, detalle_torneo_idtorneo, estado_detalle, estado_resultado) 
            VALUES ('" . $idparticipante . "', '1', '$categoria_kumi', '$codigo_kumite','$idtorneo', 'Participando','Participando')";

            if ($con->query($sql2) == TRUE) {
              header('Location: ../listado_inscritos.php?idtorneo=' . $idtorneo);
            } else {
              $con->close();
              echo '<script>alert("Error al agregar detalle del torneo.");
              window.history.back();</script>';
            }
          } else {
            $sql2 = "INSERT INTO detalle_torneo (detalle_torneo_idparticipante, detalle_torneo_idcate_kata, detalle_torneo_idcate_kumite, detalle_torneo_idtorneo, estado_detalle, estado_resultado) 
            VALUES ('" . $idparticipante . "', '1', '1', '$idtorneo', 'Participando','Participando')";

            if ($con->query($sql2) == TRUE) {
              header('Location: ../listado_inscritos.php?idtorneo=' . $idtorneo);
            } else {
              $con->close();
              echo '<script>alert("Error al agregar detalle del torneo.");
              window.history.back();</script>';
            }
          }
        }
      } else {
        $con->close();
        echo '<script>alert("Error al agregar el participante.");
         window.history.back();</script>';
      }
    } else {
      echo '<script> alert("Ocurrió algún error al subir el fichero. No pudo guardarse."); </script>';
      echo "<script type=\"text/javascript\">history.go(-1);</script>";
    }
  }
}
