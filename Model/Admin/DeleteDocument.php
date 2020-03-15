<?php

require_once '../BD.php';
$con = new BD();
$idDocumento = $_POST['id'];
try {
    $sql2 = "delete from documentos where id_documento = $idDocumento";
    $con->exec($sql2);
    echo json_encode("ok");
} catch (Exception $ex) {
    echo json_encode('error ' . $ex);
}


$con->desconectar();
