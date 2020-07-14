<?php

require '../BD.php';
$con = new BD();
$id = $_POST['id'];
$response = array();

$sql2 = "delete from  recordatorios where id_recordatorio = " . $id;
try {
    $con->exec($sql2);
    $response['datalle'] = "Recordatorio Eliminado";
    $response['msg'] = "ok";
    echo json_encode($response);
} catch (Exception $exc) {
    $response['datalle'] = $exc->getTraceAsString();
    $response['msg'] = "error";
    echo json_encode($response);
} finally {
    $con->desconectar();
}


