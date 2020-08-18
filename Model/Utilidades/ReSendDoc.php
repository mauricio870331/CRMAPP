<?php

session_start();
date_default_timezone_set('America/Bogota');
require_once '../BD.php';
$con = new BD();
try {


    $SQL_QUERY = "select * from sender_mail_config order by create_at desc limit 1";
    $rs = $con->findAll2($SQL_QUERY);

    $type_doc = $_POST['type_doc'];
    $command = "java -jar C:\\\\xampp\\\htdocs\\\CRMAPP\\\Model\\\PDFLibrary\\\dist\\\Mailer.jar "
            . "" . $rs[0]['email_sender'] . " "
            . "" . $rs[0]['pass'] . " "
            . "" . $_POST['email'] . " "
            . "" . $rs[0]['smtp_host'] . " "
            . "" . $rs[0]['smtp_enable'] . " "
            . "" . $rs[0]['stmp_port'] . " "
            . "" . $rs[0]['smtp_auth'] . " "
            . "" . $type_doc . base64_decode($_POST['ss']) . " "
            . "" . base64_decode($_POST['ss']) . "";

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



