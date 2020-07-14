//GetCities
$('#id_ciudad').change(function () {
    if (this.value !== "") {
        var data = new FormData();
        data.append("id_ciudad", this.value);
        $.ajax({
            type: 'POST',
            url: "../Model/Utilidades/listEstados.php",
            data: data,
            dataType: 'html',
            contentType: false,
            processData: false,
            cache: false,
            success: function (response) {
                $("#id_estado").html(response);
            }
        });
    } else {
        $("#id_estado").html("<option value=''>Seleccione</option>");
    }
});
//------------------------------------------------------------------------------
//Navegarion
$("#Inicio").click(function () {
    if ($(this).data("view") === "asesor") {
        redireccionarPagina('HomeAsesor.php');
    } else {
        redireccionarPagina('HomeAdmin.php');
    }
});
$("#backInicio").click(function () {
    if ($(this).data("view") === "asesor") {
        redireccionarPagina('HomeAsesor.php');
    } else {
        redireccionarPagina('HomeAdmin.php');
    }
});
//------------------------------------------------------------------------------
//Crear Leads
$("#crearNuevoLead").click(function () {
    redireccionarPagina('CrearLeads.php');
});
$("#backCrearLead").click(function () {
    redireccionarPagina('ListarLeads.php');
});
$("#CrearLead").click(function () {
    var campos = ['ss', 'nombres', 'apellidos', 'direccion', 'telefonos', 'cita', 'id_ciudad', 'id_estado', 'hora_cita', 'email'];
    var countErrors = 0;
    for (var item in campos) {
        if ($("#" + campos[item]).val() === "") {
            countErrors++;
            $("#" + campos[item]).css("border", "1px solid #dc3545");
        } else {
            $("#" + campos[item]).css("border", "1px solid #d2d6de");
        }
    }
    if (countErrors > 0) {
        showAlert("Los campos marcados en rojo son obligatorios..!", "danger");
    } else {
        var data = new FormData();
        for (var item in campos) {
            data.append(campos[item], $("#" + campos[item]).val());
        }
        data.append("dob", $("#dob").val());
        $.ajax({
            async: true,
            type: "POST",
            url: "../Model/Leads/AddLead.php",
            data: data,
            dataType: "json",
            contentType: false,
            processData: false,
            cache: false,
            success: function (response)
            {
                if (response === "ok") {
                    setTimeout(redireccionarPagina('ListarLeads.php?mensaje=ok'), 5000);
                } else {
                    showAlert("Ocurrio un error al crear el Lead", "error");
                }
            }
        });
    }
});
//------------------------------------------------------------------------------
//Modal delteLead
$(".deleteLead").click(function () {
    if ($(this).data("estado") == "CLIENTE") {
        showAlert("No puedes suspender un cliente", "error");
        return;
    }
    $("#lead" + $(this).data("id")).trigger("click");
    $("#deleteLead").attr("data-id", $(this).data("id"));
    $("#deleteLead").attr("data-opc", $(this).data("option"));
});
$("#deleteLead").click(function () {
    var data = new FormData();
    data.append("id", $(this).data("id"));
    data.append("opcion", $(this).data("opc"));
    $.ajax({
        type: 'POST',
        url: "../Model/Leads/DeleteLead.php",
        data: data,
        dataType: 'json',
        contentType: false,
        processData: false,
        cache: false,
        success: function (response) {
            if (response === "ok") {
                setTimeout(redireccionarPagina('ListarLeads.php'), 5000);
            } else {
                showAlert("Ocurrio un error al eliminar el lead", "error");
            }
        }
    });
});
//fin delete lead

//------------------------------------------------------------------------------
//Modal setClient
$(".setClient").click(function () {
    $("#client" + $(this).data("id")).trigger("click");
    $("#setClient").attr("data-id", $(this).data("id"));
    $("#setClient").attr("data-opc", $(this).data("option"));
});
$("#setClient").click(function () {
    var data = new FormData();
    data.append("id", $(this).data("id"));
    data.append("opcion", $(this).data("opc"));
    $.ajax({
        type: 'POST',
        url: "../Model/Leads/SetClient.php",
        data: data,
        dataType: 'json',
        contentType: false,
        processData: false,
        cache: false,
        success: function (response) {
            if (response === "ok") {
                setTimeout(redireccionarPagina('ListarLeads.php'), 5000);
            } else {
                showAlert("Ocurrio un error al eliminar el lead", "error");
            }
        }
    });
});
//Fin setClient

//------------------------------------------------------------------------------
$(".moreinfoLead").click(function () {
    redireccionarPagina('Profile.php?token=' + $(this).data("id"));
});
//Regresar al perfil
$("#backfromProfile").click(function () {
    redireccionarPagina('ListarLeads.php');
});
//Modal Documentos
$(".newDocument").click(function () {
    $("#newDoc" + $(this).data("id")).trigger("click");
    $("#addDocument").attr("data-id", $(this).data("id"));
    $("#addDocument").attr("data-option", $(this).data("option"));
});
//------------------------------------------------------------------------------
//AddDocuments
$(".hideInputFile").change(function () {
    if ($(this).val() != "") {
        $("#descripcion").val($(this).val());
        $(".exampleInputFileGroup").css("display", "none");
        $(".autoSend").css("display", "block");
    } else {
        $("#descripcion").val("");
        $(".exampleInputFileGroup").css("display", "block");
        $(".autoSend").css("display", "none");
    }
});

$("#addDocument").click(function () {
    var campos = {};
    if ($('.exampleInputFileGroup').is(':hidden')) {
        campos = ['descripcion'];
    } else {
        campos = ['descripcion', 'exampleInputFile'];
    }
    var countErrors = 0;
    for (var item in campos) {
        if ($("#" + campos[item]).val() === ""
                || $("#" + campos[item]).val() === "Seleccione") {
            countErrors++;
            $("#" + campos[item]).css("border", "1px solid red");
        } else {
            $("#" + campos[item]).css("border", "1px solid #d2d6de");
        }
    }
    if (countErrors > 0) {
        showAlert("Los campos marcados en rojo son obligatorios", "error");
    } else {
        var data = new FormData();
        var inputFile = document.getElementById("exampleInputFile");
        var file = inputFile.files[0];
        if (file !== undefined) {
            data.append("exampleInputFile", file);
        }
        data.append("descripcion", $("#descripcion").val());
        data.append("ss", $(this).data("id"));
        data.append("opcion", $(this).data("option"));
        data.append("nombre_cliente", $("#nombre_cliente").val());
        if ($('#send').prop('checked')) {
            data.append("enviar", "true");
        } else {
            data.append("enviar", "false");
        }

        $.ajax({
            type: 'POST',
            url: "../Model/Leads/AddDocuments.php",
            data: data,
            dataType: 'json',
            contentType: false,
            processData: false,
            cache: false,
            success: function (response) {
                if (response.msn !== "error") {
                    if (response.opcion == "documento") {
                        setTimeout(redireccionarPagina('Profile.php?token=' + btoa(response.ss) + '&mensaje=documento'), 5000);
                    } else {
                        setTimeout(redireccionarPagina('Profile.php?token=' + btoa(response.ss) + '&mensaje=adjunto'), 5000);
                    }

                } else {
                    showAlert("Ocurrio un error al crear el documento", "error");
                }
            }
        });
    }
});
//------------------------------------------------------------------------------
//Modal delteDoc
$(".deleteDoc").click(function () {
    $("#docId" + $(this).data("id")).trigger("click");
    $("#deleteDoc").attr("data-id", $(this).data("id"));
    $("#deleteDoc").attr("data-ss", $(this).data("ssocial"));
    $("#deleteDoc").attr("data-option", $(this).data("opcion"));
});
$("#deleteDoc").click(function () {
    var data = new FormData();
    data.append("id", $(this).data("id"));
    data.append("opcion", $(this).data("option"));
    var ss = $(this).data("ss");
    $.ajax({
        type: 'POST',
        url: "../Model/Leads/DeleteDoc.php",
        data: data,
        dataType: 'json',
        contentType: false,
        processData: false,
        cache: false,
        success: function (response) {
//            console.log(response);
            if (response.msg == "ok") {
                if ($(this).data("option") == "documento") {
                    setTimeout(redireccionarPagina('Profile.php?token=' + ss + '&mensaje=deletedoc'), 5000);
                } else {
                    setTimeout(redireccionarPagina('Profile.php?token=' + ss + '&mensaje=deleteadjunto'), 5000);
                }
            } else {
                showAlert("Ocurrio un error al eliminar el documento", "error");
            }
        }
    });
});
//Fin delteDoc
//------------------------------------------------------------------------------

//Modal Notas
$(".newNota").click(function () {
    $("#newNota" + $(this).data("ss")).trigger("click");
    $("#addNota").attr("data-id", $(this).data("id"));
    $("#addNota").attr("data-option", $(this).data("option"));
    $("#addNota").attr("data-ss", $(this).data("ss"));

    if ($(this).data("option") === "update") {
        $("#titulo").val($(this).data("titulo"));
        $("#txtDescripcion").val($(this).data("desc"));
    }

});
//AddNota
$("#addNota").click(function () {
    var campos = ['titulo', 'txtDescripcion'];
    var countErrors = 0;
    for (var item in campos) {
        if ($("#" + campos[item]).val() === "") {
            countErrors++;
            $("#" + campos[item]).css("border", "1px solid red");
        } else {
            $("#" + campos[item]).css("border", "1px solid #d2d6de");
        }
    }
    if (countErrors > 0) {
        showAlert("Los campos marcados en rojo son obligatorios", "error");
    } else {
        var data = new FormData();
        data.append("titulo", $("#titulo").val());
        data.append("descripcion", $("#txtDescripcion").val());
        data.append("ss", $(this).data("ss"));
        data.append("id_nota", $(this).data("id"));
        data.append("accion", $(this).data("option"));
        $.ajax({
            type: 'POST',
            url: "../Model/Leads/AddNotes.php",
            data: data,
            dataType: 'json',
            contentType: false,
            processData: false,
            cache: false,
            success: function (response) {
                if (response !== "error") {
                    setTimeout(redireccionarPagina('Profile.php?token=' + btoa(response) + '&mensaje=notaok'), 5000);
                } else {
                    showAlert("Ocurrio un error al crear el documento", "error");
                }
            }
        });
    }
});

///DeleteNota
$(".deleteNota").click(function () {
    $("#notaId" + $(this).data("id")).trigger("click");
    $("#deleteNota").attr("data-id", $(this).data("id"));
    $("#deleteNota").attr("data-ss", $(this).data("ss"));

});

$("#deleteNota").click(function () {
    var data = new FormData();
    data.append("id", $(this).data("id"));
    var ss = $(this).data("ss");
    $.ajax({
        type: 'POST',
        url: "../Model/Leads/DeleteNota.php",
        data: data,
        dataType: 'json',
        contentType: false,
        processData: false,
        cache: false,
        success: function (response) {
//            console.log(response);
            if (response.msg === "ok") {
                setTimeout(redireccionarPagina('Profile.php?token=' + ss + '&mensaje=deletenota'), 5000);
            } else {
                showAlert("Ocurrio un error al eliminar el documento", "error");
            }
        }
    });
});
//fin notas

//Modal Recordatorios
$(".newRecordatorio").click(function () {
    $("#newRemember" + $(this).data("ss")).trigger("click");
    $("#addRecordatorio").attr("data-id", $(this).data("id"));
    $("#addRecordatorio").attr("data-option", $(this).data("option"));
    $("#addRecordatorio").attr("data-ss", $(this).data("ss"));
    if ($(this).data("option") === "update") {
        $("#vence").val($(this).data("vence"));
        $("#txtDesc").val($(this).data("desc"));
    }
});
//Add recordatorio
$("#addRecordatorio").click(function () {
    var campos = ['txtDesc', 'vence', '_to'];
    var countErrors = 0;
    for (var item in campos) {
        if ($("#" + campos[item]).val() === "") {
            countErrors++;
            $("#" + campos[item]).css("border", "1px solid red");
        } else {
            $("#" + campos[item]).css("border", "1px solid #d2d6de");
        }
    }
    if (countErrors > 0) {
        showAlert("Los campos marcados en rojo son obligatorios", "error");
    } else {
        var data = new FormData();
        data.append("vence", $("#vence").val());
        data.append("descripcion", $("#txtDesc").val());
        data.append("ss", $(this).data("ss"));
        data.append("id_recordatorio", $(this).data("id"));
        data.append("accion", $(this).data("option"));
        data.append("_from", $("#_from").val());
        data.append("_to", $("#_to").val());
        $.ajax({
            type: 'POST',
            url: "../Model/Leads/AddRecordatorio.php",
            data: data,
            dataType: 'json',
            contentType: false,
            processData: false,
            cache: false,
            success: function (response) {
                if (response !== "error") {
                    setTimeout(redireccionarPagina('Profile.php?token=' + btoa(response) + '&mensaje=rememberOk'), 5000);
                } else {
                    showAlert("Ocurrio un error al crear el documento", "error");
                }
            }
        });
    }
});

///DeleteRecordatorio
$(".deleteRecordatorio").click(function () {
    $("#recId" + $(this).data("id")).trigger("click");
    $("#deleteRec").attr("data-id", $(this).data("id"));
    $("#deleteRec").attr("data-ss", $(this).data("ss"));
});

$("#deleteRec").click(function () {
    var data = new FormData();
    data.append("id", $(this).data("id"));
    var ss = $(this).data("ss");
    $.ajax({
        type: 'POST',
        url: "../Model/Leads/DeleteRecordatorio.php",
        data: data,
        dataType: 'json',
        contentType: false,
        processData: false,
        cache: false,
        success: function (response) {
//            console.log(response);
            if (response.msg === "ok") {
                setTimeout(redireccionarPagina('Profile.php?token=' + ss + '&mensaje=deleteRemember'), 5000);
            } else {
                showAlert("Ocurrio un error al eliminar el documento", "error");
            }
        }
    });
});



$(".changeStatus").click(function () {
    var data = new FormData();
    data.append("id", $(this).data("id"));
    data.append("estado", $(this).data("opction"));
    var ss = $(this).data("ss");
    $.ajax({
        type: 'POST',
        url: "../Model/Leads/UpdateStatusRec.php",
        data: data,
        dataType: 'json',
        contentType: false,
        processData: false,
        cache: false,
        success: function (response) {
//            console.log(response);
            if (response.msg === "ok") {
                setTimeout(redireccionarPagina('Profile.php?token=' + ss + '&mensaje=rememberOk'), 5000);
            } else {
                showAlert("Ocurrio un error al eliminar el documento", "error");
            }
        }
    });
});
//Fin recordatorios

//Ver Notificaciones en perfil
$("#seeNotify").click(function () {
    $("#timeline").removeClass("active");
    $("#tabTimeline").removeClass("active");
    $("#docs").removeClass("active");
    $("#tabDocs").removeClass("active");
    $("#adjuntos").removeClass("active");
    $("#tabAdjuntos").removeClass("active");
    $("#notas").removeClass("active");
    $("#tabNotas").removeClass("active");
    $("#recordatorios").addClass("active");
    $("#tabRecordatorios").addClass("active");
});

//Estados notificaciones
$(".changeStatusNotify").click(function () {
    var data = new FormData();
    data.append("id", $(this).data("id"));
    data.append("estado", $(this).data("opction"));
    var token = $(this).data("token");
    $.ajax({
        type: 'POST',
        url: "../Model/Leads/UpdateStatusNot.php",
        data: data,
        dataType: 'json',
        contentType: false,
        processData: false,
        cache: false,
        success: function (response) {
//            console.log(response);
            if (response.msg === "ok") {
                setTimeout(redireccionarPagina('ListarNotificaciones.php?token=' + token + '&mensaje=notifyOk'), 5000);
            } else {
                showAlert("Ocurrio un error al actualizar la notificación", "error");
            }
        }
    });
});


//updateLeads
$(".updateLead").click(function () {
    redireccionarPagina('ActualizarLeads.php?token=' + $(this).data("id"));
});
$("#ActualizarLead").click(function () {
    var campos = ['ss', 'nombres', 'apellidos', 'direccion', 'telefonos', 'cita', 'id_ciudad', 'id_estado', 'hora_cita', 'email'];
    var countErrors = 0;
    for (var item in campos) {
        if ($("#" + campos[item]).val() === "") {
            countErrors++;
            $("#" + campos[item]).css("border", "1px solid #dc3545");
        } else {
            $("#" + campos[item]).css("border", "1px solid #d2d6de");
        }
    }
    if (countErrors > 0) {
        showAlert("Los campos marcados en rojo son obligatorios..!", "danger");
    } else {
        var data = new FormData();
        for (var item in campos) {
            data.append(campos[item], $("#" + campos[item]).val());
        }
        data.append("dob", $("#dob").val());
        $.ajax({
            async: true,
            type: "POST",
            url: "../Model/Leads/UpdateLead.php",
            data: data,
            dataType: "json",
            contentType: false,
            processData: false,
            cache: false,
            success: function (response)
            {
                if (response === "ok") {
                    setTimeout(redireccionarPagina('ListarLeads.php?mensaje=updateOk'), 5000);
                } else {
                    showAlert("Ocurrio un error al actualizar el Lead", "error");
                }
            }
        });
    }
});
//Fin update leads
//-----------------------------------------------------------------------------
// infoProduct
$(".infoProdut").click(function () {
    if ($("#valor").val() !== "") {
        $("#infoProdut" + $(this).data("id")).trigger("click");
        $("#valor").css("border", "1px solid #d2d6de");
    } else {
        showAlert("Debes ingresar el valor total", "error");
        $("#valor").css("border", "1px solid red");
        $("#valor").focus();
    }
});
//crear productos
var cuotas = [];
var sum_valor_total = 0;
var num_cuota = 0;
$("#newCuota").click(function () {
    var campos = ['fecha_pago', 'valor_cuota'];
    var countErrors = 0;
    for (var item in campos) {
        if ($("#" + campos[item]).val() === ""
                || $("#" + campos[item]).val() === "Seleccione") {
            countErrors++;
            $("#" + campos[item]).css("border", "1px solid red");
        } else {
            $("#" + campos[item]).css("border", "1px solid #d2d6de");
        }
    }
    if (countErrors > 0) {
        showAlert("Los campos marcados en rojo son obligatorios", "error");
    } else {
        var datos_cuota = [];
        num_cuota++;
        datos_cuota[0] = num_cuota;
        datos_cuota[1] = ($("#fecha_pago").val());
        datos_cuota[2] = $("#valor_cuota").val();
        sum_valor_total = (sum_valor_total + Number($("#valor_cuota").val()));
        cuotas.push(datos_cuota);
        showAlert("Cuota agregada, puedes continuar añadiendo mas", "success");
        var htmlCuotas = "<tr id='ncuota" + num_cuota + "'>"
                + "<td>" + num_cuota + "</td>"
                + "<td>" + $("#valor_cuota").val() + "</td>"
                + "<td>" + $("#fecha_pago").val() + "</td>"
                + "<td><i class='fa fa-fw fa-eraser removeCuota' onclick='removeCuota(" + num_cuota + ")' style='color: red;cursor: pointer;font-size: 15px;'"
                + " data-toggle='tooltip' title='Remover Cuota'></i>"
                + "</tr>";
        jQuery("#content_cuotas").append(htmlCuotas);
        jQuery("#cuotas").val(cuotas.length);
        jQuery("#tot_deuda").html("$" + sum_valor_total);
        jQuery("#fecha_pago").val("");
        jQuery("#valor_cuota").val("");
    }
});
//------------------------------------------------------------------------------
//remove cuota
function removeCuota(id_cuota) {
    console.log(cuotas);
    var i = -1;
    for (var item in cuotas) {
        if (cuotas[item][0] === id_cuota) {
            i = item;
            break;
        }
    }
    if (i !== -1) {
        cuotas.splice(i, 1);
    }
    for (var item in cuotas) {
        cuotas[item][0] = (Number(item) + Number(1));
    }
    jQuery("#content_cuotas").html("");
    sum_valor_total = 0;
    var htmlCuotas = "";
    for (var item in cuotas) {
        var htmlCuotas = "<tr id='ncuota" + cuotas[item][0] + "'>"
                + "<td>" + cuotas[item][0] + "</td>"
                + "<td>" + cuotas[item][2] + "</td>"
                + "<td>" + cuotas[item][1] + "</td>"
                + "<td><i class='fa fa-fw fa-eraser removeCuota' onclick='removeCuota(" + cuotas[item][0] + ")' style='color: red;cursor: pointer;font-size: 15px;'"
                + " data-toggle='tooltip' title='Remover Cuota'></i>"
                + "</tr>";
        jQuery("#content_cuotas").append(htmlCuotas);
        sum_valor_total = (sum_valor_total + Number(cuotas[item][2]));
    }
    num_cuota = cuotas.length;
    jQuery("#cuotas").val(cuotas.length);
    jQuery("#tot_deuda").html("$" + sum_valor_total);
    jQuery("#fecha_pago").val("");
    jQuery("#valor_cuota").val("");
}
//------------------------------------------------------------------------------
//Terminar agregar cuotas
$("#endAddCuota").click(function () {
    var diferencia = (parseInt(sum_valor_total) - parseInt($("#valor").val()));
    if (sum_valor_total < $("#valor").val()) {
        showAlert("El valor total de las cuotas es menor al valor total de la deuda, diferencia:  " + diferencia, "error");
        return;
    }
    if (sum_valor_total > $("#valor").val()) {
        showAlert("El valor total de las cuotas es mayor al valor total de la deuda, diferencia:  " + diferencia, "error");
        return;
    }
    $("#close").trigger("click");
});
//------------------------------------------------------------------------------
//Modal Productos
$(".newProduct").click(function () {
    cleanModalsProducts();
    $("#newProduct" + $(this).data("id")).trigger("click");
    $("#newProduct").attr("data-id", $(this).data("id"));

});
//------------------------------------------------------------------------------
//AddProduct
$("#newProduct").click(function () {
    var campos = ['tipo_producto', 'banco', 'titular', 'tipo_cuenta', 'ruta', 'cuenta', 'valor', 'cuotas'];
    var countErrors = 0;
    for (var item in campos) {
        if ($("#" + campos[item]).val() === ""
                || $("#" + campos[item]).val() === "Seleccione") {
            countErrors++;
            $("#" + campos[item]).css("border", "1px solid red");
        } else {
            $("#" + campos[item]).css("border", "1px solid #d2d6de");
        }
    }
    if (countErrors > 0) {
        showAlert("Los campos marcados en rojo son obligatorios", "error");
    } else {
        if (sum_valor_total < $("#valor").val()) {
            showAlert("El valor total de las cuotas es menor al valor total de la deuda", "error");
            return;
        }
        if (sum_valor_total > $("#valor").val()) {
            showAlert("El valor total de las cuotas es mayor al valor total de la deuda", "error");
            return;
        }
        if (parseInt(sum_valor_total) === parseInt($("#valor").val())) {
            var data = new FormData();
            for (var item in campos) {
                data.append(campos[item], $("#" + campos[item]).val());
            }
            data.append("ss", $(this).data("id"));
            var cuotas_send = [];
            for (var item in cuotas) {
                cuotas_send.push("{" + cuotas[item] + "}");
            }
            data.append("cuotas_producto", cuotas_send);
            $.ajax({
                type: 'POST',
                url: "../Model/Leads/AddProduct.php",
                data: data,
                dataType: 'json',
                contentType: false,
                processData: false,
                cache: false,
                success: function (response) {
                    if (response !== "error") {
                        setTimeout(redireccionarPagina('Profile.php?token=' + btoa(response) + '&mensaje=productOk'), 5000);
                    } else {
                        showAlert("Ocurrio un error al crear el producto", "error");
                    }
                }
            });
        }
    }
});
// fin crear productos
//------------------------------------------------------------------------------
//limpiar Modals
function cleanModalsProducts() {
    var campos = ['fecha_pago', 'valor_cuota', 'tipo_producto', 'banco',
        'titular', 'tipo_cuenta', 'ruta', 'cuenta', 'valor', 'cuotas'];
    for (var item in campos) {
        $("#" + campos[item]).val("");
        $("#" + campos[item]).css("border", "1px solid #d2d6de");
    }
    cuotas = [];
    sum_valor_total = 0;
    num_cuota = 0;
    jQuery("#tot_deuda").html("");
    jQuery("#content_cuotas").html("");
}

//Friltro en home.
$("#filterInHome").click(function () {

    var campos = ['fini', 'ffin'];
    var countErrors = 0;
    for (var item in campos) {
        if ($("#" + campos[item]).val() === ""
                || $("#" + campos[item]).val() === "Seleccione") {
            countErrors++;
            $("#" + campos[item]).css("border", "1px solid red");
        } else {
            $("#" + campos[item]).css("border", "1px solid #d2d6de");
        }
    }
    if (countErrors > 0) {
        showAlert("Los campos marcados en rojo son obligatorios", "error");
    } else {

        var data = new FormData();
        data.append("fini", $("#fini").val());
        data.append("ffin", $("#ffin").val());
        if ($("#asesor").val() != "") {
            data.append("asesor", $("#asesor").val());
        }

        $.ajax({
            type: 'POST',
            url: "../Model/Usuarios/filterHome.php",
            data: data,
            dataType: 'json',
            contentType: false,
            processData: false,
            cache: false,
            success: function (response) {                //var json = JSON.stringify(response);
                jQuery("#total_leads").text("Total: " + response.total_leads);
                jQuery("#notificaiones_pend").text("Total: " + response.notificaiones_pend);
                jQuery("#notificaciones_ejec").text("Total: " + response.notificaciones_ejec);
                jQuery("#total_clientes").text(response.total_clientes);
                jQuery("#total_venta").text("$" + response.total_venta);
                jQuery("#total_tranfer").html("$" + response.total_tranfer);
                jQuery("#total_proccess").html("$" + response.total_proccess);
                jQuery("#total_aprobados").html("$" + response.total_aprobados);
                jQuery("#total_caida").html("$" + response.total_caida);
                console.log(response.total_leads);
//                    if (response === "ok") {
//                        setTimeout(redireccionarPagina('ListarRecursos.php?mensaje=delete'), 5000);
//                    } else {
//                        showAlert("Ocurrio un error al eliminar la el afiliado", "error");
//                    }
            }
        });
    }
});
//----------------------------------------------------------------------------
//funcion enabled edit pay
jQuery(".seleccionarCuota").click(function () {
    if ($(this).hasClass("fa-check")) {
        jQuery("#slect" + $(this).data("id")).attr("disabled", "disabled");
        $(this).attr("title", "Cambiar Estado");
        $(this).attr("data-original-title", "Cambiar Estado");
        $(this).removeClass("fa-check");
        $(this).addClass("fa-edit");
        $("#slect" + $(this).data("id")).hide();
        $("#fpago" + $(this).data("id")).hide();
        $("#v_cuota" + $(this).data("id")).hide();
        $("#spn" + $(this).data("id")).show();
        $("#fshow" + $(this).data("id")).show();
        $("#vcuota" + $(this).data("id")).show();


        var data = new FormData();
        data.append("id_estado_pago", $("#slect" + $(this).data("id")).val());
        data.append("id_pago", $("#slect" + $(this).data("id")).data("id"));
        data.append("token", $("#slect" + $(this).data("id")).data("token"));
        data.append("cuota", $("#v_cuota" + $(this).data("id")).val());
        data.append("fpago", $("#f_pago" + $(this).data("id")).val());
        $.ajax({
            type: 'POST',
            url: "../Model/Usuarios/updatePaymentStatus.php",
            data: data,
            dataType: 'json',
            contentType: false,
            processData: false,
            cache: false,
            success: function (response) {
                console.log(response);
                if (response.msg === "success") {
                    setTimeout(redireccionarPagina('Profile.php?token=' + response.token + '&mensaje=payUpdate'), 5000);
                } else {
                    showAlert("Ocurrio un error al actualizar el estado de pago..!", "error");
                }
            }
        });
    } else {
        jQuery("#slect" + $(this).data("id")).removeAttr("disabled");
        $(this).attr("title", "Guardar");
        $(this).attr("data-original-title", "Guardar");
        $(this).removeClass("fa-edit");
        $(this).addClass("fa-check");
        $("#spn" + $(this).data("id")).hide();
        $("#fshow" + $(this).data("id")).hide();
        $("#vcuota" + $(this).data("id")).hide();
        $("#slect" + $(this).data("id")).show();
        $("#fpago" + $(this).data("id")).show();
        $("#v_cuota" + $(this).data("id")).show();
    }
});
//------------------------------------------------------------------------------
//Modal Addcuota
$(".addCuota").click(function () {
    $("#addCuota" + $(this).data("id")).trigger("click");
    $("#addCuota").attr("data-id", $(this).data("id"));
});

$("#addCuota").click(function () {

    var campos = ['valor_c', 'fecha_pago_c'];
    var countErrors = 0;
    for (var item in campos) {
        if ($("#" + campos[item]).val() === ""
                || $("#" + campos[item]).val() === "Seleccione") {
            countErrors++;
            $("#" + campos[item]).css("border", "1px solid red");
        } else {
            $("#" + campos[item]).css("border", "1px solid #d2d6de");
        }
    }
    if (countErrors > 0) {
        showAlert("Los campos marcados en rojo son obligatorios", "error");
    } else {
        var data = new FormData();
        data.append("id_producto", $(this).data("id"));
        data.append("token", $(this).data("token"));
        data.append("valor_c", $("#valor_c").val());
        data.append("fecha_pago_c", $("#fecha_pago_c").val());
        $.ajax({
            type: 'POST',
            url: "../Model/Usuarios/AddCuota.php",
            data: data,
            dataType: 'json',
            contentType: false,
            processData: false,
            cache: false,
            success: function (response) {
                if (response.msg === "success") {
                    /* var htmlCuotas = '<tr>'
                     + '<td>'
                     + '<a class="textoc">'+response.numero_cuota+'</a>'
                     + '</td>'
                     + '<td>'
                     + '<a class="textoc" id="vcuota id_pago">'+response.valor_c+'</a>'
                     + '</td>'
                     + '<td>'
                     + '<a class="textoc" data-toggle="tooltip" title="descripcion" data-original-title="PTE POR PROCESAR">'
                     + '<div class="col-sm-7">'
                     + '<span class="label label-warning up" id="spn id_pago">'+response.codigo_pago+'</span>'
                     + '</div>'
                     + '</a>'
                     + '</td>'
                     + '<td>'
                     + '<a class="textoc" id="fshow id_pago">'+response.fecha_pago_c+'</a>'
                     + '</td>'
                     + '<td>'
                     + '<i class="fa fa-fw fa-eraser deleteCuota" style="cursor: pointer;color: red;" data-id="'+response.id_pago+'"'
                     + ' data-toggle="tooltip" data-token="token" title="Eliminar" ></i>'
                     + '<button type="button" style="display: none" class="btn btn-default" data-toggle="modal"'
                     + ' data-target="#modal-deleteCuota" id="deleteCuota'+response.id_pago+'"/>'
                     + '</td></tr>';
                     jQuery("#cuotas" + response.id_producto).append(htmlCuotas);
                     jQuery("#addCuotaDismiss").trigger("click");*/
                    setTimeout(redireccionarPagina('Profile.php?token=' + response.token + '&mensaje=addCuota'), 5000);
                } else {
                    showAlert("Ocurrio un error al eliminar la cuota..!", "error");
                }
            }
        });
    }
});
//fin add cuota
//------------------------------------------------------------------------------
//Modal delteLead
$(".deleteCuota").click(function () {
    $("#deleteCuota" + $(this).data("id")).trigger("click");
    $("#deleteCuota").attr("data-id", $(this).data("id"));
    $("#deleteCuota").attr("data-token", $(this).data("token"));
});

$("#deleteCuota").click(function () {
    var data = new FormData();
    data.append("id_pago", $(this).data("id"));
    data.append("token", $(this).data("token"));
    $.ajax({
        type: 'POST',
        url: "../Model/Usuarios/DeleteCuota.php",
        data: data,
        dataType: 'json',
        contentType: false,
        processData: false,
        cache: false,
        success: function (response) {
            if (response.msg === "success") {
                setTimeout(redireccionarPagina('Profile.php?token=' + response.token + '&mensaje=deleteCuota'), 5000);
            } else {
                showAlert("Ocurrio un error al eliminar la cuota..!", "error");
            }
        }
    });
});
//fin delete lead


//SendPresentation
$(".sendPresentation").click(function () {
    var data = new FormData();
    data.append("ss", $(this).data("ss"));
    data.append("name", $(this).data("name"));
    $.ajax({
        type: 'POST',
        url: "../Model/PDFLibrary/CartaPresentacion.php",
        data: data,
        dataType: 'json',
        contentType: false,
        processData: false,
        cache: false,
        success: function (response) {
            if (response.msg === "success") {
                // showAlert("Carta de Presentación enviada..!", "success", "middle");
                setTimeout(redireccionarPagina('Profile.php?token=' + response.token + '&mensaje=documento'), 5000);
                // $("#sendPresentation").css("display", "none");
            } else {
                showAlert("Ocurrio un error al eliminar la cuota..!", "error");
            }
        }
    });
});
//Enviar Documento
$(".sendFile").click(function () {
    var data = new FormData();
    data.append("ss", $(this).data("ssocial"));
    data.append("type_doc", $(this).data("type"));
    $.ajax({
        type: 'POST',
        url: "../Model/Utilidades/ReSendDoc.php",
        data: data,
        dataType: 'json',
        contentType: false,
        processData: false,
        cache: false,
        success: function (response) {
            if (response.msg === "success") {
                showAlert("Carta de Presentación enviada..!", "success", "middle");
            } else {
                showAlert("Ocurrio un error al eliminar la cuota..!", "error");
            }
        }
    });
});

//style : success,info,warn,error
function showAlert(text, style) {
    $.notify(text, style);
}

function redireccionarPagina(pagina) {
    window.location = pagina;
}