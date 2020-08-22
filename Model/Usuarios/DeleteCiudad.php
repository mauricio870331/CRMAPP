<?php

session_start();
require '../BD.php';
$con = new BD();
$id = $_POST['id'];

$sql2 = "delete from ciudad where id = " . $id;

$rs = $con->exec($sql2, "DELETE");
$rs["token"] = $_POST["token"];

$SQL_LOG = "INSERT INTO  logs_crmapp (code, message_code, msn, code_mysql, row_count, operacion, trace, user_log) "
        . "VALUES (" . $rs['code'] . ", '" . $rs['message_code'] . "',"
        . " '" . $rs['msn'] . "', '" . $rs['code_mysql'] . "', " . $rs['row_count'] . ", "
        . "'" . $rs['operacion'] . "', '" . $rs['trace'] . "', " . $_SESSION['obj_user'][0]['id'] . ")";
$rslog = $con->exec($SQL_LOG);

$con->desconectar();

echo json_encode($rs);





