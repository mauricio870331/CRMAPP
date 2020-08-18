$(document).ready(function () {

    var redirectPay = "";

    $(".updateUser").click(function () {
        redireccionarPagina('ActualizarUsuarios.php?token=' + $(this).data("id"));
    });


    $(".updateDayPay").click(function () {
        redireccionarPagina('ActualizarDiaDePago.php?token=' + $(this).data("id"));
    });

    $("#crearUsuarioSystem").click(function () {
        redireccionarPagina('CrearUsuarios.php');
    });


    $("#backCrearUsuarios").click(function () {
        redireccionarPagina('ListarUsuarios.php');
    });


    $(".seeInfo").click(function () {
        redireccionarPagina('VerInfoVehiculo.php?token=' + $(this).data("id"));
    });


    $(".deleteUser").click(function () {
        $("#user" + $(this).data("id")).trigger("click");
        $("#deleteUser").attr("data-id", $(this).data("id"));
    });


    $(".deleteR").click(function () {
        $("#R" + $(this).data("id")).trigger("click");
        $("#deleteR").attr("data-id", $(this).data("id"));
    });


    $(".deleteVehiculo").click(function () {
        $("#vehiculo" + $(this).data("id")).trigger("click");
        $("#deleteVehiculo").attr("data-id", $(this).data("id"));
        $("#deleteVehiculo").attr("data-estado", $(this).data("estado"));
        $("#deleteVehiculo").attr("data-r", $(this).data("r"));
    });


    $(".deleteDayPay").click(function () {
        $("#user" + $(this).data("id")).trigger("click");
        $("#deletDayPay").attr("data-id", $(this).data("id"));
    });
    $("#crearAfiliado").click(function () {
        redireccionarPagina('CrearAfiliados.php');
    });

    $("#cancelarAfiliados").click(function () {
        redireccionarPagina('ListarAfiliados.php');
    });

    $("#cancelarAfiliados2").click(function () {
        if ($(this).data("redirect") === true) {
            redirectPay = 'ListadoDePagos.php';
        } else {
            redirectPay = 'ListarAfiliados.php';
        }
        redireccionarPagina(redirectPay);
    });


    $("#cancelarR").click(function () {
        redireccionarPagina('ListarR.php');
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


    $(".findVehiculo").click(function () {
        $("#findVehiculo").trigger("click");
        $("#dato").val("");
    });


    $(".updateDocumento").click(function () {
        redireccionarPagina('UpdateDocument.php?token=' + $(this).data("id") + "&token2=" + $(this).data("id_vehiculo"));
    });


    $(".updatePropietario").click(function () {
        redireccionarPagina('UpdatePropietarios.php?token=' + $(this).data("id") + "&token2=" + $(this).data("id_propietario"));
    });


    $("#crearR").click(function () {
        redireccionarPagina('CrearR.php');
    });

    $(".updateR").click(function () {
        redireccionarPagina('ActualizarR.php?token=' + $(this).data("id"));
    });





//    $('#Nom_Doc').change(function () {
//        var data = new FormData();        
//        data.append("Nom_Doc", $("#Nom_Doc").val());
//        data.append("idVehiculo", $("#R").val());        
//        $.ajax({
//            type: 'POST',
//            url: "Model/Admin/chekDocuments.php",
//            data: data,
//            dataType: 'json',
//            contentType: false,
//            processData: false,
//            cache: false,
//            success: function (response) {
//                if (response == "ok") {
//                    setTimeout(redireccionarPagina('ListarUsuarios.php?mensaje=ok'), 5000);
//                } else {
//                    showAlert("Ocurrio un error al actualizar la informaciòn", "error");
//                }
//            }
//        });
//    });


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




    //Crear usuarios
//    $("#CrearUsuarios").click(function () {
//
//        campos = ['Documento', 'Nombres', 'Apellidos', 'pwd'];
//        var countErrors = 0;
//        for (var item in campos) {
//            if ($("#" + campos[item]).val() === "") {
//                countErrors++;
//                $("#" + campos[item]).css("border", "1px solid red");
//            } else {
//                $("#" + campos[item]).css("border", "1px solid #d2d6de");
//            }
//        }
//
//        if (countErrors > 0) {
//            showAlert("Los campos marcados en rojo son obligatorios..!", "error");
//        } else {
//            var data = new FormData();
//            var inputFile = document.getElementById("foto");
//            if (inputFile != null) {
//                var file = inputFile.files[0];
//                data.append("foto", file);
//            }
//            data.append("documento", $("#Documento").val());
//            data.append("nombres", $("#Nombres").val());
//            data.append("apellidos", $("#Apellidos").val());
//            data.append("pwd", $("#pwd").val());
//            $.ajax({
//                type: 'POST',
//                url: "Model/Usuarios/AddUsers.php",
//                data: data,
//                dataType: 'json',
//                contentType: false,
//                processData: false,
//                cache: false,
//                success: function (response) {
//                    if (response == "ok") {
//                        setTimeout(redireccionarPagina('ListarUsuarios.php?mensaje=ok'), 5000);
//                    } else {
//                        showAlert("Ocurrio un error al actualizar la informaciòn", "error");
//                    }
//                }
//            });
//        }
//    });


    //crear propietarios vehiculos
    $("#CrearPropietarioVehiculo").click(function () {

        campos = ['Documento', 'nompro', 'nomresp', 'telpro', 'telres'];
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
            data.append("documento", $("#Documento").val());
            data.append("nompro", $("#nompro").val());
            data.append("nomresp", $("#nomresp").val());
            data.append("telpro", $("#telpro").val());
            data.append("telres", $("#telres").val());
            data.append("id_vehiculo", $("#id_vehiculo").val());
            $.ajax({
                type: 'POST',
                url: "Model/Admin/AddPropietarios.php",
                data: data,
                dataType: 'json',
                contentType: false,
                processData: false,
                cache: false,
                success: function (response) {
                    if (response == "ok") {
                        setTimeout(redireccionarPagina('ListarVehiculos.php?mensaje=ok'), 5000);
                    } else {
                        showAlert("Ocurrio un error al actualizar la informaciòn", "error");
                    }
                }
            });
        }
    });


    //Crear usuarios


    //Update propietarios
    $("#UpdatePropietarioVehiculo").click(function () {

        campos = ['Documento', 'nompro', 'nomresp', 'telpro', 'telres'];
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
            var token = $("#id_vehiculo").val().split(",");
            data.append("documento", $("#Documento").val());
            data.append("nompro", $("#nompro").val());
            data.append("nomresp", $("#nomresp").val());
            data.append("telpro", $("#telpro").val());
            data.append("telres", $("#telres").val());
            data.append("id_vehiculo", $("#id_vehiculo").val());
            $.ajax({
                type: 'POST',
                url: "Model/Admin/UpdatePropietarios.php",
                data: data,
                dataType: 'json',
                contentType: false,
                processData: false,
                cache: false,
                success: function (response) {
                    if (response == "ok") {
                        setTimeout(redireccionarPagina('VerInfoVehiculo.php?token=' + btoa(token[0]) + '&mensaje=updateok'), 5000);
                    } else {
                        showAlert("Ocurrio un error al actualizar la informaciòn", "error");
                    }
                }
            });
        }
    });




//    $("#deleteUser").click(function () {
//        var data = new FormData();
//        data.append("id", $(this).data("id"));
//        $.ajax({
//            type: 'POST',
//            url: "Model/Usuarios/DeleteUsers.php",
//            data: data,
//            dataType: 'json',
//            contentType: false,
//            processData: false,
//            cache: false,
//            success: function (response) {
//                if (response == "ok") {
//                    setTimeout(redireccionarPagina('ListarUsuarios.php?mensaje=deleteok'), 5000);
//                } else {
//                    showAlert("Ocurrio un error al actualizar la informaciòn", "error");
//                }
//            }
//        });
//    });



    $("#deleteVehiculo").click(function () {
        var data = new FormData();
        data.append("id", $(this).data("id"));
        data.append("estado", $(this).data("estado"));
        data.append("R", $(this).data("r"));
        $.ajax({
            type: 'POST',
            url: "Model/Admin/DeleteVehiculos.php",
            data: data,
            dataType: 'json',
            contentType: false,
            processData: false,
            cache: false,
            success: function (response) {
                if (response == "ok") {
                    setTimeout(redireccionarPagina('ListarVehiculos.php?mensaje=deleteok'), 5000);
                } else {
                    showAlert("Ocurrio un error al actualizar la informaciòn", "error");
                }
            }
        });
    });


    $("#deletDayPay").click(function () {
        var data = new FormData();
        data.append("id", $(this).data("id"));
        $.ajax({
            type: 'POST',
            url: "Model/DeleteDayPay.php",
            data: data,
            dataType: 'json',
            contentType: false,
            processData: false,
            cache: false,
            success: function (response) {
                if (response == "ok") {
                    setTimeout(redireccionarPagina('ListarDiaDePago.php?mensaje=deleteok'), 5000);
                } else {
                    showAlert("Ocurrio un error al elimiar el registro", "error");
                }
            }
        });
    });


    $("#AddVehiculosSystem").click(function () {
        campos = ['R', 'Placa', 'Marca', 'Cooperativa', 'Linea'];
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
            data.append('R', $("#R").val());
            data.append('Placa', $("#Placa").val());
            data.append('Marca', $("#Marca").val());
            data.append('Cooperativa', $("#Cooperativa").val());
            data.append('Linea', $("#Linea").val());
            data.append('id_r', $("#id_r").val());
            $.ajax({
                type: 'POST',
                url: "Model/Admin/CreateVehiculosSystem.php",
                data: data,
                dataType: 'json',
                contentType: false,
                processData: false,
                cache: false,
                success: function (response) {
                    if (response == "ok") {
                        setTimeout(redireccionarPagina('ListarVehiculos.php?mensaje=ok'), 5000);
                    } else {
                        showAlert("Ocurrio un error al elimiar el registro", "error");
                    }
                }
            });
        }

    });



    $("#UpdateVehiculosSystem").click(function () {
        campos = ['Placa', 'Marca', 'Cooperativa', 'Linea'];
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
            data.append('R', $("#R").val());
            data.append('id', $("#id").val());
            data.append('Placa', $("#Placa").val());
            data.append('Marca', $("#Marca").val());
            data.append('Cooperativa', $("#Cooperativa").val());
            data.append('Linea', $("#Linea").val());
            data.append('estado', $("#estado").val());
            data.append('id_r', $("#id_r").val());
            $.ajax({
                type: 'POST',
                url: "Model/Admin/UpdateVehiculosSystem.php",
                data: data,
                dataType: 'json',
                contentType: false,
                processData: false,
                cache: false,
                success: function (response) {
                    if (response == "ok") {
                        setTimeout(redireccionarPagina('ListarVehiculos.php?mensaje=updateok'), 5000);
                    } else {
                        showAlert("Ocurrio un error al Actualizar el registro", "error");
                    }
                }
            });
        }

    });

//Crear afiliados


    var next = 1;
    $("#NextStep").click(function () {
        $("#step_" + next).css("display", "none");
        next = next + 1;
        $("#step_" + next).css("display", "block");
        if (next > 1) {
            $("#ForwardStep").css("display", "inline-block");
            $("#CrearAfiliadosBtn").css("display", "none");
            $("#updateAfiliadosBtn").css("display", "none");
        }
        if (next == 3) {
            $("#NextStep").css("display", "none");
            $("#CrearAfiliadosBtn").css("display", "inline-block");
            $("#updateAfiliadosBtn").css("display", "inline-block");
        }




    });

    $("#ForwardStep").click(function () {

        $("#step_" + next).css("display", "none");
        next = next - 1;
        $("#step_" + next).css("display", "block");
        if (next == 1) {
            $("#ForwardStep").css("display", "none");
        }
        if (next < 3) {
            $("#NextStep").css("display", "block");
            $("#CrearAfiliadosBtn").css("display", "none");
            $("#updateAfiliadosBtn").css("display", "none");
        }

    });


    $("#departamento").change(function () {
        $.ajax({
            type: 'POST',
            url: "Model/Admin/ciudades.php",
            data: {"cod": $(this).val()},
            dataType: 'html',
            success: function (response) {
//                console.log(response);
                $("#ciudad").html(response);
            }
        });
    });




// Para los campos obligatorios de afiliados
    var todosloscampos = ['nacimiento', 'tipo_doc', 'Documento', 'fechExpedicion', 'Nombres'
                , 'Apellidos', 'genero', 'nacionalidad', 'lugarExpe', 'direccion', 'telefonos', 'departamento'
                , 'ciudad', 'correspondencia', 'estadocivil', 'turno', 'diadepago'];


    $("#CrearAfiliadosBtn").click(function () {

        var countErrors = 0;
        for (var item in todosloscampos) {
            if ($("#" + todosloscampos[item]).val() === ""
                    || $("#" + todosloscampos[item]).val() === "Seleccione") {
                countErrors++;
                $("#" + todosloscampos[item]).css("border", "1px solid red");
            } else {
                $("#" + todosloscampos[item]).css("border", "1px solid #d2d6de");
            }
        }
        /*date = new Date();
         var dia = date.getDate();
         
         if (parseInt($("#diadepago").val()) <= dia) {
         showAlert("El dia de pago no debe ser menor al dia actual", "error");
         $("#diadepago").css("border", "1px solid red");
         return;
         } else {
         $("#diadepago").css("border", "1px solid #d2d6de");
         }*/
        if (countErrors > 0) {
            showAlert("Los campos marcados en rojo son obligatorios,\n verifique que en un paso anterior los campos obligatorios esten llenos", "error");
        } else {
            var data = new FormData();
            var inputFile = document.getElementById("fotoz");
            var file = inputFile.files[0];
            if (file !== undefined) {
                data.append("foto", file);
            }
            data.append("nacimiento", $("#nacimiento").val());
            data.append("tipo_doc", $("#tipo_doc").val());
            data.append("documento", $("#Documento").val());
            data.append("nombres", $("#Nombres").val());
            data.append("apellidos", $("#Apellidos").val());
            data.append("genero", $("#genero").val());
            data.append("direccion", $("#direccion").val());
            data.append("telefonos", $("#telefonos").val());
            data.append("departamento", $("#departamento").val());
            data.append("ciudad", $("#ciudad").val());
            data.append("email", $("#email").val());
            data.append("correspondencia", $("#correspondencia").val());
            data.append("estadocivil", $("#estadocivil").val());
            data.append("lugarExpe", $("#lugarExpe").val());
            data.append("fechExpedicion", $("#fechExpedicion").val());
            data.append("nacionalidad", $("#nacionalidad").val());
            data.append("nacionalidad", $("#nacionalidad").val());
            data.append("diadepago", $("#diadepago").val());
            data.append("turno", $("#turno").val());
            $.ajax({
                type: 'POST',
                url: "Model/Afiliados/CreateAfiliates.php",
                data: data,
                dataType: 'json',
                contentType: false,
                processData: false,
                cache: false,
                success: function (response) {
                    if (response == "ok") {
                        setTimeout(redireccionarPagina('ListarAfiliados.php?mensaje=ok'), 5000);
                    } else {
                        showAlert("Ocurrio un error al crear el afiliado", "error");
                    }
                }
            });
        }


    });

    $(".updateAfiliados").click(function () {
        redireccionarPagina('ActualizarAfiliados.php?token=' + $(this).data("id"));
    });


    $(".updatePayment").click(function () {
        redireccionarPagina('ActualizarPagos.php?token=' + $(this).data("id") + "&Redirect=true");
    });


    $("#updateAfiliadosBtn").click(function () {
//        var d = new Date();
        var countErrors = 0;
        for (var item in todosloscampos) {
            if ($("#" + todosloscampos[item]).val() === ""
                    || $("#" + todosloscampos[item]).val() === "Seleccione") {
                countErrors++;
                $("#" + todosloscampos[item]).css("border", "1px solid red");
            } else {
                $("#" + todosloscampos[item]).css("border", "1px solid #d2d6de");
            }
        }
//        date = new Date();
//        var dia = date.getDate();
//
//        if (parseInt($("#diadepago").val()) <= dia) {
//            showAlert("El dia de pago no debe ser menor al dia actual", "error");
//            $("#diadepago").css("border", "1px solid red");
//            return;
//        } else {
//            $("#diadepago").css("border", "1px solid #d2d6de");
//        }

        if (countErrors > 0) {
            showAlert("Los campos marcados en rojo son obligatorios,\n verifique que en un paso anterior los campos obligatorios esten llenos", "error");
        } else {
//            if (parseInt($("#diadepago").val()) <= d.getDate()) {
//                showAlert("El dia de pago debe ser mayor al dia actual", "error");
//            } else {
            var data = new FormData();
            var inputFile = document.getElementById("fotoz");
            var file = inputFile.files[0];
            if (file !== undefined) {
                data.append("foto", file);
            }
            data.append("nacimiento", $("#nacimiento").val());
            data.append("tipo_doc", $("#tipo_doc").val());
            data.append("documento", $("#Documento").val());
            data.append("nombres", $("#Nombres").val());
            data.append("apellidos", $("#Apellidos").val());
            data.append("genero", $("#genero").val());
            data.append("direccion", $("#direccion").val());
            data.append("telefonos", $("#telefonos").val());
            data.append("departamento", $("#departamento").val());
            data.append("ciudad", $("#ciudad").val());
            data.append("email", $("#email").val());
            data.append("correspondencia", $("#correspondencia").val());
            data.append("estadocivil", $("#estadocivil").val());
            data.append("lugarExpe", $("#lugarExpe").val());
            data.append("fechExpedicion", $("#fechExpedicion").val());
            data.append("nacionalidad", $("#nacionalidad").val());
            data.append("id_afiliado", $("#id_afiliado").val());
            data.append("nacionalidad", $("#nacionalidad").val());
            data.append("turno", $("#turno").val());
            data.append("diadepago", $("#diadepago").val());
            $.ajax({
                type: 'POST',
                url: "Model/Afiliados/UpdateAfiliates.php",
                data: data,
                dataType: 'json',
                contentType: false,
                processData: false,
                cache: false,
                success: function (response) {
                    if (response == "ok") {
                        setTimeout(redireccionarPagina('ListarAfiliados.php?mensaje=updateok'), 5000);
                    } else {
                        showAlert("Ocurrio un error al crear el afiliado", "error");
                    }
                }
            });

//            }
        }

    });

    $("#closeModalwebcam").click(function () {
        $("#canvas").css("display", "none");
        $("#estado").text("");
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


    $(".capturePicture").click(function () {
        if ($("#Documento").val() !== "") {
            $("#cathPicture").trigger("click");
        } else {
            showAlert("Debes ingresar el nuemro de documento primero", "error");
        }

    });


    $(".moreinfo").click(function () {
        redireccionarPagina('profile.php?token=' + $(this).data("id"));
    });


    $("#backfromProfile").click(function () {
        redireccionarPagina('ListarAfiliados.php');
    });

    $("#backInicio").click(function () {
        if ($(this).data("view") === "asesor") {
            redireccionarPagina('HomeAsesor.php');
        } else {
            redireccionarPagina('HomeAdmin.php');
        }
    });

    $("#Inicio").click(function () {
        redireccionarPagina('HomeAdmin.php');
    });


    $("#deleteAfiliado").click(function () {
        var data = new FormData();
        data.append("id", $(this).data("id"));
        data.append("estado", $(this).data("estado"));
        var redirect = "ListarAfiliados.php?mensaje=deleteok";
        if ($(this).data("redirect") === "yes") {
            redirect = "profile.php?token=" + btoa($(this).data("id")) + "&mensaje=deleteok";
        } else {
            redirect = "ListarAfiliados.php?mensaje=deleteok";
        }

        $.ajax({
            type: 'POST',
            url: "Model/Afiliados/DeleteAfiliate.php",
            data: data,
            dataType: 'json',
            contentType: false,
            processData: false,
            cache: false,
            success: function (response) {
                if (response == "ok") {
                    setTimeout(redireccionarPagina(redirect), 5000);
                } else {
                    showAlert("Ocurrio un error al eliminar la el afiliado", "error");
                }
            }
        });
    });


    $("#destroyAfiliates").click(function () {
        var data = new FormData();
        data.append("id", $(this).data("id"));
        data.append("estado", $(this).data("estado"));



        $.ajax({
            type: 'POST',
            url: "Model/Afiliados/DestroyAfiliates.php",
            data: data,
            dataType: 'json',
            contentType: false,
            processData: false,
            cache: false,
            success: function (response) {
                if (response == "ok") {
                    setTimeout(redireccionarPagina("ListarAfiliados.php?mensaje=destroyok"), 5000);
                } else {
                    showAlert("Ocurrio un error al eliminar la el afiliado", "error");
                }
            }
        });
    });


    jQuery(".addVehiculo").click(function () {
        redireccionarPagina('CrearVehiculo.php?token=' + $(this).data("id"));
    });


    $("#CrearVehiculo").click(function () {
        var campos = ['R2'];
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
            showAlert("Los campos marcados en rojo son obligatorios, haga clic en el botón buscar..!", "error");
        } else {
            var data = new FormData();
            data.append("placa", $("#R2").val());
            data.append("id_afiliado", $("#id_afiliado").val());
            data.append("id_r", $("#id_r").val());
            $.ajax({
                type: 'POST',
                url: "Model/Afiliados/AddVehiculos.php",
                data: data,
                dataType: 'json',
                contentType: false,
                processData: false,
                cache: false,
                success: function (response) {
                    if (response == "ok") {
                        setTimeout(redireccionarPagina('ListarAfiliados.php?mensaje=addVehiculook'), 5000);
                    } else {
                        showAlert("Ocurrio un error al crear el afiliado", "error");
                    }
                }
            });
        }
    });


    $(".addPayment").click(function () {
        redireccionarPagina('RegistrarPagos.php?token=' + $(this).data("id") + "&Redirect=" + $(this).data("redirect"));
    });


    $("#RegistrarPago").click(function () {
        var campos = ['concepto', 'valor'];
        var countErrors = 0;
        for (var item in campos) {
            if ($("#" + campos[item]).val() === "") {
                countErrors++;
                $("#" + campos[item]).css("border", "1px solid red");
            } else {
                $("#" + campos[item]).css("border", "1px solid #d2d6de");
            }
        }

        if ($("#redirect").val() === "true") {
            redirectPay = 'ListadoDePagos.php?mensaje=addPayok';
        } else {
            redirectPay = 'ListarAfiliados.php?mensaje=addPayok';
        }


        if (countErrors > 0) {
            showAlert("Los campos marcados en rojo son obligatorios", "error");
        } else {
            var data = new FormData();
            data.append("concepto", $("#concepto").val());
            data.append("valor", $("#valor").val());
            data.append("descuento", $("#descuento").val());
            data.append("id_afiliado", $("#id_afiliado").val());
            $.ajax({
                type: 'POST',
                url: "Model/Afiliados/AddPayment.php",
                data: data,
                dataType: 'json',
                contentType: false,
                processData: false,
                cache: false,
                success: function (response) {
                    if (response == "ok") {
                        setTimeout(redireccionarPagina(redirectPay), 5000);
                    } else {
                        showAlert("Ocurrio un error al crear el afiliado", "error");
                    }
                }
            });
        }
    });



    $("#actualizarPago").click(function () {
        var campos = ['concepto', 'valor'];
        var countErrors = 0;
        for (var item in campos) {
            if ($("#" + campos[item]).val() === "") {
                countErrors++;
                $("#" + campos[item]).css("border", "1px solid red");
            } else {
                $("#" + campos[item]).css("border", "1px solid #d2d6de");
            }
        }

        if ($("#redirect").val() === "true") {
            redirectPay = 'ListadoDePagos.php?mensaje=updateok';
        } else {
            redirectPay = 'ListarAfiliados.php?mensaje=updateok';
        }


        if (countErrors > 0) {
            showAlert("Los campos marcados en rojo son obligatorios", "error");
        } else {
            var data = new FormData();
            data.append("concepto", $("#concepto").val());
            data.append("valor", $("#valor").val());
            data.append("descuento", $("#descuento").val());
            data.append("id_pago", $("#id_pago").val());
            $.ajax({
                type: 'POST',
                url: "Model/Afiliados/UpdatePayment.php",
                data: data,
                dataType: 'json',
                contentType: false,
                processData: false,
                cache: false,
                success: function (response) {
                    if (response == "ok") {
                        setTimeout(redireccionarPagina(redirectPay), 5000);
                    } else {
                        showAlert("Ocurrio un error al crear el afiliado", "error");
                    }
                }
            });
        }
    });



    $("#findAfiliate").click(function () {
//        if ($("#documentoFind").val() === "") {
//            $("#documentoFind").css("border", "1px solid red");
//            showAlert("El campo documento es requerido", "error");
//        } else {
        $("#documentoFind").css("border", "1px solid #d2d6de");
        $.ajax({
            type: 'POST',
            url: "Model/Afiliados/listAfiliados.php",
            data: {"documento": $("#documentoFind").val()},
            dataType: 'html',
            success: function (response) {
//                console.log(response);
                $("#listaAfiliados").html(response);
            }
        });
//        }
    });


    $("#findPayment").click(function () {
        if ($("#documentoFind2").val() === "") {
            $("#documentoFind2").css("border", "1px solid red");
            showAlert("El campo documento es requerido", "error");
        } else {
            $("#documentoFind2").css("border", "1px solid #d2d6de");
            $.ajax({
                type: 'POST',
                url: "Model/Afiliados/ListPagos.php",
                data: {"documento": $("#documentoFind2").val()},
                dataType: 'html',
                success: function (response) {
//                console.log(response);
                    $("#listaPagos").html(response);
                }
            });
        }
    });


    $("#findAfiliateCars").click(function () {
        if ($("#documentoFind2").val() === "") {
            $("#documentoFind2").css("border", "1px solid red");
            showAlert("El campo documento es requerido", "error");
        } else {
            $("#documentoFind2").css("border", "1px solid #d2d6de");
            $.ajax({
                type: 'POST',
                url: "Model/Admin/ListVehiculosAfiliado.php",
                data: {"documento": $("#documentoFind2").val()},
                dataType: 'html',
                success: function (response) {
//                console.log(response);
                    $("#listaVehiculos").html(response);
                }
            });
        }
    });



    $("#AddDocuments").click(function () {

        campos = ['Nom_Doc', 'fechInic', 'fechFin'];
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
            var token = $("#R").val();
            data.append("Nom_Doc", $("#Nom_Doc").val());
            data.append("fechInic", $("#fechInic").val());
            data.append("fechFin", $("#fechFin").val());
            data.append("R", token);
            $.ajax({
                type: 'POST',
                url: "Model/Admin/AddDocumentS.php",
                data: data,
                dataType: 'json',
                contentType: false,
                processData: false,
                cache: false,
                success: function (response) {
                    if (response == "ok") {
                        setTimeout(redireccionarPagina('AddDocuments.php?token=' + btoa(token) + '&mensaje=ok'), 5000);
                    } else {
                        showAlert("Ocurrio un error al agregar la informaciòn", "error");
                    }
                }
            });
        }
    });



    $("#R").blur(function () {

        if ($("#R").val() != "") {
            var data = new FormData();
            data.append("R", $("#R").val());
            $.ajax({
                type: 'POST',
                url: "Model/Admin/GetR.php",
                data: data,
                dataType: 'json',
                contentType: false,
                processData: false,
                cache: false,
                success: function (response) {
                    if (response != "Disponible") {
                        showAlert("El 'R' " + response, "error");
                        jQuery("#R").val("");
                    }
                }
            });
        }
    });


    $("#tipo").change(function () {
        if ($(this).val() !== "") {
            $("#R2").removeAttr("disabled");
        } else {
            $("#R2").attr("disabled", "true");
        }
    });


    $("#R2").blur(function () {

        if ($("#R2").val() != "") {
            var data = new FormData();
            data.append("R", $("#R2").val());
            data.append("tipo", $("#tipo").val());
            $.ajax({
                type: 'POST',
                url: "Model/Admin/GetR.php",
                data: data,
                dataType: 'json',
                contentType: false,
                processData: false,
                cache: false,
                success: function (response) {
                    if (response != "No Existe") {
                        showAlert("El 'R' ya existe", "error");
                        jQuery("#R2").val("");
                        jQuery("#CrearNewR").prop('disabled', true);
                    } else {
                        jQuery("#CrearNewR").prop('disabled', false);
                    }
                }
            });
        }
    });


    $("#buscarVehiculo").click(function () {
        if (jQuery("#dato").val() == "") {
            jQuery("#dato").css("border", "1px solid red");
            showAlert("Debes ingresar un valor", "error");
            return;
        }

        jQuery("#dato").css("border", "1px solid #d2d6de");

        $.ajax({
            type: 'POST',
            url: "Model/Admin/FindVehiculos.php",
            data: {"dato": $("#dato").val()},
            dataType: 'html',
            success: function (response) {
//                console.log(response);
                $("#respuesta").html(response);
            }
        });
    });




    $("#UpdateDocuments").click(function () {

        campos = ['Nom_Doc', 'fechInic', 'fechFin'];
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
            var token = $("#id_vehiculo").val();
            data.append("Nom_Doc", $("#Nom_Doc").val());
            data.append("fechInic", $("#fechInic").val());
            data.append("fechFin", $("#fechFin").val());
            data.append("id_documento", $("#id_documento").val());
            $.ajax({
                type: 'POST',
                url: "Model/Admin/UpdateDocuments.php",
                data: data,
                dataType: 'json',
                contentType: false,
                processData: false,
                cache: false,
                success: function (response) {
                    if (response == "ok") {
                        setTimeout(redireccionarPagina('VerInfoVehiculo.php?token=' + token + '&mensaje=updateok'), 5000);
                    } else {
                        showAlert("Ocurrio un error al agregar la informaciòn", "error");
                    }
                }
            });
        }
    });


//style : success,info,warn,error
    function showAlert(text, style) {
        $.notify(text, style);
    }


    function redireccionarPagina(pagina) {
        window.location = pagina;
    }

    $("#edit").click(function () {
        $("#u_nombres").css("border", "0.5px solid lightgray");
    });
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


    $('body').on('click', '#users_online section ul li div div p', function () {
//        console.log('todo bienz');
        var id = $(this).attr('id');
        $(this).removeClass('iniciar');
        var status = $(this).next().attr('class');
        var splitIds = id.split(':');
        var idVentana = Number(splitIds[1]);
        if ($('#ventana_' + idVentana).length == 0) {
            var nombre = $(this).text();
            addVentana(id, nombre, status);
            retorna_history(idVentana);
        } else {
            $(this).removeClass('iniciar');
        }
    });
    function retorna_history(id_conversacion) {
        $.ajax({
            type: 'POST',
            url: "Model/historico.php",
            data: {id_conversa: id_conversacion, online: userOnline},
            dataType: 'json',
            success: function (response) {
                $.each(response, function (i, msg) {
                    if ($('#ventana_' + msg.ventana_de).length > 0) {
                        if (userOnline == msg.id_de) {
                            $('#ventana_' + msg.ventana_de + ' .messages ul').append('<li id="' + msg.id + '" class="yo"><p>' + msg.mensaje + '</p></li>');
                        } else {
                            $('#ventana_' + msg.ventana_de + ' .messages ul').append('<li id="' + msg.id + '"><div class="imgSmall"><img src="' + msg.fotoUser + '" border="0" /></div><p class="remite">' + msg.mensaje + '</p></li>');
                        }
                    }
                });
                [].reverse.call($('#ventana_' + id_conversacion + ' .messages li').appendTo($('#ventana_' + id_conversacion + ' .messages ul')));
                var altura = $('.messages').offset().top * 8;
                $('#ventana_' + id_conversacion + ' .messages').animate({
                    scrollTop: altura}, '1100');
            }
        });
    }

    $('body').on('click', '.header_window', function () {
        var next = $(this).next();
        next.toggle(100);
    });
    $('body').on('click', '.cerrar', function () {
        var parent = $(this).parent().parent();
        var idParent = parent.attr('id');
        var splitParent = idParent.split('_');
        var idVentanaCerrada = Number(splitParent[1]);
        var recuento = Number($('.window').length) - 1;
        var indice = Number($('.cerrar').index(this));
        var ultimasAlFrente = recuento - indice;
        for (var i = 1; i <= ultimasAlFrente;
                i++
                ) {
            $('.window:eq(' + (indice + i) + ')').animate({left: "+=265"}, 200);
        }
        parent.remove();
        $('#users_online li#' + idVentanaCerrada + ' a').addClass('iniciar');
    });
    $('body').on('click', '.fapersonalizado', function () {
        var parent = $(this).parent().parent();
        var posicion = parent.position();
        var elemento = $(this);
        var ventana_ancho = $(window).width();
        var ventana_alto = $(window).height();
        var incluir = '<div class="dropdown-panel" >';
        incluir += '<div id="cn_flecha"><div class="flecha-up"></div></div>';
        incluir += '<div class="header">Información de Contacto<span class="close">X</span></div>';
        incluir += '<div class="body">';
        incluir += '<div class="notify_info" data-id="' + elemento.attr("id") + '">Ver perfil</div>'; //repetir                       
        incluir += '</div>';
        incluir += '<div class="footer-notfi">Spring-face</div>';
        incluir += '</div>';
        if (!$('.dropdown-panel').is(":visible")) {
            $('#cn').append(incluir);
            $('.dropdown-panel').offset({top: posicion.top + 50, left: posicion.right});
            $('.dropdown-panel').css("width", "230");
            $('.dropdown-panel').css("height", "210px");
            $('.dropdown-panel').animate({
                width: "toggle"
            });
        } else {
            $('.dropdown-panel').html("");
            $('.dropdown-panel').animate({
                width: "toggle"
            });
            $('.dropdown-panel').remove();
        }
    });
    $('body').on('click', '.close', function () {
        $('.dropdown-panel').html("");
        $('.dropdown-panel').animate({
            width: "toggle"
        });
        $('.dropdown-panel').remove();
    });
    $('body').on('click', '.notify_info', function () {
        var elemento = $(this);
        console.log(elemento.data('id'))
        var form = document.createElement('form');
        form.method = 'POST';
        form.action = "viewprofile.php";
        var input = document.createElement('input');
        input.type = "hidden";
        input.name = "id_perfil";
        input.value = elemento.data('id');
        form.appendChild(input);
        $('body').append(form);
        form.submit();
    });
//    verificar(0, 0, userOnline);
});

