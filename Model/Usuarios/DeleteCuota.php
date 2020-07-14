<?php

session_start();
require_once '../BD.php';
$con = new BD();
$response = array();
try {
    $SQL_UPDATE = "DELETE FROM pagos_producto where id_pago = " . $_POST['id_pago'];
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
