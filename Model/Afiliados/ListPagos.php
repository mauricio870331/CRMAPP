<div class="box-body">
    <table id="example2" class="table table-bordered table-striped table-hover">
        <thead>
            <tr>
                <th>Fecha de Pago</th>
                <th>Documento</th>
                <th>Nombre</th>
                <th>Valor</th>
                <th>Descuento</th>
                <th>Total</th>                                                 
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody >
            <?php
            require_once '../BD.php';
            $con = new BD();
            $rs = $con->findAll2("SELECT p.*, a.nombre_completo, a.documento, a.id_afiliado FROM pagos p, afiliados a where a.id_afiliado = p.id_afiliado and a.documento = '" . $_POST['documento'] . "' order by fecha_pago desc LIMIT 100");
            if (count($rs) > 0) {
                $fechaUltimoPago = date("Y-m", strtotime($rs[0]['fecha_pago']));
                $fecha_hoy = date("Y-m");
                foreach ($rs as $key => $value) {
                    ?>    
                    <tr>   
                        <td><?php echo $value['fecha_pago']; ?></td>
                        <td><?php echo $value['documento']; ?></td>
                        <td><?php echo $value['nombre_completo']; ?></td>
                        <td><?php echo $value['valor']; ?></td>
                        <td><?php echo $value['descuento']; ?></td>
                        <td><?php echo $value['total']; ?></td>

                        <td> 
                            <?php if ($key == 0) {
                                ?>
                                <div class="col-md-3 col-sm-4 acercar">
                                    <i class="fa fa-fw fa-edit updatePayment " style="cursor: pointer" data-id="<?php echo base64_encode($value['id_pago']); ?>" data-toggle="tooltip" title="Actualizar Pago"></i>
                                </div>
                                <div class="col-md-3 col-sm-4 acercar">
                                    <i class="fa fa-fw fa-eraser deletePayment" style="color: red;cursor: pointer" data-id="<?php echo $value['id_pago']; ?>" data-toggle="tooltip" title="Borrar"></i>
                                    <button type="button" style="display: none" class="btn btn-default" data-toggle="modal" data-target="#modal-default" id="pago<?php echo $value['id_pago']; ?>"/>
                                </div> 
                                <?php if ($fecha_hoy == $fechaUltimoPago) { ?>
                                    <div class="col-md-3 col-sm-4 acercar">
                                        <i class="fa fa-fw fa-money addPayment" style="color: green;cursor: pointer" data-redirect="<?php echo "true" ?>" data-id="<?php echo base64_encode($value['id_afiliado']); ?>" data-toggle="tooltip" title="Registrar Pago"></i>
                                    </div>  
                                <?php } ?>
                            <?php } ?>
                        </td>
                    </tr> 
                    <?php
                }
            } else {
                ?>
                <tr class="odd"><td valign="top" colspan="7" class="dataTables_empty">No hay resultados para la consulta</td></tr>
                <?php
            }
            ?>
        <div class="modal fade" id="modal-default">
            <div class="modal-dialog">
                <div class="modal-content" style="width: 60%;margin-left: 28%">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Confirmación</h4>
                    </div>
                    <div class="modal-body">
                        <p>Esta seguro de eliminar el pago del afiliado seleccionado?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button"  class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                        <button type="button" id="deletePay" data-id="" class="btn btn-primary">Eliminar Pago</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
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

