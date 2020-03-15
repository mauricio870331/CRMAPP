<?php

session_start();
date_default_timezone_set('America/Bogota');
$now = date('Y-m-d H:i:s');
require_once '../BD.php';
$con = new BD();
$R = $_POST['codigo'];
$tipo = $_POST['tipo'];
$sql2 = "Insert into r_s (R,tipo,"
        . "estado,"
        . "create_at,"
        . "create_by,"
        . "update_at,"
        . "update_by) "
        . "Values('$R','$tipo','Disponible','$now'," . $_SESSION['obj_user'][0]['id'] . ",NULL,NULL)";
//echo $sql2;
if ($con->exec($sql2) > 0) {
    echo json_encode("ok");
} else {
    echo json_encode('error');
}
$con->desconectar();
