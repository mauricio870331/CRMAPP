<?php

session_start();

date_default_timezone_set('America/Bogota');
require_once '../BD.php';
require '../Utils.php';
$con = new BD();
$R = $_POST['R'];
$Nom_Doc = utf8_encode($_POST['Nom_Doc']);
$fechInic = $_POST['fechInic'];
$fechFin = $_POST['fechFin'];


$sql2 = "Insert into documentos (nom_documento,estado_documento,incio_vigencia,fin_vigencia,id_vehiculo) "
        . "Values('$Nom_Doc','Activo','" . Utils::DMY_TO_YMD($fechInic) . "','" . Utils::DMY_TO_YMD($fechFin) . "',$R)";
if ($con->exec($sql2) > 0) {
    $sql2 = "update documentos set estado_documento = 'Inactivo' "
            . "where id_vehiculo = $R and nom_documento = '$Nom_Doc' and id_documento < (Select MAX(id_documento) from documentos where id_vehiculo = $R)";
    
    $con->exec($sql2);
    echo json_encode("ok");
} else {
    echo json_encode('error');
}
$con->desconectar();
