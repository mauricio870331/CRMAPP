<?php

session_start();

require_once '../BD.php';
$con = new BD();
$id_user = (isset($_GET['id']) && !empty($_GET['id'])) ? $_GET['id'] : $_SESSION['obj_user'][0]['id'];
$rs = $con->findAll2("SELECT foto, ext FROM usuarios WHERE id = " . $id_user . "");
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
    $img = "../../dist/img/Usr_1.png";
    $dat = file_get_contents($img);
    echo $dat;
}
?>
