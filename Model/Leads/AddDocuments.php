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

    $documentos = array("Carta de Presentación",
        "Bienvenida Greenlight",
        "Contrato Greenlight",
        "Acuerdo de Pagos Greenlight",
        "Solicitud de Reportes",
        "Confirmación de Pagos",
        "Verificacion Greenlight");
    $response = array();
    if (in_array($descripcion, $documentos)) {

        $relativaRuta = "../Model/PDFLibrary/";

        switch ($descripcion) {
            case "Carta de Presentación":
                require '../PDFLibrary/CartaPresentacionClass.php';
                $carta = new CartaPresentacionClass();
                $carta->setName($_POST['nombre_cliente']);
                $carta->setSs($documento);
                $carta->Generar();
                $command = "java -jar C:\\\\xampp\\\htdocs\\\CRMAPP\\\Model\\\PDFLibrary\\\dist\\\Mailer.jar Carta_" . $_POST['ss'] . "";
                $SQL_INSERT3 = "INSERT INTO  documentos (descripcion,ruta, ext, ss_persona, fecha_registro, nombre_archivo, asesor) "
                        . "VALUES ('" . $descripcion . "','" . $relativaRuta . "' ,'pdf', '" . $documento . "', NOW(), 'Carta_" . $documento . ".pdf', " . $_SESSION['obj_user'][0]['id'] . ")";
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
                
                print_r($rsPagos);die;
                
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
                $command = "java -jar C:\\\\xampp\\\htdocs\\\CRMAPP\\\Model\\\PDFLibrary\\\dist\\\Mailer.jar Bienvenida_" . $_POST['ss'] . "";
                $SQL_INSERT3 = "INSERT INTO  documentos (descripcion,ruta, ext, ss_persona, fecha_registro, nombre_archivo, asesor) "
                        . "VALUES ('" . $descripcion . "','" . $relativaRuta . "' ,'pdf', '" . $documento . "', NOW(), 'Bienvenida_" . $documento . ".pdf', " . $_SESSION['obj_user'][0]['id'] . ")";
                break;

            default:
                break;
        }
        if ($_POST['enviar'] == "true") {
            $SQL_INSERT = "INSERT INTO queues (job, exec) "
                    . "values ('" . $command . "',0) ";
            $result = $con->exec($SQL_INSERT);
        }
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

