<?php
session_start();
require '../Model/BD.php';

$con = new BD();
$rs = $con->findAll2("SELECT * FROM usuarios WHERE id = " . base64_decode($_GET['token']) . "");
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link href="dist/img/Favicon.png" rel="shortcut icon" />
        <title>Actualizar Usuarios</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.7 -->
        <link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="../bower_components/font-awesome/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="../bower_components/Ionicons/css/ionicons.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
        <!-- AdminLTE Skins. Choose a skin from the css/skins
             folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
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
            <?php include_once '../view_admin/HeaderAdmin.php'; ?>
            <!-- =============================================== -->

            <!-- =============================================== -->

            <!-- Left side column. contains the sidebar -->
            <!-- Menu -->
            <?php include_once '../view_admin/MenuAdmin.php'; ?>
            <!-- =============================================== -->

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Crear Usuarios || <input type="button" id="backCrearUsuarios" class="btn btn-success"  value="Cancelar">                       
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
                                            <label>*Tipo Documento</label>
                                            <select class="form-control" name="tipo_doc" id="tipo_doc">
                                                <option value="">Seleccione</option>
                                                <?php
                                                $con = new BD();
                                                $SQL_SELECT = "SELECT * FROM tipo_documento";
                                                $list = $con->query($SQL_SELECT);
                                                $con->desconectar();
                                                for ($index = 0; $index < count($list); $index++) {
                                                    ?>
                                                    <option value="<?php echo $list[$index]['tipo_doc']; ?>" <?php echo ($list[$index]['tipo_doc'] == $rs[0]['tipo_doc']) ? "selected" : "" ?>><?php echo $list[$index]['nombre']; ?></option>
                                                    <?php
                                                }
                                                ?> 
                                            </select>
                                        </div>


                                        <div class="form-group">
                                            <label for="Documento">*Documento</label>
                                            <input type="text" class="form-control" id="documento" value="<?php echo $rs[0]['documento']; ?>" placeholder="Ingrese Documento">
                                        </div>
                                        <div class="form-group">
                                            <label for="Nombres">*Nombres</label>
                                            <input type="text" class="form-control" id="nombres" placeholder="Ingrese Nombres" value="<?php echo $rs[0]['nombres']; ?>" >
                                        </div>
                                        <div class="form-group">
                                            <label for="Apellidos">*Apellidos</label>
                                            <input type="text" class="form-control" id="apellidos" placeholder="Ingrese Apellidos" value="<?php echo $rs[0]['apellidos']; ?>" >
                                        </div>
                                        <div class="form-group">
                                            <label for="telefonos">*Telefonos</label>
                                            <input type="text" class="form-control" id="telefonos" placeholder="Ingrese Telefonos" value="<?php echo $rs[0]['telefono']; ?>" >
                                        </div>


                                        <div class="form-group">
                                            <label>*Tipo Usuario</label>
                                            <select class="form-control" name="tipo_user" id="tipo_user">
                                                <option value="">Seleccione</option>
                                                <?php
                                                $con = new BD();
                                                $SQL_SELECT = "SELECT * FROM tipo_usuario";
                                                $list = $con->query($SQL_SELECT);
                                                $con->desconectar();
                                                for ($index = 0; $index < count($list); $index++) {
                                                    ?>
                                                    <option value="<?php echo $list[$index]['id_tipo_usuario']; ?>" <?php echo ($list[$index]['id_tipo_usuario'] == $rs[0]['id_tipo_usuario']) ? "selected" : "" ?> ><?php echo $list[$index]['descripcion']; ?></option>
                                                    <?php
                                                }
                                                ?> 
                                            </select>
                                        </div>


                                        <div class="form-group">
                                            <label>*Coach?</label>
                                            <input class="coach" type="radio" name="isCoach" value="No" checked="true">No &nbsp;
                                            <input class="coach"  type="radio" name="isCoach" value="Si" <?php echo ($rs[0]['coach']) ? "checked='true'" : "" ?> >Si
                                        </div> 


                                        <div id="showCoach" class="form-group" <?php echo ($rs[0]['coach']) ? "" : "style='display: none;'" ?>>
                                            <label>*Coach</label>
                                            <select class="form-control" name="coach" id="coach">
                                                <option value="">Seleccione</option>
                                                <?php
                                                $con = new BD();
                                                $SQL_SELECT = "SELECT id, nombres, apellidos FROM usuarios u "
                                                        . "inner join tipo_usuario t on u.id_tipo_usuario = t.id_tipo_usuario "
                                                        . "where t.descripcion = 'COACH'";
                                                $list = $con->query($SQL_SELECT);
                                                $con->desconectar();
                                                for ($index = 0; $index < count($list); $index++) {
                                                    ?>
                                                    <option value="<?php echo $list[$index]['id']; ?>"><?php echo $list[$index]['nombres'] . " " . $list[$index]['apellidos']; ?></option>
                                                    <?php
                                                }
                                                ?> 
                                            </select>
                                        </div>


                                        <div class="form-group">
                                            <label for="pass">*Contraseña</label>
                                            <input type="password" class="form-control" id="pass" value="<?php echo $rs[0]['password']; ?>" placeholder="Ingrese Contraseña">
                                        </div>
                                        <div class="form-group">
                                            <label for="foto">Foto</label>
                                            <input type="file" id="foto">  
                                            <?php
                                            if ($rs[0]['foto'] != null) {
                                                echo "Seleccione otro archivo para cambiar la foto actual";
                                            }
                                            ?>
                                        </div>                                            
                                    </div>
                                    <!-- /.box-body -->

                                    <div class="box-footer">
                                         <input type="hidden" id="id" value="<?php echo base64_decode($_GET['token']); ?>">
                                        <button type="button" id="ActualizarUsuarios" class="btn btn-primary">Guardar</button>
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
            <?php include '../view_admin/FooterAdmin.php'; ?>
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
        <!-- AdminLTE App -->
        <script src="../dist/js/adminlte.min.js"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="../dist/js/demo.js"></script>
        <!-- funciones propias -->
        <script src="../dist/js/notify.js" type="text/javascript"></script>
        <script src="../dist/js/funciones_usuario.js"></script>
        <script>
            $(document).ready(function () {
                $('.sidebar-menu').tree()
            })
        </script>
    </body>
</html>
