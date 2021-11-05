<?php

include 'conexion.php';

$idtorneo = $_POST['idtorneo'];
$ronda = 1;
$grupo = 1;
$sub_grupo = 1;
$idkata = 2;

while($idkata == $idkata){
    $con_canti = "SELECT COUNT(*) FROM detalle_torneo WHERE detalle_torneo_idcate_kata = '$idkata' AND detalle_torneo_idtorneo = '$idtorneo'";
    $nro_parti = mysqli_query ($con, $con_canti);
    
    $sub_grupo = 1;
    
    if($nro_parti < 4){
        $consulta = "SELECT * FROM detalle_torneo
        WHERE detalle_torneo_idtorneo = '$idtorneo' AND detalle_torneo_idcate_kata = '$idkata'";
        $query = mysqli_query ($con, $consulta);
        while($rw = mysqli_fetch_array($query)){
            $iddetalle_torneo = $rw['iddetalle_torneo'];
            $insert = "INSERT INTO generar_torneo (generar_torneo_iddetalletor, ronda, grupo, sub_grupos) 
            VALUES ('$iddetalle_torneo', '$ronda', '$grupo', '$sub_grupo')";
            $result = mysqli_query($con, $insert);
        }
        
        
    } elseif($nro_parti > 3){
        $nro_parti = round($nro_parti / 2);
        
        $consulta2 = "SELECT * FROM detalle_torneo
        WHERE detalle_torneo_idtorneo = '$idtorneo' AND detalle_torneo_idcate_kata = '$idkata'";
        $query2 = mysqli_query ($con, $consulta2);
        while($rw = mysqli_fetch_array($query2)){
            
        }
        for ($i = 1; $i <= $nro_parti; $i++) {
            $insert = "INSERT INTO generar_torneo (generar_torneo_iddetalletor, ronda, sub_grupos) 
            VALUES ('$iddetalle_torneo', '$ronda', '$grupo', '$sub_grupo')";
            $result = mysqli_query($con, $insert);
        }
    
    }
    
}



