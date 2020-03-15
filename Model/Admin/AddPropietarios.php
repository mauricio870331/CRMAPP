<?php

session_start();

date_default_timezone_set('America/Bogota');
require_once '../BD.php';
$con = new BD();
$documento = $_POST['documento'];
$nompro = $_POST['nompro'];
$nomresp = $_POST['nomresp'];
$telpro = $_POST['telpro'];
$telres = $_POST['telres'];
$id_vehiculo = $_POST['id_vehiculo'];


$sql2 = "Insert into porpietarios_vehiculos (id_vehiculo,placa_vehiculo,documento,nom_prop,responsable,tel_pro,tel_resp, update_at) "
        . "Values($id_vehiculo,(select placa_vehiculo from vehiculos where id_vehiculo = $id_vehiculo),"
        . "'$documento','$nompro','$nomresp', '$telpro','$telres', NOW())";

if ($con->exec($sql2) > 0) {
    echo json_encode("ok");
} else {
    echo json_encode('error');
}
$con->desconectar();
