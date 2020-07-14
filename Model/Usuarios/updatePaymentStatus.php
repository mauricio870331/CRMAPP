<?php

session_start();
date_default_timezone_set('America/Bogota');
require_once '../BD.php';
$con = new BD();
$response = array();
$now = date('Y-m-d H:i:s');
try {
    $SQL_UPDATE = "UPDATE pagos_producto set id_estado_pago = " . $_POST['id_estado_pago'] . ""
            . ", valor_cuota = ". $_POST['cuota'].""
            . ", fecha_pago = '". $_POST['fpago']."'"
            . ", actualizado_por = " . $_SESSION['obj_user'][0]["id"] . ""
            . ", fecha_actualizado = '".$now."' where id_pago = " . $_POST['id_pago'];
    $res = $con->exec($SQL_UPDATE);    
    $response['detail'] = $res;
    $response['token'] = $_POST['token'];
    $response['msg'] = "success";
    echo json_encode($response);
} catch (Exception $ex) {
    $response['detail'] = $e->getMessage();
    $response['msg'] = "error";
    echo json_encode($response);
} finally {
    $con->desconectar();
}






