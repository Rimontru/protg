$(document).ready(function(events){
	/*alertify.confirm('Inicio alternativo','Elija la opción permitida',
		function(){//Frontend
			$.ajax({
				beforeSend: function(){
					$('#'+screenPrincipal).html(gifLoad);
				},
				url: pathFrontInit,
				type: 'GET',
				success: function(request){
					$('#'+screenPrincipal).html(request);
				}
			});	
		},
		function(){//Backend
			alertify.prompt("Realizar copia de seguridad","Ingrese su contraseña para continuar...", "",
				function(evt, pass){//ok
					if(pass==""){
						alertify.alert('Campos vac&iacute;os, intente de nuevo');
						location.reload();
					}
					else if(pass==pathXXX){
						$.ajax({
							beforeSend: function(){
								$('#'+screenPrincipal).html(gifLoad);
							},
							url: pathBackInit,
							type: 'GET',
							success: function(request){
								$('#'+screenPrincipal).html(request);
							}
						});	
					}
					else{
						alertify.alert('La contraseña no coincide');
						location.reload();
					}
					
				},
				function(){
				alertify.error('No se realizo lo necesitado consulte el administrador');
				location.reload();
			});
	}).set('labels', {ok:'Frontend', cancel:'Backend'});*/
	cargaPantalla('frontend/form_encuestas.php', 'bodyEncuesta', false);
	
});