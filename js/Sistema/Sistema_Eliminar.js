$(document).ready(function(){
   
   
    


        
});

function EliminarInstitucion(pk_dtgenerales){
    // prompt dialog
    alertify.set({ labels: {
        ok     : "Aceptar",
        cancel : "Cancelar"
    } });
    alertify.confirm("¿Esta seguro que desea eliminar la Institucion?", function (e) {
    if (e) {
        // user clicked "ok"
          $.ajax({
                    url: pathDatosInstitucion + 'Elimina_DatosInstitucion.php',
                    type: 'post',
                    data: 'eliminar=eliminar&pk_dtgenerales=' + pk_dtgenerales,
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






function RecuperarBajaInstitucion(pk_dtgenerales){
    // prompt dialog
    alertify.set({ labels: {
        ok     : "Aceptar",
        cancel : "Cancelar"
    } });
    alertify.confirm("¿Esta seguro que desea Recuperar la Institucion?", function (e) {
    if (e) {
        // user clicked "ok"
          $.ajax({
                    url: pathDatosInstitucion + 'Con_RecuperarBaja.php',
                    type: 'post',
                    data: 'recuperar=recuperar&pk_dtgenerales=' + pk_dtgenerales,
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








function EliminarGeneraciones(pk_generacion){
    // prompt dialog
    alertify.set({ labels: {
        ok     : "Aceptar",
        cancel : "Cancelar"
    } });
    alertify.confirm("¿Esta seguro que desea eliminar la Generación?", function (e) {
    if (e) {
        // user clicked "ok"
          $.ajax({
                    url: pathGeneraciones + 'Elimina_Generaciones.php',
                    type: 'post',
                    data: 'eliminar=eliminar&pk_generacion=' + pk_generacion,
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








function RecuperarBajaGeneracion(pk_generacion){
    // prompt dialog
    alertify.set({ labels: {
        ok     : "Aceptar",
        cancel : "Cancelar"
    } });
    alertify.confirm("¿Esta seguro que desea Recuperar la Generación?", function (e) {
    if (e) {
        // user clicked "ok"
          $.ajax({
                    url: pathGeneraciones + 'Con_RecuperarBaja.php',
                    type: 'post',
                    data: 'recuperar=recuperar&pk_generacion=' + pk_generacion,
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









//
//
//
//
//function EliminarSinodales(pk_sinodal){
//    // prompt dialog
//    alertify.set({ labels: {
//        ok     : "Aceptar",
//        cancel : "Cancelar"
//    } });
//    alertify.confirm("¿Esta seguro que desea eliminar al Sinodal?", function (e) {
//    if (e) {
//        // user clicked "ok"
//          $.ajax({
//                    url: pathSinodales + 'Elimina_DatosSinodales.php',
//                    type: 'post',
//                    data: 'eliminar=eliminar&pk_sinodal=' + pk_sinodal,
//                    success: function(data) {
//                        if(data!=""){
//                            var validar = data.split('|');
//                           if(validar[0]=='1'){
//                              
//                                  alertify.alert(validar[1], function (e) {
//                                    if (e) {
//                                        // user clicked "ok"
//                                        window.location.reload();
//                                    } 
//                                });
//
//                            //$(”#Formulario1″)[0].reset();
//                            }else{
//                            
//                                alertify.error(validar[1]);
//
//                            }
//
//                        }
//                    }
//            });
//    } else {
//        // user clicked "cancel"
//    }
//});
//}
//
//
//
//




function RecuperarBajaSinodal(pk_sinodal, pk_carreras){
    // prompt dialog
    alertify.set({ labels: {
        ok     : "Aceptar",
        cancel : "Cancelar"
    } });
    alertify.confirm("¿Esta seguro que desea Recuperar el Sinodal?", function (e) {
    if (e) {
        // user clicked "ok"
          $.ajax({
                    url: pathSinodales + 'Con_RecuperarBaja.php',
                    type: 'post',
                    data: 'recuperar=recuperar&pk_sinodal=' + pk_sinodal + "&pk_carreras="+pk_carreras,
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









function EliminarSinodales(pk_sinodal, pk_carreras){
    

    alertify.set({ labels: {
        ok     : "Aceptar",
        cancel : "Cancelar"
    } });
    alertify.confirm("¿Esta seguro que desea eliminar el Sinodal?", function (e) {
    if (e) {
        // user clicked "ok"
          $.ajax({
                    url: pathSinodales + 'Elimina_DatosSinodales.php',
                    type: 'post',
                    data: 'eliminar=eliminar&pk_sinodal=' + pk_sinodal +"&pk_carreras="+pk_carreras,
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