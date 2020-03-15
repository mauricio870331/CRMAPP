<?php

session_start();
date_default_timezone_set('America/Bogota');
$now = date('Y-m-d H:i:s');
require_once '../BD.php';
require_once '../Utils.php';
$con = new BD();
$concepto = $_POST['concepto'];
$valor = $_POST['valor'];
$descuento = $_POST['descuento'];
$id_afiliado = $_POST['id_afiliado'];
$valdescuento = 0;
if ($descuento != "") {
    $valdescuento = ($valor * $descuento) / 100;}

$sql2 = "Insert into pagos (fecha_pago, concepto, id_afiliado,"
        . " valor, descuento, total) "
        . "values (NOW(),'" . $concepto . "'," . $id_afiliado . "," . $valor . "," . $valdescuento . "," . ($valor - $valdescuento) . ")";
if ($con->exec($sql2) > 0) {//actualizar la fecha proximo pago sumar un mes a la fecha de pago
    $selectDiapago = " select diadepago from datos_afiliado where id_afiliado = " . $id_afiliado;
    $rsD = $con->findAll2($selectDiapago);
    $sql = "update datos_afiliado set estado_vinculo = 'Activo',"
            . " fecha_proximo_pago = '".Utils::SUM_ONE_MONTH_TO_DATE("1", $rsD[0]['diadepago'])."' "
            . "where id_afiliado = " . $id_afiliado;
    $con->exec($sql);
    echo json_encode("ok");
} else {
    echo json_encode('error');
}

$con->desconectar();
