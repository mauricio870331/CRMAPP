<table id="example2" class="table table-bordered table-striped table-hover">
    <thead>
        <tr>
            <th>Tipo Documento</th>
            <th>Documento</th>
            <th>Nombres</th>
            <th>Apellidos</th>
            <th>Estado</th>
            <th>Foto</th>                                                 
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php
        require_once '../BD.php';
        $con = new BD();
        $rs = "";
        if (isset($_POST['documento']) && !empty($_POST['documento'])) {
            $rs = $con->findAll2("SELECT a.*, d.estado_vinculo FROM afiliados a, datos_afiliado d where a.id_afiliado = d.id_afiliado and a.documento = '" . $_POST['documento'] . "' order by documento desc LIMIT 100");
        } else {
            $rs = $con->findAll2("SELECT a.*, d.estado_vinculo FROM afiliados a, datos_afiliado d where a.id_afiliado = d.id_afiliado order by documento desc LIMIT 100");
        }

        foreach ($rs as $key => $value) {
            ?>    
            <tr>   
                <td><?php echo utf8_decode($value['tipo_doc']); ?></td>
                <td><?php echo $value['documento']; ?></td>
                <td><?php echo $value['nombres']; ?></td>
                <td><?php echo $value['apellidos']; ?></td>
                <td><span class="pull badge <?php echo ($value['estado_vinculo'] == "Activo") ? 'bg-green' : 'bg-red' ?>"><?php echo $value['estado_vinculo']; ?></span></td>
                <td style="text-align: center" ><img src="Model/Afiliados/imageAfiliado.php?id=<?php echo $value['id_afiliado']; ?>" style="max-width: 40px;border-radius: 10%" alt="User Image"></td>                                                
                <td>            
                    <div class="col-md-3 col-sm-4 acercar">
                        <i class="fa fa-fw fa-edit updateAfiliados " style="cursor: pointer" data-id="<?php echo base64_encode($value['id_afiliado']); ?>" data-toggle="tooltip" title="Actualizar"></i>
                    </div>
                    <div class="col-md-3 col-sm-4 acercar">
                        <i class="fa fa-fw fa-check deleteAfiliados" style="color: red;cursor: pointer" data-estado="<?php echo $value['estado_vinculo']; ?>" data-id="<?php echo $value['id_afiliado']; ?>" data-toggle="tooltip" title="Activar / Desactivar"></i>
                        <button type="button" style="display: none" class="btn btn-default" data-toggle="modal" data-target="#modal-default" id="afiliado<?php echo $value['id_afiliado']; ?>"/>
                    </div>
                    <div class="col-md-3 col-sm-4 acercar">
                        <i class="fa fa-fw fa-close destroyAfiliates" style="color: red;cursor: pointer" data-estado="<?php echo $value['estado_vinculo']; ?>" data-id="<?php echo $value['id_afiliado']; ?>" data-toggle="tooltip" title="Eliminar"></i>
                        <button type="button" style="display: none" class="btn btn-default" data-toggle="modal" data-target="#modal-defaultd" id="destroyafiliado<?php echo $value['id_afiliado']; ?>"/>
                    </div>
                    <div class="col-md-3 col-sm-4 acercar">
                        <i class="fa fa-fw fa-taxi addVehiculo" style="color: orange;cursor: pointer" data-id="<?php echo base64_encode($value['id_afiliado']); ?>" data-toggle="tooltip" title="Agregar Taxi"></i>
                    </div>
                    <div class="col-md-3 col-sm-4 acercar">
                        <i class="fa fa-fw fa-money addPayment" style="color: green;cursor: pointer" data-redirect="<?php echo "false" ?>" data-id="<?php echo base64_encode($value['id_afiliado']); ?>" data-toggle="tooltip" title="Registrar Pago"></i>
                    </div>
                    <div class="col-md-3 col-sm-4 acercar">
                        <i class="fa fa-fw fa-eye moreinfo"  style="color: blue;cursor: pointer" data-id="<?php echo base64_encode($value['id_afiliado']); ?>" data-toggle="tooltip" title="Información detallada"></i>
                    </div>
                </td>
            </tr> 
        <?php } ?>
    </tbody>
</table>
<script>
    $(function () {
        $('#example2').DataTable({
            'paging': true,
            'lengthChange': false,
            'searching': false,
            'ordering': true,
            'info': true,
            'autoWidth': false
        })
    });

    $(".updateAfiliados").click(function () {
        redireccionarPagina('ActualizarAfiliados.php?token=' + $(this).data("id"));
    });

    $(".deleteAfiliados").click(function () {
        $("#afiliado" + $(this).data("id")).trigger("click");
        $("#deleteAfiliado").attr("data-id", $(this).data("id"));
        $("#deleteAfiliado").attr("data-estado", $(this).data("estado"));
    });
    
    
    $(".destroyAfiliates").click(function () {
        $("#destroyafiliado" + $(this).data("id")).trigger("click");
        $("#destroyAfiliates").attr("data-id", $(this).data("id"));
        $("#destroyAfiliates").attr("data-estado", $(this).data("estado"));
    });

    jQuery(".addVehiculo").click(function () {
        redireccionarPagina('CrearVehiculo.php?token=' + $(this).data("id"));
    });

    $(".addPayment").click(function () {
        redireccionarPagina('RegistrarPagos.php?token=' + $(this).data("id") + "&Redirect=" + $(this).data("redirect"));
    });

    $(".moreinfo").click(function () {
        redireccionarPagina('profile.php?token=' + $(this).data("id"));
    });

    function redireccionarPagina(pagina) {
        window.location = pagina;
    }
</script>