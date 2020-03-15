<?php
require_once '../BD.php';
$con = new BD();
$id = $_POST['id'];
$sql2 = "delete from usuarios where id = " . $id;
if ($con->exec($sql2) > 0) {
    echo json_encode("ok");
} else {
    echo json_encode('error');
}
$con->desconectar();
