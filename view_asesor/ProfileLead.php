<?php
session_start();
require '../Model/BD.php';
$con = new BD();
$SQL_SELECT = "SELECT u.*, concat(asesor.nombres, ' ', asesor.apellidos) asesor,"
        . "es.estado estado_lead, si.estado situacion, c.ciudad, sc.estado FROM personas u "
        . "inner join estados_personas ep on ep.id_persona = u.id 
                       and ep.fecha_registro = (select MAX(f.fecha_registro) from estados_personas f where f.id_persona = u.id) "
        . "inner join estados es on es.id_estado = ep.id_estado "
        . "inner join situacion_personas sp on sp.id_persona = u.id 
                       and sp.fecha_registro = (select MAX(sf.fecha_registro) from situacion_personas sf where sf.id_persona = u.id) "
        . "inner join situacion si on si.id_situacion = sp.id_situacion   "
        . "left join usuarios asesor on u.asesor = asesor.id "
        . "inner join ciudad c on c.id = u.id_ciudad "
        . "inner join estado sc on sc.id = u.id_estado where u.ss =" . base64_decode($_GET['token']);
$rsLead = $con->findAll2($SQL_SELECT);
$con->desconectar();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link href="../dist/img/Favicon.png" rel="shortcut icon" />
        <title>Perfil del Lead</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.7 -->
        <link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap.min.css">
        <link rel="stylesheet"  href="../bower_components/font-awesome/css/font-awesome.min.css" />
        <link rel="stylesheet" href="../bower_components/Ionicons/css/ionicons.min.css">       
        <link rel="stylesheet" href="../bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
        <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">       
        <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
        <link rel="stylesheet" href="../dist/css/mycss.css" /> 
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
            <!-- Menu -->
            <?php include_once '../view_asesor/MenuAsesor.php'; ?>
            <!-- =============================================== -->

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Perfil | <button type="button" id="backfromProfile" class="btn btn-success">Regresar</button>
                    </h1>                    
                </section>
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-md-3">

                            <!-- Profile Image -->
                            <div class="box box-primary">
                                <div class="box-body box-profile">
                                    <img class="profile-user-img img-responsive" style="width: 100%" src="../Model/Usuarios/imageProfile.php" alt="User profile picture">

                                    <h4 class="profile-username text-center" style="font-size: 18px;"><?php echo $rsLead[0]['nombres'] . " " . $rsLead[0]['apellidos'] ?></h4>
                                    <!-- Mostrar solo 22 caracteres -->
                                    <p class="text-muted text-center"> 
                                        <span class="label label-success">  
                                            <?php echo $rsLead[0]['situacion']; ?>
                                        </span>
                                    </p>
                                    <ul class="list-group list-group-unbordered">
                                        <li class="list-group-item">
                                            <b>S. Social</b> <a class="pull-right textoc"><?php echo $rsLead[0]['ss'] ?></a>
                                        </li>                                                                              
                                    </ul>                                   
                                </div>
                                <!-- /.box-body -->
                            </div>
                            <!-- /.box -->

                            <!-- About Me Box -->
                            <div class="box box-primary">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Estado</h3>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <strong><i class="fa fa-book margin-r-5"></i> Tu estado actual es:</strong>
                                    <p class="text-muted">
                                        <span class="pull badge bg-green" style="font-size: 15px;margin-left: 8%;"><?php echo $rsLead[0]['estado_lead'] ?></span>
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
                                    <li id="tabTimeline" class="active"><a href="#timeline" data-toggle="tab">Información de Contacto</a></li>
                                    <li id="tabDocs"><a href="#docs" data-toggle="tab">Documentos</a></li>                                    
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
                                                            <li class="separated"><b>Fecha de Nacimiento:</b><a href="#" class="textop"> <?php echo $rsLead[0]['dob'] ?></a></li>
                                                            <li class="separated"><b>Seguro Social:</b> <a href="#" class="textop"><?php echo $rsLead[0]['ss'] ?></a></li>
                                                            <li class="separated"><b>Nombres:</b> <a href="#" class="textop"> <?php echo $rsLead[0]['nombres'] ?></a></li>
                                                            <li class="separated"><b>Apellidos:</b> <a href="#" class="textop"> <?php echo $rsLead[0]['apellidos'] ?></a></li>

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
                                                            <li class="separated"><b>Dirección:</b> <a href="#" class="textop"> <?php echo $rsLead[0]['direccion'] ?></a></li>
                                                            <li class="separated"><b>Telefonos:</b> <a href="#" class="textop"> <?php echo $rsLead[0]['telefonos'] ?></a></li>
                                                            <li class="separated"><b>Email:</b> <a href="#" class="textop"> <?php echo $rsLead[0]['email'] ?></a></li>
                                                            <li class="separated"><b>Ciudad:</b> <a href="#" class="textop"> <?php echo $rsLead[0]['ciudad'] ?></a></li>
                                                            <li class="separated"><b>Estado:</b> <a href="#" class="textop"> <?php echo $rsLead[0]['estado'] ?></a></li>
                                                        </ul>
                                                    </div>                                                    
                                                </div>
                                            </li>
                                            <!-- END timeline item -->                                        

                                        </ul>
                                    </div>
                                    <!-- /.tab-pane -->


                                    <div class="tab-pane" id="docs">                                        
                                        <!-- /.box-header -->
                                        <div>
                                            <i class="fa fa-fw fa-plus-circle newDocument"  style="color: #008d4c;cursor: pointer;font-size: 20px;" data-id="<?php echo $rsLead[0]['ss']; ?>" data-toggle="tooltip" title="Nuevo Documento"></i>
                                            <button type="button" style="display: none" class="btn btn-default" data-toggle="modal" data-target="#modal-default" id="newDoc<?php echo $rsLead[0]['ss']; ?>"/>
                                        </div>
                                        <div class="box">                                            
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
                                                        $SQL_SELECT = "SELECT * from documentos where ss_persona =" . base64_decode($_GET['token']);
                                                        $rsDocs = $con->findAll2($SQL_SELECT);
                                                        $con->desconectar();
                                                        ?>
                                                        <?php for ($i = 0; $i < count($rsDocs); $i++) { ?>
                                                            <tr>
                                                                <td><a class="textoc"><?php echo $rsDocs[$i]['id_documento'] ?></a></td>
                                                                <td><a class="textoc"><?php echo $rsDocs[$i]['descripcion'] ?></a></td>
                                                                <td><a class="textoc" target="_blank" href="<?php echo $rsDocs[$i]['ruta'] . $rsDocs[$i]['nombre_archivo'] ?>" ><?php echo $rsDocs[$i]['nombre_archivo'] ?></a></td>
                                                                <td><a class="textoc"><?php echo $rsDocs[$i]['fecha_registro'] ?></a></td>
                                                                <td>
                                                                    <div class="col-md-3 col-sm-4" style="margin-right: -5%;">
                                                                        <i class="fa fa-fw fa-eraser deleteDoc" data-ssocial="<?php echo $_GET['token'] ?>" data-id="<?php echo $rsDocs[$i]['id_documento']; ?>" data-toggle="tooltip" title="Borrar"></i>
                                                                        <button type="button" style="display: none" class="btn btn-default" data-toggle="modal" data-target="#modal-deleteDoc" id="docId<?php echo $rsDocs[$i]['id_documento'] ?>"/>
                                                                    </div>
                                                                </td>                                                                
                                                            </tr>
                                                        <?php } ?>
                                                    </tbody>                                               
                                                </table> 
                                            </div>
                                            <!-- /.box-body -->
                                        </div>
                                        <!-- /.tab-pane -->      
                                    </div>
                                    <!-- /.tab-content -->


                                    <div class="tab-pane" id="pagos">                                        
                                        <!-- /.box-header -->
                                        <div class="box">                                            
                                            <div class="box-body">
                                                Contenido aqui
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
                        <div class="modal-content" style="width: 85%;margin-left: 12%">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Formulario Adjuntar Documentos</h4>
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
                                    <button type="button" id="addDocument" data-id=""  class="btn btn-primary">Guardar</button>
                                </div>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>
                    <!-- /.modal -->
                </div>


                <div class="modal fade" id="modal-deleteDoc">
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
                                <button type="button" id="deleteDoc" data-id="" data-ss=""   class="btn btn-primary">Eliminar</button>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->

            </div>
            <!-- /.content-wrapper -->
            <?php include_once '../view_asesor/FooterASesor.php'; ?>       
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
        <script src="../dist/js/notify.js" type="text/javascript"></script>
        <script src="../dist/js/funciones_leads.js"></script>
        <!-- page script -->
        <script>

            $(function () {
                $('#example1').DataTable()
            })


            var mensaje = getParameterByName('mensaje');
            if (mensaje === 'ok') {
                showAlert("Documento Cargado con exito..!", "success");
                $("#timeline").removeClass("active");
                $("#tabTimeline").removeClass("active");
                $("#docs").addClass("active");
                $("#tabDocs").addClass("active");
            }

            if (mensaje === 'updateok') {
                showAlert("Afiliado Actualizado con exito", "success");
            }

            if (mensaje === 'deleteok') {
                showAlert("Se elimino el documento con exito..!", "success");
                $("#timeline").removeClass("active");
                $("#tabTimeline").removeClass("active");
                $("#docs").addClass("active");
                $("#tabDocs").addClass("active");
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