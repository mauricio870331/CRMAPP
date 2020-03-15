<?php

require_once '../BD.php';
$con = new BD();
$id = $_POST['id'];
try {
    $sql2 = "Delete from datos_afiliado where id_afiliado  = '$id'";
    $con->exec($sql2);
    $sql2 = "Delete from vehiculos_afiliados where id_afiliado  = '$id' ";
    $con->exec($sql2);
    $sql = "Delete from afiliados where documento in (select documento where id_afiliado = '$id')";
    $con->exec($sql);
    echo json_encode("ok");
} catch (Exception $ex) {
    echo json_encode('error');
}
$con->desconectar();
