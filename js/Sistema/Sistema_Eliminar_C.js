$(document).ready(function(){
   
   
    


        
});

//FUNCIONES PARA ELIMINAR Y RECUPERAR CARRERA
function BorrarCarrera(id){
    var idCarrera = id;
     alertify.set({ labels: {
        ok     : "Aceptar",
        cancel : "Cancelar"
    } });
    alertify.confirm("¿Esta seguro de realizar esta acción?", function (e) {
    if (e) {
          $.ajax({
                    url: pathCarreras + 'Elimina_Carrera.php',
                    type: 'post',
                    data: 'eliminar=eliminar&idCarrera=' + idCarrera,
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
    }
});


}

function Recuperar(id)
{
    var idCarrera = id;
     alertify.set({ labels: {
        ok     : "Aceptar",
        cancel : "Cancelar"
    } });

    alertify.confirm("¿Esta seguro de realizar esta acción?", function (e) {
    if (e) {
          $.ajax({
                    url: pathCarreras + 'Recupera_Carrera.php',
                    type: 'post',
                    data: 'recuperar=recuperar&idCarrera=' + idCarrera,
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
                                //alertify.success("Success notification");
                            //$(”#Formulario1″)[0].reset();
                            }else{
                            
                                alertify.error(validar[1]);

                            }

                        }
                    }
            });
    }
    
});

}


//FUNCIUONES PARA ELIMINAR Y RECUEPRAR USUARIOS

function Borrartrabajador(id){
    var idTrabajador = id;
    alertify.set({ labels: {
        ok     : "Aceptar",
        cancel : "Cancelar"
    } });

    alertify.confirm("¿Esta seguro de realizar esta acción?", function (e) {
    if (e) {
          $.ajax({
                    url: pathTrabajadores + 'Elimina_Usuario.php',
                    type: 'post',
                    data: 'eliminar=eliminar&idTrabajador=' + idTrabajador,
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
                                //alertify.success("Success notification");
                            //$(”#Formulario1″)[0].reset();
                            }else{
                            
                                alertify.error(validar[1]);

                            }

                        }
                    }
            });
    }
    
});
}


function Recuperartrabajador(id)
{
    var idUser = id;
     alertify.set({ labels: {
        ok     : "Aceptar",
        cancel : "Cancelar"
    } });

    alertify.confirm("¿Esta seguro de realizar esta acción?", function (e) {
    if (e) {
          $.ajax({
                    url: pathTrabajadores + 'Recupera_User.php',
                    type: 'post',
                    data: 'recuperar=recuperar&idUser=' + idUser,
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
                                //alertify.success("Success notification");
                            //$(”#Formulario1″)[0].reset();
                            }else{
                            
                                alertify.error(validar[1]);

                            }

                        }
                    }
            });
    }
    
});

}


//FUNCIONES PARA ELIMINAR EMPLEADOR
function BorrarEmpleador(id){
    var idEmpleador = id;
     alertify.set({ labels: {
        ok     : "Aceptar",
        cancel : "Cancelar"
    } });
    alertify.confirm("�Esta seguro de realizar esta acci�n?", function (e) {
    if (e) {
          $.ajax({
                    url: pathEmpleadores + 'Elimina_empleadores.php',
                    type: 'post',
                    data: 'eliminar=eliminar&idEmpleador=' + idEmpleador,
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

                            //$(�#Formulario1?)[0].reset();
                            }else{
                            
                                alertify.error(validar[1]);

                            }

                        }
                    }
            });
    }
});


}

