<?php
$con = new BD();
$where = "where creado_por = " . $_SESSION['obj_user'][0]['id'] . " and estado in ('" . base64_decode($_GET['token']) . "')";
if ($_SESSION['obj_user'][0]['descripcion'] == 'ADMINISTRADOR') {
    $where = "where estado in ('" . base64_decode($_GET['token']) . "')";
}
$SQL_SELECT = "select * from notificaciones " . $where . " limit 100";
$rs = $con->findAll2($SQL_SELECT);

foreach ($rs as $key => $value) {
    ?>    
    <tr>
        <td><a class="textoc"><?php echo $value['id_notificacion'] ?></a></td>
        <td><a class="textoc"><?php echo $value['titulo'] ?></a></td>
        <td><a class="textoc"><?php echo $value['detalle'] ?></a></td>
        <td>
            <a class="textoc">
                <?php
                switch ($value['estado']) {
                    case "EJECUTADA":
                        $bg = "bg-green";
                        break;
                    case "PENDIENTE":
                        $bg = "bg-blue";
                        break;
                    case "CANCELADA":
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
            <?php if ($value['estado'] == "PENDIENTE") { ?>

                <div class="col-md-3 col-sm-4" style="margin-right: -5%;">
                    <i class="fa fa-fw fa-check changeStatusNotify" 
                       data-token="<?php echo $_GET['token'] ?>" 
                       data-id="<?php echo $value['id_notificacion'] ?>"
                       data-opction="EJECUTADA"                      
                       data-toggle="tooltip" title="Completar"></i>                                                                        
                </div>

                <div class="col-md-3 col-sm-4" style="margin-right: -5%;">
                    <i class="fa fa-fw fa-close changeStatusNotify" 
                       data-token="<?php echo $_GET['token'] ?>" 
                       data-id="<?php echo $value['id_notificacion'] ?>"
                       data-opction="CANCELADA"
                       data-toggle="tooltip" title="Cancelar"></i>                                                                        
                </div>
            <?php } ?>
        </td>                                                                
    </tr>
    <?php
}
?>
