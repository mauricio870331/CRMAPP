<?php
session_start();

/* echo "<pre>";
  print_r($_SESSION['obj_user'][0]['id']);die; */

require '../Model/BD.php';
$con = new BD();
$hoy = date("Y-m-d");
$SQL_SELECT = "SELECT u.*, concat(asesor.nombres, ' ', asesor.apellidos) asesor,"
        . "es.estado estado_lead, si.estado situacion, c.ciudad, sc.estado FROM personas u "
        . "inner join estados_personas ep on ep.id_persona = u.id 
                       and ep.fecha_registro = (select MAX(f.fecha_registro) from estados_personas f where f.id_persona = u.id) "
        . "inner join estados es on es.id_estado = ep.id_estado "
        . "inner join situacion_personas sp on sp.id_persona = u.id 
                       and sp.fecha_registro = (select MAX(sf.fecha_registro) from situacion_personas sf where sf.id_persona = u.id) "
        . "inner join situacion si on si.id_situacion = sp.id_situacion   "
        . "left join usuarios asesor on u.asesor = asesor.id "
        . "inner join ciudad c on c.id = u.id_ciudad "
        . "inner join estado sc on sc.id = u.id_estado where u.ss =" . base64_decode($_GET['token']);
$rsLead = $con->findAll2($SQL_SELECT);


/* $SQL_SELECT_NOTIFY = "select count(id) total from notificacion_personas where documento_persona = '" . base64_decode($_GET['token']) . "'";
  $rsNot = $con->findAll2($SQL_SELECT_NOTIFY); */


$con->desconectar();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link href="../dist/img/Favicon.png" rel="shortcut icon" />
        <title>Perfil del Lead</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.7 -->
        <link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap.min.css">
        <link rel="stylesheet"  href="../bower_components/font-awesome/css/font-awesome.min.css" />
        <link rel="stylesheet" href="../bower_components/Ionicons/css/ionicons.min.css">       
        <link rel="stylesheet" href="../bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
        <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">       
        <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
        <!-- bootstrap datepicker -->
        <link rel="stylesheet" href="../bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
        <link rel="stylesheet" href="../dist/css/mycss.css" /> 
        <!-- Google Font -->
        <link rel="stylesheet" href="../dist/css/AllFonts.css">   
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">        
            <!-- Left side column. contains the sidebar -->
            <!-- Header -->
            <?php include_once '../view_asesor/HeaderAsesor.php'; ?>
            <!-- =============================================== -->          
            <!-- Menu -->
            <?php include_once '../view_asesor/MenuAsesor.php'; ?>
            <!-- =============================================== -->
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Perfil | <button type="button" id="backfromProfile" data-view="asesor" data-user="<?php echo $rsLead[0]['situacion'] ?>" class="btn btn-success">Regresar</button>
                    </h1>                    
                </section>
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-md-3">                          
                            <div class="box box-primary">
                                <div class="box-body box-profile">                            
                                    <h4 class="profile-username text-center" style="font-size: 18px;"><?php echo $rsLead[0]['nombres'] . " " . $rsLead[0]['apellidos'] ?></h4>
                                    <!-- Mostrar solo 22 caracteres -->
                                    <p class="text-muted text-center"> 
                                        <?php echo $rsLead[0]['situacion']; ?> #
                                        <span class="label label-success">  
                                            <?php echo $rsLead[0]['id']; ?>
                                        </span>
                                    </p>
                                    <ul class="list-group list-group-unbordered">
                                        <li class="list-group-item">
                                            <b>S. Social</b> <a class="pull-right textoc"><?php echo $rsLead[0]['ss'] ?></a>
                                        </li>  
                                        <li class="list-group-item">
                                            <b>Telefonos</b> 
                                            <ul>
                                                <?php
                                                $tels = explode(",", $rsLead[0]['telefonos']);
                                                for ($i = 0; $i < count($tels); $i++) {
                                                    ?>
                                                    <li>
                                                        <a class="pull-right textoc"><?php echo $tels[$i]; ?></a>
                                                    </li>
                                                <?php } ?>
                                            </ul>
                                        </li> 
                                    </ul>  
                                </div>
                                <!-- /.box-body -->
                            </div>
                            <!-- /.box -->
                            <!-- About Me Box -->
                            <div class="box box-primary">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Estado</h3>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <strong><i class="fa fa-book margin-r-5"></i>Estado:</strong>
                                    <p class="text-muted">
                                        <span class="pull badge bg-green" style="font-size: 15px;margin-left: 8%;"><?php echo $rsLead[0]['estado_lead'] ?></span>
                                    </p>                                      
                                </div>
                                <!-- /.box-body -->
                            </div>
                            <!-- /.box -->
                        </div>
                        <!-- /.col -->
                        <div class="col-md-9">
                            <div class="nav-tabs-custom">
                                <ul class="nav nav-tabs">
                                    <li id="tabTimeline" class="active"><a href="#timeline" data-toggle="tab">Datos personales</a></li>
                                    <?php // if ($_SESSION['obj_user'][0]['descripcion'] == "ADMINISTRADOR") { ?> 
                                    <li id="tabDocs"><a href="#docs" data-toggle="tab">Documentos</a></li>  
                                    <?php //} ?>                         
                                    <li id="tabProduct"><a href="#producto" data-toggle="tab">Productos</a></li> 
                                    <li id="tabAdjuntos"><a href="#adjuntos" data-toggle="tab">Adjuntos</a></li>  
                                    <li id="tabNotas"><a href="#notas" data-toggle="tab">Notas</a></li> 
                                    <li id="tabRecordatorios"><a href="#recordatorios" data-toggle="tab">Recordatorios</a></li> 

                                </ul>
                                <div class="tab-content">
                                    <div class="active tab-pane" id="timeline">
                                        <!-- The timeline -->
                                        <ul class="timeline timeline-inverse">                                           
                                            <!-- timeline item -->
                                            <li>
                                                <i class="fa fa-user bg-aqua"></i>
                                                <div class="timeline-item">                                                   
                                                    <h3 class="timeline-header"><a href="#">Datos Personales</a></h3>
                                                    <div class="timeline-body">
                                                        <ul>
                                                            <li class="separated"><b>Fecha de Nacimiento:</b><a href="#" class="textop"> <?php echo $rsLead[0]['dob'] ?></a></li>
                                                            <li class="separated"><b>Seguro Social:</b> <a href="#" class="textop"><?php echo $rsLead[0]['ss'] ?></a></li>
                                                            <li class="separated"><b>Nombres:</b> <a href="#" class="textop"> <?php echo $rsLead[0]['nombres'] ?></a></li>
                                                            <li class="separated"><b>Apellidos:</b> <a href="#" class="textop"> <?php echo $rsLead[0]['apellidos'] ?></a></li>

                                                        </ul>
                                                    </div>
                                                </div>
                                            </li>
                                            <!-- END timeline item -->
                                            <!-- timeline item -->
                                            <li>
                                                <i class="fa fa-envelope bg-blue"></i>
                                                <div class="timeline-item">                                                   
                                                    <h3 class="timeline-header"><a href="#">Datos de Contacto</a></h3>
                                                    <div class="timeline-body">
                                                        <ul>
                                                            <li class="separated"><b>Dirección:</b> <a href="#" class="textop"> <?php echo $rsLead[0]['direccion'] ?></a></li>
                                                            <li class="separated"><b>Telefonos:</b> <a href="#" class="textop"> <?php echo $rsLead[0]['telefonos'] ?></a></li>
                                                            <li class="separated"><b>Email:</b> <a href="#" class="textop"> <?php echo $rsLead[0]['email'] ?></a></li>
                                                            <li class="separated"><b>Ciudad:</b> <a href="#" class="textop"> <?php echo $rsLead[0]['ciudad'] ?></a></li>
                                                            <li class="separated"><b>Estado:</b> <a href="#" class="textop"> <?php echo $rsLead[0]['estado'] ?></a></li>
                                                        </ul>
                                                    </div>                                                    
                                                </div>
                                            </li>
                                            <!-- END timeline item -->   
                                        </ul>
                                    </div>
                                    <!-- /.tab-pane -->
                                    <div class="tab-pane" id="docs">                                        
                                        <!-- /.box-header -->
                                        <div>
                                            <!--<i class="fa fa-fw fa-plus-circle newDocument" data-option="documento"  style="color: #008d4c;cursor: pointer;font-size: 20px;" data-id="<?php echo $rsLead[0]['ss']; ?>" data-toggle="tooltip" title="Nuevo Documento"></i>
                                            <button type="button" style="display: none" class="btn btn-default" data-toggle="modal" data-target="#modal-default" id="newDoc<?php echo $rsLead[0]['ss']; ?>"/>
                                            -->                 
                                            <span class="pull badge bg-green sendPresentation" 
                                                  data-ss="<?php echo $rsLead[0]['ss'] ?>"
                                                  data-email="<?php echo $rsLead[0]['email'] ?>"
                                                  data-name="<?php echo $rsLead[0]['nombres'] . " " . $rsLead[0]['apellidos'] ?>"                                                  
                                                  style="font-size: 15px;cursor: pointer;margin-bottom: 5px;">Enviar Carta de Presentación</span>
                                        </div>
                                        <div class="box">                                            
                                            <div class="box-body">
                                                <table id="example1" class="table table-bordered table-striped table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Descripcion</th>
                                                            <th>Documento</th>
                                                            <th>Fecha Registro</th>    
                                                            <th>Acciones</th>    
                                                        </tr>
                                                    </thead>
                                                    <tbody>  
                                                        <?php
                                                        $con = new BD();
                                                        $SQL_SELECT = "SELECT * from documentos where ss_persona ='" . base64_decode($_GET['token']) . "'";

                                                        $rsDocs = $con->findAll2($SQL_SELECT);
                                                        $con->desconectar();
                                                        ?>
                                                        <?php for ($i = 0; $i < count($rsDocs); $i++) { ?>
                                                            <tr>
                                                                <td><a class="textoc"><?php echo $rsDocs[$i]['id_documento'] ?></a></td>
                                                                <td><a class="textoc"><?php echo $rsDocs[$i]['descripcion'] ?></a></td>
                                                                <td><a class="textoc" target="_blank" href="<?php echo $rsDocs[$i]['ruta'] . $rsDocs[$i]['nombre_archivo'] ?>" ><?php echo $rsDocs[$i]['nombre_archivo'] ?></a></td>
                                                                <td><a class="textoc"><?php echo $rsDocs[$i]['fecha_registro'] ?></a></td>
                                                                <td>
                                                                    <div class="col-md-3 col-sm-4" style="margin-right: -5%;">
                                                                        <i class="fa fa-fw fa-eraser deleteDoc" data-opcion="documento" data-ssocial="<?php echo $_GET['token'] ?>" data-id="<?php echo $rsDocs[$i]['id_documento']; ?>" data-toggle="tooltip" title="Borrar"></i>
                                                                        <button type="button" style="display: none" class="btn btn-default" data-toggle="modal" data-target="#modal-deleteDoc" id="docId<?php echo $rsDocs[$i]['id_documento'] ?>"/>
                                                                    </div>
                                                                </td>                                                                
                                                            </tr>
                                                        <?php } ?>
                                                    </tbody>                                               
                                                </table> 
                                            </div>
                                            <!-- /.box-body -->
                                        </div>
                                        <!-- /.tab-pane -->      
                                    </div>
                                    <!-- /.tab-content -->

                                    <div class="tab-pane" id="producto">                                        
                                        <?php
                                        $con = new BD();
                                        $SQL_SELECT = "SELECT p.*, tc.descripcion tipo_cuenta, tp.nombre "
                                                . "from producto p "
                                                . "inner join tipo_cuenta tc on tc.id_tipo_cuenta = p.id_tipo_cuenta "
                                                . "inner join tipo_producto tp on tp.id_tipo_producto = p.id_tipo_producto "
                                                . "where p.ss_persona = '" . base64_decode($_GET['token']) . "'";
                                        $rsProd = $con->findAll2($SQL_SELECT);
                                        for ($i = 0; $i < count($rsProd); $i++) {
                                            $SQL_SELECT_DETALLE = "SELECT pp.id_pago, pp.numero_cuota,"
                                                    . "pp.valor_cuota, pp.fecha_pago, ep.codigo, ep.descripcion, tc.descripcion tipo_cuenta,"
                                                    . " tp.nombre from pagos_producto pp "
                                                    . "inner join producto p on p.id_producto = pp.id_producto "
                                                    . "inner join estados_de_pago ep on ep.id_estado_pago = pp.id_estado_pago "
                                                    . "inner join tipo_cuenta tc on tc.id_tipo_cuenta = p.id_tipo_cuenta "
                                                    . "inner join tipo_producto tp on tp.id_tipo_producto = p.id_tipo_producto "
                                                    . "where p.ss_persona = '" . $rsProd[$i]['ss_persona'] . "' "
                                                    . "and p.id_producto = " . $rsProd[$i]['id_producto'] . "";
                                            $rsProdDetail = $con->findAll2($SQL_SELECT_DETALLE);
                                            $rsProd[$i]["detalle_producto"] = $rsProdDetail;
                                        }

//                                        echo "<pre>";
//                                        print_r($rsProd);
//                                        die;

                                        $con->desconectar();
                                        ?>
                                        <div>
                                            <i class="fa fa-fw fa-plus-circle newProduct"  style="color: #008d4c;cursor: pointer;font-size: 20px;" data-id="<?php echo $rsLead[0]['ss']; ?>" data-toggle="tooltip" title="Nuevo Producto"></i>
                                            <button type="button" style="display: none" class="btn btn-default" data-toggle="modal" data-target="#modal-NewProduct" id="newProduct<?php echo $rsLead[0]['ss']; ?>"/>
                                        </div>
                                        <div class="titleProduc">
                                            <h4>Listado de Productos</h4>
                                        </div>
                                        <div class="box">                                        
                                            <div class="box-body">
                                                <table id="tbl_producto" class="table table-bordered table-striped table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th>Producto</th>
                                                            <th>Banco</th>
                                                            <th>Tipo de Cuenta</th>
                                                            <th>Ruta</th>    
                                                            <th>Cuenta</th>  
                                                            <th>Valor Total</th>  
                                                            <th>Titular</th>  
                                                        </tr>
                                                    </thead>
                                                    <tbody> 
                                                        <?php for ($i = 0; $i < count($rsProd); $i++) { ?>
                                                            <tr>
                                                                <td><a class="textoc"><?php echo $rsProd[$i]['nombre'] ?></a></td>
                                                                <td><a class="textoc"><?php echo $rsProd[$i]['banco']; ?></a></td>
                                                                <td><a class="textoc"><?php echo $rsProd[$i]['tipo_cuenta'] ?></a></td>
                                                                <td><a class="textoc"><?php echo $rsProd[$i]['numero_ruta'] ?></a></td>
                                                                <td><a class="textoc"><?php echo $rsProd[$i]['numero_cuenta'] ?></a></td>
                                                                <td><a class="textoc"><?php echo "$" . number_format($rsProd[$i]['valor'], 0, ",", ".") ?></a></td>
                                                                <td>
                                                                    <a class="textoc">
                                                                        <i class="fa fa-fw fa-eye" style="color: #008d4c;cursor: pointer;font-size: 15px;" 
                                                                           data-toggle="tooltip" title="<?php echo $rsProd[$i]['titular'] ?>"></i>                                                                       
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="7">
                                                                    <!-- Inicio acorderod -->
                                                                    <div style="width: 100%;">
                                                                        <div class="box box-default collapsed-box">
                                                                            <div class="box-header with-border">
                                                                                <span>Detalle Producto | Titular : <a class="textoc"><?php echo $rsProd[$i]['titular'] ?> </a></span>
                                                                                <div class="box-tools pull-right">
                                                                                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                                                                                    </button>
                                                                                </div>
                                                                                <!-- /.box-tools -->
                                                                            </div>
                                                                            <!-- /.box-header -->
                                                                            <div class="box-body">
                                                                                <table id="example3" class="table table-bordered table-striped table-hover">
                                                                                    <thead>
                                                                                        <tr>
                                                                                            <th># Cuota</th>
                                                                                            <th>Valor Cuota</th>                                                                                            
                                                                                            <th>Fecha Pago</th>  
                                                                                            <th>Estado</th>
                                                                                        </tr>
                                                                                    </thead>
                                                                                    <tbody> 
                                                                                        <?php
                                                                                        for ($j = 0; $j < count($rsProd[$i]["detalle_producto"]); $j++) {
                                                                                            ?>
                                                                                            <tr>
                                                                                                <td><a class="textoc"><?php echo $rsProd[$i]["detalle_producto"][$j]['numero_cuota'] ?></a></td>
                                                                                                <td><a class="textoc"><?php echo "$ " . number_format($rsProd[$i]["detalle_producto"][$j]['valor_cuota'], 0, ",", ".") ?></a></td>
                                                                                                <td><a class="textoc"><?php echo $rsProd[$i]["detalle_producto"][$j]['fecha_pago'] ?></a></td>
                                                                                                <td>
                                                                                                    <a class="textoc" data-toggle="tooltip" title="<?php echo $rsProd[$i]["detalle_producto"][$j]['descripcion'] ?>">
                                                                                                        <span class="label label-warning up">  
                                                                                                            <?php echo $rsProd[$i]["detalle_producto"][$j]['codigo'] ?>
                                                                                                        </span>
                                                                                                    </a>
                                                                                                </td>
                                                                                            </tr>
                                                                                        <?php } ?>
                                                                                    </tbody>                                               
                                                                                </table> 
                                                                            </div>
                                                                            <!-- /.box-body -->
                                                                        </div>
                                                                        <!-- /.box -->
                                                                    </div>
                                                                    <!-- Fin acorderon --> 
                                                                </td>
                                                            </tr>   
                                                            <tr>
                                                                <td colspan="7">
                                                                    <div style="border: 1px solid #8eafaf;margin-top: -25px;"></div>
                                                                </td>
                                                            </tr>
                                                        <?php } ?>
                                                    </tbody>                                               
                                                </table> 
                                            </div>
                                            <!-- /.box-body -->
                                        </div>
                                        <!-- /.tab-pane -->      
                                    </div>
                                    <!-- /.tab-content -->

                                    <div class="tab-pane" id="adjuntos">                                        
                                        <!-- /.box-header -->
                                        <div>
                                            <i class="fa fa-fw fa-plus-circle newDocument"  style="color: #008d4c;cursor: pointer;font-size: 20px;"
                                               data-id="<?php echo $rsLead[0]['ss']; ?>" data-option="adjunto" data-toggle="tooltip" title="Nuevo Adjunto"></i>
                                            <button type="button" style="display: none" class="btn btn-default" data-toggle="modal" data-target="#modal-default" id="newDoc<?php echo $rsLead[0]['ss']; ?>"/>
                                        </div>
                                        <div class="box">                                            
                                            <div class="box-body">
                                                <table id="tbl_adjuntos" class="table table-bordered table-striped table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Descripcion</th>
                                                            <th>Documento</th>
                                                            <th>Fecha Registro</th>    
                                                            <th>Acciones</th>    
                                                        </tr>
                                                    </thead>
                                                    <tbody>  
                                                        <?php
                                                        $con = new BD();
                                                        $SQL_SELECT = "SELECT * from adjuntos where ss_persona =" . base64_decode($_GET['token']);
                                                        $rsDocs = $con->findAll2($SQL_SELECT);
                                                        $con->desconectar();
                                                        ?>
                                                        <?php for ($i = 0; $i < count($rsDocs); $i++) { ?>
                                                            <tr>
                                                                <td><a class="textoc"><?php echo $rsDocs[$i]['id_adjunto'] ?></a></td>
                                                                <td><a class="textoc"><?php echo $rsDocs[$i]['descripcion'] ?></a></td>
                                                                <td><a class="textoc" target="_blank" href="<?php echo $rsDocs[$i]['ruta'] . $rsDocs[$i]['nombre_archivo'] ?>" ><?php echo $rsDocs[$i]['nombre_archivo'] ?></a></td>
                                                                <td><a class="textoc"><?php echo $rsDocs[$i]['fecha_registro'] ?></a></td>
                                                                <td>
                                                                    <div class="col-md-3 col-sm-4" style="margin-right: -5%;">
                                                                        <i class="fa fa-fw fa-eraser deleteDoc" data-ssocial="<?php echo $_GET['token'] ?>" data-id="<?php echo $rsDocs[$i]['id_adjunto']; ?>"
                                                                           data-opcion="adjunto" data-toggle="tooltip" title="Borrar"></i>
                                                                        <button type="button" style="display: none" class="btn btn-default" data-toggle="modal" data-target="#modal-deleteDoc" id="docId<?php echo $rsDocs[$i]['id_adjunto'] ?>"/>
                                                                    </div>
                                                                </td>                                                                
                                                            </tr>
                                                        <?php } ?>
                                                    </tbody>                                               
                                                </table> 
                                            </div>
                                            <!-- /.box-body -->
                                        </div>
                                        <!-- /.tab-pane -->      
                                    </div>
                                    <!-- /.tab-content -->

                                    <div class="tab-pane" id="notas">                                        
                                        <!-- /.box-header -->
                                        <div>
                                            <i class="fa fa-fw fa-plus-circle newNota"  style="color: #008d4c;cursor: pointer;font-size: 20px;"
                                               data-ss="<?php echo $rsLead[0]['ss']; ?>" data-option="add" data-toggle="tooltip" title="Nueva Nota"></i>
                                            <button type="button" style="display: none" class="btn btn-default" data-toggle="modal" data-target="#modal-nota" id="newNota<?php echo $rsLead[0]['ss']; ?>"/>
                                        </div>
                                        <div class="box">                                            
                                            <div class="box-body">
                                                <table id="tbl_notas" class="table table-bordered table-striped table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Titulo</th>
                                                            <th>Descripicon</th>
                                                            <th>Fecha Registro</th>    
                                                            <th>Acciones</th>    
                                                        </tr>
                                                    </thead>
                                                    <tbody>  
                                                        <?php
                                                        $con = new BD();
                                                        $SQL_SELECT = "SELECT * from notas where ss_persona =" . base64_decode($_GET['token']);
                                                        $rsDocs = $con->findAll2($SQL_SELECT);
                                                        $con->desconectar();
                                                        ?>
                                                        <?php for ($i = 0; $i < count($rsDocs); $i++) { ?>
                                                            <tr>
                                                                <td><a class="textoc"><?php echo $rsDocs[$i]['id_nota'] ?></a></td>
                                                                <td><a class="textoc"><?php echo $rsDocs[$i]['titulo'] ?></a></td>
                                                                <td><a class="textoc"><?php echo $rsDocs[$i]['descripcion'] ?></a></td>
                                                                <td><a class="textoc"><?php echo $rsDocs[$i]['fecha_registro'] ?></a></td>
                                                                <td>
                                                                    <?php if ($rsDocs[$i]['creado_por'] == $_SESSION['obj_user'][0]['id']) { ?>
                                                                        <div class="col-md-3 col-sm-4" style="margin-right: -5%;">
                                                                            <i class="fa fa-fw fa-edit newNota" data-id="<?php echo $rsDocs[$i]['id_nota'] ?>"
                                                                               data-ss="<?php echo $rsDocs[$i]['ss_persona'] ?>" 
                                                                               data-titulo="<?php echo $rsDocs[$i]['titulo'] ?>" data-desc="<?php echo $rsDocs[$i]['descripcion'] ?>"
                                                                               data-option="update" data-toggle="tooltip" title="Editar"></i>
                                                                            <button type="button" style="display: none" class="btn btn-default" data-toggle="modal" data-target="#modal-nota" id="newNota<?php echo $rsDocs[$i]['id_nota'] ?>"/>
                                                                        </div>
                                                                    <?php } ?>

                                                                    <div class="col-md-3 col-sm-4" style="margin-right: -5%;">
                                                                        <i class="fa fa-fw fa-eraser deleteNota" data-ss="<?php echo $_GET['token'] ?>" data-id="<?php echo $rsDocs[$i]['id_nota'] ?>"
                                                                           data-toggle="tooltip" title="Borrar"></i>
                                                                        <button type="button" style="display: none" class="btn btn-default" data-toggle="modal" data-target="#modal-deleteNota" id="notaId<?php echo $rsDocs[$i]['id_nota'] ?>"/>
                                                                    </div>
                                                                </td>                                                                
                                                            </tr>
                                                        <?php } ?>
                                                    </tbody>                                               
                                                </table> 
                                            </div>
                                            <!-- /.box-body -->
                                        </div>
                                        <!-- /.tab-pane -->      
                                    </div>
                                    <!-- /.tab-content -->


                                    <div class="tab-pane" id="recordatorios">                                        
                                        <!-- /.box-header -->
                                        <div>
                                            <i class="fa fa-fw fa-plus-circle newRecordatorio"  style="color: #008d4c;cursor: pointer;font-size: 20px;"
                                               data-ss="<?php echo $rsLead[0]['ss']; ?>" 
                                               data-option="add" data-toggle="tooltip" 
                                               title="Nueva Recordatorio"></i>
                                            <button type="button" style="display: none" class="btn btn-default" data-toggle="modal" data-target="#modal-recordatorio" id="newRemember<?php echo $rsLead[0]['ss']; ?>"/>
                                        </div>
                                        <div class="box">                                            
                                            <div class="box-body">
                                                <table id="tbl_recordatorio" class="table table-bordered table-striped table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Descripcion</th>
                                                            <th>Vence</th>
                                                            <th>Estado</th>    
                                                            <th>Acciones</th>    
                                                        </tr>
                                                    </thead>
                                                    <tbody>  
                                                        <?php
                                                        $con = new BD();
                                                        $SQL_SELECT = "SELECT * from recordatorios where ss_persona = '" . base64_decode($_GET['token']) . "' "
                                                                . " and _to in (" . $_SESSION['obj_user'][0]['id'] . ", 0)";
                                                        $rsRec = $con->findAll2($SQL_SELECT);
                                                        $con->desconectar();
                                                        ?>
                                                        <?php for ($i = 0; $i < count($rsRec); $i++) { ?>
                                                            <tr>
                                                                <td><a class="textoc"><?php echo $rsRec[$i]['id_recordatorio'] ?></a></td>
                                                                <td><a class="textoc"><?php echo $rsRec[$i]['descripcion'] ?></a></td>
                                                                <td><a class="textoc"><?php echo $rsRec[$i]['vence'] ?></a></td>
                                                                <td>
                                                                    <a class="textoc">
                                                                        <?php
                                                                        $estado = $rsRec[$i]['estado'];
                                                                        switch ($rsRec[$i]['estado']) {
                                                                            case "Completado":
                                                                                $bg = "bg-green";
                                                                                break;
                                                                            case "Completado_to"://                                                                              
                                                                                $elements = explode(",", $rsRec[$i]["complete_to"]);
                                                                                if (in_array($_SESSION['obj_user'][0]['id'], $elements)) {
                                                                                    $bg = "bg-green";
                                                                                    $estado = "Completado";
                                                                                } else {
                                                                                    $bg = "bg-blue";
                                                                                    $estado = "Pendiente";
                                                                                }
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
                                                                            <?php echo $estado ?>
                                                                        </span>
                                                                    </a>
                                                                </td>
                                                                <td>

                                                                    <!-- acciones para cambiar estaos --> 
                                                                    <?php if ($estado == "Pendiente") { ?>

                                                                        <div class="col-md-3 col-sm-4" style="margin-right: -5%;">
                                                                            <i class="fa fa-fw fa-check changeStatus" 
                                                                               data-ss="<?php echo $_GET['token'] ?>" 
                                                                               data-id="<?php echo $rsRec[$i]['id_recordatorio'] ?>"
                                                                               data-opction="Completado"
                                                                               data-toggle="tooltip" title="Completar"></i>                                                                        
                                                                        </div>

                                                                        <?php if ($rsRec[$i]['_to'] != 0) { ?>

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
                                                                                <i class="fa fa-fw fa-close changeStatus" 
                                                                                   data-ss="<?php echo $_GET['token'] ?>" 
                                                                                   data-id="<?php echo $rsRec[$i]['id_recordatorio'] ?>"
                                                                                   data-opction="Cancelado"
                                                                                   data-toggle="tooltip" title="Cancelar"></i>                                                                        
                                                                            </div>
                                                                        <?php } ?>
                                                                    <?php } ?>




                                                                </td>                                                                
                                                            </tr>
                                                        <?php } ?>
                                                    </tbody>                                               
                                                </table> 
                                            </div>
                                            <!-- /.box-body -->
                                        </div>
                                        <!-- /.tab-pane -->      
                                    </div>
                                    <!-- /.tab-content -->

                                </div>
                                <!-- /.nav-tabs-custom -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                </section>
                <!-- /.content -->
                <!-- Modales -->
                <div class="modal fade" id="modal-default">
                    <div class="modal-dialog">
                        <div class="modal-content" style="width: 85%;margin-left: 12%">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Formulario Adjuntar Documentos</h4>
                            </div>
                            <div class="modal-body">
                                <form role="form">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="descripcion">Descripción</label>
                                            <input type="text" class="form-control" id="descripcion" placeholder="Ingrese Descripción">
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputFile">Seleccionar Documento</label>
                                            <input type="file" id="exampleInputFile" accept=".jpg,.png,.doc,.docx,.xsl,.xslx,.pdf">
                                        </div>
                                    </div>
                                </form>
                                <div class="modal-footer">
                                    <button type="button"  class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                    <button type="button" id="addDocument" data-id="" data-option=""  class="btn btn-primary">Guardar</button>
                                </div>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>
                    <!-- /.modal -->
                </div>

                <!-- Modal nuevo Notas --> 
                <div class="modal fade" id="modal-nota">
                    <div class="modal-dialog">
                        <div class="modal-content" style="width: 85%;margin-left: 12%">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Formulario Nueva Nota</h4>
                            </div>
                            <div class="modal-body">
                                <form role="form">
                                    <div class="box-body">

                                        <div class="form-group">
                                            <label for="titulo">Titulo</label>
                                            <input type="text" class="form-control" id="titulo" disabled="disabled" value="Seguimiento de Venta" placeholder="Ingrese Titulo">
                                        </div>

                                        <div class="form-group">
                                            <label for="txtDescripcion">Descripción</label>
                                            <textarea class="form-control" id="txtDescripcion" placeholder="Ingrese Descripción"></textarea>
                                        </div>


                                    </div>
                                </form>
                                <div class="modal-footer">
                                    <button type="button"  class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                    <button type="button" id="addNota" data-id="" data-option="" data-ss="" class="btn btn-primary">Guardar</button>
                                </div>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>
                    <!-- /.modal -->
                </div>

                <!-- Modal nrecordatorio -->
                <div class="modal fade" id="modal-recordatorio">
                    <div class="modal-dialog">
                        <div class="modal-content" style="width: 85%;margin-left: 12%">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Formulario Nuevo Recordatorio</h4>
                            </div>
                            <div class="modal-body">
                                <form role="form">
                                    <div class="box-body">


                                        <div class="form-group">
                                            <label for="_to">Para</label>
                                            <select class="form-control" name="_to" id="_to">
                                                <option value="">Seleccione</option>
                                                <?php
                                                $con = new BD();
                                                $SQL_SELECT = "SELECT id, concat(nombres,' ',apellidos) nombre FROM usuarios where id != " . $_SESSION['obj_user'][0]['id'];
                                                $list = $con->query($SQL_SELECT);
                                                $con->desconectar();
                                                for ($index = 0; $index < count($list); $index++) {
                                                    ?>
                                                    <option value="<?php echo $list[$index]['id']; ?>"><?php echo $list[$index]['nombre']; ?></option>
                                                    <?php
                                                }
                                                ?> 
                                            </select>
                                        </div>


                                        <div class="form-group">
                                            <label for="txtDesc">Descripción</label>
                                            <textarea class="form-control" id="txtDesc" placeholder="Ingrese Descripción"></textarea>
                                        </div>

                                        <div class="form-group">
                                            <label for="vence">*Vence</label>
                                            <div class="input-group date">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                                <input type="text" class="form-control pull-right" id="vence" value="<?php echo $hoy; ?>"/>
                                            </div>                                           
                                            <!-- /.input group -->
                                        </div> 


                                    </div>
                                </form>
                                <div class="modal-footer">
                                    <button type="button"  class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                    <button type="button" id="addRecordatorio" data-id="" data-option="" data-ss="" class="btn btn-primary">Guardar</button>
                                </div>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>
                    <!-- /.modal -->
                </div>

                <!-- Modal nuevo producto -->
                <div class="modal fade" id="modal-NewProduct">
                    <div class="modal-dialog">
                        <div class="modal-content" style="width: 100%;">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Formulario Crear Producto</h4>
                            </div>
                            <div class="modal-body">
                                <form class="form-horizontal">

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Producto</label>
                                        <div class="col-sm-8">
                                            <select class="form-control" name="tipo_producto" id="tipo_producto">
                                                <option value="">Seleccione</option>
                                                <?php
                                                $con = new BD();
                                                $SQL_SELECT = "SELECT id_tipo_producto, nombre FROM tipo_producto";
                                                $list = $con->query($SQL_SELECT);
                                                $con->desconectar();
                                                for ($index = 0; $index < count($list); $index++) {
                                                    ?>
                                                    <option value="<?php echo $list[$index]['id_tipo_producto']; ?>"><?php echo $list[$index]['nombre']; ?></option>
                                                    <?php
                                                }
                                                ?> 
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="banco" class="col-sm-3 control-label">Banco</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="banco" placeholder="Banco">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="titular" class="col-sm-3 control-label">Titular</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="titular" value="" placeholder="<?php echo $rsLead[0]['nombres'] . " " . $rsLead[0]['apellidos'] ?>">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Tipo Cuenta</label>
                                        <div class="col-sm-8">
                                            <select class="form-control" name="tipo_cuenta" id="tipo_cuenta">
                                                <option value="">Seleccione</option>
                                                <?php
                                                $con = new BD();
                                                $SQL_SELECT = "SELECT id_tipo_cuenta, descripcion FROM tipo_cuenta";
                                                $list = $con->query($SQL_SELECT);
                                                $con->desconectar();
                                                for ($index = 0; $index < count($list); $index++) {
                                                    ?>
                                                    <option value="<?php echo $list[$index]['id_tipo_cuenta']; ?>"><?php echo $list[$index]['descripcion']; ?></option>
                                                    <?php
                                                }
                                                ?> 
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="ruta" class="col-sm-3 control-label">No. Ruta</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="ruta" placeholder="Numero de Ruta">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="cuenta" class="col-sm-3 control-label">No. Cuenta</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="cuenta" placeholder="Numero de Cuenta">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="valor" class="col-sm-3 control-label">Valor Total</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="valor" placeholder="Valor Total">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="cuotas" class="col-sm-3 control-label">No. Cuotas</label>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control" id="cuotas" disabled="true" placeholder="Numero de Cuotas">
                                        </div>
                                        <div class="col-sm-1" style="padding-top: 8px;">
                                            <i class="fa fa-fw fa-plus-circle infoProdut"  style="color: #008d4c;cursor: pointer;font-size: 20px;" data-id="<?php echo $rsLead[0]['ss']; ?>" data-toggle="tooltip" title="Nueva Cuota"></i>
                                            <button type="button" style="display: none" class="btn btn-default" data-toggle="modal" data-target="#modal-infoProduct" id="infoProdut<?php echo $rsLead[0]['ss']; ?>"/>
                                        </div>
                                    </div>

                                </form>
                                <div class="modal-footer">
                                    <button type="button"  class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                    <button type="button" id="newProduct" data-id=""  class="btn btn-primary">Guardar</button>
                                </div>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>
                    <!-- /.modal -->
                </div>


                <div class="modal fade" id="modal-deleteDoc">
                    <div class="modal-dialog">
                        <div class="modal-content" style="width: 60%;margin-left: 28%">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Confirmación</h4>
                            </div>
                            <div class="modal-body">
                                <p>Esta seguro de eliminar el documento seleccionado?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button"  class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                                <button type="button" id="deleteDoc" data-id="" data-option="" data-ss=""   class="btn btn-primary">Eliminar</button>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->

                <div class="modal fade" id="modal-deleteNota">
                    <div class="modal-dialog">
                        <div class="modal-content" style="width: 60%;margin-left: 28%">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Confirmación</h4>
                            </div>
                            <div class="modal-body">
                                <p>Esta seguro de eliminar la nota seleccionada?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button"  class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                                <button type="button" id="deleteNota" data-id=""  data-ss=""   class="btn btn-primary">Eliminar</button>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->


                <div class="modal fade" id="modal-deleteRec">
                    <div class="modal-dialog">
                        <div class="modal-content" style="width: 60%;margin-left: 28%">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Confirmación</h4>
                            </div>
                            <div class="modal-body">
                                <p>Esta seguro de eliminar el recordatorio?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button"  class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                                <button type="button" id="deleteRec" data-id=""  data-ss=""   class="btn btn-primary">Eliminar</button>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->


                <!-- Modal mor info product -->
                <div class="modal fade" id="modal-infoProduct">
                    <div class="modal-dialog">
                        <div class="modal-content" style="width: 100%;height: 50%">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                <h5 class="modal-title"><b>Agregar Cuotas</b></h5>
                            </div>
                            <div class="modal-body" id="detail_product"> 
                                <div class="box box-primary">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">Los campos marcados con (*) son obligatorios.</h3>
                                    </div>
                                    <!-- /.box-header -->
                                    <!-- form start -->
                                    <form role="form">
                                        <div class="box-body">

                                            <div class="form-group">
                                                <label>*Fecha de Pago</label>
                                                <div class="input-group date">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </div>
                                                    <input type="text" class="form-control pull-right" id="fecha_pago" value="<?php echo $hoy; ?>"/>
                                                </div>                                           
                                                <!-- /.input group -->
                                            </div>                                                                                   

                                            <div class="form-group">
                                                <label for="valor_cuota">*Valor</label>
                                                <input type="text" class="form-control" id="valor_cuota" placeholder="Ingrese Valor">
                                            </div>                                  

                                        </div>                                        
                                    </form>
                                </div>
                                <div style="overflow-x:hidden;overflow-y:visible;height:150px;">
                                    <table id="example4" class="table table-bordered table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th># Cuota</th>
                                                <th>Valor Cuota</th>                                            
                                                <th>Fecha Pago</th>  
                                                <th>Acción</th>  
                                            </tr>
                                        </thead>
                                        <tbody id="content_cuotas">                                       

                                        </tbody>                                               
                                    </table> 
                                </div>
                                <label>Total:</label>
                                <label id="tot_deuda"></label>
                            </div>
                            <div class="modal-footer">
                                <button type="button" id="endAddCuota"  class="btn btn-default">Terminar</button>
                                <input type="hidden" id="close" data-dismiss="modal" />
                                <button type="button" id="newCuota" data-id=""  class="btn btn-primary">Añadir</button>                 
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->
            </div>
            <!-- /.content-wrapper -->
            <?php include_once '../view_asesor/FooterASesor.php'; ?>       
        </div>
        <!-- ./wrapper -->
        <!-- jQuery 3 -->
        <script src="../bower_components/jquery/dist/jquery.min.js"></script>
        <!-- Bootstrap 3.3.7 -->
        <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
        <!-- DataTables -->
        <script src="../bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="../bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
        <!-- SlimScroll -->
        <script src="../bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
        <!-- FastClick -->
        <script src="../bower_components/fastclick/lib/fastclick.js"></script>
        <!-- bootstrap datepicker -->
        <script src="../bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
        <!-- AdminLTE App -->
        <script src="../dist/js/adminlte.min.js"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="../dist/js/demo.js"></script>
        <script src="../dist/js/notify.js" type="text/javascript"></script>
        <script src="../dist/js/funciones_leads.js"></script>
        <!-- page script -->
        <script>

            $(function () {
                $('#example1').DataTable();
                $('#tbl_producto').DataTable();
                $('#tbl_adjuntos').DataTable();
                $('#tbl_notas').DataTable();
                $('#tbl_recordatorio').DataTable();

                $('#fecha_pago').datepicker({
                    autoclose: true,
                    format: 'yyyy-mm-dd'
                })

                $('#vence').datepicker({
                    autoclose: true,
                    format: 'yyyy-mm-dd'
                })
            });



            var mensaje = getParameterByName('mensaje');

            if (mensaje === 'documento' || mensaje === 'adjunto') {
                showAlert("Documento Cargado con exito..!", "success");
                $("#timeline").removeClass("active");
                $("#tabTimeline").removeClass("active");
                $("#notas").removeClass("active");
                $("#tabNotas").removeClass("active");
                $("#recordatorios").removeClass("active");
                $("#tabRecordatorios").removeClass("active");
                if (mensaje === 'documento') {
                    $("#docs").addClass("active");
                    $("#tabDocs").addClass("active");
                    $("#adjuntos").removeClass("active");
                    $("#tabAdjuntos").removeClass("active");
                } else {
                    $("#docs").removeClass("active");
                    $("#tabDocs").removeClass("active");
                    $("#adjuntos").addClass("active");
                    $("#tabAdjuntos").addClass("active");
                }

            }

            if (mensaje === 'updateok') {
                showAlert("Afiliado Actualizado con exito", "success");
            }

            if (mensaje === 'deleteadjunto' || mensaje === 'deletedoc') {
                showAlert("Se elimino el documento con exito..!", "success");
                $("#timeline").removeClass("active");
                $("#tabTimeline").removeClass("active");
                $("#tabProduct").removeClass("active");
                $("#producto").removeClass("active");
                $("#notas").removeClass("active");
                $("#tabNotas").removeClass("active");
                $("#recordatorios").removeClass("active");
                $("#tabRecordatorios").removeClass("active");
                if (mensaje === 'deletedoc') {
                    $("#docs").addClass("active");
                    $("#tabDocs").addClass("active");
                    $("#adjuntos").removeClass("active");
                    $("#tabAdjuntos").removeClass("active");
                } else {
                    $("#docs").removeClass("active");
                    $("#tabDocs").removeClass("active");
                    $("#adjuntos").addClass("active");
                    $("#tabAdjuntos").addClass("active");
                }
            }


            if (mensaje === 'notaok') {
                showAlert("Nota creada o actualizada con exito..!", "success");
                $("#timeline").removeClass("active");
                $("#tabTimeline").removeClass("active");
                $("#docs").removeClass("active");
                $("#tabDocs").removeClass("active");
                $("#adjuntos").removeClass("active");
                $("#tabAdjuntos").removeClass("active");
                $("#recordatorios").removeClass("active");
                $("#tabRecordatorios").removeClass("active");
                $("#notas").addClass("active");
                $("#tabNotas").addClass("active");
            }


            if (mensaje === 'rememberOk') {
                showAlert("Recordatorio creado o actualizado con exito..!", "success");
                $("#timeline").removeClass("active");
                $("#tabTimeline").removeClass("active");
                $("#docs").removeClass("active");
                $("#tabDocs").removeClass("active");
                $("#adjuntos").removeClass("active");
                $("#tabAdjuntos").removeClass("active");
                $("#notas").removeClass("active");
                $("#tabNotas").removeClass("active");
                $("#recordatorios").addClass("active");
                $("#tabRecordatorios").addClass("active");
            }

            if (mensaje === 'deletenota') {
                showAlert("Nota eliminada con exito..!", "success");
                $("#timeline").removeClass("active");
                $("#tabTimeline").removeClass("active");
                $("#docs").removeClass("active");
                $("#tabDocs").removeClass("active");
                $("#adjuntos").removeClass("active");
                $("#tabAdjuntos").removeClass("active");
                $("#recordatorios").removeClass("active");
                $("#tabRecordatorios").removeClass("active");
                $("#notas").addClass("active");
                $("#tabNotas").addClass("active");
            }


            if (mensaje === 'deleteRemember') {
                showAlert("Recordatorio eliminado con exito..!", "success");
                $("#timeline").removeClass("active");
                $("#tabTimeline").removeClass("active");
                $("#docs").removeClass("active");
                $("#tabDocs").removeClass("active");
                $("#adjuntos").removeClass("active");
                $("#tabAdjuntos").removeClass("active");
                $("#notas").removeClass("active");
                $("#tabNotas").removeClass("active");
                $("#recordatorios").addClass("active");
                $("#tabRecordatorios").addClass("active");
            }



            if (mensaje === 'productOk') {
                showAlert("Producto registrado con exito", "success");
                $("#timeline").removeClass("active");
                $("#tabTimeline").removeClass("active");
                $("#docs").removeClass("active");
                $("#tabDocs").removeClass("active");
                $("#adjuntos").removeClass("active");
                $("#tabAdjuntos").removeClass("active");
                $("#recordatorios").removeClass("active");
                $("#tabRecordatorios").removeClass("active");
                $("#notas").removeClass("active");
                $("#tabNotas").removeClass("active");
                $("#tabProduct").addClass("active");
                $("#producto").addClass("active");
            }

            if (mensaje === 'addPayok') {
                showAlert("Pago registrado con exito", "success");
            }

            //style : success,info,warn,error
            function showAlert(text, style) {
                $.notify(text, style, "middle");
            }

            function getParameterByName(name) {
                name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
                var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
                        results = regex.exec(location.search);
                return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
            }
        </script>
    </body>
</html>