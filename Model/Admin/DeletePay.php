<?php

require_once '../BD.php';
$con = new BD();
$id = $_POST['id'];
try {
    $sql2 = "delete from pagos where id_pago = $id";
    $con->exec($sql2);   
    echo json_encode("ok");
} catch (Exception $ex) {   
    echo json_encode('error '.$ex);
}


$con->desconectar();
