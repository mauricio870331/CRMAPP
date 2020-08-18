<?php
session_start();

require '../Model/BD.php';
$con = new BD();
$hoy = date("Y-m-d");
$SQL_SELECT_LEAD = "SELECT count(*) total_leads FROM personas u "
        . "inner join situacion_personas sp on sp.id_persona = u.id "
        . "inner join situacion si on si.id_situacion = sp.id_situacion "
        . "AND si.estado = 'LEAD' "
        . "and sp.fecha_registro = (select max(fecha_registro) from situacion_personas where id_persona = sp.id_persona) ";
//        . "WHERE sp.fecha_registro BETWEEN '" . $hoy . " 00:00:00' AND '" . $hoy . " 23:59:59'";

$rsLead = $con->findAll2($SQL_SELECT_LEAD);


$SQL_SELECT_CLIENTE = "SELECT count(*) total_clientes FROM personas u "
        . "inner join situacion_personas sp on sp.id_persona = u.id "
        . "inner join situacion si on si.id_situacion = sp.id_situacion AND si.estado = 'CLIENTE' "
        . "and sp.fecha_registro = (select max(fecha_registro) from situacion_personas where id_persona = sp.id_persona) ";
//        . "WHERE sp.fecha_registro BETWEEN '" . $hoy . " 00:00:00' AND '" . $hoy . " 23:59:59'";
$rsCliente = $con->findAll2($SQL_SELECT_CLIENTE);


$SQL_SELECT_CLIENTE2 = "SELECT count(*) total_clientes FROM personas u "
        . "inner join situacion_personas sp on sp.id_persona = u.id "
        . "inner join situacion si on si.id_situacion = sp.id_situacion AND si.estado = 'CLIENTE' "
        . "and sp.fecha_registro = (select max(fecha_registro) from situacion_personas where id_persona = sp.id_persona) "
        . "WHERE sp.fecha_registro BETWEEN '" . $hoy . " 00:00:00' AND '" . $hoy . " 23:59:59'";
$rsVentaDia = $con->findAll2($SQL_SELECT_CLIENTE2);


$SQL_SUM_TRANFER = "select  COALESCE(sum(pp.valor_cuota), 0) total from pagos_producto pp "
        . "inner join estados_de_pago ep on ep.id_estado_pago = pp.id_estado_pago and ep.codigo = 'R0'";
$rsTanfer = $con->findAll2($SQL_SUM_TRANFER);

$SQL_SUM_PROCCESS = "select  COALESCE(sum(pp.valor_cuota), 0) total from pagos_producto pp "
        . "inner join estados_de_pago ep on ep.id_estado_pago = pp.id_estado_pago and ep.codigo = 'EN PROCESO'";
$rsProccess = $con->findAll2($SQL_SUM_PROCCESS);

$SQL_SUM_APROBE = "select  COALESCE(sum(pp.valor_cuota), 0) total from pagos_producto pp "
        . "inner join estados_de_pago ep on ep.id_estado_pago = pp.id_estado_pago and ep.codigo = 'APROBADO'";
$rsAprobe = $con->findAll2($SQL_SUM_APROBE);


$SQL_SUM_DOWN = "select  COALESCE(sum(pp.valor_cuota), 0) total from pagos_producto pp "
        . "inner join estados_de_pago ep on ep.id_estado_pago = pp.id_estado_pago "
        . "and ep.codigo in ('R1','R2','R3','R4','R7','R8','R9','R10','R15','R16','R20')";
$rsDown = $con->findAll2($SQL_SUM_DOWN);

$SQL_COUNT_NOTP = "select count(id_notificacion) total from notificaciones where estado = 'PENDIENTE'";
$rscCountNotify = $con->findAll2($SQL_COUNT_NOTP);

$SQL_COUNT_NOTE = "select count(id_notificacion) total from notificaciones where estado = 'EJECUTADA'";
$rscCountNotifyE = $con->findAll2($SQL_COUNT_NOTE);


$SQL_SUM_TOT_VENT = "select COALESCE(sum(valor_cuota), 0) total from pagos_producto "
        . "where fecha_pago_realizado between '" . $hoy . " 00:00:00' and '" . $hoy . " 23:59:59'";
$rsTotVent = $con->findAll2($SQL_SUM_TOT_VENT);



$SQL_SUM_TOT_REC = "select count(id_recurso) total from recursos ";
$rsTotRecursos = $con->findAll2($SQL_SUM_TOT_REC);

//print_r($rsDown);die;

$con->desconectar();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link href="../dist/img/Favicon.png" rel="shortcut icon" />
        <title>Inicio || Home </title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.7 -->
        <link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="../bower_components/font-awesome/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="../bower_components/Ionicons/css/ionicons.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
        <!-- AdminLTE Skins. Choose a skin from the css/skins
             folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
        <link rel="stylesheet" href="../bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
        <!-- Google Font -->
        <link href="../dist/css/mycss.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="../dist/css/AllFonts.css">
        <link href="../dist/css/estilos_admin/admin.css" rel="stylesheet"/>

    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <!-- Site wrapper -->
        <div class="wrapper">

            <!-- Left side column. contains the sidebar -->
            <!-- Header -->
            <?php include_once '../view_admin//HeaderAdmin.php'; ?>
            <!-- =============================================== -->

            <!-- =============================================== -->

            <!-- Left side column. contains the sidebar -->
            <!-- Menu -->
            <?php include_once '../view_admin/MenuAdmin.php'; ?>
            <!-- =============================================== -->

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Bienvenid@ a CRM-APP                        
                    </h1>                    
                </section>

                <!-- Main content -->
                <section class="content">

                    <!-- Default box -->
                    <div class="box">

                        <div class="box-body">

                            <div class="row">
                                <div class="col-lg-3 col-xs-6">
                                    <!-- small box -->
                                    <div class="small-box bg-aqua">
                                        <div class="inner">
                                            <h4>Leads</h4>
                                            <h3 id="total_leads">Total: <?php echo $rsLead[0]['total_leads']; ?></h3>
                                        </div>
                                        <div class="icon">
                                            <i class="fa fa-users"></i>
                                        </div>
                                        <a href="ListarLeads.php" class="small-box-footer">Empezar <i class="fa fa-arrow-circle-right"></i></a>
                                    </div>
                                </div>


                                <div class="col-lg-3 col-xs-6">
                                    <!-- small box -->
                                    <div class="small-box bg-green">
                                        <div class="inner">
                                            <h4>Clientes</h4>
                                            <h3 id="total_leads">Total: <?php echo $rsCliente[0]['total_clientes']; ?></h3>
                                        </div>
                                        <div class="icon">
                                            <i class="fa fa-users"></i>
                                        </div>
                                        <a href="ListarClientes.php" class="small-box-footer">Empezar <i class="fa fa-arrow-circle-right"></i></a>
                                    </div>
                                </div>


                                <div class="col-lg-3 col-xs-6">
                                    <!-- small box -->
                                    <div class="small-box bg-yellow">
                                        <div class="inner">
                                            <h4>Notificaciones Pendientes</h4>
                                            <h3 id="notificaiones_pend">Total: <?php echo $rscCountNotify[0]['total'] ?></h3>
                                        </div>
                                        <div class="icon">
                                            <i class="fa fa-bell"></i>
                                        </div>
                                        <a href="ListarNotificaciones.php?token=<?php echo base64_encode("PENDIENTE"); ?>" class="small-box-footer">Empezar <i class="fa fa-arrow-circle-right"></i></a>
                                    </div>
                                </div>

                                <!--<div class="col-lg-3 col-xs-6">
                                  
                                    <div class="small-box bg-green">
                                        <div class="inner">
                                            <h4>Notificaciones Ejecutadas</h4>
                                            <h3 id="notificaciones_ejec">Total: echo $rscCountNotifyE[0]['total'] ?></h3>
                                        </div>
                                        <div class="icon">
                                            <i class="fa fa-bell-slash"></i>
                                        </div>
                                        <a href="ListarNotificaciones.php?token= echo base64_encode("EJECUTADA"); ?>" class="small-box-footer">Empezar <i class="fa fa-arrow-circle-right"></i></a>
                                    </div>
                                </div>-->

                                <div class="col-lg-3 col-xs-6">
                                    <!-- small box -->
                                    <div class="small-box bg-red">
                                        <div class="inner">
                                            <h4>Recursos Ventas</h4>
                                            <h3>Total: <?php echo $rsTotRecursos[0]['total'] ?></h3>
                                        </div>
                                        <div class="icon">
                                            <i class="fa fa-graduation-cap"></i>
                                        </div>
                                        <a href="ListarRecursos.php" class="small-box-footer">Empezar <i class="fa fa-arrow-circle-right"></i></a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-aqua"><i class="fa fa-angellist"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">Ventas del Dia</span>
                                    <span class="info-box-number up" id="total_clientes"><?php echo $rsVentaDia[0]['total_clientes']; ?></span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <!-- /.col -->
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-green"><i class="fa fa-money"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">Total Vendido</span>
                                    <span class="info-box-number up" id="total_venta">$<?php echo number_format($rsTotVent[0]['total'], 0, ",", "."); ?></span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <!-- /.col -->                            
                    </div>
                    <!-- /.row -->


                    <div class="row">
                        <div class="col-md-12">
                            <div class="box">                             
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="box box-primary">
                                                <div class="box-header with-border">
                                                    <h3 class="box-title">Filtrar</h3>
                                                </div>
                                                <!-- /.box-header -->
                                                <!-- form start -->
                                                <form role="form">
                                                    <div class="box-body">
                                                        <div>
                                                            <div class="form-group left">
                                                                <label>Fecha Inicial</label>
                                                                <div class="input-group date">
                                                                    <div class="input-group-addon">
                                                                        <i class="fa fa-calendar"></i>
                                                                    </div>
                                                                    <input type="text" class="form-control pull-right" id="fini" value="<?php echo $hoy; ?>"/>
                                                                </div>
                                                                <!-- /.input group -->
                                                            </div>
                                                            <div class="form-group right">
                                                                <label>Fecha Final</label>
                                                                <div class="input-group date">
                                                                    <div class="input-group-addon">
                                                                        <i class="fa fa-calendar"></i>
                                                                    </div>
                                                                    <input type="text" class="form-control pull-right" id="ffin" value="<?php echo $hoy; ?>"/>
                                                                </div>
                                                                <!-- /.input group -->
                                                            </div>
                                                        </div>

                                                        <div>
                                                            <div class="form-group left">
                                                                <label>*Coach</label>
                                                                <select class="form-control" name="coach" id="coach">
                                                                    <option value="">Seleccione</option>
                                                                    <?php
                                                                    $con = new BD();
                                                                    $SQL_SELECT = "SELECT id, nombres, apellidos FROM usuarios u "
                                                                            . "inner join tipo_usuario t on u.id_tipo_usuario = t.id_tipo_usuario "
                                                                            . "where t.descripcion = 'COACH'";
                                                                    $list = $con->query($SQL_SELECT);
                                                                    $con->desconectar();
                                                                    for ($index = 0; $index < count($list); $index++) {
                                                                        ?>
                                                                        <option value="<?php echo $list[$index]['id']; ?>"><?php echo $list[$index]['nombres'] . " " . $list[$index]['apellidos']; ?></option>
                                                                        <?php
                                                                    }
                                                                    ?> 
                                                                </select>
                                                            </div>

                                                            <div class="form-group right">
                                                                <label>*Asesor</label>
                                                                <select class="form-control" name="asesor" id="asesor">
                                                                    <option value="">Seleccione</option>
                                                                    <?php
                                                                    $con = new BD();
                                                                    $SQL_SELECT = "SELECT id, nombres, apellidos FROM usuarios u "
                                                                            . "inner join tipo_usuario t on u.id_tipo_usuario = t.id_tipo_usuario "
                                                                            . "where t.descripcion = 'ASESOR'";
                                                                    $list = $con->query($SQL_SELECT);
                                                                    $con->desconectar();
                                                                    for ($index = 0; $index < count($list); $index++) {
                                                                        ?>
                                                                        <option value="<?php echo $list[$index]['id']; ?>"><?php echo $list[$index]['nombres'] . " " . $list[$index]['apellidos']; ?></option>
                                                                        <?php
                                                                    }
                                                                    ?> 
                                                                </select>
                                                            </div>
                                                        </div>                                              
                                                    </div>
                                                    <!-- /.box-body -->
                                                    <div class="box-footer">
                                                        <button id="filterInHome" type="button" class="btn btn-primary">Buscar</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>                                  
                                    </div>
                                    <!-- /.row -->
                                </div>
                                <!-- ./box-body -->
                                <!--                                <div class="box-footer">
                                                                    <div class="row">
                                                                        <div class="col-sm-3 col-xs-6">
                                                                            <div class="description-block border-right">
                                                                                <span class="description-percentage text-green"><i class="fa fa-caret-up"></i> 17%</span>
                                                                                <h5 class="description-header">$35,210.43</h5>
                                                                                <span class="description-text">TOTAL REVENUE</span>
                                                                            </div>
                                                                             /.description-block 
                                                                        </div>
                                                                         /.col 
                                                                        <div class="col-sm-3 col-xs-6">
                                                                            <div class="description-block border-right">
                                                                                <span class="description-percentage text-yellow"><i class="fa fa-caret-left"></i> 0%</span>
                                                                                <h5 class="description-header">$10,390.90</h5>
                                                                                <span class="description-text">TOTAL COST</span>
                                                                            </div>
                                                                             /.description-block 
                                                                        </div>
                                                                         /.col 
                                                                        <div class="col-sm-3 col-xs-6">
                                                                            <div class="description-block border-right">
                                                                                <span class="description-percentage text-green"><i class="fa fa-caret-up"></i> 20%</span>
                                                                                <h5 class="description-header">$24,813.53</h5>
                                                                                <span class="description-text">TOTAL PROFIT</span>
                                                                            </div>
                                                                             /.description-block 
                                                                        </div>
                                                                         /.col 
                                                                        <div class="col-sm-3 col-xs-6">
                                                                            <div class="description-block">
                                                                                <span class="description-percentage text-red"><i class="fa fa-caret-down"></i> 18%</span>
                                                                                <h5 class="description-header">1200</h5>
                                                                                <span class="description-text">GOAL COMPLETIONS</span>
                                                                            </div>
                                                                             /.description-block 
                                                                        </div>
                                                                    </div>
                                                                     /.row 
                                                                </div>-->
                                <!-- /.box-footer -->
                            </div>
                            <!-- /.box -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.box -->

                    <div class="row">
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box bg-aqua">
                                <span class="info-box-icon"><i class="fa fa-hand-o-right"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">TRANFER</span>
                                    <span class="info-box-number upPays" id="total_tranfer">$<?php echo number_format($rsTanfer[0]['total'], 0, ",", "."); ?></span>

                                    <div class="progress">
                                        <div class="progress-bar" style="width: 0%"></div>
                                    </div>
                                    <span class="progress-description">
                                        <!--70% Increase in 30 Days-->
                                    </span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <!-- /.col -->
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box bg-yellow">
                                <span class="info-box-icon"><i class="fa fa-clock-o"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">PROCESO</span>
                                    <span class="info-box-number upPays" id="total_proccess">$<?php echo number_format($rsProccess[0]['total'], 0, ",", "."); ?></span>

                                    <div class="progress">
                                        <div class="progress-bar" style="width: 0%"></div>
                                    </div>
                                    <span class="progress-description">
                                        <!--70% Increase in 30 Days-->
                                    </span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <!-- /.col -->
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box bg-green">
                                <span class="info-box-icon"><i class="fa  fa-money"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">RECAUDO</span>
                                    <span class="info-box-number upPays" id="total_aprobados">$<?php echo number_format($rsAprobe[0]['total'], 0, ",", "."); ?></span>
                                    <div class="progress">
                                        <div class="progress-bar" style="width: 70%"></div>
                                    </div>
                                    <span class="progress-description">
                                        <!--70% Increase in 30 Days-->
                                    </span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>                       
                        <!-- /.col -->
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box bg-red">
                                <span class="info-box-icon"><i class="fa fa-warning"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">CAIDA</span>
                                    <span class="info-box-number upPays" id="total_caida">$<?php echo number_format($rsDown[0]['total'], 0, ",", "."); ?></span>

                                    <div class="progress">
                                        <div class="progress-bar" style="width: 70%"></div>
                                    </div>
                                    <span class="progress-description">
                                        <!--70% Increase in 30 Days->
                                    </span>
                                </div>
                                        <!-- /.info-box-content -->
                                </div>
                                <!-- /.info-box -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->


                </section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->         
            <?php include_once '../view_admin//FooterAdmin.php'; ?>
        </div>
        <!-- ./wrapper -->
        <!-- jQuery 3 -->




        <script src="../bower_components/jquery/dist/jquery.min.js"></script>
        <!-- Bootstrap 3.3.7 -->
        <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
        <!-- SlimScroll -->
        <script src="../bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
        <!-- FastClick -->
        <script src="../bower_components/fastclick/lib/fastclick.js"></script>
        <!-- bootstrap datepicker -->
        <script src="../bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
        <!-- AdminLTE App -->
        <script src="../dist/js/adminlte.min.js"></script>
        <!-- Sparkline -->
        <script src="../bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
        <!-- AdminLTE App -->
        <script src="../dist/js/adminlte.min.js"></script>      
        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <!--<script src="dist/js/pages/dashboard2.js"></script>-->
        <!-- AdminLTE for demo purposes -->
        <script src="../dist/js/demo.js"></script>
        <script src="../dist/js/notify.js" type="text/javascript"></script>
        <script src="../dist/js/funciones_usuario.js"></script>

        <script>

            $(document).ready(function () {
                var titulos = new Array();
                var valores = new Array();


                $('.sidebar-menu').tree();

            })

            $(function () {
                //Date picker
                $('#fini').datepicker({
                    autoclose: true,
                    format: 'yyyy-mm-dd'
                });

                $('#ffin').datepicker({
                    autoclose: true,
                    format: 'yyyy-mm-dd'
                })
            })
        </script>
    </body>
</html>
