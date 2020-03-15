<?php

session_start();
try {
    require '../Utils.php';
    date_default_timezone_set('America/Bogota');
    $now = date('Y-m-d H:i:s');
    require '../BD.php';
    $con = new BD();
//$ruta = "../archivos";
    $documento = $_POST['documento'];
    $nombres = $_POST['nombres'];
    $apellidos = $_POST['apellidos'];
    $genero = $_POST['genero'];
    $direccion = $_POST['direccion'];
    $telefonos = $_POST['telefonos'];
    $nacimiento = $_POST['nacimiento'];
    $tipo_doc = utf8_encode($_POST['tipo_doc']);
    $departamento = $_POST['departamento'];
    $ciudad = $_POST['ciudad'];
    $correspondencia = $_POST['correspondencia'];
    $estadocivil = $_POST['estadocivil'];
    $email = $_POST['email'];
    $lugarExpe = $_POST['lugarExpe'];
    $fechExpedicion = $_POST['fechExpedicion'];
    $nacionalidad = $_POST['nacionalidad'];
    $turno = $_POST['turno'];
    $diadepago = $_POST['diadepago'];


    $foto = null;
    $extension = null;
    if (isset($_FILES['foto']) && !empty($_FILES['foto'])) {
        $archivo = $_FILES['foto']['tmp_name'];
        $nombre_archivo = $_FILES['foto']['name'];
        $tamanio = $_FILES["foto"]["size"];
        $ext = pathinfo($nombre_archivo);
        $extension = $ext['extension'];
//$subir = move_uploaded_file($archivo, $ruta . "/" . $nombre);
        $fp = fopen($archivo, 'rb');
        $contenido = fread($fp, $tamanio);
        $temp = addslashes($contenido);
//    $data = fread($fp, filesize($ruta . "/" . $nombre . "." . $ext['extension']));
        fclose($fp);
        $foto = $temp;
    }


    $ruta = getcwd() . "\..\..\imageAfiliate\\" . $documento . ".png";
    if (file_exists($ruta)) {
//            $archivo = readfile($ruta); Muestra la imagen
        $tamanio = filesize($ruta);
        $fp = fopen($ruta, 'rb');
        $contenido = fread($fp, $tamanio);
        $temp = addslashes($contenido);
        $extension = "png";
//    $data = fread($fp, filesize($ruta . "/" . $nombre . "." . $ext['extension']));
        fclose($fp);
        $foto = $temp;
    }


    $sql2 = "Insert into afiliados (tipo_doc,documento, nombres, apellidos, nombre_completo, genero, foto, ext, create_by, lugar_expedi_doc, fecha_exp_doc, create_at) "
            . "values ('" . trim($tipo_doc) . "','" . trim($documento) . "','" . trim($nombres) . "'"
            . ", '" . trim($apellidos) . "', '" . $nombres . " " . $apellidos . "','" . $genero . "','" . $foto . "', '" . $extension . "'," . $_SESSION['obj_user'][0]['id'] . ","
            . "'" . $lugarExpe . "','" . Utils::DMY_TO_YMD($fechExpedicion) . "','" . date("Y-m-d H:i:s") . "')";

    if (file_exists($ruta)) {
        unlink($ruta);
    }

    if ($con->exec($sql2) > 0) {
        $sql3 = "insert into datos_afiliado (id_afiliado,direccion,telefonos,departamento,ciudad_residencia,email,"
                . "	direccion_correo,estado_vinculo,estado_civil,fecha_nacimiento,nacionalidad,turno,diadepago,fecha_proximo_pago)"
                . " values(" . getIdUser($documento, $con) . ",'" . $direccion . "','" . $telefonos . "','" . $departamento . "','" . $ciudad . "','" . $email . "'"
                . ",'" . $correspondencia . "','Activo','" . $estadocivil . "','" . Utils::DMY_TO_YMD($nacimiento) . "','" . $nacionalidad . "','" . $turno . "','" . $diadepago . "','" . Utils::SUM_ONE_MONTH_TO_DATE("1", $diadepago) . "')";

        if ($con->exec($sql3) > 0) {
            echo json_encode("ok");
        } else {
            echo json_encode('error');
        }
    } else {
        echo json_encode('error');
    }
    $con->desconectar();
} catch (Exception $exc) {
    echo $exc->getTraceAsString();
}

function getIdUser($documento, $con) {
    $rs = $con->findAll2("SELECT id_afiliado FROM afiliados WHERE documento = '" . $documento . "'");
    return $rs[0]['id_afiliado'];
}
