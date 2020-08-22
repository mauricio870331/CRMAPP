<?php

session_start();
date_default_timezone_set('America/Bogota');
$now = date('Y-m-d H:i:s');
require_once '../BD.php';
$con = new BD();
//$ruta = "../archivos";
$coach = ($_POST['coach'] == "") ? 'NULL' : $_POST['coach'];
$newFoto = "";
if (isset($_FILES['foto']) && !empty($_FILES['foto'])) {
    $archivo = $_FILES['foto']['tmp_name'];
    $nombre_archivo = $_FILES['foto']['name'];
    $tamanio = $_FILES["foto"]["size"];
    $ext = pathinfo($nombre_archivo);
    $extension = $ext['extension'];
//$subir = move_uploaded_file($archivo, $ruta . "/" . $nombre);
    $fp = fopen($archivo, 'rb');
    $contenido = fread($fp, $tamanio);
    $temp = addslashes($contenido);
//    $data = fread($fp, filesize($ruta . "/" . $nombre . "." . $ext['extension']));
    fclose($fp);
    $foto = $temp;
    $newFoto = ", foto = '" . $foto . "',ext='" . $extension . "' ";
}

$SQL_UPDATE = "UPDATE usuarios set tipo_doc = " . $_POST['tipo_doc'] . " ,documento = '" . $_POST['documento'] . "',"
        . "nombres = '" . $_POST['nombres'] . "',apellidos = '" . $_POST['apellidos'] . "',telefono = '" . $_POST['telefonos'] . "'"
        . ",id_tipo_usuario = " . $_POST['id_tipo_usuario'] . ",coach = " . $coach . ",password = '" . $_POST['pass'] . "'" . $newFoto . " where id = " . $_POST['id'];

//echo $SQL_UPDATE;die;

$res = $con->exec($SQL_UPDATE);


if ($res > 0) {
    echo json_encode("ok");
} else {
    echo json_encode($res);
}
$con->desconectar();
