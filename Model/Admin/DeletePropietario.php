<?php

require_once '../BD.php';
$con = new BD();
$id = explode(",",base64_decode($_POST['id']));
try {
    $sql2 = "delete from porpietarios_vehiculos where id_vehiculo = $id[0] "
            . "and placa_vehiculo = '$id[1]' and documento = '$id[2]'";
    $con->exec($sql2);
    echo json_encode("ok");
} catch (Exception $ex) {
    echo json_encode('error ' . $ex);
}


$con->desconectar();
