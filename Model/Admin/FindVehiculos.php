<?php
session_start();
$array = array();
require_once '../BD.php';
$con = new BD();
$dato = $_POST['dato'];
$sql2 = "select v.*, r.R, r.id_r, r.tipo from  vehiculos v LEFT JOIN r_s r on r.id_r = v.id_r "
        . "where (r.R like '%$dato%' or v.placa_vehiculo like '%$dato%') and v.disponible = 1";

$rs = $con->findAll2($sql2);
if (count($rs) > 0) {
    foreach ($rs as $key => $value) {
        ?>
        <tr style="cursor:pointer;">
            <td><?php echo $value['id_vehiculo'] ?></td>
            <td class="v2"><?php echo $value['id_r'] ?></td>
            <td ><?php echo $value['tipo']." ".$value['R'] ?></td>
            <td class="valor"><?php echo $value['placa_vehiculo'] ?></td>
            <td><?php echo $value['marca'] ?></td>
            <td><?php echo $value['linea'] ?></td>
            <td><?php echo $value['cooperativa'] ?></td>
            <td><?php echo $value['estado'] ?></td>
            <td><i class="fa fa-fw fa-check mio" data-id="tr<?php echo $value['id_vehiculo']; ?>"></i></td>
        </tr>
        <?php
    }
} else {
    ?>
    <tr class="odd">
        <td valign="top" colspan="7" class="dataTables_empty">No hay coincidencias</td>
    </tr>
    <?php
}
if (isset($_POST['dato']) && !empty($_POST['dato'])) {
    ?>
    <!-- otras -->   
    <script>

        jQuery(".mio").click(function () {
            var valores = "";
            var val2 = "";
            jQuery(this).parents("tr").find(".v2").each(function () {
                val2 += $(this).html();
            });
            
            jQuery(this).parents("tr").find(".valor").each(function () {
                valores += $(this).html();
            });
            console.log(valores)
            $("#closeModalFindVehiculo").trigger("click");
            $("#R2").val(valores);   
            $("#id_r").val(val2); 
            $("#respuesta").html("");            
        });

    </script>
    <?php
}
$con->desconectar();
?>





