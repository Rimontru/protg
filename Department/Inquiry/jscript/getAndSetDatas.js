$(document).ready(function(){


	$("#sendEncuestaNew").on('click', function(event) {
		miArray = new Array();
		faltan = 0;
		for (i = 1; i <= 9; i++) {
			valor = $("#option"+i+":checked").val();
			if (valor == undefined || valor == "" || valor == null) {
				miArray[i] = 1;
				++faltan;
			} else
				miArray[i] = valor;
		}

		comment = $("#comentario").val();
		fk_persona = $("#fk_persona").val();
		if (comment == "") comment = 'Ninguno...';

		if (faltan == 0) {
			if ( miArray.length >= 10 ) {
				$.ajax({
					url: urlProcessor + 'ins_newEncuesta.php',
					type: 'POST',
					dataType: 'JSON',
					data: 'options='+miArray+'&comment='+comment+'&fk_persona='+fk_persona,
					success: function(request){
						if (request.status == '_success') {
							alertify.alert(request.msg, function(e){
								if (e) {
							 		/*miArray.length = 0;
							 		$("#comentario").val("");
							 		$("#fk_persona").val(1);
							 		$('html, body').animate({scrollTop:0}, 'slow');
							 		for (i = 1; i <= 9; i++) {
							 			$('input[name=question'+i+']:checked').prop('checked',false);
							 		}*/
							 		location.href = "/Department/Requirement/";
								}
							});

						} else {
							alertify.alert(request.msg);
						}
					}
				});

			} else
			    alertify.alert('Error, algo anda mal...');

		} else{
			alertify.alert('Error, no as seleccionado: '+faltan);
			setTimeout(function(){
				location.href = "/Department/Requirement/";
			}, 60000);
		}

	});

























})