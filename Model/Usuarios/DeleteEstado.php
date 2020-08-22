<?php

require '../BD.php';
$con = new BD();
$id = $_POST['id'];
$response = array();
try {
    $sql2 = "delete from estado where id = " . $id;

    if ($con->exec($sql2) > 0) {

        $sql2 = "delete from ciudad where id_estado = " . $id;
        $con->exec($sql2);
        echo json_encode("ok");
    } else {
        echo json_encode('error');
    }
} catch (Exception $exc) {
    echo $exc->getTraceAsString();
} finally {
    $con->desconectar();
}





