$(document).ready(function(){

	$("#cmb_search").on("change", function(){
		var opcion = $("#cmb_search").val();
		if(opcion != ""){
			if(opcion == 3){
				$.ajax({
					type: 'POST',
					url: pathModegresados+"fa_busGeneracion.php",	
					beforeSend: function (){
                              $("#cont_search").html("Procesando, espere por favor... <img src='assets/img/ajax-loaders/ajax-loader-1.gif'>");
                           },				  
					error:function(XMLHttpRequest, textStatus, errorThrown){
						var error;
						if (XMLHttpRequest.status === 404) error="Pagina no existe"+XMLHttpRequest.status;// display some page not found error 
						if (XMLHttpRequest.status === 500) error="Error del Servidor"+XMLHttpRequest.status; // display some server error 
						$('#cont_search').html('<div class="alert_error">'+error+'</div>');						  
					},
					success:function(data){
						$("#cont_search").html(data);
					}
				});	
			}else{
				var etiquet = '';
				if(opcion == 1){ etiquet = "Nombre completo"; pleacehold = 'Nombres    Apellido Paterno   Apellido Materno ';  value=''; type='text';}
        if(opcion == 2){ etiquet = "Matrícula"; pleacehold = 'Introduce Número de control'; value=''; type='text';}
				if(opcion == 4){ etiquet = "<b>LISTA DEFUNCIONES</b>"; pleacehold = ''; value='2'; type='hidden';}
				$("#cont_search").html('<div class="form-group"><label class="col-sm-2 control-label">'+etiquet+'</label><div class="col-sm-6"><input id="txt_parametro" name="txt_parametro" type="'+type+'" class="form-control" placeholder="'+pleacehold+'" value="'+value+'"></div></div>');
			}	

		}else{
			$("#cont_search").html('');
			$("#btn_busqueda").attr('disabled','disabled');
		}
     $("#btn_busqueda").removeAttr('disabled','disabled');    
	});

 


	$("#f_busqueda").submit(function() {			
     var str = $("#f_busqueda").serialize();	
        $.ajax({
            url: pathEgresados +'list_busqueda.php',
            type: 'post',
            data: str,
            beforeSend: function (){
                       $("#botonera").hide();
                       $("#loading-data").html("Procesando, espere por favor... <img src='assets/img/ajax-loaders/ajax-loader-1.gif'>");
                    },
            success: function(data){
                $("#botonera").show("slow");
                $("#loading-data").html("");
                $('#resul_busqueda').html(data);
            }
        });
        return false;
    });




	 //obtener carreras por modalidad
     $("#f_busqueda #txt_modalidad").change(function () {
        $("#f_busqueda #txt_modalidad option:selected").each(function () {
           indiceElegido=$(this).val();
           var fk_nivelestudio = $("#f_busqueda #txt_nivelestudio").val();
           if(indiceElegido!=""){              
               if(fk_nivelestudio!=""){
                        $.ajax({
                            url: pathCarreras + 'Con_CarrerasModalidad.php',
                            type: 'post',
                            data: "ObtenerModalidad=ObtenerModalidad&fk_modalidad="+ indiceElegido + "&fk_nivelestudio="+fk_nivelestudio,
                            dataType: 'json',
                            success: function(data) {
                                if (data.Municipios != "Error") {
                                    $("#txt_carrera").html(data.Carreras);
                                }else{
                                     $("#txt_carrera").html("");
                                }
                            }
                        });
                   
               }else{
                    alertify.error("Seleccione el Nivel de Estudios.");
               }    
            }
            
        });     
    });
	//termina metodo parta cargar carreras 

	$("#f_busqueda #txt_nivelestudio").change(function(){
		$("#f_busqueda #txt_modalidad").val("");
	});


});


