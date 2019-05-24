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
			if(re[0]<9){
				cargaPantalla(pathFrontInit+'?request='+re[0],screenPrincipal);
			}
			else{
				cargaPantalla(pathThanks+'?fk_encuesta='+re[1],screenPrincipal);
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
			if(request==1)
				cargaPantalla(pathFrontInit,screenPrincipal);
			else
				alertify.alert(request);
		}
	});
}