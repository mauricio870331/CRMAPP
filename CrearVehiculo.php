<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link href="dist/img/Favicon.png" rel="shortcut icon" />
        <title>Crear Vehiculos</title>
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
                        Asociar Vehiculos a Afiliado || <input type="button" id="cancelarAfiliados2" class="btn btn-success"  value="Cancelar">                       
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
                                            <label for="Documento">*R ó Placa || Buscar: <i class="fa fa-fw fa-search findVehiculo" style="cursor: pointer" data-toggle="tooltip" title="Buscar"></i></label>
                                            <input  type="hidden" data-toggle="modal" data-target="#modal-default" id="findVehiculo"/>
                                            <input type="text" disabled class="form-control" id="R2" placeholder="Selecione Buscar">
                                        </div>                                                                                                                                                      
                                    </div>
                                    <!-- /.box-body -->

                                    <div class="box-footer">
                                        <input type="hidden" id="id_afiliado" value="<?php echo base64_decode($_GET['token']) ?>" />
                                        <input type="hidden" id="id_r" value="" />
                                        <button type="button" id="CrearVehiculo" class="btn btn-primary">Guardar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->

                    <!-- /.box -->
                    <div class="modal fade" id="modal-default">
                        <div class="modal-dialog">
                            <div class="modal-content" style="width: 125%;margin-left: -2%">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title">Buscar Vehiculos</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="box-body">
                                        <div class="col-md-12">
                                            <!-- general form elements -->
                                            <div class="box box-primary">                                                
                                                <!-- /.box-header -->
                                                <!-- form start -->
                                                <form role="form">
                                                    <div class="box-body">                                        
                                                        <div class="form-group">
                                                            <label for="dato">*Ingrese Un Valor</label>
                                                            <input type="text" class="form-control" style="width: 61%" id="dato" placeholder="Ingrese R, Placa, Iniciales, etc">
                                                            <button type="button" id="buscarVehiculo" style="float: right;margin-top: -34px;margin-right: 28%;" class="btn btn-primary">Buscar</button>
                                                        </div>                                                                                                                                                      
                                                    </div>
                                                    <!-- /.box-body -->                                                    
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="box-body">
                                        <table id="example2" class="table table-bordered table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Id</th>
                                                    <th>#</th>
                                                    <th>R</th>                                                    
                                                    <th>Placa</th>
                                                    <th>Marca</th>
                                                    <th>Linea</th> 
                                                    <th>Cooperativa</th> 
                                                    <th>Estado</th> 
                                                    <th>Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody id="respuesta">

                                            </tbody>                                        
                                        </table>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" id="closeModalFindVehiculo"  class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>

                                </div>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>
                    <!-- /.modal -->

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
        <!-- DataTables -->
        <script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
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

        </script>
    </body>
</html>
