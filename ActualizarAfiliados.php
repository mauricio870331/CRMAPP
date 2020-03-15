<?php
session_start();
require './Model/Utils.php';
require './Model/BD.php';
$con = new BD();
$rsPaises = $con->findAll2("SELECT * FROM paises order by nombre");
$rs = $con->findAll2("SELECT * FROM departamentos order by departamento");
$sql = "SELECT * FROM afiliados a "
        . "inner join datos_afiliado b on a.id_afiliado = b.id_afiliado "
        . "inner join departamentos c on b.departamento = c.id_departamento "
        . "inner join municipios d on b.ciudad_residencia = d.id_municipio "
        . "WHERE a.id_afiliado = " . base64_decode($_GET['token']) . "";
//echo $sql;
$rsAfiliado = $con->findAll2($sql);
//echo "<pre>";
//print_r($rsAfiliado);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link href="dist/img/Favicon.png" rel="shortcut icon" />
        <title>Actualizar Afiliados</title>
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

            <?php include_once './Header.php'; ?>

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
                        Actualizar Afiliados || <input type="button" id="cancelarAfiliados2" class="btn btn-success"  value="Cancelar">                      
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
                                                <input type="text" class="form-control pull-right" id="nacimiento" value="<?php echo Utils::YMD_TO_DMY($rsAfiliado[0]['fecha_nacimiento']) ?>" />
                                            </div>
                                            <!-- /.input group -->
                                        </div>

                                        <div class="form-group">
                                            <label>*Tipo Documento</label>
                                            <select class="form-control" id="tipo_doc" >
                                                <option>Seleccione</option>
                                                <option <?php echo (utf8_decode($rsAfiliado[0]['tipo_doc']) == "Cédula de Ciudadania") ? 'selected' : '' ?> >Cédula de Ciudadania</option>
                                                <option <?php echo (utf8_decode($rsAfiliado[0]['tipo_doc']) == "Cédula de Extrangeria") ? 'selected' : '' ?> >Cédula de Extrangeria</option>
                                                <option <?php echo (utf8_decode($rsAfiliado[0]['tipo_doc']) == "Pasaporte") ? 'selected' : '' ?> >Pasaporte</option>
                                                <option <?php echo (utf8_decode($rsAfiliado[0]['tipo_doc']) == "Rut") ? 'selected' : '' ?> >Rut</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="Documento">*Documento</label>
                                            <input type="text" class="form-control" id="Documento" value="<?php echo $rsAfiliado[0]['documento'] ?>" placeholder="Ingrese Documento">
                                        </div>
                                        <div class="form-group">
                                            <label>*Fecha de Expedicion Documento:</label>
                                            <div class="input-group date">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                                <input type="text" class="form-control pull-right" id="fechExpedicion" value="<?php echo Utils::YMD_TO_DMY($rsAfiliado[0]['fecha_exp_doc']) ?>" />
                                            </div>
                                            <!-- /.input group -->
                                        </div>

                                        <div class="form-group">
                                            <label for="lugarExpe">*Lugar de Expedicion del Documento</label>
                                            <input type="text" class="form-control" id="lugarExpe" value="<?php echo $rsAfiliado[0]['lugar_expedi_doc'] ?>" placeholder="Ingrese Lugar de Expedicion">
                                        </div> 

                                        <div class="form-group">
                                            <label for="Nombres">*Nombres</label>
                                            <input type="text" class="form-control" id="Nombres" placeholder="Ingrese Nombres" value="<?php echo $rsAfiliado[0]['nombres'] ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="Apellidos">*Apellidos</label>
                                            <input type="text" class="form-control" id="Apellidos" placeholder="Ingrese Apellidos" value="<?php echo $rsAfiliado[0]['apellidos'] ?>">
                                        </div>                                        
                                        <div class="form-group">
                                            <label>*Genero</label>
                                            <select class="form-control" id="genero">
                                                <option>Seleccione</option>
                                                <option <?php echo ($rsAfiliado[0]['genero'] == "Masculino") ? 'selected' : '' ?>>Masculino</option>
                                                <option <?php echo ($rsAfiliado[0]['genero'] == "Femenino") ? 'selected' : '' ?>>Femenino</option>
                                                <option <?php echo ($rsAfiliado[0]['genero'] == "Otro") ? 'selected' : '' ?>>Otro</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>*Nacionalidad</label>
                                            <select class="form-control" id="nacionalidad">
                                                <option>Seleccione</option>   
                                                <?php foreach ($rsPaises as $key => $value) { ?>
                                                    <option <?php echo ($rsAfiliado[0]['nacionalidad'] == $value['id']) ? 'selected' : '' ?> value="<?php echo $value['id'] ?>"><?php echo $value['nombre'] ?></option>
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
                                                    <option  <?php echo ($rsAfiliado[0]['id_departamento'] == $value['id_departamento']) ? 'selected' : '' ?> value="<?php echo $value['id_departamento'] ?>"><?php echo $value['departamento'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>*Ciudad Residencia</label>
                                            <select class="form-control" id="ciudad">
                                                <option>Seleccione</option> 
                                                <option selected value="<?php echo $rsAfiliado[0]['id_municipio'] ?>" ><?php echo $rsAfiliado[0]['municipio'] ?></option> 
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="direccion">*Dirección</label>
                                            <input type="text" class="form-control" id="direccion" placeholder="Ingrese Direccion" value="<?php echo $rsAfiliado[0]['direccion'] ?>">
                                        </div> 

                                        <div class="form-group">
                                            <label for="correspondencia">*Dirección de Correspondencia</label>
                                            <input type="text" class="form-control" id="correspondencia" placeholder="Ingrese Dirección de Correspondencia" value="<?php echo $rsAfiliado[0]['direccion_correo'] ?>">
                                        </div> 

                                        <div class="form-group">
                                            <label for="telefonos">*Telefonos (Separados por ',')</label>
                                            <input type="text" class="form-control" id="telefonos" placeholder="Ingrese Telefonos" value="<?php echo $rsAfiliado[0]['telefonos'] ?>">
                                        </div> 

                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="text" class="form-control" id="email" placeholder="Ingrese Email" value="<?php echo $rsAfiliado[0]['email'] ?>">
                                        </div> 

                                        <div class="form-group">
                                            <label>*Estado Civil</label>
                                            <select class="form-control" id="estadocivil">
                                                <option>Seleccione</option>   
                                                <option <?php echo ($rsAfiliado[0]['estado_civil'] == 'Soltero') ? 'selected' : '' ?> >Soltero</option>    
                                                <option <?php echo ($rsAfiliado[0]['estado_civil'] == 'Casado') ? 'selected' : '' ?> >Casado</option>  
                                                <option <?php echo ($rsAfiliado[0]['estado_civil'] == 'Unión Libre') ? 'selected' : '' ?> >Unión Libre</option>  
                                                <option <?php echo ($rsAfiliado[0]['estado_civil'] == 'Otro') ? 'selected' : '' ?> >Otro</option> 
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
                                            <input type="hidden" value="<?php echo base64_decode($_GET['token']) ?>" id="id_afiliado"  />
                                        </div>  
                                    </div>

                                    <!-- step_3 -->
                                    <div class="box-body" id="step_3" style="display: none">

                                        <div class="form-group">
                                            <label for="turno">*Turno</label>
                                            <input type="text" class="form-control" id="turno" value="<?php echo $rsAfiliado[0]['turno'] ?>" placeholder="Ingrese Turno">
                                        </div> 

                                        <div class="form-group">
                                            <label>*Dia de Pago</label>
                                            <select class="form-control" id="diadepago">
                                                <option>Seleccione</option>
                                                <?php for ($index = 1; $index < 32; $index++) { ?>
                                                    <?php
                                                    if ($index < 10) {
                                                        $flag = "0" . $index;
                                                    } else {
                                                        $flag = $index;
                                                    }
                                                    ?>
                                                    <option  <?php echo ($rsAfiliado[0]['diadepago'] == $flag) ? 'selected' : '' ?> value="<?php echo $flag ?>"><?php echo $flag; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div> 
                                    </div>

                                    <div class="box-footer" style="margin-top: -3%">

                                        <input type="button" id="ForwardStep"  class="btn btn-primary" style="display: none" value="Atras">
                                        <input type="button" id="NextStep"  class="btn btn-primary" value="Siguiente">
                                        <input type="button" id="updateAfiliadosBtn" class="btn btn-primary" style="display: none" value="Guardar">  

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
