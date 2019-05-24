
$(document).ready(function() {

    /***** Ivan Mauricio Meneses Melo Granados *************/

//
//    var contadorPermisos = 2;     
//    $("#Agrega_Permiso").click(function(){  
//        var Filas = '<tr id="Filas'+contadorPermisos+'">';        
//        Filas = Filas + '<td><select name="Modulo[]" id="Modulo'+contadorPermisos+'"></select></td>'
//        Filas = Filas + '<td><a href="" class="elimina" id="EliminarPermiso'+contadorPermisos+'" title= "Eliminar"><img src="assets/img/delete.png"></a></td>';
//        Filas = Filas + '</tr>'; 
//        $("#asigna-permisos").append(Filas);
//
//        $("#Modulo"+contadorPermisos).load(pathSistema+"Con_ModuloCombo.php");
//        
//       $("#EliminarPermiso"+contadorPermisos).click(function(){
//            var currentId = $(this).attr('id');			
//            var element = currentId.spfrm_busqueda_alumnos_modificarlit('o');
//            var num = element[1];
//            // alert(num);
//            $("#Filas"+num).remove();
//            return false;
//        });
//        
//        
//      contadorPermisos++;
//        return false;
//    });
//
//    
    
    
    
    
    
    
    //seleccionar municipio dependiendo el estado
     $("#f_datosinstitucion #v_estado").change(function () {
        $("#f_datosinstitucion #v_estado option:selected").each(function () {
           indiceElegido=$(this).val();
           elegido=$(this).text();
           
           if(indiceElegido!=""){
                $.ajax({
                    url: pathSistema + 'CodigosPostales/Obtener_Municipios.php',
                    type: 'post',
                    data: "ObtenerMunicipio=ObtenerMunicipio&v_estado="+indiceElegido,
                    dataType: 'json',
                    success: function(data) {
                        if (data.Municipios != "Error") {
                            $("#v_Municipio").html(data.Municipios);
                        }else{
                             $("#v_Municipio").html("");
                        }
                    }
                });
            }
            
        });     
    });
    
    
    
    
    //obtener colonia dependiendo el municipio
      $("#f_datosinstitucion #v_Municipio").change(function () {
        $("#f_datosinstitucion #v_Municipio option:selected").each(function () {
           indiceElegido=$(this).val();
           elegido=$(this).text();
           
           if(indiceElegido!=""){
                $.ajax({
                    url: pathSistema + 'CodigosPostales/Obtener_Colonias.php',
                    type: 'post',
                    data: "ObtenerColonias=ObtenerColonias&v_Municipio="+indiceElegido,
                    dataType: 'json',
                    success: function(data) {
                        if (data.Colonias != "Error") {
                            $("#v_coloniafracc").html(data.Colonias);
                        }else{
                             $("#v_coloniafracc").html("");
                        }
                    }
                });
            }
            
        });     
    });
    
    
    
    
    
    
    
    
    //
    // CARGAR cATALOGO ESTADOS MUNICPIOS COLONIAS DE ALUMNOS
    //
    //seleccionar municipio dependiendo el estado
     $("#f_datosalumnos #v_estado").change(function () {
        $("#f_datosalumnos #v_estado option:selected").each(function () {
           indiceElegido=$(this).val();
           elegido=$(this).text();
           
           if(indiceElegido!=""){
                $.ajax({
                    url: pathSistema + 'CodigosPostales/Obtener_Municipios.php',
                    type: 'post',
                    data: "ObtenerMunicipio=ObtenerMunicipio&v_estado="+indiceElegido,
                    dataType: 'json',
                    success: function(data) {
                        if (data.Municipios != "Error") {
                            $("#v_Municipio").html(data.Municipios);
                        }else{
                             $("#v_Municipio").html("");
                        }
                    }
                });
            }
            
        });     
    });
    
    
    
    
    //obtener colonia dependiendo el municipio
      $("#f_datosalumnos #v_Municipio").change(function () {
        $("#f_datosalumnos #v_Municipio option:selected").each(function () {
           indiceElegido=$(this).val();
           elegido=$(this).text();
           
           if(indiceElegido!=""){
                $.ajax({
                    url: pathSistema + 'CodigosPostales/Obtener_Colonias.php',
                    type: 'post',
                    data: "ObtenerColonias=ObtenerColonias&v_Municipio="+indiceElegido,
                    dataType: 'json',
                    success: function(data) {
                        if (data.Colonias != "Error") {
                            $("#v_coloniafracc").html(data.Colonias);
                        }else{
                             $("#v_coloniafracc").html("");
                        }
                    }
                });
            }
            
        });     
    });
    
    
    
    
    //codigos postales dependiendo la colonia
        $("#f_datosalumnos #v_coloniafracc").change(function () {
        $("#f_datosalumnos #v_coloniafracc option:selected").each(function () {
           indiceElegido=$(this).val();
           elegido=$(this).text();
           
           if(indiceElegido!=""){
                $.ajax({
                    url: pathSistema + 'CodigosPostales/Obtener_CodigoPostal.php',
                    type: 'post',
                    data: "ObtenerCodigoPostal=ObtenerCodigoPostal&v_coloniafracc="+indiceElegido,
                    dataType: 'json',
                    success: function(data) {
                        if (data.Colonias != "Error") {
                            $("#codigopostal").val(data.CodigoPostal);
                        }else{
                             $("#codigopostal").val("");
                        }
                    }
                });
            }
            
        });     
    });
    
    
    //obtener carreras por modalidad
     $("#f_datosalumnos #fk_modalidad").change(function () {
        $("#f_datosalumnos #fk_modalidad option:selected").each(function () {
           indiceElegido=$(this).val();
           elegido=$(this).text();
           var fk_nivelestudio = $("#f_datosalumnos #fk_nivelestudio").val();
           if(indiceElegido!=""){
               
               
               if(fk_nivelestudio!=""){
                        $.ajax({
                            url: pathCarreras + 'Con_CarrerasModalidad.php',
                            type: 'post',
                            data: "ObtenerModalidad=ObtenerModalidad&fk_modalidad="+ indiceElegido + "&fk_nivelestudio="+fk_nivelestudio,
                            dataType: 'json',
                            success: function(data) {
                                if (data.Municipios != "Error") {
                                    $("#fk_carreras").html(data.Carreras);
                                }else{
                                     $("#fk_carreras").html("");
                                }
                            }
                        });
                   
               }else{
                   $("#f_datosalumnos #fk_modalidad").val("");
                    alertify.error("Seleccione el Nivel de Estudios.");
                    
               }
                
                
                
                
                
                
            }
            
        });     
    });
    
    
    
    
    
    
    //obtener carreras por modalidad
     $("#f_datosalumnos #fk_nivelestudio").change(function () {
        $("#f_datosalumnos #fk_nivelestudio option:selected").each(function () {
           indiceElegido=$(this).val();
           elegido=$(this).text();
           var fk_nivelestudio = $("#f_datosalumnos #fk_nivelestudio").val();
           var fk_modalidad = $("#f_datosalumnos #fk_modalidad").val();
           if(indiceElegido!=""){
               
               
               if(fk_nivelestudio!=""){
                        $.ajax({
                            url: pathCarreras + 'Con_CarrerasModalidad.php',
                            type: 'post',
                            data: "ObtenerModalidad=ObtenerModalidad&fk_modalidad="+ fk_modalidad + "&fk_nivelestudio="+fk_nivelestudio,
                            dataType: 'json',
                            success: function(data) {
                                if (data.Municipios != "Error") {
                                    $("#fk_carreras").html(data.Carreras);
                                }else{
                                     $("#fk_carreras").html("");
                                }
                            }
                        });
                   
               }else{
                   $("#f_datosalumnos #fk_modalidad").val("");
                    alertify.error("Seleccione el Nivel de Estudios.");
                    
               }
                
                
                
                
                
                
            }
            
        });     
    });
    
    
    
    
    
    
//busqueda egresados    
$("#frm_busqueda_egresados").submit(function() {	
     var str = $("#frm_busqueda_egresados").serialize();
       $('#ListaConsulta').show();
       $('#FormularioEditarAlumno').hide();
        $.ajax({
            url: pathEgresados +'lista_DatosEgresados.php',
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





//busqueda egresados    
$("#frm_busqueda_trabajadores").submit(function() {	
     var str = $("#frm_busqueda_trabajadores").serialize();
       $('#ListaConsulta').show();
       $('#FormularioEditarAlumno').hide();
        $.ajax({
            url: pathSistema +'Usuario/lista_DatosTrabajadores.php',
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


   
   
   
   
   
//busqueda egresados encuesta medicina  
$("#frm_busqueda_encuestaEgresadosMedicina").submit(function() {	
     var str = $("#frm_busqueda_encuestaEgresadosMedicina").serialize();
       $('#ListaConsulta').show();
       $('#FormularioEditarAlumno').hide();
        $.ajax({
            url: pathEgresados +'lista_DatosEgresadosEncuesta.php',
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




//busqueda egresados encuesta Maestria  
$("#frm_busqueda_encuestaEgresadosMaestria").submit(function() {	
     var str = $("#frm_busqueda_encuestaEgresadosMaestria").serialize();
       $('#ListaConsulta').show();
       $('#FormularioEditarAlumno').hide();
        $.ajax({
            url: pathEgresados +'lista_DatosEgresadosEncuestaMaestria.php',
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




//busqueda egresados encuesta Maestria  
$("#frm_busqueda_encuestaEgresadosDoctorado").submit(function() {	
     var str = $("#frm_busqueda_encuestaEgresadosDoctorado").serialize();
       $('#ListaConsulta').show();
       $('#FormularioEditarAlumno').hide();
        $.ajax({
            url: pathEgresados +'lista_DatosEgresadosEncuestaDoctorado.php',
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






//busqueda alumnos modificar    
$("#frm_busqueda_alumnos_modificar").submit(function() {	
     var str = $("#frm_busqueda_alumnos_modificar").serialize();
       $('#ListaConsulta').show();
       $('#FormularioEditarAlumno').hide();
        $.ajax({
            url: pathAlumnos +'lista_DatosAlumnos.php',
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
 
 
 
 
 
//busqueda alumnos para toma de protesta
$("#frm_busquedaExamenIns").submit(function() {	
     var str = $("#frm_busquedaExamenIns").serialize();
       $('#ListaConsulta').show();
       $('#FormularioEditarAlumno').hide();
        $.ajax({
            url: pathExamenInstitucional +'lista_DatosExamenInstitucional.php',
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
    
    
    
    
//busqueda alumnos para toma de protesta
$("#frm_busquedaTomaProtesta").submit(function() {	
     var str = $("#frm_busquedaTomaProtesta").serialize();
       $('#ListaConsulta').show();
       $('#FormularioEditarAlumno').hide();
        $.ajax({
            url: pathTomaProtesta +'lista_DatosTomaProtesta.php',
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
    
    
    
    
    
    $("#frm_busquedaTomaProtestaReportes").submit(function() {	
     var str = $("#frm_busquedaTomaProtestaReportes").serialize();
       $('#ListaConsulta').show();
       $('#FormularioEditarAlumno').hide();
        $.ajax({
            url: pathTomaProtesta +'lista_DatosTomaProtestaReportes.php',
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
    
    
    
    
    
    
   
//busqueda alumnos para toma de protesta
$("#frm_busquedaSecretariaEdu").submit(function() {
     var str = $("#frm_busquedaSecretariaEdu").serialize();
       $('#ListaConsulta').show();
       $('#FormularioEditarAlumno').hide();
        $.ajax({
            url: pathSecretariaEducacion +'lista_DatosSecretariaEducacion.php',
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
    
    
    
    
    
    
    $("#frm_busquedaSecretariaEducacionReportes").submit(function() {
     var str = $("#frm_busquedaSecretariaEducacionReportes").serialize();
       $('#ListaConsulta').show();
       $('#FormularioEditarAlumno').hide();
        $.ajax({
            url: pathSecretariaEducacion +'lista_DatosTomaProtestaReportesSecreEdu.php',
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
     
    //
    // CARGAR cATALOGO ESTADOS MUNICPIOS COLONIAS DE ENCUESTA MEDICINA
    //
    //seleccionar municipio dependiendo el estado
     $("#frm_datosEncuestaMedicina #v_estado").change(function () {
        $("#frm_datosEncuestaMedicina #v_estado option:selected").each(function () {
           indiceElegido=$(this).val();
           elegido=$(this).text();
   
           if(indiceElegido!=""){
                $.ajax({
                    url: pathSistema + 'CodigosPostales/Obtener_Municipios.php',
                    type: 'post',
                    data: "ObtenerMunicipio=ObtenerMunicipio&v_estado="+indiceElegido,
                    dataType: 'json',
                    success: function(data) {
                        if (data.Municipios != "Error") {
                            $("#v_Municipio").html(data.Municipios);
                           $("#v_coloniafracc").html("");
                            //$("#f_ReporteSinodalesPago #v_Municipio").select2("val", data.Municipios);
                        }else{
                             $("#v_Municipio").html("");
                             
//                              $("#f_ReporteSinodalesPago #v_Municipio").select2("val", "");
                              //$("#f_ReporteSinodalesPago #v_coloniafracc").select2("val", "");
                        }
                    }
                });
            }
            
        });     
    });
    
    
    
    
    //obtener colonia dependiendo el municipio
      $("#frm_datosEncuestaMedicina #v_Municipio").change(function () {
        $("#frm_datosEncuestaMedicina #v_Municipio option:selected").each(function () {
           indiceElegido=$(this).val();
           elegido=$(this).text();
           
           if(indiceElegido!=""){
                $.ajax({
                    url: pathSistema + 'CodigosPostales/Obtener_Colonias.php',
                    type: 'post',
                    data: "ObtenerColonias=ObtenerColonias&v_Municipio="+indiceElegido,
                    dataType: 'json',
                    success: function(data) {
                        if (data.Colonias != "Error") {
                            $("#v_coloniafracc").html(data.Colonias);
                            //$("#f_ReporteSinodalesPago #v_coloniafracc").select2("val", data.Colonias);
                        }else{
                             //$("#v_coloniafracc").html("");
                             $("#f_ReporteSinodalesPago #v_coloniafracc").select2("val", "");
                        }
                    }
                });
            }
            
        });     
    });
    
    
    
    
    //codigos postales dependiendo la colonia
        $("#frm_datosEncuestaMedicina #v_coloniafracc").change(function () {
        $("#frm_datosEncuestaMedicina #v_coloniafracc option:selected").each(function () {
           indiceElegido=$(this).val();
           elegido=$(this).text();
           
           if(indiceElegido!=""){
                $.ajax({
                    url: pathSistema + 'CodigosPostales/Obtener_CodigoPostal.php',
                    type: 'post',
                    data: "ObtenerCodigoPostal=ObtenerCodigoPostal&v_coloniafracc="+indiceElegido,
                    dataType: 'json',
                    success: function(data) {
                        if (data.Colonias != "Error") {
                            $("#codigopostal").val(data.CodigoPostal);
                        }else{
                            // $("#codigopostal").val("");
                             $("#frm_datosEncuestaMedicina #codigopostal").select2("val", "");
                        }
                    }
                });
            }
            
        });     
    });
    
    
    
    
    
     //
    // CARGAR cATALOGO ESTADOS MUNICPIOS COLONIAS DE EGRESADOS
    //
    //seleccionar municipio dependiendo el estado
     $("#frm_datosAlumnoModificar #v_estado").change(function () {
        $("#frm_datosAlumnoModificar #v_estado option:selected").each(function () {
           indiceElegido=$(this).val();
           elegido=$(this).text();
           
           if(indiceElegido!=""){
                $.ajax({
                    url: pathSistema + 'CodigosPostales/Obtener_Municipios.php',
                    type: 'post',
                    data: "ObtenerMunicipio=ObtenerMunicipio&v_estado="+indiceElegido,
                    dataType: 'json',
                    success: function(data) {
                        if (data.Municipios != "Error") {
                            $("#v_Municipio").html(data.Municipios);
                        }else{
                             $("#v_Municipio").html("");
                        }
                    }
                });
            }
            
        });     
    });
    
    
    
    
    //obtener colonia dependiendo el municipio
      $("#frm_datosAlumnoModificar #v_Municipio").change(function () {
        $("#frm_datosAlumnoModificar #v_Municipio option:selected").each(function () {
           indiceElegido=$(this).val();
           elegido=$(this).text();
           
           if(indiceElegido!=""){
                $.ajax({
                    url: pathSistema + 'CodigosPostales/Obtener_Colonias.php',
                    type: 'post',
                    data: "ObtenerColonias=ObtenerColonias&v_Municipio="+indiceElegido,
                    dataType: 'json',
                    success: function(data) {
                        if (data.Colonias != "Error") {
                            $("#v_coloniafracc").html(data.Colonias);
                        }else{
                             $("#v_coloniafracc").html("");
                        }
                    }
                });
            }
            
        });     
    });
    
    
    
    
    //codigos postales dependiendo la colonia
        $("#frm_datosAlumnoModificar #v_coloniafracc").change(function () {
        $("#frm_datosAlumnoModificar #v_coloniafracc option:selected").each(function () {
           indiceElegido=$(this).val();
           elegido=$(this).text();
           
           if(indiceElegido!=""){
                $.ajax({
                    url: pathSistema + 'CodigosPostales/Obtener_CodigoPostal.php',
                    type: 'post',
                    data: "ObtenerCodigoPostal=ObtenerCodigoPostal&v_coloniafracc="+indiceElegido,
                    dataType: 'json',
                    success: function(data) {
                        if (data.Colonias != "Error") {
                            $("#codigopostal").val(data.CodigoPostal);
                        }else{
                             $("#codigopostal").val("");
                        }
                    }
                });
            }
            
        });     
    });
    
    
    
    
    
    
    
    
    
    
    
    //se utiliza para la realizacion de folios
    //obtener carreras por modalidad
     $("#f_AsignarFolios #fk_modalidad").change(function () {
        $("#f_AsignarFolios #fk_modalidad option:selected").each(function () {
           indiceElegido=$(this).val();
           elegido=$(this).text();
           var fk_nivelestudio = $("#f_AsignarFolios #fk_nivelestudio").val();
           if(indiceElegido!=""){
               
               
               if(fk_nivelestudio!=""){
                        $.ajax({
                            url: pathCarreras + 'Con_CarrerasModalidad.php',
                            type: 'post',
                            data: "ObtenerModalidad=ObtenerModalidad&fk_modalidad="+ indiceElegido + "&fk_nivelestudio="+fk_nivelestudio,
                            dataType: 'json',
                            success: function(data) {
                                if (data.Carreras != "Error") {
                                    $("#f_AsignarFolios #fk_carreras").html(data.Carreras);
                                }else{
                                     $("#f_AsignarFolios #fk_carreras").html("");
                                }
                            }
                        });
                   
               }else{
                   $("#f_AsignarFolios #fk_modalidad").val("");
                    alertify.error("Seleccione el Nivel de Estudios.");
                    
               }
                
                
                
                
                
                
            }
            
        });     
    });
    
    
    
    
    
    
    //obtener carreras por modalidad
     $("#f_AsignarFolios #fk_nivelestudio").change(function () {
        $("#f_AsignarFolios #fk_nivelestudio option:selected").each(function () {
           indiceElegido=$(this).val();
           elegido=$(this).text();
           var fk_nivelestudio = $("#f_AsignarFolios #fk_nivelestudio").val();
           var fk_modalidad = $("#f_AsignarFolios #fk_modalidad").val();
           if(indiceElegido!=""){
               
               
               if(fk_nivelestudio!=""){
                        $.ajax({
                            url: pathCarreras + 'Con_CarrerasModalidad.php',
                            type: 'post',
                            data: "ObtenerModalidad=ObtenerModalidad&fk_modalidad="+ fk_modalidad + "&fk_nivelestudio="+fk_nivelestudio,
                            dataType: 'json',
                            success: function(data) {
                                if (data.Carreras != "Error") {
                                    $("#f_AsignarFolios #fk_carreras").html(data.Carreras);
                                }else{
                                     $("#f_AsignarFolios #fk_carreras").html("");
                                }
                            }
                        });
                   
               }else{
                   $("#f_AsignarFolios #fk_modalidad").val("");
                    alertify.error("Seleccione el Nivel de Estudios.");
                    
               }
                
                
                
                
                
                
            }
            
        });     
    });
    
    
   
    
    
    
    
    
    
    
    
    //se utiliza para registro asistencias
    //obtener carreras por modalidad
     $("#f_RegistroAsistencia #fk_modalidad").change(function () {
        $("#f_RegistroAsistencia #fk_modalidad option:selected").each(function () {
           indiceElegido=$(this).val();
           elegido=$(this).text();
           var fk_nivelestudio = $("#f_RegistroAsistencia #fk_nivelestudio").val();
           if(indiceElegido!=""){
               
               
               if(fk_nivelestudio!=""){
                        $.ajax({
                            url: pathCarreras + 'Con_CarrerasModalidad.php',
                            type: 'post',
                            data: "ObtenerModalidad=ObtenerModalidad&fk_modalidad="+ indiceElegido + "&fk_nivelestudio="+fk_nivelestudio,
                            dataType: 'json',
                            success: function(data) {
                                if (data.Carreras != "Error") {
                                    $("#f_RegistroAsistencia #fk_carreras").html(data.Carreras);
                                }else{
                                     $("#f_RegistroAsistencia #fk_carreras").html("");
                                }
                            }
                        });
                   
               }else{
                   $("#f_RegistroAsistencia #fk_modalidad").val("");
                    alertify.error("Seleccione el Nivel de Estudios.");
                    
               }
                
                
                
                
                
                
            }
            
        });     
    });
    
    //obtener carreras por modalidad
     $("#f_RegistroAsistencia #fk_nivelestudio").change(function () {
        $("#f_RegistroAsistencia #fk_nivelestudio option:selected").each(function () {
           indiceElegido=$(this).val();
           elegido=$(this).text();
           var fk_nivelestudio = $("#f_RegistroAsistencia #fk_nivelestudio").val();
           var fk_modalidad = $("#f_RegistroAsistencia #fk_modalidad").val();
           if(indiceElegido!=""){
               
               
               if(fk_nivelestudio!=""){
                        $.ajax({
                            url: pathCarreras + 'Con_CarrerasModalidad.php',
                            type: 'post',
                            data: "ObtenerModalidad=ObtenerModalidad&fk_modalidad="+ fk_modalidad + "&fk_nivelestudio="+fk_nivelestudio,
                            dataType: 'json',
                            success: function(data) {
                                if (data.Carreras != "Error") {
                                    $("#f_RegistroAsistencia #fk_carreras").html(data.Carreras);
                                }else{
                                     $("#f_RegistroAsistencia #fk_carreras").html("");
                                }
                            }
                        });
                   
               }else{
                   $("#f_RegistroAsistencia #fk_modalidad").val("");
                    alertify.error("Seleccione el Nivel de Estudios.");
                    
               }
                
                
                
                
                
                
            }
            
        });     
    });
    
    
   
   
   
   
   
   
   
   
       //obtener carreras por modalidad
     $("#f_ReporteSabadaAut #fk_modalidad").change(function () {
        $("#f_ReporteSabadaAut #fk_modalidad option:selected").each(function () {
           indiceElegido=$(this).val();
           elegido=$(this).text();
           var fk_nivelestudio = $("#f_ReporteSabadaAut #fk_nivelestudio").val();
           if(indiceElegido!=""){
               
               
               if(fk_nivelestudio!=""){
                        $.ajax({
                            url: pathCarreras + 'Con_CarrerasModalidad.php',
                            type: 'post',
                            data: "ObtenerModalidad=ObtenerModalidad&fk_modalidad="+ indiceElegido + "&fk_nivelestudio="+fk_nivelestudio,
                            dataType: 'json',
                            success: function(data) {
                                if (data.Carreras != "Error") {
                                    $("#f_ReporteSabadaAut #fk_carreras").html(data.Carreras);
                                }else{
                                     $("#f_ReporteSabadaAut #fk_carreras").html("");
                                }
                            }
                        });
                   
               }else{
                   $("#f_ReporteSabadaAut #fk_modalidad").val("");
                    alertify.error("Seleccione el Nivel de Estudios.");
                    
               }
                
                
                
                
                
                
            }
            
        });     
    });
    
    //obtener carreras por modalidad
     $("#f_ReporteSabadaAut #fk_nivelestudio").change(function () {
        $("#f_ReporteSabadaAut #fk_nivelestudio option:selected").each(function () {
           indiceElegido=$(this).val();
           elegido=$(this).text();
           var fk_nivelestudio = $("#f_ReporteSabadaAut #fk_nivelestudio").val();
           var fk_modalidad = $("#f_ReporteSabadaAut #fk_modalidad").val();
           if(indiceElegido!=""){
               
               
               if(fk_nivelestudio!=""){
                        $.ajax({
                            url: pathCarreras + 'Con_CarrerasModalidad.php',
                            type: 'post',
                            data: "ObtenerModalidad=ObtenerModalidad&fk_modalidad="+ fk_modalidad + "&fk_nivelestudio="+fk_nivelestudio,
                            dataType: 'json',
                            success: function(data) {
                                if (data.Carreras != "Error") {
                                    $("#f_ReporteSabadaAut #fk_carreras").html(data.Carreras);
                                }else{
                                     $("#f_ReporteSabadaAut #fk_carreras").html("");
                                }
                            }
                        });
                   
               }else{
                   $("#f_ReporteSabadaAut #fk_modalidad").val("");
                    alertify.error("Seleccione el Nivel de Estudios.");
                    
               }
                
                
                
                
                
                
            }
            
        });     
    });
    
    
   
   
   
   
   
   
    ////////////consulta para obtener las carreras en los reportes de egresados
    //obtener carreras por modalidad
     $("#f_ReporteEgresadosTitulacion #fk_modalidad").change(function () {
        $("#f_ReporteEgresadosTitulacion #fk_modalidad option:selected").each(function () {
           indiceElegido=$(this).val();
           elegido=$(this).text();
           var fk_nivelestudio = $("#f_ReporteEgresadosTitulacion #fk_nivelestudio").val();
           if(indiceElegido!=""){
               
               
               if(fk_nivelestudio!=""){
                        $.ajax({
                            url: pathCarreras + 'Con_CarrerasModalidad.php',
                            type: 'post',
                            data: "ObtenerModalidad=ObtenerModalidad&fk_modalidad="+ indiceElegido + "&fk_nivelestudio="+fk_nivelestudio,
                            dataType: 'json',
                            success: function(data) {
                                if (data.Carreras != "Error") {
                                    
                                    $("#f_ReporteEgresadosTitulacion #fk_carreras").html(data.Carreras);
//                                    $("#f_ReporteEgresadosTitulacion #fk_carreras").select2("val", data.Carreras);
                                }else{
                                     $("#f_ReporteEgresadosTitulacion #fk_carreras").select2("val", "");
                                }
                            }
                        });
                   
               }else{
                   $("#f_ReporteEgresadosTitulacion #fk_modalidad").val("");
                    alertify.error("Seleccione el Nivel de Estudios.");
                    
               }
                
                
                
                
                
                
            }
            
        });     
    });
    
        
//    //obtener carreras por modalidad
     $("#f_ReporteEgresadosTitulacion #fk_nivelestudio").change(function () {
        $("#f_ReporteEgresadosTitulacion #fk_nivelestudio option:selected").each(function () {
           indiceElegido=$(this).val();
           elegido=$(this).text();
           var fk_nivelestudio = $("#f_ReporteEgresadosTitulacion #fk_nivelestudio").val();
           var fk_modalidad = $("#f_ReporteEgresadosTitulacion #fk_modalidad").val();
           if(indiceElegido!=""){
               
               
               if(fk_nivelestudio!=""){
                        $.ajax({
                            url: pathCarreras + 'Con_CarrerasModalidad.php',
                            type: 'post',
                            data: "ObtenerModalidad=ObtenerModalidad&fk_modalidad="+ fk_modalidad + "&fk_nivelestudio="+fk_nivelestudio,
                            dataType: 'json',
                            success: function(data) {
                                if (data.Carreras != "Error") {
                                    $("#f_ReporteEgresadosTitulacion #fk_carreras").html(data.Carreras);
//                                    $("#f_ReporteEgresadosTitulacion #fk_carreras").select2("val", data.Carreras);
                                }else{
                                     $("#f_ReporteEgresadosTitulacion #fk_carreras").html("");
//                                     $("#f_ReporteEgresadosTitulacion #fk_carreras").select2("val", "");
                                }
                            }
                        });
                   
               }else{
                   $("#f_ReporteEgresadosTitulacion #fk_modalidad").val("");
                    alertify.error("Seleccione el Nivel de Estudios.");
                    
               }
                
                
                
                
                
                
            }
            
        });     
    });





//nuevoooooooo 07 de agosto
 //obtener carreras por modalidad
     $("#f_ReporteEgresadosTitulacionSegundaParte #fk_modalidad").change(function () {
        $("#f_ReporteEgresadosTitulacionSegundaParte #fk_modalidad option:selected").each(function () {
           indiceElegido=$(this).val();
           elegido=$(this).text();
           var fk_nivelestudio = $("#f_ReporteEgresadosTitulacionSegundaParte #fk_nivelestudio").val();
           if(indiceElegido!=""){
               
               
               if(fk_nivelestudio!=""){
                        $.ajax({
                            url: pathCarreras + 'Con_CarrerasModalidad.php',
                            type: 'post',
                            data: "ObtenerModalidad=ObtenerModalidad&fk_modalidad="+ indiceElegido + "&fk_nivelestudio="+fk_nivelestudio,
                            dataType: 'json',
                            success: function(data) {
                                if (data.Carreras != "Error") {
                                    
                                    $("#f_ReporteEgresadosTitulacionSegundaParte #fk_carreras").html(data.Carreras);
//                                    $("#f_ReporteEgresadosTitulacionSegundaParte #fk_carreras").select2("val", data.Carreras);
                                }else{
                                     $("#f_ReporteEgresadosTitulacionSegundaParte #fk_carreras").select2("val", "");
                                }
                            }
                        });
                   
               }else{
                   $("#f_ReporteEgresadosTitulacionSegundaParte #fk_modalidad").val("");
                    alertify.error("Seleccione el Nivel de Estudios.");
                    
               }
                
                
                
                
                
                
            }
            
        });     
    });
    
        
//    //obtener carreras por modalidad
     $("#f_ReporteEgresadosTitulacionSegundaParte #fk_nivelestudio").change(function () {
        $("#f_ReporteEgresadosTitulacionSegundaParte #fk_nivelestudio option:selected").each(function () {
           indiceElegido=$(this).val();
           elegido=$(this).text();
           var fk_nivelestudio = $("#f_ReporteEgresadosTitulacionSegundaParte #fk_nivelestudio").val();
           var fk_modalidad = $("#f_ReporteEgresadosTitulacionSegundaParte #fk_modalidad").val();
           if(indiceElegido!=""){
               
               
               if(fk_nivelestudio!=""){
                        $.ajax({
                            url: pathCarreras + 'Con_CarrerasModalidad.php',
                            type: 'post',
                            data: "ObtenerModalidad=ObtenerModalidad&fk_modalidad="+ fk_modalidad + "&fk_nivelestudio="+fk_nivelestudio,
                            dataType: 'json',
                            success: function(data) {
                                if (data.Carreras != "Error") {
                                    $("#f_ReporteEgresadosTitulacionSegundaParte #fk_carreras").html(data.Carreras);
//                                    $("#f_ReporteEgresadosTitulacionSegundaParte #fk_carreras").select2("val", data.Carreras);
                                }else{
                                     $("#f_ReporteEgresadosTitulacionSegundaParte #fk_carreras").html("");
//                                     $("#f_ReporteEgresadosTitulacionSegundaParte #fk_carreras").select2("val", "");
                                }
                            }
                        });
                   
               }else{
                   $("#f_ReporteEgresadosTitulacionSegundaParte #fk_modalidad").val("");
                    alertify.error("Seleccione el Nivel de Estudios.");
                    
               }
                
                
                
                
                
                
            }
            
        });     
    });







//nuevoooooooo 07 de agosto
 //obtener carreras por modalidad
 //tercera seccion
     $("#f_ReporteEgresadosTitulacionTerceraParte #fk_modalidad").change(function () {
        $("#f_ReporteEgresadosTitulacionTerceraParte #fk_modalidad option:selected").each(function () {
           indiceElegido=$(this).val();
           elegido=$(this).text();
           var fk_nivelestudio = $("#f_ReporteEgresadosTitulacionTerceraParte #fk_nivelestudio").val();
           if(indiceElegido!=""){
               
               
               if(fk_nivelestudio!=""){
                        $.ajax({
                            url: pathCarreras + 'Con_CarrerasModalidad.php',
                            type: 'post',
                            data: "ObtenerModalidad=ObtenerModalidad&fk_modalidad="+ indiceElegido + "&fk_nivelestudio="+fk_nivelestudio,
                            dataType: 'json',
                            success: function(data) {
                                if (data.Carreras != "Error") {
                                    
                                    $("#f_ReporteEgresadosTitulacionTerceraParte #fk_carreras").html(data.Carreras);
//                                    $("#f_ReporteEgresadosTitulacionTerceraParte #fk_carreras").select2("val", data.Carreras);
                                }else{
                                     $("#f_ReporteEgresadosTitulacionTerceraParte #fk_carreras").select2("val", "");
                                }
                            }
                        });
                   
               }else{
                   $("#f_ReporteEgresadosTitulacionTerceraParte #fk_modalidad").val("");
                    alertify.error("Seleccione el Nivel de Estudios.");
                    
               }
                
                
                
                
                
                
            }
            
        });     
    });
    
        
//    //obtener carreras por modalidad
     $("#f_ReporteEgresadosTitulacionTerceraParte #fk_nivelestudio").change(function () {
        $("#f_ReporteEgresadosTitulacionTerceraParte #fk_nivelestudio option:selected").each(function () {
           indiceElegido=$(this).val();
           elegido=$(this).text();
           var fk_nivelestudio = $("#f_ReporteEgresadosTitulacionTerceraParte #fk_nivelestudio").val();
           var fk_modalidad = $("#f_ReporteEgresadosTitulacionTerceraParte #fk_modalidad").val();
           if(indiceElegido!=""){
               
               
               if(fk_nivelestudio!=""){
                        $.ajax({
                            url: pathCarreras + 'Con_CarrerasModalidad.php',
                            type: 'post',
                            data: "ObtenerModalidad=ObtenerModalidad&fk_modalidad="+ fk_modalidad + "&fk_nivelestudio="+fk_nivelestudio,
                            dataType: 'json',
                            success: function(data) {
                                if (data.Carreras != "Error") {
                                    $("#f_ReporteEgresadosTitulacionTerceraParte #fk_carreras").html(data.Carreras);
//                                    $("#f_ReporteEgresadosTitulacionTerceraParte #fk_carreras").select2("val", data.Carreras);
                                }else{
                                     $("#f_ReporteEgresadosTitulacionTerceraParte #fk_carreras").html("");
//                                     $("#f_ReporteEgresadosTitulacionTerceraParte #fk_carreras").select2("val", "");
                                }
                            }
                        });
                   
               }else{
                   $("#f_ReporteEgresadosTitulacionTerceraParte #fk_modalidad").val("");
                    alertify.error("Seleccione el Nivel de Estudios.");
                    
               }
                
                
                
                
                
                
            }
            
        });     
    });













    
    
    //se utiliza para la captura de resultados examen institucionales
    //obtener carreras por modalidad
     $("#f_CapturaResultadosExa #fk_modalidad").change(function () {
        $("#f_CapturaResultadosExa #fk_modalidad option:selected").each(function () {
           indiceElegido=$(this).val();
           elegido=$(this).text();
           var fk_nivelestudio = $("#f_CapturaResultadosExa #fk_nivelestudio").val();
           if(indiceElegido!=""){
               
               
               if(fk_nivelestudio!=""){
                        $.ajax({
                            url: pathCarreras + 'Con_CarrerasModalidad.php',
                            type: 'post',
                            data: "ObtenerModalidad=ObtenerModalidad&fk_modalidad="+ indiceElegido + "&fk_nivelestudio="+fk_nivelestudio,
                            dataType: 'json',
                            success: function(data) {
                                if (data.Carreras != "Error") {
                                    $("#f_CapturaResultadosExa #fk_carreras").html(data.Carreras);
                                }else{
                                     $("#f_CapturaResultadosExa #fk_carreras").html("");
                                }
                            }
                        });
                   
               }else{
                   $("#f_CapturaResultadosExa #fk_modalidad").val("");
                    alertify.error("Seleccione el Nivel de Estudios.");
                    
               }
                
                
                
                
                
                
            }
            
        });     
    });
    
    
    
    
    
    
    //obtener carreras por modalidad
     $("#f_CapturaResultadosExa #fk_nivelestudio").change(function () {
        $("#f_CapturaResultadosExa #fk_nivelestudio option:selected").each(function () {
           indiceElegido=$(this).val();
           elegido=$(this).text();
           var fk_nivelestudio = $("#f_CapturaResultadosExa #fk_nivelestudio").val();
           var fk_modalidad = $("#f_CapturaResultadosExa #fk_modalidad").val();
           if(indiceElegido!=""){
               
               
               if(fk_nivelestudio!=""){
                        $.ajax({
                            url: pathCarreras + 'Con_CarrerasModalidad.php',
                            type: 'post',
                            data: "ObtenerModalidad=ObtenerModalidad&fk_modalidad="+ fk_modalidad + "&fk_nivelestudio="+fk_nivelestudio,
                            dataType: 'json',
                            success: function(data) {
                                if (data.Carreras != "Error") {
                                    $("#f_CapturaResultadosExa #fk_carreras").html(data.Carreras);
                                }else{
                                     $("#f_CapturaResultadosExa #fk_carreras").html("");
                                }
                            }
                        });
                   
               }else{
                   $("#f_CapturaResultadosExa #fk_modalidad").val("");
                    alertify.error("Seleccione el Nivel de Estudios.");
                    
               }
                
                
                
                
                
                
            }
            
        });     
    });
    
    
   
    
    
    
    
    
    
    
    
    //se utiliza para la encuesta de medicna
    $("#frm_datosEncuestaMedicina #EstudiosPosgradoMedicina").change(function () {
        $("#frm_datosEncuestaMedicina #EstudiosPosgradoMedicina option:selected").each(function () {
           indiceElegido=$(this).val();
           elegido=$(this).text();
           
           if(indiceElegido=="4"){
               $("#frm_datosEncuestaMedicina #DIVEstudioPosgradoMedicinaOtros").slideDown();             
            }else{
               $("#frm_datosEncuestaMedicina #EstudioPosgradoMedicinaOtros").val("");
               $("#frm_datosEncuestaMedicina #DIVEstudioPosgradoMedicinaOtros").slideUp();                
            }
            
        });     
    });
    
    
     $("#frm_datosEncuestaMedicina #fk_institucioneslabora").change(function () {
        $("#frm_datosEncuestaMedicina #fk_institucioneslabora option:selected").each(function () {
           indiceElegido=$(this).val();
           elegido=$(this).text();
           
           if(indiceElegido=="10"){
               $("#frm_datosEncuestaMedicina #DIVInstitucionLaboraMedicinaOtros").slideDown();             
            }else{
               $("#frm_datosEncuestaMedicina #InstitucionLaboraMedicinaOtros").val("");
               $("#frm_datosEncuestaMedicina #DIVInstitucionLaboraMedicinaOtros").slideUp();                
            }
            
        });     
    });
    
    
    
    //Pertenece a alguna Organización Social ó Profesional
    $("#frm_datosEncuestaMedicina #PerteneceOrganizacionSocial").change(function () {
        $("#frm_datosEncuestaMedicina #PerteneceOrganizacionSocial option:selected").each(function () {
           indiceElegido=$(this).val();
           elegido=$(this).text();
           
           if(indiceElegido=="1"){
               $("#frm_datosEncuestaMedicina #DIVPerteneceOrganizacionSocialSi").slideDown();             
            }else{
               $("#frm_datosEncuestaMedicina #PerteneceOrganizacionSocialSi").val("");
               $("#frm_datosEncuestaMedicina #DIVPerteneceOrganizacionSocialSi").slideUp();                
            }
            
        });     
    });
    
    //Cuenta con Alguna Certificación Profesional
      $("#frm_datosEncuestaMedicina #CertificacionProfesional").change(function () {
        $("#frm_datosEncuestaMedicina #CertificacionProfesional option:selected").each(function () {
           indiceElegido=$(this).val();
           elegido=$(this).text();
           
           if(indiceElegido=="1"){
               $("#frm_datosEncuestaMedicina #DIVCertificacionProfesionalSi").slideDown();             
            }else{
               $("#frm_datosEncuestaMedicina #CertificacionProfesionalFecha").val("");
               $("#frm_datosEncuestaMedicina #CertificacionProfesionalOrganismo").val("");
               $("#frm_datosEncuestaMedicina #DIVCertificacionProfesionalSi").slideUp();                
            }
            
        });     
    });
    
    
    
    //En caso de haber contestado nada, poco ó regular, ¿En que aspecto detecta la debilidad?.
      $("#frm_datosEncuestaMedicina #AspectoDebilidad").change(function () {
        $("#frm_datosEncuestaMedicina #AspectoDebilidad option:selected").each(function () {
           indiceElegido=$(this).val();
           elegido=$(this).text();
           
           if(indiceElegido=="8"){
               $("#frm_datosEncuestaMedicina #DIVAspectoDebilidadOtros").slideDown();             
            }else{
               $("#frm_datosEncuestaMedicina #AspectoDebilidadOtros").val("");
               $("#frm_datosEncuestaMedicina #DIVAspectoDebilidadOtros").slideUp();                
            }
            
        });     
    });
    
    
});








function VerInvitacion(pk_alumno,fk_nivelestudio){
	
   if (fk_nivelestudio=='2'){
	    
    window.open('includes/ajax/Tramites/TomaProtesta/Reportes/VerInvitacionSinodales.php?pk_alumno='+pk_alumno+"&fk_nivelestudio=" + fk_nivelestudio);
   
}else if(fk_nivelestudio=='3' || fk_nivelestudio=='4'){
	
	    window.open('includes/ajax/Tramites/TomaProtesta/Reportes/VerLecturaMaestria.php?pk_alumno='+pk_alumno + "&fk_nivelestudio=" + fk_nivelestudio);
	}
}





function VerConstancia(pk_alumno,fk_nivelestudio){
   if (fk_nivelestudio=='3' || fk_nivelestudio=='4'){ 

    window.open('includes/ajax/Tramites/TomaProtesta/Reportes/VerConstanciaMaestria.php?pk_alumno='+pk_alumno+ "&fk_nivelestudio=" + fk_nivelestudio);

    }else if(fk_nivelestudio=='2'){
	
	window.open('includes/ajax/Tramites/TomaProtesta/Reportes/VerConstancia.php?pk_alumno='+pk_alumno+ "&fk_nivelestudio=" + fk_nivelestudio);
	}
}
	
function VerConstanciaPromedio(pk_alumno,fk_nivelestudio){
	
	
	if(fk_nivelestudio=='2'){
    
    alertify.set({ labels: {
    ok     : "Aceptar",
    cancel : "Cancelar"
} });
    alertify.prompt("Ingrese el Ciclo Escolar", function (e, str) {
    // str is the input text
    if (e) {
        // user clicked "ok"
        window.open('includes/ajax/Tramites/TomaProtesta/Reportes/VerConstanciaPromedio.php?pk_alumno='+pk_alumno + "&CicloEscolarPromt=" + str);
   
    } else {
        // user clicked "cancel"
    }
}, "");

	} 
}

function verTituloAtras(pk_alumno,fk_nivelestudio){
	if(fk_nivelestudio=='2'){
		
    alertify.set({ labels: {
    ok     : "Aceptar",
    cancel : "Cancelar"
} });
    alertify.prompt("Ingrese el N&uacute;mero de Foja", function (e, str) {
    // str is the input text
    if (e) {
        // user clicked "ok"
         alertify.prompt("Ingrese el Numero de Acuerdo", function (f, registro) {
    // str is the input text
    if (f) {
        // user clicked "ok"
        window.open('includes/ajax/Tramites/TomaProtesta/Reportes/verTituloAtras.php?pk_alumno='+pk_alumno + "&Fojanumero=" + str + "&nuRegistro=" + registro);
   
    } else {
        // user clicked "cancel"
    }
}, "");
   
    } else {
        // user clicked "cancel"
    }
}, "");

	}else if(fk_nivelestudio=='3' || fk_nivelestudio=='4'){
		
		alertify.set({ labels: {
    ok     : "Aceptar",
    cancel : "Cancelar"
} });
    alertify.prompt("Ingrese el N&uacute;mero de Foja", function (e, str) {
    // str is the input text
    if (e) {
        // user clicked "ok"
         alertify.prompt("Ingrese el Numero de Acuerdo", function (f, registro) {
    // str is the input text
    if (f) {
        // user clicked "ok"
		
	   window.open('includes/ajax/Tramites/TomaProtesta/Reportes/verTituloAtrasMaestria.php?pk_alumno='+pk_alumno + "&fk_nivelestudio=" + fk_nivelestudio);
	       } else {
        // user clicked "cancel"
    }
}, "");
   
    } else {
        // user clicked "cancel"
    }
}, "");
   }
} 

function verPDF(pk_alumno){
    
    alertify.set({ labels: {
    ok     : "Aceptar",
    cancel : "Cancelar"
} });
    alertify.prompt("Ingrese el Folio", function (e, str) {
    // str is the input text
    if (e) {
        // user clicked "ok"
        window.open('includes/ajax/Tramites/TomaProtesta/Reportes/verPDFDocumentos.php?pk_alumno='+pk_alumno + "&FolioPago=" + str);
   
    } else {
        // user clicked "cancel"
    }
}, "");


}





function verPDFSecretaria(pk_alumno,fk_nivelestudio){
   if (fk_nivelestudio=='3' || fk_nivelestudio=='4'){
	   
	    alertify.set({ labels: {
    ok     : "Aceptar",
    cancel : "Cancelar"
} });
    alertify.prompt("Ingrese Modalidad", function (e, str) {
    // str is the input text
    if (e) {
        // user clicked "ok"
	   
	     window.open('includes/ajax/Tramites/TomaProtesta/Reportes/verPDFSecretariaMaestria.php?pk_alumno=' + pk_alumno + "&fk_nivelestudio=" + fk_nivelestudio+ "&modalidad=" + str);
     } else {
        // user clicked "cancel"
    }
}, "");  
  
   }else if(fk_nivelestudio=='2'){
	   
	   window.open('includes/ajax/Tramites/TomaProtesta/Reportes/verPDFSecretaria.php?pk_alumno=' + pk_alumno + "&fk_nivelestudio=" + fk_nivelestudio);
	   }
}


function verActaExamenFrente(pk_alumno,fk_nivelestudio){
   if (fk_nivelestudio=='3' || fk_nivelestudio=='4' ){
	   
	    alertify.set({ labels: {
    ok     : "Aceptar",
    cancel : "Cancelar"
} });
    alertify.prompt("Ingrese Modalidad", function (e, str) {
    // str is the input text
    if (e) {
        // user clicked "ok"
        window.open('includes/ajax/Tramites/TomaProtesta/Reportes/verActaExamenFrenteMaestria.php?pk_alumno=' + pk_alumno + "&fk_nivelestudio=" + fk_nivelestudio + "&modalidad=" + str);
   
    } else {
        // user clicked "cancel"
    }
}, "");
        
  
   }else if(fk_nivelestudio=='2'){
	   
	   window.open('includes/ajax/Tramites/TomaProtesta/Reportes/verActaExamenFrente.php?pk_alumno=' + pk_alumno + "&fk_nivelestudio=" + fk_nivelestudio);
	   }
}


function verActaExamenAtras(pk_alumno,fk_nivelestudio){
   if (fk_nivelestudio=='3' || fk_nivelestudio=='4'){
	   
	     window.open('includes/ajax/Tramites/TomaProtesta/Reportes/verActaExamenAtrasMaestria.php?pk_alumno=' + pk_alumno + "&fk_nivelestudio=" + fk_nivelestudio);
       
  
   }else if(fk_nivelestudio=='2'){
	   
	   window.open('includes/ajax/Tramites/TomaProtesta/Reportes/verActaExamenAtras.php?pk_alumno=' + pk_alumno + "&fk_nivelestudio=" + fk_nivelestudio);
	   }
}


function verTituloFrente(pk_alumno,fk_nivelestudio){
   if(fk_nivelestudio=='2'){
        window.open('includes/ajax/Tramites/TomaProtesta/Reportes/verTituloFrente.php?pk_alumno='+pk_alumno);
   }else if(fk_nivelestudio=='3' || fk_nivelestudio=='4'){
	   window.open('includes/ajax/Tramites/TomaProtesta/Reportes/verTituloFrenteMaestria.php?pk_alumno='+pk_alumno + "&fk_nivelestudio=" + fk_nivelestudio);
   }
}


function ActaPromedioFrente(pk_alumno){
   
        window.open('includes/ajax/Tramites/TomaProtesta/Reportes/ActaPromedioFrente.php?pk_alumno='+pk_alumno);
   
}


function ActaPromedioAtras(pk_alumno){
   
        window.open('includes/ajax/Tramites/TomaProtesta/Reportes/ActaPromedioAtras.php?pk_alumno='+pk_alumno);
   
}

function verActaTitulacionFrente(pk_alumno,fk_nivelestudio){
   if(fk_nivelestudio=='2'){
        window.open('includes/ajax/Tramites/TomaProtesta/Reportes/verActaTitulacionFrente.php?pk_alumno='+pk_alumno);
   }else if(fk_nivelestudio=='3' || fk_nivelestudio=='4'){
	   window.open('includes/ajax/Tramites/TomaProtesta/Reportes/verActaTitulacionMaestriaFrente.php?pk_alumno='+pk_alumno + "&fk_nivelestudio=" + fk_nivelestudio);
   }
}

function verActaTitulacionAtras(pk_alumno,fk_nivelestudio){
   if(fk_nivelestudio=='2'){
        window.open('includes/ajax/Tramites/TomaProtesta/Reportes/verActaTitulacionAtras.php?pk_alumno='+pk_alumno);
   }else if(fk_nivelestudio=='3' || fk_nivelestudio=='4'){
       window.open('includes/ajax/Tramites/TomaProtesta/Reportes/verActaTitulacionMaestriAtras.php?pk_alumno='+pk_alumno + "&fk_nivelestudio=" + fk_nivelestudio);
   }
}


function VerDictamen(pk_alumno,fk_nivelestudio){   
    
    if(fk_nivelestudio=='3' || fk_nivelestudio=='4'){
    
    alertify.set({ labels: {
    ok     : "Aceptar",
    cancel : "Cancelar"
} });
    alertify.prompt("Ingrese la Generacion", function (e, str) {
    // str is the input text
    if (e) {
        // user clicked "ok"
        window.open('includes/ajax/Tramites/TomaProtesta/Reportes/VerDictamenMaestria.php?pk_alumno='+pk_alumno + "&Generacion=" + str);
   
    } else {
        // user clicked "cancel"
    }
}, "");

    } else if(fk_nivelestudio=='2'){       
     window.open('includes/ajax/Tramites/TomaProtesta/Reportes/VerDictamenLicenciatura.php?pk_alumno='+pk_alumno +"&fk_nivelestudio="+fk_nivelestudio);
        }
}