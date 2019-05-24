$(document).ready(function() {

    /***** Ivan Mauricio Meneses Melo Granados *************/


    var contadorPermisos = 2;     
    $("#Agrega_Permiso").click(function(){  
        var Filas = '<tr id="Filas'+contadorPermisos+'">';        
        Filas = Filas + '<td><select name="Modulo[]" id="Modulo'+contadorPermisos+'"></select></td>'
        Filas = Filas + '<td><a href="" class="elimina" id="EliminarPermiso'+contadorPermisos+'" title= "Eliminar"><img src="img/iconos/delete.png"></a></td>';
        Filas = Filas + '</tr>'; 
        $("#asigna-permisos").append(Filas);

        $("#Modulo"+contadorPermisos).load(pathUsuarios+"Con_ModuloCombo.php");
        
       $("#EliminarPermiso"+contadorPermisos).click(function(){
            var currentId = $(this).attr('id');			
            var element = currentId.spfrm_busqueda_alumnos_modificarlit('o');
            var num = element[1];
            // alert(num);
            $("#Filas"+num).remove();
            return false;
        });
        
        
      contadorPermisos++;
        return false;
    });

    
    

//busqueda alumnos modificar    
$("#frm_busqueda_alumnos_modificar").submit(function() {	
     var str = $("#frm_busqueda_alumnos_modificar").serialize();
       $('#ListaConsulta').show();
       $('#FormularioEditarAlumno').hide();
        $.ajax({
            url: pathMateriales +'lista_DatosMateriales.php',
            type: 'post',
            data: str,
            beforeSend: function (){
                       $("#botonera").hide();
                       $("#loading-data").html("Procesando, espere por favor... <img src='assets/img/ajax-loaders/ajax-loader-1.gif'>");
                    },
            success: function(data){
                if(data!=""){
                 
                        $("#botonera").show();
                        $("#loading-data").hide();
                         
                         $("#ListaConsulta").html(data);
                         $("#example_filter").hide();

                }
            }
        });
        return false;
    });
 
 
 
 
    
});






