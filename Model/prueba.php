<?php

include './BD.php';
$con = new BD();
$sql = "select * from logs_crmapp";
$rsDocs = $con->findAll2($sql);
$con->desconectar();

echo "<pre>";

echo $rsDocs[0]["msn"];
 $arr = json_decode(base64_decode($rsDocs[0]["trace"]));
print_r($arr);

