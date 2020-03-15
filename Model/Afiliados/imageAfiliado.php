<?php

session_start();
require_once '../BD.php';
$con = new BD();
$id_user = $_GET['id'];
$rs = $con->findAll2("SELECT foto, ext FROM afiliados WHERE id_afiliado = " . $id_user . "");
$foto = $rs[0]['foto'];
if ($rs[0]['ext'] == '') {
    $ext = 'jpg';
} else {
    $ext = $rs[0]['ext'];
}
header("Content-type: image/" . $ext);
if ($ext != '' && $foto != "") {
    echo $foto;
} else {
    $img = "../../dist/img/default.png";
    $dat = file_get_contents($img);
    echo $dat;
}
?>
