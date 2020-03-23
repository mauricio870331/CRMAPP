<?php

require '../BD.php';
$con = new BD();
$id = $_POST['id'];

$SQL_SELECT = "SELECT * FROM documentos WHERE id_documento = " . $id;

$rs = $con->findAll2($SQL_SELECT);

$ruta = "../../view_asesor/Documentos/" . $rs[0]["ss_persona"] . "/" . $rs[0]["nombre_archivo"];

if (file_exists($ruta)) {
    unlink($ruta);
    $sql2 = "delete from documentos where id_documento = " . $id;
    if ($con->exec($sql2) > 0) {
        echo json_encode("ok");
    } else {
        echo json_encode('error');
    }
} else {
    echo json_encode('error');
}
$con->desconectar();
