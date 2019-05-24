$(document).ready(function() {

    /***** Ivan Mauricio Meneses Melo Granados *************/       
//alertify.log("soy un mensaje", "", 0);
//

       //usuarios
 $("#Usuario_Alta").submit(function() {			
     var str = $("#Usuario_Alta").serialize();	
        $.ajax({
            url: pathUsuarios+'Ins_Usuario.php',
            type: 'post',
            data: str,
            beforeSend: function (){
                       $("#botonera").hide();
                       $("#loading-data").html("Procesando, espere por favor... <img src='img/ajax-loaders/ajax-loader-1.gif'>");
                    },
            success: function(data){
                if(data!=""){
                    var validar = data.split('|');
                   if(validar[0]=='1'){
                        $("#botonera").show();
                        $("#loading-data").hide();
                        $("#mensaje_done").html(validar[1]);
                        mensaje_sistema_done();

                    }else{
                        $("#botonera").show();
                        $("#loading-data").hide();
                        $("#mensaje_error").html(validar[1]);
                        mensaje_sistema_error();

                    }

                }
            }
        });
        return false;
    });



$("#f_datosmateriales").submit(function() {			
     var str = $("#f_datosmateriales").serialize();	
        $.ajax({
            url: pathMateriales+'Ins_Materiales.php',
            type: 'post',
            data: str,
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

                }
            }
        });
        return false;
    });






});





function AltaExamenInstitucional(pk_alumno){
    
      $.ajax({
        url: pathExamenInstitucional + 'Con_ExamenInstitucional.php',
        type: 'post',
        data: 'consultar=consultar&pk_alumno=' + pk_alumno,
        dataType: 'json',
        success: function(data) {

            if (data.error == 'ok') {
                 $('#ListaConsulta').hide();
                 $('#FormularioEditarAlumno').show();
                $('#frm_AltaExamenInstitucional #pk_alumno').val(data.pk_alumno);
                $('#frm_AltaExamenInstitucional #matricula').val(data.matricula);
                $('#frm_AltaExamenInstitucional #matricula_desc').val(data.matricula);
                
                $('#frm_AltaExamenInstitucional #nombre').val(data.nombre);
                $('#frm_AltaExamenInstitucional #apaterno').val(data.apaterno);                
                $('#frm_AltaExamenInstitucional #amaterno').val(data.amaterno);
                $('#frm_AltaExamenInstitucional #fk_carreras').val(data.fk_carreras);
                
                $('#frm_AltaExamenInstitucional #fechaaplicacion').val(data.fechaaplicacion);                
                $('#frm_AltaExamenInstitucional #timepicker1').val(data.hora);

                if(data.ActaOriginal=='1'){
                    $("#ActaOriginal").prop("checked", true);
                }else{
                    $("#ActaOriginal").prop("checked", false);
                }
                
                if(data.ActaCopia=='1'){
                    $("#ActaCopia").prop("checked", true);
                }else{
                    $("#ActaCopia").prop("checked", false);
                }
                 
                if(data.cbOriginal=='1'){
                    $("#cbOriginal").prop("checked", true);
                }else{
                    $("#cbOriginal").prop("checked", false);
                }
                 
                if(data.cbCopia=='1'){
                    $("#cbCopia").prop("checked", true);
                }else{
                    $("#cbCopia").prop("checked", false);
                }
                 
                if(data.clicOriginal=='1'){
                    $("#clicOriginal").prop("checked", true);
                }else{
                    $("#clicOriginal").prop("checked", false);
                }
                
                 if(data.clicCopia=='1'){
                    $("#clicCopia").prop("checked", true);
                }else{
                    $("#clicCopia").prop("checked", false);
                }
                 
                 
                if(data.curpOriginal=='1'){
                    $("#curpOriginal").prop("checked", true);
                }else{
                    $("#curpOriginal").prop("checked", false);
                }
                
                 if(data.curpCopia=='1'){
                    $("#curpCopia").prop("checked", true);
                }else{
                    $("#curpCopia").prop("checked", false);
                }
                
                
                if(data.consservicioOriginal=='1'){
                    $("#consservicioOriginal").prop("checked", true);
                }else{
                    $("#consservicioOriginal").prop("checked", false);
                }
                
                 if(data.consservicioCopia=='1'){
                    $("#consservicioCopia").prop("checked", true);
                }else{
                    $("#consservicioCopia").prop("checked", false);
                }
                
                
                if(data.reciboOriginal=='1'){
                    $("#reciboOriginal").prop("checked", true);
                }else{
                    $("#reciboOriginal").prop("checked", false);
                }
                
                 if(data.reciboCopia=='1'){
                    $("#reciboCopia").prop("checked", true);
                }else{
                    $("#reciboCopia").prop("checked", false);
                }
                
                
                
                
                 if(data.triniti=='1'){
                    $("#triniti").prop("checked", true);
                }else{
                    $("#triniti").prop("checked", false);
                }
                
                 if(data.trinitiCopia=='1'){
                    $("#trinitiCopia").prop("checked", true);
                }else{
                    $("#trinitiCopia").prop("checked", false);
                }
                
                
                
                $('#frm_AltaExamenInstitucional #ObservacionesDoc').val(data.ObservacionesDoc);                
                $('#frm_AltaExamenInstitucional #recibofolio').val(data.recibofolio);
                $('#frm_AltaExamenInstitucional #Pk_ExamenInstitucional').val(data.Pk_ExamenInstitucional);
                
            }
        }
    });
    
}





function AltaTomaProtesta(pk_alumno){
    
      $.ajax({
        url: pathTomaProtesta + 'Con_TomaProtesta.php',
        type: 'post',
        data: 'consultar=consultar&pk_alumno=' + pk_alumno,
        dataType: 'json',
        success: function(data) {

            if (data.error == 'ok') {
                 $('#ListaConsulta').hide();
                 $('#FormularioEditarAlumno').show();
                $('#frm_AltaTomaProtesta #pk_alumno').val(data.pk_alumno);
                $('#frm_AltaTomaProtesta #matricula').val(data.matricula);
                $('#frm_AltaTomaProtesta #matricula_desc').val(data.matricula);
                
                $('#frm_AltaTomaProtesta #nombre').val(data.nombre);
                $('#frm_AltaTomaProtesta #apaterno').val(data.apaterno);                
                $('#frm_AltaTomaProtesta #amaterno').val(data.amaterno);
                $('#frm_AltaTomaProtesta #fk_carreras').val(data.fk_carreras);
                
                
                //datos listos
                $('#frm_AltaTomaProtesta #pk_tramites').val(data.pk_tramites);                
                $('#frm_AltaTomaProtesta #FechaTomaProtesta').val(data.FechaTomaProtesta);
                $('#frm_AltaTomaProtesta #hora').val(data.horaTomaProtesta);                
                $('#frm_AltaTomaProtesta #salon').val(data.salon);
                $('#frm_AltaTomaProtesta #fk_titulacion').val(data.fk_titulacion);                
                $('#frm_AltaTomaProtesta #nombreTesis').val(data.nombreTesis);
                $('#frm_AltaTomaProtesta #Fk_Duracion').val(data.Fk_Duracion); 
                
                $("#frm_AltaTomaProtesta #presidente").select2("val", data.presidente);
                $("#frm_AltaTomaProtesta #secretario").select2("val", data.secretario);
                $("#frm_AltaTomaProtesta #vocal").select2("val", data.vocal);
                $("#frm_AltaTomaProtesta #suplente").select2("val", data.suplente);
       
                
                $('#frm_AltaTomaProtesta #observacion').val(data.observacion);
                

               
                
            }
        }
    });
    
}





function AltaSecretariaEducacion(pk_alumno){
    
      $.ajax({
        url: pathSecretariaEducacion + 'Con_SecretariaEducacion.php',
        type: 'post',
        data: 'consultar=consultar&pk_alumno=' + pk_alumno,
        dataType: 'json',
        success: function(data) {

            if (data.error == 'ok') {
                 $('#ListaConsulta').hide();
                 $('#FormularioEditarAlumno').show();
                $('#frm_SecretariaEducacion #pk_alumno').val(data.pk_alumno);
                $('#frm_SecretariaEducacion #matricula').val(data.matricula);
                $('#frm_SecretariaEducacion #matricula_desc').val(data.matricula);
                
                $('#frm_SecretariaEducacion #nombre').val(data.nombre);
                $('#frm_SecretariaEducacion #apaterno').val(data.apaterno);                
                $('#frm_SecretariaEducacion #amaterno').val(data.amaterno);
                $('#frm_SecretariaEducacion #fk_carreras').val(data.fk_carreras);
                
                $('#frm_SecretariaEducacion #planEstudios').val(data.planEstudios);
                $('#frm_SecretariaEducacion #promedio').val(data.promedio);
                $('#frm_SecretariaEducacion #letraPromedio').val(data.letraPromedio);
                $('#frm_SecretariaEducacion #curp').val(data.curp);
                
                 $('#frm_SecretariaEducacion #generacionSecre').val(data.generacionSecre);
                 $('#frm_SecretariaEducacion #fk_generacion').val(data.fk_generacion);
                 
                
                
                //datos listos
                $('#frm_SecretariaEducacion #pk_tramites').val(data.pk_tramites);                
                $('#frm_SecretariaEducacion #FechaTomaProtesta').val(data.FechaTomaProtesta);
                $('#frm_SecretariaEducacion #hora').val(data.horaTomaProtesta);                
                $('#frm_SecretariaEducacion #salon').val(data.salon);
                $('#frm_SecretariaEducacion #fk_titulacion').val(data.fk_titulacion);                
                $('#frm_SecretariaEducacion #nombreTesis').val(data.nombreTesis);
                $('#frm_SecretariaEducacion #Fk_Duracion').val(data.Fk_Duracion); 
                
                $("#frm_SecretariaEducacion #presidente").select2("val", data.presidente);
                $("#frm_SecretariaEducacion #secretario").select2("val", data.secretario);
                $("#frm_SecretariaEducacion #vocal").select2("val", data.vocal);
                $("#frm_SecretariaEducacion #suplente").select2("val", data.suplente);
       
                
                $('#frm_SecretariaEducacion #observacion').val(data.observacion);
                
                //ultimos datos
               $('#frm_SecretariaEducacion #FechaSolicitud').val(data.FechaSolicitud);
               $('#frm_SecretariaEducacion #FechaExamen').val(data.FechaExamen);
               $('#frm_SecretariaEducacion #NumeroAutorizacion').val(data.NumeroAutorizacion);
               $('#frm_SecretariaEducacion #FolioActa').val(data.FolioActa);
               $('#frm_SecretariaEducacion #TipoRevoe').val(data.TipoRevoe);
               $('#frm_SecretariaEducacion #ExamenExtraOrdinario').val(data.ExamenExtraOrdinario);
                
            }
        }
    });
    
}


