// JavaScript Document
//funcion para mostrar modulos deseados

function detalleAlumno(id){
	$("#content").html('Procesando, espere por favor... <img src="assets/img/ajax-loaders/ajax-loader-1.gif" alt=""><br>');	
	$.ajax({
		type: 'POST',
		url: pathEgresados+'Dta_Generales.php',	
        data: 'id='+id,				  
		error:function(XMLHttpRequest, textStatus, errorThrown){
			console.log(arguments);
			var error;
			if (XMLHttpRequest.status === 404) error="Pagina no existe"+XMLHttpRequest.status;// display some page not found error 
			if (XMLHttpRequest.status === 500) error="Error del Servidor"+XMLHttpRequest.status; // display some server error 
			$('#content').html('<div class="alert_error">'+error+'</div>');						  
		},
		success:function(msj){
			console.log(msj);
			if(msj!=""){
				$("#content").html(msj);
                }else{
					$('#content').html('<div class="alert alert-dismissable alert-danger"><strong>Error!</strong>'+msj+'</div>');		
				}
           }						  
	});
}

function cerrarSesion(id){
	$("#content").html('Procesando, espere por favor... <img src="assets/img/ajax-loaders/ajax-loader-1.gif" alt=""><br>');		
	$.ajax({
		type: 'POST',
		url: pathSistema+'Usuario/desconectar.php',	
        data: 'id='+id,				  
		error:function(XMLHttpRequest, textStatus, errorThrown){
			console.log(arguments);
			var error;
			if (XMLHttpRequest.status === 404) error="Pagina no existe"+XMLHttpRequest.status;// display some page not found error 
			if (XMLHttpRequest.status === 500) error="Error del Servidor"+XMLHttpRequest.status; // display some server error 
			$('#content').html('<div class="alert_error">'+error+'</div>');						  
		},
		success:function(msj){
			console.log(msj);
			if(msj!=""){
				$("#content").html("");
                var validar = msj.split('|');
                if(validar[0] == 1){
                    alertify.alert(validar[1], function (e) {
	                    if (e) {
	                        // user clicked "ok"
	                        window.location.reload();
	                    } 
                    });
                }else{
					$('#content').html('<div class="alert alert-dismissable alert-danger"><strong>Error!</strong>'+validar[1]+'</div>');		
				}
           }						  
		}
	});	
}

function rptExcelEmpleadores(){
	window.open("includes/ajax/Herramientas/empleadores/rptEmpleadores.php");
}

function reporteExcelcumple(){
	var fecha = $("#fechacumple").val();
	var parametro = '';
	if(fecha != ""){
		parametro = "?fecha="+fecha;
	}else{
		parametro = '';
	}
	window.open("includes/ajax/cumples.php"+parametro);
}

function reportePdfcunples(){
	var fecha = $("#fechacumple").val();
	setTimeout (location.replace("Sistema.php?content=rptCumplexcel&fecha="+fecha), 5000); 
}

function aparecermodulos(pagina,donde)
{
	
	$("#"+donde).html('<div align="center" style="padding:120px"><img src="imgs/loding.gif" alt=""></div>');		

	$.ajax({
		type: 'POST',
		url: pathReportes+pagina,					  
		error:function(XMLHttpRequest, textStatus, errorThrown){
			console.log(arguments);
			var error;
			if (XMLHttpRequest.status === 404) error="Pagina no existe"+XMLHttpRequest.status;// display some page not found error 
			if (XMLHttpRequest.status === 500) error="Error del Servidor"+XMLHttpRequest.status; // display some server error 
			$('#'+donde).html('<div class="alert_error">'+error+'</div>');						  
		},
		success:function(poneloaqui){
			//overlayclose('c_loading');
			$("#"+donde).html(poneloaqui);
			//alert(msj);						  
		}
	});				  					  
			
}



//validacion de formulario
function MM_validateForm() 
{ //v4.0
  if (document.getElementById)
  {
    	var i,p,q,nm,test,num,min,max,errors='',args=MM_validateForm.arguments;
    	for (i=0; i<(args.length-2); i+=3)
		{ 
			test=args[i+2]; 
			val=document.getElementById(args[i]);
      		if (val) 
			{ 
				nm=val.title; 
				if ((val=val.value)!="") 
				{
        			if (test.indexOf('isEmail')!=-1) 
					{ 
						p=val.indexOf('@');
						if (p<1 || p==(val.length-1)) errors+='- '+nm+' Debe de contener una direccion valida de Email.<br>';
						
        			} 
                                else if (test!='R') 
                                { 
                                        num = parseFloat(val);
                                        if (isNaN(val)) errors+='- '+nm+' Debe de contener numeros.<br>';
                                        if (test.indexOf('inRange') != -1) 
                                        { 
                                                p=test.indexOf(':');
                                                min=test.substring(8,p); max=test.substring(p+1);
                                                if (num<min || max<num) errors+='- '+nm+' Debe de contener un numero entre '+min+' y '+max+'.<br>';
                                        } 
                                }
                            } else if (test.charAt(0) == 'R') errors += '- '+nm+' es requerido.<br>'; 
			}
    	} 
		if (errors) 
		{
			apprise('Han ocurrido los siguientes errores:<br>'+errors);
			return 0;
		}
		else
		{
			//alert("entro en 1");
		  return 1;
		}
  }
}



//funcion para recoger los datos del formulario de la empresa
function ObtenerDatosFormulario(id)
{
    var  form = document.getElementById(id);
    var length = form.elements.length;
    var  cadena = "";
	
    for( var i = 0; i < length; i++ )
    {
        element = form.elements[i];
		 
        if(element.tagName.toLowerCase() == 'textarea' )
        {
               cadena +=element.name+"="+element.value+"&";
        }
		else if(element.tagName.toLowerCase() =='select')
		{
			cadena +=element.name+"="+element.value+"&";
		}
        else if( element.tagName.toLowerCase() == 'input' )
        {
                if( element.type == 'text' || element.type == 'hidden' || element.type == 'password')
                {
					cadena +=element.name+"="+element.value+"&";
                }
                else if( element.type == 'radio' && element.checked )
                {
                        if( !element.value )
                                params[element.name] = "on";
                        else
                               cadena +=element.name+"="+element.value+"&";
 
                }
                else if( element.type == 'checkbox' && element.checked )
                {
                        if( !element.value )
                                params[element.name] = "on";
                        else
                                cadena +=element.name+"="+element.value+"&";
                }
        }
    }
	cadena = cadena.substring(0,cadena.length-1);
	console.log(cadena);
    return cadena;
}


//funcion de guardado especial

function GuardarEspecial(formulario,archivo_envio,archivo_vizualizar,donde_mostrar)
{
	//alert(archivo_envio);
	if(confirm("\u00BFEstas seguro de querer realizar esta operaci\u00f3n?"))
	{
		var datos = ObtenerDatosFormulario(formulario);//obteniedo los datos del formulario
		console.log(datos);
		$('#'+donde_mostrar).html('<div align="center" class="mostrar"><img src="imgs/loding.gif" alt="" /></div>');
		//overlayopen('abc');
		setTimeout(function(){
				  $.ajax({
					  type: 'POST',
					  url: archivo_envio,
					  data: datos,
					  error:function(XMLHttpRequest, textStatus, errorThrown){
						  var error;
						  console.error(XMLHttpRequest);
						  if (XMLHttpRequest.status === 404)  error="Pagina no existe"+XMLHttpRequest.status;// display some page not found error 
						  if (XMLHttpRequest.status === 500) error="Error del Servidor"+XMLHttpRequest.status; // display some server error 
						  $('#'+donde_mostrar).html('<div class="alert_error">'+error+'</div>');	
						  //overlayclose('abc');
						  aparecermodulos(archivo_vizualizar,donde_mostrar);
					  },
					  success:function(msj){
						   console.log("El resultado de msj es: "+ msj);
						  // alert(msj)
						  if ( msj == 1 ){
							  //overlayclose('ventana');
							  //overlayclose('abc');
							  aparecermodulos(archivo_vizualizar,donde_mostrar);
						  }
						  else{
							  //overlayclose('ventana');
							 //overlayclose('abc');
							 $("#"+donde_mostrar).html("EL GUARDADO NO SE EJECUTO");
							 //aparecermodulos(archivo_vizualizar+"?ac=0&msj=Error. "+msj,donde_mostrar);
						  }	
					  }
				  });				  					  
		},1000);
	}
}// fin de function GuardarEspecial




function v_l_plan(idAcademico,donde)
{
	
	if(idAcademico != 0)
	{
		//alert("EL PAIS SELECCIONADO FUE " + idpais );
		
		setTimeout(
	              function(){
				  $.ajax({
					  type: 'POST',
					  url: 'modulos/l_plan.php',
					  data: 'idAcademico='+idAcademico,					  
					  error:function(XMLHttpRequest, textStatus, errorThrown){
						  console.log(arguments);
						  var error;
						  if (XMLHttpRequest.status === 404) error="Pagina no existe"+XMLHttpRequest.status;// display some page not found error 
						  if (XMLHttpRequest.status === 500) error="Error del Servidor"+XMLHttpRequest.status; // display some server error 
						  $('#'+donde).html('<div class="alert_error">'+error+'</div>');						  
					  },
					  success:function(poneloaqui){
						 // overlayclose('c_loading');
						  $("#"+donde).html(poneloaqui);
						  //alert(msj);						  
					  }
				  });				  					  
		},600);	
		
		
			
	}else
	 {
	    alert("Selecciona tu Nivel Academico");	 
	 }
	
}

function v_l_carreras(idplan,donde)
{
	
	if(idplan != 0)
	{
		//alert("EL PAIS SELECCIONADO FUE " + idpais );
		
		setTimeout(
	              function(){
				  $.ajax({
					  type: 'POST',
					  url: 'modulos/l_carreras.php',
					  data: 'idplan='+idplan,					  
					  error:function(XMLHttpRequest, textStatus, errorThrown){
						  console.log(arguments);
						  var error;
						  if (XMLHttpRequest.status === 404) error="Pagina no existe"+XMLHttpRequest.status;// display some page not found error 
						  if (XMLHttpRequest.status === 500) error="Error del Servidor"+XMLHttpRequest.status; // display some server error 
						  $('#'+donde).html('<div class="alert_error">'+error+'</div>');						  
					  },
					  success:function(poneloaqui){
						 // overlayclose('c_loading');
						  $("#"+donde).html(poneloaqui);
						  //alert(msj);						  
					  }
				  });				  					  
		},600);	
		
		
			
	}else
	 {
	    alert("Selecciona tu Plan de Estudios");	 
	 }
	
}


//funcion para borrar datos de la base de datos

function BorrarDatos(id,campo,tabla,tipo,archivo_vizualizar,donde_mostrar)
{
	var cadena="id="+id+"&campo="+campo+"&tabla="+tabla+"&tipo="+tipo;
	
	if(confirm("\u00BFEstas seguro de querer realizar esta operaci\u00f3n?"))
	{
		$('#'+donde_mostrar).html('<div align="center" class="mostrar"><img src="imgs/loding.gif" alt="" /></div>');
		//overlayopen('abc');
		
		setTimeout(function(){
				  $.ajax({
					  type: 'POST',
					  url: 'clases/borrar.php',
					  data: cadena,
					  success:function(msj){

						  if ( msj == 1 ){
							  //overlayclose('abc');
							  aparecermodulos(archivo_vizualizar,donde_mostrar);
						  }
						  else{
							  //overlayclose('abc');
							  //aparecermodulos(archivo_vizualizar+"?ac=0&msj=Error. "+msj,donde_mostrar);
							  $('#'+donde_mostrar).html('<div align="center" class="mostrar">Error en el borrado</div>');
						  }							  
					  },
					  error:function(){
						  $('#'+donde_mostrar).html('<div class="alert_error"></div>');
						  $('.alert_error').hide(0).html('Ha ocurrido un error durante la ejecuciÃ³n');
						  $('.alert_error').slideDown(timeSlide);
						  
					  }
				  });				  					  
		},1000);
	}
}// fin de function BORRARDATOS



function limpiaForm(miForm) {
// recorremos todos los campos que tiene el formulario
	$(':input', miForm).each(function() {
		var type = this.type;
		var tag = this.tagName.toLowerCase();
		//limpiamos los valores de los campos…
		if (type == 'text' || type == 'password' || tag == 'textarea')
		this.value = '';
		// excepto de los checkboxes y radios, le quitamos el checked
		// pero su valor no debe ser cambiado
		else if (type == 'checkbox' || type == 'radio')
		this.checked = false;
		// los selects le ponesmos el indice a -
		else if (tag == 'select')
		this.selectedIndex = "";
                else if (type == 'file')
                this.value = '';
	});
}


function foco(campo)
{
	$('#'+campo).focus();
}



function OcultarDiv(nombre)
{
    setTimeout(function(){
    $('#'+nombre).fadeToggle(1000);},4000);	
}


//funcion para bloquear caracteres especiales 

function validaCaractaer(pEvent)
{$('#usuario').valueOf('')

    if (pEvent.charCode==241) //esta es la letra ñ
    {
        $('#usuario').html('')
        $("#mensajes").html('<span style="float:left;color:red" id="msj_error"> ñ es un caracter no valido </span>');
        OcultarDiv('msj_error')
        pEvent.charCode = 0; 
    }
}


//funcion prar abril modal 
function AbrirModalGeneral (modal,ancho,alto)
{
    //console.log("Entro "+modal);	

    var m_ancho = parseInt(ancho) / 2;
    var m_alto = parseInt(alto) / 2;

    //console.log("m_ancho"+m_ancho);	

    //$('#'.modal).slideDown("fast");

    $('#'+modal).css('width',ancho+"px");
    $('#'+modal).css('height',alto+"px");
    $('#'+modal).css('margin-top','-'+m_alto+"px");
    $('#'+modal).css('margin-left','-'+m_ancho+"px");

    //modifico el tamaño del contenido de la moda		
    var m_alto_contenido = parseInt(alto) - 20;

    $('#contenido_modal').css('height',m_alto_contenido+"px");
    //$('#contenido_modal').css('overflow',"auto");		
    $('#'+modal).css('display','block');
    //console.log("Salio");
}	


function CerrarModalGeneral (modal)
{
    //console.log("Entro "+modal);	
    $('#'+modal).css('display','none');
    console.log("Salio");
}	


function AbrirModalSec (modal,ancho,alto)
{
    //console.log("Entro "+modal);	

    var m_ancho = parseInt(ancho) / 2;
    var m_alto = parseInt(alto) / 2;

    console.log("m_ancho"+m_ancho);	

    //$('#'.modal).slideDown("fast");

    $('#'+modal).css('width',ancho+"px");
    $('#'+modal).css('height',alto+"px");
    $('#'+modal).css('margin-top','-'+m_alto+"px");
    $('#'+modal).css('margin-left','-'+m_ancho+"px");

    //modifico el tamaño del contenido de la moda		
    var m_alto_contenido = parseInt(alto) - 20;

    $('#contenido_modal').css('height',m_alto_contenido+"px");
    $('#contenido_modal').css('overflow',"auto");		
    $('#'+modal).css('display','block');
    //console.log("Salio");
}


function LimpiarFormModal(formu){
	$("#"+formu)[0].reset();
}


function miAlertaModal(){
	console.log('Entrando a mensaje de mi archivo externo ');
	$("#myModal").modal("show");
}



function cargarmodulo(nombre,id){
    setTimeout (location.replace("Sistema.php?content="+nombre+"&id="+id), 5000); 
}



function formato_numero(numero, decimales, separador_decimal, separador_miles){ // v2007-08-06

    numero=parseFloat(numero);
        if(isNaN(numero)){
        return "";
    }

    if(decimales!==undefined){
        // Redondeamos
        numero=numero.toFixed(decimales);
    }

    // Convertimos el punto en separador_decimal
    numero=numero.toString().replace(".", separador_decimal!==undefined ? separador_decimal : ",");

    if(separador_miles){
        // Añadimos los separadores de miles
        var miles=new RegExp("(-?[0-9]+)([0-9]{3})");
        while(miles.test(numero)) {
            numero=numero.replace(miles, "$1" + separador_miles + "$2");
        }
    }

    return numero;
}

//pendiente ver si omitimos esat funcion 
/*function vermoduloedit(nombre,id,x){
    setTimeout (location.replace("Sistema.php?content="+nombre+"&id="+id+'&val='+x), 5000); 
}*/


