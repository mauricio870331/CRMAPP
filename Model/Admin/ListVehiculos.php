<?php
$con = new BD();
$sql = "SELECT v.*, r.R,r.id_r,r.tipo FROM vehiculos v LEFT JOIN r_s r on v.id_r = r.id_r order by r.R limit 200";
$rs = $con->findAll2($sql);
foreach ($rs as $key => $value) {
    ?>    
    <tr>       
        <td><?php echo $value['R']; ?></td>
        <td><?php echo $value['tipo']; ?></td>
        <td><?php echo $value['placa_vehiculo']; ?></td>
        <td><?php echo $value['marca']; ?></td>
        <td><?php echo $value['linea']; ?></td>
        <td><?php echo $value['cooperativa']; ?></td>
        <td><span class="pull badge <?php echo ($value['estado'] == "Activo") ? 'bg-green' : 'bg-red' ?>"><?php echo $value['estado']; ?></span></td>
        <td>
            <div class="col-md-3 col-sm-4 acercar">
                <i class="fa fa-fw fa-eraser deleteVehiculo" data-estado="<?php echo $value['estado']; ?>"
                   data-id="<?php echo $value['id_vehiculo']; ?>" data-R="<?php echo $value['id_r']; ?>" 
                   data-toggle="tooltip" title="Borrar"></i>
                <button type="button" style="display: none" class="btn btn-default" data-toggle="modal" data-target="#modal-default" id="vehiculo<?php echo $value['id_vehiculo']; ?>"/>
            </div>
            <div class="col-md-3 col-sm-4 acercar">
                <i class="fa fa-fw fa-edit updateVehiculo" data-id="<?php echo base64_encode($value['id_vehiculo']); ?>" data-toggle="tooltip" title="Actualizar"></i>
            </div>
            <div class="col-md-3 col-sm-4 acercar">
                <i class="fa fa-fw fa-files-o addDocument" data-id="<?php echo base64_encode($value['id_vehiculo']); ?>" data-toggle="tooltip" title="Agregar Documentos"></i>
            </div>
            <div class="col-md-3 col-sm-4 acercar">
                <i class="fa fa-fw fa-drivers-license addPropietario" 
                   data-id="<?php echo base64_encode($value['id_vehiculo']); ?>" 
                   data-toggle="tooltip" title="Agregar Popietarios"></i>
            </div>
            <div class="col-md-3 col-sm-4 acercar">
                <i class="fa fa-fw fa-eye seeInfo" data-id="<?php echo base64_encode($value['id_vehiculo']); ?>" data-toggle="tooltip" title="Ver"></i>
            </div>
        </td>
    </tr> 
    <?php
}
?>
