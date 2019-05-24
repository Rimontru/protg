$(document).ready(function(e) {
    //busqueda alumnos certificacion a peticion    
$("#frm_busqueda_alumnos_certificados").submit(function() {  
 var str = $("#frm_busqueda_alumnos_certificados").serialize();
   $('#ListaConsulta').show();
   $('#FormularioEditarAlumno').hide();
	$.ajax({
		url: pathAlumnos +'lista_DatosAlumnosCert.php',
		type: 'post',
		data: str,
		beforeSend: function (){
				   $("#botonera").hide();
				   $("#loading-data").html("Procesando, espere por favor... <img src='assets/img/ajax-loaders/ajax-loader-1.gif'>");
				},
		success: function(data){
			if(data!=""){
			 
					$("#botonera").show();
					$("#loading-data").hide();
					 
					 $("#ListaConsulta").html(data);
					 $("#example_filter").hide();

			}
		}
	});
	return false;
});

$("#frm_busqueda_alumnos_timbres").submit(function() {  
 var str = $("#frm_busqueda_alumnos_timbres").serialize();
   $('#ListaConsulta').show();
   $('#FormularioEditarAlumno').hide();
	$.ajax({
		url: pathAlumnos +'lista_DatosAlumnosTimbre.php',
		type: 'post',
		data: str,
		beforeSend: function (){
				   $("#botonera").hide();
				   $("#loading-data").html("Procesando, espere por favor... <img src='assets/img/ajax-loaders/ajax-loader-1.gif'>");
				},
		success: function(data){
			if(data!=""){
			 
					$("#botonera").show();
					$("#loading-data").hide();
					 
					 $("#ListaConsulta").html(data);
					 $("#example_filter").hide();

			}
		}
	});
	return false;
});




$('#formulario_AlumnoModificar_Certificacion').submit(function(){
	var strData = $("#formulario_AlumnoModificar_Certificacion").serialize();
	window.open(pathCertificacion+'certificacionesDocumentosEgresadosPDF.php?'+strData);

return false;
});

$('#formulario_AlumnoModificar_RegistroTimbres').submit(function(){
	var strData = $("#formulario_AlumnoModificar_RegistroTimbres").serialize();
	$.ajax({
        url: pathTimbresSecretaria +'Ins_Timbres.php',
        type: 'post',
        data: strData,
        beforeSend: function (){
                   $("#botonera").hide();
                   $("#loading-data").html("Procesando, espere por favor... <img src='assets/img/ajax-loaders/ajax-loader-1.gif'>");
                },
        success: function(data){
        	console.log(data);
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
	

	$('#formulario_AlumnoModificar_Certificacion #fecha_examen').datepicker({dateFormat: "yy-mm-dd"});
 	$('#formulario_AlumnoModificar_Certificacion #fecha_certificado').datepicker({dateFormat: "yy-mm-dd"});
    $('#formulario_AlumnoModificar_Certificacion #hora_certificado').timepicker({dateFormat: "hh:mm"});


$("#form_nueva_preparatoria").submit(function(e) {  
	e.preventDefault();
 var str = $("#form_nueva_preparatoria").serialize();

	$.ajax({
		url: 'includes/ajax/Directorio/Ins_preparatoria.php',
		type: 'post',
		data: str,
		beforeSend: function (){
			$('#save').attr('disabled',true);
	   	$("small").show();
		},
		success: function(data){
			data.split("|");
			if(data[0] == 1)
				location.reload(true);
			else 
				console.log(data);
		}
	});

return false;
});


$("#form_editar_preparatoria").submit(function(e) {  
	e.preventDefault();
 var str = $("#form_editar_preparatoria").serialize();

	$.ajax({
		url: 'includes/ajax/Directorio/Mod_preparatoria.php',
		type: 'post',
		data: str,
		beforeSend: function (){
			$('#save').attr('disabled',true);
	   	$("small").show();
		},
		success: function(data){
			data.split("|");
			if(data[0] == 1)
				location.reload(true);
			else 
				console.log(data);
		}
	});

return false;
});


});


function showEdit(id_prepa){
	$("#form_editar_preparatoria")[0].reset;
	if (id_prepa != 0) {

		$.ajax({
			url: 'includes/ajax/Directorio/Cons_preparatoria.php',
			type: 'post',
			data: "id_prepa="+id_prepa,
			dataType: 'json',
			success: function(data){
				//console.log(data);
				if(data.msg == 1)
				{					
					$("#form_editar_preparatoria #pk_prepa").val(data.pk_prepa);
					$("#form_editar_preparatoria #nomb_prepa").val(data.nomb_prepa);
					$('#form_editar_preparatoria #plantel').val(data.plantel);
					$('#form_editar_preparatoria #turno').val(data.turno);
					$('#form_editar_preparatoria #ciudad').val(data.ciudad);
					$('#form_editar_preparatoria #direccion').val(data.direccion);
					$('#form_editar_preparatoria #email').val(data.email);
					$('#form_editar_preparatoria #telefonos').val(data.telefonos);
					$('#form_editar_preparatoria #persona_atiende').val(data.persona_atiende);
					$('#form_editar_preparatoria #cargo_persona').val(data.cargo_persona);
				}
				else 
					console.log(data);
			}
		});
	}	
}




