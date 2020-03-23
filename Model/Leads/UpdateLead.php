<?php

session_start();
date_default_timezone_set('America/Bogota');
require_once '../BD.php';
$con = new BD();
try {

    $dob = "NULL";

    if ($_POST['dob'] != "") {
        $dob = $_POST['dob'];
    }

    $SQL_UPDATE = "UPDATE personas set nombres = '" . $_POST['nombres'] . "',"
            . "apellidos = '" . $_POST['apellidos'] . "',telefonos = '" . $_POST['telefonos'] . "',"
            . "direccion = '" . $_POST['direccion'] . "', ss='" . $_POST['ss'] . "',"
            . "email = '" . $_POST['email'] . "',asesor = " . $_SESSION['obj_user'][0]["id"] . ","
            . "cita = '" . $_POST['cita'] . "',hora_cita = '" . $_POST['hora_cita'] . "',"
            . "id_ciudad = " . $_POST['id_ciudad'] . ",id_estado = " . $_POST['id_estado'] . ","
            . "fecha_cracion = NOW(),dob = '" . $dob . "'";
    
//    echo $SQL_UPDATE;

    $rows = $con->exec($SQL_UPDATE);

    if ($rows > 0) {
        echo json_encode("ok");
    } else {
        echo json_encode('error');
    }
} catch (Exception $exc) {
    echo json_encode($exc->getTraceAsString());
}
$con->desconectar();


