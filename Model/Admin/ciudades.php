<?php
require_once '../BD.php';
$con = new BD();
$rs = $con->findAll2("SELECT distinct * FROM municipios where departamento_id = '" . $_POST['cod'] . "' order by municipio");
?>
<option>Seleccione</option>
<?php foreach ($rs as $key => $value) { ?>
    <option value="<?php echo $value['id_municipio'] ?>"><?php echo $value['municipio'] ?></option>
<?php } ?>
