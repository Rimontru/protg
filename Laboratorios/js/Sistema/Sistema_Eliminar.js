$(document).ready(function(){
   
   
    

$("#f_SalidasMateriales").submit(function() {	
    
     var str = $("#f_SalidasMateriales").serialize();

        $.ajax({
           url: pathMateriales +'Mod_SalidasMateriales.php',
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



function EliminarMateriales(Pk_material){
    

    alertify.set({ labels: {
        ok     : "Aceptar",
        cancel : "Cancelar"
    } });
    alertify.confirm("¿Esta seguro que desea dar de baja el Material Seleccionado?", function (e) {
    if (e) {
        // user clicked "ok"
          $.ajax({
                    url: pathMateriales + 'Elimina_DatosMateriales.php',
                    type: 'post',
                    data: 'eliminar=eliminar&Pk_material=' + Pk_material,
                    success: function(data) {
                        if(data!=""){
                            var validar = data.split('|');
                           if(validar[0]=='1'){
                              
                                  alertify.alert(validar[1], function (e) {
                                    if (e) {
                                        // user clicked "ok"
                                        window.location.reload();
                                    } 
                                });

                            //$(”#Formulario1″)[0].reset();
                            }else{
                            
                                alertify.error(validar[1]);

                            }

                        }
                    }
            });
    } else {
        // user clicked "cancel"
    }
});
}


function SalidasMateriales(Pk_material){
  $.ajax({
        url: pathMateriales + 'Con_Materiales.php',
        type:'post',
        data: 'consulta=consulta&Pk_material='+Pk_material,
        dataType:'json',
        success: function(data){
            if(data.error!=''){
                $('#f_SalidasMateriales #Pk_material').val(data.Pk_material);
                $('#f_SalidasMateriales #NumeroInventario').val(data.NumeroInventario);
                $('#f_SalidasMateriales #DescripcionMaterial').val(data.DescripcionMaterial);
                $('#f_SalidasMateriales #CantidadMaterial').val(data.CantidadMaterial);   
                $('#f_SalidasMateriales #Fk_UnidadMedida').val(data.Fk_UnidadMedida);   
                 $('#f_SalidasMateriales #CantidadMaterialDisabled').val(data.CantidadMaterial);  
                $('#f_SalidasMateriales #CantidadSalida').focus();
           
            }    
        }
        
    });
    
}