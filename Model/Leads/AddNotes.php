<?php

session_start();

require '../BD.php';
$con = new BD();
try {
    $descripcion = $_POST['descripcion'];
    $documento = $_POST['ss'];
    $titulo = $_POST['titulo'];
    $SQL_INSERT = "INSERT INTO  notas (titulo, descripcion,ss_persona, fecha_registro, creado_por) "
            . "VALUES ('" . $titulo . "','" . $descripcion . "','" . $documento .
            "',  NOW(), " . $_SESSION['obj_user'][0]['id'] . ")";
    if ($_POST['accion'] == "update") {
        $SQL_INSERT = "UPDATE notas set titulo = '" . $titulo . "', descripcion = '" . $descripcion . "'"
                . ", modificado_por = " . $_SESSION['obj_user'][0]['id'] . ", fecha_modificado = NOW()"
                . " WHERE id_nota = " . $_POST['id_nota'];
        
        
    }
    if ($con->exec($SQL_INSERT) > 0) {
        echo json_encode($documento);
    } else {
        echo json_encode('error');
    }
} catch (Exception $exc) {
    echo $exc->getTraceAsString();
} finally {
    $con->desconectar();
}

