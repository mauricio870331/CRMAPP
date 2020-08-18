<?php

session_start();

require '../BD.php';
$con = new BD();
$response = array();
try {
    $bureau = $_POST['bureau'];
    $respuesta = $_POST['respuesta'];
    $id_disputa = $_POST['id_disputa'];

    $SQL_INSERT = "INSERT INTO  resp_disputas (id_disputa, fecha_respuesta,respuesta, create_by, bureau) "
            . "VALUES (" . $id_disputa . ",NOW(),'" . $respuesta . "', " . $_SESSION['obj_user'][0]['id'] . ", '" . $bureau . "')";
    $result = $con->exec($SQL_INSERT);

    $SQL_UPDATE = "UPDATE disputas set tot_resp  = (tot_resp+1) WHERE id_disputa = " . $id_disputa;
    $result = $con->exec($SQL_UPDATE);

    if ($result > 0) {
        $response["msn"] = "success";
        $response["ss"] = $_POST['ss'];
        echo json_encode($response);
    } else {
        $response["msn"] = "error";
        echo json_encode($response);
    }
} catch (Exception $exc) {
    $response["msn"] = $exc;
    echo json_encode($response);
} finally {
    $con->desconectar();
}

