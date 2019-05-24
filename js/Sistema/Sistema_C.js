$(document).ready(function() {
    
    $("#f_ReporteSinodalesCarrera #fk_carreras").select2({width: 'resolve'});

    
    
    
//    $("#f_datoSinodal #FechaPagoIni").datepicker({dateFormat: "dd/mm/yy"});
//    $("#f_datoSinodal #FechaPagoFin").datepicker({dateFormat: "dd/mm/yy"});
//    $("#f_datoSinodal #FechaOficioIni").datepicker({dateFormat: "dd/mm/yy"});
//    $("#f_datoSinodal #FechaOficioFin").datepicker({dateFormat: "dd/mm/yy"});
//    $("#f_datoSinodal #pk_carrera").select2({width: 'resolve'});


$("#imprimirReporteSinodalesCarrera").click(function() { 
    var fk_nivelestudio = $('#fk_nivelestudio').val();
    var fk_modalidad = $('#fk_modalidad').val();
    var fk_carreras = $('#fk_carreras').val();
    window.open('includes/ajax/Sinodales/Reportes/ReporteSinodalesCarrera.php?fk_nivelestudio='+fk_nivelestudio+"&fk_modalidad="+fk_modalidad+"&fk_carreras="+fk_carreras); 
	
	
    
});

$("#ReporteDesarrolloAcademico").click(function() { 
    var fk_nivelestudio = $('#fk_nivelestudio').val();
    var fk_modalidad = $('#fk_modalidad').val();
    var fk_carreras = $('#fk_carreras').val();
    window.open('includes/ajax/Egresados/Reportes/ReporteUltimasGeneracionesConPosgrado_PDF_XLS_DOC.php?fk_nivelestudio='+fk_nivelestudio+"&fk_modalidad="+fk_modalidad+"&fk_carreras="+fk_carreras+"&typeDoc=1"); 
    
    
    
});





//*******Generar formato de pago Sinodales por carrera****//

    $("#f_ReporteSinodalesPago #fk_carreras").select2({width: 'resolve'});

    
    $("#frm_cargarFull_titulos #fecha_frente").datepicker({dateFormat: "yy-mm-dd"});
	$("#frm_cargarFull_titulos #fecha_atras").datepicker({dateFormat: "yy-mm-dd"});
    
    $("#f_ReporteSinodalesPago #fechaUnoPago").datepicker({dateFormat: "dd/mm/yy"});
    $("#f_ReporteSinodalesPago #fechaDosPago").datepicker({dateFormat: "dd/mm/yy"});
//    $("#f_ReporteSinodalesCarrerapago #FechaOficioIni").datepicker({dateFormat: "dd/mm/yy"});
//    $("#f_ReporteSinodalesCarrerapago #FechaOficioFin").datepicker({dateFormat: "dd/mm/yy"});


$("#imprimirReporteSinodalesPago").click(function() { 
    var fk_nivelestudio = $('#f_ReporteSinodalesPago #fk_nivelestudio').val();
    var fk_modalidad = $('#f_ReporteSinodalesPago #fk_modalidad').val();
    var fk_carreras = $('#f_ReporteSinodalesPago #fk_carreras').val();
    var fechaUnoPago = $('#f_ReporteSinodalesPago #fechaUnoPago').val();
    var fechaDosPago = $('#f_ReporteSinodalesPago #fechaDosPago').val();

//	alert (fk_nivelestudio);
    window.open('includes/ajax/Sinodales/Reportes/ReporteSinodalesPagos.php?fk_nivelestudio='+fk_nivelestudio+"&fk_modalidad="+fk_modalidad+"&fk_carreras="+fk_carreras+"&fechaUnoPago="+fechaUnoPago+"&fechaDosPago="+fechaDosPago); 

    
});

/****************Generar reporte del formato de pago de sinodales todos********/
$("#imprimirReporteSinodalesPagoTodos").click(function() { 
    
    var fk_nivelestudio = $('#f_ReporteSinodalesPago #fk_nivelestudio').val();
    var fk_modalidad = $('#f_ReporteSinodalesPago #fk_modalidad').val();
    var fechaUnoPago = $('#f_ReporteSinodalesPago #fechaUnoPago').val();
    var fechaDosPago = $('#f_ReporteSinodalesPago #fechaDosPago').val();

//	alert (fk_nivelestudio);
    window.open('includes/ajax/Sinodales/Reportes/ReporteSinodalesPagosTodos.php?fk_nivelestudio='+fk_nivelestudio+'&fk_modalidad='+fk_modalidad+"&fechaUnoPago="+fechaUnoPago+"&fechaDosPago="+fechaDosPago); 

    
});
$('#imprimirReporteSinodalesPagoTodosXLS').click(function(){
	var fk_nivelestudio = $('#f_ReporteSinodalesPago #fk_nivelestudio').val();
    var fk_modalidad = $('#f_ReporteSinodalesPago #fk_modalidad').val();
    var fechaUnoPago = $('#f_ReporteSinodalesPago #fechaUnoPago').val();
    var fechaDosPago = $('#f_ReporteSinodalesPago #fechaDosPago').val();
	
	var data='&fk_nivelestudio='+fk_nivelestudio;
		data+='&fk_modalidad='+fk_modalidad;
        data+='&fechaUnoPago='+fechaUnoPago;
		data+='&fechaDosPago='+fechaDosPago;

    window.open('includes/ajax/Sinodales/Reportes/ReporteSinodalesPagosTodosXLS.php?datas='+data);
	
});


////***************GENERAR OFICIO SINODALES INDIVIDUALES****************//
//    $("#f_ReporteSinodalesIndividual #fk_carreras").select2({width: 'resolve'});
//    $("#f_ReporteSinodalesIndividual #fk_sinodal").select2({width: 'resolve'});
//
//    
//    
//    
//    $("#f_ReporteSinodalesIndividual #FechaUnoIndividual").datepicker({dateFormat: "dd/mm/yy"});
//    $("#f_ReporteSinodalesIndividual #FechaDosIndividual").datepicker({dateFormat: "dd/mm/yy"});
////    $("#f_ReporteSinodalesIndividual #FechaOficioIni").datepicker({dateFormat: "dd/mm/yy"});
////    $("#f_ReporteSinodalesIndividual #FechaOficioFin").datepicker({dateFormat: "dd/mm/yy"});
//
//
//$("#imprimirReporteSinodalesIndividual").click(function() { 
//    var fk_nivelestudio = $('#fk_nivelestudio').val();
//    var fk_modalidad = $('#fk_modalidad').val();
//    var fk_carreras = $('#fk_carreras').val();
//    var fechaUnoIndividual = $('#fechaUnoIndividual').val();
//    var fechaDosIndividual = $('#fechaDosIndividual').val();
//
//	
//    window.open('includes/ajax/Sinodales/Reportes/ReporteSinodalesIndividuales.php?fk_nivelestudio='+fk_nivelestudio+"&fk_modalidad="+fk_modalidad+"&fk_carreras="+fk_carreras+"&fechaUnoIndividual="+fechaUnoIndividual+"&fechaDosIndividual="+fechaDosIndividual); 
//	
//	
//    
//});


});

function blockButton(btn){
	$('#'+btn).each(function (){
    	this.style.pointerEvents = 'none'; 
	});
}

function activeButton(btn){
	$('#'+btn).each(function (){
    	this.style.pointerEvents = 'auto'; 
	});
}
