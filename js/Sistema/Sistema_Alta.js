$(document).ready(function() {

    /***** Ivan Mauricio Meneses Melo Granados *************/

//obtenemos el combo permisos
    $("#Modulo").change(function () {
        $("#Modulo option:selected").each(function () {
            elegido=$(this).val();
            $.ajax({
                url: pathSistema +'Usuario/Con_PermisoCombo.php',
                type: 'post',
                data: "llenarCombo=llenarCombo&Fk_Modulo="+elegido,
                success: function(data){
                    $("#comboPermisos").html(data);
                }
            }); //fin del ajax
        });
    });



//
//    // Altas de Usuarios
//    $("#Usuario_Alta_Sistema_Users").submit(function() {
//
//        var str = $("#Usuario_Alta_Sistema_Users").serialize();
//        $.ajax({
//            url: pathSistema + 'Usuario/Ins_Usuario.php',
//            type: 'post',
//            data: str,
//             beforeSend: function () {
//                $("#load").html("Procesando, espere por favor... <img src='img/0DB9CDC5A.gif' width='30' height='30'>");
//            },
//            success: function(data){
//                if(data!=""){
//                    var validar = data.split('|');
//                    if(validar[0]=='1'){
//                        $("#mensaje_done").html(validar[1])
//                        mensaje_guero_done();
//                        $("#load").hide();
//                    }else{
//                        $("#mensaje_error").html(validar[1])
//                        mensaje_guero_error();
//                         $("#load").hide();
//                    }
//
//                }
//            }
//        });
//        return false;
//    });
//

var contadorPermisos = 2;
    $("#Agrega_Permiso").click(function(){
        var Filas = '<tr id="Filas'+contadorPermisos+'">';
        Filas = Filas + '<td><select name="Modulo[]" id="Modulo'+contadorPermisos+'"></select></td>'
        Filas = Filas + '<td><div id="comboPermisos'+contadorPermisos+'"></div></td>'
        Filas = Filas + '<td><a href="" class="elimina" id="EliminarPermiso'+contadorPermisos+'" title= "Eliminar"><img src="assets/img/delete.png"></a></td>';
        Filas = Filas + '</tr>';
        $("#asigna-permisos").append(Filas);

        $("#Modulo"+contadorPermisos).load(pathSistema+"Usuario/Con_ModuloCombo.php");
        $("#Modulo2").change(function () {
            $("#Modulo2 option:selected").each(function () {
                elegido=$(this).val();
                $.ajax({
                    url: pathSistema +'Usuario/Con_PermisoCombo.php',
                    type: 'post',
                    data: "llenarCombo=llenarCombo&Fk_Modulo="+elegido,
                    success: function(data){
                        $("#comboPermisos2").html(data);
                    }
                }); //fin del ajax
            });
        });

        $("#Modulo3").change(function () {
        $("#Modulo3 option:selected").each(function () {
            elegido=$(this).val();
            $.ajax({
                url: pathSistema +'Usuario/Con_PermisoCombo.php',
                type: 'post',
                data: "llenarCombo=llenarCombo&Fk_Modulo="+elegido,
                success: function(data){
                    $("#comboPermisos3").html(data);
                }
            }); //fin del ajax
        });
    });

        $("#Modulo4").change(function () {
        $("#Modulo4 option:selected").each(function () {
            elegido=$(this).val();
            $.ajax({
                url: pathSistema +'Usuario/Con_PermisoCombo.php',
                type: 'post',
                data: "llenarCombo=llenarCombo&Fk_Modulo="+elegido,
                success: function(data){
                   $("#comboPermisos4").html(data);
                }
            }); //fin del ajax
        });
    });

        $("#Modulo5").change(function () {
        $("#Modulo5 option:selected").each(function () {
            elegido=$(this).val();
            $.ajax({
                url: pathSistema +'Usuario/Con_PermisoCombo.php',
                type: 'post',
                data: "llenarCombo=llenarCombo&Fk_Modulo="+elegido,
                success: function(data){
                    $("#comboPermisos5").html(data);
                }
            }); //fin del ajax
        });
    });

        $("#Modulo6").change(function () {
        $("#Modulo6 option:selected").each(function () {
            elegido=$(this).val();
            $.ajax({
                url: pathSistema +'Usuario/Con_PermisoCombo.php',
                type: 'post',
                data: "llenarCombo=llenarCombo&Fk_Modulo="+elegido,
                success: function(data){
                    $("#comboPermisos6").html(data);
                }
            }); //fin del ajax
        });
    });

        $("#Modulo7").change(function () {
        $("#Modulo7 option:selected").each(function () {
            elegido=$(this).val();
            $.ajax({
                url: pathSistema +'Usuario/Con_PermisoCombo.php',
                type: 'post',
                data: "llenarCombo=llenarCombo&Fk_Modulo="+elegido,
                success: function(data){
                    $("#comboPermisos7").html(data);
                }
            }); //fin del ajax
        });
    });

        $("#Modulo8").change(function () {
        $("#Modulo8 option:selected").each(function () {
            elegido=$(this).val();
            $.ajax({
                url: pathSistema +'Usuario/Con_PermisoCombo.php',
                type: 'post',
                data: "llenarCombo=llenarCombo&Fk_Modulo="+elegido,
                success: function(data){
                    $("#comboPermisos8").html(data);
                }
            }); //fin del ajax
        });
    });

        $("#Modulo9").change(function () {
        $("#Modulo9 option:selected").each(function () {
            elegido=$(this).val();
            $.ajax({
                url: pathSistema +'Usuario/Con_PermisoCombo.php',
                type: 'post',
                data: "llenarCombo=llenarCombo&Fk_Modulo="+elegido,
                success: function(data){
                    $("#comboPermisos9").html(data);
                }
            }); //fin del ajax
        });
    });

        $("#Modulo10").change(function () {
        $("#Modulo10 option:selected").each(function () {
           elegido=$(this).val();
           $.ajax({
                url: pathSistema +'Usuario/Con_PermisoCombo.php',
                type: 'post',
                data: "llenarCombo=llenarCombo&Fk_Modulo="+elegido,
                success: function(data){
                    $("#comboPermisos10").html(data);
                }
            }); //fin del ajax
        });
    });


        $("#Modulo11").change(function () {
        $("#Modulo11 option:selected").each(function () {
            elegido=$(this).val();
            $.ajax({
                url: pathSistema +'Usuario/Con_PermisoCombo.php',
                type: 'post',
                data: "llenarCombo=llenarCombo&Fk_Modulo="+elegido,
                success: function(data){
                    $("#comboPermisos11").html(data);
                }
            }); //fin del ajax
        });
    });

        $("#Modulo12").change(function () {
        $("#Modulo12 option:selected").each(function () {
            elegido=$(this).val();
            $.ajax({
                url: pathSistema +'Usuario/Con_PermisoCombo.php',
                type: 'post',
                data: "llenarCombo=llenarCombo&Fk_Modulo="+elegido,
                success: function(data){
                    $("#comboPermisos12").html(data);
                }
            }); //fin del ajax
        });
    });


        $("#Modulo13").change(function () {
        $("#Modulo13 option:selected").each(function () {
            elegido=$(this).val();
            $.ajax({
                url: pathSistema +'Usuario/Con_PermisoCombo.php',
                type: 'post',
                data: "llenarCombo=llenarCombo&Fk_Modulo="+elegido,
                success: function(data){
                    $("#comboPermisos13").html(data);
                }
            }); //fin del ajax
        });
    });

        $("#Modulo14").change(function () {
        $("#Modulo14 option:selected").each(function () {
            elegido=$(this).val();
            $.ajax({
                url: pathSistema +'Usuario/Con_PermisoCombo.php',
                type: 'post',
                data: "llenarCombo=llenarCombo&Fk_Modulo="+elegido,
                success: function(data){
                    $("#comboPermisos14").html(data);
                }
            }); //fin del ajax
        });
    });


        $("#Modulo15").change(function () {
        $("#Modulo15 option:selected").each(function () {
            elegido=$(this).val();
            $.ajax({
                url: pathSistema +'Usuario/Con_PermisoCombo.php',
                type: 'post',
                data: "llenarCombo=llenarCombo&Fk_Modulo="+elegido,
                success: function(data){
                    $("#comboPermisos15").html(data);
                }
            }); //fin del ajax
        });
    });

        $("#Modulo16").change(function () {
        $("#Modulo16 option:selected").each(function () {
            elegido=$(this).val();
            $.ajax({
                url: pathSistema +'Usuario/Con_PermisoCombo.php',
                type: 'post',
                data: "llenarCombo=llenarCombo&Fk_Modulo="+elegido,
                success: function(data){
                    $("#comboPermisos16").html(data);
                }
            }); //fin del ajax
        });
    });

        $("#Modulo17").change(function () {
        $("#Modulo17 option:selected").each(function () {
            elegido=$(this).val();
            $.ajax({
                url: pathSistema +'Usuario/Con_PermisoCombo.php',
                type: 'post',
                data: "llenarCombo=llenarCombo&Fk_Modulo="+elegido,
                success: function(data){
                    $("#comboPermisos17").html(data);
                }
            }); //fin del ajax
        });
    });

        $("#Modulo18").change(function () {
        $("#Modulo18 option:selected").each(function () {
            elegido=$(this).val();
            $.ajax({
                url: pathSistema +'Usuario/Con_PermisoCombo.php',
                type: 'post',
                data: "llenarCombo=llenarCombo&Fk_Modulo="+elegido,
                success: function(data){
                    $("#comboPermisos18").html(data);
                }
            }); //fin del ajax
        });
    });

        $("#Modulo19").change(function () {
        $("#Modulo19 option:selected").each(function () {
            elegido=$(this).val();
            $.ajax({
                url: pathSistema +'Usuario/Con_PermisoCombo.php',
                type: 'post',
                data: "llenarCombo=llenarCombo&Fk_Modulo="+elegido,
                success: function(data){
                    $("#comboPermisos19").html(data);
                }
            }); //fin del ajax
        });
    });

        $("#Modulo20").change(function () {
        $("#Modulo20 option:selected").each(function () {
            elegido=$(this).val();
            $.ajax({
                url: pathSistema +'Usuario/Con_PermisoCombo.php',
                type: 'post',
                data: "llenarCombo=llenarCombo&Fk_Modulo="+elegido,
                success: function(data){
                    $("#comboPermisos20").html(data);
                }
            }); //fin del ajax
        });

    });


    $("#Modulo21").change(function () {
        $("#Modulo21 option:selected").each(function () {
            elegido=$(this).val();
            $.ajax({
                url: pathSistema +'Usuario/Con_PermisoCombo.php',
                type: 'post',
                data: "llenarCombo=llenarCombo&Fk_Modulo="+elegido,
                success: function(data){
                    $("#comboPermisos21").html(data);
                }
            }); //fin del ajax
        });

    });

    $("#Modulo22").change(function () {
        $("#Modulo22 option:selected").each(function () {
            elegido=$(this).val();
            $.ajax({
                url: pathSistema +'Usuario/Con_PermisoCombo.php',
                type: 'post',
                data: "llenarCombo=llenarCombo&Fk_Modulo="+elegido,
                success: function(data){
                    $("#comboPermisos22").html(data);
                }
            }); //fin del ajax
        });

    });
    $("#Modulo23").change(function () {
        $("#Modulo23 option:selected").each(function () {
            elegido=$(this).val();
            $.ajax({
                url: pathSistema +'Usuario/Con_PermisoCombo.php',
                type: 'post',
                data: "llenarCombo=llenarCombo&Fk_Modulo="+elegido,
                success: function(data){
                    $("#comboPermisos23").html(data);
                }
            }); //fin del ajax
        });

    });

     $("#Modulo24").change(function () {
        $("#Modulo24 option:selected").each(function () {
            elegido=$(this).val();
            $.ajax({
                url: pathSistema +'Usuario/Con_PermisoCombo.php',
                type: 'post',
                data: "llenarCombo=llenarCombo&Fk_Modulo="+elegido,
                success: function(data){
                    $("#comboPermisos24").html(data);
                }
            }); //fin del ajax
        });

    });

     $("#Modulo25").change(function () {
        $("#Modulo25 option:selected").each(function () {
            elegido=$(this).val();
            $.ajax({
                url: pathSistema +'Usuario/Con_PermisoCombo.php',
                type: 'post',
                data: "llenarCombo=llenarCombo&Fk_Modulo="+elegido,
                success: function(data){
                    $("#comboPermisos25").html(data);
                }
            }); //fin del ajax
        });

    });

     $("#Modulo26").change(function () {
        $("#Modulo26 option:selected").each(function () {
            elegido=$(this).val();
            $.ajax({
                url: pathSistema +'Usuario/Con_PermisoCombo.php',
                type: 'post',
                data: "llenarCombo=llenarCombo&Fk_Modulo="+elegido,
                success: function(data){
                    $("#comboPermisos26").html(data);
                }
            }); //fin del ajax
        });

    });

     $("#Modulo27").change(function () {
        $("#Modulo27 option:selected").each(function () {
            elegido=$(this).val();
            $.ajax({
                url: pathSistema +'Usuario/Con_PermisoCombo.php',
                type: 'post',
                data: "llenarCombo=llenarCombo&Fk_Modulo="+elegido,
                success: function(data){
                    $("#comboPermisos27").html(data);
                }
            }); //fin del ajax
        });

    });

     $("#Modulo28").change(function () {
        $("#Modulo28 option:selected").each(function () {
            elegido=$(this).val();
            $.ajax({
                url: pathSistema +'Usuario/Con_PermisoCombo.php',
                type: 'post',
                data: "llenarCombo=llenarCombo&Fk_Modulo="+elegido,
                success: function(data){
                    $("#comboPermisos28").html(data);
                }
            }); //fin del ajax
        });

    });

     $("#Modulo29").change(function () {
        $("#Modulo29 option:selected").each(function () {
            elegido=$(this).val();
            $.ajax({
                url: pathSistema +'Usuario/Con_PermisoCombo.php',
                type: 'post',
                data: "llenarCombo=llenarCombo&Fk_Modulo="+elegido,
                success: function(data){
                    $("#comboPermisos29").html(data);
                }
            }); //fin del ajax
        });

    });

     $("#Modulo30").change(function () {
        $("#Modulo30 option:selected").each(function () {
            elegido=$(this).val();
            $.ajax({
                url: pathSistema +'Usuario/Con_PermisoCombo.php',
                type: 'post',
                data: "llenarCombo=llenarCombo&Fk_Modulo="+elegido,
                success: function(data){
                    $("#comboPermisos30").html(data);
                }
            }); //fin del ajax
        });

    });


                $("#Modulo31").change(function () {
                        $("#Modulo31 option:selected").each(function () {
                            elegido=$(this).val();
                            $.ajax({
                                url: pathSistema +'Usuario/Con_PermisoCombo.php',
                                type: 'post',
                                data: "llenarCombo=llenarCombo&Fk_Modulo="+elegido,
                                success: function(data){
                                    $("#comboPermisos31").html(data);
                                }
                            }); //fin del ajax
                        });

                    });

                $("#Modulo32").change(function () {
                        $("#Modulo32 option:selected").each(function () {
                            elegido=$(this).val();
                            $.ajax({
                                url: pathSistema +'Usuario/Con_PermisoCombo.php',
                                type: 'post',
                                data: "llenarCombo=llenarCombo&Fk_Modulo="+elegido,
                                success: function(data){
                                    $("#comboPermisos32").html(data);
                                }
                            }); //fin del ajax
                        });

                    });

                     $("#Modulo33").change(function () {
                        $("#Modulo33 option:selected").each(function () {
                            elegido=$(this).val();
                            $.ajax({
                                url: pathSistema +'Usuario/Con_PermisoCombo.php',
                                type: 'post',
                                data: "llenarCombo=llenarCombo&Fk_Modulo="+elegido,
                                success: function(data){
                                    $("#comboPermisos33").html(data);
                                }
                            }); //fin del ajax
                        });

                    });

                     $("#Modulo34").change(function () {
                        $("#Modulo34 option:selected").each(function () {
                            elegido=$(this).val();
                            $.ajax({
                                url: pathSistema +'Usuario/Con_PermisoCombo.php',
                                type: 'post',
                                data: "llenarCombo=llenarCombo&Fk_Modulo="+elegido,
                                success: function(data){
                                    $("#comboPermisos34").html(data);
                                }
                            }); //fin del ajax
                        });

                    });

                     $("#Modulo35").change(function () {
                        $("#Modulo35 option:selected").each(function () {
                            elegido=$(this).val();
                            $.ajax({
                                url: pathSistema +'Usuario/Con_PermisoCombo.php',
                                type: 'post',
                                data: "llenarCombo=llenarCombo&Fk_Modulo="+elegido,
                                success: function(data){
                                    $("#comboPermisos35").html(data);
                                }
                            }); //fin del ajax
                        });

                    });

                     $("#Modulo36").change(function () {
                        $("#Modulo36 option:selected").each(function () {
                            elegido=$(this).val();
                            $.ajax({
                                url: pathSistema +'Usuario/Con_PermisoCombo.php',
                                type: 'post',
                                data: "llenarCombo=llenarCombo&Fk_Modulo="+elegido,
                                success: function(data){
                                    $("#comboPermisos36").html(data);
                                }
                            }); //fin del ajax
                        });

                    });

                    $("#Modulo37").change(function () {
                        $("#Modulo37 option:selected").each(function () {
                            elegido=$(this).val();
                            $.ajax({
                                url: pathSistema +'Usuario/Con_PermisoCombo.php',
                                type: 'post',
                                data: "llenarCombo=llenarCombo&Fk_Modulo="+elegido,
                                success: function(data){
                                    $("#comboPermisos37").html(data);
                                }
                            }); //fin del ajax
                        });

                    });

                     $("#Modulo38").change(function () {
                        $("#Modulo38 option:selected").each(function () {
                            elegido=$(this).val();
                            $.ajax({
                                url: pathSistema +'Usuario/Con_PermisoCombo.php',
                                type: 'post',
                                data: "llenarCombo=llenarCombo&Fk_Modulo="+elegido,
                                success: function(data){
                                    $("#comboPermisos38").html(data);
                                }
                            }); //fin del ajax
                        });

                    });

                     $("#Modulo39").change(function () {
                        $("#Modulo39 option:selected").each(function () {
                            elegido=$(this).val();
                            $.ajax({
                                url: pathSistema +'Usuario/Con_PermisoCombo.php',
                                type: 'post',
                                data: "llenarCombo=llenarCombo&Fk_Modulo="+elegido,
                                success: function(data){
                                    $("#comboPermisos39").html(data);
                                }
                            }); //fin del ajax
                        });

                    });

                     $("#Modulo40").change(function () {
                        $("#Modulo40 option:selected").each(function () {
                            elegido=$(this).val();
                            $.ajax({
                                url: pathSistema +'Usuario/Con_PermisoCombo.php',
                                type: 'post',
                                data: "llenarCombo=llenarCombo&Fk_Modulo="+elegido,
                                success: function(data){
                                    $("#comboPermisos40").html(data);
                                }
                            }); //fin del ajax
                        });

                    });

                    $("#Modulo41").change(function () {
                        $("#Modulo41 option:selected").each(function () {
                            elegido=$(this).val();
                            $.ajax({
                                url: pathSistema +'Usuario/Con_PermisoCombo.php',
                                type: 'post',
                                data: "llenarCombo=llenarCombo&Fk_Modulo="+elegido,
                                success: function(data){
                                    $("#comboPermisos41").html(data);
                                }
                            }); //fin del ajax
                        });

                    });


                    $("#Modulo42").change(function () {
                        $("#Modulo42 option:selected").each(function () {
                            elegido=$(this).val();
                            $.ajax({
                                url: pathSistema +'Usuario/Con_PermisoCombo.php',
                                type: 'post',
                                data: "llenarCombo=llenarCombo&Fk_Modulo="+elegido,
                                success: function(data){
                                    $("#comboPermisos42").html(data);
                                }
                            }); //fin del ajax
                        });

                    });

                    $("#Modulo43").change(function () {
                        $("#Modulo43 option:selected").each(function () {
                            elegido=$(this).val();
                            $.ajax({
                                url: pathSistema +'Usuario/Con_PermisoCombo.php',
                                type: 'post',
                                data: "llenarCombo=llenarCombo&Fk_Modulo="+elegido,
                                success: function(data){
                                    $("#comboPermisos43").html(data);
                                }
                            }); //fin del ajax
                        });

                    });

                    $("#Modulo44").change(function () {
                        $("#Modulo44 option:selected").each(function () {
                            elegido=$(this).val();
                            $.ajax({
                                url: pathSistema +'Usuario/Con_PermisoCombo.php',
                                type: 'post',
                                data: "llenarCombo=llenarCombo&Fk_Modulo="+elegido,
                                success: function(data){
                                    $("#comboPermisos44").html(data);
                                }
                            }); //fin del ajax
                        });

                    });

                    $("#Modulo45").change(function () {
                        $("#Modulo45 option:selected").each(function () {
                            elegido=$(this).val();
                            $.ajax({
                                url: pathSistema +'Usuario/Con_PermisoCombo.php',
                                type: 'post',
                                data: "llenarCombo=llenarCombo&Fk_Modulo="+elegido,
                                success: function(data){
                                    $("#comboPermisos45").html(data);
                                }
                            }); //fin del ajax
                        });

                    });


                    $("#Modulo46").change(function () {
                        $("#Modulo46 option:selected").each(function () {
                            elegido=$(this).val();
                            $.ajax({
                                url: pathSistema +'Usuario/Con_PermisoCombo.php',
                                type: 'post',
                                data: "llenarCombo=llenarCombo&Fk_Modulo="+elegido,
                                success: function(data){
                                    $("#comboPermisos46").html(data);
                                }
                            }); //fin del ajax
                        });

                    });

                    $("#Modulo47").change(function () {
                        $("#Modulo47 option:selected").each(function () {
                            elegido=$(this).val();
                            $.ajax({
                                url: pathSistema +'Usuario/Con_PermisoCombo.php',
                                type: 'post',
                                data: "llenarCombo=llenarCombo&Fk_Modulo="+elegido,
                                success: function(data){
                                    $("#comboPermisos47").html(data);
                                }
                            }); //fin del ajax
                        });

                    });

                    $("#Modulo48").change(function () {
                        $("#Modulo48 option:selected").each(function () {
                            elegido=$(this).val();
                            $.ajax({
                                url: pathSistema +'Usuario/Con_PermisoCombo.php',
                                type: 'post',
                                data: "llenarCombo=llenarCombo&Fk_Modulo="+elegido,
                                success: function(data){
                                    $("#comboPermisos48").html(data);
                                }
                            }); //fin del ajax
                        });

                    });


                    $("#Modulo49").change(function () {
                        $("#Modulo49 option:selected").each(function () {
                            elegido=$(this).val();
                            $.ajax({
                                url: pathSistema +'Usuario/Con_PermisoCombo.php',
                                type: 'post',
                                data: "llenarCombo=llenarCombo&Fk_Modulo="+elegido,
                                success: function(data){
                                    $("#comboPermisos49").html(data);
                                }
                            }); //fin del ajax
                        });

                    });

                    $("#Modulo50").change(function () {
                        $("#Modulo50 option:selected").each(function () {
                            elegido=$(this).val();
                            $.ajax({
                                url: pathSistema +'Usuario/Con_PermisoCombo.php',
                                type: 'post',
                                data: "llenarCombo=llenarCombo&Fk_Modulo="+elegido,
                                success: function(data){
                                    $("#comboPermisos50").html(data);
                                }
                            }); //fin del ajax
                        });

                    });



       $("#EliminarPermiso"+contadorPermisos).click(function(){
            var currentId = $(this).attr('id');
            var element = currentId.split('o');
            var num = element[1];
            // alert(num);
            $("#Filas"+num).remove();
            return false;
        });


      contadorPermisos++;
        return false;
    });















       //usuarios
 $("#Usuario_Alta").submit(function() {
     var str = $("#Usuario_Alta").serialize();
        $.ajax({
            url: pathSistema +'Usuario/Ins_Usuario.php',
            type: 'post',
            data: str,
            beforeSend: function (){
                       $("#botonera").hide();
                       $("#loading-data").html("Procesando, espere por favor... <img src='img/ajax-loaders/ajax-loader-1.gif'>");
                    },
            success: function(data){
                if(data!=""){
                    var validar = data.split('|');
                    if(validar[0]=='1'){
                        $("#botonera").show();
                        $("#loading-data").hide();
                          alertify.alert(validar[1], function (e) {
                            if (e) {
                                // user clicked "ok"
                                window.location.reload();
                            }
                        });

                    //$(”#Formulario1″)[0].reset();
                    }else{
                        $("#botonera").show();
                        $("#loading-data").hide();

                        alertify.error(validar[1]);

                    }

                }
            }
        });
        return false;
    });



$("#frm_TrabajadorModificar").submit(function() {
     var str = $("#frm_TrabajadorModificar").serialize();
        $.ajax({
            url: pathSistema +'Usuario/Ins_Usuario.php',
            type: 'post',
            data: str,
            beforeSend: function (){
                       $("#botonera").hide();
                       $("#loading-data").html("Procesando, espere por favor... <img src='assets/img/ajax-loaders/ajax-loader-1.gif'>");
                    },
            success: function(data){
                if(data!=""){
                    var validar = data.split('|');
                   if(validar[0]=='1'){
                        $("#botonera").show();
                        $("#loading-data").hide();
                          alertify.alert(validar[1], function (e) {
                            if (e) {
                                // user clicked "ok"
                                window.location.reload();
                            }
                        });

                    //$(”#Formulario1″)[0].reset();
                    }else{
                        $("#botonera").show();
                        $("#loading-data").hide();

                        alertify.error(validar[1]);

                    }

                }
            }
        });
        return false;
    });



$("#f_datosinstitucion").submit(function() {
     var str = $("#f_datosinstitucion").serialize();
        $.ajax({
            url: pathDatosInstitucion+'Ins_DatosInstitucion.php',
            type: 'post',
            data: str,
            beforeSend: function (){
                       $("#botonera").hide();
                       $("#loading-data").html("Procesando, espere por favor... <img src='assets/img/ajax-loaders/ajax-loader-1.gif'>");
                    },
            success: function(data){
                if(data!=""){
                    var validar = data.split('|');
                   if(validar[0]=='1'){
                        $("#botonera").show();
                        $("#loading-data").hide();
                          alertify.alert(validar[1], function (e) {
                            if (e) {
                                // user clicked "ok"
                                window.location.reload();
                            }
                        });

                    //$(”#Formulario1″)[0].reset();
                    }else{
                        $("#botonera").show();
                        $("#loading-data").hide();

                        alertify.error(validar[1]);

                    }

                }
            }
        });
        return false;
    });



$("#f_altageneraciones").submit(function() {
     var str = $("#f_altageneraciones").serialize();

     var MesInicio = $("#fk_iniciomes option:selected").text();
     var AnioInicio = $("#fk_inicioanios option:selected").text();
     var MesFIn = $("#fk_finmeses option:selected").text();
     var AnioFin = $("#fk_finanios option:selected").text();
     var fk_tipo = $("#fk_tipo option:selected").text();


     if(MesInicio=="No Aplica" && MesFIn=="No Aplica"){

             var Descripcion = AnioInicio + " - " + AnioFin +" "+ fk_tipo;

     }else if(fk_tipo=="No Aplica"){
             var Descripcion = MesInicio +" "+ AnioInicio + " - " + MesFIn +" "+ AnioFin;
     }




        $.ajax({
            url: pathGeneraciones+'Ins_Generaciones.php',
            type: 'post',
            data: str + "&Descripcion=" + Descripcion,
            beforeSend: function (){
                       $("#botonera").hide();
                       $("#loading-data").html("Procesando, espere por favor... <img src='assets/img/ajax-loaders/ajax-loader-1.gif'>");
                    },
            success: function(data){
                if(data!=""){
                    var validar = data.split('|');
                   if(validar[0]=='1'){
                        $("#botonera").show();
                        $("#loading-data").hide();
                          alertify.alert(validar[1], function (e) {
                            if (e) {
                                // user clicked "ok"
                                window.location.reload();
                            }
                        });

                    //$(”#Formulario1″)[0].reset();
                    }else{
                        $("#botonera").show();
                        $("#loading-data").hide();

                        alertify.error(validar[1]);

                    }

                }
            }
        });
        return false;
    });











$("#f_datosSinodales").submit(function() {


         var arreglo = [];
        $('[id^=multi-select]').each(function(){
            arreglo.push($(this).val());
        });


     var str = $("#f_datosSinodales").serialize();
        $.ajax({
            url: pathSinodales +'Ins_Sinodales.php',
            type: 'post',
            data: str + "&Carreras="+arreglo,
            beforeSend: function (){
                       $("#botonera").hide();
                       $("#loading-data").html("Procesando, espere por favor... <img src='assets/img/ajax-loaders/ajax-loader-1.gif'>");
                    },
            success: function(data){
                if(data!=""){
                    var validar = data.split('|');
                   if(validar[0]=='1'){
                        $("#botonera").show();
                        $("#loading-data").hide();
                          alertify.alert(validar[1], function (e) {
                            if (e) {
                                // user clicked "ok"
                                window.location.reload();
                            }
                        });

                    //$(”#Formulario1″)[0].reset();
                    }else{
                        $("#botonera").show();
                        $("#loading-data").hide();

                        alertify.error(validar[1]);

                    }

                }
            }
        });
        return false;
    });








//alta alumnos



$("#f_datosalumnos").submit(function() {

     var generacionSecre = $("#fk_generacion option:selected").text();

     var str = $("#f_datosalumnos").serialize();
        $.ajax({
            url: pathAlumnos +'Ins_Alumnos.php',
            type: 'post',
            data: str + "&generacionSecre="+generacionSecre,
            beforeSend: function (){
                       $("#botonera").hide();
                       $("#loading-data").html("Procesando, espere por favor... <img src='assets/img/ajax-loaders/ajax-loader-1.gif'>");
                    },
            success: function(data){
                if(data!=""){
                    var validar = data.split('|');
                   if(validar[0]=='1'){
                        $("#botonera").show();
                        $("#loading-data").hide();
                          alertify.alert(validar[1], function (e) {
                            if (e) {
                                // user clicked "ok"
                                window.location.reload();
                            }
                        });

                    //$(”#Formulario1″)[0].reset();
                    }else{
                        $("#botonera").show();
                        $("#loading-data").hide();

                        alertify.error(validar[1]);

                    }

                }
            }
        });
        return false;
    });




//alta del alumno para examen institucional
$("#frm_AltaExamenInstitucional").submit(function() {

     var str = $("#frm_AltaExamenInstitucional").serialize();
     var Pk_ExamenInstitucional = $("#frm_AltaExamenInstitucional #Pk_ExamenInstitucional").val();

     if(Pk_ExamenInstitucional==""){

         $.ajax({
            url: pathExamenInstitucional +'Ins_ExamenInsitucional.php',
            type: 'post',
            data: str,
            beforeSend: function (){
                       $("#botonera").hide();
                       $("#loading-data").html("Procesando, espere por favor... <img src='assets/img/ajax-loaders/ajax-loader-1.gif'>");
                    },
            success: function(data){
                if(data!=""){
                    var validar = data.split('|');
                   if(validar[0]=='1'){
                        $("#botonera").show();
                        $("#loading-data").hide();
                          alertify.alert(validar[1], function (e) {
                            if (e) {
                                // user clicked "ok"
                                window.location.reload();
                            }
                        });

                    //$(”#Formulario1″)[0].reset();
                    }else{
                        $("#botonera").show();
                        $("#loading-data").hide();

                        alertify.error(validar[1]);

                    }

                }
            }
        });

     }else{  //modificamos si ya existe


                $.ajax({
                   url: pathExamenInstitucional +'Mod_ExamenInstitucional.php',
                   type: 'post',
                   data: str,
                   beforeSend: function (){
                              $("#botonera").hide();
                              $("#loading-data").html("Procesando, espere por favor... <img src='assets/img/ajax-loaders/ajax-loader-1.gif'>");
                           },
                   success: function(data){
                       if(data!=""){
                           var validar = data.split('|');
                          if(validar[0]=='1'){
                               $("#botonera").show();
                               $("#loading-data").hide();
                                 alertify.alert(validar[1], function (e) {
                                   if (e) {
                                       // user clicked "ok"
                                       window.location.reload();
                                   }
                               });

                           //$(”#Formulario1″)[0].reset();
                           }else{
                               $("#botonera").show();
                               $("#loading-data").hide();

                               alertify.error(validar[1]);

                           }

                       }
                   }
               });

     }



        return false;
    });









//aqui voy
//alta del alumno toma de protesta
$("#frm_AltaTomaProtesta").submit(function() {

     var str = $("#frm_AltaTomaProtesta").serialize();
     var pk_tramites = $("#frm_AltaTomaProtesta #pk_tramites").val();
     if(pk_tramites==""){

         $.ajax({
            url: pathTomaProtesta +'Ins_TomaProtesta.php',
            type: 'post',
            data: str,
            beforeSend: function (){
                       $("#botonera").hide();
                       $("#loading-data").html("Procesando, espere por favor... <img src='assets/img/ajax-loaders/ajax-loader-1.gif'>");
                    },
            success: function(data){
                //console.log(str);
                //console.log(data);
                if(data!=""){
                    var validar = data.split('|');
                   if(validar[0]=='1'){
                        $("#botonera").show();
                        $("#loading-data").hide();
                          alertify.alert(validar[1], function (e) {
                            if (e) {
                                // user clicked "ok"
                                window.location.reload();
                            }
                        });

                    //$(”#Formulario1″)[0].reset();
                    }else{
                        $("#botonera").show();
                        $("#loading-data").hide();

                        alertify.error(validar[1]);

                    }

                }
            }
        });

     }else{  //modificamos si ya existe


                $.ajax({
                   url: pathTomaProtesta +'Mod_TomaProtesta.php',
                   type: 'post',
                   data: str,
                   beforeSend: function (){
                              $("#botonera").hide();
                              $("#loading-data").html("Procesando, espere por favor... <img src='assets/img/ajax-loaders/ajax-loader-1.gif'>");
                           },
                   success: function(data){
                        //console.log(data);

                       if(data!=""){
                           var validar = data.split('|');
                          if(validar[0]=='1'){
                               $("#botonera").show();
                               $("#loading-data").hide();
                                 alertify.alert(validar[1], function (e) {
                                   if (e) {
                                       // user clicked "ok"
                                       window.location.reload();
                                   }
                               });

                           //$(”#Formulario1″)[0].reset();
                           }else{
                               $("#botonera").show();
                               $("#loading-data").hide();

                               alertify.error(validar[1]);

                           }

                       }
                   }
               });

     }



        return false;
    });









//aqui voy
//alta del alumno toma de protesta
$("#frm_SecretariaEducacion").submit(function() {

     var str = $("#frm_SecretariaEducacion").serialize();
     var pk_tramites = $("#frm_SecretariaEducacion #pk_tramites").val();

        $.ajax({
           url: pathSecretariaEducacion +'Mod_SecretariaEducacion.php',
           type: 'post',
           data: str,
           beforeSend: function (){
                      $("#botonera").hide();
                      $("#loading-data").html("Procesando, espere por favor... <img src='assets/img/ajax-loaders/ajax-loader-1.gif'>");
                   },
           success: function(data){
               if(data!=""){
                   var validar = data.split('|');
                  if(validar[0]=='1'){
                       $("#botonera").show();
                       $("#loading-data").hide();
                         alertify.alert(validar[1], function (e) {
                           if (e) {
                               // user clicked "ok"
                               window.location.reload();
                           }
                       });

                   //$(”#Formulario1″)[0].reset();
                   }else{
                       $("#botonera").show();
                       $("#loading-data").hide();

                       alertify.error(validar[1]);

                   }

               }
           }
       });





        return false;
    });










//aqui voy
//alta del alumno toma de protesta
$("#AltaFoliosExamenInstitucional").submit(function() {

     var str = $("#AltaFoliosExamenInstitucional").serialize();
     var pk_tramites = $("#AltaFoliosExamenInstitucional #pk_tramites").val();

        $.ajax({
           url: pathAsignarFolios +'Ins_DatosFoliosExamen.php',
           type: 'post',
           data: str,
           beforeSend: function (){
                      $("#botonera").hide();
                      $("#loading-data").html("Procesando, espere por favor... <img src='assets/img/ajax-loaders/ajax-loader-1.gif'>");
                   },
           success: function(data){
               if(data!=""){
                   var validar = data.split('|');
                  if(validar[0]=='1'){
                       $("#botonera").show();
                       $("#loading-data").hide();
                         alertify.alert(validar[1], function (e) {
                           if (e) {
                               // user clicked "ok"
                               window.location.reload();
                           }
                       });

                   //$(”#Formulario1″)[0].reset();
                   }else{
                       $("#botonera").show();
                       $("#loading-data").hide();

                       alertify.error(validar[1]);

                   }

               }
           }
       });





        return false;
    });




//captura de resultados del examen institucionak
//DIRECTORES
$("#AltaResultadosExamenInst").submit(function() {

     var str = $("#AltaResultadosExamenInst").serialize();
 //alert(str);
        $.ajax({
           url: pathCapturarResultados +'Ins_CapturaExamenRes.php',
           type: 'post',
           data: str,
           beforeSend: function (){
                      $("#botonera").hide();
                      $("#loading-data").html("Procesando, espere por favor... <img src='assets/img/ajax-loaders/ajax-loader-1.gif'>");
                   },
           success: function(data){
               if(data!=""){
                   var validar = data.split('|');
                  if(validar[0]=='1'){
                       $("#botonera").show();
                       $("#loading-data").hide();
                         alertify.alert(validar[1], function (e) {
                           if (e) {
                               // user clicked "ok"
                               window.location.reload();
                           }
                       });

                   //$(”#Formulario1″)[0].reset();
                   }else{
                       $("#botonera").show();
                       $("#loading-data").hide();

                       alertify.error(validar[1]);

                   }

               }
           }
       });

       return false;
});





});





function AltaExamenInstitucional(pk_alumno){

      $.ajax({
        url: pathExamenInstitucional + 'Con_ExamenInstitucional.php',
        type: 'post',
        data: 'consultar=consultar&pk_alumno=' + pk_alumno,
        dataType: 'json',
        success: function(data) {

            if (data.error == 'ok') {
                 $('#ListaConsulta').hide();
                 $('#FormularioEditarAlumno').show();
                $('#frm_AltaExamenInstitucional #pk_alumno').val(data.pk_alumno);
                $('#frm_AltaExamenInstitucional #matricula').val(data.matricula);
                $('#frm_AltaExamenInstitucional #matricula_desc').val(data.matricula);

                $('#frm_AltaExamenInstitucional #nombre').val(data.nombre);
                $('#frm_AltaExamenInstitucional #apaterno').val(data.apaterno);
                $('#frm_AltaExamenInstitucional #amaterno').val(data.amaterno);
                $('#frm_AltaExamenInstitucional #fk_carreras').val(data.fk_carreras);

                $('#frm_AltaExamenInstitucional #fechaaplicacion').val(data.fechaaplicacion);
                $('#frm_AltaExamenInstitucional #timepicker1').val(data.hora);

                if(data.ActaOriginal=='1'){
                    $("#ActaOriginal").prop("checked", true);
                }else{
                    $("#ActaOriginal").prop("checked", false);
                }

                if(data.ActaCopia=='1'){
                    $("#ActaCopia").prop("checked", true);
                }else{
                    $("#ActaCopia").prop("checked", false);
                }

                if(data.cbOriginal=='1'){
                    $("#cbOriginal").prop("checked", true);
                }else{
                    $("#cbOriginal").prop("checked", false);
                }

                if(data.cbCopia=='1'){
                    $("#cbCopia").prop("checked", true);
                }else{
                    $("#cbCopia").prop("checked", false);
                }

                if(data.clicOriginal=='1'){
                    $("#clicOriginal").prop("checked", true);
                }else{
                    $("#clicOriginal").prop("checked", false);
                }

                 if(data.clicCopia=='1'){
                    $("#clicCopia").prop("checked", true);
                }else{
                    $("#clicCopia").prop("checked", false);
                }


                if(data.curpOriginal=='1'){
                    $("#curpOriginal").prop("checked", true);
                }else{
                    $("#curpOriginal").prop("checked", false);
                }

                 if(data.curpCopia=='1'){
                    $("#curpCopia").prop("checked", true);
                }else{
                    $("#curpCopia").prop("checked", false);
                }


                if(data.consservicioOriginal=='1'){
                    $("#consservicioOriginal").prop("checked", true);
                }else{
                    $("#consservicioOriginal").prop("checked", false);
                }

                 if(data.consservicioCopia=='1'){
                    $("#consservicioCopia").prop("checked", true);
                }else{
                    $("#consservicioCopia").prop("checked", false);
                }


                if(data.reciboOriginal=='1'){
                    $("#reciboOriginal").prop("checked", true);
                }else{
                    $("#reciboOriginal").prop("checked", false);
                }

                 if(data.reciboCopia=='1'){
                    $("#reciboCopia").prop("checked", true);
                }else{
                    $("#reciboCopia").prop("checked", false);
                }




                 if(data.triniti=='1'){
                    $("#triniti").prop("checked", true);
                }else{
                    $("#triniti").prop("checked", false);
                }

                 if(data.trinitiCopia=='1'){
                    $("#trinitiCopia").prop("checked", true);
                }else{
                    $("#trinitiCopia").prop("checked", false);
                }



                $('#frm_AltaExamenInstitucional #ObservacionesDoc').val(data.ObservacionesDoc);
                $('#frm_AltaExamenInstitucional #recibofolio').val(data.recibofolio);
                $('#frm_AltaExamenInstitucional #Pk_ExamenInstitucional').val(data.Pk_ExamenInstitucional);

            }
        }
    });

}





function AltaTomaProtesta(pk_alumno){

      $.ajax({
        url: pathTomaProtesta + 'Con_TomaProtesta.php',
        type: 'post',
        data: 'consultar=consultar&pk_alumno=' + pk_alumno,
        dataType: 'json',
        success: function(data) {
            (data.curp)!='' ? active=true : active=false;
            if (data.error == 'ok') {
                 $('#ListaConsulta').hide();
                 $('#FormularioEditarAlumno').show();
                $('#frm_AltaTomaProtesta #pk_alumno').val(data.pk_alumno);
                $('#frm_AltaTomaProtesta #matricula').val(data.matricula);
                $('#frm_AltaTomaProtesta #curp').val(data.curp).attr('disabled', active);
                $('#frm_AltaTomaProtesta #matricula_desc').val(data.matricula);

                $('#frm_AltaTomaProtesta #nombre').val(data.nombre);
                $('#frm_AltaTomaProtesta #apaterno').val(data.apaterno);
                $('#frm_AltaTomaProtesta #amaterno').val(data.amaterno);
                $('#frm_AltaTomaProtesta #fk_carreras').val(data.fk_carreras);

                $('#frm_AltaTomaProtesta #f_inicio_car').val(data.f_inicio_car);
                $('#frm_AltaTomaProtesta #f_fin_car').val(data.f_fin_car);
                $('#frm_AltaTomaProtesta #institucionProcedencia').val(data.institucionProcedencia);
                $('#frm_AltaTomaProtesta #f_inicio_antecedente').val(data.f_inicio_antecedente);
                $('#frm_AltaTomaProtesta #f_fin_antecedente').val(data.f_fin_antecedente);
                $('#frm_AltaTomaProtesta #noCedula').val(data.noCedula);
                $('#frm_AltaTomaProtesta #entidad_federativa').val(data.entidad_federativa);
                $('#frm_AltaTomaProtesta #nivel_escolar').val(data.nivel_escolar);



                //datos listos
                $('#frm_AltaTomaProtesta #pk_tramites').val(data.pk_tramites);
                $('#frm_AltaTomaProtesta #FechaTomaProtesta').val(data.FechaTomaProtesta);
                $('#frm_AltaTomaProtesta #hora').val(data.horaTomaProtesta);
                $('#frm_AltaTomaProtesta #salon').val(data.salon);
                $('#frm_AltaTomaProtesta #fk_titulacion').val(data.fk_titulacion);
                $('#frm_AltaTomaProtesta #nombreTesis').val(data.nombreTesis);
                $('#frm_AltaTomaProtesta #Fk_Duracion').val(data.Fk_Duracion);

                $("#frm_AltaTomaProtesta #presidente").select2("val", data.presidente);
                $("#frm_AltaTomaProtesta #secretario").select2("val", data.secretario);
                $("#frm_AltaTomaProtesta #vocal").select2("val", data.vocal);
                $("#frm_AltaTomaProtesta #suplente").select2("val", data.suplente);


                $('#frm_AltaTomaProtesta #observacion').val(data.observacion);




            }
        }
    });

}





function AltaSecretariaEducacion(pk_alumno){

      $.ajax({
        url: pathSecretariaEducacion + 'Con_SecretariaEducacion.php',
        type: 'post',
        data: 'consultar=consultar&pk_alumno=' + pk_alumno,
        dataType: 'json',
        success: function(data) {

            if (data.error == 'ok') {
                 $('#ListaConsulta').hide();
                 $('#FormularioEditarAlumno').show();
                $('#frm_SecretariaEducacion #pk_alumno').val(data.pk_alumno);
                $('#frm_SecretariaEducacion #matricula').val(data.matricula);
                $('#frm_SecretariaEducacion #matricula_desc').val(data.matricula);

                $('#frm_SecretariaEducacion #nombre').val(data.nombre);
                $('#frm_SecretariaEducacion #apaterno').val(data.apaterno);
                $('#frm_SecretariaEducacion #amaterno').val(data.amaterno);
                $('#frm_SecretariaEducacion #fk_carreras').val(data.fk_carreras);

                $('#frm_SecretariaEducacion #planEstudios').val(data.planEstudios);
                $('#frm_SecretariaEducacion #promedio').val(data.promedio);
                $('#frm_SecretariaEducacion #letraPromedio').val(data.letraPromedio);
                $('#frm_SecretariaEducacion #curp').val(data.curp);

                 $('#frm_SecretariaEducacion #generacionSecre').val(data.generacionSecre);
                 $('#frm_SecretariaEducacion #fk_generacion').val(data.fk_generacion);



                //datos listos
                $('#frm_SecretariaEducacion #pk_tramites').val(data.pk_tramites);
                $('#frm_SecretariaEducacion #FechaTomaProtesta').val(data.FechaTomaProtesta);
                $('#frm_SecretariaEducacion #hora').val(data.horaTomaProtesta);
                $('#frm_SecretariaEducacion #salon').val(data.salon);
                $('#frm_SecretariaEducacion #fk_titulacion').val(data.fk_titulacion);
                $('#frm_SecretariaEducacion #nombreTesis').val(data.nombreTesis);
                $('#frm_SecretariaEducacion #Fk_Duracion').val(data.Fk_Duracion);

                $("#frm_SecretariaEducacion #presidente").select2("val", data.presidente);
                $("#frm_SecretariaEducacion #secretario").select2("val", data.secretario);
                $("#frm_SecretariaEducacion #vocal").select2("val", data.vocal);
                $("#frm_SecretariaEducacion #suplente").select2("val", data.suplente);


                $('#frm_SecretariaEducacion #observacion').val(data.observacion);

                //ultimos datos
               $('#frm_SecretariaEducacion #FechaSolicitud').val(data.FechaSolicitud);
               $('#frm_SecretariaEducacion #FechaExamen').val(data.FechaExamen);
               $('#frm_SecretariaEducacion #NumeroAutorizacion').val(data.NumeroAutorizacion);
               $('#frm_SecretariaEducacion #FolioActa').val(data.FolioActa);
               $('#frm_SecretariaEducacion #noActaExamen').val(data.noActaExamen);
               $('#frm_SecretariaEducacion #TipoRevoe').val(data.TipoRevoe);
               $('#frm_SecretariaEducacion #ExamenExtraOrdinario').val(data.ExamenExtraOrdinario);

            }
        }
    });

}


