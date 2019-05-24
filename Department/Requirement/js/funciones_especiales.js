// JavaScript Document
function cargaPantalla(file, content, scroll){
	$.ajax({
		beforeSend: function(){
			$('#'+content).html("<div style='text-align:center;margin-top:150px;'><img src='img/frontend/loading.gif' width='40' height='40'><br><h3 style='font-family:Arial,Helvetica,sans-serif;color:#999;font-size:16px;'>Trabajando en ello... Espere por favor</h3><div>");
		}, 
		url:file,
		success: function(e){
			if(scroll){
				$('html, body').animate({scrollTop:0}, 'slow');
				$('#'+content).html(e);
			}
			else{
				$('#'+content).html(e);
			}
		}	
	});
}


function cargaPantallaSimple(file,content){
	$.ajax({
		url:file,
		success: function(e){
			$('html, body').animate({scrollTop:0}, 'slow');
			$('#'+content).html(e);
		}	
	});
}



function cerrarPantalla(){
	$('html, body').animate({scrollTop:0}, 'slow');
	document.getElementById('page-content-wrapper').innerHTML="";
}



 function validateTecla(e){
	var key=e.keyCode || e.which;
	switch(key)
	{
		case 13:
			return('enter');
		case 114:
			return('F2');
		case 114:
			return('F3');
		case 115:
			return('F4');
		case 116:
			return('F5');
		case 117:
			return('F6');
		case 118:
			return('F7');
		case 119:
			return('F8');
		case 120:
			return('F9');
		case 121:
			return('F10');
		case 122:
			return('F11');
		case 123:
			return('F12');
	}//sintaxis if(validateTecla(event)=='enter'){}
}



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



function acerca(){
	alertify.alert('Acerca del software Sanatorios&reg; v.2.0&trade;','<div style="text-align:justify;">Desarrollado por el Ing.Ricardo Elías Mondragón Trujillo, contáctanos por facebook en facebook.com/OdAkiR, si cuentas con correo electrónico esperamos tu mensaje a la dirección wyrecosmonky@gmail.com para dudas o aclaraciones.</div>');
}



function displayWindow(w,h){
	$('html, body').animate({scrollTop:0}, 'slow');
	var x=w/2;
	var y=h/2;
	$('#backScreen,#window').fadeIn(1000);
	document.getElementById('backScreen').style.display="block";
	document.getElementById('window').style.display="block";
	document.getElementById('window').style.width=w+"px";
	document.getElementById('window').style.height=h+"px";
	document.getElementById('window').style.marginTop="-"+y+"px";
	document.getElementById('window').style.marginLeft="-"+x+"px";	
}



function closeWindow(){
	$('#backScreen,#window').fadeOut(1000);		
}



function printReportPDF(idpaci,idHisto){
	window.open('reportes/PDFreportHistorialmedico.php?idpaci='+idpaci+'&idHisto='+idHisto);
}




function printReportsTypePDFs(url_file,param1,param2,param3){
	window.open(file+'?param1='+param1+'&param2='+param2+'&param3='+param3);
}


function jumpinput(res){// solo sirve en google para sartar de campo
	if(validateTecla(event)=='enter'){
		$('#'+res).focus();
	}
}



function jumpEnter(e,obj) { // salta en mozilla
  tecla=(document.all) ? e.keyCode : e.which;
  if(tecla!=13) return;
  frm=obj.form;
  for(i=0;i<frm.elements.length;i++) 
    if(frm.elements[i]==obj) { 
      if (i==frm.elements.length-1) i=-1;
      break }
  frm.elements[i+1].focus();
  return false;
} 



function resetform(forms){
    $("#"+forms).reset();
}


