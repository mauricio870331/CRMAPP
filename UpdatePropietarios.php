<?php
session_start();
require './Model/BD.php';

$con = new BD();
$llaveparts = explode(",",base64_decode($_GET['token2']));
$sql = "SELECT * FROM porpietarios_vehiculos WHERE id_vehiculo = " . $llaveparts[0] . " "
        . "and placa_vehiculo = '".$llaveparts[1]."' and documento =  '".$llaveparts[2]."'";
$rs = $con->findAll2($sql);


?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link href="dist/img/Favicon.png" rel="shortcut icon" />
        <title>Actualizar Porpietarios</title>
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
                        Actualizar Propietario(s) de Vehiculo || <input type="button" id="backListVehiculos2" class="btn btn-success" 
                                                                   data-id="<?php echo $_GET['token'] ?>" value="Cancelar">                       
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
                                            <label for="Documento">*Documento Propietario</label>
                                            <input type="text" class="form-control" id="Documento" value="<?php echo $rs[0]['documento'] ?>" placeholder="Ingrese Documento Propietario">
                                        </div>
                                        <div class="form-group">
                                            <label for="nompro">*Nombre Completo</label>
                                            <input type="text" class="form-control" id="nompro" value="<?php echo $rs[0]['nom_prop'] ?>" placeholder="Ingrese Nombre Propietario">
                                        </div>
                                        <div class="form-group">
                                            <label for="nomresp">*Nombre Responsable</label>
                                            <input type="text" class="form-control" id="nomresp" value="<?php echo $rs[0]['responsable'] ?>" placeholder="Ingrese Nombre Responsable">
                                        </div>
                                        <div class="form-group">
                                            <label for="telpro">*Teléfono Propietario</label>
                                            <input type="text" class="form-control" id="telpro" value="<?php echo $rs[0]['tel_pro'] ?>" placeholder="Ingrese Teléfono Propietario">
                                        </div>
                                        <div class="form-group">
                                            <label for="telres">Teléfono Responsable</label>
                                            <input type="text" class="form-control" id="telres" value="<?php echo $rs[0]['tel_resp'] ?>" placeholder="Ingrese Teléfono Responsable">
                                            <input type="hidden" class="form-control" id="id_vehiculo" value="<?php echo base64_decode($_GET['token2']); ?>" />                                           

                                        </div>                                            
                                    </div>
                                    <!-- /.box-body -->
                                    <div class="box-footer">
                                        <button type="button" id="UpdatePropietarioVehiculo" class="btn btn-primary">Guardar</button>
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
        </script>
    </body>
</html>
