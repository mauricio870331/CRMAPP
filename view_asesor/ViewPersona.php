<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>CRMAPP | Crear Persona</title>

        <!-- Bootstrap -->
        <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Font Awesome -->
        <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <!-- NProgress -->
        <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
        <!-- bootstrap-daterangepicker -->
        <link href="../vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
        <!-- bootstrap-datetimepicker -->
        <link href="../vendors/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css" rel="stylesheet">
        <!-- jQuery custom content scroller -->
        <link href="../vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css" rel="stylesheet"/>

        <!-- Custom Theme Style -->
        <link href="../build/css/custom.min.css" rel="stylesheet">
        <link href="../src/cssmensajes/estilo.css" rel="stylesheet"/>
    </head>

    <body class="nav-md">

        <div class="container body" id="Up">
            <div class="main_container">
                <?php
                include './menu.php';
                ?>                

                <!-- page content -->
                <div class="right_col" role="main">
                    <div id="mensaje" >
                        <img id="imageMessage">
                        <div class="messageStyle">
                            <p id="txtMensaje"></p>
                        </div>
                    </div>
                    <div class="">

                        <div class="clearfix"></div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="x_panel">
                                    <div class="x_title">
                                        <h2>Crear Persona</h2>                                       
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="x_content">
                                        <br />
                                        <?php
                                        include_once '../Controllers/PersonaController.php';
                                        $user = getPersonById($_GET['personId']);
//                                        echo "<pre>";
//                                        print_r($user);
                                        ?>
                                        <form id="demo-form2" class="form-horizontal form-label-left" autocomplete="off">
                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Tipo Documento</label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <select class="form-control" name="tipo_doc" id="tipo_doc">
                                                        <option value="">Seleccione</option>
                                                        <?php
                                                        include_once '../Controllers/TipoDocumentoController.php';
                                                        $list = listTiposDoc();
//                                                        print_r($list);
                                                        for ($index = 0; $index < count($list); $index++) {
                                                            ?>
                                                            <option value="<?php echo $list[$index]['tipo_doc']; ?>" <?php echo ($list[$index]['tipo_doc'] == $user[0]['tipo_doc']) ? "selected" : "" ?> >
                                                                <?php echo $list[$index]['nombre']; ?></option>
                                                            <?php
                                                        }
                                                        ?>                                                        
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="documento">Documento<span class="required">*</span>
                                                </label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input type="text" id="documento" name="documento" value="<?php echo $user[0]['documento'] ?>" class="form-control col-md-7 col-xs-12">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nombres">Nombres<span class="required">*</span>
                                                </label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input type="text" id="nombres" name="nombres" value="<?php echo $user[0]['nombres'] ?>" class="form-control col-md-7 col-xs-12">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="middle-name" for="apellidos" class="control-label col-md-3 col-sm-3 col-xs-12">Apellidos<span class="required">*</span></label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input id="apellidos" class="form-control col-md-7 col-xs-12" value="<?php echo $user[0]['apellidos'] ?>" type="text" name="apellidos">
                                                </div>
                                            </div>    
                                            <div class="form-group">
                                                <label for="telefonos" class="control-label col-md-3 col-sm-3 col-xs-12">Telefonos</label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input id="telefonos" class="form-control col-md-7 col-xs-12" value="<?php echo $user[0]['telefonos'] ?>" type="text" name="telefonos">
                                                </div>
                                            </div> 
                                            <div class="form-group">
                                                <label for="direccion" class="control-label col-md-3 col-sm-3 col-xs-12">Dirección</label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input id="direccion" class="form-control col-md-7 col-xs-12" value="<?php echo $user[0]['direccion'] ?>" type="text" name="direccion">
                                                </div>
                                            </div> 

                                            <div class="form-group">
                                                <label for="ss" class="control-label col-md-3 col-sm-3 col-xs-12">S.Social<span class="required">*</span></label></label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input id="ss" class="form-control col-md-7 col-xs-12" type="text" value="<?php echo $user[0]['ss'] ?>" name="ss">
                                                </div>
                                            </div>                                            

                                            <div class="form-group">
                                                <label for="email" class="control-label col-md-3 col-sm-3 col-xs-12">E-Mail<span class="required">*</span></label></label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input id="email" class="form-control col-md-7 col-xs-12" type="text" value="<?php echo $user[0]['email'] ?>" name="email">
                                                </div>
                                            </div> 

                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Asesor</label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <select class="form-control" name="asesor" id="asesor">
                                                        <option value="">Seleccione</option>
                                                        <?php
                                                        $list = ListAsesores("ASESOR");
                                                        for ($index = 0; $index < count($list); $index++) {
                                                            ?>
                                                            <option value="<?php echo $list[$index]['id']; ?>" <?php echo ($list[$index]['id'] == $user[0]['asesor']) ? "selected" : "" ?> ><?php echo $list[$index]['nombres'] . " " . $list[$index]['apellidos']; ?></option>
                                                            <?php
                                                        }
                                                        ?> 
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Situación</label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <select class="form-control" name="situacion" id="situacion">
                                                        <option value="">Seleccione</option>
                                                        <?php
                                                        
                                                        $list = ListSituacion();
                                                        for ($index = 0; $index < count($list); $index++) {
                                                            ?>
                                                            <option value="<?php echo $list[$index]['id_situacion']; ?>" <?php echo ($list[$index]['id_situacion'] == $user[0]['id_situacion']) ? "selected" : "" ?> ><?php echo $list[$index]['estado']; ?></option>
                                                            <?php
                                                        }
                                                        ?> 
                                                    </select>
                                                </div>
                                            </div>


                                            <div class="form-group">
                                                <label for="ss" class="control-label col-md-3 col-sm-3 col-xs-12">Cita<span class="required">*</span></label></label>
                                                <div class='col-md-6 col-sm-6 col-xs-12'>                                            
                                                    <div class='input-group date' id='myDatepicker2'>
                                                        <input id="cita" name="cita" type='text' class="form-control" value="<?php echo $user[0]['cita'] ?>" />
                                                        <span class="input-group-addon">
                                                            <span class="glyphicon glyphicon-calendar"></span>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div> 

                                            <div class="form-group">
                                                <label for="ss" class="control-label col-md-3 col-sm-3 col-xs-12">Fecha de Nacimiento<span class="required">*</span></label></label>
                                                <div class='col-md-6 col-sm-6 col-xs-12'>                                            
                                                    <div class='input-group date' id='myDatepicker'>
                                                        <input id="dob" name="dob" type='text' value="<?php echo $user[0]['dob'] ?>" class="form-control" />
                                                        <span class="input-group-addon">
                                                            <span class="glyphicon glyphicon-calendar"></span>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div> 


                                            <div class="ln_solid"></div>
                                            <div class="form-group">
                                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                                    <button onclick="redireccionarPagina('ListPersonas.php')" class="btn btn-primary" type="button">Cancelar</button>
                                                    <button id="reset" class="btn btn-primary" type="reset">Reset</button>
                                                    <button type="button" id="send" onclick="sendPerson('update')" class="btn btn-success">Guardar</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- /page content -->

                <?php
                include './footer.php';
                ?>
            </div>
        </div>

        <!-- jQuery -->
        <script src="../vendors/jquery/dist/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
        <!-- FastClick -->
        <script src="../vendors/fastclick/lib/fastclick.js"></script>
        <!-- NProgress -->
        <script src="../vendors/nprogress/nprogress.js"></script>
        <!-- bootstrap-daterangepicker -->
        <script src="../vendors/moment/min/moment.min.js"></script>
        <script src="../vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
        <!-- bootstrap-datetimepicker -->    
        <script src="../vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
        <!-- jQuery custom content scroller -->
        <script src="../vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script>
        <!-- Custom Theme Scripts -->
        <script src="../build/js/custom.min.js"></script>
        <script src="../vendors/Funciones.js" type="text/javascript"></script>
        <script>

                                                        $('#myDatepicker').datetimepicker({
                                                            format: 'YYYY-MM-DD'
                                                        });

                                                        $('#myDatepicker2').datetimepicker({
                                                            format: 'YYYY-MM-DD'
                                                        });


        </script>
    </body>

</html>