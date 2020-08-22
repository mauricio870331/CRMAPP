<?php

session_start();
require '../BD.php';
$con = new BD();
$response = array();

$email = $_POST['email'];
$pass = $_POST["pass"];
$id = $_POST["id"];

$SQL = "update sender_mail_config set email_sender = '" . $email . "', pass = '" . $pass . "', create_at = NOW(), create_by = ".$_SESSION['obj_user'][0]['id']." where id_config  = " . $id;
$rs = $con->exec($SQL);

if (is_array($rs)) {
    $response["msn"] = "error";
    $response["detail"] = $rs->getMessage();  
    echo json_encode($response);
} else {
    $response["msn"] = "ok";   
    echo json_encode($response);
}
$con->desconectar();
