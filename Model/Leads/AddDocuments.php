<?php

session_start();
require '../BD.php';
$con = new BD();
try {

    $descripcion = $_POST['descripcion'];
    $documento = $_POST['ss'];

    $foto = null;
    $extension = null;
    if (isset($_FILES['exampleInputFile']) && !empty($_FILES['exampleInputFile'])) {
        $archivo = $_FILES['exampleInputFile']['tmp_name'];
        $nombre_archivo = $_FILES['exampleInputFile']['name'];
        $tamanio = $_FILES["exampleInputFile"]["size"];
        $ext = pathinfo($nombre_archivo);
        $extension = $ext['extension'];
        $ruta = "../../view_asesor/Documentos/" . $documento;
        $relativaRuta = "Documentos/" . $documento;
        if (!file_exists($ruta)) {
            mkdir($ruta, 0700);
        }
        $subir = move_uploaded_file($archivo, $ruta . "/" . $descripcion . "." . $extension);
    }

    $SQL_INSERT = "INSERT INTO documentos (descripcion,ruta, ext, ss_persona, fecha_registro, nombre_archivo) "
            . "VALUES ('" . $descripcion . "','" . $relativaRuta . "/','" . $extension . "'"
            . ", '" . $documento . "', NOW(), '" . $descripcion . "." . $extension . "')";
//
//    if (file_exists($ruta)) {
//        unlink($ruta);
//    }

    if ($con->exec($SQL_INSERT) > 0) {
        echo json_encode($documento);
    } else {
        echo json_encode('error');
    }
} catch (Exception $exc) {
    echo $exc->getTraceAsString();
}
$con->desconectar();
