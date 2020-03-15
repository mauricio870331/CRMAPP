<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link href="dist/img/Favicon.png" rel="shortcut icon" />
        <title>Agregar Documentos</title>
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
        <!-- bootstrap datepicker -->
        <link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">


        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Google Font -->
        <link rel="stylesheet" href="dist/css/AllFonts.css">
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
                        Agregar Vehiculos || <input type="button" id="backListVehiculos" class="btn btn-success"  value="Cancelar">                       
                    </h1>                   
                </section>

                <!-- Main content -->
                <section class="content">

                    <!-- Default box -->


                    <div class="box-body">
                        <div class="col-md-8" style="margin-left: 15%">
                            <!-- general form elements -->
                            <div class="box box-primary">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Los campos marcados con (*) son obligatorios.</h3>
                                </div>
                                <!-- /.box-header -->
                                <!-- form start -->
                                <form role="form">
                                    <div class="box-body">

                                        <div class="form-group">
                                            <label for="Nom_Doc">*Nombre Documento</label>
                                            <select class="form-control" id="Nom_Doc">
                                                <option value="">Seleccione</option>
                                                <option value="SOAT">SOAT</option>
                                                <option value="TARJETA DE OPERACIÓN">TARJETA DE OPERACIÓN</option>
                                                <option value="REVISIÓN TÉCNICO-MECANICA">REVISIÓN TÉCNICO-MECANICA</option>
                                            </select>
                                        </div>



                                        <div class="form-group">
                                            <label>*Inicio Vigencia:</label>
                                            <div class="input-group date">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                                <input type="text" class="form-control pull-right" id="fechInic"/>
                                            </div>
                                            <!-- /.input group -->
                                        </div>


                                        <div class="form-group">
                                            <label>*Fin Vigencia:</label>
                                            <div class="input-group date">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                                <input type="text" class="form-control pull-right" id="fechFin"/>
                                                <input type="hidden" class="form-control pull-right" id="R" value="<?php echo base64_decode($_GET['token']); ?>"/>
                                            </div>
                                            <!-- /.input group -->
                                        </div>

                                    </div>
                                    <!-- /.box-body -->

                                    <div class="box-footer">
                                        <button type="button" id="AddDocuments" class="btn btn-primary">Guardar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->

                    <!-- /.box -->

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
        <!-- SlimScroll -->
        <script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
        <!-- FastClick -->
        <script src="bower_components/fastclick/lib/fastclick.js"></script>
        <!-- AdminLTE App -->
        <script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
        <script src="dist/js/adminlte.min.js"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="dist/js/demo.js"></script>
        <!-- funciones propias -->
        <script src="dist/js/notify.js" type="text/javascript"></script>
        <script src="dist/js/funciones.js"></script>
        <script>
            var mensaje = getParameterByName('mensaje');


            $(document).ready(function () {
                $('.sidebar-menu').tree()
            })


            if (mensaje == 'ok') {
                showAlert("Documento agregado, Puede registrar otro o regresar al listado", "success");
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


            $('#fechInic').datepicker({
                autoclose: true
            })


            $('#fechFin').datepicker({
                autoclose: true
            })
        </script>
    </body>
</html>
