<?php

session_start();
require_once '../BD.php';
$con = new BD();
$id = $_POST['id'];
$opcion = $_POST['opcion'];
$SQL_INSERT = "INSERT INTO situacion_personas (id_situacion,id_persona, fecha_registro) "
        . "values ((select id_situacion from situacion where estado = '" . $opcion . "')," . $id . ",NOW())";

if ($con->exec($SQL_INSERT) > 0) {
    echo json_encode("ok");
} else {
    echo json_encode('error');
}
$con->desconectar();
