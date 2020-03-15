<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>CRMAPP | Listado Usuarios </title>

        <!-- Bootstrap -->
        <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Font Awesome -->
        <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <!-- NProgress -->
        <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
        <!-- iCheck -->
        <link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet">
        <!-- Datatables -->
        <link href="../vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
        <link href="../vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
        <link href="../vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
        <link href="../vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
        <link href="../vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
        <!-- Custom Theme Style -->
        <link href="../build/css/custom.min.css" rel="stylesheet">

    </head>

    <body class="nav-md">
        <div class="container body">
            <div class="main_container">

                <?php
                include './menu.php';
                ?>    

                <!-- page content -->
                <div class="right_col" role="main">
                    <div class="">


                        <div class="clearfix"></div>

                        <div class="row">

                            <div class="clearfix"></div>

                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="x_panel">  


                                    <div class="page-title">
                                        <div class="title_left">
                                            <h2>Listado de Personas 
                                                <button type="button" id="send" onclick="redireccionarPagina('CreatePersona.php')" class="btn btn-default">Nueva Persona</button></h2>
                                        </div>

                                        <div class="title_right">
                                            <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                                                <div class="input-group">
                                                    <input id="SearchUser" type="text" class="form-control" placeholder="Ingrese un valor">
                                                    <span class="input-group-btn">
                                                        <button class="btn btn-default" onclick="findUser()" type="button">Buscar</button>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="clearfix">
                                        <hr style="margin-bottom: 17px;
                                            margin-top: 10px;">
                                    </div>

                                    <div class="x_content">


                                        <div class="table-responsive">
                                            <table id="datatable" class="table table-striped table-bordered jambo_table bulk_action">
                                                <thead>
                                                    <tr class="headings">

                                                        <th class="column-title">Id </th>
                                                        <th class="column-title">Estado | Situción</th>
                                                        <th class="column-title">Documento </th>
                                                        <th class="column-title">Nombres </th>
                                                        <th class="column-title">Apellidos </th>
                                                        <th class="column-title">Telefonos </th>
                                                        <th class="column-title">Asesor </th>
                                                        <th class="column-title no-link last"><span class="nobr">Action</span></th>

                                                    </tr>
                                                </thead>

                                                <tbody id="data-usuarios">

                                                    <?php
                                                    include_once '../Controllers/PersonaController.php';

                                                    for ($index = 0; $index < count($lisPersonas); $index++) {
                                                        ?>
                                                        <tr class="even pointer">                                                            
                                                            <td class="a-right"><?php echo $lisPersonas[$index]['id']; ?></td>                                                            
                                                            <td class="a-right">
                                                                <span class="label label-success" style="margin-right: 2px;">
                                                                    <?php echo $lisPersonas[$index]['estado']; ?>                                                           
                                                                </span>                                                       
                                                                |
                                                                <span class="label label-success">  
                                                                    <?php echo $lisPersonas[$index]['situacion']; ?>
                                                                </span>
                                                            </td>
                                                            <td class="a-right"><?php echo $lisPersonas[$index]['siglas'] . " " . $lisPersonas[$index]['documento']; ?></td>
                                                            <td class="a-right"><?php echo $lisPersonas[$index]['nombres']; ?></td>
                                                            <td class="a-right"><?php echo $lisPersonas[$index]['apellidos']; ?></td>
                                                            <td class="a-right"><?php echo $lisPersonas[$index]['telefonos']; ?></td>
                                                            <td class="a-right"><?php echo $lisPersonas[$index]['asesor']; ?></td>
                                                            <td class=" last">
                                                                <a style="margin-left: 5px;" href="ViewPersona.php?personId=<?php echo $lisPersonas[$index]['id']; ?>">Ver</a> 
                                                                |
                                                                <a data-toggle="modal" data-target=".bs-example-modal-sm"
                                                                   style="margin-left: 5px;" onclick="setDelete(<?php echo $lisPersonas[$index]['id']; ?>)" href="#">Eliminar</a>
                                                            </td>
                                                        </tr>
                                                        <?php
                                                    }
                                                    ?> 
                                                </tbody>
                                            </table>
                                            <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
                                                <div class="modal-dialog modal-sm">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                                                            </button>
                                                            <h4 class="modal-title" id="myModalLabel2">Eliminar Usuario</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <h4>Aviso.!</h4>
                                                            <p>Esta seguro de eliminar el usuario seleccionado?</p>                                                           
                                                        </div>
                                                        <div class="modal-footer">
                                                            <input type="hidden" id="idDel">
                                                            <button type="button" onclick="setDelete('')" class="btn btn-default" data-dismiss="modal">No</button>
                                                            <button type="button" class="btn btn-danger" onclick="deleteUser()" >Si</button>
                                                        </div>
                                                    </div>
                                                </div> 
                                            </div>
                                        </div>                                       
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /page content -->    



                <!-- footer content -->
                <?php
                include './footer.php';
                ?>
                <!-- /footer content -->
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
        <!-- iCheck -->
        <script src="../vendors/iCheck/icheck.min.js"></script>

        <!-- Custom Theme Scripts -->
        <script src="../build/js/custom.min.js"></script>

        <!-- Datatables -->
        <script src="../vendors/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="../vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
        <script src="../vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
        <script src="../vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
        <script src="../vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
        <script src="../vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
        <script src="../vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
        <script src="../vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
        <script src="../vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
        <script src="../vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
        <script src="../vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
        <script src="../vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
        <script src="../vendors/Funciones.js" type="text/javascript"></script>

    </body>
</html>
