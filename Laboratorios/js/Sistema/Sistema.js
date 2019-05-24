$(document).ready(function() {


   $("#ReporteLaboratorios").click(function() {

        var Pk_laboratorios = $('#Pk_laboratorios').val();
        var pk_clasematerial = $('#pk_clasematerial').val();
        
        if(Pk_laboratorios==""){           
            alertify.error("Seleccione una Opcion: Laboratorio");            
        }else if(pk_clasematerial==""){
            alertify.error("Seleccione una Opcion: Clase de Material");
        }else{
             param = "pk_clasematerial=" + pk_clasematerial;
             param += "&Pk_laboratorios=" + Pk_laboratorios;
             window.open('includes/ajax/Materiales/Reporte_General_Laboratorios.php?'+param);       
        }
        
        
        
        return false;
    });
    
    
    
    $("#Usuario_Modificar_Consulta").submit(function() {

        var str = $("#Usuario_Modificar_Consulta").serialize();
        //alert(str);
        $.ajax({
            url: pathUsuarios + 'Con_Usuario.php',
            type: 'post',
            data: str,
            success: function(data) {
                //alert(data);
                var validar = data.split("|");
                if (validar[0] != "2") {
                    $("#BuscarUsuarioModificar").slideUp();
                    $('#DatosUsuarioModificar').slideDown();
                    var resultados = data.split("|");
                    $("#Usuario_Modificar #Nombre").val(resultados[0]);
                    $("#Usuario_Modificar #Apellido_Paterno").val(resultados[1]);
                    $("#Usuario_Modificar #Apellido_Materno").val(resultados[2]);
                    $("#Usuario_Modificar #Fk_Empresa").val(resultados[3]);
                    $("#Usuario_Modificar #Correo").val(resultados[4]);
                    $("#Usuario_Modificar #Usuario").val(resultados[5]);
                    $("#Usuario_Modificar #Password").val(resultados[6]);
                    $("#Usuario_Modificar #PasswordRepite").val(resultados[6]);

                    $("#Usuario_Modificar #Password").attr('disabled', true);
                    $("#Usuario_Modificar #PasswordRepite").attr('disabled', true);

                    $("#Usuario_Modificar #Pk_Usuario_Login").val(resultados[9]);
                    $("#Usuario_Modificar #Status_User").val(resultados[10]);

                    var modulos = resultados[7];
                    var permisos = resultados[8];

                    cantidad_pesos = permisos.split('$').length - 1;
                    cantidad_pesos = cantidad_pesos + 2;

                    $.ajax({
                        data: str,
                        url: pathUsuarios + 'Con_UsuarioModulosModificar.php',
                        type: 'post',
                        success: function(data) {
                            $("#asigna-permisos-modificar").append(data);
                        }
                    });



                } else {
                    $("#mensaje_error").html(validar[1]);
                    mensaje_sistema_error();
                }
            }
        });

        return false;

    }); //fin del submit

    $("#verPermisos").click(function() {
        var str = $("#Usuario_Modificar_Consulta").serialize();
        $.ajax({
            url: pathUsuarios + 'Con_Usuario.php',
            type: 'post',
            data: str,
            success: function(data) {
//                alert("entree");
                $("#buscador").slideUp();
                $('#datos').slideDown();
                $("#verPermisos").slideUp();
                if (data != "") {
                    var resultados = data.split("|");

                    $("#Permisos-Usuario-Modificar").slideDown();

                    $(".elimina").click(function() {
                        var objFila = $(this).parents().get(1);
                        $(objFila).remove();
                        return false;
                    });



                }//fin
            }
        });



    });     //clic permisos

    $("#Agrega_Permiso_Modificar").click(function() {
//                              alert(cantidad_pesos);
        var Filas = '<tr id="Filas' + cantidad_pesos + '">';
        Filas = Filas + '<td><select name="Modulo[]" id="Modulo' + cantidad_pesos + '"></select></td>'
        Filas = Filas + '<td><a href="" class="elimina" id="EliminarPermiso' + cantidad_pesos + '" title= "Eliminar"><img src="img/iconos/delete.png"></a></td>';
        Filas = Filas + '</tr>';
        $("#asigna-permisos-modificar").append(Filas);

        $("#Modulo" + cantidad_pesos).load(pathUsuarios + "Con_ModuloCombo.php");

        $("#EliminarPermiso" + cantidad_pesos).click(function() {
            var currentId = $(this).attr('id');
            var element = currentId.split('o');
            var num = element[1];
            // alert(num);
            $("#Filas" + num).remove();
            return false;
        });



        cantidad_pesos++;
        return false;
    });
    $('#Si_Cambiar_Pass').click(function() {
        $("#Usuario_Modificar #Password").attr('disabled', false);
        $("#Usuario_Modificar #PasswordRepite").attr('disabled', false);
        $("#Usuario_Modificar #Password").val("");
        $("#Usuario_Modificar #PasswordRepite").val("");
        $("#Usuario_Modificar #banderita").val("1");
    });

    $('#No_Cambiar_Pass').click(function() {

        $("#Usuario_Modificar #Password").val("********************************");
        $("#Usuario_Modificar #PasswordRepite").val("********************************");
        $("#Usuario_Modificar #Password").attr('disabled', true);
        $("#Usuario_Modificar #PasswordRepite").attr('disabled', true);
        $("#Usuario_Modificar #banderita").val("2");
    });

    $("#Usuario_Modificar").submit(function() {
        var str = $("#Usuario_Modificar").serialize();
        $.ajax({
            url: pathUsuarios + 'Mod_Usuario.php',
            type: 'post',
            data: str,
            success: function(data) {

                if (data != "") {

                    var validar = data.split('|');
                    if (validar[0] == '1') {
                        $("#mensaje_done").html(validar[1]);
                        mensaje_sistema_done();

                    } else {
                        $("#mensaje_error").html(validar[1]);
                        mensaje_sistema_error();

                    }

                }
            }
        });
        return false;
    });


 $('#CerrarModalSalidas').click(function() {
            $('#EditSalidas').modal('hide');
            $('#CantidadSalida').val('');
            
    
    });


    
    
});