<?php
$con = new BD();
$rs = $con->findAll2("SELECT * FROM r_s order by R limit 200");
foreach ($rs as $key => $value) {
    ?>    
    <tr>       
        <td><?php echo $value['R']; ?></td>     
        <td><?php echo $value['create_at']; ?></td>  
        <td><span class="pull badge <?php echo ($value['tipo'] == "R") ? 'bg-aqua' : 'bg-blue' ?>"><?php echo $value['tipo']; ?></span></td>  
        <td><span class="pull badge <?php echo ($value['estado'] == "Disponible") ? 'bg-green' : 'bg-red' ?>"><?php echo $value['estado']; ?></span></td>
        <td>
            <div class="col-md-3 col-sm-4 acercar">
                <i class="fa fa-fw fa-eraser deleteR" data-estado="<?php echo $value['estado']; ?>" data-id="<?php echo $value['id_r']; ?>"   data-toggle="tooltip" title="Borrar"></i>
                <button type="button" style="display: none" class="btn btn-default" data-toggle="modal" data-target="#modal-default" id="R<?php echo $value['id_r']; ?>"/>
            </div>
            <div class="col-md-3 col-sm-4 acercar">
                <i class="fa fa-fw fa-edit updateR" data-id="<?php echo base64_encode($value['id_r']); ?>" data-toggle="tooltip" title="Actualizar"></i>
            </div>            
        </td>
    </tr> 
    <?php
}
?>