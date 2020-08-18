<?php

session_start();
require '../BD.php';
$con = new BD();

try {
    $from = $_SESSION['obj_user'][0]['id'];
    $cuenta = $_POST['cuenta'];
    $num_cuenta = $_POST['num_cuenta'];
    $ss_persona = $_POST['ss'];
    $razon = $_POST['razon'];
    $observacion = $_POST['observacion'];

    $SQL_INSERT = "INSERT INTO  disputas (cuenta, num_cuenta,razon, observacion, fecha_creacion, creado_por,"
            . "ss_persona, item) "
            . "VALUES ('" . $cuenta . "','" . $num_cuenta . "','" . $razon . "','" . $observacion . "', NOW(),"
            . $_SESSION['obj_user'][0]['id'] . ", '" . $_POST['ss'] . "', (select count(d.id_disputa)+1 from disputas d where d.ss_persona = '".$_POST['ss']."'))";

    if ($con->exec($SQL_INSERT) > 0) {
        echo json_encode($ss_persona);
    } else {
        echo json_encode('error');
    }
} catch (Exception $exc) {
    echo $exc->getTraceAsString();
} finally {
    $con->desconectar();
}

