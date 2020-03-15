<?php

session_start();
date_default_timezone_set('America/Bogota');
$now = date('Y-m-d H:i:s');
require_once '../BD.php';
$con = new BD();
$R = $_POST['id_r'];
$Placa = $_POST['Placa'];
$Marca = $_POST['Marca'];
$Cooperativa = $_POST['Cooperativa'];
$Linea = $_POST['Linea'];

$sql2 = "Insert into vehiculos (id_r,placa_vehiculo,estado,marca,cooperativa,linea, create_at, create_by, disponible) "
        . "Values('$R','$Placa','Activo','$Marca','$Cooperativa','$Linea','$now'," . $_SESSION['obj_user'][0]['id'] . ", 1)";
if ($con->exec($sql2) > 0) {
    if ($R != "") {
        $sql = "update r_s set estado = 'En Uso', update_at = '$now', update_by = " . $_SESSION['obj_user'][0]['id'] . "  where id_r = $R";
        $con->exec($sql);
    }
    echo json_encode("ok");
} else {
    echo json_encode('error');
}
$con->desconectar();
