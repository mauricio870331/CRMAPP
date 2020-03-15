<?php

session_start();
date_default_timezone_set('America/Bogota');
$now = date('Y-m-d H:i:s');

require_once '../BD.php';
$con = new BD();
$placa = $_POST['placa'];
$id_r = $_POST['id_r'];
$id_afiliado = $_POST['id_afiliado'];


$sql = "SELECT * FROM vehiculos where placa_vehiculo = '$placa'";
$rs = $con->findAll2($sql, true);


$query2 = "select placa_vehiculo from vehiculos_afiliados where placa_vehiculo = '$placa' and estado = 'Activo'";
$rs2 = $con->findAll2($query2, true);

if (count($rs2) == 0) {

    $sqlupdate = "update vehiculos set disponible = 0 where placa_vehiculo  = '$placa'";
    $con->exec($sqlupdate);

    $sql2 = "Insert into vehiculos_afiliados (id_vehiculo, id_r, placa_vehiculo,"
            . "estado, marca, cooperativa,  linea, fecha_ini_activo, fecha_fin_activo, id_afiliado,"
            . "create_at,create_by) "
            . "values (" . $rs[0]->id_vehiculo . ","
            . "" . $id_r . ","
            . "'" . $rs[0]->placa_vehiculo . "',"
            . "'Activo',"
            . "'" . $rs[0]->marca . "',"
            . "'" . $rs[0]->cooperativa . "',"
            . "'" . $rs[0]->linea . "',"
            . "NOW(),"
            . "NULL,"
            . "$id_afiliado,"
            . "NOW(),  " . $_SESSION['obj_user'][0]['id'] . ")";
    if ($con->exec($sql2) > 0) {
        echo json_encode("ok");
    } else {
        echo json_encode('error');
    }
} else {
    $sqlupdate = "update vehiculos set disponible = 0 where placa_vehiculo  = '$placa'";
    $con->exec($sqlupdate);
    echo json_encode("ok");
}
$con->desconectar();
