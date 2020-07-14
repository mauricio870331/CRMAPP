<?php
//echo "<pre>";
//print_r($_SESSION['obj_user']);
//die;

$con = new BD();
$where = "where asesor = " . $_SESSION['obj_user'][0]['id'];
if ($_SESSION['obj_user'][0]['descripcion'] == 'ADMINISTRADOR') {
    $where = "";
}

if (isset($_POST['field']) && $_POST['field'] != "") {
    
   $pos = strpos($where, "asesor");
   if ($pos === false) {
       $where .= " where (u.nombres like '%" . $field . "%' or u.apellidos like '%" . $field . "%' or u.documento like '%" . $field . "%')";
   }else{
       $where .= " AND (u.nombres like '%" . $field . "%' or u.apellidos like '%" . $field . "%' or u.documento like '%" . $field . "%')";
   }    
   
}


$SQL_SELECT = "SELECT u.*, concat(asesor.nombres, ' ', asesor.apellidos) asesor,"
        . "es.estado estado, si.estado situacion FROM personas u "
        . "inner join estados_personas ep on ep.id_persona = u.id 
                       and ep.fecha_registro = (select MAX(f.fecha_registro) from estados_personas f where f.id_persona = u.id) "
        . "inner join estados es on es.id_estado = ep.id_estado "
        . "inner join situacion_personas sp on sp.id_persona = u.id 
                       and sp.fecha_registro = (select MAX(sf.fecha_registro) from situacion_personas sf where sf.id_persona = u.id) "
        . "inner join situacion si on si.id_situacion = sp.id_situacion  and si.estado = 'CLIENTE' "
        . "left join usuarios asesor on u.asesor = asesor.id " . $where . " order by u.id desc limit 500 ";


$rs = $con->findAll2($SQL_SELECT);

foreach ($rs as $key => $value) {
    ?>    
    <tr>       
        <td><?php echo $value['id']; ?></td>

        <td>
            <span class="label <?php echo ($value['estado'] != "SUSPENDIDO") ? 'label-success' : 'label-danger' ?> " style="margin-right: 2px;">
                <?php echo $value['estado']; ?>                                                           
            </span> 
        </td>
        <!--<td>           
            <span class="label label-success">  
                <?php //echo $value['situacion']; ?>
            </span>
        </td>-->

        <td><?php echo $value['nombres']; ?></td>
        <td><?php echo $value['apellidos']; ?></td>
       
        <td><?php echo $value['telefonos']; ?></td>
        <!--<td><img src="Model/Usuarios/imageProfile.php?id=<?php // echo $value['id']; ?>" style="max-width: 40px;border-radius: 10%" alt="User Image"></td>-->                                                
        <td>
            <div class="col-md-3 col-sm-4" style="margin-right: -3%;">
                <i class="fa fa-fw fa-eye moreinfoLead"  style="color: blue;cursor: pointer" data-id="<?php echo base64_encode($value['ss']); ?>" data-toggle="tooltip" title="Información detallada"></i>
            </div>            
            <?php if ($value['estado'] == "ACTIVO") { ?>
                <div class="col-md-3 col-sm-4">
                    <i class="fa fa-fw fa-edit updateLead" style="cursor: pointer" data-id="<?php echo base64_encode($value['id']); ?>" data-toggle="tooltip" title="Actualizar"></i>
                </div>
            <?php } ?>
            <!--<div class="col-md-3 col-sm-4" style="margin-left: -3%;">
                <?php // if ($value['estado'] == "ACTIVO") { ?>
                    <i class="fa fa-fw fa-warning deleteLead" style="cursor: pointer;color: red;" data-estado="<?php // echo $value['situacion']; ?>" data-option="SUSPENDIDO" data-id="<?php //echo $value['id']; ?>" data-toggle="tooltip" title="Suspender"></i>
                <?php //} else { ?>
                    <i class="fa fa-fw fa-check deleteLead" style="cursor: pointer;color: green;" data-estado="<?php // echo $value['situacion']; ?>" data-option="ACTIVO" data-id="<?php //echo $value['id']; ?>" data-toggle="tooltip" title="Activar"></i>
                <?php // } ?>
                <button type="button" style="display: none" class="btn btn-default" data-toggle="modal" data-target="#modal-default" id="lead<?php //echo $value['id']; ?>"/>
            </div>-->
        </td>
    </tr> 
    <?php
}
?>
