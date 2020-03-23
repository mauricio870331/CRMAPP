<?php

session_start();
require './Admin/CleanDuplicates.php';
$clean = new CleanDuplicates();
$clean->CleanDuplicados();
date_default_timezone_set('America/Bogota');
if (isset($_POST)) {
    require_once 'BD.php';
    $con = new BD();
    $usuario = $_POST['usuario'];
    $pass = (int) $_POST['pass'];
    $resultado = $con->findAll2("SELECT *, concat(nombres,' ',apellidos) nombre_completo FROM usuarios u "
            . "inner join tipo_usuario tu on tu.id_tipo_usuario = u.id_tipo_usuario "
            . " WHERE documento = '" . $usuario . "' and password = '" . $pass . "'");
    if (count($resultado) == 0) {
        echo "error";
    } else {
        $_SESSION['obj_user'] = $resultado;
        echo $resultado[0]['descripcion'];
    }
}