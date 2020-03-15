<?php
session_start();
require './Model/BD.php';
$con = new BD();
$sql = "SELECT * FROM afiliados a "
        . "inner join datos_afiliado b on a.id_afiliado = b.id_afiliado "
        . "inner join departamentos c on b.departamento = c.id_departamento "
        . "inner join municipios d on b.ciudad_residencia = d.id_municipio "
        . "WHERE a.id_afiliado = " . base64_decode($_GET['token']) . "";


$rsAfiliado = $con->findAll2($sql);



$sqlvehiculos = "select va.*, v.R, v.tipo  from vehiculos_afiliados va, r_s v"
        . " where  v.id_r = va.id_r  "
        . "and va.id_afiliado = " . base64_decode($_GET['token']) . " order by estado limit 50";
$rsVehiculos = $con->findAll2($sqlvehiculos);



$sqlPagos = "select * from pagos where id_afiliado = " . base64_decode($_GET['token']) . " order by fecha_pago desc limit 50";
$rsPagos = $con->findAll2($sqlPagos);




//$id_vehiculo = "";
//for ($j = 0; $j < count($rsVehiculos); $j++) {
//    if ($rsVehiculos[$j]['estado'] == 'Activo') {
//        $id_vehiculo = $rsVehiculos[$j]['id_vehiculo'];
//    }
//}
//$rsDocVehiculo = array();
//if ($id_vehiculo != "") {
//    $queryDocVehiculo = "select * from documentos where estado_documento = 'Activo' and id_vehiculo = $id_vehiculo";
//    $rsDocVehiculo = $con->findAll2($queryDocVehiculo);
//}
//echo "<pre>";
//print_r($rsDocVehiculo);
$con->desconectar();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link href="dist/img/Favicon.png" rel="shortcut icon" />
        <title>Perfil del Afiliado</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.7 -->
        <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
        <!-- Theme style -->
        <!-- DataTables -->
        <link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
        <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
        <!-- AdminLTE Skins. Choose a skin from the css/skins
             folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
        <link rel="stylesheet" href="dist/css/mycss.css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Google Font -->
        <link rel="stylesheet" href="dist/css/AllFonts.css">
        <style>
            .example-modal .modal {
                position: relative;
                top: auto;
                bottom: auto;
                right: auto;
                left: auto;
                display: block;
                z-index: 1;
            }

            .example-modal .modal {
                background: transparent !important;
            }
        </style>
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">

            <!-- =============================================== -->

            <!-- Left side column. contains the sidebar -->
            <!-- Header -->
            <?php include_once './Header.php'; ?>
            <!-- =============================================== -->
            <!-- =============================================== -->

            <!-- Left side column. contains the sidebar -->
            <!-- Menu -->
            <?php include_once './Menu.php'; ?>
            <!-- =============================================== -->

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Perfil del Afiliado <button type="button" id="backfromProfile" class="btn btn-success">Regresar</button>
                    </h1>                    
                </section>

                <!-- Main content -->
                <section class="content">

                    <div class="row">
                        <div class="col-md-3">

                            <!-- Profile Image -->
                            <div class="box box-primary">
                                <div class="box-body box-profile">
                                    <img class="profile-user-img img-responsive" style="width: 100%" src="Model/Afiliados/imageAfiliado.php?id=<?php echo $rsAfiliado[0]['id_afiliado'] ?>" alt="User profile picture">

                                    <h4 class="profile-username text-center" style="font-size: 18px;"><?php echo $rsAfiliado[0]['nombre_completo'] ?></h4>
                                    <!-- Mostrar solo 22 caracteres -->

                                    <p class="text-muted text-center">Afiliado</p>

                                    <ul class="list-group list-group-unbordered">
                                        <li class="list-group-item">
                                            <b>Documento</b> <a class="pull-right textoc"><?php echo $rsAfiliado[0]['documento'] ?></a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Telefono</b> <a class="pull-right textoc"><?php echo $rsAfiliado[0]['telefonos'] ?></a>
                                        </li>                                      
                                    </ul>

                                    <a href="javascript:void(0)" data-id="<?php echo $rsAfiliado[0]['id_afiliado']; ?>" class="deleteAfiliados btn <?php echo ($rsAfiliado[0]['estado_vinculo'] == "Activo") ? 'btn-success' : 'btn-danger' ?>  btn-block" data-estado="<?php echo $rsAfiliado[0]['estado_vinculo']; ?>"><b><?php echo $rsAfiliado[0]['estado_vinculo'] ?></b></a>
                                    <button type="button" style="display: none" class="btn btn-default" data-toggle="modal" data-target="#modal-default" id="afiliado<?php echo $rsAfiliado[0]['id_afiliado']; ?>"/>
                                </div>
                                <!-- /.box-body -->
                            </div>
                            <!-- /.box -->

                            <!-- About Me Box -->
                            <div class="box box-primary">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Estado de Cuenta</h3>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <strong><i class="fa fa-book margin-r-5"></i> Tu estado actual es:</strong>

                                    <p class="text-muted">
                                        <?php
                                        if ($rsAfiliado[0]['fecha_proximo_pago'] != "" && count($rsPagos) > 0) {

                                            $fechapagoproximopago = date("Y-m-d", strtotime($rsAfiliado[0]['fecha_proximo_pago'])); // viene de la tabla afiliado
                                            $fecha_pago = date("Y-m-d", strtotime($fechapagoproximopago . "- 1 month"));
                                            $fecha_ultimopago = date("Y-m-d", strtotime($rsPagos[0]['fecha_pago'])); // viene de la tabla pagos
                                            $flag = "";

                                            $ResDiff = "";
                                            if ($fecha_ultimopago > $fecha_pago) {
                                                $datetime1_menor = new DateTime($fecha_pago);
                                                $datetime2_mayor = new DateTime($fecha_ultimopago);
                                                $interval = $datetime1_menor->diff($datetime2_mayor);
                                                $ResDiff = $interval->format('%d días');
                                                $flag = "Al dia en mora";
                                            } else if ($fecha_ultimopago < $fecha_pago) {
                                                $fecha_ultimopago = date("Y-m-d");
                                                $datetime1_menor = new DateTime($fecha_pago);
                                                $datetime2_mayor = new DateTime($fecha_ultimopago);
                                                $interval = $datetime1_menor->diff($datetime2_mayor);
                                                $ResDiff = $interval->format('%d días');
                                                $flag = "En mora";
                                            } else if ($fecha_ultimopago == $fecha_pago) {
                                                $flag = "Al dia";
                                            }


                                            switch ($flag) {
                                                case "Al dia":
                                                    ?>
                                                    <span class="pull badge bg-green" style="font-size: 15px;margin-left: 8%;"><?php echo "Al dia"; ?></span>
                                                    <?php
                                                    break;
                                                case "Al dia en mora":
                                                    ?>
                                                    <span class="pull badge bg-green" style="font-size: 15px;margin-left: 8%;"><?php echo "Pagaste con " . $ResDiff . " de retraso"; ?></span>
                                                    <?php
                                                    break;
                                                case "En mora":
                                                    ?>
                                                    <span class="pull badge bg-red" style="font-size: 15px;margin-left: 8%;"><?php echo "En mora por " . $ResDiff; ?></span>
                                                    <?php
                                                    break;
                                            }
                                        } else {
                                            $fechapagoproximopago = date("Y-m-d", strtotime($rsAfiliado[0]['fecha_proximo_pago'])); // viene de la tabla afiliado
                                            $fecha_pago = date("Y-m-d", strtotime($fechapagoproximopago . "- 1 month"));
                                            $fecha_ultimopago = date("Y-m-d");
                                            $datetime1_menor = new DateTime($fecha_pago);
                                            $datetime2_mayor = new DateTime($fecha_ultimopago);
                                            $interval = $datetime1_menor->diff($datetime2_mayor);
                                            $ResDiff = $interval->format('%d días');

                                            if ($ResDiff == 0) {
                                                ?>
                                                <span class="pull badge bg-green" style="font-size: 15px;margin-left: 8%;"><?php echo "Al dia"; ?></span>
                                                <?php
                                            } else {
                                                ?>
                                                <span class="pull badge bg-red" style="font-size: 15px;margin-left: 8%;"><?php echo "En Mora por " . $ResDiff; ?></span>
                                                <?php
                                            }
                                        }
                                        ?>
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
                                    <li class="active"><a href="#timeline" data-toggle="tab">Información de Contacto</a></li>
                                    <li><a href="#activity" data-toggle="tab">Historial de Vehiculos</a></li>                                    
                                    <!--<li><a href="#documentos" data-toggle="tab">Documentos Vehiculo Activo</a></li>-->
                                    <li><a href="#pagos" data-toggle="tab">Historial de Pagos</a></li>
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
                                                            <li class="separated"><b>Fecha de Nacimiento:</b><a href="#" class="textop">  <?php echo utf8_decode($rsAfiliado[0]['fecha_nacimiento']) ?></a></li>
                                                            <li class="separated"><b>Tipo Documento:</b>  <a href="#" class="textop"><?php echo utf8_decode($rsAfiliado[0]['tipo_doc']) ?></a></li>
                                                            <li class="separated"><b>Documento:</b> <a href="#" class="textop"> <?php echo $rsAfiliado[0]['documento'] ?></a></li>
                                                            <li class="separated"><b>Fecha Expedición:</b>  <a href="#" class="textop"><?php echo $rsAfiliado[0]['fecha_exp_doc'] ?></a></li>
                                                            <li class="separated"><b>Lugar Expedición:</b>  <a href="#" class="textop"><?php echo $rsAfiliado[0]['lugar_expedi_doc'] ?></a></li>
                                                            <li class="separated"><b>Nombres:</b> <a href="#" class="textop"> <?php echo $rsAfiliado[0]['nombres'] ?></a></li>
                                                            <li class="separated"><b>Apellidos:</b> <a href="#" class="textop"> <?php echo $rsAfiliado[0]['apellidos'] ?></a></li>
                                                            <li class="separated"><b>Genero:</b> <a href="#" class="textop"> <?php echo $rsAfiliado[0]['genero'] ?></a></li>
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
                                                            <li class="separated"><b>Dirección de Residencia:</b> <a href="#" class="textop"><?php echo $rsAfiliado[0]['direccion'] ?></a></li>
                                                            <li class="separated"><b>Dirección de Correspondencia:</b> <a href="#" class="textop"><?php echo $rsAfiliado[0]['direccion_correo'] ?></a></li>
                                                            <li class="separated"><b>Departamento Residencia:</b> <a href="#" class="textop"><?php echo $rsAfiliado[0]['departamento'] ?></a></li>
                                                            <li class="separated"><b>Ciudad Residencia:</b> <a href="#" class="textop"><?php echo $rsAfiliado[0]['municipio'] ?></a></li>
                                                            <li class="separated"><b>Telefonos:</b> <a href="#" class="textop"><?php echo $rsAfiliado[0]['telefonos'] ?></a></li>
                                                            <li class="separated"><b>Correo:</b> <a href="#" class="textop"><?php echo $rsAfiliado[0]['email'] ?></a></li>
                                                            <li class="separated"><b>Estado Civil:</b> <a href="#" class="textop"><?php echo $rsAfiliado[0]['estado_civil'] ?></a></li>
                                                        </ul>
                                                    </div>                                                    
                                                </div>
                                            </li>
                                            <!-- END timeline item -->                                        

                                        </ul>
                                    </div>
                                    <!-- /.tab-pane -->


                                    <div class="tab-pane" id="activity">

                                        <!-- /.box-header -->
                                        <div class="box">
                                            <div class="box-body">

                                                <table id="example1" class="table table-bordered table-striped table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th>R | GPS</th>
                                                            <th>Tipo</th>
                                                            <th>Placa</th>
                                                            <th>Marca</th>
                                                            <th>Fecha Inicial</th>
                                                            <th>Fecha Final</th>                                                            
                                                            <th>Estado</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>  
                                                        <?php for ($i = 0; $i < count($rsVehiculos); $i++) { ?>
                                                            <tr>
                                                                <td><a class="textoc"><?php echo $rsVehiculos[$i]['R'] ?></a></td>
                                                                 <td><a class="textoc"><?php echo $rsVehiculos[$i]['tipo'] ?></a></td>
                                                                <td><a class="textoc"><?php echo $rsVehiculos[$i]['placa_vehiculo'] ?></a></td>
                                                                <td><a class="textoc"><?php echo $rsVehiculos[$i]['marca'] ?></a></td>
                                                                <td><a class="textoc"><?php echo $rsVehiculos[$i]['fecha_ini_activo'] ?></a></td>
                                                                <td><a class="textoc"><?php echo $rsVehiculos[$i]['fecha_fin_activo'] ?></a></td>                                                               
                                                                <td><span class="pull badge <?php echo ($rsVehiculos[$i]['estado'] == "Activo") ? 'bg-green' : 'bg-red' ?>"><?php echo $rsVehiculos[$i]['estado']; ?></span></td>
                                                            </tr>
                                                        <?php } ?>
                                                    </tbody>                                               
                                                </table>                                              
                                            </div>
                                        </div>
                                        <!-- /.box-body -->
                                    </div>
                                    <!-- /.tab-pane -->



                                    <!--                                    <div class="tab-pane" id="documentos">
                                                                             /.box-header 
                                                                            <div class="box">
                                                                                <div class="box-body">
                                    
                                                                                    <table id="example1" class="table table-bordered table-striped table-hover">
                                                                                        <thead>
                                                                                            <tr>
                                                                                                <th>Documento</th>                                                            
                                                                                                <th>Inicio Vigencia</th>
                                                                                                <th>Fin Vigencia</th>
                                                                                                <th>Estado</th>
                                                                                            </tr>
                                                                                        </thead>
                                                                                        <tbody>  
                                                                                          for ($i = 0; $i < count($rsDocVehiculo); $i++) { ?>
                                                                                                <tr>
                                                                                                    <td><a class="textoc">< echo $rsDocVehiculo[$i]['nom_documento'] ?></a></td>                                                                
                                                                                                    <td><a class="textoc"><?p echo $rsDocVehiculo[$i]['incio_vigencia'] ?></a></td>
                                                                                                    <td><a class="textoc"><?p echo $rsDocVehiculo[$i]['fin_vigencia'] ?></a></td> 
                                                                                                    <td><span class="pull badge <?p echo ($rsDocVehiculo[$i]['estado_documento'] == "Activo") ? 'bg-green' : 'bg-red' ?>"><?php echo $rsDocVehiculo[$i]['estado_documento']; ?></span></td>
                                                                                                </tr>
                                                                                           
                                                                                        </tbody>                                               
                                                                                    </table>                                              
                                                                                </div>
                                                                            </div>
                                                                             /.box-body 
                                                                        </div>-->
                                    <!-- /.tab-pane -->

                                    <!-- /.tab-pane -->


                                    <div class="tab-pane" id="pagos">
                                        <!-- /.box-header -->
                                        <div class="box">
                                            <div class="box-body">

                                                <table id="example2" class="table table-bordered table-striped table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th>Fecha de Pago</th>
                                                            <th>Concepto</th>
                                                            <th>Valor</th>
                                                            <th>Descuento</th>
                                                            <th>Total</th>                                                            
                                                        </tr>
                                                    </thead>
                                                    <tbody>  
                                                        <?php for ($i = 0; $i < count($rsPagos); $i++) { ?>
                                                            <tr>
                                                                <td><a class="textoc"><?php echo $rsPagos[$i]['fecha_pago'] ?></a></td>
                                                                <td><a class="textoc"><?php echo $rsPagos[$i]['concepto'] ?></a></td>
                                                                <td><a class="textoc">$<?php echo number_format($rsPagos[$i]['valor'], 0, ",", ".") ?></a></td>
                                                                <td><a class="textoc">$<?php echo number_format($rsPagos[$i]['descuento'], 0, ",", ".") ?></a></td>
                                                                <td><a class="textoc">$<?php echo number_format($rsPagos[$i]['total'], 0, ",", ".") ?></a></td>                                                                
                                                            </tr>
                                                        <?php } ?>
                                                    </tbody>                                               
                                                </table>
                                            </div>
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
                <div class="modal fade" id="modal-default">
                    <div class="modal-dialog">
                        <div class="modal-content" style="width: 60%;margin-left: 28%">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Confirmación</h4>
                            </div>
                            <div class="modal-body">
                                <p>Esta seguro de Activar / Inactivar el afiliado?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button"  class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                                <button type="button" id="deleteAfiliado" data-id="" data-estado="" data-redirect="yes"  class="btn btn-primary">Activar / Desactivar</button>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->
            </div>
            <!-- /.content-wrapper -->
            <?php include './Footer.php'; ?>           
        </div>
        <!-- ./wrapper -->

        <!-- jQuery 3 -->
        <script src="bower_components/jquery/dist/jquery.min.js"></script>
        <!-- Bootstrap 3.3.7 -->
        <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
        <!-- DataTables -->
        <script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
        <!-- SlimScroll -->
        <script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
        <!-- FastClick -->
        <script src="bower_components/fastclick/lib/fastclick.js"></script>
        <!-- AdminLTE App -->
        <script src="dist/js/adminlte.min.js"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="dist/js/demo.js"></script>
        <script src="dist/js/notify.js" type="text/javascript"></script>
        <script src="dist/js/funciones.js"></script>
        <!-- page script -->
        <script>
            $(function () {
                $('#example1').DataTable();
                $('#example2').DataTable()
            })


            var mensaje = getParameterByName('mensaje');
            if (mensaje == 'ok') {
                showAlert("Afiliado Registrado", "success");
            }

            if (mensaje == 'updateok') {
                showAlert("Afiliado Actualizado con exito", "success");
            }

            if (mensaje == 'deleteok') {
                showAlert("Estado del afiliado actualizado con éxito", "success");
            }

            if (mensaje == 'addPayok') {
                showAlert("Pago registrado con exito", "success");
            }

            //style : success,info,warn,error
            function showAlert(text, style) {
                $.notify(text, style);
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
