<?php

session_start();
date_default_timezone_set('America/Bogota');
require_once '../BD.php';
$con = new BD();
try {
    $dob = "NULL";
    if ($_POST['dob'] != "") {
        $dob = $_POST['dob'];    }

    $SQL_INSERT = "INSERT INTO personas (nombres,apellidos,telefonos,direccion,ss,email,asesor,cita,hora_cita,id_ciudad,id_estado,fecha_cracion,dob) "
            . "VALUES ('" . $_POST['nombres'] . "','" . $_POST['apellidos'] . "','" . $_POST['telefonos'] . "','" . $_POST['direccion'] . "',"
            . "'" . $_POST['ss'] . "','" . $_POST['email'] . "'," . $_SESSION['obj_user'][0]["id"] . ",'" . $_POST['cita'] . "','" . $_POST['hora_cita'] . "'"
            . "," . $_POST['id_ciudad'] . "," . $_POST['id_estado'] . ", NOW(), '" . $dob . "')";

    $rows = $con->exec($SQL_INSERT);
//Insert Situacion:
    $SQL_INSERT_S = "INSERT INTO situacion_personas (id_situacion,id_persona,fecha_registro) "
            . "VALUES (1,(select id from personas where ss = '" . $_POST['ss'] . "'),NOW())";
    $rows = $con->exec($SQL_INSERT_S);
//Insert Estados:
    $SQL_INSERT_E = "INSERT INTO estados_personas (id_estado,id_persona,fecha_registro) "
            . "VALUES (1,(select id from personas where ss = '" . $_POST['ss'] . "'),NOW())";
    $rows = $con->exec($SQL_INSERT_E);

    if ($rows > 0) {
        echo json_encode("ok");
    } else {
        echo json_encode('error');
    }
} catch (Exception $exc) {
    echo json_encode($exc->getTraceAsString());
}
$con->desconectar();


