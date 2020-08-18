<?php

require '../BD.php';
$con = new BD();
$id = $_POST['id'];
$response = array();


$folder = "Documentos";
$table_name = "documentos";
$field = "id_documento";
if ($_POST['opcion'] == "adjunto") {
    $folder = "Adjuntos";
    $table_name = "adjuntos";
    $field = "id_adjunto";
}

$SQL_SELECT = "SELECT * FROM " . $table_name . " WHERE " . $field . " = " . $id;
$rs = $con->findAll2($SQL_SELECT);

$ruta = "../../" . $folder . "/" . $rs[0]["ss_persona"] . "/" . $rs[0]["nombre_archivo"];


if (file_exists($ruta)) {
    unlink($ruta);
    $sql2 = "delete from " . $table_name . " where " . $field . " = " . $id;
    try {
        $con->exec($sql2);
        $response['datalle'] = "Documento eliminado";
        $response['option'] = $_POST['opcion'];
        $response['msg'] = "ok";
        echo json_encode($response);
    } catch (Exception $exc) {
        $response['datalle'] = $exc->getTraceAsString();
        $response['msg'] = "error";
        echo json_encode($response);
    }
} else {
    $sql2 = "delete from " . $table_name . " where " . $field . " = " . $id;
    $con->exec($sql2);
    $response['datalle'] = "El documento no existe..!";
    $response['option'] = $_POST['opcion'];
    $response['msg'] = "ok";
    echo json_encode($response);
}
$con->desconectar();
