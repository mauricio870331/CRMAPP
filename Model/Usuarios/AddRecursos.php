<?php

session_start();
require '../BD.php';
$con = new BD();
try {

    $descripcion = $_POST['descripcion'];  

    $foto = null;
    $extension = null;
    if (isset($_FILES['exampleInputFile']) && !empty($_FILES['exampleInputFile'])) {
        $archivo = $_FILES['exampleInputFile']['tmp_name'];
        $nombre_archivo = $_FILES['exampleInputFile']['name'];
        $tamanio = $_FILES["exampleInputFile"]["size"];
        $ext = pathinfo($nombre_archivo);
        $extension = $ext['extension'];
        $ruta = "../../RecursosVentas";
        $relativaRuta = "../RecursosVentas";       
        $subir = move_uploaded_file($archivo, $ruta . "/" . $descripcion . "." . $extension);
    }
    $SQL_INSERT = "INSERT INTO recursos (descripcion,ruta, ext, fecha_registro, nombre_archivo) "
            . "VALUES ('" . $descripcion . "','" . $relativaRuta . "/','" . $extension . "'"
            . ", NOW(), '" . $descripcion . "." . $extension . "')";

    if ($con->exec($SQL_INSERT) > 0) {
        echo json_encode("ok");
    } else {
        echo json_encode('error');
    }
} catch (Exception $exc) {
    echo $exc->getTraceAsString();
}
$con->desconectar();
