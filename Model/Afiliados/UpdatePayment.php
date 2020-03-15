<?php

session_start();
date_default_timezone_set('America/Bogota');
$now = date('Y-m-d H:i:s');
require_once '../BD.php';
$con = new BD();
$concepto = $_POST['concepto'];
$valor = $_POST['valor'];
$descuento = $_POST['descuento'];
$id_pago = $_POST['id_pago'];
$valdescuento = 0;
if ($descuento != "") {
    $valdescuento = ($valor * $descuento) / 100;
}

try {
    $sql2 = "update pagos  set concepto='" . $concepto . "', valor=" . $valor . ", descuento=" . $valdescuento . ","
            . " total= " . ($valor - $valdescuento) . " where id_pago = " . $id_pago;
    $con->exec($sql2);
    $selectDiapago = " select diadepago, id_afiliado from datos_afiliado where id_afiliado = (select id_afiliado from pagos where id_pago = " . $id_pago . ")";
    $rsD = $con->findAll2($selectDiapago);
    $sql = "update datos_afiliado set estado_vinculo = 'Activo',"
            . "fecha_proximo_pago = '".Utils::SUM_ONE_MONTH_TO_DATE("1", $rsD[0]['diadepago'])."'"
            . " where id_afiliado = (select id_afiliado from pagos where id_pago = " . $rsD[0]['id_afiliado'] . ")";
    $con->exec($sql);
    echo json_encode("ok");
} catch (Exception $exc) {
    echo json_encode('error' . " " . $exc->getMessage());
}
$con->desconectar();
