<?php

session_start();

//print_r();die;

require '../BD.php';
require '../PDFLibrary/CrearDocxClass.php';


$con = new BD();
try {


    $documento = $_POST['ss'];
    $table_name = "documentos";



    $SQL_QUERY = "Select concat(p.nombres, ' ', p.apellidos) cliente, p.telefonos, p.direccion, d.*,"
            . " r.razon, DATE_FORMAT(p.dob, '%d/%m/%Y') nacimiento, DATE_FORMAT(d.fecha_creacion, '%d/%m/%Y') fecha_reg "
            . "from personas p "
            . "join disputas d on p.ss = d.ss_persona "
            . "join razon_disputas r on r.id_razon = d.razon "
            . "where p.ss = '" . $documento . "' and doc_gen = 0 limit 1";


    $rs = $con->findAll2($SQL_QUERY);

    $descripcion = "Disputa";
    $relativaRuta = "../Documentos/" . $documento . "/";
    $formato = "Disputa" . $rs[0]['id_disputa'] . "_" . $documento;


    $doc = new CrearDocxClass();
    $doc->cliente = strtoupper($rs[0]['cliente']);
    $doc->direccion = $rs[0]['direccion'];
    $doc->id = $rs[0]['item'];
    $doc->ss = $rs[0]['ss_persona'];
    $doc->dob = $rs[0]['nacimiento'];
    $doc->created_at = $rs[0]['fecha_reg'];
    $doc->razon = $rs[0]['razon'];
    $doc->telefonos = $rs[0]['telefonos'];
    $doc->Generar();


    $SQL_INSERT3 = "INSERT INTO  documentos (descripcion,ruta, ext, ss_persona, fecha_registro, nombre_archivo, asesor) "
            . "VALUES ('" . $descripcion . "','" . $relativaRuta . "' ,'docx', '" . $documento . "', NOW(), '" . $formato . ".docx', " . $_SESSION['obj_user'][0]['id'] . ")";
    $result = $con->exec($SQL_INSERT3);
    
    $SQL_UPDATE = "update disputas set doc_gen = 1 where id_disputa = ".$rs[0]['id_disputa'];
    $result = $con->exec($SQL_UPDATE);

    $response = array();
    if ($result > 0) {
        $response["msn"] = "success";
        $response["ss"] = $documento;
        echo json_encode($response);
    } else {
        $response["msn"] = "error";
        echo json_encode($response);
    }
} catch (Exception $exc) {
    $response["msn"] = "error";
    $response["detail"] = $exc->getMessage();
    echo json_encode($response);
} finally {
    $con->desconectar();
}

