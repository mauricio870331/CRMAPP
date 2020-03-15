<?php

require_once '../BD.php';
$con = new BD();
$id = $_POST['id'];
$R = $_POST['R'];
$estado = "Activo";
$disponible = 1;
if ($_POST['estado'] == 'Activo') {
    $estado = "Inactivo";
    $disponible = 0;
}

try {
    $sql2 = "Update vehiculos set estado = '$estado', id_r = NULL,"
            . " disponible = $disponible where id_vehiculo = " . $id . "";
    $con->exec($sql2);
    
    $sql2 = "Update vehiculos_afiliados set estado = '$estado', id_r = NULL where id_vehiculo = " . $id . " and estado = 'Activo'";
    $con->exec($sql2);

    $sql2 = "Update r_s set estado = 'Disponible' where id_r = " . $R . "";
    $con->exec($sql2);
    echo json_encode("ok");
} catch (Exception $ex) {
    echo json_encode('error ' . $ex);
}


$con->desconectar();
