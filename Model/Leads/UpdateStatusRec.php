<?php

session_start();

require '../BD.php';
$con = new BD();
try {

    $updateBy = $_SESSION['obj_user'][0]['id'];
    $pending_to = "pending_to = NULL,";
    $complete_to = "complete_to = NULL";
    $estado = $_POST['estado'];
    $queryRec = "select _to, pending_to, complete_to from recordatorios where id_recordatorio = " . $_POST['id'];
    $rs = $con->findAll2($queryRec);

    if ($rs[0]["_to"] == 0) {
        $estado = "Completado_to";
        $pending = explode(",", substr($rs[0]["pending_to"], 0, strlen($rs[0]["pending_to"]) - 1));
        if (count($pending) == 1) {
            $estado = "Completado";
            $pending_to = "pending_to = NULL,";
        } else {
            $lementToDelete = array_search($updateBy, $pending);
            unset($pending[$lementToDelete]);
            $pending[] = "";
            $pending_to = "pending_to = '" . implode(",", $pending) . "',";
        }

        $complete = explode(",", substr($rs[0]["complete_to"], 0, strlen($rs[0]["complete_to"]) - 1));
        if ($complete[0] == "") {
            $complete[0] = $updateBy;
        } else {
            $complete[] = $updateBy;
        }
        $complete[] = "";
        $complete_to = "complete_to = '" . implode(",", $complete) . "' ";
    }

    $response = array();
    $SQL_INSERT = "UPDATE recordatorios set estado = '" . $estado . "', "
            . "actualizado_por = " . $updateBy . ", fecha_actualizado = NOW(),"
            . $pending_to . " "
            . $complete_to . " "
            . " WHERE id_recordatorio = " . $_POST['id'];

//    echo $SQL_INSERT;die;
    
    if ($con->exec($SQL_INSERT) > 0) {
        $response['datalle'] = "Recordatorio Actualizado";
        $response['msg'] = "ok";
        echo json_encode($response);
    } else {
        $response['datalle'] = "Error al actualizar";
        $response['msg'] = "error";
        echo json_encode($response);
    }
} catch (Exception $exc) {
    $response['datalle'] = $exc->getTraceAsString();
    $response['msg'] = "error";
    echo json_encode($response);
} finally {
    $con->desconectar();
}

