<?php
 $ruta = "../../Documentos/1113626301";
if(!mkdir($ruta, 0777, true)) {
    die('Fallo al crear las carpetas...');
}else{
    echo "creado";
}

