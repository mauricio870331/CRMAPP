<?php

session_start();
date_default_timezone_set('America/Bogota');
require_once '../BD.php';
$con = new BD();
try {

    $type_doc = $_POST['type_doc'];
    $command = "java -jar C:\\\\xampp\\\htdocs\\\CRMAPP\\\Model\\\PDFLibrary\\\dist\\\Mailer.jar " . $type_doc . base64_decode($_POST['ss']) . "";

    $SQL_INSERT = "INSERT INTO queues (job, exec) "
            . "values ('" . $command . "',0) ";
    $result = $con->exec($SQL_INSERT);

    if ($result > 0) {
        $response["msg"] = "success";
        echo json_encode($response);
    } else {
        $response["msg"] = "error";
        echo json_encode($response);
    }
} catch (Exception $exc) {
    echo json_encode($exc->getTraceAsString());
} finally {
    $con->desconectar();
}



