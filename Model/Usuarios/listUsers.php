<?php
$con = new BD();
$sql = "SELECT u.*, t.descripcion FROM usuarios u "
        . "inner join tipo_usuario t on t.id_tipo_usuario = u.id_tipo_usuario "
        . "order by documento desc LIMIT 100";


$rs = $con->findAll2($sql);
foreach ($rs as $key => $value) {
    ?>    
    <tr>       
        <td><?php echo $value['documento']; ?></td>
        <td><?php echo $value['nombres']; ?></td>
        <td><?php echo $value['apellidos']; ?></td>
        <td><?php echo $value['descripcion']; ?></td>
        <!--<td><img src="Model/Usuarios/imageProfile.php?id=<?php echo $value['id']; ?>" style="max-width: 40px;border-radius: 10%" alt="User Image"></td>-->                                                
        <td>
            <div class="col-md-3 col-sm-4" style="margin-right: -10%;">
                <i class="fa fa-fw fa-eraser deleteUser" data-id="<?php echo $value['id']; ?>" data-toggle="tooltip" title="Borrar"></i>
                <button type="button" style="display: none" class="btn btn-default" data-toggle="modal" data-target="#modal-default" id="user<?php echo $value['id']; ?>"/>
            </div>
            <div class="col-md-3 col-sm-4">
                <i class="fa fa-fw fa-edit updateUser" data-id="<?php echo base64_encode($value['id']); ?>" data-toggle="tooltip" title="Actualizar"></i>
            </div>
        </td>
    </tr> 
    <?php
}
?>
