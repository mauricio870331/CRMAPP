<?php

session_start();

//print_r();die;

require '../BD.php';


$con = new BD();
try {

    $descripcion = $_POST['descripcion'];
    $documento = $_POST['ss'];
    $folder = "Documentos";
    $table_name = "documentos";
    if ($_POST['opcion'] == "adjunto") {
        $folder = "Adjuntos";
        $table_name = "adjuntos";
    }

    $documentos = array(
        "Carta de Presentación",
        "Bienvenida Greenlight",
        "Contrato Greenlight",
        "Acuerdo de Pagos Greenlight",
        "Solicitud de Reportes",
        "Verificacion Greenlight");
    $response = array();
    if (in_array($descripcion, $documentos)) {

        $relativaRuta = "../Documentos/" . $documento . "/";
        $formato = "";
        switch ($descripcion) {
            case "Carta de Presentación":
                require '../PDFLibrary/CartaPresentacionClass.php';
                $carta = new CartaPresentacionClass();
                $carta->setName($_POST['nombre_cliente']);
                $carta->setSs($documento);
                $carta->Generar();
                $formato = "Carta_" . $_POST['ss'];
                break;
            case "Bienvenida Greenlight":
                require '../PDFLibrary/BienvenidaClass.php';
                $query = "select pr.id_producto, p.email, p.direccion, pr.titular, pr.numero_cuenta, tc.descripcion from personas p "
                        . "inner join producto pr on pr.ss_persona = p.ss "
                        . "inner join tipo_cuenta tc on tc.id_tipo_cuenta = pr.id_tipo_cuenta "
                        . "Where ss = '" . $documento . "' limit 1";
                $rs = $con->query($query);

                $queryPagos = "select concat('Cuota: ',numero_cuota,', Fecha de pago: ',fecha_pago,', Valor: $',FORMAT(valor_cuota,0)) resumen from pagos_producto "
                        . "Where id_producto = " . $rs[0]['id_producto'];
                $rsPagos = $con->query($queryPagos);


                $rs_pagos = array();
                foreach ($rsPagos[0] as $value) {
                    $rs_pagos[] = $value;
                }
                $pdf = new BienvenidaClass();
                $pdf->name = $_SESSION['obj_user'][0]['nombre_completo'];
                $pdf->ss = $documento;
                $pdf->mail = $rs[0]['email'];
                $pdf->direccion = $rs[0]['direccion'];
                $pdf->client_name = $_POST['nombre_cliente'];
                $pdf->tipo_cuenta = $rs[0]['descripcion'];
                $pdf->titular_cuenta = $rs[0]['titular'];
                $pdf->numero_cuenta = $rs[0]['numero_cuenta'];
                $pdf->pagos = $rs_pagos;
                $pdf->Generar();
                $formato = "Bienvenida_" . $_POST['ss'];
                break;
            case "Contrato Greenlight":
                $query_user = "select p.id, p.direccion, concat(c.ciudad,', ',e.estado) estado_ciudad,"
                        . " pr.titular, pr.numero_ruta, pr.numero_cuenta, pr.banco, pr.id_producto from personas p "
                        . "join estado e on e.id = p.id_estado join ciudad c on c.id = p.id_ciudad "
                        . "join producto pr on pr.ss_persona = p.ss and pr.has_contract = 0 "
                        . "where p.ss = '" . $_POST['ss'] . "' ORDER by p.id asc LIMIT 1";
                $rs = $con->findAll2($query_user);
                $query_pagos = "select  DATE_FORMAT(fecha_pago, '%m-%d-%Y') fecha_pago, valor_cuota from pagos_producto where id_producto = " . $rs[0]["id_producto"];
                $rs_pagos = $con->findAll2($query_pagos);
                $arrayPagos = array();
                for ($index = 0; $index < count($rs_pagos); $index++) {
                    $arrayPagos[] = array($rs_pagos[$index]["fecha_pago"], $rs_pagos[$index]["valor_cuota"]);
                }

                require '../PDFLibrary/ContratoClass.php';
                $contrato = new ContratoClass();
                $contrato->ss = $_POST['ss'];
                $contrato->id = $rs[0]["id"];
                $contrato->name = strtoupper($_POST['nombre_cliente']);
                $contrato->direccion = $rs[0]["direccion"];
                $contrato->pais_ciudad = $rs[0]["estado_ciudad"];
                $contrato->titular_cuenta = $rs[0]["titular"];
                $contrato->numero_cuenta = encodeAccountNumnber($rs[0]["numero_cuenta"]);
                $contrato->numero_ruta = $rs[0]["numero_ruta"];
                $contrato->banco = $rs[0]["banco"];
                $contrato->pagos = $arrayPagos;
                $contrato->Generar();
                $formato = "Contrato_" . $_POST['ss'];
                break;
            case "Acuerdo de Pagos Greenlight":
                $query_user = "select p.id, p.direccion, concat(c.ciudad,', ',e.estado) estado_ciudad,"
                        . " pr.titular, pr.numero_ruta, pr.numero_cuenta, pr.banco, pr.id_producto from personas p "
                        . "join estado e on e.id = p.id_estado join ciudad c on c.id = p.id_ciudad "
                        . "join producto pr on pr.ss_persona = p.ss and pr.has_contract = 0 "
                        . "where p.ss = '" . $_POST['ss'] . "' ORDER by p.id asc LIMIT 1";
                $rs = $con->findAll2($query_user);
                $query_pagos = "select  DATE_FORMAT(fecha_pago, '%m-%d-%Y') fecha_pago, valor_cuota from pagos_producto where id_producto = " . $rs[0]["id_producto"];
                $rs_pagos = $con->findAll2($query_pagos);
                $arrayPagos = array();
                for ($index = 0; $index < count($rs_pagos); $index++) {
                    $arrayPagos[] = array($rs_pagos[$index]["fecha_pago"], $rs_pagos[$index]["valor_cuota"]);
                }

                require '../PDFLibrary/AcuerdosDePagoClass.php';

                $acuerdo = new AcuerdosDePagoClass();
                $acuerdo->ss = $_POST['ss'];
                $acuerdo->titular_cuenta = $rs[0]["titular"];
                $acuerdo->numero_cuenta = encodeAccountNumnber($rs[0]["numero_cuenta"]);
                $acuerdo->numero_ruta = $rs[0]["numero_ruta"];
                $acuerdo->banco = $rs[0]["banco"];
                $acuerdo->pagos = $arrayPagos;
                $acuerdo->Generar();
                $formato = "AcuerdoDePagos_" . $_POST['ss'];
                break;
            case "Solicitud de Reportes":

                $query_user = "select p.id, p.direccion, concat(c.ciudad,', ',e.estado) estado_ciudad,"
                        . " DATE_FORMAT(p.dob , '%d/%m/%Y') dob from personas p "
                        . "join estado e on e.id = p.id_estado join ciudad c on c.id = p.id_ciudad "
                        . "where p.ss = '" . $_POST['ss'] . "' ORDER by p.id asc LIMIT 1";

                $rs = $con->findAll2($query_user);

                require '../PDFLibrary/SolicitudReportes.php';

                $sReportes = new SolicitudReportes();
                $sReportes->ss = $_POST['ss'];
                $sReportes->name = strtoupper($_POST['nombre_cliente']);
                $sReportes->direccion = $rs[0]["direccion"];
                $sReportes->ciudad = $rs[0]["estado_ciudad"];
                $sReportes->fecha_nacimiento = $rs[0]["dob"];
                $sReportes->Generar();
                $formato = "SolicitudReporte_" . $_POST['ss'];

                break;
            case "Verificacion Greenlight":

                require '../PDFLibrary/VerificacionClass.php';

                $verificacion = new VerificacionClass();
                $verificacion->name = $_SESSION['obj_user'][0]['nombre_completo'];
                $verificacion->ss = $_POST['ss'];
                $verificacion->Generar();
                $formato = "Verificacion_" . $_POST['ss'];

                break;
            default:
                break;
        }

        if ($_POST['enviar'] == "true") {
            $command = "java -jar C:\\\\xampp\\\htdocs\\\CRMAPP\\\Model\\\PDFLibrary\\\dist\\\Mailer.jar " . $formato . "";
            $SQL_INSERT = "INSERT INTO queues (job, exec) "
                    . "values ('" . $command . "',0) ";
            $result = $con->exec($SQL_INSERT);
        }

        $SQL_INSERT3 = "INSERT INTO  documentos (descripcion,ruta, ext, ss_persona, fecha_registro, nombre_archivo, asesor) "
                . "VALUES ('" . $descripcion . "','" . $relativaRuta . "' ,'pdf', '" . $documento . "', NOW(), '" . $formato . ".pdf', " . $_SESSION['obj_user'][0]['id'] . ")";
        $result = $con->exec($SQL_INSERT3);
    } else {
        $foto = null;
        $extension = null;
        if (isset($_FILES['exampleInputFile']) && !empty($_FILES['exampleInputFile'])) {
            $archivo = $_FILES['exampleInputFile']['tmp_name'];
            $nombre_archivo = $_FILES['exampleInputFile']['name'];
            $tamanio = $_FILES["exampleInputFile"]["size"];
            $ext = pathinfo($nombre_archivo);
            $extension = $ext['extension'];
            $ruta = "../../" . $folder . "/" . $documento;
            $relativaRuta = "../" . $folder . "/" . $documento;
            if (!file_exists($ruta)) {
                mkdir($ruta, 0700);
            }
            $subir = move_uploaded_file($archivo, $ruta . "/" . $descripcion . "." . $extension);
        }

        $SQL_INSERT = "INSERT INTO " . $table_name . " (descripcion,ruta, ext, ss_persona, fecha_registro, nombre_archivo) "
                . "VALUES ('" . $descripcion . "','" . $relativaRuta . "/','" . $extension . "'"
                . ", '" . $documento . "', NOW(), '" . $descripcion . "." . $extension . "')";
        $result = $con->exec($SQL_INSERT);
    }
    if ($result > 0) {
        $response["msn"] = "success";
        $response["opcion"] = $_POST['opcion'];
        $response["ss"] = $documento;
        echo json_encode($response);
    } else {
        $response["msn"] = "error";
        echo json_encode($response);
    }
} catch (Exception $exc) {

    $response["msn"] = "error";
    $response["detail"] = $exc->getTraceAsString();
    echo json_encode($response);
} finally {
    $con->desconectar();
}

function encodeAccountNumnber($numero_cuenta) {
    $total_chars = strlen($numero_cuenta);
    $last4chars = substr($numero_cuenta, $total_chars - 4);
    $encodeAccount = "";
    for ($index = 0; $index < $total_chars - 4; $index++) {
        $encodeAccount .= "X";
    }
    return $encodeAccount . $last4chars;
}
