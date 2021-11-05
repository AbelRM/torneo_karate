<?php

include 'conexion.php';

$idtorneo = 2;

$consulta = "SELECT * FROM detalle_torneo INNER JOIN participante ON detalle_torneo.detalle_torneo_idparticipante = participante.idparticipante
WHERE detalle_torneo_idtorneo = '$idtorneo'";
$query = mysqli_query ($con, $consulta);
while($rw = mysqli_fetch_array($query)){
    $club_idclub = $rw['club_idclub'];
    $iddetalle_torneo = $rw['iddetalle_torneo'];
    $todo[] = $iddetalle_torneo;
}
print_r($todo);


