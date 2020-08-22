<?php

session_start();
require '../BD.php';
$con = new BD();
$response = array();

$ciudad = filter_input(INPUT_POST, "ciudad");
$token = isset(filter_input(INPUT_POST, "token")) ? filter_input(INPUT_POST, "token") : "";

if (filter_input(INPUT_POST, "accion") == "add") {
    $action = "INSERT";
    $SQL = "INSERT INTO ciudad (ciudad, id_estado) VALUES ('" . $ciudad . "', " . $_POST['id_estado'] . ")";
} else {
    $action = "UPDATE";
    $SQL = "update ciudad set ciudad = '" . $ciudad . "' where id = " . $_POST['id_ciudad'];
}

$rs = $con->exec($SQL, $action);
$rs["token"] = $token;
$rs["view"] = $_POST['view'];
$rs["accion"] = $_POST['accion'];

$SQL_LOG = "INSERT INTO  logs_crmapp (code, message_code, msn, code_mysql, row_count, operacion, trace, user_log) "
        . "VALUES (" . $rs['code'] . ", '" . $rs['message_code'] . "',"
        . " '" . $rs['msn'] . "', '" . $rs['code_mysql'] . "', " . $rs['row_count'] . ", "
        . "'" . $rs['operacion'] . "', '" . $rs['trace'] . "', " . $_SESSION['obj_user'][0]['id'] . ")";
$rslog = $con->exec($SQL_LOG);

$con->desconectar();

echo json_encode($rs);


