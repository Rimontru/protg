$(document).ready(function() {


	   $("#f_datosempleadores #v_fechaSolicitud").datepicker({dateFormat: "dd/mm/yy"});


//CESAR
//ALTAS CARRERAS

	  $("#f_carreras").submit(function() {
                      
            var plantel = $('#f_carreras #v_plantel').val();
            var clvCarrera = $('#f_carreras #v_clvCarrera').val();   
            var nomCarrera = $('#f_carreras #v_nomCarrera').val();   
            var revoe = $('#f_carreras #v_revoe').val();   
            var fechaExp= $('#f_carreras #v_fechaexp').val();
            var modalidad = $('#f_carreras #v_modalidad').val();
            var nomTitulo = $('#f_carreras #v_nomTitulo').val();
            var academico = $('#f_carreras #v_academico').val();
            var edificio = $('#f_carreras #v_edificio').val();
            
 
            $.ajax({
                    url: pathCarreras+'Ins_Carreras.php',
                    type: 'post',
                    data: "envio=envio&plantel="+plantel+"&clvCarrera="+clvCarrera+"&nomCarrera="+nomCarrera+"&revoe="+revoe+"&fechaExp="+fechaExp+"&modalidad="+modalidad+"&nomTitulo="+nomTitulo+"&academico="+academico+"&edificio="+edificio,
                    success: function(data){
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
                           }//if
                    }//succes
            });
            return false;
				
		});
                
             
  
 //CESAR
//ALTAS USUARIOS

	  $("#f_user").submit(function() {
              
            var cadena = [];  
            $('#multi-select').each(function(){
                cadena.push($(this).val());
            });
            
            var datos = $('#f_user').serialize();              
 
            $.ajax({
                    url: pathTrabajadores+'Ins_usuarios.php',
                    type: 'post',
                    data: datos+"&carreras="+cadena,
                    beforeSend: function (){
                       $("#botonera").hide();
                       $("#loading-data").html("Procesando, espere por favor... <img src='assets/img/ajax-loaders/ajax-loader-1.gif'>");
                    },
                    success: function(data){
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
                           }//if
                    }//succes
            });
            return false;
				
		});
		

		
		
		  $("#f_datosempleadores").submit(function() {
                      
            var fechaSolicitud = $('#f_datosempleadores #v_fechaSolicitud').val();
            var empresa = $('#f_datosempleadores #v_empresa').val();   
            var nomSolicitante = $('#f_datosempleadores #v_nomSolicitante').val();   
            var puestoSolicitante = $('#f_datosempleadores #v_puestoSolicitante').val();   
            var licenciatura= $('#f_datosempleadores #v_licenciatura').val();
	        var puestoVacante= $('#f_datosempleadores #v_puestoVacante').val();
            var numVacantes = $('#f_datosempleadores #v_numVacantes').val();
            var telefono = $('#f_datosempleadores #v_telefono').val();
            var email = $('#f_datosempleadores #v_email').val();
            var direccion = $('#f_datosempleadores #v_direccion').val();
            var sexo = $('#f_datosempleadores #v_sexo').val();
            var empleador = $('#f_datosempleadores #v_empleador').val();
            var pagina = '';
            if(empleador == 0){
                pagina = 'Ins_Empleadores.php';
            }else{
                pagina = 'Mod_Empleadores.php';
            }    
            $.ajax({
                    url: pathEmpleadores+pagina,
                    type: 'post',
                    data: "envio=envio&fechaSolicitud="+fechaSolicitud+"&empresa="+empresa+"&nomSolicitante="+nomSolicitante+"&puestoSolicitante="+puestoSolicitante+"&licenciatura="+licenciatura+"&puestoVacante="+puestoVacante+"&numVacantes="+numVacantes+"&telefono="+telefono+"&email="+email+"&direccion="+direccion+"&sexo="+sexo+"&empleador="+empleador,
                    success: function(data){
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
                           }//if
                    }//succes
            });
            return false;
				
		});	


});




function GuardarMateria(){
     
}
