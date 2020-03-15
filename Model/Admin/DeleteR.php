<?php
require_once '../BD.php';
$con = new BD();
$id = $_POST['id'];
$flag = 0;
$sqlUpdateVehiculo = "update vehiculos set id_r = NULL where id_r = $id AND estado = 'Activo'";
$flag = $con->exec($sqlUpdateVehiculo);

$sqlUpdateVehiculo_af = "update vehiculos_afiliados set id_r = NULL where id_r = $id AND estado = 'Activo'";
$flag = $con->exec($sqlUpdateVehiculo_af);

$sql2 = "delete from r_s where id_r = $id";
$flag = $con->exec($sql2);

if ($flag > 0) {
    echo json_encode("ok");
} else {
    echo json_encode('error');
}
$con->desconectar();