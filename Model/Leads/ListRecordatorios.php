<?php
//echo "<pre>";
//print_r($_SESSION['obj_user']);
//die;

$con = new BD();
$where = "where _to = " . $_SESSION['obj_user'][0]['id'] . " and estado in ('Pendiente', 'Completado')";
if ($_SESSION['obj_user'][0]['descripcion'] == 'ADMINISTRADOR') {
    $where = "where estado in ('Pendiente', 'Completado')";
}

$SQL_SELECT = "select * from recordatorios " . $where . " limit 100";


$rs = $con->findAll2($SQL_SELECT);



foreach ($rs as $key => $value) {
    ?>    
    <tr>
        <td><a class="textoc"><?php echo $value['id_recordatorio'] ?></a></td>
        <td><a class="textoc"><?php echo $value['descripcion'] ?></a></td>
        <td><a class="textoc"><?php echo $value['vence'] ?></a></td>
        <td>
            <a class="textoc">
                <?php
                switch ($value['estado']) {
                    case "Completado":
                        $bg = "bg-green";
                        break;
                    case "Pendiente":
                        $bg = "bg-blue";
                        break;
                    case "Cancelado":
                        $bg = "bg-red";
                        break;
                }
                ?>
                <span class="pull badge <?php echo $bg; ?>">
                    <?php echo $value['estado'] ?>
                </span>
            </a>
        </td>
        <td>
            <!-- acciones para cambiar estaos --> 
            <?php if ($value['estado'] == "Pendiente") { ?>

                <div class="col-md-3 col-sm-4" style="margin-right: -5%;">
                    <i class="fa fa-fw fa-edit newRecordatorio" data-id="<?php echo $rsRec[$i]['id_recordatorio'] ?>"
                       data-ss="<?php echo base64_decode($_GET['token']) ?>" 
                       data-desc="<?php echo $rsRec[$i]['descripcion'] ?>" data-vence="<?php echo $rsRec[$i]['vence'] ?>"
                       data-option="update" data-toggle="tooltip" title="Editar"></i>
                    <button type="button" style="display: none" class="btn btn-default" data-toggle="modal" data-target="#modal-nota" id="newRemember<?php echo $rsRec[$i]['id_recordatorio'] ?>"/>
                </div>

                <div class="col-md-3 col-sm-4" style="margin-right: -5%;">
                    <i class="fa fa-fw fa-eraser deleteRecordatorio" 
                       data-ss="<?php echo $_GET['token'] ?>" 
                       data-id="<?php echo $rsRec[$i]['id_recordatorio'] ?>"
                       data-toggle="tooltip" title="Borrar"></i>
                    <button type="button" style="display: none" class="btn btn-default" data-toggle="modal" data-target="#modal-deleteRec" id="recId<?php echo $rsRec[$i]['id_recordatorio'] ?>"/>
                </div>

                <div class="col-md-3 col-sm-4" style="margin-right: -5%;">
                    <i class="fa fa-fw fa-check changeStatus" 
                       data-ss="<?php echo $_GET['token'] ?>" 
                       data-id="<?php echo $rsRec[$i]['id_recordatorio'] ?>"
                       data-opction="Completado"
                       data-toggle="tooltip" title="Completar"></i>                                                                        
                </div>

                <div class="col-md-3 col-sm-4" style="margin-right: -5%;">
                    <i class="fa fa-fw fa-close changeStatus" 
                       data-ss="<?php echo $_GET['token'] ?>" 
                       data-id="<?php echo $rsRec[$i]['id_recordatorio'] ?>"
                       data-opction="Cancelado"
                       data-toggle="tooltip" title="Cancelar"></i>                                                                        
                </div>
            <?php } ?>
        </td>                                                                
    </tr>
    <?php
}
?>
