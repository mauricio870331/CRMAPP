<?php
session_start();
$array = array();
require_once '../BD.php';
$con = new BD();
$dato = $_POST['dato'];
$sql2 = "select * from  r_s where R like '%$dato%'  and estado = 'Disponible'";

$rs = $con->findAll2($sql2);
if (count($rs) > 0) {
    foreach ($rs as $key => $value) {
        ?>
        <tr style="cursor:pointer;">
            <td class="idr"><?php echo $value['id_r'] ?></td>  
            <td class="valor"><?php echo $value['R'] ?></td>   
            <td class=""><?php echo $value['tipo'] ?></td>   
            <td><?php echo $value['estado'] ?></td>
            <td><i class="fa fa-fw fa-check mio" data-id="tr<?php echo $value['R']; ?>"></i></td>
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
            var valor2 = "";
            jQuery(this).parents("tr").find(".valor").each(function () {
                valores += $(this).html();
            });
            
            jQuery(this).parents("tr").find(".idr").each(function () {
                valor2 += $(this).html();
            });
            
            console.log(valores)
            $("#closeModalFindVehiculo").trigger("click");
            $("#R").val(valores);    
            $("#id_r").val(valor2);  
            $("#respuesta").html("");            
        });

    </script>
    <?php
}
$con->desconectar();
?>





