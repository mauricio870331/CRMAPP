<?php
session_start();
//require './Model/BD.php';
//$hoy = date("Y-m-d 23:59:59");
//$inicioMes = date("Y-01-01 00:00:00");
//$con = new BD();
//$sql = "SELECT count(a.id_afiliado) total_afiliados, 'A' estado FROM afiliados a, datos_afiliado d "
//        . "where a.id_afiliado = d.id_afiliado and d.estado_vinculo = 'Activo' "
//        . "UNION SELECT count(a.id_afiliado) total_afiliados, 'I' estado FROM afiliados a, datos_afiliado d "
//        . "where a.id_afiliado = d.id_afiliado and d.estado_vinculo = 'Inactivo'";
////echo $sql;
//$rsAf = $con->findAll2($sql); // total afiliados
////print_r($rsAf);
//$titleGrafic = "Ganancia: " . substr($inicioMes, 0, 10) . " - " . date("Y-m-d");
//
//$sqlV = "select count(id_vehiculo) total_vehiculos from vehiculos where estado = 'Activo'";
////echo $sql;
//$rsVa = $con->findAll2($sqlV);
//
//$sqlTotalGanancia = "Select sum(total) total from  pagos where  DATE_FORMAT(fecha_pago, '%Y') = '" . date('Y') . "'";
//$rsTotal = $con->findAll2($sqlTotalGanancia);
//
//$con->desconectar();
//echo $titleGrafic;
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link href="../dist/img/Favicon.png" rel="shortcut icon" />
        <title>Inicio || Home </title>
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
        <!-- Google Font -->
        <link rel="stylesheet" href="../dist/css/AllFonts.css">
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <!-- Site wrapper -->
        <div class="wrapper">

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
                        Bienvenid@ a CRM-APP                        
                    </h1>                    
                </section>

                <!-- Main content -->
                <section class="content">

                    <!-- Default box -->
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Que deseas hacer?</h3>                            
                        </div>
                        <div class="box-body">

                            <div class="row">
                                <div class="col-lg-3 col-xs-6">
                                    <!-- small box -->
                                    <div class="small-box bg-aqua">
                                        <div class="inner">
                                            <h3>Administrar</h3>

                                            <h4>Usuarios</h4>
                                        </div>
                                        <div class="icon">
                                            <i class="ion ion-android-create"></i>
                                        </div>
                                        <a href="ListarUsuarios.php" class="small-box-footer">Empezar <i class="fa fa-arrow-circle-right"></i></a>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-xs-6">
                                    <!-- small box -->
                                    <div class="small-box bg-yellow">
                                        <div class="inner">
                                            <h3>Administrar</h3>

                                            <h4>Afiliados</h4>
                                        </div>
                                        <div class="icon">
                                            <i class="ion ion-person-add"></i>
                                        </div>
                                        <a href="ListarAfiliados.php" class="small-box-footer">Empezar <i class="fa fa-arrow-circle-right"></i></a>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-xs-6">
                                    <!-- small box -->
                                    <div class="small-box bg-green">
                                        <div class="inner">
                                            <h3>Administrar</h3>
                                            <h4>Pagos $</h4>
                                        </div>
                                        <div class="icon">
                                            <i class="ion ion-cash"></i>
                                        </div>
                                        <a href="ListadoDePagos.php" class="small-box-footer">Empezar <i class="fa fa-arrow-circle-right"></i></a>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-xs-6">
                                    <!-- small box -->
                                    <div class="small-box bg-red">
                                        <div class="inner">
                                            <h3>Historial</h3>
                                            <h4>De Vehiculos</h4>
                                        </div>
                                        <div class="icon">
                                            <i class="ion ion-android-car"></i>
                                        </div>
                                        <a href="ListadoDeVehiculos.php" class="small-box-footer">Empezar <i class="fa fa-arrow-circle-right"></i></a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="box">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Reporte de Ingresos</h3>

                                    <div class="box-tools pull-right">

                                        <div class="btn-group">
                                            <button type="button" class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown">
                                                <i class="fa fa-wrench"></i></button>
                                            <ul class="dropdown-menu" role="menu">
                                                <li><a href="#">Action</a></li>
                                                <li><a href="#">Another action</a></li>
                                                <li><a href="#">Something else here</a></li>
                                                <li class="divider"></li>
                                                <li><a href="#">Separated link</a></li>
                                            </ul>
                                        </div>

                                    </div>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <p class="text-center">
                                                <strong><?php echo $titleGrafic; ?></strong>                                        </p>
                                            <div class="chart">
                                                <!-- Sales Chart Canvas -->
                                                <canvas id="salesChart" style="height: 180px;"></canvas>
                                            </div>
                                            <!-- /.chart-responsive -->
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-md-4">
                                            <p class="text-center">
                                                <strong>Informacion General</strong>
                                            </p>

                                            <div class="progress-group">
                                                <span class="progress-text">Total Afiliados Activos</span>
                                                <span class="progress-number"><b><?php echo $rsAf[0]['total_afiliados'] ?></b></span>

                                                <div class="progress sm">
                                                    <div class="progress-bar progress-bar-aqua" style="width: <?php echo $rsAf[0]['total_afiliados'] ?>%"></div>
                                                </div>
                                            </div>
                                            <!-- /.progress-group -->
                                            <div class="progress-group">
                                                <span class="progress-text">Total Afiliados Inactivos</span>
                                                <span class="progress-number"><b><?php echo $rsAf[1]['total_afiliados'] ?></b></span>

                                                <div class="progress sm">
                                                    <div class="progress-bar progress-bar-red" style="width: <?php echo $rsAf[1]['total_afiliados'] ?>%"></div>
                                                </div>
                                            </div>
                                            <!-- /.progress-group -->
                                            <div class="progress-group">
                                                <span class="progress-text">Total Vehiculos</span>
                                                <span class="progress-number"><b><?php echo $rsVa[0]['total_vehiculos']; ?></b></span>

                                                <div class="progress sm">
                                                    <div class="progress-bar progress-bar-green" style="width: <?php echo $rsVa[0]['total_vehiculos']; ?>%"></div>
                                                </div>
                                            </div>
                                            <!-- /.progress-group -->
                                            <div class="progress-group">
                                                <span class="progress-text">Total Ganancia</span>
                                                <span class="progress-number"><b><?php echo $rsTotal[0]['total']; ?></b></span>

                                                <div class="progress sm">
                                                    <div class="progress-bar progress-bar-yellow" style="width: <?php echo $rsTotal[0]['total'] * 0.000001; ?>%"></div>
                                                </div>
                                            </div>
                                            <!-- /.progress-group -->
                                        </div>
                                        <!-- /.col -->
                                    </div>
                                    <!-- /.row -->
                                </div>
                                <!-- ./box-body -->
                                <!--                                <div class="box-footer">
                                                                    <div class="row">
                                                                        <div class="col-sm-3 col-xs-6">
                                                                            <div class="description-block border-right">
                                                                                <span class="description-percentage text-green"><i class="fa fa-caret-up"></i> 17%</span>
                                                                                <h5 class="description-header">$35,210.43</h5>
                                                                                <span class="description-text">TOTAL REVENUE</span>
                                                                            </div>
                                                                             /.description-block 
                                                                        </div>
                                                                         /.col 
                                                                        <div class="col-sm-3 col-xs-6">
                                                                            <div class="description-block border-right">
                                                                                <span class="description-percentage text-yellow"><i class="fa fa-caret-left"></i> 0%</span>
                                                                                <h5 class="description-header">$10,390.90</h5>
                                                                                <span class="description-text">TOTAL COST</span>
                                                                            </div>
                                                                             /.description-block 
                                                                        </div>
                                                                         /.col 
                                                                        <div class="col-sm-3 col-xs-6">
                                                                            <div class="description-block border-right">
                                                                                <span class="description-percentage text-green"><i class="fa fa-caret-up"></i> 20%</span>
                                                                                <h5 class="description-header">$24,813.53</h5>
                                                                                <span class="description-text">TOTAL PROFIT</span>
                                                                            </div>
                                                                             /.description-block 
                                                                        </div>
                                                                         /.col 
                                                                        <div class="col-sm-3 col-xs-6">
                                                                            <div class="description-block">
                                                                                <span class="description-percentage text-red"><i class="fa fa-caret-down"></i> 18%</span>
                                                                                <h5 class="description-header">1200</h5>
                                                                                <span class="description-text">GOAL COMPLETIONS</span>
                                                                            </div>
                                                                             /.description-block 
                                                                        </div>
                                                                    </div>
                                                                     /.row 
                                                                </div>-->
                                <!-- /.box-footer -->
                            </div>
                            <!-- /.box -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.box -->
                </section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->         
            <?php include_once '../view_asesor/FooterASesor.php'; ?>
        </div>
        <!-- ./wrapper -->
        <!-- jQuery 3 -->
        <script src="../bower_components/jquery/dist/jquery.min.js"></script>
        <!-- Bootstrap 3.3.7 -->
        <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
        <!-- FastClick -->
        <script src="../bower_components/fastclick/lib/fastclick.js"></script>
        <!-- AdminLTE App -->
        <script src="../dist/js/adminlte.min.js"></script>
        <!-- Sparkline -->
        <script src="../bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
        <!-- jvectormap  -->
        <!--<script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>-->
        <!--<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>-->
        <!-- SlimScroll -->
        <!--<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>-->
        <!-- ChartJS -->
        <script src="../bower_components/chart.js/Chart.js"></script>
        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <!--<script src="dist/js/pages/dashboard2.js"></script>-->
        <!-- AdminLTE for demo purposes -->
        <script src="../dist/js/demo.js"></script>

        <script>

            $(document).ready(function () {
                var titulos = new Array();
                var valores = new Array();


                $('.sidebar-menu').tree()


                $.ajax({
                    type: 'POST',
                    url: "Model/Admin/GetDataForChart.php",
                    data: {},
                    dataType: 'json',
                    contentType: false,
                    processData: false,
                    cache: false,
                    success: function (response) {
                        for (var item in response) {
                            titulos.push(item);
                            valores.push(response[item]);
                        }
                        paintCharts(titulos, valores);
                    }
                });

            })



            function paintCharts(titulos, valores) {



                // Get context with jQuery - using jQuery's .get() method.
                var salesChartCanvas = $('#salesChart').get(0).getContext('2d');
                // This will get the first returned node in the jQuery collection.
                var salesChart = new Chart(salesChartCanvas);

                var salesChartData = {
                    labels: titulos,
                    datasets: [
                        {
                            label: 'Digital Goods',
                            fillColor: 'rgba(60,141,188,0.9)',
                            strokeColor: 'rgba(60,141,188,0.8)',
                            pointColor: '#3b8bba',
                            pointStrokeColor: 'rgba(60,141,188,1)',
                            pointHighlightFill: '#fff',
                            pointHighlightStroke: 'rgba(60,141,188,1)',
                            data: valores
                        }
                    ]

                };

                var salesChartOptions = {
                    // Boolean - If we should show the scale at all
                    showScale: true,
                    // Boolean - Whether grid lines are shown across the chart
                    scaleShowGridLines: false,
                    // String - Colour of the grid lines
                    scaleGridLineColor: 'rgba(0,0,0,.05)',
                    // Number - Width of the grid lines
                    scaleGridLineWidth: 1,
                    // Boolean - Whether to show horizontal lines (except X axis)
                    scaleShowHorizontalLines: true,
                    // Boolean - Whether to show vertical lines (except Y axis)
                    scaleShowVerticalLines: true,
                    // Boolean - Whether the line is curved between points
                    bezierCurve: true,
                    // Number - Tension of the bezier curve between points
                    bezierCurveTension: 0.3,
                    // Boolean - Whether to show a dot for each point
                    pointDot: true,
                    // Number - Radius of each point dot in pixels
                    pointDotRadius: 4,
                    // Number - Pixel width of point dot stroke
                    pointDotStrokeWidth: 1,
                    // Number - amount extra to add to the radius to cater for hit detection outside the drawn point
                    pointHitDetectionRadius: 20,
                    // Boolean - Whether to show a stroke for datasets
                    datasetStroke: true,
                    // Number - Pixel width of dataset stroke
                    datasetStrokeWidth: 2,
                    // Boolean - Whether to fill the dataset with a color
                    datasetFill: true,
                    // String - A legend template
                    legendTemplate: '<ul class=\'<%=name.toLowerCase()%>-legend\'><% for (var i=0; i<datasets.length; i++){%><li><span style=\'background-color:<%=datasets[i].lineColor%>\'></span><%=datasets[i].label%></li><%}%></ul>',
                    // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
                    maintainAspectRatio: true,
                    // Boolean - whether to make the chart responsive to window resizing
                    responsive: true
                };

                // Create the line chart
                salesChart.Line(salesChartData, salesChartOptions);
            }

        </script>
    </body>
</html>
