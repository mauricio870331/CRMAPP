<div class="box-body">
    <table id="example2" class="table table-bordered table-striped table-hover">
        <thead>
            <tr>
                <th>R</th>
                <th>Placa</th>
                <th>Marca</th>
                <th>Linea</th>
                <th>Cooperativa</th>
                <th>Estado</th>                                                 
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody >
            <?php
            require_once '../BD.php';
            $con = new BD();
            $rs = $con->findAll2("SELECT * FROM vehiculos_afiliados "
                    . "where id_afiliado = (select id_afiliado from afiliados where documento = '" . $_POST['documento'] . "') "
                    . "order by R limit 200");
            foreach ($rs as $key => $value) {
                ?>    
                <tr>       
                    <td><?php echo $value['R']; ?></td>
                    <td><?php echo $value['placa_vehiculo']; ?></td>
                    <td><?php echo $value['marca']; ?></td>
                    <td><?php echo $value['linea']; ?></td>
                    <td><?php echo $value['cooperativa']; ?></td>
                    <td><span class="pull badge <?php echo ($value['estado'] == "Activo") ? 'bg-green' : 'bg-red' ?>"><?php echo $value['estado']; ?></span></td>
                    <td>
                        <div class="col-md-3 col-sm-4 acercar">
                            <i class="fa fa-fw fa-eraser deleteVehiculo" data-estado="<?php echo $value['estado']; ?>" data-id="<?php echo $value['id_vehiculo']; ?>" data-R="<?php echo $value['R']; ?>"  data-toggle="tooltip" title="Borrar"></i>
                            <button type="button" style="display: none" class="btn btn-default" data-toggle="modal" data-target="#modal-default" id="vehiculo<?php echo $value['id_vehiculo']; ?>"/>
                        </div>
                        <div class="col-md-3 col-sm-4 acercar">
                            <i class="fa fa-fw fa-edit updateVehiculo" data-id="<?php echo base64_encode($value['id_vehiculo']); ?>" data-toggle="tooltip" title="Actualizar"></i>
                        </div>
                        <div class="col-md-3 col-sm-4 acercar">
                            <i class="fa fa-fw fa-files-o addDocument" data-id="<?php echo base64_encode($value['id_vehiculo']); ?>" data-toggle="tooltip" title="Agregar Documentos"></i>
                        </div>
                        <div class="col-md-3 col-sm-4 acercar">
                            <i class="fa fa-fw fa-eye seeInfo" data-id="<?php echo base64_encode($value['id_vehiculo']); ?>" data-toggle="tooltip" title="Ver"></i>
                        </div>
                    </td>
                </tr> 
                <?php
            }
            ?>
        </tbody>                                        
    </table>                                  
</div>
<script src="dist/js/demo.js"></script>
<script>
    $(function () {
        $('#example2').DataTable({
            'paging': true,
            'lengthChange': false,
            'searching': false,
            'ordering': true,
            'info': true,
            'autoWidth': false,
            "order": [[1, "desc"]]
        })
    });

    $(".updatePayment").click(function () {
        redireccionarPagina('ActualizarPagos.php?token=' + $(this).data("id") + "&Redirect=true");
    });

    $(".addPayment").click(function () {
        redireccionarPagina('RegistrarPagos.php?token=' + $(this).data("id") + "&Redirect=" + $(this).data("redirect"));
    });

    function redireccionarPagina(pagina) {
        window.location = pagina;
    }


    $(".deletePayment").click(function () {
        $("#pago" + $(this).data("id")).trigger("click");
        $("#deletePay").attr("data-id", $(this).data("id"));
    });


    $("#deletePay").click(function () {
        var data = new FormData();
        data.append("id", $(this).data("id"));
        $.ajax({
            type: 'POST',
            url: "Model/Admin/DeletePay.php",
            data: data,
            dataType: 'json',
            contentType: false,
            processData: false,
            cache: false,
            success: function (response) {
                if (response == "ok") {
                    setTimeout(redireccionarPagina('ListadoDePagos.php?mensaje=deleteok'), 5000);
                } else {
                    showAlert("Ocurrio un error al eliminar el pago", "error");
                }
            }
        });
    });
</script>