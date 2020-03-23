$(document).ready(function () {

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

    $("#Inicio").click(function () {
        redireccionarPagina('HomeAsesor.php');
    });
    
    $("#backInicio").click(function () {
        redireccionarPagina('HomeAsesor.php');
    });

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
                        setTimeout(redireccionarPagina('ListarUsuarios.php?mensaje=ok'), 5000);
                    } else {
                        showAlert("Ocurrio un error al crear el Lead", "error");
                    }
                }
            });
        }
    });


    //Modal delteLead
    $(".deleteLead").click(function () {
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

    $(".moreinfoLead").click(function () {
        redireccionarPagina('ProfileLead.php?token=' + $(this).data("id"));
    });


    $("#backfromProfile").click(function () {
        redireccionarPagina('ListarLeads.php');
    });


    //Modal Documentos
    $(".newDocument").click(function () {
        $("#newDoc" + $(this).data("id")).trigger("click");
        $("#addDocument").attr("data-id", $(this).data("id"));
    });



    //AddDocuments
    $("#addDocument").click(function () {

        var campos = ['descripcion', 'exampleInputFile'];
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
            $.ajax({
                type: 'POST',
                url: "../Model/Leads/AddDocuments.php",
                data: data,
                dataType: 'json',
                contentType: false,
                processData: false,
                cache: false,
                success: function (response) {

                    if (response !== "error") {
                        setTimeout(redireccionarPagina('ProfileLead.php?token=' + btoa(response) + '&mensaje=ok'), 5000);
                    } else {
                        showAlert("Ocurrio un error al crear el afiliado", "error");
                    }
                }
            });
        }
    });


    //Modal delteDoc
    $(".deleteDoc").click(function () {
        $("#docId" + $(this).data("id")).trigger("click");
        $("#deleteDoc").attr("data-id", $(this).data("id"));
        $("#deleteDoc").attr("data-ss", $(this).data("ssocial"));
    });


    $("#deleteDoc").click(function () {
        var data = new FormData();
        data.append("id", $(this).data("id"));
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
                if (response == "ok") {
                    setTimeout(redireccionarPagina('ProfileLead.php?token=' + ss + '&mensaje=deleteok'), 5000);
                } else {
                    showAlert("Ocurrio un error al eliminar la el afiliado", "error");
                }
            }
        });
    });
    //Fin delteDoc


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


    //style : success,info,warn,error
    function showAlert(text, style) {
        $.notify(text, style);
    }

    function redireccionarPagina(pagina) {
        window.location = pagina;
    }




});

