<?php

session_start();
require '../Utils.php';
require_once '../BD.php';
$con = new BD();
$sqlTotalByMes = "Select DATE_FORMAT(fecha_pago, '%m') mes,sum(total) total from  pagos where  DATE_FORMAT(fecha_pago, '%Y') = '" . date('Y') . "' "
        . "group by DATE_FORMAT(fecha_pago, '%m')";
$rsTotalByMes = $con->findAll2($sqlTotalByMes);

$meses = array();
for ($i = 0; $i < count($rsTotalByMes); $i++) {
    $meses[Utils::ConvertMontIntToStr($rsTotalByMes[$i]['mes'])] = $rsTotalByMes[$i]['total'];
}
$con->desconectar();

echo json_encode($meses);
