<?php

require '../BD.php';
$con = new BD();
$id = $_POST['id'];

$SQL_SELECT = "SELECT * FROM recursos WHERE id_recurso = " . $id;

$rs = $con->findAll2($SQL_SELECT);

$ruta = "../../RecursosVentas/" . $rs[0]["nombre_archivo"];

if (file_exists($ruta)) {
    unlink($ruta);
    $sql2 = "delete from recursos where id_recurso = " . $id;
    if ($con->exec($sql2) > 0) {
        echo json_encode("ok");
    } else {
        echo json_encode('error');
    }
} else {
    echo json_encode('error');
}
$con->desconectar();
