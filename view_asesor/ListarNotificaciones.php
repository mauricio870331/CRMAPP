<?php
session_start();
include '../Model/BD.php';
$hoy = date("Y-m-d");
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link href="../dist/img/Favicon.png" rel="shortcut icon" />
        <title>Notifiaciones</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.7 -->
        <link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="../bower_components/font-awesome/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="../bower_components/Ionicons/css/ionicons.min.css">
        <!-- DataTables -->
        <link rel="stylesheet" href="../bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
        <!-- AdminLTE Skins. Choose a skin from the css/skins
             folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Google Font -->
        <link rel="stylesheet" href="../dist/css/AllFonts.css">
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

            <!-- Left side column. contains the sidebar -->
            <!-- Header -->
            <?php include_once '../view_asesor/HeaderAsesor.php'; ?>
            <!-- =============================================== -->

            <!-- =============================================== -->

            <!-- Left side column. contains the sidebar -->
            <!-- Menu -->
            <?php include_once '../view_asesor/MenuAsesor.php'; ?>
            <!-- =============================================== -->

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Notificaciones <?php echo (base64_decode($_GET['token']) == "PENDIENTE") ? "Pendientes " : "Ejecutadas "; ?> || <input type="button" id="backInicio" data-view="asesor" class="btn btn-success"  value="Regresar">
                    </h1>                    
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
<!--                        <div class="col-xs-12">
                            <button type="button" class="btn btn-block btn-primary" style="width: 10%;margin-bottom: 1%;"  data-toggle="modal" data-target="#modal-recordatorio" >Nuevo</button>
                        </div>-->
                    </div>
                    <div class="row">
                        <div class="col-xs-12">                   

                            <div class="box">                               
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <table id="example1" class="table table-bordered table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Titulo</th>   
                                                <th>Detalle</th>  
                                                <th>Estado</th>                                                
                                                <!--<th>Foto</th>--> 
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            include '../Model/Leads/ListarNotificaciones.php';
                                            ?>                                           
                                        </tbody>                                        
                                    </table>
                                    <div class="modal fade" id="modal-default">
                                        <div class="modal-dialog">
                                            <div class="modal-content" style="width: 60%;margin-left: 28%">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span></button>
                                                    <h4 class="modal-title">Confirmación</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Esta seguro de modificar el estado del lead seleccionado?</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button"  class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                                                    <button type="button" id="deleteLead" data-id="" data-opc=""  class="btn btn-primary">Modificar</button>
                                                </div>
                                            </div>
                                            <!-- /.modal-content -->
                                        </div>
                                        <!-- /.modal-dialog -->
                                    </div>
                                    <!-- /.modal -->



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
                                </div>
                                <!-- /.box-body -->
                            </div>
                            <!-- /.box -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </section>
                <!-- /.content -->
            </div>
            <?php include './FooterASesor.php'; ?>

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
        <!-- AdminLTE App -->
        <script src="../dist/js/adminlte.min.js"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="../dist/js/demo.js"></script>
        <!-- otras -->
        <script src="../dist/js/notify.js" type="text/javascript"></script>
        <script src="../dist/js/funciones_leads.js" type="text/javascript"></script>
        <!-- page script -->
        <script>
            var mensaje = getParameterByName('mensaje');

            $(function () {
                $('#example1').DataTable()
                $('#example2').DataTable({
                    'paging': true,
                    'lengthChange': false,
                    'searching': false,
                    'ordering': true,
                    'info': true,
                    'autoWidth': false
                })
            })

            if (mensaje == 'notifyOk') {
                showAlert("Notificacion completada con exito", "success");
            }

            if (mensaje == 'updateOk') {
                showAlert("Lead Actualizado con exito", "success");
            }

            if (mensaje == 'deleteok') {
                showAlert("Estado de Lead Actualziado", "success");
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
