<?php

include '../BD.php';
$con = new BD();
$sql = "SELECT * FROM notificaciones where notify = 0 order by 1 desc limit 1";
$rs = $con->findAll2($sql);
if (count($rs) > 0) {

//    $update = "update notificaciones set notify = 1 where id_notificacion = " . $rs[0]["id_notificacion"];
//    $con->exec($update);

    $array = array(
        "titulo" => $rs[0]["titulo"],
        "detalle" => $rs[0]["detalle"],
        "id" => $rs[0]["id_notificacion"],
        "count" => 1
    );
    echo json_encode($array);
} else {
    $array = array(
        "titulo" => "",
        "detalle" => "",
        "id" => "",
        "count" => 0
    );
    echo json_encode($array);
}
?>

