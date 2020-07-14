<?php
session_start();
require '../BD.php';
$con = new BD();
$SQL_SELECT = "SELECT pp.*, p.*, ep.codigo, ep.descripcion, tc.descripcion tipo_cuenta, tp.nombre from pagos_producto pp "
        . "inner join producto p on p.id_producto = pp.id_producto "
        . "inner join estados_de_pago ep on ep.id_estado_pago = pp.id_estado_pago "
        . "inner join tipo_cuenta tc on tc.id_tipo_cuenta = p.id_tipo_cuenta "
        . "inner join tipo_producto tp on tp.id_tipo_producto = p.id_tipo_producto "
        . "where p.ss_persona = '" . base64_decode($_POST['ss']) . "' "
        . "and p.id_producto = " . $_POST['id_product'] . "";

$rsProd = $con->findAll2($SQL_SELECT);
$con->desconectar();
?>
<div>
    <ul>
        <li><label>Producto:</label><label class="labelInfo"><?php echo $rsProd[0]['nombre'] ?></label></li>
        <li><label>Banco:</label><label class="labelInfo"><?php echo $rsProd[0]['banco'] ?></label></li>
        <li><label>Tipo de Cuenta:</label><label class="labelInfo"><?php echo $rsProd[0]['tipo_cuenta'] ?></label></li>
        <li><label>Numero de Ruta:</label><label class="labelInfo"><?php echo $rsProd[0]['numero_ruta'] ?></label></li>
        <li><label>Numero de Cuenta:</label><label class="labelInfo"><?php echo $rsProd[0]['numero_cuenta'] ?></label></li>
        <li><label>Total Deuda:</label><label class="labelInfo"><?php echo "$" . number_format($rsProd[0]['valor'], 0, ",", ".") ?></label></li>
    </ul>
</div>
<div class="box">                                            
    <div class="box-body">
        <table id="example1" class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th># Cuota</th>
                    <th>Valor Cuota</th>
                    <th>Estado</th>
                    <th>Fecha Pago</th>    
                </tr>
            </thead>
            <tbody> 
                <?php
                for ($i = 0; $i < count($rsProd); $i++) {
                    ?>
                    <tr>
                        <td><a class="textoc"><?php echo $rsProd[$i]['numero_cuota'] ?></a></td>
                        <td><a class="textoc"><?php echo "$ " . number_format($rsProd[$i]['valor_cuota'], 0, ",", ".") ?></a></td>
                        <td>
                            <a class="textoc" data-toggle="tooltip" title="<?php echo $rsProd[$i]['descripcion'] ?>">
                                <span class="label label-warning up">  
                                    <?php echo $rsProd[$i]['codigo'] ?>
                                </span>
                            </a>
                        </td>
                        <td><a class="textoc"><?php echo $rsProd[$i]['fecha_pago'] ?></a></td>
                    </tr>
                <?php } ?>
            </tbody>                                               
        </table> 
    </div>
</div>