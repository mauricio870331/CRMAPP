<?php

session_start();
require '../BD.php';
$con = new BD();



try {

    $SQL_SELECT = "select count(id_producto) total from producto where ss_persona = '" . $_POST['ss'] . "'";
    $rs = $con->findAll2($SQL_SELECT);
    $total_productos = $rs[0]['total'];


    $SQL_INSERT = "INSERT INTO producto (banco,titular, id_tipo_cuenta, numero_ruta, numero_cuenta, valor, numero_cuotas, ss_persona, fecha_registro, id_tipo_producto) "
            . "VALUES ('" . strtoupper($_POST['banco']) . "','" . strtoupper($_POST['titular']) . "',"
            . " " . $_POST['tipo_cuenta'] . ", '" . $_POST['ruta'] . "', "
            . "'" . $_POST['cuenta'] . "', " . $_POST['valor'] . ", " . $_POST['cuotas'] . ", '" . $_POST['ss'] . "', NOW(), " . $_POST['tipo_producto'] . ")";
    $con->exec($SQL_INSERT);

    $val = "VALUES ";
    $separador = ",";
    $cuotas = str_replace("},{", ";", $_POST['cuotas_producto']);
    $cuotas = str_replace("{", "", $cuotas);
    $cuotas = explode(";", str_replace("}", "", $cuotas));

    for ($index = 0; $index < count($cuotas); $index++) {
        if ($index == (count($cuotas) - 1)) {
            $separador = "";
        }
        $arr_cuota = explode(",", $cuotas[$index]);
        $val .= "(" . $arr_cuota[0] . "," . $arr_cuota[2] . ",1,"
                . "(select max(id_producto) id_producto from producto where ss_persona = '" . $_POST['ss'] . "'),"
                . " " . $_SESSION['obj_user'][0]['id'] . ", NOW(), '" . $arr_cuota[1] . "')" . $separador . " ";
    }

    $SQL_INSERT_PAGO = "INSERT INTO pagos_producto (numero_cuota,valor_cuota,id_estado_pago,id_producto,creado_por,fecha_creacion, fecha_pago) " . $val;

//    echo $SQL_INSERT_PAGO;die;

    if ($con->exec($SQL_INSERT_PAGO) > 0) {
        $SQL_SELECT = "select concat(p.nombres,' ',p.apellidos) cliente, concat(u.nombres,' ',u.apellidos) asesor, u.id, u.id_tipo_usuario from personas p "
                . "inner join usuarios u on p.asesor = u.id where p.ss = '" . $_POST['ss'] . "'";
//        echo $SQL_SELECT;
        $rs = $con->findAll2($SQL_SELECT);
        if ($total_productos == 0) {
            $SQL_INSERT_NOTIFY = "INSERT INTO notificaciones (titulo,detalle,tipo_usuario,fecha_creacion,creado_por, estado, ss_persona) "
                    . "VALUES ('PASAR LEAD A CLIENTE', 'El lead " . $rs[0]['cliente'] . ", identificado con SS: " . $_POST['ss'] . " "
                    . "acaba de adquirir un producto y esta listo para ser cliente. \nAsesor asignado: " . $rs[0]['asesor'] . ".',"
                    . "" . $rs[0]['id_tipo_usuario'] . ", NOW()," . $rs[0]['id'] . ", 'PENDIENTE', '" . $_POST['ss'] . "')";
            $con->exec($SQL_INSERT_NOTIFY);
        }
        echo json_encode($_POST['ss']);
    } else {
        echo json_encode('error');
    }
} catch (Exception $exc) {
    echo $exc->getTraceAsString();
}
$con->desconectar();
