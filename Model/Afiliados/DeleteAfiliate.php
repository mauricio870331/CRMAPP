<?php

require_once '../BD.php';
$con = new BD();
$id = $_POST['id'];
if ($_POST['estado'] == "Activo") {
    $estado = "Inactivo";
} else {
    $estado = "Activo";
}


$queryVehiculosAf = "select  va.id_vehiculo from vehiculos_afiliados va, vehiculos v "
        . "where va.id_vehiculo=v.id_vehiculo and va.id_afiliado = " . $id . " and va.estado = 'Activo'";
$rsv = $con->findAll2($queryVehiculosAf);


if (count($rsv) > 0) {
    for ($i = 0; $i < count($rsv); $i++) {
        $q = "update vehiculos_afiliados set estado='Inactivo', fecha_fin_activo = NOW() "
                . "where id_vehiculo =" . $rsv[$i]['id_vehiculo'];
        $con->exec($q);
        $q2 = "update vehiculos set disponible=1 where id_vehiculo =" . $rsv[$i]['id_vehiculo'];
        $con->exec($q2);
    }
}
$sql2 = "update datos_afiliado set estado_vinculo = '$estado' where id_afiliado = " . $id;

if ($con->exec($sql2) > 0) {
    echo json_encode("ok");
} else {
    echo json_encode('error');
}
$con->desconectar();
