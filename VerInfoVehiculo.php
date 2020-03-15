<?php
session_start();
require_once './Model/BD.php';
$con = new BD();
$query1="SELECT v.*, r.R, r.id_r, r.tipo FROM vehiculos v LEFT JOIN r_s r on r.id_r = v.id_r"
        . " WHERE id_vehiculo = " . base64_decode($_GET['token']) . "";
$rs = $con->findAll2($query1);
$rsDocumentos = $con->findAll2("SELECT * FROM documentos WHERE id_vehiculo = " . base64_decode($_GET['token']) . " and estado_documento = 'Activo' order by id_documento desc limit 10");
$rsDocumentosVencidos = $con->findAll2("SELECT * FROM documentos WHERE id_vehiculo = " . base64_decode($_GET['token']) . " and estado_documento = 'Inactivo' order by id_documento desc limit 10");
$rsPropietarios = $con->findAll2("SELECT * FROM porpietarios_vehiculos WHERE id_vehiculo = " . base64_decode($_GET['token']) . "");
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link href="dist/img/Favicon.png" rel="shortcut icon" />
        <title>Información Vehiculo</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.7 -->
        <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
        <!-- AdminLTE Skins. Choose a skin from the css/skins
             folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">

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
        <!-- Site wrapper -->
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
                        Informacion Vehiculo || <input type="button" id="backListVehiculos" class="btn btn-success"  value="Cancelar">                       
                    </h1>                   
                </section>

                <!-- Main content -->
                <section class="content">
                    <!-- Default box -->
                    <div class="box-body">
                        <!-- Main content -->
                        <section class="content">
                            <!-- row -->
                            <div class="row">
                                <div class="col-md-12">
                                    <!-- The time line -->
                                    <ul class="timeline">
                                        <!-- timeline time label -->
                                        <li class="time-label">
                                            <span class="bg-green">
                                                <?php echo "Creado: " . $rs[0]['create_at']; ?>
                                            </span>
                                        </li>
                                        <!-- /.timeline-label -->
                                        <!-- timeline item -->
                                        <li>
                                            <i class="fa fa-info bg-blue"></i>

                                            <div class="timeline-item">                                            

                                                <h3 class="timeline-header"><a href="#">Información</a></h3>
                                                <div class="timeline-body">
                                                    <ul>
                                                        <li><?php echo $rs[0]['tipo'] ?> Asociado: <a><?php echo $rs[0]['R'] ?></a></li>
                                                        <li>Placa: <a><?php echo $rs[0]['placa_vehiculo'] ?></a></li>
                                                        <li>Marca: <a><?php echo $rs[0]['marca'] ?></a></li>
                                                        <li>Linea: <a><?php echo $rs[0]['linea'] ?></a></li>
                                                        <li>Cooperativa: <a><?php echo $rs[0]['cooperativa'] ?></a></li>
                                                        <li>Estado: <a><?php echo $rs[0]['estado'] ?></a></li>
                                                    </ul>
                                                </div>

                                            </div>
                                        </li>
                                        <!-- END timeline item -->

                                        <!-- timeline item -->
                                        <li>
                                            <i class="fa fa-drivers-license-o bg-navy-active"></i>

                                            <div class="timeline-item">                                            

                                                <h3 class="timeline-header"><a href="#">Propietarios</a></h3>
                                                <div class="timeline-body">
                                                    <ul>
                                                        <?php for ($i = 0; $i < count($rsPropietarios); $i++) {
                                                            ?>
                                                            <li>Documento: <a><?php echo $rsPropietarios[$i]['documento'] ?></a> | 
                                                                <i style="color:blue"  class="fa fa-fw fa-edit updatePropietario" 
                                                                   data-id="<?php echo $_GET['token']; ?>" 
                                                                   data-id_propietario="<?php echo base64_encode($rsPropietarios[$i]['id_vehiculo'] . "," . $rsPropietarios[$i]['placa_vehiculo'] . "," . $rsPropietarios[$i]['documento']); ?>" 
                                                                   data-toggle="tooltip" title="Actualizar Propietarios"></i>
                                                                <i style="color:red" class="fa fa-fw fa-eraser deletePropietario" 
                                                                   data-id="<?php echo base64_encode($rsPropietarios[$i]['id_vehiculo'] . "," . $rsPropietarios[$i]['placa_vehiculo'] . "," . $rsPropietarios[$i]['documento']); ?>" 
                                                                   data-toggle="tooltip" title="Eliminar Propietario"></i>
                                                                <button type="button" style="display: none" class="btn btn-default" data-toggle="modal"
                                                                        data-target="#modal-2" 
                                                                        data-id_vehiculo="<?php echo base64_encode($rsPropietarios[$i]['id_vehiculo'] . "," . $rsPropietarios[$i]['placa_vehiculo'] . "," . $rsPropietarios[$i]['documento']); ?>" 
                                                                        id="propietario<?php echo base64_encode($rsPropietarios[$i]['id_vehiculo'] . "," . $rsPropietarios[$i]['placa_vehiculo'] . "," . $rsPropietarios[$i]['documento']); ?>"/></li> 
                                                            </li>
                                                            <li>Nombre: <a><?php echo $rsPropietarios[$i]['nom_prop'] ?></a></li>
                                                            <li>Responsable: <a><?php echo $rsPropietarios[$i]['responsable'] ?></a></li>
                                                            <li>Teléfono Propietario: <a><?php echo $rsPropietarios[$i]['tel_pro'] ?></a></li>
                                                            <li>Teléfono Responsable: <a><?php echo $rsPropietarios[$i]['tel_resp'] ?></a></li>
                                                        <?php } ?>
                                                    </ul>
                                                </div>

                                            </div>
                                        </li>
                                        <!-- END timeline item -->


                                        <!-- timeline item -->
                                        <li>
                                            <i class="fa fa-files-o bg-green"></i>

                                            <div class="timeline-item">                              

                                                <h3 class="timeline-header"><a href="#">Documentos</a></h3>
                                                <div class="timeline-body">
                                                    <ol>
                                                        <?php foreach ($rsDocumentos as $key => $value) { ?>
                                                            <li><?php echo utf8_decode($value['nom_documento']) . " - Vence: " . $value['fin_vigencia'] . " - Estado: " . $value['estado_documento']; ?> 
                                                                | <i style="color:blue"  class="fa fa-fw fa-edit updateDocumento" data-id="<?php echo base64_encode($value['id_documento']); ?>" data-id_vehiculo="<?php echo $_GET['token']; ?>" data-toggle="tooltip" title="Actualizar Documento"></i>
                                                                <i style="color:red" class="fa fa-fw fa-eraser deleteDocumento" data-id="<?php echo $value['id_documento']; ?>" data-toggle="tooltip" title="Eliminar Documento"></i>
                                                                <button type="button" style="display: none" class="btn btn-default" data-toggle="modal" data-target="#modal-default" data-id_vehiculo="<?php echo $_GET['token']; ?>" id="documento<?php echo $value['id_documento']; ?>"/></li> 
                                                        <?php } ?> 
                                                    </ol>
                                                </div>
                                            </div>
                                        </li>
                                        <!-- END timeline item -->
                                        <!-- timeline item -->
                                        <li>
                                            <i class="fa fa-files-o bg-red"></i>

                                            <div class="timeline-item">                              

                                                <h3 class="timeline-header"><a href="#">Documentos Vencidos</a></h3>
                                                <div class="timeline-body">
                                                    <ol>
                                                        <?php foreach ($rsDocumentosVencidos as $key => $value) { ?>
                                                            <li><?php echo utf8_decode($value['nom_documento']) . " - Vence: " . $value['fin_vigencia'] . " - Estado: " . $value['estado_documento']; ?></li> 
                                                        <?php } ?> 
                                                    </ol>
                                                </div>
                                            </div>
                                        </li>
                                        <!-- END timeline item -->
                                    </ul>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->
                        </section>
                        <!-- /.content -->
                    </div>
                    <!-- /.box-body -->
                    <!-- /.box -->
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
                                <p>Esta seguro de eliminar el documento seleccionado?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button"  class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                                <button type="button" id="deleteDocumento" data-id="" data-token="<?php echo $_GET['token'] ?>" class="btn btn-danger">Eliminar</button>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->
                <div class="modal fade" id="modal-2">
                    <div class="modal-dialog">
                        <div class="modal-content" style="width: 60%;margin-left: 28%">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Confirmación</h4>
                            </div>
                            <div class="modal-body">
                                <p>Esta seguro de eliminar el propietario seleccionado?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button"  class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                                <button type="button" id="deletePropietario" data-id="" data-token="<?php echo $_GET['token'] ?>" class="btn btn-danger">Eliminar</button>
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
        <!-- SlimScroll -->
        <script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
        <!-- FastClick -->
        <script src="bower_components/fastclick/lib/fastclick.js"></script>
        <!-- AdminLTE App -->
        <script src="dist/js/adminlte.min.js"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="dist/js/demo.js"></script>
        <!-- funciones propias -->
        <script src="dist/js/notify.js" type="text/javascript"></script>
        <script src="dist/js/funciones.js"></script>
        <script>
            $(document).ready(function () {
                $('.sidebar-menu').tree()
            })
            var mensaje = getParameterByName('mensaje');
            if (mensaje == 'ok') {
                showAlert("Vehiculo Registrado", "success");
            }

            if (mensaje == 'updateok') {
                showAlert("Informacion Actualizada con exito", "success");
            }

            if (mensaje == 'deleteok') {
                showAlert("Registro eliminado con éxito", "success");
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
