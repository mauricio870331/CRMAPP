<?php
include '../BD.php';
$con = new BD();
$sql = "SELECT * FROM ciudad where id_estado = ".$_POST["id_estado"];


$rs = $con->findAll2($sql);
?>
<option value="">Seleccione</option>
<?php
for ($index = 0; $index < count($rs); $index++) {
    ?>
    <option value="<?php echo $rs[$index]['id']; ?>"><?php echo $rs[$index]['ciudad']; ?></option>
    <?php
}
?>
