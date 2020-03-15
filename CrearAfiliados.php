<?php
session_start();
require_once './Model/BD.php';
$con = new BD();
$rsPaises = $con->findAll2("SELECT * FROM paises order by nombre");
$rs = $con->findAll2("SELECT * FROM departamentos order by departamento");
//print_r($rs);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link href="dist/img/Favicon.png" rel="shortcut icon" />
        <title>Crear Afiliados</title>
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
                        Crear Afiliados || <input type="button" id="cancelarAfiliados" class="btn btn-success"  value="Cancelar">                      
                    </h1> 

                </section>

                <!-- Main content -->
                <section class="content">
                    <!-- Default box -->
                    <div class="box-body" style="margin-top: -1%">
                        <div class="col-md-8" style="margin-left: 15%">
                            <!-- general form elements -->
                            <div class="box box-primary">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Los campos marcados con (*) son obligatorios.</h3>

                                </div>
                                <!-- /.box-header -->
                                <!-- form start -->
                                <form role="form" id_createAfiliados>
                                    <!-- step_1 -->
                                    <div class="box-body" id="step_1">
                                        <div class="form-group">
                                            <label>*Fecha de Nacimiento:</label>
                                            <div class="input-group date">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                                <input type="text" class="form-control pull-right" id="nacimiento" />
                                            </div>
                                            <!-- /.input group -->
                                        </div>



                                        <div class="form-group">
                                            <label>*Tipo Documento</label>
                                            <select class="form-control" id="tipo_doc">
                                                <option>Seleccione</option>
                                                <option>Cédula de Ciudadania</option>
                                                <option>Cédula de Extrangeria</option>
                                                <option>Pasaporte</option>
                                                <option>Rut</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="Documento">*Documento</label>
                                            <input type="text" class="form-control" id="Documento" placeholder="Ingrese Documento">
                                        </div>
                                        <div class="form-group">
                                            <label>*Fecha de Expedicion Documento:</label>
                                            <div class="input-group date">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                                <input type="text" class="form-control pull-right" id="fechExpedicion"/>
                                            </div>
                                            <!-- /.input group -->
                                        </div>

                                        <div class="form-group">
                                            <label for="lugarExpe">*Lugar de Expedicion del Documento</label>
                                            <input type="text" class="form-control" id="lugarExpe" placeholder="Ingrese Lugar de Expedicion">
                                        </div> 

                                        <div class="form-group">
                                            <label for="Nombres">*Nombres</label>
                                            <input type="text" class="form-control" id="Nombres" placeholder="Ingrese Nombres">
                                        </div>
                                        <div class="form-group">
                                            <label for="Apellidos">*Apellidos</label>
                                            <input type="text" class="form-control" id="Apellidos" placeholder="Ingrese Apellidos">
                                        </div>                                        
                                        <div class="form-group">
                                            <label>*Genero</label>
                                            <select class="form-control" id="genero">
                                                <option>Seleccione</option>
                                                <option>Masculino</option>
                                                <option>Femenino</option>
                                                <option>Otro</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>*Nacionalidad</label>
                                            <select class="form-control" id="nacionalidad">
                                                <option>Seleccione</option>   
                                                <?php foreach ($rsPaises as $key => $value) { ?>
                                                    <option value="<?php echo $value['id'] ?>"><?php echo $value['nombre'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>

                                    </div>
                                    <!-- /.box-body -->
                                    <!-- step_2 -->
                                    <div class="box-body" id="step_2" style="display: none">

                                        <div class="form-group">
                                            <label>*Departamento Residencia</label>
                                            <select class="form-control" id="departamento">
                                                <option>Seleccione</option>
                                                <?php foreach ($rs as $key => $value) { ?>
                                                    <option value="<?php echo $value['id_departamento'] ?>"><?php echo $value['departamento'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>*Ciudad Residencia</label>
                                            <select class="form-control" id="ciudad">
                                                <option>Seleccione</option>                                                
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="direccion">*Dirección</label>
                                            <input type="text" class="form-control" id="direccion" placeholder="Ingrese Direccion">
                                        </div> 

                                        <div class="form-group">
                                            <label for="correspondencia">*Dirección de Correspondencia</label>
                                            <input type="text" class="form-control" id="correspondencia" placeholder="Ingrese Dirección de Correspondencia">
                                        </div> 

                                        <div class="form-group">
                                            <label for="telefonos">*Telefonos (Separados por ',')</label>
                                            <input type="text" class="form-control" id="telefonos" placeholder="Ingrese Telefonos">
                                        </div> 

                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="text" class="form-control" id="email" placeholder="Ingrese Email">
                                        </div> 

                                        <div class="form-group">
                                            <label>*Estado Civil</label>
                                            <select class="form-control" id="estadocivil">
                                                <option>Seleccione</option>   
                                                <option>Soltero</option>    
                                                <option>Casado</option>  
                                                <option>Unión Libre</option>  
                                                <option>Otro</option> 
                                            </select>
                                        </div>


                                        <div class="form-group">
                                            <label for="foto">Tomar Foto</label> 
                                            <!-- Crear Modal para llamar a la foto-->
                                            <a><i class="fa fa-fw fa-camera-retro fa-2x capturePicture" style="cursor: pointer;" data-toggle="tooltip" title="Tomar Foto"></i></a>  
                                            <button type="button" style="display: none" class="btn btn-default" data-toggle="modal" data-target="#modal-default" id="cathPicture"/>
                                        </div>  

                                        <div class="form-group">
                                            <label for="foto">Foto</label>                                            
                                            <input type="file" id="fotoz" value="z"> 
                                        </div>  
                                    </div>

                                    <!-- step_3 -->
                                    <div class="box-body" id="step_3" style="display: none">

                                        <div class="form-group">
                                            <label for="turno">*Turno</label>
                                            <input type="text" class="form-control" id="turno" placeholder="Ingrese Turno">
                                        </div> 

                                        <div class="form-group">
                                            <label>*Dia de Pago</label>
                                            <select class="form-control" id="diadepago">
                                                <option>Seleccione</option>
                                                <?php for ($index = 1; $index < 32; $index++) { ?>
                                                    <option value="<?php echo ($index < 10) ? "0" . $index : $index; ?>"><?php echo ($index < 10) ? "0" . $index : $index; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div> 
                                    </div>

                                    <div class="box-footer" style="margin-top: -3%">

                                        <input type="button" id="ForwardStep"  class="btn btn-primary" style="display: none" value="Atras">
                                        <input type="button" id="NextStep"  class="btn btn-primary" value="Siguiente">
                                        <input type="button" id="CrearAfiliadosBtn" class="btn btn-primary" style="display: none" value="Guardar">  

                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->

                    <!-- /.box -->
                    <div class="modal fade" id="modal-default">
                        <div class="modal-dialog">
                            <div class="modal-content" style="width: 60%;margin-left: 28%">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title">Capturando Imagen</h4>
                                </div>
                                <div class="modal-body">
                                    <!-- Stream video via webcam -->
                                    <div class="video-wrap">
                                        <video id="video" playsinline autoplay></video>
                                    </div>                              
                                    <p id="estado"></p>
                                    <!-- Webcam video snapshot -->
                                    <canvas id="canvas" style="display: none;margin-left: 10%" width="270" height="270"></canvas>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" id="closeModalwebcam"  class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                                    <button type="button" id="boton"  class="btn btn-primary">Capturar</button>
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
        <!-- AdminLTE App -->
        <!-- bootstrap datepicker -->
        <script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
        <script src="dist/js/adminlte.min.js"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="dist/js/demo.js"></script>
        <!-- funciones propias -->
        <script src="dist/js/notify.js" type="text/javascript"></script>
        <script src="dist/js/funciones.js"></script>
        <script src="dist/js/webcam.js"></script>
        <script>
            $(document).ready(function () {
                $('.sidebar-menu').tree()

            })
            $(function () {

                //Date picker
                $('#nacimiento').datepicker({
                    autoclose: true
                })

                $('#fechExpedicion').datepicker({
                    autoclose: true
                })


            })
        </script>
    </body>
</html>
