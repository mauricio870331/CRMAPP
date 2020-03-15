<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link href="dist/img/Favicon.png" rel="shortcut icon" />
        <title>Historial de Vehiculos</title>
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
                        Historial Vehiculos de Afiliados || <input type="button" id="backInicio" class="btn btn-success"  value="Regresar">                      
                    </h1>                    
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="col-xs-3" style="display: inline-flex;margin-left: 70%;margin-top: -4.4%"> 
                                <input type="text" id="documentoFind2" placeholder="Ingrese Documento" class="form-control">
                                <span class="input-group-btn">
                                    <button type="button" id="findAfiliateCars" class="btn btn-primary btn-flat">Buscar</button>
                                </span>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-xs-12"> 
                            <div class="box" id="listaVehiculos">                               
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <table id="example2" class="table table-bordered table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>R</th>
                                                <th>Placa</th>
                                                <th>Marca</th>
                                                <th>Linea</th>
                                                <th>Cooperativa</th>
                                                <th>Estado</th> 
                                                <th>Acciones</th> 
                                            </tr>
                                        </thead>
                                        <tbody >

                                        </tbody>                                        
                                    </table>                                  
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
                showAlert("Afiliado Actualizado con exito", "success");
            }

            if (mensaje == 'deleteok') {
                showAlert("Pago eliminado con exito", "success");
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
