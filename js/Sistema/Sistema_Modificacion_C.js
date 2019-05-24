$(document).ready(function() {

 $("#f_Editcarreras").submit(function() {
             
            var idCarrera = $('#f_Editcarreras #v_pkCarrera').val();
            var plantel = $('#f_Editcarreras #v_plantel').val();
            var clvCarrera = $('#f_Editcarreras #v_clvCarrera').val();   
            var nomCarrera = $('#f_Editcarreras #v_nomCarrera').val();   
            var revoe = $('#f_Editcarreras #v_revoe').val();   
            var fechaExp= $('#f_Editcarreras #v_fechaexp').val();
            var modalidad = $('#f_Editcarreras #v_modalidad').val();
            var nomTitulo = $('#f_Editcarreras #v_nomTitulo').val();
            var academico = $('#f_Editcarreras #v_academico').val();
            var edificio = $('#f_Editcarreras #v_edificio').val();
            
 
            $.ajax({
                    url: pathCarreras+'Mod_carreras.php',
                    type: 'post',
                    data: "envio=envio&plantel="+plantel+"&clvCarrera="+clvCarrera+"&nomCarrera="+nomCarrera+"&revoe="+revoe+"&fechaExp="+fechaExp+"&modalidad="+modalidad+"&nomTitulo="+nomTitulo+"&academico="+academico+"&edificio="+edificio+"&idCarrera="+idCarrera,
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

function EditarCarrera(id){
    var idCarrera = id;
    
    $.ajax({
        url: pathCarreras + 'Con_datoscarrera.php',
        type:'post',
        data: 'consulta=consulta&idCarrera='+idCarrera,
        dataType:'json',
        success: function(data){
            if(data.error!=''){
                $('#f_Editcarreras #v_pkCarrera').val(data.pk_carreras);
                $('#f_Editcarreras #v_plantel').val(data.pk_dtgenerales);
                $('#f_Editcarreras #v_clvCarrera').val(data.clvCarrera);   
                $('#f_Editcarreras #v_nomCarrera').val(data.nombreCarrera);   
                $('#f_Editcarreras #v_revoe').val(data.noacuerdo);   
                $('#f_Editcarreras #v_fechaexp').val(data.fechaExpedicion);
                $('#f_Editcarreras #v_modalidad').val(data.pk_modalidad);
                $('#f_Editcarreras #v_nomTitulo').val(data.nombreTitulo);
                $('#f_Editcarreras #v_academico').val(data.pk_nivelestudio);
                $('#f_Editcarreras #v_edificio').val(data.edificio);
            }    
        }
        
    });
    
}

function EditUsuer(id){
    var idUser = id
    
    $.ajax({
        url: pathTrabajadores + 'Con_datosusuario.php',
        type:'post',
        data: 'consulta=consulta&idUser='+idUser,
        dataType:'json',
        success: function(data){
            if(data.error!=''){
                $('#f_Editcarreras #v_pkTrabajador').val(data.pk_carreras);
                $('#f_Editcarreras #v_clvTrabajador').val(data.pk_dtgenerales);
                $('#f_Editcarreras #v_nombreUser').val(data.clvCarrera);   
                $('#f_Editcarreras #v_apaterno').val(data.nombreCarrera);   
                $('#f_Editcarreras #v_amaterno').val(data.noacuerdo);   
                $('#f_Editcarreras #v_tel').val(data.fechaExpedicion);
                $('#f_Editcarreras #v_correo').val(data.pk_modalidad);
                $('#f_Editcarreras #v_puesto').val(data.nombreTitulo);
                $('#f_Editcarreras #v_area').val(data.pk_nivelestudio);
            }    
        }
        
    });
}