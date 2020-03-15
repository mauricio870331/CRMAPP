<?php

session_start();

require_once '../BD.php';
$con = new BD();
$idVehiculo = $_POST['R'];
$Nom_Doc = $_POST['Nom_Doc'];




$sql2 = "select * from  r_s where R = '$R'";
$rs = $con->findAll2($sql2);
if (count($rs)>0) {
    if ($rs[0]['estado']=="Disponible") {
         echo json_encode("Disponible");
    }else{
        echo json_encode("No esta Disponible");
    }
}else{
    echo json_encode("No Existe");
}
$con->desconectar();
