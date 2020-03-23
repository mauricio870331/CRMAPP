<?php

session_start();
require_once '../BD.php';
$con = new BD();
$id = $_POST['id'];
$opcion = $_POST['opcion'];
$SQL_INSERT = "INSERT INTO estados_personas (id_estado,id_persona, fecha_registro, update_by) "
        . "values ((select id_estado from estados where estado = '" . $opcion . "')," . $id . ",NOW()," .  $_SESSION['obj_user'][0]['id']  . ") ";

if ($con->exec($SQL_INSERT) > 0) {
    echo json_encode("ok");
} else {
    echo json_encode('error');
}
$con->desconectar();
