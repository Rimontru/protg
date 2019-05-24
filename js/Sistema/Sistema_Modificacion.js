$(document).ready(function() {

    //egresados
    $("#f_ReporteEgresadosTitulacion").submit(function() {
      
        return false;
    });

     //*********************  modulo de usuarios     ********************** //
    //*********************          Melo           ********************** //
    $("#Usuario_Modificar_Consulta").submit(function() {
 	
        var str = $("#Usuario_Modificar_Consulta").serialize();       
       var Usuario = $("#Usuario").val();       
       if(Usuario==""){
                alertify.error("Error: No debe estar vacio.");

       }else  if(Usuario=="Admin" || Usuario=="Administrador" || Usuario=="melo"){
            alertify.error("Error: No se permite cambiar al administrador.");
        }else{ 
             $.ajax({
                        url: pathSistema +'Usuario/Con_Usuario.php',
                        type: 'post',
                        data: str,
                        success: function(data){
                            //alert(data);
                            $("#buscador").slideUp(); 
                            $('#DatosUsuarioModificar').slideDown();
                            if(data!=""){                                                                      
                                var resultados = data.split("|");
                                $("#Usuario_Modificar #Nombre").val(resultados[0]);
            //                    $("#Usuario_Modificar #Apellido_Paterno").val(resultados[1]);
            //                    $("#Usuario_Modificar #Apellido_Materno").val(resultados[2]);
            //                    $("#Usuario_Modificar #DepartamentoId").val(resultados[3]);
            //                    $("#Usuario_Modificar #Correo").val(resultados[4]);                        
                                $("#Usuario_Modificar #Usuario").val(resultados[5]);                   
                                $("#Usuario_Modificar #Password").val(resultados[6]);
                                $("#Usuario_Modificar #PasswordRepite").val(resultados[6]);

                                $("#Usuario_Modificar #Password").attr('disabled',true);
                                $("#Usuario_Modificar #PasswordRepite").attr('disabled',true);

                                $("#Usuario_Modificar #Pk_Usuario_Login").val(resultados[9]);
                                $("#Usuario_Modificar #activo_usuario").val(resultados[10]);
                                var modulos=resultados[7];
                                var permisos=resultados[8];                      

                                cantidad_pesos=modulos.split('$').length - 1;
                                cantidad_pesos=cantidad_pesos+2;
                                $.ajax({
                                    data: str,
                                    url: pathSistema+'Usuario/Con_UsuarioModulosModificar.php',
                                    type: 'post',
                                    success: function(data){                        
                                        $("#asigna-permisos-modificar").append(data);                            
                                    }                                                        
                                });




                            }
                        }
                    });
        
        
        
         } //fin del else
        return false;                		
                               
    }); //fin del submit
    



$("#Usuario_Modificar").submit(function() {							
        var str = $("#Usuario_Modificar").serialize();  

 //alert("asdasdasd");
 
 
                $.ajax({
                    url: pathSistema +'Usuario/Mod_Usuario.php',
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
    
    
  banderapesos=1;
$("#Agrega_Permiso_Modificar").click(function(){         
        
                                     
          if(banderapesos==1){
              
               cantidad_pesos=cantidad_pesos+20;
                banderapesos=2;
//                   alert(cantidad_pesos);
          }
           cantidad_pesos=cantidad_pesos+1;                               
        var Filas = '<tr id="Filas'+cantidad_pesos+'">';        
        Filas = Filas + '<td><select name="Modulo[]" id="Modulo'+cantidad_pesos+'"></select></td>'
        Filas = Filas + '<td><div id="comboPermisos'+cantidad_pesos+'"></div></td>'
        Filas = Filas + '<td><a href="" class="elimina" id="EliminarPermiso'+cantidad_pesos+'" title= "Eliminar"><img src="assets/img/delete.png"></a></td>';
        Filas = Filas + '</tr>'; 
        $("#asigna-permisos-modificar").append(Filas);

        $("#Modulo"+cantidad_pesos).load(pathSistema+"Usuario/Con_ModuloCombo.php");
                       
        $("#EliminarPermiso"+cantidad_pesos).click(function(){
            var currentId = $(this).attr('id');			
            var element = currentId.split('o');
            var num = element[1];
            // alert(num);
            $("#Filas"+num).remove();
            return false;
        });
   
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
    
    
        cantidad_pesos++;
        return false;
    });
    
    
    



$("#verPermisos").click(function() {
        var str = $("#Usuario_Modificar_Consulta").serialize();    
        
        
        
        $.ajax({
            url: pathSistema +'Usuario/Con_Usuario.php',
            type: 'post',
            data: str,
            success: function(data){
//                alert("entree");
                $("#buscador").slideUp(); 
                $('#datos').slideDown();
                if(data!=""){                                                                      
                    var resultados = data.split("|");
                    
                $("#Permisos-Usuario-Modificar").slideDown();
                
                $(".elimina").click(function(){
                    var objFila=$(this).parents().get(1);
                    $(objFila).remove(); 
                    return false;
                });
                
                
                $("#Modulo2").change(function () {
                    $("#Modulo2 option:selected").each(function () {
                        elegido=$(this).val();
                        $.ajax({
                            url: pathSistema +'Usuario/Con_PermisoCombo.php',
                            type: 'post',
                            data: "llenarCombo=llenarCombo&Fk_Modulo="+elegido,  
                            success: function(data){
                                $("#Permiso2").html(data);                                 
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
                                $("#Permiso3").html(data);
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
                                $("#Permiso4").html(data);                     
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
                                $("#Permiso5").html(data);
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
                                $("#Permiso6").html(data);                    
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
                                $("#Permiso7").html(data);                    
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
                                $("#Permiso8").html(data);                    
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
                                $("#Permiso9").html(data);                    
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
                                $("#Permiso10").html(data);                    
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
                                $("#Permiso11").html(data);                    
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
                                $("#Permiso12").html(data);
                                // alert(data);
                                
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
                                $("#Permiso13").html(data);
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
                                $("#Permiso14").html(data);                    
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
                                $("#Permiso15").html(data);                                  
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
                                $("#Permiso16").html(data);
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
                                $("#Permiso17").html(data);               
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
                                $("#Permiso18").html(data);                        
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
                                $("#Permiso19").html(data);
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
                                $("#Permiso20").html(data);                    
                            }
                        }); //fin del ajax   
                    });      
                });//fin modulo 20


                    $("#Modulo21").change(function () {
                        $("#Modulo21 option:selected").each(function () {
                            elegido=$(this).val();
                            $.ajax({
                                url: pathSistema +'Usuario/Con_PermisoCombo.php',
                                type: 'post',
                                data: "llenarCombo=llenarCombo&Fk_Modulo="+elegido,  
                                success: function(data){           
                                    $("#Permiso21").html(data);
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
                                    $("#Permiso22").html(data);
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
                                    $("#Permiso23").html(data);
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
                                    $("#Permiso24").html(data);
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
                                    $("#Permiso25").html(data);
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
                                    $("#Permiso26").html(data);
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
                                    $("#Permiso27").html(data);
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
                                    $("#Permiso28").html(data);
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
                                    $("#Permiso29").html(data);
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
                                    $("#Permiso30").html(data);
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
                                    $("#Permiso31").html(data);
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
                                    $("#Permiso32").html(data);
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
                                    $("#Permiso33").html(data);
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
                                    $("#Permiso34").html(data);
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
                                    $("#Permiso35").html(data);
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
                                    $("#Permiso36").html(data);
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
                                    $("#Permiso37").html(data);
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
                                    $("#Permiso38").html(data);
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
                                    $("#Permiso39").html(data);
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
                                    $("#Permiso40").html(data);
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
                                    $("#Permiso41").html(data);
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
                                    $("#Permiso42").html(data);
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
                                    $("#Permiso43").html(data);
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
                                    $("#Permiso44").html(data);
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
                                    $("#Permiso45").html(data);
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
                                    $("#Permiso46").html(data);
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
                                    $("#Permiso47").html(data);
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
                                    $("#Permiso48").html(data);
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
                                    $("#Permiso49").html(data);
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
                                    $("#Permiso50").html(data);
                                }
                            }); //fin del ajax        
                        });

                    });
                        
                }//fin
            }   
        });
                
                
                
            });     //clic permisos
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
    //*********************  modulo de escuelas     ********************** //
    //*********************          Melo           ********************** //
   $("#f_Modificardatosinstitucion").submit(function() {
     var str = $("#f_Modificardatosinstitucion").serialize();	
        $.ajax({
            url: pathDatosInstitucion + 'Mod_DatosInstitucion.php',
            type: 'post',
            data: str,
            beforeSend: function (){
                       $("#botonera2").hide();
                       $("#loading-data2").html("Procesando, espere por favor... <img src='assets/img/ajax-loaders/ajax-loader-1.gif'>");
                    },
            success: function(data){
                if(data!=""){
                   var validar = data.split('|');
                   if(validar[0]=='1'){
                        $("#botonera2").show();
                        $("#loading-data2").hide();
                        
                        alertify.alert(validar[1], function (e) {
                            if (e) {
                                // user clicked "ok"
                                window.location.reload();
                            } 
                        });

                    //$(”#Formulario1″)[0].reset();
                    }else{
                        $("#botonera2").show();
                        $("#loading-data2").hide();
                        alertify.error(validar[1]);
                        
                    }

                }
            }
        });
        return false;
    });

    




    //modificar las generaciones
    $("#f_modificargeneraciones").submit(function() {
     var str = $("#f_modificargeneraciones").serialize();	
     
     var MesInicio = $("#m_fk_iniciomes option:selected").text();
     var AnioInicio = $("#m_fk_inicioanios option:selected").text();
     
     var MesFIn = $("#m_fk_finmeses option:selected").text();
     var AnioFin = $("#m_fk_finanios option:selected").text();
     
     var Descripcion = MesInicio +" "+ AnioInicio + " - " + MesFIn +" "+ AnioFin;
     
     
     
        $.ajax({
            url: pathGeneraciones + 'Mod_Generaciones.php',
            type: 'post',
            data: str + "&Descripcion=" + Descripcion,
            beforeSend: function (){
                       $("#botonera2").hide();
                       $("#loading-data2").html("Procesando, espere por favor... <img src='assets/img/ajax-loaders/ajax-loader-1.gif'>");
                    },
            success: function(data){
                if(data!=""){
                    var validar = data.split('|');
                   if(validar[0]=='1'){
                        $("#botonera2").show();
                        $("#loading-data2").hide();
                        
                        alertify.alert(validar[1], function (e) {
                            if (e) {
                                // user clicked "ok"
                                window.location.reload();
                            } 
                        });

                    //$(”#Formulario1″)[0].reset();
                    }else{
                        $("#botonera2").show();
                        $("#loading-data2").hide();
                        alertify.error(validar[1]);
                        
                    }

                }
            }
        });
        return false;
    });
    
    
    
    
    
    
    
    
    
     //modificar los sinodales
    $("#f_ModificarSinodales").submit(function() {
     var str = $("#f_ModificarSinodales").serialize();	
   
        $.ajax({
            url: pathSinodales + 'Mod_Sinodales.php',
            type: 'post',
            data: str,
            beforeSend: function (){
                       $("#botonera2").hide();
                       $("#loading-data2").html("Procesando, espere por favor... <img src='assets/img/ajax-loaders/ajax-loader-1.gif'>");
                    },
            success: function(data){
                if(data!=""){
                    var validar = data.split('|');
                   if(validar[0]=='1'){
                        $("#botonera2").show();
                        $("#loading-data2").hide();
                        
                        alertify.alert(validar[1], function (e) {
                            if (e) {
                                // user clicked "ok"
                                window.location.reload();
                            } 
                        });

                    //$(”#Formulario1″)[0].reset();
                    }else{
                        $("#botonera2").show();
                        $("#loading-data2").hide();
                        alertify.error(validar[1]);
                        
                    }

                }
            }
        });
        return false;
    });
    
    
    
    
    //modificar egresados
    //lic hugo
     $("#frm_datosAlumnoModificar").submit(function() {
     var str = $("#frm_datosAlumnoModificar").serialize();
        $.ajax({
            url: pathAlumnos + 'Mod_Alumnos.php', //primera parte
            type: 'post',
            data: str,
            beforeSend: function (){
                       $("#botonera2").hide();
                       $("#loading-data2").html("Procesando, espere por favor... <img src='assets/img/ajax-loaders/ajax-loader-1.gif'>");
                    },
            success: function(data){
     //console.log(data);	
                if(data!=""){
                    var validar = data.split('|');
                   if(validar[0]=='1'){
                        $("#botonera2").show();
                        $("#loading-data2").hide();
                        
                        
                           var TieneDatosEgresado = $('#frm_datosAlumnoModificar #pk_egresados').val();
                           //si no tiene
                           //alert(TieneDatosEgresado);
                           if(TieneDatosEgresado==""){
                                  $.ajax({
                                        url: pathEgresados+ 'Ins_Egresados.php',
                                        type: 'post',
                                        data: str,
                                        success: function(data) {
                                            //console.log(data);
                                             var validar = data.split('|');
                                             if(validar[0]=='1'){

                                                    alertify.alert(validar[1], function (e) {
                                                        if (e) {
                                                            // user clicked "ok"
                                                            window.location.reload();
                                                        } 
                                                    });

                                                }else{
                                                    $("#botonera2").show();
                                                    $("#loading-data2").hide();
                                                    alertify.error(validar[1]);

                                                }

                                        }
                                    });
                            }else { //si tiene datosModificarDatosEgresados
                                    $.ajax({
                                        url: pathEgresados+ 'Mod_Egresados.php',
                                        type: 'post',
                                        data: str,
                                        success: function(data) {
                                            //console.log(data);

                                             var validar = data.split('|');
                                             if(validar[0]=='1'){

                                                    alertify.alert(validar[1], function (e) {
                                                        if (e) {
                                                            // user clicked "ok"
                                                            window.location.reload();
                                                        } 
                                                    });

                                                }else{
                                                    $("#botonera2").show();
                                                    $("#loading-data2").hide();
                                                    alertify.error(validar[1]);

                                                }

                                        }
                                    });
                                    
                            } //fin del if si tiene datos egresado
                        
                    //$(”#Formulario1″)[0].reset();
                    }else{
                        $("#botonera2").show();
                        $("#loading-data2").hide();
                        alertify.error(validar[1]);
                        
                    }

                }
            }
        });
        return false;
    });

    

    
    
    //modificar alumnos
    //formulario de alumnos unicamente sin nada de egresados
    //secretarias
     $("#formulario_AlumnoModificar").submit(function() {
     var str = $("#formulario_AlumnoModificar").serialize();	
        $.ajax({
            url: pathAlumnos + 'Mod_Alumnos.php', //primera parte
            type: 'post',
            data: str,
            beforeSend: function (){
                       $("#botonera2").hide();
                       $("#loading-data2").html("Procesando, espere por favor... <img src='assets/img/ajax-loaders/ajax-loader-1.gif'>");
                    },
            success: function(data){
                if(data!=""){
                    var validar = data.split('|');
                   if(validar[0]=='1'){
                        $("#botonera2").show();
                        $("#loading-data2").hide();
                        
                         alertify.alert(validar[1], function (e) {
                            if (e) {
                                // user clicked "ok"
                                window.location.reload();
                            } 
                        });
    

                    //$(”#Formulario1″)[0].reset();
                    }else{
                        $("#botonera2").show();
                        $("#loading-data2").hide();
                        alertify.error(validar[1]);
                        
                    }

                }
            }
        });
        return false;
    });

    
 
 
 
    //
    // CARGAR cATALOGO ESTADOS MUNICPIOS COLONIAS DE ALUMNOS
    //
    //seleccionar municipio dependiendo el estado
     $("#formulario_AlumnoModificar #v_estado").change(function () {
        $("#formulario_AlumnoModificar #v_estado option:selected").each(function () {
           indiceElegido=$(this).val();
           elegido=$(this).text();
           
           if(indiceElegido!=""){
                $.ajax({
                    url: pathSistema + 'CodigosPostales/Obtener_Municipios.php',
                    type: 'post',
                    data: "ObtenerMunicipio=ObtenerMunicipio&v_estado="+indiceElegido,
                    dataType: 'json',
                    success: function(data) {
                        if (data.Municipios != "Error") {
                            $("#v_Municipio").html(data.Municipios);
                        }else{
                             $("#v_Municipio").html("");
                        }
                    }
                });
            }
            
        });     
    });
    
    
    
    
    //obtener colonia dependiendo el municipio
      $("#formulario_AlumnoModificar #v_Municipio").change(function () {
        $("#formulario_AlumnoModificar #v_Municipio option:selected").each(function () {
           indiceElegido=$(this).val();
           elegido=$(this).text();
           
           if(indiceElegido!=""){
                $.ajax({
                    url: pathSistema + 'CodigosPostales/Obtener_Colonias.php',
                    type: 'post',
                    data: "ObtenerColonias=ObtenerColonias&v_Municipio="+indiceElegido,
                    dataType: 'json',
                    success: function(data) {
                        if (data.Colonias != "Error") {
                            $("#v_coloniafracc").html(data.Colonias);
                        }else{
                             $("#v_coloniafracc").html("");
                        }
                    }
                });
            }
            
        });     
    });
    
    
    
    
    //codigos postales dependiendo la colonia
        $("#formulario_AlumnoModificar #v_coloniafracc").change(function () {
        $("#formulario_AlumnoModificar #v_coloniafracc option:selected").each(function () {
           indiceElegido=$(this).val();
           elegido=$(this).text();
           
           if(indiceElegido!=""){
                $.ajax({
                    url: pathSistema + 'CodigosPostales/Obtener_CodigoPostal.php',
                    type: 'post',
                    data: "ObtenerCodigoPostal=ObtenerCodigoPostal&v_coloniafracc="+indiceElegido,
                    dataType: 'json',
                    success: function(data) {
                        if (data.Colonias != "Error") {
                            $("#codigopostal").val(data.CodigoPostal);
                        }else{
                             $("#codigopostal").val("");
                        }
                    }
                });
            }
            
        });     
    });
    
    
    
    
     //obtener carreras por modalidad
     $("#formulario_AlumnoModificar #fk_modalidad").change(function () {
        $("#formulario_AlumnoModificar #fk_modalidad option:selected").each(function () {
           indiceElegido=$(this).val();
           elegido=$(this).text();
           var fk_nivelestudio = $("#formulario_AlumnoModificar #fk_nivelestudio").val();
           if(indiceElegido!=""){
               
               
               if(fk_nivelestudio!=""){
                        $.ajax({
                            url: pathCarreras + 'Con_CarrerasModalidad.php',
                            type: 'post',
                            data: "ObtenerModalidad=ObtenerModalidad&fk_modalidad="+ indiceElegido + "&fk_nivelestudio="+fk_nivelestudio,
                            dataType: 'json',
                            success: function(data) {
                                if (data.Municipios != "Error") {
                                    $("#fk_carreras").html(data.Carreras);
                                }else{
                                     $("#fk_carreras").html("");
                                }
                            }
                        });
                   
               }else{
                   $("#formulario_AlumnoModificar #fk_modalidad").val("");
                    alertify.error("Seleccione el Nivel de Estudios.");
                    
               }
                
                
                
                
                
                
            }
            
        });     
    });
    
    
    
    
    
    
    //obtener carreras por modalidad
     $("#formulario_AlumnoModificar #fk_nivelestudio").change(function () {
        $("#formulario_AlumnoModificar #fk_nivelestudio option:selected").each(function () {
           indiceElegido=$(this).val();
           elegido=$(this).text();
           var fk_nivelestudio = $("#formulario_AlumnoModificar #fk_nivelestudio").val();
           var fk_modalidad = $("#formulario_AlumnoModificar #fk_modalidad").val();
           if(indiceElegido!=""){
               
               
               if(fk_nivelestudio!=""){
                        $.ajax({
                            url: pathCarreras + 'Con_CarrerasModalidad.php',
                            type: 'post',
                            data: "ObtenerModalidad=ObtenerModalidad&fk_modalidad="+ fk_modalidad + "&fk_nivelestudio="+fk_nivelestudio,
                            dataType: 'json',
                            success: function(data) {
                                if (data.Municipios != "Error") {
                                    $("#fk_carreras").html(data.Carreras);
                                }else{
                                     $("#fk_carreras").html("");
                                }
                            }
                        });
                   
               }else{
                   $("#formulario_AlumnoModificar #fk_modalidad").val("");
                    alertify.error("Seleccione el Nivel de Estudios.");
                    
               }
                
                
                
                
                
                
            }
            
        });     
    });
    ////////////////////////
    




//para la encuesta de medicina
  $("#frm_datosEncuestaMedicina").submit(function() {
     var str = $("#frm_datosEncuestaMedicina").serialize();	
        $.ajax({
            url: pathAlumnos + 'Mod_AlumnosEncuestaMedicina.php', //primera parte
            type: 'post',
            data: str,
            beforeSend: function (){
                       $("#botonera2").hide();
                       $("#loading-data2").html("Procesando, espere por favor... <img src='assets/img/ajax-loaders/ajax-loader-1.gif'>");
                    },
            success: function(data){
                if(data!=""){
                    var validar = data.split('|');
                   if(validar[0]=='1'){
                        $("#botonera2").show();
                        $("#loading-data2").hide();
                        
                        
                           var TieneDatos = $('#frm_datosEncuestaMedicina #Pk_EncuestaMedicina').val();
                           //si no tiene
                           //alert(TieneDatos);
                           if(TieneDatos==""){
                                  $.ajax({
                                        url: pathEgresados+ 'Ins_EgresadosEncuestaMedicina.php',
                                        type: 'post',
                                        data: str,
                                        success: function(data) {
                                             var validar = data.split('|');
                                             if(validar[0]=='1'){

                                                    alertify.alert(validar[1], function (e) {
                                                        if (e) {
                                                            // user clicked "ok"
                                                            window.location.reload();
                                                        } 
                                                    });

                                                }else{
                                                    $("#botonera2").show();
                                                    $("#loading-data2").hide();
                                                    alertify.error(validar[1]);

                                                }

                                        }
                                    });
                            }else { //si tiene datos
                                    $.ajax({
                                        url: pathEgresados+ 'Mod_EgresadosEncuestaMedicina.php',
                                        type: 'post',
                                        data: str,
                                        success: function(data) {
                                             var validar = data.split('|');
                                             if(validar[0]=='1'){

                                                    alertify.alert(validar[1], function (e) {
                                                        if (e) {
                                                            // user clicked "ok"
                                                            window.location.reload();
                                                        } 
                                                    });

                                                }else{
                                                    $("#botonera2").show();
                                                    $("#loading-data2").hide();
                                                    alertify.error(validar[1]);

                                                }

                                        }
                                    });
                                    
                            } //fin del if si tiene datos egresado
                        
                           
    
    
    
    

                    //$(”#Formulario1″)[0].reset();
                    }else{
                        $("#botonera2").show();
                        $("#loading-data2").hide();
                        alertify.error(validar[1]);
                        
                    }

                }
            }
        });
        return false;
    });








//para la encuesta de maestria
  $("#frm_datosEncuestaMaestria").submit(function() {
     var str = $("#frm_datosEncuestaMaestria").serialize();	
        $.ajax({
            url: pathAlumnos + 'Mod_AlumnosEncuestaMedicina.php', //primera parte
            type: 'post',
            data: str,
            beforeSend: function (){
                       $("#botonera2").hide();
                       $("#loading-data2").html("Procesando, espere por favor... <img src='assets/img/ajax-loaders/ajax-loader-1.gif'>");
                    },
            success: function(data){
                if(data!=""){
                    var validar = data.split('|');
                   if(validar[0]=='1'){
                        $("#botonera2").show();
                        $("#loading-data2").hide();
                        
                        
                           var TieneDatos = $('#frm_datosEncuestaMaestria #pk_encuestamaestria').val();
                           //si no tiene
                          // alert(TieneDatos);
                          if(TieneDatos==""){

                                  $.ajax({
                                        url: pathEgresados+ 'Ins_EgresadosEncuestaMaestria.php',
                                        type: 'post',
                                        data: str,
                                        success: function(data) {
                                             var validar = data.split('|');
                                             if(validar[0]=='1'){

                                                    alertify.alert(validar[1], function (e) {
                                                        if (e) {
                                                            // user clicked "ok"
                                                            window.location.reload();
                                                        } 
                                                    });

                                                }else{
                                                    $("#botonera2").show();
                                                    $("#loading-data2").hide();
                                                    alertify.error(validar[1]);

                                                }

                                        }
                                    });
                            }else { //si tiene datos


                                    $.ajax({
                                        url: pathEgresados+ 'Mod_EgresadosEncuestaMaestria.php',
                                        type: 'post',
                                        data: str,
                                        success: function(data) {
                                             var validar = data.split('|');
                                             if(validar[0]=='1'){

                                                    alertify.alert(validar[1], function (e) {
                                                        if (e) {
                                                            // user clicked "ok"
                                                            window.location.reload();
                                                        } 
                                                    });

                                                }else{
                                                    $("#botonera2").show();
                                                    $("#loading-data2").hide();
                                                    alertify.error(validar[1]);

                                                }

                                        }
                                    });
                                    
                            } //fin del if si tiene datos egresado
                        
                           
    
    
    
    

                    //$(�#Formulario1?)[0].reset();
                    }else{
                        $("#botonera2").show();
                        $("#loading-data2").hide();
                        alertify.error(validar[1]);
                        
                    }

                }
            }
        });
        return false;
    });









//para la encuesta de dcotorado
  $("#frm_datosEncuestaDoctorado").submit(function() {
     var str = $("#frm_datosEncuestaDoctorado").serialize();	
        $.ajax({
            url: pathAlumnos + 'Mod_AlumnosEncuestaMedicina.php', //primera parte
            type: 'post',
            data: str,
            beforeSend: function (){
                       $("#botonera2").hide();
                       $("#loading-data2").html("Procesando, espere por favor... <img src='assets/img/ajax-loaders/ajax-loader-1.gif'>");
                    },
            success: function(data){
                if(data!=""){
                    var validar = data.split('|');
                   if(validar[0]=='1'){
                        $("#botonera2").show();
                        $("#loading-data2").hide();
                        
                        
                           var TieneDatos = $('#frm_datosEncuestaDoctorado #pk_encuestadoctorado').val();
                           //si no tiene
                           //alert(TieneDatos);
                           if(TieneDatos==""){
                                  $.ajax({
                                        url: pathEgresados+ 'Ins_EgresadosEncuestaDoctorado.php',
                                        type: 'post',
                                        data: str,
                                        success: function(data) {
                                             var validar = data.split('|');
                                             if(validar[0]=='1'){

                                                    alertify.alert(validar[1], function (e) {
                                                        if (e) {
                                                            // user clicked "ok"
                                                            window.location.reload();
                                                        } 
                                                    });

                                                }else{
                                                    $("#botonera2").show();
                                                    $("#loading-data2").hide();
                                                    alertify.error(validar[1]);

                                                }

                                        }
                                    });
                            }else { //si tiene datos
                                    $.ajax({
                                        url: pathEgresados+ 'Mod_EgresadosEncuestaDoctorado.php',
                                        type: 'post',
                                        data: str,
                                        success: function(data) {
                                             var validar = data.split('|');
                                             if(validar[0]=='1'){

                                                    alertify.alert(validar[1], function (e) {
                                                        if (e) {
                                                            // user clicked "ok"
                                                            window.location.reload();
                                                        } 
                                                    });

                                                }else{
                                                    $("#botonera2").show();
                                                    $("#loading-data2").hide();
                                                    alertify.error(validar[1]);

                                                }

                                        }
                                    });
                                    
                            } //fin del if si tiene datos egresado
                        
                           
    
    
    
    

                    //$(�#Formulario1?)[0].reset();
                    }else{
                        $("#botonera2").show();
                        $("#loading-data2").hide();
                        alertify.error(validar[1]);
                        
                    }

                }
            }
        });
        return false;
    });




    $("#f_completar_datos_generaciones").submit(function() {
     var str = $("#f_completar_datos_generaciones").serialize();  
        $.ajax({
            url: pathGeneraciones + 'Ins_GroupGeneraciones.php', //primera parte
            type: 'post',
            data: str,
            beforeSend: function (){
                       $("#botonera2").hide();
                       $("#loading-data2").html("Procesando, espere por favor... <img src='assets/img/ajax-loaders/ajax-loader-1.gif'>");
                    },
            success: function(data){
                if(data!=""){
                    var validar = data.split('|');
                   if(validar[0]=='1'){
                        $("#botonera2").show();
                        $("#loading-data2").hide();              

                        alertify.alert(validar[1], function (e) {
                            if (e) {
                                // user clicked "ok"
                                $('#f_completar_datos_generaciones')[0].reset();
                                //window.location.reload();
                            } 
                        }); 
                    
                    }else{
                        $("#botonera2").show();
                        $("#loading-data2").hide();
                        alertify.error(validar[1]);
                        
                    }

                }
            }
        });
        return false;
    });






});


function ModificarInstitucion(pk_dtgenerales){
     $('#f_Modificardatosinstitucion #pk_escuela').val(pk_dtgenerales);
    
      $.ajax({
        url: pathDatosInstitucion + 'Con_DatosInstitucion.php',
        type: 'post',
        data: 'consultar=consultar&pk_dtgenerales=' + pk_dtgenerales,
        dataType: 'json',
        success: function(data) {
            if (data.error != '') {
                $('#f_Modificardatosinstitucion #pk_dtgenerales').val(data.pk_dtgenerales);
                
                
                $('#f_Modificardatosinstitucion #m_nombre').val(data.nombreInstitucion);
                $('#f_Modificardatosinstitucion #m_apodoInstitucion').val(data.apodoInstitucion);
                $('#f_Modificardatosinstitucion #m_lema').val(data.lemaEscuela);                
                $('#f_Modificardatosinstitucion #m_clave').val(data.clave);
                $('#f_Modificardatosinstitucion #m_direccion').val(data.direccion);
                
                $('#f_Modificardatosinstitucion #m_telefono').val(data.telefono);
                $('#f_Modificardatosinstitucion #m_fechaincorporacion').val(data.fechaIncorporacionSrecetaria);
               
                $('#f_Modificardatosinstitucion #m_registro').val(data.registro);
                $('#f_Modificardatosinstitucion #m_regimen').val(data.regimen);
                 $('#f_Modificardatosinstitucion #m_nooficio').val(data.noOficio);
                $('#f_Modificardatosinstitucion #m_paginaweb').val(data.paginaInternet);
                
                //estados municipio colonia                
                $('#f_Modificardatosinstitucion #m_estado').val(data.combo_estados);
                $('#f_Modificardatosinstitucion #m_Municipio').html(data.combo_municipios);
                $('#f_Modificardatosinstitucion #m_coloniafracc').html(data.combo_colonias);

                

            }
        }
    });
    
}






function ModificarGeneraciones(pk_generacion){
     $('#f_modificargeneraciones #pk_generacion').val(pk_generacion);
    
      $.ajax({
        url: pathGeneraciones + 'Con_Generaciones.php',
        type: 'post',
        data: 'consultar=consultar&pk_generacion=' + pk_generacion,
        dataType: 'json',
        success: function(data) {

            if (data.error == 'ok') {
                      
                $('#f_modificargeneraciones #m_fk_iniciomes').val(data.m_fk_iniciomes);
                $('#f_modificargeneraciones #m_fk_inicioanios').val(data.m_fk_inicioanios);
                $('#f_modificargeneraciones #m_fk_finmeses').val(data.m_fk_finmeses);                
                $('#f_modificargeneraciones #m_fk_finanios').val(data.m_fk_finanios);
                

            }
        }
    });
    
}







function ModificarSinodales(pk_sinodal, pk_carreras){
    
 $("#Lista").hide();
    $("#modificarcontenidosinodal").show();
    
     $('#f_ModificarSinodales #pk_sinodal').val(pk_sinodal);
    
      $.ajax({
        url: pathSinodales + 'Con_Sinodales.php',
        type: 'post',
        data: 'consultar=consultar&pk_sinodal=' + pk_sinodal + '&pk_carreras='+ pk_carreras,
        dataType: 'json',
        success: function(data) {

            if (data.error == 'ok') {
                      
                $('#f_ModificarSinodales #v_nombre').val(data.nombre);
                $('#f_ModificarSinodales #v_cedula').val(data.cedula);                
                $('#f_ModificarSinodales #fk_nivelestudio').val(data.fk_nivelestudio);
                $('#f_ModificarSinodales #numEmpleado').val(data.numEmpleado);
                $('#f_ModificarSinodales #cel').val(data.cel);                
                $('#f_ModificarSinodales #nss').val(data.nss);
                $('#f_ModificarSinodales #direccion').val(data.direccion);                
                $('#f_ModificarSinodales #curp').val(data.curp);
                $('#f_ModificarSinodales #rfc').val(data.rfc);
                
                
                $('#f_ModificarSinodales #pk_carreras').html(data.Lista1);
                $('#f_ModificarSinodales #pk_carreras_anterior').html(data.Lista1);

            }
        }
    });
    
}


function ModificarDatosTrabajador(pk_trabajador){
     $.ajax({
        url: pathSistema + 'Usuario/Con_VerificarExisteTrabajador.php',
        type: 'post',
        data: 'consultar=consultar&pk_trabajador=' + pk_trabajador,
        success: function(data) {
                if(data!=""){
                    var validar = data.split('|');
                    if(validar[0]=='1'){
                        $("#botonera").show();
                        $("#loading-data").hide();
                                $.ajax({
                                     url: pathSistema + 'Usuario/Con_Trabajadores.php',
                                     type: 'post',
                                     data: 'consultar=consultar&pk_trabajador=' + pk_trabajador,
                                     dataType: 'json',
                                     success: function(data) {

                                         if (data.error == 'ok') {
                                              $('#ListaConsulta').hide();
                                              $('#FormularioEditarAlumno').show();
                                             $('#frm_TrabajadorModificar #pk_trabajador').val(data.pk_trabajador);
                                             $('#frm_TrabajadorModificar #claveTrabajador').val(data.claveTrabajador);
                                             $('#frm_TrabajadorModificar #nombre').val(data.nombre);

                                             $('#frm_TrabajadorModificar #apaterno').val(data.apaterno);
                                             $('#frm_TrabajadorModificar #amaterno').val(data.amaterno);                
                                             $('#frm_TrabajadorModificar #telefono').val(data.telefono);
                                             $('#frm_TrabajadorModificar #correo').val(data.correo);
                                             $('#frm_TrabajadorModificar #puestoLaboral').val(data.puestoLaboral);
                                             $('#frm_TrabajadorModificar #fk_genero').val(data.fk_genero);


                                         }
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



// aki esta la accion del boton de accion editar egresado y sus datos
function ModificarAlumnoEgresado(pk_alumno){
      $.ajax({
        url: pathEgresados + 'Con_Egresados.php',
        type: 'post',
        data: 'consultar=consultar&pk_alumno=' + pk_alumno,
        dataType: 'json',
        success: function(data) {
            //console.log(data);
            if (data.error == 'ok') {
                 $('#ListaConsulta').hide();
                 $('#FormularioEditarAlumno').show();
                $('#frm_datosAlumnoModificar #pk_alumno').val(data.pk_alumno);
                $('#frm_datosAlumnoModificar #matricula').val(data.matricula);
                $('#frm_datosAlumnoModificar #matricula_desc').val(data.matricula);
                
                $('#frm_datosAlumnoModificar #nombre').val(data.nombre);
                $('#frm_datosAlumnoModificar #apaterno').val(data.apaterno);                
                $('#frm_datosAlumnoModificar #amaterno').val(data.amaterno);
                $('#frm_datosAlumnoModificar #codigopostal').val(data.codigopostal);
                $('#frm_datosAlumnoModificar #curp').val(data.curp);
                $('#frm_datosAlumnoModificar #correo').val(data.correo);
                $('#frm_datosAlumnoModificar #direccion').val(data.direccion);
                $('#frm_datosAlumnoModificar #FechaNacimiento').val(data.FechaNacimiento);
                $('#frm_datosAlumnoModificar #fk_genero').val(data.fk_genero);                
                $('#frm_datosAlumnoModificar #telefonofijo').val(data.telefonofijo);
                $('#frm_datosAlumnoModificar #telefonocelular').val(data.telefonocelular);

                $('#frm_datosAlumnoModificar #f_inicio_car').val(data.f_inicio_car);
                $('#frm_datosAlumnoModificar #f_fin_car').val(data.f_fin_car);
                $('#frm_datosAlumnoModificar #institucionProcedencia').val(data.institucionProcedencia);
                $('#frm_datosAlumnoModificar #f_inicio_antecedente').val(data.f_inicio_antecedente);
                $('#frm_datosAlumnoModificar #f_fin_antecedente').val(data.f_fin_antecedente);
                $('#frm_datosAlumnoModificar #noCedula').val(data.noCedula);
                $('#frm_datosAlumnoModificar #entidad_federativa').val(data.entidad_federativa);
                $('#frm_datosAlumnoModificar #nivel_escolar').val(data.nivel_escolar);
                //$('#frm_datosAlumnoModificar #fk_carreras').val(data.fk_carreras);
                $('#frm_datosAlumnoModificar #fk_turnos').val(data.fk_turnos);
                $('#frm_datosAlumnoModificar #planEstudios').val(data.planEstudios);
                
                $('#frm_datosAlumnoModificar #fk_generacion').val(data.fk_generacion);
                $('#frm_datosAlumnoModificar #letraPromedio').val(data.letraPromedio);
                $('#frm_datosAlumnoModificar #promedio').val(data.promedio);
                $('#frm_datosAlumnoModificar #generacionNumero').val(data.generacionNumero);
                
                //colonias estados municipios
                $('#frm_datosAlumnoModificar #v_estado').val(data.combo_estados);
                $('#frm_datosAlumnoModificar #v_Municipio').html(data.combo_municipios);
                $('#frm_datosAlumnoModificar #v_coloniafracc').html(data.combo_colonias);


                //datos del egresado 
                //si es que tiene jejeje
                $('#frm_datosAlumnoModificar #fk_estadoTitulacion').val(data.fk_estadoTitulacion);
                $('#frm_datosAlumnoModificar #estatusTrabajo').val(data.estatusTrabajo);
                $('#frm_datosAlumnoModificar #correoTrabajo').val(data.correoTrabajo);
                $('#frm_datosAlumnoModificar #nombreJefeInmediato').val(data.nombreJefeInmediato);
                $('#frm_datosAlumnoModificar #mtriaNombre').val(data.mtriaNombre);
                $('#frm_datosAlumnoModificar #mtriaInstitucion').val(data.mtriaInstitucion);
                $('#frm_datosAlumnoModificar #doctoradoNombre').val(data.doctoradoNombre);
                $('#frm_datosAlumnoModificar #doctoradoInstitucion').val(data.doctoradoInstitucion);
                $('#frm_datosAlumnoModificar #especialidadNombre').val(data.especialidadNombre);
                $('#frm_datosAlumnoModificar #especialidadInstitucion').val(data.especialidadInstitucion);
                $('#frm_datosAlumnoModificar #estatusCredencial').val(data.estatusCredencial);
                
                $('#frm_datosAlumnoModificar #pk_egresados').val(data.pk_egresados);

                $('#frm_datosAlumnoModificar #noactatitulo').val(data.noactatitulo);
                $('#frm_datosAlumnoModificar #folioTimbreTitulo').val(data.folioTimbreTitulo);
                $('#frm_datosAlumnoModificar #fechaexpediciontitulo').val(data.fechaexpediciontitulo);
                $('#frm_datosAlumnoModificar #quehacermejora').val(data.quehacermejora);       
             
                //datos que faltaban del egresado laborales
                $('#frm_datosAlumnoModificar #nombreEmpresaTrabajo').val(data.nombreEmpresaTrabajo);
                $('#frm_datosAlumnoModificar #puestoTrabajo').val(data.puestoTrabajo);
                $('#frm_datosAlumnoModificar #direccionTrabajo').val(data.direccionTrabajo);
                $('#frm_datosAlumnoModificar #telefonoTrabajo').val(data.telefonoTrabajo);
                
                $('#frm_datosAlumnoModificar #fk_titulacion').val(data.fk_titulacion);
                $('#frm_datosAlumnoModificar #FechaTomaProtesta').val(data.FechaTomaProtesta);
                $('#frm_datosAlumnoModificar #FolioActa').val(data.FolioActa);
                $('#frm_datosAlumnoModificar #folioTimbreActa').val(data.folioTimbreActa);
	            $('#frm_datosAlumnoModificar #noActaExamen').val(data.noActaExamen);
                $('#frm_datosAlumnoModificar #TipoAcreditacion').val(data.TipoAcreditacion);

                
                $('#frm_datosAlumnoModificar #fk_nivelestudio').val(data.fk_nivelestudio);
                $('#frm_datosAlumnoModificar #fk_modalidad').val(data.fk_modalidad);
                $('#frm_datosAlumnoModificar #fk_carreras').html(data.combo_carreras);

                $('#frm_datosAlumnoModificar #fk_nivelestudio_disabled').val(data.fk_nivelestudio);
                $('#frm_datosAlumnoModificar #fk_modalidad_disabled').val(data.fk_modalidad);
                $('#frm_datosAlumnoModificar #fk_carreras_disabled').html(data.combo_carreras);

                $('#F_fotoperfil #MostrarFoto').html(data.RutaFotoPerfil);
                $('#frm_datosAlumnoModificar #fk_ingresoactual').val(data.fk_ingresoactualegre);
                $('#frm_datosAlumnoModificar #empleoencontrar').val(data.empleoencontrar);
                $('#frm_datosAlumnoModificar #fk_gradosatisfaccion').val(data.fk_gradosatisfaccionegre);
                $('#frm_datosAlumnoModificar #plandeestudioscalificacion').val(data.plandeestudioscalificacion);				 
                $('#frm_datosAlumnoModificar #aspectodebilidad').val(data.aspectodebilidad);
                $('#frm_datosAlumnoModificar #sugerencias').val(data.sugerencias);
                $('#frm_datosAlumnoModificar #edadEgreso').val(data.edadEgreso);
                $('#frm_datosAlumnoModificar #Discapacidad').val(data.Discapacidad);
                $('#frm_datosAlumnoModificar #DiscapacidadCual').val(data.DiscapacidadCual);
                $('#frm_datosAlumnoModificar #fechaEntregaCredencial').val(data.fechaEntregaCredencial);
                $('#frm_datosAlumnoModificar #fk_estcivil').val(data.estadocivil);

                $('#frm_datosAlumnoModificar #noCedulaProf').val(data.noCedulaProf);
                $('#frm_datosAlumnoModificar #derechoPromedio').val(data.derechoPromedio);
                $('#frm_datosAlumnoModificar #nuevaUno').val(data.nuevaUno);
                $('#frm_datosAlumnoModificar #nuevaDos').val(data.nuevaDos);
                $('#frm_datosAlumnoModificar #porqueUno').val(data.porqueUno);
                $('#frm_datosAlumnoModificar #porqueDos').val(data.porqueDos);
                   
                
                $('#F_fotoperfil #MostrarFoto').slideDown();
                
            
            }
        }
    });
    
}

function AgregarFolioConcursoEgresado(pk_alumno,matricula){
	alertify.prompt("No. de Folio concurso...", function (e, str) {
            // str is the input text
            if (e) {
                // user clicked "ok"
				if(str!="" && str.length <=5){
					$.ajax({
						url: pathEgresados+'Mod_EgresadosFolioconcurso.php',
						type: 'POST',
						data: 'pk_alumno='+pk_alumno+'&folioConcurso='+str+'&matricula='+matricula,
						success: function(e){
							var res=e.split('|');
							if(res[0]==1){
								alertify.alert(res[1]);
							}
							else{
								alertify.alert(res[1]);
							}
						}
						
					});
				}
				else{
					alertify.alert('Ingrese un fólio correcto');
					AgregarFolioConcursoEgresado(pk_alumno,matricula);
				}
            }
    }, "");
}



function ModificarAlumnosSolo(pk_alumno){
    
      $.ajax({
        url: pathEgresados + 'Con_Egresados.php',
        type: 'post',
        data: 'consultar=consultar&pk_alumno=' + pk_alumno,
        dataType: 'json',
        success: function(data) {

            if (data.error == 'ok') {
                 $('#ListaConsulta').hide();
                 $('#FormularioEditarAlumno').show();
                $('#formulario_AlumnoModificar #pk_alumno').val(data.pk_alumno);
                $('#formulario_AlumnoModificar #matricula').val(data.matricula);
                $('#formulario_AlumnoModificar #matricula_desc').val(data.matricula);
                
                $('#formulario_AlumnoModificar #nombre').val(data.nombre);
                $('#formulario_AlumnoModificar #apaterno').val(data.apaterno);                
                $('#formulario_AlumnoModificar #amaterno').val(data.amaterno);
                $('#formulario_AlumnoModificar #codigopostal').val(data.codigopostal);
                $('#formulario_AlumnoModificar #curp').val(data.curp);
                $('#formulario_AlumnoModificar #correo').val(data.correo);
                $('#formulario_AlumnoModificar #direccion').val(data.direccion);
                $('#formulario_AlumnoModificar #FechaNacimiento').val(data.FechaNacimiento);
                $('#formulario_AlumnoModificar #fk_genero').val(data.fk_genero);                
                $('#formulario_AlumnoModificar #telefonofijo').val(data.telefonofijo);
                $('#formulario_AlumnoModificar #telefonocelular').val(data.telefonocelular);
               
                $('#formulario_AlumnoModificar #fk_turnos').val(data.fk_turnos);
                $('#formulario_AlumnoModificar #planEstudios').val(data.planEstudios);
                
                $('#formulario_AlumnoModificar #fk_generacion').val(data.fk_generacion);
                $('#formulario_AlumnoModificar #letraPromedio').val(data.letraPromedio);
                $('#formulario_AlumnoModificar #promedio').val(data.promedio);
                $('#formulario_AlumnoModificar #generacionNumero').val(data.generacionNumero);
                
                $('#formulario_AlumnoModificar #fk_nivelestudio').val(data.fk_nivelestudio);
                $('#formulario_AlumnoModificar #fk_modalidad').val(data.fk_modalidad);
                
                //colonias estados municipios
                $('#formulario_AlumnoModificar #fk_carreras').html(data.combo_carreras);
                $('#formulario_AlumnoModificar #v_estado').val(data.combo_estados);
                $('#formulario_AlumnoModificar #v_Municipio').html(data.combo_municipios);
                $('#formulario_AlumnoModificar #v_coloniafracc').html(data.combo_colonias);

                 
   


            
            }
        }
    });
    
}



// ####################################### MONKY #########################################
// 
// 
function loadDatasAlumnoForCertificacion(pk_alumno){
    
      $.ajax({
        url: pathEgresados + 'Con_Egresados.php',
        type: 'post',
        data: 'consultar=consultar&pk_alumno=' + pk_alumno,
        dataType: 'json',
        success: function(data) {

            if (data.error == 'ok') {
                 $('#ListaConsulta').hide();
                 $('#FormularioEditarAlumno').show();

                $('#formulario_AlumnoModificar_Certificacion #pk_alumno').val(data.pk_alumno);
                $('#formulario_AlumnoModificar_Certificacion #matricula').val(data.matricula);
                $('#formulario_AlumnoModificar_Certificacion #matricula_desc').val(data.matricula);
                
                $('#formulario_AlumnoModificar_Certificacion #nombre').val(data.nombre);
                $('#formulario_AlumnoModificar_Certificacion #apaterno').val(data.apaterno);                
                $('#formulario_AlumnoModificar_Certificacion #amaterno').val(data.amaterno);
                $('#formulario_AlumnoModificar_Certificacion #codigopostal').val(data.codigopostal);
                $('#formulario_AlumnoModificar_Certificacion #curp').val(data.curp);
                $('#formulario_AlumnoModificar_Certificacion #correo').val(data.correo);
                $('#formulario_AlumnoModificar_Certificacion #direccion').val(data.direccion);
                $('#formulario_AlumnoModificar_Certificacion #FechaNacimiento').val(data.FechaNacimiento);
                $('#formulario_AlumnoModificar_Certificacion #fk_genero').val(data.fk_genero);                
                $('#formulario_AlumnoModificar_Certificacion #telefonofijo').val(data.telefonofijo);
                $('#formulario_AlumnoModificar_Certificacion #telefonocelular').val(data.telefonocelular);
               
                $('#formulario_AlumnoModificar_Certificacion #fk_turnos').val(data.fk_turnos);
                $('#formulario_AlumnoModificar_Certificacion #planEstudios').val(data.planEstudios);
                
                $('#formulario_AlumnoModificar_Certificacion #fk_generacion').val(data.fk_generacion);
                $('#formulario_AlumnoModificar_Certificacion #letraPromedio').val(data.letraPromedio);
                $('#formulario_AlumnoModificar_Certificacion #promedio').val(data.promedio);
                $('#formulario_AlumnoModificar_Certificacion #generacionNumero').val(data.generacionNumero);
                
                $('#formulario_AlumnoModificar_Certificacion #fk_nivelestudio').val(data.fk_nivelestudio);
                $('#formulario_AlumnoModificar_Certificacion #fk_modalidad').val(data.fk_modalidad);
                
                //colonias estados municipios
                $('#formulario_AlumnoModificar_Certificacion #fk_carreras').html(data.combo_carreras);
                $('#formulario_AlumnoModificar_Certificacion #v_estado').val(data.combo_estados);
                $('#formulario_AlumnoModificar_Certificacion #v_Municipio').html(data.combo_municipios);
                $('#formulario_AlumnoModificar_Certificacion #v_coloniafracc').html(data.combo_colonias);
           
            }
        }
    });
    
}



function loadDatasAlumnoRegistroTimbres(pk_alumno){
    
      $.ajax({
        url: pathEgresados + 'Con_Egresados.php',
        type: 'post',
        data: 'consultar=consultar&pk_alumno=' + pk_alumno,
        dataType: 'json',
        success: function(data) {

            if (data.error == 'ok') {
                 $('#ListaConsulta').hide();
                 $('#FormularioEditarAlumno').show();

                $('#formulario_AlumnoModificar_RegistroTimbres #pk_alumno').val(data.pk_alumno);
                $('#formulario_AlumnoModificar_RegistroTimbres #matricula').val(data.matricula);
                $('#formulario_AlumnoModificar_RegistroTimbres #matricula_desc').val(data.matricula);
                
                $('#formulario_AlumnoModificar_RegistroTimbres #nombre').val(data.nombre);
                $('#formulario_AlumnoModificar_RegistroTimbres #apaterno').val(data.apaterno);                
                $('#formulario_AlumnoModificar_RegistroTimbres #amaterno').val(data.amaterno);
                $('#formulario_AlumnoModificar_RegistroTimbres #codigopostal').val(data.codigopostal);
                $('#formulario_AlumnoModificar_RegistroTimbres #curp').val(data.curp);
                $('#formulario_AlumnoModificar_RegistroTimbres #correo').val(data.correo);
                $('#formulario_AlumnoModificar_RegistroTimbres #direccion').val(data.direccion);
                $('#formulario_AlumnoModificar_RegistroTimbres #FechaNacimiento').val(data.FechaNacimiento);
                $('#formulario_AlumnoModificar_RegistroTimbres #fk_genero').val(data.fk_genero);                
                $('#formulario_AlumnoModificar_RegistroTimbres #telefonofijo').val(data.telefonofijo);
                $('#formulario_AlumnoModificar_RegistroTimbres #telefonocelular').val(data.telefonocelular);
               
                $('#formulario_AlumnoModificar_RegistroTimbres #fk_turnos').val(data.fk_turnos);
                $('#formulario_AlumnoModificar_RegistroTimbres #planEstudios').val(data.planEstudios);
                
                $('#formulario_AlumnoModificar_RegistroTimbres #fk_generacion').val(data.fk_generacion);
                $('#formulario_AlumnoModificar_RegistroTimbres #letraPromedio').val(data.letraPromedio);
                $('#formulario_AlumnoModificar_RegistroTimbres #promedio').val(data.promedio);
                $('#formulario_AlumnoModificar_RegistroTimbres #generacionNumero').val(data.generacionNumero);
                
                $('#formulario_AlumnoModificar_RegistroTimbres #fk_nivelestudio').val(data.fk_nivelestudio);
                $('#formulario_AlumnoModificar_RegistroTimbres #fk_modalidad').val(data.fk_modalidad);
                
                //colonias estados municipios
                $('#formulario_AlumnoModificar_RegistroTimbres #fk_carreras').html(data.combo_carreras);
                $('#formulario_AlumnoModificar_RegistroTimbres #v_estado').val(data.combo_estados);
                $('#formulario_AlumnoModificar_RegistroTimbres #v_Municipio').html(data.combo_municipios);
                $('#formulario_AlumnoModificar_RegistroTimbres #v_coloniafracc').html(data.combo_colonias);
           
            }
        }
    });
    
}


function ModificarEncuestaEgresados(pk_alumno){
    
      $.ajax({
        url: pathEgresados + 'Con_Egresados.php',
        type: 'post',
        data: 'consultar=consultar&pk_alumno=' + pk_alumno,
        dataType: 'json',
        success: function(data) {

            if (data.error == 'ok') {
                 $('#ListaConsulta').hide();
                 $('#FormularioEditarAlumno').show();
                $('#frm_datosEncuestaMedicina #pk_alumno').val(data.pk_alumno);
                $('#frm_datosEncuestaMedicina #matricula').val(data.matricula);
                $('#frm_datosEncuestaMedicina #matricula_desc').val(data.matricula);
                
                $('#frm_datosEncuestaMedicina #nombre').val(data.nombre);
                $('#frm_datosEncuestaMedicina #apaterno').val(data.apaterno);                
                $('#frm_datosEncuestaMedicina #amaterno').val(data.amaterno);
                $('#frm_datosEncuestaMedicina #codigopostal').val(data.codigopostal);
                $('#frm_datosEncuestaMedicina #curp').val(data.curp);
                $('#frm_datosEncuestaMedicina #correo').val(data.correo);
                $('#frm_datosEncuestaMedicina #direccion').val(data.direccion);
                $('#frm_datosEncuestaMedicina #FechaNacimiento').val(data.FechaNacimiento);
                $('#frm_datosEncuestaMedicina #fk_genero').val(data.fk_genero);                
                $('#frm_datosEncuestaMedicina #telefonofijo').val(data.telefonofijo);
                $('#frm_datosEncuestaMedicina #telefonocelular').val(data.telefonocelular);
                $('#frm_datosEncuestaMedicina #fk_carreras').val(data.fk_carreras);
                $('#frm_datosEncuestaMedicina #fk_turnos').val(data.fk_turnos);
                $('#frm_datosEncuestaMedicina #planEstudios').val(data.planEstudios);
                
                $('#frm_datosEncuestaMedicina #fk_generacion').val(data.fk_generacion);
                $('#frm_datosEncuestaMedicina #letraPromedio').val(data.letraPromedio);
                $('#frm_datosEncuestaMedicina #promedio').val(data.promedio);
                $('#frm_datosEncuestaMedicina #generacionNumero').val(data.generacionNumero);
                
                //colonias estados municipios
                $('#frm_datosEncuestaMedicina #v_estado').val(data.combo_estados);
                $('#frm_datosEncuestaMedicina #v_Municipio').html(data.combo_municipios);
                $('#frm_datosEncuestaMedicina #v_coloniafracc').html(data.combo_colonias);

//                 $("#frm_datosEncuestaMedicina #v_estado").select2("val", data.combo_estados);
//                 $("#frm_datosEncuestaMedicina #v_Municipio").select2("val", data.combo_municipios);
//                 $("#frm_datosEncuestaMedicina #v_coloniafracc").select2("val", data.combo_colonias);
//                 
                //datos del egresado 
                //si es que tiene jejeje
                $('#frm_datosEncuestaMedicina #fk_estadoTitulacion').val(data.fk_estadoTitulacion);
                $('#frm_datosEncuestaMedicina #fk_titulacion').val(data.fk_titulacion);
                $('#frm_datosEncuestaMedicina #estatusTrabajo').val(data.estatusTrabajo);
                $('#frm_datosEncuestaMedicina #correoTrabajo').val(data.correoTrabajo);
                $('#frm_datosEncuestaMedicina #nombreJefeInmediato').val(data.nombreJefeInmediato);
                $('#frm_datosEncuestaMedicina #mtriaNombre').val(data.mtriaNombre);
                $('#frm_datosEncuestaMedicina #mtriaInstitucion').val(data.mtriaInstitucion);
                $('#frm_datosEncuestaMedicina #doctoradoNombre').val(data.doctoradoNombre);
                $('#frm_datosEncuestaMedicina #doctoradoInstitucion').val(data.doctoradoInstitucion);
                $('#frm_datosEncuestaMedicina #especialidadNombre').val(data.especialidadNombre);
                $('#frm_datosEncuestaMedicina #especialidadInstitucion').val(data.especialidadInstitucion);
                $('#frm_datosEncuestaMedicina #estatusCredencial').val(data.estatusCredencial);
                
                $('#frm_datosEncuestaMedicina #pk_egresados').val(data.pk_egresados);
                
                $('#frm_datosEncuestaMedicina #Pk_EncuestaMedicina').val(data.Pk_EncuestaMedicina);
                


	//fotoMedicina
		$('#fotoperfil #foto').html(data.urlfoto);
		$('#fotoperfil #foto').slideDown();


                
                //datos encuesta medicina
                $('#frm_datosEncuestaMedicina #EdadAlumno').val(data.EdadAlumno);
                $('#frm_datosEncuestaMedicina #fk_estadocivil').val(data.fk_estadocivil);
                
//                $('#frm_datosEncuestaMedicina #AnoInicioLicenciatura').val(data.AnoInicioLicenciatura);
//                $('#frm_datosEncuestaMedicina #AnoFinLicenciatura').val(data.AnoFinLicenciatura);
                $('#frm_datosEncuestaMedicina #AnoInicioLicenciatura').select2("val", data.AnoInicioLicenciatura);
                $('#frm_datosEncuestaMedicina #AnoFinLicenciatura').select2("val", data.AnoFinLicenciatura);
                
                $('#frm_datosEncuestaMedicina #fk_estudiosposgrado').val(data.fk_estudiosposgrado);
                $('#frm_datosEncuestaMedicina #EstudioPosgradoMedicinaOtros').val(data.EstudioPosgradoMedicinaOtros);
                $('#frm_datosEncuestaMedicina #fk_ramaposgrado').val(data.fk_ramaposgrado);
                
                
                $('#frm_datosEncuestaMedicina #fk_institucioneslabora').val(data.fk_institucioneslabora);
                //en caso de ser 1 = si
                if(data.fk_institucioneslabora=='10'){
                    $('#frm_datosEncuestaMedicina #DIVInstitucionLaboraMedicinaOtros').slideDown();                    
                    $('#frm_datosEncuestaMedicina #InstitucionLaboraMedicinaOtros').val(data.InstitucionLaboraMedicinaOtros);
                }else{
                    $('#frm_datosEncuestaMedicina #InstitucionLaboraMedicinaOtros').val(""); 
                }
                
                
                $('#frm_datosEncuestaMedicina #DireccionInstitucionLabora').val(data.DireccionInstitucionLabora);
                $('#frm_datosEncuestaMedicina #fk_puestosmedicina').val(data.fk_puestosmedicina);
                $('#frm_datosEncuestaMedicina #FuncionesDesempenaMedicina').val(data.FuncionesDesempenaMedicina);
                $('#frm_datosEncuestaMedicina #fk_ingresoactual').val(data.fk_ingresoactual);
                $('#frm_datosEncuestaMedicina #PuestoUno').val(data.PuestoUno);
                $('#frm_datosEncuestaMedicina #InstitucionEmpresaUno').val(data.InstitucionEmpresaUno);
                $('#frm_datosEncuestaMedicina #TiempoQueLaboroUno').val(data.TiempoQueLaboroUno);
                $('#frm_datosEncuestaMedicina #PuestoDos').val(data.PuestoDos);
                $('#frm_datosEncuestaMedicina #InstitucionEmpresaDos').val(data.InstitucionEmpresaDos);
                $('#frm_datosEncuestaMedicina #TiempoQueLaboroDos').val(data.TiempoQueLaboroDos);
                $('#frm_datosEncuestaMedicina #PuestoTres').val(data.PuestoTres);
                $('#frm_datosEncuestaMedicina #InstitucionEmpresaTres').val(data.InstitucionEmpresaTres);
                $('#frm_datosEncuestaMedicina #TiempoQueLaboroTres').val(data.TiempoQueLaboroTres);
                
                
                $('#frm_datosEncuestaMedicina #PerteneceOrganizacionSocial').val(data.PerteneceOrganizacionSocial);
                 if(data.PerteneceOrganizacionSocial=='1'){
                    $('#frm_datosEncuestaMedicina #DIVPerteneceOrganizacionSocialSi').slideDown();                    
                    $('#frm_datosEncuestaMedicina #PerteneceOrganizacionSocialSi').val(data.PerteneceOrganizacionSocialSi);
                }else{
                    $('#frm_datosEncuestaMedicina #PerteneceOrganizacionSocialSi').val(""); 
                }
                
                
                
                $('#frm_datosEncuestaMedicina #CertificacionProfesional').val(data.CertificacionProfesional);
                if(data.CertificacionProfesional=='1'){
                    $('#frm_datosEncuestaMedicina #DIVCertificacionProfesionalSi').slideDown();                    
                    $('#frm_datosEncuestaMedicina #CertificacionProfesionalFecha').val(data.CertificacionProfesionalFecha);
                    $('#frm_datosEncuestaMedicina #CertificacionProfesionalOrganismo').val(data.CertificacionProfesionalOrganismo);
              
                }else{
                    $('#frm_datosEncuestaMedicina #CertificacionProfesionalFecha').val(""); 
                    $('#frm_datosEncuestaMedicina #CertificacionProfesionalOrganismo').val(""); 

                }           
               
                
                
                
                 $('#frm_datosEncuestaMedicina #CapacitacionTrabajoActual').val(data.CapacitacionTrabajoActual);
                $('#frm_datosEncuestaMedicina #GradoCienciasBasicas').val(data.GradoCienciasBasicas);
                $('#frm_datosEncuestaMedicina #GradoCienciasClinicas').val(data.GradoCienciasClinicas);
                $('#frm_datosEncuestaMedicina #fk_aspectodebilidad').val(data.fk_aspectodebilidad);
                $('#frm_datosEncuestaMedicina #AspectoDebilidadOtros').val(data.AspectoDebilidadOtros);
                $('#frm_datosEncuestaMedicina #ComentarioMejorarPerfil').val(data.ComentarioMejorarPerfil);
                $('#frm_datosEncuestaMedicina #ComentarioMejorarPlanEstudios').val(data.ComentarioMejorarPlanEstudios);
                $('#frm_datosEncuestaMedicina #fk_gradosatisfaccion').select2("val", data.fk_gradosatisfaccion);
                $('#frm_datosEncuestaMedicina #ElegirMismaInstitucion').val(data.ElegirMismaInstitucion);

            
            }
        }
    });
    
}







function ModificarEncuestaMaestria(pk_alumno){
    
      $.ajax({
        url: pathEgresados + 'Con_EgresadosMaestria.php',
        type: 'post',
        data: 'consultar=consultar&pk_alumno=' + pk_alumno,
        dataType: 'json',
        success: function(data) {

            if (data.error == 'ok') {
                 $('#ListaConsulta').hide();
                 $('#FormularioEditarAlumno').show();
                $('#frm_datosEncuestaMaestria #pk_alumno').val(data.pk_alumno);
                $('#frm_datosEncuestaMaestria #matricula').val(data.matricula);
                $('#frm_datosEncuestaMaestria #matricula_desc').val(data.matricula);
                
                $('#frm_datosEncuestaMaestria #nombre').val(data.nombre);
                $('#frm_datosEncuestaMaestria #apaterno').val(data.apaterno);                
                $('#frm_datosEncuestaMaestria #amaterno').val(data.amaterno);
                $('#frm_datosEncuestaMaestria #codigopostal').val(data.codigopostal);
                $('#frm_datosEncuestaMaestria #curp').val(data.curp);
                $('#frm_datosEncuestaMaestria #correo').val(data.correo);
                $('#frm_datosEncuestaMaestria #direccion').val(data.direccion);
                $('#frm_datosEncuestaMaestria #FechaNacimiento').val(data.FechaNacimiento);
                $('#frm_datosEncuestaMaestria #fk_genero').val(data.fk_genero);                
                $('#frm_datosEncuestaMaestria #telefonofijo').val(data.telefonofijo);
                $('#frm_datosEncuestaMaestria #telefonocelular').val(data.telefonocelular);
                $('#frm_datosEncuestaMaestria #fk_carreras').val(data.fk_carreras);
                $('#frm_datosEncuestaMaestria #fk_turnos').val(data.fk_turnos);
                $('#frm_datosEncuestaMaestria #planEstudios').val(data.planEstudios);
                
                $('#frm_datosEncuestaMaestria #fk_generacion').val(data.fk_generacion);
                $('#frm_datosEncuestaMaestria #letraPromedio').val(data.letraPromedio);
                $('#frm_datosEncuestaMaestria #promedio').val(data.promedio);
                $('#frm_datosEncuestaMaestria #generacionNumero').val(data.generacionNumero);
                
                //colonias estados municipios
                $('#frm_datosEncuestaMaestria #v_estado').val(data.combo_estados);
                $('#frm_datosEncuestaMaestria #v_Municipio').html(data.combo_municipios);
                $('#frm_datosEncuestaMaestria #v_coloniafracc').html(data.combo_colonias);

                //datos del egresado 
                //si es que tiene jejeje
                $('#frm_datosEncuestaMaestria #fk_estadoTitulacion').val(data.fk_estadoTitulacion);
                $('#frm_datosEncuestaMaestria #estatusTrabajo').val(data.estatusTrabajo);
                $('#frm_datosEncuestaMaestria #correoTrabajo').val(data.correoTrabajo);
                $('#frm_datosEncuestaMaestria #nombreJefeInmediato').val(data.nombreJefeInmediato);
                $('#frm_datosEncuestaMaestria #mtriaNombre').val(data.mtriaNombre);
                $('#frm_datosEncuestaMaestria #mtriaInstitucion').val(data.mtriaInstitucion);
                $('#frm_datosEncuestaMaestria #doctoradoNombre').val(data.doctoradoNombre);
                $('#frm_datosEncuestaMaestria #doctoradoInstitucion').val(data.doctoradoInstitucion);
                $('#frm_datosEncuestaMaestria #especialidadNombre').val(data.especialidadNombre);
                $('#frm_datosEncuestaMaestria #especialidadInstitucion').val(data.especialidadInstitucion);
                $('#frm_datosEncuestaMaestria #estatusCredencial').val(data.estatusCredencial);
                
                $('#frm_datosEncuestaMaestria #pk_egresados').val(data.pk_egresados);
                
                                             
                $('#frm_datosEncuestaMaestria #pk_encuestamaestria').val(data.pk_encuestamaestria);
                $('#frm_datosEncuestaMaestria #DA_Licenciatura').val(data.DA_Licenciatura);
                $('#frm_datosEncuestaMaestria #DA_LicenciaturaInst').val(data.DA_LicenciaturaInst);
                $('#frm_datosEncuestaMaestria #DA_Maestria').val(data.DA_Maestria);
                $('#frm_datosEncuestaMaestria #DA_MaestriaInst').val(data.DA_MaestriaInst);
                $('#frm_datosEncuestaMaestria #DA_Doctorado').val(data.DA_Doctorado);
                $('#frm_datosEncuestaMaestria #DA_DoctoradoInst').val(data.DA_DoctoradoInst);
                $('#frm_datosEncuestaMaestria #DA_Especialidad').val(data.DA_Especialidad);
                $('#frm_datosEncuestaMaestria #DA_EspecialidadInst').val(data.DA_EspecialidadInst);
                $('#frm_datosEncuestaMaestria #DL_TrabajaActualmente').val(data.DL_TrabajaActualmente);
                $('#frm_datosEncuestaMaestria #DL_EmpresaColabora').val(data.DL_EmpresaColabora);
                $('#frm_datosEncuestaMaestria #DL_PuestoDesempena').val(data.DL_PuestoDesempena);
                $('#frm_datosEncuestaMaestria #DL_DireccionEmpresa').val(data.DL_DireccionEmpresa);
                $('#frm_datosEncuestaMaestria #DL_TelefonoEmpresa').val(data.DL_TelefonoEmpresa);
             
               $('#frm_datosEncuestaMaestria #DL_Mail').val(data.DL_Mail);
                $('#frm_datosEncuestaMaestria #DL_JefeInmediato').val(data.DL_JefeInmediato);
                $('#frm_datosEncuestaMaestria #DL_OpinionPlan').val(data.DL_OpinionPlan);
                $('#frm_datosEncuestaMaestria #DL_CalifPlan').val(data.DL_CalifPlan);
                $('#frm_datosEncuestaMaestria #DL_Satisfaccion').val(data.DL_Satisfaccion);
                
                
             
            }
        }
    });
    
}






function ModificarEncuestaDoctorado(pk_alumno){
    
      $.ajax({
        url: pathEgresados + 'Con_EgresadosDoctorado.php',
        type: 'post',
        data: 'consultar=consultar&pk_alumno=' + pk_alumno,
        dataType: 'json',
        success: function(data) {

            if (data.error == 'ok') {
                 $('#ListaConsulta').hide();
                 $('#FormularioEditarAlumno').show();
                $('#frm_datosEncuestaDoctorado #pk_alumno').val(data.pk_alumno);
                $('#frm_datosEncuestaDoctorado #matricula').val(data.matricula);
                $('#frm_datosEncuestaDoctorado #matricula_desc').val(data.matricula);
                
                $('#frm_datosEncuestaDoctorado #nombre').val(data.nombre);
                $('#frm_datosEncuestaDoctorado #apaterno').val(data.apaterno);                
                $('#frm_datosEncuestaDoctorado #amaterno').val(data.amaterno);
                $('#frm_datosEncuestaDoctorado #codigopostal').val(data.codigopostal);
                $('#frm_datosEncuestaDoctorado #curp').val(data.curp);
                $('#frm_datosEncuestaDoctorado #correo').val(data.correo);
                $('#frm_datosEncuestaDoctorado #direccion').val(data.direccion);
                $('#frm_datosEncuestaDoctorado #FechaNacimiento').val(data.FechaNacimiento);
                $('#frm_datosEncuestaDoctorado #fk_genero').val(data.fk_genero);                
                $('#frm_datosEncuestaDoctorado #telefonofijo').val(data.telefonofijo);
                $('#frm_datosEncuestaDoctorado #telefonocelular').val(data.telefonocelular);
                $('#frm_datosEncuestaDoctorado #fk_carreras').val(data.fk_carreras);
                $('#frm_datosEncuestaDoctorado #fk_turnos').val(data.fk_turnos);
                $('#frm_datosEncuestaDoctorado #planEstudios').val(data.planEstudios);
                
                $('#frm_datosEncuestaDoctorado #fk_generacion').val(data.fk_generacion);
                $('#frm_datosEncuestaDoctorado #letraPromedio').val(data.letraPromedio);
                $('#frm_datosEncuestaDoctorado #promedio').val(data.promedio);
                $('#frm_datosEncuestaDoctorado #generacionNumero').val(data.generacionNumero);
                
                //colonias estados municipios
                $('#frm_datosEncuestaDoctorado #v_estado').val(data.combo_estados);
                $('#frm_datosEncuestaDoctorado #v_Municipio').html(data.combo_municipios);
                $('#frm_datosEncuestaDoctorado #v_coloniafracc').html(data.combo_colonias);

                //datos del egresado 
                //si es que tiene jejeje
                $('#frm_datosEncuestaDoctorado #fk_estadoTitulacion').val(data.fk_estadoTitulacion);
                $('#frm_datosEncuestaDoctorado #estatusTrabajo').val(data.estatusTrabajo);
                $('#frm_datosEncuestaDoctorado #correoTrabajo').val(data.correoTrabajo);
                $('#frm_datosEncuestaDoctorado #nombreJefeInmediato').val(data.nombreJefeInmediato);
                $('#frm_datosEncuestaDoctorado #mtriaNombre').val(data.mtriaNombre);
                $('#frm_datosEncuestaDoctorado #mtriaInstitucion').val(data.mtriaInstitucion);
                $('#frm_datosEncuestaDoctorado #doctoradoNombre').val(data.doctoradoNombre);
                $('#frm_datosEncuestaDoctorado #doctoradoInstitucion').val(data.doctoradoInstitucion);
                $('#frm_datosEncuestaDoctorado #especialidadNombre').val(data.especialidadNombre);
                $('#frm_datosEncuestaDoctorado #especialidadInstitucion').val(data.especialidadInstitucion);
                $('#frm_datosEncuestaDoctorado #estatusCredencial').val(data.estatusCredencial);
                
                $('#frm_datosEncuestaDoctorado #pk_egresados').val(data.pk_egresados);
                
                
                
                
                $('#frm_datosEncuestaDoctorado #pk_encuestadoctorado ').val(data.pk_encuestadoctorado);
                $('#frm_datosEncuestaDoctorado #DA_Licenciatura').val(data.DA_Licenciatura);
                $('#frm_datosEncuestaDoctorado #DA_LicenciaturaInst').val(data.DA_LicenciaturaInst);
                $('#frm_datosEncuestaDoctorado #DA_Maestria').val(data.DA_Maestria);
                $('#frm_datosEncuestaDoctorado #DA_MaestriaInst').val(data.DA_MaestriaInst);
                $('#frm_datosEncuestaDoctorado #DA_Doctorado').val(data.DA_Doctorado);
                $('#frm_datosEncuestaDoctorado #DA_DoctoradoInst').val(data.DA_DoctoradoInst);
                $('#frm_datosEncuestaDoctorado #DA_Especialidad').val(data.DA_Especialidad);
                $('#frm_datosEncuestaDoctorado #DA_EspecialidadInst').val(data.DA_EspecialidadInst);
                $('#frm_datosEncuestaDoctorado #DL_TrabajaActualmente').val(data.DL_TrabajaActualmente);
                $('#frm_datosEncuestaDoctorado #DL_EmpresaColabora').val(data.DL_EmpresaColabora);
                $('#frm_datosEncuestaDoctorado #DL_PuestoDesempena').val(data.DL_PuestoDesempena);
                $('#frm_datosEncuestaDoctorado #DL_DireccionEmpresa').val(data.DL_DireccionEmpresa);
                $('#frm_datosEncuestaDoctorado #DL_TelefonoEmpresa').val(data.DL_TelefonoEmpresa);
             
               $('#frm_datosEncuestaDoctorado #DL_Mail').val(data.DL_Mail);
                $('#frm_datosEncuestaDoctorado #DL_JefeInmediato').val(data.DL_JefeInmediato);
                $('#frm_datosEncuestaDoctorado #DL_OpinionPlan').val(data.DL_OpinionPlan);
                $('#frm_datosEncuestaDoctorado #DL_CalifPlan').val(data.DL_CalifPlan);
                $('#frm_datosEncuestaDoctorado #DL_Satisfaccion').val(data.DL_Satisfaccion);
                
                
             
            }
        }
    });
    
}



function ModificarEmpleadores(pk_trabajador){
        $("#f_datosempleadores #v_empleador").val(pk_trabajador);
        $.ajax({
             url: pathEmpleadores + 'Con_empleadores.php',
             type: 'post',
             data: 'id=' + pk_trabajador,
             dataType: 'json',
             success: function(data) {

                 if (data.error == 'ok') {
                    $('#f_datosempleadores #v_fechaSolicitud').val(data.fechaSolicitud);
                    $('#f_datosempleadores #v_empresa').val(data.empresa);
                    $('#f_datosempleadores #v_nomSolicitante').val(data.nombreSolicitante);
                    $('#f_datosempleadores #v_puestoSolicitante').val(data.puetoSolicitante);
                    $('#f_datosempleadores #v_licenciatura').val(data.licenciatura);
                    $('#f_datosempleadores #v_puestoVacante').val(data.puestoVacante);                
                    $('#f_datosempleadores #v_numVacantes').val(data.numVacantes);
                    $('#f_datosempleadores #v_telefono').val(data.telefono);
                    $('#f_datosempleadores #v_email').val(data.email);
                    $('#f_datosempleadores #v_direccion').val(data.direccion);
                    $('#f_datosempleadores #v_sexo').val(data.sexo);
                 }
             }
         });
    
}






