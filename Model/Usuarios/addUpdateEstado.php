<?php

session_start();
require '../BD.php';
$con = new BD();
$response = array();
try {
    $estado = $_POST['estado'];
    if (isset($_POST['id'])) {
        $id = $_POST['id'];
    }
    if ($_POST['accion'] == "add") {
        $SQL = "INSERT INTO estado (estado) VALUES ('" . $estado . "')";
    } else {
        $SQL = "update estado set estado = '" . $estado . "' where id = " . $id;
    }

    $rs = $con->exec($SQL);



    if ($rs > 0) {
        $response["msn"] = "ok";
        $response["accion"] = $_POST['accion'];
        echo json_encode($response);
    } else {
        $response["msn"] = "error";
        $response["accion"] = $_POST['accion'];
        echo json_encode($response);
    }
} catch (Exception $exc) {
    $response["msn"] = "error";
    $response["detail"] = $exc->getMessage();
    echo json_encode($response);
}
$con->desconectar();
