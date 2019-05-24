$(document).ready(function() {

    //obtener carreras por modalidad
     $("#f_ReporteSinodalesCarrera #fk_modalidad").change(function () {
        $("#f_ReporteSinodalesCarrera #fk_modalidad option:selected").each(function () {
           indiceElegido=$(this).val();
           elegido=$(this).text();
           var fk_nivelestudio = $("#f_ReporteSinodalesCarrera #fk_nivelestudio").val();
           if(indiceElegido!=""){
               
               
               if(fk_nivelestudio!=""){
                        $.ajax({
                            url: pathCarreras + 'Con_CarrerasModalidad.php',
                            type: 'post',
                            data: "ObtenerModalidad=ObtenerModalidad&fk_modalidad="+ indiceElegido + "&fk_nivelestudio="+fk_nivelestudio,
                            dataType: 'json',
                            success: function(data) {
                                if (data.Carreras != "Error") {
                                    $("#f_ReporteSinodalesCarrera #fk_carreras").html(data.Carreras);
                                }else{
                                     $("#f_ReporteSinodalesCarrera #fk_carreras").html("");
                                   $("#f_ReporteSinodalesCarrera #fk_carreras").select2("val", "");

                                }
                            }
                        });
                   
               }else{
                   $("#f_ReporteSinodalesCarrera #fk_modalidad").val("");
                    alertify.error("Seleccione el Nivel de Estudios.");
                    
               }
                
                
                
                
                
                
            }
            
        });     
    });
    
    
    
    
    
    
//    //obtener carreras por nivel de estudio
     $("#f_ReporteSinodalesCarrera #fk_nivelestudio").change(function () {
        $("#f_ReporteSinodalesCarrera #fk_nivelestudio option:selected").each(function () {
           indiceElegido=$(this).val();
           elegido=$(this).text();
           var fk_nivelestudio = $("#f_ReporteSinodalesCarrera #fk_nivelestudio").val();
           var fk_modalidad = $("#f_ReporteSinodalesCarrera #fk_modalidad").val();
           if(indiceElegido!=""){
               
               
               if(fk_nivelestudio!=""){
                        $.ajax({
                            url: pathCarreras + 'Con_CarrerasModalidad.php',
                            type: 'post',
                            data: "ObtenerModalidad=ObtenerModalidad&fk_modalidad="+ fk_modalidad + "&fk_nivelestudio="+fk_nivelestudio,
                            dataType: 'json',
                            success: function(data) {
                                if (data.Carreras != "Error") {
                                    $("#f_ReporteSinodalesCarrera #fk_carreras").html(data.Carreras);
                                }else{
                                     $("#f_ReporteSinodalesCarrera #fk_carreras").html("");
                                     $("#f_ReporteSinodalesCarrera #fk_carreras").select2("val", "");

                                }
                            }
                        });
                   
               }else{
                   $("#f_ReporteSinodalesCarrera #fk_modalidad").val("");
                    alertify.error("Seleccione el Nivel de Estudios.");
                    
               }
                
                
                
                
                
                
            }
            
        });     
    });


 

//****************Consulta para Formato de Pago Sinodales****************//

//obtener carreras por modalidad
     $("#f_ReporteSinodalesPago #fk_modalidad").change(function () {
        $("#f_ReporteSinodalesPago #fk_modalidad option:selected").each(function () {
           indiceElegido=$(this).val();
           elegido=$(this).text();
           var fk_nivelestudio = $("#f_ReporteSinodalesPago #fk_nivelestudio").val();
           if(indiceElegido!=""){
               
               
               if(fk_nivelestudio!=""){
                        $.ajax({
                            url: pathCarreras + 'Con_CarrerasModalidad.php',
                            type: 'post',
                            data: "ObtenerModalidad=ObtenerModalidad&fk_modalidad="+ indiceElegido + "&fk_nivelestudio="+fk_nivelestudio,
                            dataType: 'json',
                            success: function(data) {
                                if (data.Carreras != "Error") {
                                    $("#f_ReporteSinodalesPago #fk_carreras").html(data.Carreras);
                                }else{
                                     $("#f_ReporteSinodalesPago #fk_carreras").html("");
                                     $("#f_ReporteSinodalesPago #fk_carreras").select2("val", "");

                                }
                            }
                        });
                   
               }else{
                   $("#f_ReporteSinodalesPago #fk_modalidad").val("");
                    alertify.error("Seleccione el Nivel de Estudios.");
                    
               }
                
                
                
                
                
                
            }
            
        });     
    });
    
    
    
    
    
    
//    //obtener carreras por modalidad
     $("#f_ReporteSinodalesPago #fk_nivelestudio").change(function () {
        $("#f_ReporteSinodalesPago #fk_nivelestudio option:selected").each(function () {
           indiceElegido=$(this).val();
           elegido=$(this).text();
           var fk_nivelestudio = $("#f_ReporteSinodalesPago #fk_nivelestudio").val();
           var fk_modalidad = $("#f_ReporteSinodalesPago #fk_modalidad").val();
           if(indiceElegido!=""){
               
               
               if(fk_nivelestudio!=""){
                        $.ajax({
                            url: pathCarreras + 'Con_CarrerasModalidad.php',
                            type: 'post',
                            data: "ObtenerModalidad=ObtenerModalidad&fk_modalidad="+ fk_modalidad + "&fk_nivelestudio="+fk_nivelestudio,
                            dataType: 'json',
                            success: function(data) {
                                if (data.Carreras != "Error") {
                                    $("#f_ReporteSinodalesPago #fk_carreras").html(data.Carreras);
                                }else{
                                     $("#f_ReporteSinodalesPago #fk_carreras").html("");
                                     $("#f_ReporteSinodalesPago #fk_carreras").select2("val", "");

                                }
                            }
                        });
                   
               }else{
                   $("#f_ReporteSinodalesPago #fk_modalidad").val("");
                    alertify.error("Seleccione el Nivel de Estudios.");
                    
               }
                
                
                
                
                
                
            }
            
        });     
    });


////****************Consulta para obtener oficio desinodales individuales****************//
////obtener carreras por modalidad
//     $("#f_ReporteSinodalesIndividual #fk_modalidad").change(function () {
//        $("#f_ReporteSinodalesIndividual #fk_modalidad option:selected").each(function () {
//           indiceElegido=$(this).val();
//           elegido=$(this).text();
//           var fk_nivelestudio = $("#f_ReporteSinodalesIndividual #fk_nivelestudio").val();
//           if(indiceElegido!=""){
//               
//               
//               if(fk_nivelestudio!=""){
//                        $.ajax({
//                            url: pathCarreras + 'Con_CarrerasModalidad.php',
//                            type: 'post',
//                            data: "ObtenerModalidad=ObtenerModalidad&fk_modalidad="+ indiceElegido + "&fk_nivelestudio="+fk_nivelestudio,
//                            dataType: 'json',
//                            success: function(data) {
//                                if (data.Carreras != "Error") {
//                                    $("#f_ReporteSinodalesIndividual #fk_carreras").html(data.Carreras);
//                                }else{
//                                     $("#f_ReporteSinodalesIndividual #fk_carreras").html("");
//                                      $("#f_ReporteSinodalesIndividual #fk_sinodal").select2("val", "");
//                                      $("#f_ReporteSinodalesIndividual #fk_carreras").select2("val", "");
//
//                                }
//                            }
//                        });
//                   
//               }else{
//                   $("#f_ReporteSinodalesIndividual #fk_modalidad").val("");
//                    alertify.error("Seleccione el Nivel de Estudios.");
//                    
//               }
//                
//                
//                
//                
//                
//                
//            }
//            
//        });     
//    });
//    
//    
//    
//    
//    
//    
////    //obtener carreras por modalidad
//     $("#f_ReporteSinodalesIndividual #fk_nivelestudio").change(function () {
//        $("#f_ReporteSinodalesIndividual #fk_nivelestudio option:selected").each(function () {
//           indiceElegido=$(this).val();
//           elegido=$(this).text();
//           var fk_nivelestudio = $("#f_ReporteSinodalesIndividual #fk_nivelestudio").val();
//           var fk_modalidad = $("#f_ReporteSinodalesIndividual #fk_modalidad").val();
//           if(indiceElegido!=""){
//               
//               
//               if(fk_nivelestudio!=""){
//                        $.ajax({
//                            url: pathCarreras + 'Con_CarrerasModalidad.php',
//                            type: 'post',
//                            data: "ObtenerModalidad=ObtenerModalidad&fk_modalidad="+ fk_modalidad + "&fk_nivelestudio="+fk_nivelestudio,
//                            dataType: 'json',
//                            success: function(data) {
//                                if (data.Carreras != "Error") {
//                                    $("#f_ReporteSinodalesIndividual #fk_carreras").html(data.Carreras);
//                                }else{
//                                     $("#f_ReporteSinodalesIndividual #fk_carreras").html("");
//                                     $("#f_ReporteSinodalesIndividual #fk_carreras").select2("val", "");
//                                     $("#f_ReporteSinodalesIndividual #fk_sinodal").select2("val", "");
//
//
//                                }
//                            }
//                        });
//                   
//               }else{
//                   $("#f_ReporteSinodalesIndividual #fk_modalidad").val("");
//                    alertify.error("Seleccione el Nivel de Estudios.");
//                    
//               }
//                
//                
//                
//                
//                
//                
//            }
//            
//        });  
//    });
//    
//    
//    //   obtener sinodales por carreras
//     $("#f_ReporteSinodalesIndividual #fk_carreras").change(function () {
//        $("#f_ReporteSinodalesIndividual #fk_carreras option:selected").each(function () {
//           indiceElegido=$(this).val();
//           elegido=$(this).text();
//           var fk_nivelestudio = $("#f_ReporteSinodalesIndividual #fk_nivelestudio").val();
//           var fk_modalidad = $("#f_ReporteSinodalesIndividual #fk_modalidad").val();
//           var fk_carreras = $("#f_ReporteSinodalesIndividual #fk_carreras").val();
//
//           if(indiceElegido!=""){   
//               if(fk_nivelestudio!=""){
//                        $.ajax({
//                            url: pathSinodales + 'Con_SinodalesModalidad.php',
//                            type: 'post',
//                            data: "ObtenerSinodal=ObtenerSinodal&fk_modalidad="+ fk_modalidad + "&fk_nivelestudio="+fk_nivelestudio + "&fk_carreras="+fk_carreras,
//                            dataType: 'json',
//                            success: function(data) {
//                                if (data.Sinodal != "Error") {
//                                    $("#f_ReporteSinodalesIndividual #fk_sinodal").html(data.Sinodal);
//                                }else{
//                                     $("#f_ReporteSinodalesIndividual #fk_sinodal").html("");
//                                     $("#f_ReporteSinodalesIndividual #fk_sinodal").select2("val", "");
//
//
//                                }
//                            }
//                        });
//                   
//               }else{
//                   $("#f_ReporteSinodalesIndividual #fk_modalidad").val("");
//                    alertify.error("Seleccione el Nivel de Estudios.");
//                    
//               }
//                
//                
//                
//                
//                
//                
//            }
////            
//        });  
//    });


    //se utiliza para la captura de resultados examen institucionales
    //obtener carreras por modalidad
     $("#f_GraficasEgresados #fk_modalidad").change(function () {
        $("#f_GraficasEgresados #fk_modalidad option:selected").each(function () {
           indiceElegido=$(this).val();
           elegido=$(this).text();
           var fk_nivelestudio = $("#f_GraficasEgresados #fk_nivelestudio").val();
           if(indiceElegido!=""){
               
               
               if(fk_nivelestudio!=""){
                        $.ajax({
                            url: pathCarreras + 'Con_CarrerasModalidad.php',
                            type: 'post',
                            data: "ObtenerModalidad=ObtenerModalidad&fk_modalidad="+ indiceElegido + "&fk_nivelestudio="+fk_nivelestudio,
                            dataType: 'json',
                            success: function(data) {
                                if (data.Carreras != "Error") {
                                    $("#f_GraficasEgresados #fk_carreras").html(data.Carreras);
                                }else{
                                     $("#f_GraficasEgresados #fk_carreras").html("");
                                }
                            }
                        });
                   
               }else{
                   $("#f_GraficasEgresados #fk_modalidad").val("");
                    alertify.error("Seleccione el Nivel de Estudios.");
                    
               }
                
                
                
                
                
                
            }
            
        });     
    });
    
    
    
    
    
    
    //obtener carreras por modalidad
     $("#f_GraficasEgresados #fk_nivelestudio").change(function () {
        $("#f_GraficasEgresados #fk_nivelestudio option:selected").each(function () {
           indiceElegido=$(this).val();
           elegido=$(this).text();
           var fk_nivelestudio = $("#f_GraficasEgresados #fk_nivelestudio").val();
           var fk_modalidad = $("#f_GraficasEgresados #fk_modalidad").val();
           if(indiceElegido!=""){
               
               
               if(fk_nivelestudio!=""){
                        $.ajax({
                            url: pathCarreras + 'Con_CarrerasModalidad.php',
                            type: 'post',
                            data: "ObtenerModalidad=ObtenerModalidad&fk_modalidad="+ fk_modalidad + "&fk_nivelestudio="+fk_nivelestudio,
                            dataType: 'json',
                            success: function(data) {
                                if (data.Carreras != "Error") {
                                    $("#f_GraficasEgresados #fk_carreras").html(data.Carreras);
                                }else{
                                     $("#f_GraficasEgresados #fk_carreras").html("");
                                }
                            }
                        });
                   
               }else{
                   $("#f_GraficasEgresados #fk_modalidad").val("");
                    alertify.error("Seleccione el Nivel de Estudios.");
                    
               }
                
                
                
                
                
                
            }
            
        });     
    });
    
	////////////////////////////////////////////////////////////MONKY*******************************************
	    //obtener carreras por modalidad
     $("#f_ReporteEgresadosTrabajadoresActivos #fk_modalidad").change(function () {
        $("#f_ReporteEgresadosTrabajadoresActivos #fk_modalidad option:selected").each(function () {
           indiceElegido=$(this).val();
           elegido=$(this).text();
           var fk_nivelestudio = $("#f_ReporteEgresadosTrabajadoresActivos #fk_nivelestudio").val();
           if(indiceElegido!=""){
               
               
               if(fk_nivelestudio!=""){
                        $.ajax({
                            url: pathCarreras + 'Con_CarrerasModalidad.php',
                            type: 'post',
                            data: "ObtenerModalidad=ObtenerModalidad&fk_modalidad="+ indiceElegido + "&fk_nivelestudio="+fk_nivelestudio,
                            dataType: 'json',
                            success: function(data) {
                                if (data.Carreras != "Error") {
                                    $("#f_ReporteEgresadosTrabajadoresActivos #fk_carreras").html(data.Carreras);
                                }else{
                                     $("#f_ReporteEgresadosTrabajadoresActivos #fk_carreras").html("");
                                }
                            }
                        });
                   
               }else{
                   $("#f_ReporteEgresadosTrabajadoresActivos #fk_modalidad").val("");
                    alertify.error("Seleccione el Nivel de Estudios.");
                    
               }
                
                
                
                
                
                
            }
            
        });     
    });
    
    //obtener carreras por modalidad
     $("#f_ReporteEgresadosTrabajadoresActivos #fk_nivelestudio").change(function () {
        $("#f_ReporteEgresadosTrabajadoresActivos #fk_nivelestudio option:selected").each(function () {
           indiceElegido=$(this).val();
           elegido=$(this).text();
           var fk_nivelestudio = $("#f_ReporteEgresadosTrabajadoresActivos #fk_nivelestudio").val();
           var fk_modalidad = $("#f_ReporteEgresadosTrabajadoresActivos #fk_modalidad").val();
           if(indiceElegido!=""){
               
               if(fk_nivelestudio!=""){
                        $.ajax({
                            url: pathCarreras + 'Con_CarrerasModalidad.php',
                            type: 'post',
                            data: "ObtenerModalidad=ObtenerModalidad&fk_modalidad="+ fk_modalidad + "&fk_nivelestudio="+fk_nivelestudio,
                            dataType: 'json',
                            success: function(data) {
                                if (data.Carreras != "Error") {
                                    $("#f_ReporteEgresadosTrabajadoresActivos #fk_carreras").html(data.Carreras);
                                }else{
                                     $("#f_ReporteEgresadosTrabajadoresActivos #fk_carreras").html("");
                                }
                            }
                        });
                   
               }else{
                   $("#f_ReporteEgresadosTrabajadoresActivos #fk_modalidad").val("");
                    alertify.error("Seleccione el Nivel de Estudios.");
                    
               }
            }
            
        });     
    });

	 //------------------------------------------------------BOTONES ESPECIALEs------------------------------------------------------- 
	
     $("#form_btn_especials #fk_modalidad").change(function () {
        $("#form_btn_especials #fk_modalidad option:selected").each(function () {
           indiceElegido=$(this).val();
           elegido=$(this).text();
           var fk_nivelestudio = $("#form_btn_especials #fk_nivelestudio").val();
           if(indiceElegido!=""){
               
               if(fk_nivelestudio!=""){
                        $.ajax({
                            url: pathCarreras + 'Con_CarrerasModalidad.php',
                            type: 'post',
                            data: "ObtenerModalidad=ObtenerModalidad&fk_modalidad="+ indiceElegido + "&fk_nivelestudio="+fk_nivelestudio,
                            dataType: 'json',
                            success: function(data) {
                                if (data.Carreras != "Error") {
                                    $("#form_btn_especials #fk_carreras").html(data.Carreras);
                                }else{
                                     $("#form_btn_especials #fk_carreras").html("");
                                }
                            }
                        });
               }else{
                   $("#form_btn_especials #fk_modalidad").val("");
                    alertify.error("Seleccione el Nivel de Estudios.");
               }
            }
            
        });     
    });
	
	$("#form_btn_especials #fk_nivelestudio").change(function () {
			$("#form_btn_especials #fk_nivelestudio option:selected").each(function () {
			   indiceElegido=$(this).val();
			   elegido=$(this).text();
			   var fk_nivelestudio = $("#form_btn_especials #fk_nivelestudio").val();
			   var fk_modalidad = $("#form_btn_especials #fk_modalidad").val();
			   if(indiceElegido!=""){
				   
				   if(fk_nivelestudio!=""){
							$.ajax({
								url: pathCarreras + 'Con_CarrerasModalidad.php',
								type: 'post',
								data: "ObtenerModalidad=ObtenerModalidad&fk_modalidad="+ fk_modalidad + "&fk_nivelestudio="+fk_nivelestudio,
								dataType: 'json',
								success: function(data) {
									if (data.Carreras != "Error") {
										$("#form_btn_especials #fk_carreras").html(data.Carreras);
									}else{
										 $("#form_btn_especials #fk_carreras").html("");
									}
								}
							});
					   
				   }else{
					   $("#form_btn_especials #fk_modalidad").val("");
						alertify.error("Seleccione el Nivel de Estudios.");
						
				   }
				}
				
			});     
		});

	
	$("#form_btn_especials #fk_carreras").change(function () {
		$("#form_btn_especials #fk_carreras option:selected").each(function () {
			var fk_carreras= $(this).val();
			var fk_nivelestudio = $("#form_btn_especials #fk_nivelestudio").val();
			var fk_modalidad = $("#form_btn_especials #fk_modalidad").val();
			var datas="ObtenerGeneraciones=ObtenerGeneraciones&fk_carreras="+fk_carreras+"&fk_modalidad="+fk_modalidad+"&fk_nivelestudio="+fk_nivelestudio;
			if(indiceElegido!=""){
			   if(fk_nivelestudio!=""){
						$.ajax({
							url: pathCarreras + 'Con_NoGeneracionesbyCar.php',
							type: 'post',
							data: datas,
							dataType: 'json',
							success: function(data) {
								if (data.Generaciones != "Error") {
									$("#form_btn_especials #fk_generacion").html(data.Generaciones);
								}else{
									 $("#form_btn_especials #fk_generacion").html("");
								}
							}
						});
			   }else{
				   $("#form_btn_especials #fk_carreras").val("");
					alertify.error("Seleccione el Nivel de Estudios.");
			   }
		   }
			
		});
    });

   
 //------------------------------------------------------COMPLETAR DATOS GENERACIONES------------------------------------------------------- 
  
     $("#f_completar_datos_generaciones #fk_modalidad").change(function () {
        $("#f_completar_datos_generaciones #fk_modalidad option:selected").each(function () {
           indiceElegido=$(this).val();
           elegido=$(this).text();
           var fk_nivelestudio = $("#f_completar_datos_generaciones #fk_nivelestudio").val();
           if(indiceElegido!=""){
               
               if(fk_nivelestudio!=""){
                        $.ajax({
                            url: pathCarreras + 'Con_CarrerasModalidad.php',
                            type: 'post',
                            data: "ObtenerModalidad=ObtenerModalidad&fk_modalidad="+ indiceElegido + "&fk_nivelestudio="+fk_nivelestudio,
                            dataType: 'json',
                            success: function(data) {
                                if (data.Carreras != "Error") {
                                    $("#f_completar_datos_generaciones #fk_carreras").html(data.Carreras);
                                }else{
                                     $("#f_completar_datos_generaciones #fk_carreras").html("");
                                }
                            }
                        });
               }else{
                   $("#f_completar_datos_generaciones #fk_modalidad").val("");
                    alertify.error("Seleccione el Nivel de Estudios.");
               }
            }
            
        });     
    });
  
  $("#f_completar_datos_generaciones #fk_nivelestudio").change(function () {
      $("#f_completar_datos_generaciones #fk_nivelestudio option:selected").each(function () {
         indiceElegido=$(this).val();
         elegido=$(this).text();
         var fk_nivelestudio = $("#f_completar_datos_generaciones #fk_nivelestudio").val();
         var fk_modalidad = $("#f_completar_datos_generaciones #fk_modalidad").val();
         if(indiceElegido!=""){
           
           if(fk_nivelestudio!=""){
              $.ajax({
                url: pathCarreras + 'Con_CarrerasModalidad.php',
                type: 'post',
                data: "ObtenerModalidad=ObtenerModalidad&fk_modalidad="+ fk_modalidad + "&fk_nivelestudio="+fk_nivelestudio,
                dataType: 'json',
                success: function(data) {
                  if (data.Carreras != "Error") {
                    $("#f_completar_datos_generaciones #fk_carreras").html(data.Carreras);
                  }else{
                     $("#f_completar_datos_generaciones #fk_carreras").html("");
                  }
                }
              });
             
           }else{
             $("#f_completar_datos_generaciones #fk_modalidad").val("");
            alertify.error("Seleccione el Nivel de Estudios.");
            
           }
        }
        
      });     
    });

  
  $("#f_completar_datos_generaciones #fk_carreras").change(function () {
    $("#f_completar_datos_generaciones #fk_carreras option:selected").each(function () {
      var fk_carreras= $(this).val();
      var fk_nivelestudio = $("#f_completar_datos_generaciones #fk_nivelestudio").val();
      var fk_modalidad = $("#f_completar_datos_generaciones #fk_modalidad").val();
      var datas="ObtenerGeneraciones=ObtenerGeneraciones&fk_carreras="+fk_carreras+"&fk_modalidad="+fk_modalidad+"&fk_nivelestudio="+fk_nivelestudio;
      if(indiceElegido!=""){
         if(fk_nivelestudio!=""){
            $.ajax({
              url: pathCarreras + 'Con_getFullGeneracionesbyCar.php',
              type: 'post',
              data: datas,
              dataType: 'json',
              success: function(data) {
                if (data.Generaciones != "Error") {
                  $("#f_completar_datos_generaciones #fk_generacion").html(data.Generaciones);
                }else{
                   $("#f_completar_datos_generaciones #fk_generacion").html("");
                }
              }
            });
         }else{
           $("#f_completar_datos_generaciones #fk_carreras").val("");
          alertify.error("Seleccione el Nivel de Estudios.");
         }
       }
      
    });
    });

   
    
});