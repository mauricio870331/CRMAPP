<?php

session_start();
date_default_timezone_set('America/Bogota');
$now = date('Y-m-d H:i:s');
require_once '../BD.php';
$con = new BD();
$id_r = $_POST['id'];
$codigo = $_POST['R'];
$estado = $_POST['estado'];
$tipo = $_POST['tipo'];
$flag = 0;
if ($estado == "Disponible") {
    $sqlUpdateVehiculo = "update vehiculos set id_r = NULL where id_r = $id_r and estado = 'Activo'";
    $flag = $con->exec($sqlUpdateVehiculo);

    $sqlUpdateVehiculo_af = "update vehiculos_afiliados set id_r = NULL where id_r = $id_r and estado = 'Activo'";
    $flag = $con->exec($sqlUpdateVehiculo_af);
}
$sql2 = "update r_s set R = '$codigo', estado = '$estado',tipo = '$tipo', update_at = NOW(), update_by  = " . $_SESSION['obj_user'][0]['id'] . " where id_r = $id_r";
//echo $sql2;
$flag = $con->exec($sql2);

if ($flag > 0) {
    echo json_encode("ok");
} else {
    echo json_encode('error');
}
$con->desconectar();
