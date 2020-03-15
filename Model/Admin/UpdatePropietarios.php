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
$paartsid_vehiculo = explode(",",$_POST['id_vehiculo']);


$sql2 = "Update porpietarios_vehiculos set id_vehiculo = $paartsid_vehiculo[0],"
        . "placa_vehiculo = '$paartsid_vehiculo[1]',"
        . "documento = '$documento',"
        . "nom_prop = '$nompro',"
        . "responsable = '$nomresp',"
        . "tel_pro='$telpro',tel_resp = '$telres', update_at = NOW() "
        . "where id_vehiculo = $paartsid_vehiculo[0] and placa_vehiculo = '$paartsid_vehiculo[1]' "
        . "and documento = '$paartsid_vehiculo[2]'";

//echo $sql2;

if ($con->exec($sql2) > 0) {
    echo json_encode("ok");
} else {
    echo json_encode('error');
}
$con->desconectar();
