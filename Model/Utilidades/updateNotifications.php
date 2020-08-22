<?php

include '../BD.php';
$con = new BD();


$update = "update notificaciones set notify = 1 where id_notificacion = " . $_POST["id"];
$rs = $con->exec($update);

if ($rs > 0) {
    echo json_encode("ok");
} else {
    echo json_encode("error");
}
?>

