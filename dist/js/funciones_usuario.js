$(document).ready(function () {

    $(".updateUser").click(function () {
        redireccionarPagina('ActualizarUsuarios.php?token=' + $(this).data("id"));
    });


    $("#crearUsuarioSystem").click(function () {
        redireccionarPagina('CrearUsuarios.php');
    });


    $("#backCrearUsuarios").click(function () {
        redireccionarPagina('ListarUsuarios.php');
    });


    $(".deleteUser").click(function () {
        $("#user" + $(this).data("id")).trigger("click");
        $("#deleteUser").attr("data-id", $(this).data("id"));
    });


    $(".update").mouseenter(function () {
        $(this).css("border", "0.5px solid lightgray");
    });

    $(".update").mouseleave(function () {
        $(this).css("border", "0.5px solid white");
    });

    $(".file").click(function () {
        $("#file").trigger("click");
        $('#file').change(function () {
            var filename = $('#file').val();
            var splitDatos = filename.split('\\');
            $('.file').val("Archivo seleccionado: " + splitDatos[splitDatos.length - 1]);
        });
    });


    $(".coach").click(function () {
        var val = $('input:radio[name=isCoach]:checked').val();
        if (val == "Si") {
            $("#showCoach").css("display", "block");
        } else {
            jQuery("#coach").val("");
            $("#showCoach").css("display", "none");
        }
    });


    //Crear usuarios
    $("#CrearUsuarios").click(function () {
        var campos = ['tipo_doc', 'documento', 'nombres', 'apellidos', 'telefonos', 'tipo_user', 'pass'];
        var val = $('input:radio[name=isCoach]:checked').val();
        if (val == "Si") {
            campos[7] = "coach";
        }
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
            var inputFile = document.getElementById("foto");
            if (inputFile != null) {
                var file = inputFile.files[0];
                data.append("foto", file);
            }
            data.append("documento", $("#documento").val());
            data.append("tipo_doc", $("#tipo_doc").val());
            data.append("nombres", $("#nombres").val());
            data.append("pass", $("#pass").val());
            data.append("apellidos", $("#apellidos").val());
            data.append("telefonos", $("#telefonos").val());
            data.append("id_tipo_usuario", $("#tipo_user").val());
            data.append("coach", $("#coach").val());
            $.ajax({
                async: true,
                type: "POST",
                url: "../Model/Usuarios/AddUsers.php",
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
                        showAlert("Ocurrio un error al actualizar la informaciòn", "error");
                    }
                }
            });
        }
    });
    //Actualizar usuarios
    $("#ActualizarUsuarios").click(function () {
        var campos = ['tipo_doc', 'documento', 'nombres', 'apellidos', 'telefonos', 'tipo_user', 'pass'];
        var val = $('input:radio[name=isCoach]:checked').val();
        if (val == "Si") {
            campos[7] = "coach";
        }
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
            showAlert("Los campos marcados en rojo son obligatorios..!", "error");
        } else {
            var data = new FormData();
            var inputFile = document.getElementById("foto");
            if (inputFile != null) {
                var file = inputFile.files[0];
                data.append("foto", file);
            }
            data.append("documento", $("#documento").val());
            data.append("tipo_doc", $("#tipo_doc").val());
            data.append("nombres", $("#nombres").val());
            data.append("pass", $("#pass").val());
            data.append("apellidos", $("#apellidos").val());
            data.append("telefonos", $("#telefonos").val());
            data.append("id_tipo_usuario", $("#tipo_user").val());
            data.append("coach", $("#coach").val());
            data.append("id", $("#id").val());
            $.ajax({
                type: 'POST',
                url: "../Model/Usuarios/UpdateUsers.php",
                data: data,
                dataType: 'json',
                contentType: false,
                processData: false,
                cache: false,
                success: function (response) {
                    if (response === "ok") {
                        setTimeout(redireccionarPagina('ListarUsuarios.php?mensaje=updateok'), 5000);
                    } else {
                        showAlert("Ocurrio un error al actualizar la informaciòn", "error");
                    }
                }
            });
        }
    });
    //Eliminar usuarios
    $("#deleteUser").click(function () {
        var data = new FormData();
        data.append("id", $(this).data("id"));
        $.ajax({
            type: 'POST',
            url: "../Model/Usuarios/DeleteUsers.php",
            data: data,
            dataType: 'json',
            contentType: false,
            processData: false,
            cache: false,
            success: function (response) {
                if (response == "ok") {
                    setTimeout(redireccionarPagina('ListarUsuarios.php?mensaje=deleteok'), 5000);
                } else {
                    showAlert("Ocurrio un error al actualizar la informaciòn", "error");
                }
            }
        });
    });
    //AddRecursos
    $("#addRecurso").click(function () {

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
            $.ajax({
                type: 'POST',
                url: "../Model/Usuarios/AddRecursos.php",
                data: data,
                dataType: 'json',
                contentType: false,
                processData: false,
                cache: false,
                success: function (response) {
                    if (response === "ok") {
                        setTimeout(redireccionarPagina('ListarRecursos.php?mensaje=create'), 5000);
                    } else {
                        showAlert("Ocurrio un error al crear el recurso", "error");
                    }
                }
            });
        }
    });



    $("#crearEstado").click(function () {
        $("#addEstado").attr("data-accion", "add");
    });


    $(".updateEstado").click(function () {
        $("#estadoId" + $(this).data("id")).trigger("click");
        $("#addEstado").attr("data-accion", "update");
        $("#addEstado").attr("data-id", $(this).data("id"));
        $("#nom_estado").val($(this).data("estado"));

    });

    $("#addEstado").click(function () {
        var data = new FormData();
        if ($(this).data("accion") == "add") {
            data.append("accion", $(this).data("accion"));
            data.append("estado", $("#nom_estado").val());
        } else {
            data.append("accion", $(this).data("accion"));
            data.append("id", $(this).data("id"));
            data.append("estado", $("#nom_estado").val());
        }
        $.ajax({
            type: 'POST',
            url: "../Model/Usuarios/addUpdateEstado.php",
            data: data,
            dataType: 'json',
            contentType: false,
            processData: false,
            cache: false,
            success: function (response) {
                if (response.msn === "ok") {
                    if (response.accion === "add") {
                        setTimeout(redireccionarPagina('ListarEstados.php?mensaje=estadoOk'), 5000);
                    } else {
                        setTimeout(redireccionarPagina('ListarEstados.php?mensaje=estadoUpdate'), 5000);
                    }
                } else {
                    showAlert("Ocurrio un error al crear el estado", "error");
                }
            }
        });
    });

    //Modal delete estado
    $(".deleteEstado").click(function () {
        $("#delEstadoId" + $(this).data("id")).trigger("click");
        $("#deleteEstado").attr("data-id", $(this).data("id"));
    });
    $("#deleteEstado").click(function () {
        var data = new FormData();
        data.append("id", $(this).data("id"));
        $.ajax({
            type: 'POST',
            url: "../Model/Usuarios/DeleteEstado.php",
            data: data,
            dataType: 'json',
            contentType: false,
            processData: false,
            cache: false,
            success: function (response) {
                if (response === "ok") {
                    setTimeout(redireccionarPagina('ListarEstados.php?mensaje=deleteEstado'), 5000);
                } else {
                    showAlert("Ocurrio un error al eliminar el estado", "error");
                }
            }
        });
    });

    //AddCiudad a Estado

    $(".newCIudad").click(function () {
        $("#addCiudad").attr("data-id", $(this).data("id"));
        $("#addCiudad").attr("data-accion", "add");
        $("#addCiudad").attr("data-view", $(this).data("view"));
    });


    $(".updateCiudad").click(function () {
        $("#ciudadId" + $(this).data("id")).trigger("click");
        $("#addCiudad").attr("data-accion", "update");
        $("#addCiudad").attr("data-id", $(this).data("id"));
        $("#addCiudad").attr("data-view", $(this).data("view"));
        $("#nom_ciudad").val($(this).data("ciudad"));
    });

    $("#addCiudad").click(function () {
        var campos = ['nom_ciudad'];
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
            data.append("token", $(this).data("token"));
            data.append("view", $(this).data("view"));
            if ($(this).data("accion") === "add") {
                data.append("ciudad", $("#nom_ciudad").val());
                data.append("id_estado", $(this).data("id"));
                data.append("accion", $(this).data("accion"));
            } else {
                data.append("accion", $(this).data("accion"));
                data.append("id_ciudad", $(this).data("id"));
                data.append("ciudad", $("#nom_ciudad").val());
            }
            $.ajax({
                type: 'POST',
                url: "../Model/Usuarios/addUpdateCiudad.php",
                data: data,
                dataType: 'json',
                contentType: false,
                processData: false,
                cache: false,
                success: function (response) {
                    if (response.message_code === "success") {
                        if (response.accion === "add") {
                            if (response.view === "estados") {
                                setTimeout(redireccionarPagina('ListarEstados.php?mensaje=ciudadOk'), 5000);
                            } else {
                                setTimeout(redireccionarPagina('InfoEstados.php?mensaje=ciudadOk&token=' + response.token), 5000);
                            }
                        } else {
                            if (response.view === "estados") {
                                setTimeout(redireccionarPagina('ListarEstados.php?mensaje=ciudadUpdate'), 5000);
                            } else {
                                setTimeout(redireccionarPagina('InfoEstados.php?mensaje=ciudadUpdate&token=' + response.token), 5000);
                            }
                        }
                    } else {
                        showAlert("Ocurrio un error al crear el estado", "error");
                    }
                }
            });
        }
    });

    //Modal delete Ciudad
    $(".deleteCiudad").click(function () {
        $("#deleteCiudadId" + $(this).data("id")).trigger("click");
        $("#deleteCiudad").attr("data-id", $(this).data("id"));
    });
    $("#deleteCiudad").click(function () {
        var data = new FormData();
        data.append("id", $(this).data("id"));
        data.append("token", $(this).data("token"));
        $.ajax({
            type: 'POST',
            url: "../Model/Usuarios/DeleteCiudad.php",
            data: data,
            dataType: 'json',
            contentType: false,
            processData: false,
            cache: false,
            success: function (response) {
                if (response.message_code === "success") {
                    setTimeout(redireccionarPagina('InfoEstados.php?mensaje=deleteCiudad&token=' + response.token), 5000);
                } else {
                    showAlert("Ocurrio un error al eliminar el estado", "error");
                }
            }
        });
    });



    //Update Email Config
    $(".updateConfig").click(function () {
        $("#configEmailId" + $(this).data("id")).trigger("click");
        $("#updateConfig").attr("data-id", $(this).data("id"));
        $("#email_sender").val($(this).data("email"));
        $("#email_pass").val($(this).data("pass"));
    });

    $("#updateConfig").click(function () {
        var campos = ['email_sender', 'email_pass'];
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
            data.append("email", $("#email_sender").val());
            data.append("pass", $("#email_pass").val());
            data.append("id", $(this).data("id"));
            $.ajax({
                type: 'POST',
                url: "../Model/Usuarios/updateConfigEmail.php",
                data: data,
                dataType: 'json',
                contentType: false,
                processData: false,
                cache: false,
                success: function (response) {
                    if (response.msn === "ok") {
                        setTimeout(redireccionarPagina('CredencialesEmail.php?mensaje=configOk'), 5000);
                    } else {
                        showAlert("Ocurrio un error al crear el estado", "error");
                    }
                }
            });
        }
    });

//Ver info estado
    $(".viewEstado").click(function () {
        var data = $(this).data("id") + "|" + $(this).data("name");
        redireccionarPagina('InfoEstados.php?token=' + btoa(data));
    });


//Modal delteDoc
    $(".deleteRecurso").click(function () {
        $("#RecursoId" + $(this).data("id")).trigger("click");
        $("#deleteRecurso").attr("data-id", $(this).data("id"));
    });
    $("#deleteRecurso").click(function () {
        var data = new FormData();
        data.append("id", $(this).data("id"));
        $.ajax({
            type: 'POST',
            url: "../Model/Usuarios/DeleteRecurso.php",
            data: data,
            dataType: 'json',
            contentType: false,
            processData: false,
            cache: false,
            success: function (response) {
                if (response === "ok") {
                    setTimeout(redireccionarPagina('ListarRecursos.php?mensaje=delete'), 5000);
                } else {
                    showAlert("Ocurrio un error al eliminar la el afiliado", "error");
                }
            }
        });
    });
    //Fin delteDoc
//------------------------------------------------------------------------------
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
            if ($("#coach").val() != "") {
                data.append("coach", $("#coach").val());
            }
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
                success: function (response) {

                    //var json = JSON.stringify(response);
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


    $(".moreinfo").click(function () {
        redireccionarPagina('profile.php?token=' + $(this).data("id"));
    });


    $("#backInicio").click(function () {
        if ($(this).data("view") === "asesor") {
            redireccionarPagina('HomeAsesor.php');
        } else {
            redireccionarPagina('HomeAdmin.php');
        }
    });

    $("#backEstados").click(function () {
        redireccionarPagina('ListarEstados.php');

    });

    $("#Inicio").click(function () {
        redireccionarPagina('HomeAdmin.php');
    });

    //style : success,info,warn,error
    function showAlert(text, style) {
        $.notify(text, style);
    }


    function redireccionarPagina(pagina) {
        window.location = pagina;
    }


    $(".public").click(function () {
        var elemento = $(this);
        var field = elemento.parent(elemento).attr("for");
        var value = elemento.parent(elemento).attr("class");
        $.ajax({
            type: 'POST',
            url: "Model/updatePublicFields.php",
            dataType: 'json',
            data: {"campo": field, "valor": value},
            success: function (response) {
                if (response == "ok") {
                    setTimeout(redireccionarPagina('profile.php'), 3000);
                } else {
                    showAlert("No se pudo cambiar el estado", "error");
                }
            }
        });
    });

});

