<?php

session_start();
date_default_timezone_set('America/Bogota');
$now = date('Y-m-d H:i:s');
require_once '../BD.php';
$con = new BD();
//$ruta = "../archivos";
$documento = $_POST['documento'];
$nombres = $_POST['nombres'];
$apellidos = $_POST['apellidos'];
$pwd = $_POST['pwd'];
$id = $_POST['id'];
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
$sql2 = "update usuarios set documento = '" . trim($documento) . "', nombres = '" . trim($nombres) . "', apellidos = '" . trim($apellidos) . "', nombre_completo = '" . $nombres . " " . $apellidos . "',"
        . " pwd = '" . $pwd . "', updated_at = '$now', create_by = " . $_SESSION['obj_user'][0]['id'] . $newFoto . " where id = " . $id;

$res = $con->exec($sql2);
if ($res > 0) {
    echo json_encode("ok");
} else {
    echo json_encode($res);
}
$con->desconectar();
