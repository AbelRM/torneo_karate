<?php

include "../conexion.php";

if (isset($_POST['actualizar_participante'])) {
  $nom_competidor = $_POST['nom_competidor'];
  $ape_competidor = $_POST['ape_competidor'];
  $fech_nacimiento = $_POST['fech_nacimiento'];
  $dni = $_POST['dni'];
  $grado = $_POST['grado'];
  $sexo = $_POST['sexo'];
  $peso = $_POST['peso'];

  $idparticipante = $_POST['idparticipante'];
  $iddetalle = $_POST['iddetalle'];
  $idtorneo = $_POST['idtorneo'];

  $categoria_kata = $_POST['categoria_kata'];
  $categoria_kumi = $_POST['categoria_kumi'];


  if (!empty($_FILES['foto_update']['name'])) {

    //crear carpeta
    $micarpeta = '../fotos/' . $dni . '/';
    if (!file_exists($micarpeta)) {
      mkdir($micarpeta, 0777, true);
    }
    //datos del arhivo
    $nombre_archivo = $_FILES['foto_update']['name'];
    $tipo_archivo = $_FILES['foto_update']['type'];
    $tamano_archivo = $_FILES['foto_update']['size'];

    $new_nombre = "foto1.jpg";

    if (!(strpos($tipo_archivo, "jpeg") && ($tamano_archivo <= 5000000))) {
      echo '<script> alert("El archivo supera los 5MB máximos, o no es un tipo imagen."); </script>';
      // echo "<script type=\"text/javascript\">history.go(-1);</script>";
    } else {
      if (move_uploaded_file($_FILES['foto_update']['tmp_name'], $micarpeta . $new_nombre)) {
        $sql = "UPDATE participante SET nombres = '" . $nom_competidor . "', apellidos = '" . $ape_competidor . "', fech_nacimiento = '$fech_nacimiento', dni = '$dni', estado_parti = 'Participando', sexo = '" . $sexo . "', grado = '" . $grado . "', peso = '" . $peso . "', foto = '$new_nombre' where idparticipante = '$idparticipante'";

        if ($con->query($sql) == TRUE) {

          if ($categoria_kata != '1') {
            $kata = $_POST['kata'];

            if ($categoria_kumi == 'Participar') {
              $codigo_kumite = strtoupper($_POST['codigo_kumite']);

              $sql2 = "UPDATE detalle_torneo SET detalle_torneo_idcate_kata = '$categoria_kata', detalle_torneo_idcate_kumite = '$categoria_kumi', codigo_kumite = '$codigo_kumite', nro_kata = '$kata' WHERE iddetalle_torneo = '$iddetalle'";

              if ($con->query($sql2) == TRUE) {
                header('Location: ../listado_inscritos.php?idtorneo=' . $idtorneo);
              } else {
                $con->close();
                echo '<script>alert("Error al agregar detalle del torneo. (001)");
              window.history.back();</script>';
              }
            } else {
              $sql2 = "UPDATE detalle_torneo SET detalle_torneo_idcate_kata = '$categoria_kata', detalle_torneo_idcate_kumite = '$categoria_kumi', nro_kata = '$kata' WHERE iddetalle_torneo = '$iddetalle'";

              if ($con->query($sql2) == TRUE) {
                header('Location: ../listado_inscritos.php?idtorneo=' . $idtorneo);
              } else {
                $con->close();
                echo '<script>alert("Error al agregar detalle del torneo. (002)");
                window.history.back();</script>';
              }
            }
          } else {
            if ($categoria_kumi == 'Participar') {
              $codigo_kumite = strtoupper($_POST['codigo_kumite']);

              $sql2 = "UPDATE detalle_torneo SET detalle_torneo_idcate_kata = '$categoria_kata', detalle_torneo_idcate_kumite = '$categoria_kumi', codigo_kumite = '$codigo_kumite', nro_kata = '$kata' WHERE iddetalle_torneo = '$iddetalle'";

              if ($con->query($sql2) == TRUE) {
                header('Location: ../listado_inscritos.php?idtorneo=' . $idtorneo);
              } else {
                $con->close();
                echo '<script>alert("Error al agregar detalle del torneo. (003)");
              window.history.back();</script>';
              }
            } else {
              $sql2 = "UPDATE detalle_torneo SET detalle_torneo_idcate_kata = '$categoria_kata', detalle_torneo_idcate_kumite = '$categoria_kumi', nro_kata = '$kata' WHERE iddetalle_torneo = '$iddetalle'";

              if ($con->query($sql2) == TRUE) {
                header('Location: ../listado_inscritos.php?idtorneo=' . $idtorneo);
              } else {
                $con->close();
                echo '<script>alert("Error al agregar detalle del torneo. (004)");
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
  } else {
    $sql = "UPDATE participante SET nombres = '$nom_competidor', apellidos = '$ape_competidor', fech_nacimiento = '$fech_nacimiento', dni = '$dni', estado_parti = 'Participando', sexo = '$sexo', grado = '$grado', peso = '$peso' WHERE idparticipante = '$idparticipante'";

    if ($con->query($sql) == TRUE) {

      if ($categoria_kata != '1') {
        $kata = $_POST['kata'];

        if ($categoria_kumi == 'Participar') {
          $codigo_kumite = strtoupper($_POST['codigo_kumite']);

          $sql2 = "UPDATE detalle_torneo SET detalle_torneo_idcate_kata = '$categoria_kata', detalle_torneo_idcate_kumite = '$categoria_kumi', codigo_kumite = '$codigo_kumite', nro_kata = '$kata' WHERE iddetalle_torneo = '$iddetalle'";

          if ($con->query($sql2) == TRUE) {
            header('Location: ../listado_inscritos.php?idtorneo=' . $idtorneo);
          } else {
            $con->close();
            echo '<script>alert("Error al agregar detalle del torneo. (005)");
            window.history.back();</script>';
          }
        } else {
          $sql2 = "UPDATE detalle_torneo SET detalle_torneo_idcate_kata = '$categoria_kata', detalle_torneo_idcate_kumite = '$categoria_kumi', nro_kata = '$kata' WHERE iddetalle_torneo = '$iddetalle'";

          if ($con->query($sql2) == TRUE) {
            header('Location: ../listado_inscritos.php?idtorneo=' . $idtorneo);
          } else {
            $con->close();
            echo '<script>alert("Error al agregar detalle del torneo. (006)");
            window.history.back();</script>';
          }
        }
      } else {
        if ($categoria_kumi == 'Participar') {
          $codigo_kumite = strtoupper($_POST['codigo_kumite']);

          $sql2 = "UPDATE detalle_torneo SET detalle_torneo_idcate_kata = '$categoria_kata', detalle_torneo_idcate_kumite = '$categoria_kumi', codigo_kumite = '$codigo_kumite', nro_kata = '$kata' WHERE iddetalle_torneo = '$iddetalle'";

          if ($con->query($sql2) == TRUE) {
            header('Location: ../listado_inscritos.php?idtorneo=' . $idtorneo);
          } else {
            $con->close();
            echo '<script>alert("Error al agregar detalle del torneo. (007)");
            window.history.back();</script>';
          }
        } else {
          $sql2 = "UPDATE detalle_torneo SET detalle_torneo_idcate_kata = '$categoria_kata', detalle_torneo_idcate_kumite = '$categoria_kumi', nro_kata = '$kata' WHERE iddetalle_torneo = '$iddetalle'";

          if ($con->query($sql2) == TRUE) {
            header('Location: ../listado_inscritos.php?idtorneo=' . $idtorneo);
          } else {
            $con->close();
            echo '<script>alert("Error al agregar detalle del torneo. (008)");
            window.history.back();</script>';
          }
        }
      }
    } else {
      $con->close();
      echo '<script>alert("Error al agregar el participante.");
         window.history.back();</script>';
    }
  }
}
