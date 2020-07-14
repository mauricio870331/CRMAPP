<?php

session_start();

require '../BD.php';
$con = new BD();
try {

    $response = array();
    $SQL_INSERT = "UPDATE recordatorios set estado = '" . $_POST['estado'] . "', "
            . "actualizado_por = " . $_SESSION['obj_user'][0]['id'] . ", fecha_actualizado = NOW()"
            . " WHERE id_recordatorio = " . $_POST['id'];

    if ($con->exec($SQL_INSERT) > 0) {
        $response['datalle'] = "Recordatorio Actualizado";
        $response['msg'] = "ok";
        echo json_encode($response);
    } else {
        $response['datalle'] = "Error al actualizar";
        $response['msg'] = "error";
        echo json_encode($response);
    }
} catch (Exception $exc) {
    $response['datalle'] = $exc->getTraceAsString();
    $response['msg'] = "error";
    echo json_encode($response);
} finally {
    $con->desconectar();
}

