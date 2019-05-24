function generaReporteEncuestaPDF(){
	var params=$('#form_imprimeReporte').serialize();
	window.open(reporteEncuestas+'?'+params);
}

function GetValOptionEmoji(option,pregunta){
	blockButton('btn_emoji');
	stringDatas='pregunta='+pregunta+'&option='+option;
	$.ajax({
		url: addArrayNewDatas,
		type: 'POST',
		data: stringDatas,
		success: function(request){
			re=request.split('|');
			if(re[0]<10){
				cargaPantalla(pathFrontInit+'?request='+re[0], screenPrincipal, false);
			}
			else{
				cargaPantalla(pathThanks+'?fk_encuesta='+re[1], screenPrincipal, false);
				setTimeout(function(){
					cargaPantalla(pathFrontInit,screenPrincipal);
				},180000);//se posterga con un tiempo de 1 minuto por si no comenta
			}
		}
	});
}

function InsertNewComentarioByFkEncuesta(){
	blockButton('btn_cometario');
	stringData=$('#form_comentario').serialize();
	$.ajax({
		url: accInsertComentario,
		type: 'POST',
		data: stringData,
		success: function(request){
			if(request==1){
				$('html, body').animate({scrollTop:0}, 'slow');
				cargaPantalla(pathFrontInit,screenPrincipal, true);
			}
			else{
				$('html, body').animate({scrollTop:0}, 'slow');
				alertify.alert(request);
			}
		}
	});
}

function showInfo(){
        alertify.alert('<div style="text-align: justify;">Powered Made SAGOsoft&reg; |Corp.&trade; by Ing. Ricardo Elías Mondragón Trujillo, contáctanos por facebook en facebook.com/OdAkiR, si cuentas con correo electrónico esperamos tu mensaje a la dirección wyrecosmonky@gmail.com para dudas o aclaraciones.</div>');
}
