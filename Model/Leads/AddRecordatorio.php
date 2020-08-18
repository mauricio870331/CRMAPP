<?php

session_start();

require '../BD.php';
$con = new BD();

$from = $_SESSION['obj_user'][0]['id'];
$to = $_SESSION['obj_user'][0]['id'];
if ($_POST["_from"] != "undefined") {
    $from = $_POST["_from"];
}
if ($_POST["_to"] != "undefined") {
    $to = $_POST["_to"];
}

try {
    $descripcion = $_POST['descripcion'];
    $documento = $_POST['ss'];
    $vence = $_POST['vence'];


    if ($_POST['accion'] == "update") {
        $SQL_INSERT = "UPDATE recordatorios set _from = " . $from . ", _to = " . $to . ","
                . "descripcion = '" . $_POST['descripcion'] . "', "
                . "vence = '" . $_POST['vence'] . "', actualizado_por = " . $_SESSION['obj_user'][0]['id'] . ", "
                . "fecha_actualizado = NOW() WHERE 	id_recordatorio = " . $_POST['id_recordatorio'];
    } else {
        $queryTodos = "NULL";
        if ($to == 0) {
            $queryTodos = "(select id from usuarios)";
            $rs = $con->findAll2($queryTodos);
            $allTo = "";
            foreach ($rs as $value) {
                $allTo .= $value["id"] . ",";
            } 
        }
        $SQL_INSERT = "INSERT INTO  recordatorios (_from, _to,descripcion, vence, fecha_creacion, estado, "
                . "creado_por, ss_persona, pending_to) "
                . "VALUES (" . $from . "," . $to . ",'" . $_POST['descripcion'] . "','" . $_POST['vence'] . "', NOW(), 'Pendiente', "
                . $_SESSION['obj_user'][0]['id'] . ", '" . $_POST['ss'] . "', '" . $allTo . "')";     
    }
    if ($con->exec($SQL_INSERT) > 0) {
        echo json_encode($documento);
    } else {
        echo json_encode('error');
    }
} catch (Exception $exc) {
    echo $exc->getTraceAsString();
} finally {
    $con->desconectar();
}

