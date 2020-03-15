<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);
//seleccionar todos los afiliados donde proxima fecha de pago sea menor a hoy
$hoy = date("Y-m-d");
try {
    $con = new PDO('mysql:host=localhost:3306;dbname=bdcordiales;charset=utf8', "cordiales", "cordiales123", array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
    ));
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $exc) {
    echo $exc->getTraceAsString();
}

$query = "Select d.id_afiliado, a.documento, a.nombre_completo, d.fecha_proximo_pago from datos_afiliado d, afiliados a where a.id_afiliado = d.id_afiliado and"
        . " d.fecha_proximo_pago < '$hoy'";
$res = findAll2($query, $con);
//print_r($res);
 $MensajeHTML = mensajeHTML($res);
//enviarMail("smaurville@gmail.com", "smaurville@gmail.com", "Afiliados en Mora..!", $MensajeHTML);
if (count($res) > 0) {
    $updates = 0;
    for ($i = 0; $i < count($res); $i++) {
        $update = "update datos_afiliado set estado_vinculo = 'Inactivo' where id_afiliado = " . $res[$i]['id_afiliado'];
        if (ejecutar($update, $con) > 0) {
            $updates++;
        }
    }
    // si $updates > 0 enviar emal avisando que usuarios quedaron inactivos por mora
    if ($updates > 0) {
        $MensajeHTML = mensajeHTML($res);
        enviarMail("smaurville@gmail.com", "smaurville@gmail.com", "Afiliados en Mora..!", $MensajeHTML);
    }
}
$con = null;

function mensajeHTML($afiliados = array()) {
    $mensaaje = "<table border='1'>";
    $mensaaje .= "<tr>";
    $mensaaje .= "<td colspan='3'><b>A continuacion se relacionan los empleados incatvos por mora</b></td>";
    $mensaaje .= "</tr>";
    $mensaaje .= "<tr>";
    $mensaaje .= "<td><b>Documento</b></td>";
    $mensaaje .= "<td><b>Nombre</b></td>";
    $mensaaje .= "<td><b>Fecha de Pago</b></td>";
    $mensaaje .= "</tr>";
    for ($i = 0; $i < count($afiliados); $i++) {
        $mensaaje .= "<tr>";
        $mensaaje .= "<td>".$afiliados[$i]['documento']."</td>";
        $mensaaje .= "<td>".$afiliados[$i]['nombre_completo']."</td>";
        $mensaaje .= "<td>".$afiliados[$i]['fecha_proximo_pago']."</td>";
        $mensaaje .= "</tr>";
    }
    $mensaaje .= "</table>";
    return $mensaaje;
}
function findAll2($query, $con, $opc = false) {
    $stm = $con->prepare($query);
    $stm->execute();
    if ($opc) {
        $rs = $stm->fetchAll(PDO::FETCH_OBJ);
    } else {
        $rs = $stm->fetchAll(PDO::FETCH_ASSOC);
    }
    return $rs;
}

function ejecutar($query, $con) {
    try {
        $con->beginTransaction();
        $stm = $con->prepare($query);
        $stm->execute();
        $con->commit();
        return $stm->rowCount();
    } catch (Exception $ex) {
        $con->rollBack();
        return $ex->getMessage();
    }
}

function enviarMail($de, $para, $asunto, $mensaje) {
//    $from = "smaurville@gmail.com";
//    $to = "smaurville@gmail.com";
//    $subject = "Checking PHP mail";
//    $message = "PHP mail works just fine";
    $headers = "From:" . $de . "\r\n";
    $headers .= "Reply-To: " . $de . "\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html\r\n";
    mail($para, $asunto, $mensaje, $headers);
    echo "The email message was sent.";
}
