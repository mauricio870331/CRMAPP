<?php

session_start();
date_default_timezone_set('America/Bogota');
$now = date('Y-m-d H:i:s');
require_once '../BD.php';
$con = new BD();
$coach = ($_POST['coach'] == "") ? 'NULL' : $_POST['coach'];
$foto = null;
$extension = null;
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
}
//$sql2 = "Insert into usuarios (documento, nombres, apellidos, nombre_completo, pwd, foto, create_by, ext) "
//        . "values ('" . trim($documento) . "','" . trim($nombres) . "'"
//        . ", '" . trim($apellidos) . "', '" . $nombres . " " . $apellidos . "','" . $pwd . "','" . $foto . "'," . $_SESSION['obj_user'][0]['id'] . ", '" . $extension . "')";

$SQL_INSERT = "INSERT INTO usuarios (tipo_doc,documento,nombres,apellidos,telefono,id_tipo_usuario,coach,password) "
        . "VALUES (" . $_POST['tipo_doc'] . ",'" . $_POST['documento'] . "','" . $_POST['nombres'] . "','" . $_POST['apellidos'] . "',"
        . "'" . $_POST['telefonos'] . "','" . $_POST['id_tipo_usuario'] . "'," . $coach . ", '" . $_POST['pass'] . "')";

if ($con->exec($SQL_INSERT) > 0) {
    echo json_encode("ok");
} else {
    echo json_encode('error');
}
$con->desconectar();
