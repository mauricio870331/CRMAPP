<?php

session_start();

date_default_timezone_set('America/Bogota');
require_once '../BD.php';
require '../Utils.php';
$con = new BD();
$now = date('Y-m-d H:i:s');
$id_documento = $_POST['id_documento'];
$Nom_Doc = utf8_encode($_POST['Nom_Doc']);
$fechInic = $_POST['fechInic'];
$fechFin = $_POST['fechFin'];

$sql2 = "Update documentos set nom_documento = '$Nom_Doc',estado_documento = 'Activo',"
        . "incio_vigencia = '" . Utils::DMY_TO_YMD($fechInic) . "',fin_vigencia = '" . Utils::DMY_TO_YMD($fechFin) . "',"
        . "updated_at = '$now',update_by = ".$_SESSION['obj_user'][0]['id']." where id_documento = $id_documento";
if ($con->exec($sql2) > 0) {   
    echo json_encode("ok");
} else {
    echo json_encode('error');
}
$con->desconectar();
