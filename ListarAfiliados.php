<?php
session_start();
include_once './Model/BD.php';
$con = new BD();
$rs = $con->findAll2("SELECT a.*, d.estado_vinculo FROM afiliados a, datos_afiliado d where a.id_afiliado = d.id_afiliado order by documento desc LIMIT 1000");
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link href="dist/img/Favicon.png" rel="shortcut icon" />
        <title>Listar Afiliados</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.7 -->
        <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
        <!-- DataTables -->
        <link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
        <!-- AdminLTE Skins. Choose a skin from the css/skins
             folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">

        <link rel="stylesheet" href="dist/css/mycss.css">
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
            <!-- Left side column. contains the logo and sidebar -->
            <!-- Menu -->
            <?php include_once './Menu.php'; ?>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Listado de Afiliados || <input type="button" id="backInicio" class="btn btn-success"  value="Regresar">                      
                    </h1>                    
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <button type="button" id="crearAfiliado" class="btn btn-block btn-primary" style="width: 20%;margin-bottom: 1%;" >Crear Afiliado</button>

                            <div class="col-xs-3" style="display: inline-flex;margin-left: 70%;margin-top: -4.4%"> 
                                <input type="text" id="documentoFind" placeholder="Ingrese Documento" class="form-control">
                                <span class="input-group-btn">
                                    <button type="button" id="findAfiliate" class="btn btn-primary btn-flat">Buscar</button>
                                </span>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-xs-12"> 
                            <div class="box">                               
                                <!-- /.box-header -->
                                <div class="box-body" id="listaAfiliados">
                                    <table id="example2" class="table table-bordered table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>Tipo Documento</th>
                                                <th>Documento</th>
                                                <th>Nombres</th>
                                                <th>Apellidos</th>
                                                <th>Estado</th>
                                                <th>Foto</th>                                                 
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($rs as $key => $value) {
                                                ?>    
                                                <tr>   
                                                    <td><?php echo utf8_decode($value['tipo_doc']); ?></td>
                                                    <td><?php echo $value['documento']; ?></td>
                                                    <td><?php echo $value['nombres']; ?></td>
                                                    <td><?php echo $value['apellidos']; ?></td>
                                                    <td><span class="pull badge <?php echo ($value['estado_vinculo'] == "Activo") ? 'bg-green' : 'bg-red' ?>"><?php echo $value['estado_vinculo']; ?></span></td>
                                                    <td style="text-align: center" ><img src="Model/Afiliados/imageAfiliado.php?id=<?php echo $value['id_afiliado']; ?>" style="max-width: 40px;border-radius: 10%" alt="User Image"></td>                                                
                                                    <td>            
                                                        <div class="col-md-3 col-sm-4 acercar">
                                                            <i class="fa fa-fw fa-edit updateAfiliados " style="cursor: pointer" data-id="<?php echo base64_encode($value['id_afiliado']); ?>" data-toggle="tooltip" title="Actualizar"></i>
                                                        </div>
                                                        <div class="col-md-3 col-sm-4 acercar">
                                                            <i class="fa fa-fw fa-check deleteAfiliados" style="color: red;cursor: pointer" data-estado="<?php echo $value['estado_vinculo']; ?>" data-id="<?php echo $value['id_afiliado']; ?>" data-toggle="tooltip" title="Activar / Desactivar"></i>
                                                            <button type="button" style="display: none" class="btn btn-default" data-toggle="modal" data-target="#modal-default" id="afiliado<?php echo $value['id_afiliado']; ?>"/>
                                                        </div>
                                                        <div class="col-md-3 col-sm-4 acercar">
                                                            <i class="fa fa-fw fa-close destroyAfiliates" style="color: red;cursor: pointer" data-estado="<?php echo $value['estado_vinculo']; ?>" data-id="<?php echo $value['id_afiliado']; ?>" data-toggle="tooltip" title="Eliminar"></i>
                                                            <button type="button" style="display: none" class="btn btn-default" data-toggle="modal" data-target="#modal-defaultd" id="destroyafiliado<?php echo $value['id_afiliado']; ?>"/>
                                                        </div>
                                                        <div class="col-md-3 col-sm-4 acercar">
                                                            <i class="fa fa-fw fa-taxi addVehiculo" style="color: orange;cursor: pointer" data-id="<?php echo base64_encode($value['id_afiliado']); ?>" data-toggle="tooltip" title="Agregar Taxi"></i>
                                                        </div>
                                                        <div class="col-md-3 col-sm-4 acercar">
                                                            <i class="fa fa-fw fa-money addPayment" style="color: green;cursor: pointer" data-redirect="<?php echo "false" ?>" data-id="<?php echo base64_encode($value['id_afiliado']); ?>" data-toggle="tooltip" title="Registrar Pago"></i>
                                                        </div>
                                                        <div class="col-md-3 col-sm-4 acercar">
                                                            <i class="fa fa-fw fa-eye moreinfo"  style="color: blue;cursor: pointer" data-id="<?php echo base64_encode($value['id_afiliado']); ?>" data-toggle="tooltip" title="Información detallada"></i>
                                                        </div>
                                                    </td>
                                                </tr> 
                                            <?php } ?>                                            
                                        </tbody>
                                    </table>
                                </div>
                                <!--/.box-body -->
                            </div>
                            <!--/.box -->
                            <!--<button type = "button" id = "backInicio" class = "btn btn-success">Regresar</button> -->
                        </div>
                        <!--/.col -->
                        <div class = "modal fade" id = "modal-default">
                            <div class = "modal-dialog">
                                <div class = "modal-content" style = "width: 60%;margin-left: 28%">
                                    <div class = "modal-header">
                                        <button type = "button" class = "close" data-dismiss = "modal" aria-label = "Close">
                                            <span aria-hidden = "true">&times;
                                            </span></button>
                                        <h4 class = "modal-title">Confirmación</h4>
                                    </div>
                                    <div class = "modal-body">
                                        <p>Esta seguro de desactivar el afiliado seleccionado?</p>
                                    </div>
                                    <div class = "modal-footer">
                                        <button type = "button" class = "btn btn-default pull-left" data-dismiss = "modal">Cerrar</button>
                                        <button type = "button" id = "deleteAfiliado" data-id = "" data-estado = "" data-redirect = "no" class = "btn btn-primary">Activar / Desactivar</button>
                                    </div>
                                </div>
                                <!--/.modal-content -->
                            </div>
                            <!--/.modal-dialog -->
                        </div>
                        <!--/.modal -->


                        <div class = "modal fade" id = "modal-defaultd">
                            <div class = "modal-dialog">
                                <div class = "modal-content" style = "width: 60%;margin-left: 28%">
                                    <div class = "modal-header">
                                        <button type = "button" class = "close" data-dismiss = "modal" aria-label = "Close">
                                            <span aria-hidden = "true">&times;
                                            </span></button>
                                        <h4 class = "modal-title">Confirmación</h4>
                                    </div>
                                    <div class = "modal-body">
                                        <p>Esta seguro de eliminar el afiliado seleccionado?</p>
                                    </div>
                                    <div class = "modal-footer">
                                        <button type = "button" class = "btn btn-default pull-left" data-dismiss = "modal">Cerrar</button>
                                        <button type = "button" id = "destroyAfiliates" data-id = "" data-estado = "" data-redirect = "no" class = "btn btn-primary">Eliminar</button>
                                    </div>
                                </div>
                                <!--/.modal-content -->
                            </div>
                            <!--/.modal-dialog -->
                        </div>
                        <!--/.modal -->
                    </div>
                    <!--/.row -->
                </section>
                <!--/.content -->
            </div>
            <!--/.content-wrapper -->
            <?php include './Footer.php';
            ?>


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
        <!-- otras -->
        <script src="dist/js/notify.js" type="text/javascript"></script>
        <script src="dist/js/funciones.js" type="text/javascript"></script>
        <!-- page script -->
        <script>
            var mensaje = getParameterByName('mensaje');

            $(function () {
                $('#example2').DataTable({
                    'paging': true,
                    'lengthChange': false,
                    'searching': false,
                    'ordering': true,
                    'info': true,
                    'autoWidth': false
                })
            })

            if (mensaje == 'ok') {
                showAlert("Afiliado Registrado", "success");
            }

            if (mensaje == 'updateok') {
                showAlert("Afiliado Actualizado con éxito", "success");
            }

            if (mensaje == 'deleteok') {
                showAlert("Estado del afiliado actualizado con éxito", "success");
            }
            
            if (mensaje == 'destroyok') {
                showAlert("Afiliado eliminado con éxito", "success");
            }

            if (mensaje == 'addPayok') {
                showAlert("Pago registrado con éxito", "success");
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
