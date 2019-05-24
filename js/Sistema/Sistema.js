$(document).ready(function() {

//---------------------------MONKY--------------------------------------
$("#ReporteGraficaTituladosPorAnio").click(function() {
    var fk_nivelestudio = $('#fk_nivelestudio').val();
    var fk_modalidad = $('#fk_modalidad').val();
    var fk_carreras = $('#fk_carreras').val();
    window.open('includes/ajax/Egresados/Reportes/monk/GraficaEgresadosTituladosPorAnio.php?fk_nivelestudio=' + fk_nivelestudio + "&fk_modalidad=" + fk_modalidad + "&fk_carreras=" + fk_carreras);
});


$("#frm_cargarFull_titulos #frmTitu").click(function(event){
	stringDatas = $("#frm_cargarFull_titulos").serialize();
	$.ajax({
		url:'modulos/Extras/Titulos/creaArregloConSession.php',
		type: 'POST',
		data: stringDatas,
		beforeSend: function(){
			$("#ListaConsulta").html("Procesando, espere por favor... <img src='assets/img/ajax-loaders/ajax-loader-1.gif'>");
        },
		error:function(XMLHttpRequest, textStatus, errorThrown){
			var error;
			if (XMLHttpRequest.status === 404) error="Pagina no existe"+XMLHttpRequest.status;// display some page not found error
			if (XMLHttpRequest.status === 500) error="Error del Servidor"+XMLHttpRequest.status; // display some server error
			$('#ListaConsulta').html('<div class="alert_error">'+error+'</div>');
		},
		success: function(request){
            $("#frm_cargarFull_titulos #foja").val('');
            $("#frm_cargarFull_titulos #matricula").focus().val('');
			$('#ListaConsulta').html(request);
		}
	});
});


$("#frm_cargarFull_titulos #cancelarTitulos").click(function(event){
	$.ajax({
		url:'modulos/Extras/Titulos/creaArregloConSession.php?Del=1',
		beforeSend: function(){
			$("#ListaConsulta").html("Procesando, espere por favor... <img src='assets/img/ajax-loaders/ajax-loader-1.gif'>");
        },
		error:function(XMLHttpRequest, textStatus, errorThrown){
			var error;
			if (XMLHttpRequest.status === 404) error="Pagina no existe"+XMLHttpRequest.status;// display some page not found error
			if (XMLHttpRequest.status === 500) error="Error del Servidor"+XMLHttpRequest.status; // display some server error
			$('#ListaConsulta').html('<div class="alert_error">'+error+'</div>');
		},
		success: function(request){
			$('#ListaConsulta').html("");
			$('#frm_cargarFull_titulos')[0].reset();
			$('#matricula').focus();
		}
	});
});


$("#form_btn_especials #btnEspeciales").click(function(event) {
		event.preventDefault();
        var fk_nivelestudio = $('#form_btn_especials #fk_nivelestudio').val();
        var fk_modalidad = $('#form_btn_especials #fk_modalidad').val();
        var fk_carreras = $('#form_btn_especials #fk_carreras').val();
		var Generacioncorte= $('#form_btn_especials #fk_generacion').val();

        window.open('includes/ajax/Egresados/Reportes/ReporteEspecialMedEnferOdon.php?fk_nivelestudio=' + fk_nivelestudio + "&fk_modalidad=" + fk_modalidad + "&fk_carreras=" + fk_carreras + "&Generacioncorte="+Generacioncorte);
 });
//BOTONES ESPECIALES NUEVO FORMULARIO



   $('#uploadfiles').click(function() {
        var matricula = $("#matricula_desc").val();

            $("#mensaje-foto").html('<div class="alert alert-dismissable alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><p>Recarge el Navegador para visualizar la imagen.</p><br /></div>')


    });


    $("#f_datosalumnos #v_estado").select2({width: 'resolve'});
    $("#f_datosalumnos #v_Municipio").select2({width: 'resolve'});
    $("#f_datosalumnos #v_coloniafracc").select2({width: 'resolve'});
    $("#f_datosalumnos #fk_carreras").select2({width: 'resolve'});
    $("#f_datosalumnos #FechaNacimiento").datepicker({dateFormat: "dd/mm/yy"});

//$("#frm_datosAlumnoModificar #v_estado").select2({width: 'resolve'});
//$("#frm_datosAlumnoModificar #v_Municipio").select2({width: 'resolve'});
//$("#frm_datosAlumnoModificar #v_coloniafracc").select2({width: 'resolve'});
//$("#frm_datosAlumnoModificar #fk_carreras").select2({width: 'resolve'});
    $("#frm_datosAlumnoModificar #FechaNacimiento").datepicker({dateFormat: "dd/mm/yy"});
//
//EXAMEN INSTITUCIONAL
    $("#frm_AltaExamenInstitucional #fechaaplicacion").datepicker({dateFormat: "dd/mm/yy"});


//TOMA PROTESTA Y sinodales
    $("#frm_AltaTomaProtesta #FechaTomaProtesta").datepicker({dateFormat: "dd/mm/yy"});
    $('#frm_AltaTomaProtesta #hora').timepicker();
    $("#frm_AltaTomaProtesta #presidente").select2({width: 'resolve'});
    $("#frm_AltaTomaProtesta #secretario").select2({width: 'resolve'});
    $("#frm_AltaTomaProtesta #vocal").select2({width: 'resolve'});
    $("#frm_AltaTomaProtesta #suplente").select2({width: 'resolve'});


//TOMA PROTESTA sECRETARIA EDUCACION
    $("#frm_SecretariaEducacion #FechaTomaProtesta").datepicker({dateFormat: "dd/mm/yy"});
    $('#frm_SecretariaEducacion #hora').timepicker();
    $("#frm_SecretariaEducacion #presidente").select2({width: 'resolve'});
    $("#frm_SecretariaEducacion #secretario").select2({width: 'resolve'});
    $("#frm_SecretariaEducacion #vocal").select2({width: 'resolve'});
    $("#frm_SecretariaEducacion #suplente").select2({width: 'resolve'});
//segunda parte
    $("#frm_SecretariaEducacion #FechaSolicitud").datepicker({dateFormat: "dd/mm/yy"});
    $("#frm_SecretariaEducacion #FechaExamen").datepicker({dateFormat: "dd/mm/yy"});

//egresados
    $("#frm_datosAlumnoModificar #fechaexpediciontitulo").datepicker({dateFormat: "dd/mm/yy"});
    $("#frm_datosAlumnoModificar #FechaTomaProtesta").datepicker({dateFormat: "dd/mm/yy"});
    $("#frm_datosAlumnoModificar #fechaEntregaCredencial").datepicker({dateFormat: "dd/mm/yy"});


//rango de fechas
    $('#rangoFechas').daterangepicker({timePicker: true, format: 'DD/MM/YYYY'});

//reporte de invitacion a sinodal
  $('#f_ReporteInvitacion #cmb_sinodal').select2({width: 'resolve'});
  $('#f_ReporteInvitacion #txt_fechaToma').datepicker({dateFormat: "dd/mm/yy"});

  $("#fechacumple").datepicker({dateFormat: "dd/mm/yy"});
//reporte egresados titulacion
// $("#f_ReporteEgresadosTitulacion #fk_carreras").select2({width: 'resolve'});


 //encuesta medicina
//  $("#frm_datosEncuestaMedicina #v_estado").select2({width: 'resolve'});
//    $("#frm_datosEncuestaMedicina #v_Municipio").select2({width: 'resolve'});
//    $("#frm_datosEncuestaMedicina #v_coloniafracc").select2({width: 'resolve'});
  $("#frm_datosEncuestaMedicina #FechaNacimiento").datepicker({dateFormat: "dd/mm/yy"});
  $("#frm_datosEncuestaMedicina #CertificacionProfesionalFecha").datepicker({dateFormat: "dd/mm/yy"});
 $("#frm_datosEncuestaMedicina #AnoInicioLicenciatura").select2({width: 'resolve'});
 $("#frm_datosEncuestaMedicina #AnoFinLicenciatura").select2({width: 'resolve'});
 $("#frm_datosEncuestaMedicina #fk_gradosatisfaccion").select2({width: 'resolve'});

//
//    $("#Usuario_Modificar_Consulta").submit(function() {
//
//        var str = $("#Usuario_Modificar_Consulta").serialize();
//        //alert(str);
//        $.ajax({
//            url: pathUsuarios + 'Con_Usuario.php',
//            type: 'post',
//            data: str,
//            success: function(data) {
//                //alert(data);
//                var validar = data.split("|");
//                if (validar[0] != "2") {
//                    $("#BuscarUsuarioModificar").slideUp();
//                    $('#DatosUsuarioModificar').slideDown();
//                    var resultados = data.split("|");
//                    $("#Usuario_Modificar #Nombre").val(resultados[0]);
//                    $("#Usuario_Modificar #Apellido_Paterno").val(resultados[1]);
//                    $("#Usuario_Modificar #Apellido_Materno").val(resultados[2]);
//                    $("#Usuario_Modificar #Fk_Empresa").val(resultados[3]);
//                    $("#Usuario_Modificar #Correo").val(resultados[4]);
//                    $("#Usuario_Modificar #Usuario").val(resultados[5]);
//                    $("#Usuario_Modificar #Password").val(resultados[6]);
//                    $("#Usuario_Modificar #PasswordRepite").val(resultados[6]);
//
//                    $("#Usuario_Modificar #Password").attr('disabled', true);
//                    $("#Usuario_Modificar #PasswordRepite").attr('disabled', true);
//
//                    $("#Usuario_Modificar #Pk_Usuario_Login").val(resultados[9]);
//                    $("#Usuario_Modificar #Status_User").val(resultados[10]);
//
//                    var modulos = resultados[7];
//                    var permisos = resultados[8];
//
//                    cantidad_pesos = permisos.split('$').length - 1;
//                    cantidad_pesos = cantidad_pesos + 2;
//
//                    $.ajax({
//                        data: str,
//                        url: pathUsuarios + 'Con_UsuarioModulosModificar.php',
//                        type: 'post',
//                        success: function(data) {
//                            $("#asigna-permisos-modificar").append(data);
//                        }
//                    });
//
//
//
//                } else {
//                    $("#mensaje_error").html(validar[1]);
//                    mensaje_sistema_error();
//                }
//            }
//        });
//
//        return false;
//
//    }); //fin del submit
//
//







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


//REPORTES DE EGRESADOS
  $("#imprimirReporteEgresadosTitulos").click(function() {
        var fk_nivelestudio = $('#fk_nivelestudio').val();
        var fk_modalidad = $('#fk_modalidad').val();
        var fk_carreras = $('#fk_carreras').val();
        var fk_generacion = $('#fk_generacion').val();
         var fk_estadoTitulacion = $('#fk_estadoTitulacion').val();

        window.open('includes/ajax/Egresados/Reportes/ReporteEgresadosTitulos.php?fk_nivelestudio=' + fk_nivelestudio + "&fk_modalidad=" + fk_modalidad + "&fk_carreras=" + fk_carreras + "&fk_generacion=" + fk_generacion+ "&fk_estadoTitulacion=" + fk_estadoTitulacion);
 });

   $("#ReporteTodaslasGeneraciones").click(function() {
        var fk_nivelestudio = $('#fk_nivelestudio').val();
        var fk_modalidad = $('#fk_modalidad').val();
        var fk_carreras = $('#fk_carreras').val();
        var fk_generacion = $('#fk_generacion').val();
         var fk_estadoTitulacion = $('#fk_estadoTitulacion').val();

        window.open('includes/ajax/Egresados/Reportes/TodaslasGeneraciones.php?fk_nivelestudio=' + fk_nivelestudio + "&fk_modalidad=" + fk_modalidad + "&fk_carreras=" + fk_carreras + "&fk_generacion=" + fk_generacion+ "&fk_estadoTitulacion=" + fk_estadoTitulacion);
 });


    $("#ReporteTablaGeneraciones").click(function() {
        var fk_nivelestudio = $('#fk_nivelestudio').val();
        var fk_modalidad = $('#fk_modalidad').val();
        var fk_carreras = $('#fk_carreras').val();
        var fk_generacion = $('#fk_generacion').val();
         var fk_estadoTitulacion = $('#fk_estadoTitulacion').val();

        window.open('includes/ajax/Egresados/Reportes/ReporteTablaGeneraciones.php?fk_nivelestudio=' + fk_nivelestudio + "&fk_modalidad=" + fk_modalidad + "&fk_carreras=" + fk_carreras + "&fk_generacion=" + fk_generacion+ "&fk_estadoTitulacion=" + fk_estadoTitulacion);
 });


 $("#ReporteUltimasGeneraciones").click(function() {
        var fk_nivelestudio = $('#fk_nivelestudio').val();
        var fk_modalidad = $('#fk_modalidad').val();
        var fk_carreras = $('#fk_carreras').val();
        var fk_generacion = $('#fk_generacion').val();
         var fk_estadoTitulacion = $('#fk_estadoTitulacion').val();

        window.open('includes/ajax/Egresados/Reportes/ReporteComparacionUltimasGeneraciones.php?fk_nivelestudio=' + fk_nivelestudio + "&fk_modalidad=" + fk_modalidad + "&fk_carreras=" + fk_carreras + "&fk_generacion=" + fk_generacion+ "&fk_estadoTitulacion=" + fk_estadoTitulacion);
 });


 $("#alumnosNoTitulados").click(function(){
    var nivel = $("#fk_nivelestudio").val();
    var modalidad = $("#fk_modalidad").val();
    var estadoTitulo = $("#fk_estadoTitulacion").val();

    if(nivel == ''){
        alertify.error("Por favor selecciona una de las opciones de <strong>Nivel de Estudio </strong> para poder generar el reporte ");
        $("#fk_nivelestudio").closest('.form-group').addClass('has-error');
    }else if(modalidad == ''){
        alertify.error("Por favor selecciona una de las opciones de <strong>Modalidad</strong> para poder generar el reporte ");
         $("#fk_modalidad").closest('.form-group').addClass('has-error');
    }else if(estadoTitulo == '' ){
        alertify.error("Por favor selecciona una de las opciones de <strong>Estado de Titulación</strong> para poder generar el reporte ");
         $("#fk_estadoTitulacion").closest('.form-group').addClass('has-error');
    }else{
        $("#fk_nivelestudio").closest('.form-group').removeClass('has-error');
        $("#fk_modalidad").closest('.form-group').removeClass('has-error');
        $("#fk_estadoTitulacion").closest('.form-group').removeClass('has-error');
          window.open('includes/ajax/Egresados/Reportes/egresadosEstadotitulacion.php?nivel='+nivel + "&modalidad=" + modalidad+'&estadoTitulo='+estadoTitulo);
    }

 });

//REPORTES DE EGRESADOS



    $("#ReporteAlumnosTituloExpedido").click(function() {
        var fk_nivelestudio = $('#f_ReporteEgresadosTitulacionSegundaParte #fk_nivelestudio').val();
        var fk_modalidad = $('#f_ReporteEgresadosTitulacionSegundaParte #fk_modalidad').val();
        var fk_carreras = $('#f_ReporteEgresadosTitulacionSegundaParte #fk_carreras').val();
        var rangoFechas = $('#f_ReporteEgresadosTitulacionSegundaParte #rangoFechas').val();

        window.open('includes/ajax/Egresados/Reportes/ReporteAlumnosTituloExpedido.php?fk_nivelestudio=' + fk_nivelestudio + "&fk_modalidad=" + fk_modalidad + "&fk_carreras=" + fk_carreras + "&rangoFechas=" + rangoFechas);
 });
/* $("#f_ReporteEgresadosTitulacionSegundaParte").submit(function() {

       return false;
});*/

   $("#CantidadAlumnosTitulados").click(function() {

        var fk_nivelestudio = $('#f_ReporteEgresadosTitulacionSegundaParte #fk_nivelestudio').val();
        var fk_modalidad = $('#f_ReporteEgresadosTitulacionSegundaParte #fk_modalidad').val();
        var fk_carreras = $('#f_ReporteEgresadosTitulacionSegundaParte #fk_carreras').val();
        var fk_generacion = $('#f_ReporteEgresadosTitulacionSegundaParte #fk_generacion').val();
        var rangoFechas = $('#f_ReporteEgresadosTitulacionSegundaParte #rangoFechas').val();

        window.open('includes/ajax/Egresados/Reportes/CantidadDeAlumnosTitulados.php?fk_nivelestudio=' + fk_nivelestudio + "&fk_modalidad=" + fk_modalidad + "&fk_carreras=" + fk_carreras + "&fk_generacion=" + fk_generacion + "&rangoFechas=" + rangoFechas);
 });




 $("#AlumnosTituladosEdad").click(function() {

        var fk_nivelestudio = $('#f_ReporteEgresadosTitulacionSegundaParte #fk_nivelestudio').val();
        var fk_modalidad = $('#f_ReporteEgresadosTitulacionSegundaParte #fk_modalidad').val();
        var fk_carreras = $('#f_ReporteEgresadosTitulacionSegundaParte #fk_carreras').val();
        var fk_generacion = $('#f_ReporteEgresadosTitulacionSegundaParte #fk_generacion').val();
        var rangoFechas = $('#f_ReporteEgresadosTitulacionSegundaParte #rangoFechas').val();

        window.open('includes/ajax/Egresados/Reportes/CantidadDeAlumnosTituladosByEdad.php?fk_nivelestudio=' + fk_nivelestudio + "&fk_modalidad=" + fk_modalidad + "&fk_carreras=" + fk_carreras + "&fk_generacion=" + fk_generacion + "&rangoFechas=" + rangoFechas);
 });



//REPORTES DE EGRESADOS

 //tercera seccion

    $("#TablaGeneralAlumnosEgresadosTitulados").click(function() {

        var fk_nivelestudio = $('#f_ReporteEgresadosTitulacionTerceraParte #fk_nivelestudio').val();
        var fk_modalidad = $('#f_ReporteEgresadosTitulacionTerceraParte #fk_modalidad').val();
        var fk_carreras = $('#f_ReporteEgresadosTitulacionTerceraParte #fk_carreras').val();
         var fk_generacion = $('#f_ReporteEgresadosTitulacionTerceraParte #fk_generacion').val();

        window.open('includes/ajax/Egresados/Reportes/TablaGeneralAlumnosEgresadosTitulados.php?fk_nivelestudio=' + fk_nivelestudio + "&fk_modalidad=" + fk_modalidad + "&fk_carreras=" + fk_carreras + "&fk_generacion=" + fk_generacion);
    });

    $("#f_ReporteEgresadosTitulacionTerceraParte").submit(function() {

       return false;
    });

    $("#reporteLaboralGeneracion").click(function() {

        var fk_nivelestudio = $('#f_ReporteEgresadosTitulacionTerceraParte #fk_nivelestudio').val();
        var fk_modalidad = $('#f_ReporteEgresadosTitulacionTerceraParte #fk_modalidad').val();
        var fk_carreras = $('#f_ReporteEgresadosTitulacionTerceraParte #fk_carreras').val();

        window.open('includes/ajax/Egresados/Reportes/ReporteTablaLaborandoEspecialGeneraciones.php?fk_nivelestudio=' + fk_nivelestudio + "&fk_modalidad=" + fk_modalidad + "&fk_carreras=" + fk_carreras );
    });
//REPORTES DE EGRESADOS



//reportes de la segundapagina protg anteriore
//todo lo relacionado a alumno
   $("#btnReporteInformacionPersonalPDF").click(function() {

        var fk_nivelestudio = $('#f_ReporteEgresadosTitulacionTerceraParte #fk_nivelestudio').val();
        var fk_modalidad = $('#f_ReporteEgresadosTitulacionTerceraParte #fk_modalidad').val();
        var fk_carreras = $('#f_ReporteEgresadosTitulacionTerceraParte #fk_carreras').val();
         var fk_generacion = $('#f_ReporteEgresadosTitulacionTerceraParte #fk_generacion').val();
         var fk_estadoTitulacion = $('#f_ReporteEgresadosTitulacionTerceraParte #fk_estadoTitulacion').val();

        window.open('includes/ajax/Egresados/Reportes/ReporteInformacionPersonalPDF.php?fk_nivelestudio=' + fk_nivelestudio + "&fk_modalidad=" + fk_modalidad + "&fk_carreras=" + fk_carreras + "&fk_generacion=" + fk_generacion + "&fk_estadoTitulacion=" + fk_estadoTitulacion);
 });

   $("#btnReporteInformacionPersonalXLS").click(function() {

        var fk_nivelestudio = $('#f_ReporteEgresadosTitulacionTerceraParte #fk_nivelestudio').val();
        var fk_modalidad = $('#f_ReporteEgresadosTitulacionTerceraParte #fk_modalidad').val();
        var fk_carreras = $('#f_ReporteEgresadosTitulacionTerceraParte #fk_carreras').val();
         var fk_generacion = $('#f_ReporteEgresadosTitulacionTerceraParte #fk_generacion').val();
         var fk_estadoTitulacion = $('#f_ReporteEgresadosTitulacionTerceraParte #fk_estadoTitulacion').val();

        window.open('includes/ajax/Egresados/Reportes/ReporteInformacionPersonalXLS.php?fk_nivelestudio=' + fk_nivelestudio + "&fk_modalidad=" + fk_modalidad + "&fk_carreras=" + fk_carreras + "&fk_generacion=" + fk_generacion + "&fk_estadoTitulacion=" + fk_estadoTitulacion);
 });




   $("#btnReporteAcademicoPDF").click(function() {

        var fk_nivelestudio = $('#f_ReporteEgresadosTitulacionTerceraParte #fk_nivelestudio').val();
        var fk_modalidad = $('#f_ReporteEgresadosTitulacionTerceraParte #fk_modalidad').val();
        var fk_carreras = $('#f_ReporteEgresadosTitulacionTerceraParte #fk_carreras').val();
         var fk_generacion = $('#f_ReporteEgresadosTitulacionTerceraParte #fk_generacion').val();

        window.open('includes/ajax/Egresados/Reportes/btnReporteAcademicoPDF.php?fk_nivelestudio=' + fk_nivelestudio + "&fk_modalidad=" + fk_modalidad + "&fk_carreras=" + fk_carreras + "&fk_generacion=" + fk_generacion);
 });
  $("#btnReporteAcademicoXLS").click(function() {

        var fk_nivelestudio = $('#f_ReporteEgresadosTitulacionTerceraParte #fk_nivelestudio').val();
        var fk_modalidad = $('#f_ReporteEgresadosTitulacionTerceraParte #fk_modalidad').val();
        var fk_carreras = $('#f_ReporteEgresadosTitulacionTerceraParte #fk_carreras').val();
         var fk_generacion = $('#f_ReporteEgresadosTitulacionTerceraParte #fk_generacion').val();

        window.open('includes/ajax/Egresados/Reportes/btnReporteAcademicoXLS.php?fk_nivelestudio=' + fk_nivelestudio + "&fk_modalidad=" + fk_modalidad + "&fk_carreras=" + fk_carreras + "&fk_generacion=" + fk_generacion);
 });






   $("#btnreporteLaboralPDF").click(function() {

        var fk_nivelestudio = $('#f_ReporteEgresadosTitulacionTerceraParte #fk_nivelestudio').val();
        var fk_modalidad = $('#f_ReporteEgresadosTitulacionTerceraParte #fk_modalidad').val();
        var fk_carreras = $('#f_ReporteEgresadosTitulacionTerceraParte #fk_carreras').val();
         var fk_generacion = $('#f_ReporteEgresadosTitulacionTerceraParte #fk_generacion').val();

        window.open('includes/ajax/Egresados/Reportes/btnreporteLaboralPDF.php?fk_nivelestudio=' + fk_nivelestudio + "&fk_modalidad=" + fk_modalidad + "&fk_carreras=" + fk_carreras + "&fk_generacion=" + fk_generacion);
 });
  $("#btnreporteLaboralXLS").click(function() {

        var fk_nivelestudio = $('#f_ReporteEgresadosTitulacionTerceraParte #fk_nivelestudio').val();
        var fk_modalidad = $('#f_ReporteEgresadosTitulacionTerceraParte #fk_modalidad').val();
        var fk_carreras = $('#f_ReporteEgresadosTitulacionTerceraParte #fk_carreras').val();
         var fk_generacion = $('#f_ReporteEgresadosTitulacionTerceraParte #fk_generacion').val();

        window.open('includes/ajax/Egresados/Reportes/btnreporteLaboralXLS.php?fk_nivelestudio=' + fk_nivelestudio + "&fk_modalidad=" + fk_modalidad + "&fk_carreras=" + fk_carreras + "&fk_generacion=" + fk_generacion);
 });



   $("#reportePromedioPDF").click(function() {

        var fk_nivelestudio = $('#f_ReporteEgresadosTitulacionTerceraParte #fk_nivelestudio').val();
        var fk_modalidad = $('#f_ReporteEgresadosTitulacionTerceraParte #fk_modalidad').val();
        var fk_carreras = $('#f_ReporteEgresadosTitulacionTerceraParte #fk_carreras').val();
         var fk_generacion = $('#f_ReporteEgresadosTitulacionTerceraParte #fk_generacion').val();

        window.open('includes/ajax/Egresados/Reportes/reportePromedioPDF.php?fk_nivelestudio=' + fk_nivelestudio + "&fk_modalidad=" + fk_modalidad + "&fk_carreras=" + fk_carreras + "&fk_generacion=" + fk_generacion);
 });





   $("#reporteEdadTitulacion").click(function() {

        var fk_nivelestudio = $('#f_ReporteEgresadosTitulacionTerceraParte #fk_nivelestudio').val();
        var fk_modalidad = $('#f_ReporteEgresadosTitulacionTerceraParte #fk_modalidad').val();
        var fk_carreras = $('#f_ReporteEgresadosTitulacionTerceraParte #fk_carreras').val();
         var fk_generacion = $('#f_ReporteEgresadosTitulacionTerceraParte #fk_generacion').val();

        window.open('includes/ajax/Egresados/Reportes/reporteEdadTitulacion.php?fk_nivelestudio=' + fk_nivelestudio + "&fk_modalidad=" + fk_modalidad + "&fk_carreras=" + fk_carreras + "&fk_generacion=" + fk_generacion);
 });
   $("#ReporteCredencialesNoTramitadas").click(function() {

        var fk_nivelestudio = $('#f_ReporteEgresadosTitulacionTerceraParte #fk_nivelestudio').val();
        var fk_modalidad = $('#f_ReporteEgresadosTitulacionTerceraParte #fk_modalidad').val();
        var fk_carreras = $('#f_ReporteEgresadosTitulacionTerceraParte #fk_carreras').val();
         var fk_generacion = $('#f_ReporteEgresadosTitulacionTerceraParte #fk_generacion').val();

        window.open('includes/ajax/Egresados/Reportes/ReporteCredencialesNoTramitadas.php?fk_nivelestudio=' + fk_nivelestudio + "&fk_modalidad=" + fk_modalidad + "&fk_carreras=" + fk_carreras + "&fk_generacion=" + fk_generacion);
 });
   $("#ReporteCredencialesNoTramitadasXLS").click(function() {

        var fk_nivelestudio = $('#f_ReporteEgresadosTitulacionTerceraParte #fk_nivelestudio').val();
        var fk_modalidad = $('#f_ReporteEgresadosTitulacionTerceraParte #fk_modalidad').val();
        var fk_carreras = $('#f_ReporteEgresadosTitulacionTerceraParte #fk_carreras').val();
         var fk_generacion = $('#f_ReporteEgresadosTitulacionTerceraParte #fk_generacion').val();

        window.open('includes/ajax/Egresados/Reportes/ReporteCredencialesNoTramitadasXLS.php?fk_nivelestudio=' + fk_nivelestudio + "&fk_modalidad=" + fk_modalidad + "&fk_carreras=" + fk_carreras + "&fk_generacion=" + fk_generacion);
 });

//mi reporte de crendenciales entregadas anualmente
$("#ReporteCredencialesEntregadasAnuales").click(function(){
	 	var fk_nivelestudio = $('#f_ReporteEgresadosTitulacionTerceraParte #fk_nivelestudio').val();
        var fk_modalidad = $('#f_ReporteEgresadosTitulacionTerceraParte #fk_modalidad').val();

		var param  = '&fk_nivelestudio='+fk_nivelestudio;
			param += '&fk_modalidad='+fk_modalidad;

	alertify.prompt("Ingrese año... (0000)", function (e, str) {
		if(e){
			param += '&anhio='+str; //ay se va todo el chorizo de datos 4 parametros
			//alert(param);
			window.open('includes/ajax/Egresados/Reportes/ReporteCredencialesEntregadasAnuales.php?datas='+param);
		}

	}, "");
});


$("#ReporteCredencialesEntregadasTodas").click(function(){
        var fk_nivelestudio = $('#f_ReporteEgresadosTitulacionTerceraParte #fk_nivelestudio').val();
        var fk_modalidad = $('#f_ReporteEgresadosTitulacionTerceraParte #fk_modalidad').val();

        var param  = '&fk_nivelestudio='+fk_nivelestudio;
            param += '&fk_modalidad='+fk_modalidad;
    window.open('includes/ajax/Egresados/Reportes/ReporteCredencialesEntregadasTodas.php?datas='+param);
});


   $("#btnGrafica").click(function() {

        var fk_nivelestudio = $('#f_ReporteEgresadosTitulacionTerceraParte #fk_nivelestudio').val();
        var fk_modalidad = $('#f_ReporteEgresadosTitulacionTerceraParte #fk_modalidad').val();
        var fk_carreras = $('#f_ReporteEgresadosTitulacionTerceraParte #fk_carreras').val();
         var fk_generacion = $('#f_ReporteEgresadosTitulacionTerceraParte #fk_generacion').val();

        window.open('includes/ajax/Egresados/Reportes/btnGrafica.php?fk_nivelestudio=' + fk_nivelestudio + "&fk_modalidad=" + fk_modalidad + "&fk_carreras=" + fk_carreras + "&fk_generacion=" + fk_generacion);
 });


    ///reportes
    $("#imprimirReporteDocumentacionAl").click(function() {
        var fk_nivelestudio = $('#fk_nivelestudio').val();
        var fk_modalidad = $('#fk_modalidad').val();
        var fk_carreras = $('#fk_carreras').val();
        var rangoFechas = $('#rangoFechas').val();

        window.open('includes/ajax/Tramites/ExamenInstitucional/Reportes/ReporteDocumentacionAlumnos.php?fk_nivelestudio=' + fk_nivelestudio + "&fk_modalidad=" + fk_modalidad + "&fk_carreras=" + fk_carreras + "&rangoFechas=" + rangoFechas);

    });


    $("#f_AsignarFolios").submit(function() {

        var fk_nivelestudio = $('#fk_nivelestudio').val();
        var fk_modalidad = $('#fk_modalidad').val();
        var fk_carreras = $('#fk_carreras').val();
        var rangoFechas = $('#rangoFechas').val();


        param = "rangoFechas=" + rangoFechas;
        param += "&fk_nivelestudio=" + fk_nivelestudio;
        param += "&fk_modalidad=" + fk_modalidad;
        param += "&fk_carreras=" + fk_carreras;

        $.ajax({
            url: pathAsignarFolios + 'Reportes/ObtenerFoliosAlumnos.php',
            type: 'post',
            data: "Folios=Folios&" + param,
            success: function(data) {

                $("#divAsignacionFolios").show();
                $("#RespuestaLista").html(data);


            }
        });



        return false;
    });







//registro de asistencia

    $("#f_AsignarFolios").submit(function() {

        var fk_nivelestudio = $('#fk_nivelestudio').val();
        var fk_modalidad = $('#fk_modalidad').val();
        var fk_carreras = $('#fk_carreras').val();
        var rangoFechas = $('#rangoFechas').val();


        param = "rangoFechas=" + rangoFechas;
        param += "&fk_nivelestudio=" + fk_nivelestudio;
        param += "&fk_modalidad=" + fk_modalidad;
        param += "&fk_carreras=" + fk_carreras;

        $.ajax({
            url: pathAsignarFolios + 'Reportes/ObtenerFoliosAlumnos.php',
            type: 'post',
            data: "Folios=Folios&" + param,
            success: function(data) {

                $("#divAsignacionFolios").show();
                $("#RespuestaLista").html(data);


            }
        });



        return false;
    });

    $("#ReporteVerLista").click(function() {

        var fk_nivelestudio = $('#fk_nivelestudio').val();
        var fk_modalidad = $('#fk_modalidad').val();
        var fk_carreras = $('#fk_carreras').val();
        var rangoFechas = $('#rangoFechas').val();


        param = "rangoFechas=" + rangoFechas;
        param += "&fk_nivelestudio=" + fk_nivelestudio;
        param += "&fk_modalidad=" + fk_modalidad;
        param += "&fk_carreras=" + fk_carreras;

          window.open('includes/ajax/ServiciosEscolares/RegistroAsistencia/Reportes/ReporteRegistroAsistencia.php?'+param);



        return false;
    });



 $("#ReporteVerSabanaAutorizaciones").click(function() {

        var fk_nivelestudio = $('#fk_nivelestudio').val();
        var fk_modalidad = $('#fk_modalidad').val();
        var fk_carreras = $('#fk_carreras').val();
        var rangoFechas = $('#rangoFechas').val();


        param = "rangoFechas=" + rangoFechas;
        param += "&fk_nivelestudio=" + fk_nivelestudio;
        param += "&fk_modalidad=" + fk_modalidad;
        param += "&fk_carreras=" + fk_carreras;

if (fk_nivelestudio=='3'){
          window.open('includes/ajax/ServiciosEscolares/RegistroAsistencia/Reportes/SabanaAutorizacionesMaestria.php?'+param);

  }else if(fk_nivelestudio=='2'){
	  window.open('includes/ajax/ServiciosEscolares/RegistroAsistencia/Reportes/SabanaAutorizaciones.php?'+param);
	  }


        return false;
    });




   $("#ReporteVerRecortables").click(function() {

        var fk_nivelestudio = $('#fk_nivelestudio').val();
        var fk_modalidad = $('#fk_modalidad').val();
        var fk_carreras = $('#fk_carreras').val();
        var rangoFechas = $('#rangoFechas').val();


        param = "rangoFechas=" + rangoFechas;
        param += "&fk_nivelestudio=" + fk_nivelestudio;
        param += "&fk_modalidad=" + fk_modalidad;
        param += "&fk_carreras=" + fk_carreras;

          window.open('includes/ajax/ServiciosEscolares/RegistroAsistencia/Reportes/ReporteVerRecortables.php?'+param);



        return false;
    });


  $("#ReporteVerConstancia").click(function() {//MONKY******************************
	alertify.set({ labels: {
		ok     : "SI",
		cancel : "NO"
	}});

	alertify.prompt("<b>¿Ocuparà un duplicado de constancia?</b>", function (e, str) {
		if(e){//duplicado
			var fk_nivelestudio = $('#fk_nivelestudio').val();
			var fk_modalidad = $('#fk_modalidad').val();
			var fk_carreras = $('#fk_carreras').val();
			var rangoFechas = $('#rangoFechas').val();


			param = "rangoFechas=" + rangoFechas;
			param += "&fk_nivelestudio=" + fk_nivelestudio;
			param += "&fk_modalidad=" + fk_modalidad;
			param += "&fk_carreras=" + fk_carreras;
			param += "&cons_duplicado="+str;

			  window.open('includes/ajax/ServiciosEscolares/RegistroAsistencia/Reportes/ReporteVerConstancia.php?'+param);
		}
		else{//original
			var fk_nivelestudio = $('#fk_nivelestudio').val();
			var fk_modalidad = $('#fk_modalidad').val();
			var fk_carreras = $('#fk_carreras').val();
			var rangoFechas = $('#rangoFechas').val();


			param = "rangoFechas=" + rangoFechas;
			param += "&fk_nivelestudio=" + fk_nivelestudio;
			param += "&fk_modalidad=" + fk_modalidad;
			param += "&fk_carreras=" + fk_carreras;

			  window.open('includes/ajax/ServiciosEscolares/RegistroAsistencia/Reportes/ReporteVerConstancia.php?'+param);
	}



	},"DUPLICADO");



    return false;
    });







  $("#ReporteReporteCantidad").click(function() {

        var fk_nivelestudio = $('#fk_nivelestudio').val();
        var fk_modalidad = $('#fk_modalidad').val();
        var fk_carreras = $('#fk_carreras').val();
        var rangoFechas = $('#rangoFechas').val();


        param = "rangoFechas=" + rangoFechas;
        param += "&fk_nivelestudio=" + fk_nivelestudio;
        param += "&fk_modalidad=" + fk_modalidad;
        param += "&fk_carreras=" + fk_carreras;

        window.open('includes/ajax/ServiciosEscolares/RegistroAsistencia/Reportes/ReporteReporteCantidad.php?'+param);



        return false;
    });



  $("#ReporteServiciosEscolaresPDF").click(function() {

        var fk_nivelestudio = $('#fk_nivelestudio').val();
        var fk_modalidad = $('#fk_modalidad').val();
        var fk_carreras = $('#fk_carreras').val();
        var rangoFechas = $('#rangoFechas').val();


        param = "rangoFechas=" + rangoFechas;
        param += "&fk_nivelestudio=" + fk_nivelestudio;
        param += "&fk_modalidad=" + fk_modalidad;
        param += "&fk_carreras=" + fk_carreras;

        window.open('includes/ajax/ServiciosEscolares/RegistroAsistencia/Reportes/ReporteServiciosEscolaresPDF.php?'+param);



        return false;
    });




   //reporte resultados del examen institucional
  $("#ReporteResultadosExamenPDF").click(function() {

        var fk_nivelestudio = $('#fk_nivelestudio').val();
        var fk_modalidad = $('#fk_modalidad').val();
        var fk_carreras = $('#fk_carreras').val();
        var rangoFechas = $('#rangoFechas').val();


        param = "rangoFechas=" + rangoFechas;
        param += "&fk_nivelestudio=" + fk_nivelestudio;
        param += "&fk_modalidad=" + fk_modalidad;
        param += "&fk_carreras=" + fk_carreras;

        window.open('includes/ajax/ServiciosEscolares/RegistroAsistencia/Reportes/ReporteResultadosExamenPDF.php?'+param);



        return false;
    });

    $("#PublicarResultadosExamen").click(function() {

        var fk_nivelestudio = $('#fk_nivelestudio').val();
        var fk_modalidad = $('#fk_modalidad').val();
        var fk_carreras = $('#fk_carreras').val();
        var rangoFechas = $('#rangoFechas').val();

        param = "rangoFechas=" + rangoFechas;
        param += "&fk_nivelestudio=" + fk_nivelestudio;
        param += "&fk_modalidad=" + fk_modalidad;
        param += "&fk_carreras=" + fk_carreras;

        window.open('includes/ajax/ServiciosEscolares/RegistroAsistencia/Reportes/PublicarResultadosExamen.php?'+param);
        return false;
    });


    $("#EstadisticasResultadosExamen").click(function() {

        var fk_nivelestudio = $('#fk_nivelestudio').val();
        var fk_modalidad = $('#fk_modalidad').val();
        var rangoFechas = $('#rangoFechas').val();

        param = "rangoFechas=" + rangoFechas;
        param += "&fk_nivelestudio=" + fk_nivelestudio;
        param += "&fk_modalidad=" + fk_modalidad;

        window.open('includes/ajax/ServiciosEscolares/RegistroAsistencia/Reportes/EstadisticasResultadosExamen.php?'+param);
        return false;
    });




       //reporte resultados del examen institucional
  $("#ReporteResultadosExamenWORD").click(function() {

        var fk_nivelestudio = $('#fk_nivelestudio').val();
        var fk_modalidad = $('#fk_modalidad').val();
        var fk_carreras = $('#fk_carreras').val();
        var rangoFechas = $('#rangoFechas').val();


        param = "rangoFechas=" + rangoFechas;
        param += "&fk_nivelestudio=" + fk_nivelestudio;
        param += "&fk_modalidad=" + fk_modalidad;
        param += "&fk_carreras=" + fk_carreras;

        window.open('includes/ajax/ServiciosEscolares/RegistroAsistencia/Reportes/ReporteResultadosExamenWORD.php?'+param);



        return false;
    });




    //captura resultados examen insitutcional
    $("#f_CapturaResultadosExa").submit(function() {

        var fk_nivelestudio = $('#fk_nivelestudio').val();
        var fk_modalidad = $('#fk_modalidad').val();
        var fk_carreras = $('#fk_carreras').val();
        var rangoFechas = $('#rangoFechas').val();


        param = "rangoFechas=" + rangoFechas;
        param += "&fk_nivelestudio=" + fk_nivelestudio;
        param += "&fk_modalidad=" + fk_modalidad;
        param += "&fk_carreras=" + fk_carreras;

        $.ajax({
            url: pathCapturarResultados + 'Reportes/ObtenerFormularioCaptura.php',
            type: 'post',
            data: "Folios=Folios&" + param,
            success: function(data) {

                $("#divAsignacionFolios").show();
                $("#RespuestaLista").html(data);


            }
        });



        return false;
    });






     $("#frm_datosEncuestaMedicina #FechaNacimiento").focusout(function() {

      var FechaNacimiento = $("#frm_datosEncuestaMedicina #FechaNacimiento").val();
        $.ajax({
            url: pathEgresados+ 'Con_ObtenerEdad.php',
            type: 'post',
            dataType: 'json',
            data: "obtenerEdad=obtenerEdad&FechaNacimiento=" + FechaNacimiento,
            success: function(data) {

                $("#frm_datosEncuestaMedicina #EdadAlumno").val(data.EdadAlumno);

            }
        });



        return false;
    });





   //js. Anibal Nuevos

    $("#ReporteGeneracionEdad").click(function() {
        var fk_nivelestudio = $('#fk_nivelestudio').val();
        var fk_modalidad = $('#fk_modalidad').val();
        var fk_carreras = $('#fk_carreras').val();
        var fk_generacion = $('#fk_generacion').val();

        window.open('includes/ajax/Egresados/Reportes/ReporteGeneracionEdad.php?fk_nivelestudio=' + fk_nivelestudio + "&fk_modalidad=" + fk_modalidad + "&fk_carreras=" + fk_carreras+ "&fk_generacion=" + fk_generacion);
 });

 $("#ReporteGeneracionPromedio").click(function() {
        var fk_nivelestudio = $('#fk_nivelestudio').val();
        var fk_modalidad = $('#fk_modalidad').val();
        var fk_carreras = $('#fk_carreras').val();
        var fk_generacion = $('#fk_generacion').val();

        window.open('includes/ajax/Egresados/Reportes/ReporteGeneracionPromedio.php?fk_nivelestudio=' + fk_nivelestudio + "&fk_modalidad=" + fk_modalidad + "&fk_carreras=" + fk_carreras+ "&fk_generacion=" + fk_generacion);
 });

  $("#ReporteEgresadosTituladosPorEdad").click(function() {
        var fk_nivelestudio = $('#fk_nivelestudio').val();
        var fk_modalidad = $('#fk_modalidad').val();
        var fk_carreras = $('#fk_carreras').val();
        var fk_generacion = $('#fk_generacion').val();

        window.open('includes/ajax/Egresados/Reportes/ReporteAlumnosTituladosPorEdad.php?fk_nivelestudio=' + fk_nivelestudio + "&fk_modalidad=" + fk_modalidad + "&fk_carreras=" + fk_carreras+ "&fk_generacion=" + fk_generacion);
 });


 $("#ReporteGeneracionEgresadosLaborado").click(function() {
        var fk_nivelestudio = $('#fk_nivelestudio').val();
        var fk_modalidad = $('#fk_modalidad').val();
        var fk_carreras = $('#fk_carreras').val();
        var fk_generacion = $('#fk_generacion').val();

        window.open('includes/ajax/Egresados/Reportes/ReporteGeneracionEgresadosLaborado.php?fk_nivelestudio=' + fk_nivelestudio + "&fk_modalidad=" + fk_modalidad + "&fk_carreras=" + fk_carreras+ "&fk_generacion=" + fk_generacion);
 });


 $("#ReporteGeneracionPlanEstudio").click(function() {
 			 var fk_nivelestudio = $('#fk_nivelestudio').val();
 			 var fk_modalidad = $('#fk_modalidad').val();
 			 var fk_carreras = $('#fk_carreras').val();

 			 window.open('includes/ajax/Egresados/Reportes/ReporteGeneracionPlanEstudio.php?fk_nivelestudio=' + fk_nivelestudio + "&fk_modalidad=" + fk_modalidad + "&fk_carreras=" + fk_carreras);
 return false;
 });


  $("#ReporteEgresadosYTituladosEdadSex").click(function() {
        var fk_nivelestudio = $('#fk_nivelestudio').val();
        var fk_modalidad = $('#fk_modalidad').val();
        var fk_carreras = $('#fk_carreras').val();
        var fk_generacion = $('#fk_generacion').val();

        window.open('includes/ajax/Egresados/Reportes/CantidadDeAlumnosTituladosByEdadSecretaria.php?fk_nivelestudio=' + fk_nivelestudio + "&fk_modalidad=" + fk_modalidad + "&fk_carreras=" + fk_carreras+ "&fk_generacion=" + fk_generacion);
 });

	$("#graf").click(function() {

        var vr_grafica = $('#grafica #grafica').val();

		if(vr_grafica !=1 && vr_grafica !=2 && vr_grafica !=3 && vr_grafica !=4){
			window.open('includes/ajax/Egresados/Reportes/GraficasMedicinaByMono/graficasEncuestaMedicina.php?v_opcion=' + vr_grafica);
		}
		else{
			window.open('includes/ajax/Egresados/Reportes/graf.php?vr_grafica=' + vr_grafica);
		}

		return false;
 	});


  //GRAFICAS EGRESADOS
  //#FECHA:30/09/2015
  //#BOTON VERDE "GRAFICA"
  //#SECCION: GRAFICAS:EGRESADOS

    $("#GraficasEgresadosFimpes").click(function() {

        var fk_nivelestudio = $('#f_GraficasEgresados #fk_nivelestudio').val();
        var fk_modalidad = $('#f_GraficasEgresados #fk_modalidad').val();
        var fk_carreras = $('#f_GraficasEgresados #fk_carreras').val();
        var fk_generacion = $('#f_GraficasEgresados #fk_generacion').val();
        var opcionGrafica = $('#f_GraficasEgresados #opcionGrafica').val();

        if (opcionGrafica==7 || opcionGrafica==8)
            window.open('includes/ajax/Egresados/Reportes/monk/GraficaPreguntasNuevasUnoDos.php?fk_nivelestudio=' + fk_nivelestudio + "&fk_modalidad=" + fk_modalidad + "&fk_carreras=" + fk_carreras + "&fk_generacion=" + fk_generacion + "&opcionGrafica=" + opcionGrafica);
        else
            window.open('includes/ajax/Egresados/Reportes/GraficasEgresados.php?fk_nivelestudio=' + fk_nivelestudio + "&fk_modalidad=" + fk_modalidad + "&fk_carreras=" + fk_carreras + "&fk_generacion=" + fk_generacion + "&opcionGrafica=" + opcionGrafica);

    return false;

 	});

     $("#form_graficaEncuesta2019 #btn_graficaEncuesta2019").click(function() {
        console.log(1);

        var fk_nivelestudio = $('#form_graficaEncuesta2019 #fk_nivelestudio').val();
        var fk_modalidad = $('#form_graficaEncuesta2019 #fk_modalidad').val();
        var fk_carreras = $('#form_graficaEncuesta2019 #fk_carreras').val();
        var fk_generacion = $('#form_graficaEncuesta2019 #fk_generacion').val();
        var opt_GraficaEncuesta = $('#form_graficaEncuesta2019 #opt_GraficaEncuestaopt_GraficaEncuestaopt_GraficaEncuesta').val();

        window.open('includes/ajax/Egresados/Reportes/Graficas/GraficaEncuesta2019.php?fk_nivelestudio=' + fk_nivelestudio + "&fk_modalidad=" + fk_modalidad + "&fk_carreras=" + fk_carreras + "&fk_generacion=" + fk_generacion + "&opt_graficaEncuesta2019=" + opt_graficaEncuesta2019);

      /*   if (opcionGrafica==7 || opcionGrafica==8)
            window.open('includes/ajax/Egresados/Reportes/monk/GraficaPreguntasNuevasUnoDos.php?fk_nivelestudio=' + fk_nivelestudio + "&fk_modalidad=" + fk_modalidad + "&fk_carreras=" + fk_carreras + "&fk_generacion=" + fk_generacion + "&opcionGrafica=" + opcionGrafica);
        else
            window.open('includes/ajax/Egresados/Reportes/GraficasEgresados.php?fk_nivelestudio=' + fk_nivelestudio + "&fk_modalidad=" + fk_modalidad + "&fk_carreras=" + fk_carreras + "&fk_generacion=" + fk_generacion + "&opcionGrafica=" + opcionGrafica);

*/    return false;

    });

     $("#form_graficaEncuesta2019 #btn_relacionEmpleadores").click(function() {
        console.log(1);

        var fk_nivelestudio = $('#form_graficaEncuesta2019 #fk_nivelestudio').val();
        var fk_modalidad = $('#form_graficaEncuesta2019 #fk_modalidad').val();
        var fk_carreras = $('#form_graficaEncuesta2019 #fk_carreras').val();
        var fk_generacion = $('#form_graficaEncuesta2019 #fk_generacion').val();
        var opt_GraficaEncuestaopt_GraficaEncuesta = $('#form_graficaEncuesta2019 #opt_GraficaEncuestaopt_GraficaEncuesta').val();

        window.open('includes/ajax/Egresados/Reportes/Graficas/GraficaRelaciondeEmpladores.php?fk_nivelestudio=' + fk_nivelestudio + "&fk_modalidad=" + fk_modalidad + "&fk_carreras=" + fk_carreras + "&fk_generacion=" + fk_generacion + "&btn_relacionEmpleadores=" + btn_relacionEmpleadores);

      /*   if (opcionGrafica==7 || opcionGrafica==8)
            window.open('includes/ajax/Egresados/Reportes/monk/GraficaPreguntasNuevasUnoDos.php?fk_nivelestudio=' + fk_nivelestudio + "&fk_modalidad=" + fk_modalidad + "&fk_carreras=" + fk_carreras + "&fk_generacion=" + fk_generacion + "&opcionGrafica=" + opcionGrafica);
        else
            window.open('includes/ajax/Egresados/Reportes/GraficasEgresados.php?fk_nivelestudio=' + fk_nivelestudio + "&fk_modalidad=" + fk_modalidad + "&fk_carreras=" + fk_carreras + "&fk_generacion=" + fk_generacion + "&opcionGrafica=" + opcionGrafica);

*/    return false;

    });

     $("#form_graficaEncuesta2019 #OpnionesEncuesta").click(function() {
        console.log(1);

        var fk_nivelestudio = $('#form_graficaEncuesta2019 #fk_nivelestudio').val();
        var fk_modalidad = $('#form_graficaEncuesta2019 #fk_modalidad').val();
        var fk_carreras = $('#form_graficaEncuesta2019 #fk_carreras').val();
        var fk_generacion = $('#form_graficaEncuesta2019 #fk_generacion').val();
        var opt_GraficaEncuesta = $('#form_graficaEncuesta2019 #opt_GraficaEncuesta').val();

        window.open('includes/ajax/Egresados/Reportes/Graficas/GraficaOpinionEncuesta.php?fk_nivelestudio=' + fk_nivelestudio + "&fk_modalidad=" + fk_modalidad + "&fk_carreras=" + fk_carreras + "&fk_generacion=" + fk_generacion + "&OpnionesEncuesta=" + OpnionesEncuesta);

      /*   if (opcionGrafica==7 || opcionGrafica==8)
            window.open('includes/ajax/Egresados/Reportes/monk/GraficaPreguntasNuevasUnoDos.php?fk_nivelestudio=' + fk_nivelestudio + "&fk_modalidad=" + fk_modalidad + "&fk_carreras=" + fk_carreras + "&fk_generacion=" + fk_generacion + "&opcionGrafica=" + opcionGrafica);
        else
            window.open('includes/ajax/Egresados/Reportes/GraficasEgresados.php?fk_nivelestudio=' + fk_nivelestudio + "&fk_modalidad=" + fk_modalidad + "&fk_carreras=" + fk_carreras + "&fk_generacion=" + fk_generacion + "&opcionGrafica=" + opcionGrafica);

*/    return false;

    });     



    $("#DatosRespuestasAbiertas").click(function() {

        var fk_nivelestudio = $('#f_GraficasEgresados #fk_nivelestudio').val();
        var fk_modalidad = $('#f_GraficasEgresados #fk_modalidad').val();
        var fk_carreras = $('#f_GraficasEgresados #fk_carreras').val();
        var fk_generacion = $('#f_GraficasEgresados #fk_generacion').val();
        var opcionGrafica = $('#f_GraficasEgresados #opcionGrafica').val();

        if (opcionGrafica==7 || opcionGrafica==8 || opcionGrafica==9)
            window.open('includes/ajax/Egresados/Reportes/monk/ReporteOpinionesEncuestaEgresado_PDF_XLS_DOC.php?fk_nivelestudio=' + fk_nivelestudio + "&fk_modalidad=" + fk_modalidad + "&fk_carreras=" + fk_carreras + "&fk_generacion=" + fk_generacion + "&opcionGrafica=" + opcionGrafica + '&typeDoc=1');
        else
           alertify.error('Solo se puede generar el reporte con la opcion 7, 8 y 9.');

    return false;
    });



	$("#GraficasEgresadosFimpesExcell").click(function() {

        var fk_nivelestudio = $('#f_GraficasEgresados #fk_nivelestudio').val();
        var fk_modalidad = $('#f_GraficasEgresados #fk_modalidad').val();
        var fk_carreras = $('#f_GraficasEgresados #fk_carreras').val();
        var fk_generacion = $('#f_GraficasEgresados #fk_generacion').val();
        var opcionGrafica = $('#f_GraficasEgresados #opcionGrafica').val();

        window.open('includes/ajax/Egresados/Reportes/GraficasEgresados.php?fk_nivelestudio=' + fk_nivelestudio + "&fk_modalidad=" + fk_modalidad + "&fk_carreras=" + fk_carreras + "&fk_generacion=" + fk_generacion + "&opcionGrafica=" + opcionGrafica);

    return false;

 	});


 $("#ReporteAlumnosNoLaborando").click(function() {
        var fk_nivelestudio = $('#fk_nivelestudio').val();
        var fk_modalidad = $('#fk_modalidad').val();
        var fk_carreras = $('#fk_carreras').val();

        window.open('includes/ajax/Egresados/Reportes/ReporteAlumnosNoLaborando.php?fk_nivelestudio=' + fk_nivelestudio + "&fk_modalidad=" + fk_modalidad + "&fk_carreras=" + fk_carreras);

    return false;

});

 $("#ReporteContactoNoTitulados").click(function() {
        var fk_nivelestudio = $('#fk_nivelestudio').val();
        var fk_modalidad = $('#fk_modalidad').val();
        var fk_carreras = $('#fk_carreras').val();

        window.open('includes/ajax/Egresados/Reportes/monk/reporteContactoEgresadosNoTitulados.php?fk_nivelestudio=' + fk_nivelestudio + "&fk_modalidad=" + fk_modalidad + "&fk_carreras=" + fk_carreras);

    return false;

});


//BOTON PARA GENERAR ALUMNOS QUE HACEN FALTA POR COMPLETAR DATOS
  //#FECHA:12/05/2016
  //#BOTON VERDE
  //#SECCION: GRAFICAS:EGRESADOS


 $("#btnListaAlumnos").click(function() {
         var fk_nivelestudio = $('#f_GraficasEgresados #fk_nivelestudio').val();
        var fk_modalidad = $('#f_GraficasEgresados #fk_modalidad').val();
        var fk_carreras = $('#f_GraficasEgresados #fk_carreras').val();
        var fk_generacion = $('#f_GraficasEgresados #fk_generacion').val();


        window.open('includes/ajax/Egresados/Reportes/btnListaAlumnosXLS.php?fk_nivelestudio=' + fk_nivelestudio + "&fk_modalidad=" + fk_modalidad + "&fk_carreras=" + fk_carreras+ "&fk_generacion=" + fk_generacion);


    return false;

});




////////
///////////////
////CESAR ESPINOSA
 // Listen for click on toggle checkbox
    $('#select-all').click(function(event) {
        if(this.checked) {
            $('.selects :checkbox').each(function() {
                this.checked = true;
            });
        } else {
            $('.selects :checkbox').each(function() {
                this.checked = false;
            });
        }
    });

//MONKY
	$("#ReporteEmpresasEmpleadorasEgresados").click(function(){
		var fk_nivelestudio = $('#f_ReporteEgresadosTrabajadoresActivos #fk_nivelestudio').val();
        var fk_modalidad = $('#f_ReporteEgresadosTrabajadoresActivos #fk_modalidad').val();
        var fk_carreras = $('#f_ReporteEgresadosTrabajadoresActivos #fk_carreras').val();

	window.open('includes/ajax/Herramientas/empleadores/Reportes/ReportesEgresadosEmpresasEmpleadores.php?fk_nivelestudio=' + fk_nivelestudio + "&fk_modalidad=" + fk_modalidad + "&fk_carreras=" + fk_carreras);
	});


});//fin de la primera llave

function generarTitulosPDF(nivel_estudio){
	if(nivel_estudio==1){
		    alertify.set({ labels: {
				ok     : "Frente",
				cancel : "Atr&aacute;s"
			} });

		alertify.confirm( 'Lado que desea imprimir...', function (e) {
			if (e) {
				//after clicking OK
				window.open('includes/ajax/Extras/Reportes/mioTituloFrente.php');
			} else {
				//after clicking Cancel
				window.open('includes/ajax/Extras/Reportes/mioTituloAtras.php');
			}
		});

	}
	else{
		alertify.set({ labels: {
				ok     : "Frente",
				cancel : "Atr&aacute;s"
			} });

		alertify.confirm( 'Lado que desea imprimir...', function (e) {
			if (e) {
				//after clicking OK
				window.open('includes/ajax/Extras/Reportes/mioTituloFrenteMaestria.php');
			} else {
				//after clicking Cancel
				window.open('includes/ajax/Extras/Reportes/mioTituloAtrasMaestria.php');
			}
		});

	}
}

function uploadDatasListsAlumnos(stringArrayDatas){
	blockButton("enviarLista");
	$.ajax({
		url: 'includes/ajax/Extras/uploadLists/procesarDatosListasForCloud.php',
		type: 'POST',
		data: stringArrayDatas,
		beforeSend: function(){
			$("#ListaConsulta").html("Procesando puede demorar unos segundos, espere por favor... <img src='assets/img/ajax-loaders/ajax-loader-1.gif'>");
        },
		error:function(XMLHttpRequest, textStatus, errorThrown){
			var error;
			if (XMLHttpRequest.status === 404) error="Pagina no existe"+XMLHttpRequest.status;// display some page not found error
			if (XMLHttpRequest.status === 500) error="Error del Servidor"+XMLHttpRequest.status; // display some server error
			$('#ListaConsulta').html('<div class="alert_error">'+error+'</div>');
		},
		success: function(request){
			res=request.split('|');
			if(res[0]==1){
				alertify.alert(res[1]);
				location.href ='Sistema.php?content=Upload_Alumnos';
			}
			else{
				alertify.alert("Error: "+res[1]);
				activeButton("enviarLista");
			}
		}
	});
}
