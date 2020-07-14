<?php

require '../BD.php';
$con = new BD();
$response = array();


$andAssesor = "";
$andCoach = "";
$andCoachAnsAsesor = "";
if (isset($_POST['asesor'])) {
    $andAssesor = " and u.asesor = " . $_POST['asesor'];
}

if (isset($_POST['coach'])) {
    $andCoach = "inner join usuarios user on user.id_tipo_usuario = u.asesor "
            . "and user.coach = " . $_POST['coach'];
}


try {
    $SQL_SELECT_LEAD = "SELECT count(*) total_leads FROM personas u "
            . "inner join situacion_personas sp on sp.id_persona = u.id "
            . "inner join situacion si on si.id_situacion = sp.id_situacion AND si.estado = 'LEAD' "
            . $andCoach . " "
            . "where sp.fecha_registro between '" . $_POST['fini'] . " 00:00:00' and '" . $_POST['ffin'] . " 23:59:59'" . $andAssesor;
    $rsLead = $con->findAll2($SQL_SELECT_LEAD);
    //replicar en la que los necesite

    $SQL_SELECT_CLIENTE = "SELECT count(*) total_clientes FROM personas u "
            . "inner join situacion_personas sp on sp.id_persona = u.id 
                       and sp.fecha_registro = (select MAX(sf.fecha_registro) from situacion_personas sf where sf.id_persona = u.id) "
            . "inner join situacion si on si.id_situacion = sp.id_situacion AND si.estado = 'CLIENTE' "
            . $andCoach . " "
            . "WHERE sp.fecha_registro between '" . $_POST['fini'] . " 00:00:00' and '" . $_POST['ffin'] . " 23:59:59'" . $andAssesor;
    $rsCliente = $con->findAll2($SQL_SELECT_CLIENTE);

    //Tranfer--------------
    $SQL_SUM_TRANFER = "select  COALESCE(sum(pp.valor_cuota), 0) total_tranfer from pagos_producto pp "
            . "inner join estados_de_pago ep on ep.id_estado_pago = pp.id_estado_pago and ep.codigo = 'R0' ";
    $inner = "";
    $Assesor = "";
    if (isset($_POST['coach'])) {
        $inner = "inner join producto p on p.id_producto = pp.id_producto "
                . "inner join personas u on u.ss = p.ss_persona "
                . "inner join usuarios user on user.id_tipo_usuario = u.asesor and user.coach = " . $_POST['coach'];
    }
    $SQL_SUM_TRANFER .= $inner;
    if (isset($_POST['asesor'])) {
        if (strpos($SQL_SUM_TRANFER, "personas") === false) {
            $SQL_SUM_TRANFER .= "inner join producto p on p.id_producto = pp.id_producto "
                    . "inner join personas u on u.ss = p.ss_persona ";
            $Assesor = " and u.asesor = " . $_POST['asesor'];
        } else {
            $Assesor = " and u.asesor = " . $_POST['asesor'];
        }
    }
    $SQL_SUM_TRANFER .= " WHERE pp.fecha_pago_realizado between '" . $_POST['fini'] . " 00:00:00' and '" . $_POST['ffin'] . " 23:59:59'" . $Assesor;
    $rsTanfer = $con->findAll2($SQL_SUM_TRANFER);
    // fin tranfer --------
    // inicio process --------
    $SQL_SUM_PROCCESS = "select  COALESCE(sum(pp.valor_cuota), 0) total_proccess from pagos_producto pp "
            . "inner join estados_de_pago ep on ep.id_estado_pago = pp.id_estado_pago and ep.codigo = 'EN PROCESO'";
    $SQL_SUM_PROCCESS .= $inner;
    if (isset($_POST['asesor'])) {
        if (strpos($SQL_SUM_PROCCESS, "personas") === false) {
            $SQL_SUM_PROCCESS .= "inner join producto p on p.id_producto = pp.id_producto "
                    . "inner join personas u on u.ss = p.ss_persona ";
            $Assesor = " and u.asesor = " . $_POST['asesor'];
        } else {
            $Assesor = " and u.asesor = " . $_POST['asesor'];
        }
    }
    $SQL_SUM_PROCCESS .= " WHERE pp.fecha_pago_realizado between '" . $_POST['fini'] . " 00:00:00' and '" . $_POST['ffin'] . " 23:59:59'" . $Assesor;
    $rsProccess = $con->findAll2($SQL_SUM_PROCCESS);
    // fin process --------
    // inicio aprobe --------
    $SQL_SUM_APROBE = "select  COALESCE(sum(pp.valor_cuota), 0) total_aprobados from pagos_producto pp "
            . "inner join estados_de_pago ep on ep.id_estado_pago = pp.id_estado_pago and ep.codigo = 'APROBADO'";
    $SQL_SUM_APROBE .= $inner;
    if (isset($_POST['asesor'])) {
        if (strpos($SQL_SUM_APROBE, "personas") === false) {
            $SQL_SUM_APROBE .= "inner join producto p on p.id_producto = pp.id_producto "
                    . "inner join personas u on u.ss = p.ss_persona ";
            $Assesor = " and u.asesor = " . $_POST['asesor'];
        } else {
            $Assesor = " and u.asesor = " . $_POST['asesor'];
        }
    }
    $SQL_SUM_APROBE .= " WHERE pp.fecha_pago_realizado between '" . $_POST['fini'] . " 00:00:00' and '" . $_POST['ffin'] . " 23:59:59'" . $Assesor;
    $rsAprobe = $con->findAll2($SQL_SUM_APROBE);
    // fin aprobe --------


    $SQL_SUM_DOWN = "select  COALESCE(sum(pp.valor_cuota), 0) total_caida from pagos_producto pp "
            . "inner join estados_de_pago ep on ep.id_estado_pago = pp.id_estado_pago "
            . "and ep.codigo in ('R1','R2','R3','R4','R7','R8','R9','R10','R15','R16','R20')";
    $SQL_SUM_DOWN .= $inner;
    if (isset($_POST['asesor'])) {
        if (strpos($SQL_SUM_DOWN, "personas") === false) {
            $SQL_SUM_DOWN .= "inner join producto p on p.id_producto = pp.id_producto "
                    . "inner join personas u on u.ss = p.ss_persona ";
            $Assesor = " and u.asesor = " . $_POST['asesor'];
        } else {
            $Assesor = " and u.asesor = " . $_POST['asesor'];
        }
    }
    $SQL_SUM_DOWN .= " WHERE pp.fecha_pago_realizado between '" . $_POST['fini'] . " 00:00:00' and '" . $_POST['ffin'] . " 23:59:59'" . $Assesor;
    $rsDown = $con->findAll2($SQL_SUM_DOWN);

    $SQL_COUNT_NOTP = "select count(id_notificacion) notificaiones_pend from notificaciones n";
    $inner_notify = "";
    if (isset($_POST['coach'])) {
        $inner_notify = " inner join usuarios user on user.id_tipo_usuario = n.tipo_usuario and user.coach = " . $_POST['coach'];
    }
    $SQL_COUNT_NOTP .= $inner_notify;
    if (isset($_POST['asesor'])) {
        if (strpos($SQL_COUNT_NOTP, "usuarios") === false) {
            $SQL_COUNT_NOTP .= " inner join usuarios user on user.id_tipo_usuario = n.tipo_usuario";
            $Assesor = " and n.tipo_usuario = " . $_POST['asesor'];
        } else {
            $Assesor = " and n.tipo_usuario = " . $_POST['asesor'];
        }
    }
    $SQL_COUNT_NOTP .= " where n.estado = 'PENDIENTE' and n.fecha_creacion between '" . $_POST['fini'] . " 00:00:00' and '" . $_POST['ffin'] . " 23:59:59'" . $Assesor;
    $rscCountNotify = $con->findAll2($SQL_COUNT_NOTP);

    $SQL_COUNT_NOTE = "select count(id_notificacion) notificaciones_ejec from notificaciones n ";
    $SQL_COUNT_NOTE .= $inner_notify;
    if (isset($_POST['asesor'])) {
        if (strpos($SQL_COUNT_NOTE, "usuarios") === false) {
            $SQL_COUNT_NOTE .= " inner join usuarios user on user.id_tipo_usuario = n.tipo_usuario";
            $Assesor = " and n.tipo_usuario = " . $_POST['asesor'];
        } else {
            $Assesor = " and n.tipo_usuario = " . $_POST['asesor'];
        }
    }
    $SQL_COUNT_NOTE .= " where n.estado = 'EJECUTADA' and n.fecha_creacion between '" . $_POST['fini'] . " 00:00:00' and '" . $_POST['ffin'] . " 23:59:59'" . $Assesor;
    $rscCountNotifyE = $con->findAll2($SQL_COUNT_NOTE);


    $SQL_SUM_TOT_VENT = "select COALESCE(sum(pp.valor_cuota), 0) total_venta from pagos_producto pp ";
    $SQL_SUM_TOT_VENT .= $inner;
    if (isset($_POST['asesor'])) {
        if (strpos($SQL_SUM_TOT_VENT, "personas") === false) {
            $SQL_SUM_TOT_VENT .= "inner join producto p on p.id_producto = pp.id_producto "
                    . "inner join personas u on u.ss = p.ss_persona ";
            $Assesor = " and u.asesor = " . $_POST['asesor'];
        } else {
            $Assesor = " and u.asesor = " . $_POST['asesor'];
        }
    }
    $SQL_SUM_TOT_VENT .= " WHERE pp.fecha_pago_realizado between '" . $_POST['fini'] . " 00:00:00' and '" . $_POST['ffin'] . " 23:59:59'" . $Assesor;
    $rsTotVent = $con->findAll2($SQL_SUM_TOT_VENT);

    $response['total_leads'] = $rsLead[0]['total_leads'];
    $response['total_clientes'] = $rsCliente[0]['total_clientes'];
    $response['total_tranfer'] = $rsTanfer[0]['total_tranfer'];
    $response['total_proccess'] = $rsProccess[0]['total_proccess'];
    $response['total_aprobados'] = $rsAprobe[0]['total_aprobados'];
    $response['total_caida'] = $rsDown[0]['total_caida'];
    $response['notificaiones_pend'] = $rscCountNotify[0]['notificaiones_pend'];
    $response['notificaciones_ejec'] = $rscCountNotifyE[0]['notificaciones_ejec'];
    $response['total_venta'] = $rsTotVent[0]['total_venta'];
    $response['msg'] = "success";
    echo json_encode($response);
} catch (Exception $e) {
    $response['detail'] = $e->getMessage();
    $response['msg'] = "error";
    echo json_encode($response);
} finally {
    $con->desconectar();
}


