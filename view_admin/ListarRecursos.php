<?php
session_start();
require '../Model/BD.php';
$con = new BD();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link href="../dist/img/Favicon.png" rel="shortcut icon" />
        <title>Listado de Recursos</title>
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

            <!-- =============================================== -->

            <!-- Left side column. contains the sidebar -->
            <!-- Header -->
            <?php include_once './HeaderAdmin.php'; ?>
            <!-- =============================================== -->
            <!-- Left side column. contains the logo and sidebar -->
            <!-- Menu -->
            <?php include_once './MenuAdmin.php'; ?>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Listado de Usuarios || <input type="button" id="backInicio" class="btn btn-success"  value="Regresar">
                    </h1>                    
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <button type="button" id="crearRecurso" class="btn btn-block btn-primary" data-toggle="modal" data-target="#modal-newRecurso" style="width: 12%;margin-bottom: 1%;" >Nuevo Recurso</button>
                        </div>
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
                                                <th>Descripcion</th>
                                                <th>Documento</th>
                                                <th>Fecha Registro</th>    
                                                <th>Acciones</th>    
                                            </tr>
                                        </thead>
                                        <tbody>  
                                            <?php
                                            $con = new BD();
                                            $SQL_SELECT = "SELECT * from recursos limit 500";
                                            $rsDocs = $con->findAll2($SQL_SELECT);
                                            $con->desconectar();
                                            ?>
                                            <?php for ($i = 0; $i < count($rsDocs); $i++) { ?>
                                                <tr>
                                                    <td><a class="textoc"><?php echo $rsDocs[$i]['id_recurso'] ?></a></td>
                                                    <td><a class="textoc"><?php echo $rsDocs[$i]['descripcion'] ?></a></td>
                                                    <td><a class="textoc" target="_blank" href="<?php echo $rsDocs[$i]['ruta'] . $rsDocs[$i]['nombre_archivo'] ?>" ><?php echo $rsDocs[$i]['nombre_archivo'] ?></a></td>
                                                    <td><a class="textoc"><?php echo $rsDocs[$i]['fecha_registro'] ?></a></td>
                                                    <td>
                                                        <div class="col-md-3 col-sm-4" style="margin-right: -5%;">
                                                            <i class="fa fa-fw fa-eraser deleteRecurso" data-id="<?php echo $rsDocs[$i]['id_recurso']; ?>" data-toggle="tooltip" title="Borrar"></i>
                                                            <button type="button" style="display: none" class="btn btn-default" data-toggle="modal" data-target="#modal-deleteRec" id="RecursoId<?php echo $rsDocs[$i]['id_recurso'] ?>"/>
                                                        </div>
                                                    </td>                                                                
                                                </tr>
                                            <?php } ?>
                                        </tbody>                                          
                                    </table>
                                    <div class="modal fade" id="modal-deleteRec">
                                        <div class="modal-dialog">
                                            <div class="modal-content" style="width: 60%;margin-left: 28%">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span></button>
                                                    <h4 class="modal-title">Confirmación</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Esta seguro de eliminar el recurso seleccionado?</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button"  class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                                                    <button type="button" id="deleteRecurso" data-id=""  class="btn btn-primary">Eliminar</button>
                                                </div>
                                            </div>
                                            <!-- /.modal-content -->
                                        </div>
                                        <!-- /.modal-dialog -->
                                    </div>
                                    <!-- /.modal -->
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
                <div class="modal fade" id="modal-newRecurso">
                    <div class="modal-dialog">
                        <div class="modal-content" style="width: 85%;margin-left: 12%">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Formulario Adjuntar Recursos de Ventas</h4>
                            </div>
                            <div class="modal-body">
                                <form role="form">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="descripcion">Descripción</label>
                                            <input type="text" class="form-control" id="descripcion" placeholder="Ingrese Descripción">
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputFile">Seleccionar Documento</label>
                                            <input type="file" id="exampleInputFile">
                                        </div>
                                    </div>
                                </form>
                                <div class="modal-footer">
                                    <button type="button"  class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                    <button type="button" id="addRecurso" class="btn btn-primary">Guardar</button>
                                </div>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>
                    <!-- /.modal -->
                </div>
            </div>
            <?php include './FooterAdmin.php'; ?>
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
        <script src="../dist/js/funciones_usuario.js" type="text/javascript"></script>
        <!-- page script -->
        <script>
            var mensaje = getParameterByName('mensaje');

            $(function () {
                $('#example1').DataTable();
            })

            if (mensaje == 'create') {
                showAlert("Recurso creado corectamente", "success");
            }

            if (mensaje == 'update') {
                showAlert("Usuario Actualizado con exito", "success");
            }

            if (mensaje == 'delete') {
                showAlert("Recurso Eliminado con exito", "success");
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
