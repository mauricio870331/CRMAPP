<?php
include '../BD.php';
$con = new BD();
$sql = "SELECT * FROM estado where id_ciudad = ".$_POST["id_ciudad"];


$rs = $con->findAll2($sql);
?>
<option value="">Seleccione</option>
<?php
for ($index = 0; $index < count($rs); $index++) {
    ?>
    <option value="<?php echo $rs[$index]['id']; ?>"><?php echo $rs[$index]['estado']; ?></option>
    <?php
}
?>
