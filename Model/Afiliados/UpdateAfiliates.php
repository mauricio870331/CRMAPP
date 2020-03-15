<?php

session_start();
require '../Utils.php';
date_default_timezone_set('America/Bogota');
$now = date('Y-m-d H:i:s');
require_once '../BD.php';
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
$id_afiliado = $_POST['id_afiliado'];
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

$fieldFoto = "";

if ($foto != null) {
    $fieldFoto = ", foto='" . $foto . "'," . " ext = '" . $extension . "' ";
}

$sql2 = "update afiliados  set tipo_doc = '" . trim($tipo_doc) . "',documento = '" . trim($documento) . "',"
        . " nombres = '" . trim($nombres) . "', apellidos = '" . trim($apellidos) . "',"
        . " nombre_completo =  '" . $nombres . " " . $apellidos . "', "
        . "genero = '" . $genero . "', create_by = " . $_SESSION['obj_user'][0]['id'] . ","
        . " lugar_expedi_doc = '" . $lugarExpe . "', fecha_exp_doc = '" . date('Y-m-d', strtotime($fechExpedicion)) . "'"
        . " " . $fieldFoto . " Where id_afiliado = " . $id_afiliado;
$con->exec($sql2);
$sql2 = "update datos_afiliado set direccion = '" . $direccion . "',telefonos = '" . $telefonos . "',"
        . "departamento = '" . $departamento . "',ciudad_residencia = '" . $ciudad . "',"
        . "email = '" . $email . "',direccion_correo = '" . $correspondencia . "',"
        . "estado_vinculo = 'Activo',estado_civil = '" . $estadocivil . "',"
        . "fecha_nacimiento = '" . date('Y-m-d', strtotime($nacimiento)) . "',nacionalidad = '" . $nacionalidad . "',"
        . "turno = '$turno', diadepago = '$diadepago', "
        . "fecha_proximo_pago = '" . Utils::SUM_ONE_MONTH_TO_DATE("1", $diadepago) . "' where id_afiliado = " . $id_afiliado;
$con->exec($sql2);
if (file_exists($ruta)) {
    unlink($ruta);
}
echo json_encode("ok");
$con->desconectar();

