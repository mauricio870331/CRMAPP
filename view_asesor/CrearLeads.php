<?php
session_start();
date_default_timezone_set('America/Bogota');
include_once '../Model/BD.php';
$hoy = date("Y-m-d");
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link href="../dist/img/Favicon.png" rel="shortcut icon" />
        <title>Crear Leads</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.7 -->
        <link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="../bower_components/font-awesome/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="../bower_components/Ionicons/css/ionicons.min.css">
        <!-- Bootstrap time Picker -->
        <link rel="stylesheet" href="../plugins/timepicker/bootstrap-timepicker.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
        <!-- AdminLTE Skins. Choose a skin from the css/skins
             folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
        <!-- bootstrap datepicker -->
        <link rel="stylesheet" href="../bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
        <link href="../dist/css/mycss.css" rel="stylesheet" type="text/css"/>
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Google Font -->
        <link rel="stylesheet" href="../dist/css/AllFonts.css">
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <!-- Site wrapper -->
        <div class="wrapper">

            <!-- =============================================== -->

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
                        Crear Lead || <input type="button" id="backCrearLead" class="btn btn-success"  value="Cancelar">                       
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
                                            <label for="ss">*Seguro Social</label>
                                            <input type="text" class="form-control" id="ss" placeholder="Ingrese Seguro Social">
                                        </div>

                                        <div class="form-group">
                                            <label for="nombres">*Nombres</label>
                                            <input type="text" class="form-control" id="nombres" placeholder="Ingrese Nombres">
                                        </div>

                                        <div class="form-group">
                                            <label for="apellidos">*Apellidos</label>
                                            <input type="text" class="form-control" id="apellidos" placeholder="Ingrese Nombres">
                                        </div>

                                        <div class="form-group">
                                            <label for="direccion">*Direccion</label>
                                            <input type="text" class="form-control" id="direccion" placeholder="Ingrese Direccion">
                                        </div>

                                        <div class="form-group">
                                            <label for="email">*Email</label>
                                            <input type="text" class="form-control" id="email" placeholder="Ingrese Email">
                                        </div>

                                        <div class="form-group">
                                            <label for="telefonos">*Telefonos</label>
                                            <input type="text" class="form-control" id="telefonos" placeholder="Ingrese Telefonos">
                                        </div>



                                        <div class="form-group">
                                            <label>Fecha de Nacimiento</label>
                                            <div class="input-group date">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                                <input type="text" value="<?php echo $hoy; ?>" class="form-control pull-right" id="dob" />
                                            </div>
                                            <!-- /.input group -->
                                        </div>


                                        <div class="form-group">
                                            <label>*Fecha de Cita</label>
                                            <div class="input-group date">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                                <input type="text" value="<?php echo $hoy; ?>" class="form-control pull-right" id="cita" />
                                            </div>                                           
                                            <!-- /.input group -->
                                        </div>

                                        <div class="form-group">
                                            <label>*Hora Cita</label>

                                            <div class="input-group">
                                                <input type="text" class="form-control timepicker" id="hora_cita">

                                                <div class="input-group-addon">
                                                    <i class="fa fa-clock-o"></i>
                                                </div>
                                            </div>
                                            <!-- /.input group -->
                                        </div>

                                        <div class="form-group">
                                            <label>*Estado</label>
                                            <select class="form-control" name="id_estado" id="id_estado">
                                                <option value="">Seleccione</option>
                                                <?php
                                                $con = new BD();
                                                $SQL_SELECT = "SELECT * FROM estado";
                                                $list = $con->query($SQL_SELECT);
                                                $con->desconectar();
                                                for ($index = 0; $index < count($list); $index++) {
                                                    ?>
                                                    <option value="<?php echo $list[$index]['id']; ?>"><?php echo $list[$index]['estado']; ?></option>
                                                    <?php
                                                }
                                                ?> 
                                            </select>
                                        </div>


                                        <div class="form-group">
                                            <label>*Ciudad</label>
                                            <select class="form-control" name="id_ciudad" id="id_ciudad">
                                                <option value="">Seleccione</option>                                                
                                            </select>
                                        </div>


                                    </div>
                                    <!-- /.box-body -->
                                    <div class="box-footer">
                                        <button type="button" id="CrearLead" class="btn btn-primary">Guardar</button>
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
            <?php include '../view_asesor/FooterASesor.php'; ?>
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
        <!-- bootstrap time picker -->
        <script src="../plugins/timepicker/bootstrap-timepicker.min.js"></script>
        <!-- AdminLTE App -->
        <script src="../dist/js/adminlte.min.js"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="../dist/js/demo.js"></script>
        <!-- funciones propias -->
        <script src="../dist/js/notify.js" type="text/javascript"></script>
        <script src="../dist/js/funciones_leads.js"></script>
        <script>
            $(document).ready(function () {
                $('.sidebar-menu').tree()
            })

            $(function () {
                //Date picker
                $('#dob').datepicker({
                    autoclose: true,
                    format: 'yyyy-mm-dd'
                })

                $('#cita').datepicker({
                    autoclose: true,
                    format: 'yyyy-mm-dd'
                })

                //Timepicker
                $('.timepicker').timepicker({
                    showInputs: false
                })


            })
        </script>
    </body>
</html>
