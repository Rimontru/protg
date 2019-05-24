$(document).ready(function() {


    //*********************  modulo de escuelas     ********************** //
    //*********************          Melo           ********************** //
  
     $("#f_datosmaterialesModificar").submit(function() {
     var str = $("#f_datosmaterialesModificar").serialize();	
        $.ajax({
            url: pathMateriales + 'Mod_Materiales.php', //primera parte
            type: 'post',
            data: str,
            beforeSend: function (){
                       $("#botonera2").hide();
                       $("#loading-data2").html("Procesando, espere por favor... <img src='assets/img/ajax-loaders/ajax-loader-1.gif'>");
                    },
            success: function(data){
                if(data!=""){
                    var validar = data.split('|');
                   if(validar[0]=='1'){
                        $("#botonera2").show();
                        $("#loading-data2").hide();
                        
                         alertify.alert(validar[1], function (e) {
                            if (e) {
                                // user clicked "ok"
                                window.location.reload();
                            } 
                        });
    

                    //$(”#Formulario1″)[0].reset();
                    }else{
                        $("#botonera2").show();
                        $("#loading-data2").hide();
                        alertify.error(validar[1]);
                        
                    }

                }
            }
        });
        return false;
    });

    
 
   




});


function ModificarMaterialesSolo(Pk_material){
    
      $.ajax({
        url: pathMateriales + 'Con_Materiales.php',
        type: 'post',
        data: 'consultar=consultar&Pk_material=' + Pk_material,
        dataType: 'json',
        success: function(data) {

            if (data.error == 'ok') {
                 $('#ListaConsulta').hide();
                 $('#FormularioEditarAlumno').show();
                $('#f_datosmaterialesModificar #Pk_material').val(data.Pk_material);
                $('#f_datosmaterialesModificar #fk_laboratorios').val(data.fk_laboratorios);
                $('#f_datosmaterialesModificar #fk_clasematerial').val(data.fk_clasematerial);
                
                $('#f_datosmaterialesModificar #DescripcionMaterial').val(data.DescripcionMaterial);
                $('#f_datosmaterialesModificar #CantidadMaterial').val(data.CantidadMaterial);                
                $('#f_datosmaterialesModificar #MedidasMaterial').val(data.MedidasMaterial);
                $('#f_datosmaterialesModificar #Fk_TipoMaterial').val(data.Fk_TipoMaterial);
                $('#f_datosmaterialesModificar #MarcaMaterial').val(data.MarcaMaterial);
                $('#f_datosmaterialesModificar #Fk_EstadoMaterial').val(data.Fk_EstadoMaterial);
                $('#f_datosmaterialesModificar #ObservacionesMaterial').val(data.ObservacionesMaterial);
                $('#f_datosmaterialesModificar #Almacenado').val(data.Almacenado);
                $('#f_datosmaterialesModificar #Uso').val(data.Uso);                
                $('#f_datosmaterialesModificar #fk_frecuenciauso').val(data.fk_frecuenciauso);
                $('#f_datosmaterialesModificar #NumeroInventario').val(data.NumeroInventario);
               
                $('#f_datosmaterialesModificar #ActivoMaterial').val(data.ActivoMaterial);
                
                $('#f_datosmaterialesModificar #Fk_UnidadMedida').val(data.Fk_UnidadMedida);
                $('#f_datosmaterialesModificar #fk_laboratorios').val(data.fk_laboratorios);
               
                

            
            }
        }
    });
    
}




