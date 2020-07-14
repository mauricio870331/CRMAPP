<?php

session_start();
date_default_timezone_set('America/Bogota');

require_once '../BD.php';
$con = new BD();
$response = array();
$now = date('Y-m-d H:i:s');


$SQL_UPDATE = "insert into pagos_producto (numero_cuota, valor_cuota, fecha_pago, id_producto, creado_por, fecha_creacion, id_estado_pago)"
        . " values((select (COALESCE(max(pp.numero_cuota), 0)+1) from pagos_producto pp where pp.id_producto = " . $_POST['id_producto'] . "),"
        . " " . $_POST['valor_c'] . ", '" . $_POST['fecha_pago_c'] . "', " . $_POST['id_producto'] . ","
        . " " . $_SESSION['obj_user'][0]["id"] . ", '" . $now . "', 1)";

$res = $con->exec($SQL_UPDATE);
$pos = strpos($res, "PDOException");
if ($pos === false) {

    /*$SQL_SELECT = "select pp.*, e.codigo from pagos_producto pp
    inner join estados_de_pago e on e.id_estado_pago = pp.id_estado_pago
    where pp.id_pago = (select max(p.id_pago) from pagos_producto p where p.id_producto = " . $_POST['id_producto'] . ")";
    $res = $con->findAll2($SQL_SELECT);
    $response['id_pago'] = $res[0]['id_pago'];
    $response['id_producto'] = $_POST['id_producto'];
    $response['numero_cuota'] = $res[0]['numero_cuota'];
    $response['codigo_pago'] = $res[0]['codigo'];
    $response['valor_c'] = "$ " . number_format($_POST['valor_c'], 0, ",", ".");
    $response['fecha_pago_c'] = $_POST['fecha_pago_c'];*/
    
    $response['detail'] = $res;
    $response['token'] = $_POST['token'];
    $response['msg'] = "success";
} else {
    $response['detail'] = $res->getMessage();
    $response['file'] = $res->getTrace()[1]['file'];
    $response['line'] = $res->getTrace()[1]['line'];
    $response['function'] = $res->getTrace()[1]['function'];
    $response['class'] = $res->getTrace()[1]['class'];
    $response['query'] = $res->getTrace()[1]['args'][0];
    $response['msg'] = "error";
}
$con->desconectar();
echo json_encode($response);

