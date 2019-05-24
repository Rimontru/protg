<?php

class ConsultaDB{
    
    //************************ Ivan Mauricio Meneses Melo Granados ********************//
//*********************************************************************************//
 #AGREGADO: Ivan Mauricio Meneses Melo Granados
 #FECHA: 11/05/13 11:31 am 
 #MODULO AFECTADO: 
 #DESCRIPCION: colocamos el status del usuario a online
  function UsuarioOnline($IdUsuario) {
        $dbLuminarias = new database;
        if ($dbLuminarias->conectar() == true) {
            $query = "UPDATE tbl_usuario_login SET Usuario_Online='1' WHERE Pk_Usuario_Login='$IdUsuario'";
            $result = @mysql_query($query) or die(mysql_error());
            if (!$result)
                return false;
            else
                return $result;
        }
    }    
    
    
 #AGREGADO: Ivan Mauricio Meneses Melo Granados
 #FECHA: 11/05/13 11:31 am 
 #MODULO AFECTADO: 
 #DESCRIPCION: colocamos el status del usuario a online
  function ConExisteUsuario($nombreUsuario) {
        $dbLuminarias = new database;
        if ($dbLuminarias->conectar() == true) {
            $query = "SELECT COUNT(*) as existe FROM tbl_usuario_login WHERE Usuario='$nombreUsuario'";
            $result = @mysql_query($query) or die(mysql_error());
            if (!$result)
                return false;
            else
                return $result;
        }
    }    
    
    
     #AGREGADO: Ivan Mauricio Meneses Melo Granados
 #FECHA: 11/05/13 11:31 am 
 #MODULO AFECTADO: 
 #DESCRIPCION: colocamos el status del usuario a online
  function ConExisteUsuarioCompleto($Nombre, $Fk_Empresa) {
        $dbLuminarias = new database;
        if ($dbLuminarias->conectar() == true) {
            $query = "SELECT COUNT(*) as existe FROM tbl_usuario_login WHERE Nombre='" . $Nombre . "' AND Fk_Empresa='" . $Fk_Empresa . "'";
            $result = @mysql_query($query) or die(mysql_error());
            if (!$result)
                return false;
            else
                return $result;
        }
    }    
    
    
#AGREGADO: Ivan Mauricio Meneses Melo Granados		
#FECHA: 29/01/13 10:40 am 
#MODULO AFECTADO: modulos/Departamento/Loginpermisos_Alta.php
#DESCRIPCION: Seleccionamos todos los Usuarios de tbl_usuario_login
# @params        
# @return        True ó False en función de la consulta 
function ConUsuarioLoginDatosPanel($usuario) {
        $dbIP = new database;
        if ($dbIP->conectar() == true) {
            $query = "SELECT * FROM tbl_usuario_login 
INNER JOIN Cat_Departamento ON tbl_usuario_login.Fk_Departamento=Cat_Departamento.Pk_Departamento 
WHERE activo_usuario=1 and Usuario='$usuario'";
            $result = @mysql_query($query);
            if (!$result)
                return false;
            else
                return $result;
        }
}


#AGREGADO: Ivan Mauricio Meneses Melo Granados		
#FECHA: 19/02/13 15:23 pm 
#MODULO AFECTADO: modulos/Sistema/usuarios/Usuario_Eliminar.php
#DESCRIPCION: obtenemos los usuarios
# @return        True ó False en función de la consulta 
function conUsuarioDatos($nombreUser) {
        $dbLuminarias = new database;
        if ($dbLuminarias->conectar() == true) {
            $query="SELECT *, tbl_usuario_login.Usuario as NombreUsuarioNormal, cat_titulos_menu.Nombre AS NombreMenu
                    FROM tbl_usuario_login
                    LEFT JOIN rel_login_permisos ON tbl_usuario_login.Pk_Usuario_Login = rel_login_permisos.Fk_Usuario_Login
                    LEFT JOIN cat_menu ON rel_login_permisos.Fk_CatMenu = cat_menu.idMenu
                    LEFT JOIN cat_titulos_menu ON cat_titulos_menu.idTituloMenu = rel_login_permisos.FkTituloMenu
                    WHERE Usuario = '$nombreUser'
                    AND cat_menu.idMenu != '1'
                   ";
            $result = @mysql_query($query) or die(mysql_error());
            if (!$result)
                return false;
            else
                return $result;
        }
}


    
#AGREGADO: Ivan Mauricio Meneses Melo Granados		
#FECHA: 23/05/2012 10:13 am 
#MODULO AFECTADO: includes/ajax/Sistema/usuario/Ins_Usuario.php
#DESCRIPCION: Seleccionamos todas las depedencias activas
# @params        
# @return        True ó False en función de la consulta 
    function ConTitulosMenus() {
        $dbLuminarias = new database;
        if ($dbLuminarias->conectar() == true) {
            $query = "SELECT * FROM cat_titulos_menu";
            $result = @mysql_query($query) or die(mysql_error());
            if (!$result)
                return false;
            else
                return $result;
        }
    }
    
    
 #AGREGADO: Ivan Mauricio Meneses Melo Granados
 #FECHA: 11/05/13 11:31 am 
 #MODULO AFECTADO: 
 #DESCRIPCION: colocamos el status del usuario a Offline
  function UsuarioOffline($IdUsuario) {
        $dbLuminarias = new database;
        if ($dbLuminarias->conectar() == true) {
            $query = "UPDATE tbl_usuario_login SET Usuario_Online='0' WHERE Pk_Usuario_Login='$IdUsuario'";
            $result = @mysql_query($query) or die(mysql_error());
            if (!$result)
                return false;
            else
                return $result;
        }
    }
    
    
   
    #FECHA: 01/07/13 15:23 pm 
    #MODULO AFECTADO: modulos/Sistema/usuarios/Usuario_Eliminar.php
    #DESCRIPCION: obtenemos los usuarios
    # @return        True ó False en función de la consulta 

    function ConMenuXIdUsuario($IdUsuario, $AliasMenu){
        $dbLuminarias = new database;
        if ($dbLuminarias->conectar() == true) {
            $query = "SELECT * FROM tbl_usuario_login
                          LEFT JOIN rel_login_permisos ON tbl_usuario_login.Pk_Usuario_Login = rel_login_permisos.Fk_Usuario_Login
                          LEFT JOIN cat_menu ON rel_login_permisos.Fk_CatMenu = cat_menu.idMenu  
                          WHERE tbl_usuario_login.Pk_Usuario_Login = '$IdUsuario'
                            AND cat_menu.Alias_Archivo = '$AliasMenu'";
            $result = @mysql_query($query) or die(mysql_error());
            if (!$result)
                return false;
            else
                return $result;
        }
    }
    
    
     #FECHA: 22/01/14 15:23 pm 
    #DESCRIPCION: obtenemos los si existen registros
    # @return        True ó False en función de la consulta 
    function ConsultaUsuarios(){
        $dbLuminarias = new database;
        if ($dbLuminarias->conectar() == true) {
            $query = "SELECT * FROM tbl_usuario_login";
            $result = @mysql_query($query) or die(mysql_error());
            if (!$result)
                return false;
            else
                return $result;
        }
    }
    
    
    
    
    
    
     #FECHA: 22/01/14 15:23 pm 
    #DESCRIPCION: obtenemos los si existen registros
    # @return        True ó False en función de la consulta 
    function ConsultaDatosInsitucion(){
        $dbLuminarias = new database;
        if ($dbLuminarias->conectar() == true) {
            $query = "SELECT * FROM tbl_escuela";
            $result = @mysql_query($query) or die(mysql_error());
            if (!$result)
                return false;
            else
                return $result;
        }
    }
    
      
     #FECHA: 22/01/14 15:23 pm 
    #DESCRIPCION: obtenemos los si existen registros
    # @return        True ó False en función de la consulta 
    function ConsultaDatosInsitucionConEstados(){
        $dbLuminarias = new database;
        if ($dbLuminarias->conectar() == true) {
            $query = "SELECT *, cat_municipios.descripcion as CiudadEscuela,
                     cat_estado.descripcion as EstadoEscuela
                     FROM tbl_escuela
                    INNER JOIN cat_colonia ON cat_colonia.pk_colonia = tbl_escuela.fk_colonia
                    INNER JOIN cat_municipios ON cat_municipios.pk_ciudad = cat_colonia.fk_municipio
                    INNER JOIN cat_estado ON cat_estado.pk_estado = cat_municipios.fk_estado";
            $result = @mysql_query($query) or die(mysql_error());
            if (!$result)
                return false;
            else
                return $result;
        }
    }
    
    
    function ConsultaCarreras(){
        $db =  new database;
        if($db->conectar() == true){
            $sql = "SELECT * FROM tbl_carreras
INNER JOIN cat_modalidad ON cat_modalidad.pk_modalidad = tbl_carreras.fk_modalidad 
INNER JOIN cat_nivelestudio ON cat_nivelestudio.pk_nivelestudio = tbl_carreras.fk_nivelestudio AND estadoCarrera=1";
            $result = @mysql_query($sql) or die(mysql_error());
            if(!$result){
                return false;
            }else{
                return $result;
            }
            
        }       
        
    }


function ConsultaCarrerasLicenciatura(){
        $db =  new database;
        if($db->conectar() == true){
            $sql = "SELECT * FROM tbl_carreras
INNER JOIN cat_modalidad ON cat_modalidad.pk_modalidad = tbl_carreras.fk_modalidad 
INNER JOIN cat_nivelestudio ON cat_nivelestudio.pk_nivelestudio = tbl_carreras.fk_nivelestudio AND estadoCarrera=1

where fk_modalidad='1'";
            $result = @mysql_query($sql) or die(mysql_error());
            if(!$result){
                return false;
            }else{
                return $result;
            }
            
        }       
        
    }
    
    
    
            
//    function ConsultaCarreras(){
//        $db =  new database;
//        if($db->conectar() == true){
//            $sql = "SELECT * FROM tbl_carreras,cat_modalidad WHERE cat_modalidad.pk_modalidad = tbl_carreras.fk_modalidad AND estadocarrera=1";
//            $result = @mysql_query($sql) or die(mysql_error());
//            if(!$result){
//                return false;
//            }else{
//                return $result;
//            }
//            
//        }       
//        
//    }    
//    
    
    function ConsultaNiveldeEstudios(){
        $db =  new database;
        if($db->conectar() == true){
            $sql = "SELECT * FROM cat_nivelestudio WHERE estadoNivel='1'";
            $result = @mysql_query($sql) or die(mysql_error());
            if(!$result){
                return false;
            }else{
                return $result;
            }
            
        }       
        
    }
    
    
    
    function ConsultaGenero(){
        $db =  new database;
        if($db->conectar() == true){
            $sql = "SELECT * FROM cat_genero WHERE estado='1'";
            $result = @mysql_query($sql) or die(mysql_error());
            if(!$result){
                return false;
            }else{
                return $result;
            }
            
        }       
        
    }
    
    
    
   function ConsultaDatosInstitucion(){
        $db =  new database;
        if($db->conectar() == true){
            $sql = "SELECT * FROM tbl_escuela WHERE escuelaActiva='1'";
            $result = @mysql_query($sql) or die(mysql_error());
            if(!$result){
                return false;
            }else{
                return $result;
            }
            
        }       
        
    }
    
    
    
    
        
        
   function ConsultaDatosSinodales(){
        $db =  new database;
        if($db->conectar() == true){
            $sql = "SELECT * FROM tbl_profesores
                    INNER JOIN rel_profesorcarrera ON tbl_profesores.pk_sinodal = rel_profesorcarrera.fk_sinodal
                    INNER JOIN tbl_carreras ON tbl_carreras.pk_carreras = rel_profesorcarrera.fk_carreras
                    INNER JOIN cat_modalidad ON tbl_carreras.fk_modalidad = cat_modalidad.pk_modalidad
                    WHERE act_profe='1' AND sinodal='1' AND rel_profesorcarrera.activoRel='1'

			ORDER BY fk_carreras ASC,fk_modalidad DESC;
			";
            $result = @mysql_query($sql) or die(mysql_error());
            if(!$result){
                return false;
            }else{
                return $result;
            }
            
        }       
        
    }
    
    
    
            
   function ConsultaDatosSinodalesNivelEstudioModalidad($fk_nivelestudio, $fk_modalidad, $fk_carreras){
        $db =  new database;
        if($db->conectar() == true){
            $sql = "SELECT *
                    FROM tbl_profesores
                    INNER JOIN rel_profesorcarrera ON tbl_profesores.pk_sinodal = rel_profesorcarrera.fk_sinodal
                    INNER JOIN tbl_carreras ON tbl_carreras.pk_carreras = rel_profesorcarrera.fk_carreras
                    WHERE act_profe = '1'
                    AND sinodal = '1'
                    AND rel_profesorcarrera.activoRel = '1'
                    AND tbl_profesores.fk_nivelestudio = '$fk_nivelestudio'
                    AND fk_modalidad = '$fk_modalidad'
                    AND fk_carreras = '$fk_carreras'";
            $result = @mysql_query($sql) or die(mysql_error());
            if(!$result){
                return false;
            }else{
                return $result;
            }
            
        }       
        
    }
    
        
       
   function ConsultaTodosSinodales(){
        $db =  new database;
        if($db->conectar() == true){
            $sql = "SELECT * FROM tbl_profesores
                    WHERE act_profe='1' AND sinodal='1'";
            $result = @mysql_query($sql) or die(mysql_error());
            if(!$result){
                return false;
            }else{
                return $result;
            }
            
        }       
        
    }
    
    
       function ConsultaDatosSinodalesporCedulaProfesional($cedula){
        $db =  new database;
        if($db->conectar() == true){
            $sql = "SELECT * FROM tbl_profesores
                    WHERE cedula='$cedula' AND act_profe='1'";
            $result = @mysql_query($sql) or die(mysql_error());
            if(!$result){
                return false;
            }else{
                return $result;
            }
            
        }       
        
    }
    
    
           function ConsultaDatosAlumnosPorMatricula($matricula){
        $db =  new database;
        if($db->conectar() == true){
            $sql = "SELECT * FROM tbl_alumnos
                    WHERE matricula='$matricula'";
            $result = @mysql_query($sql) or die(mysql_error());
            if(!$result){
                return false;
            }else{
                return $result;
            }
            
        }       
        
    }
    
    
        
   function ConsultaSinodalesBaja(){
        $db =  new database;
        if($db->conectar() == true){
            $sql = "SELECT * FROM tbl_profesores
                    INNER JOIN rel_profesorcarrera ON tbl_profesores.pk_sinodal = rel_profesorcarrera.fk_sinodal
                    INNER JOIN tbl_carreras ON tbl_carreras.pk_carreras = rel_profesorcarrera.fk_carreras
                    WHERE act_profe='1' AND sinodal='1' AND rel_profesorcarrera.activoRel='0'";
            $result = @mysql_query($sql) or die(mysql_error());
            if(!$result){
                return false;
            }else{
                return $result;
            }
            
        }       
        
    }
    
    
          
   function ConsultaDatosSinodalesporLlavePrimaria($pk_sinodal, $pk_carreras){
        $db =  new database;
        if($db->conectar() == true){
            $sql = "SELECT * FROM tbl_profesores
                    INNER JOIN rel_profesorcarrera ON tbl_profesores.pk_sinodal = rel_profesorcarrera.fk_sinodal
                    INNER JOIN tbl_carreras ON tbl_carreras.pk_carreras = rel_profesorcarrera.fk_carreras
                    WHERE act_profe='1' AND pk_sinodal='$pk_sinodal' AND pk_carreras='$pk_carreras'";
            $result = @mysql_query($sql) or die(mysql_error());
            if(!$result){
                return false;
            }else{
                return $result;
            }
            
        }       
        
    }
    
    
    
        
    
          
   function ConsultaDatosSinodalesPkSinodal($pk_sinodal, $pk_carreras_anterior){
        $db =  new database;
        if($db->conectar() == true){
            $sql = "SELECT * FROM tbl_profesores
                    INNER JOIN rel_profesorcarrera ON tbl_profesores.pk_sinodal = rel_profesorcarrera.fk_sinodal
                    INNER JOIN tbl_carreras ON tbl_carreras.pk_carreras = rel_profesorcarrera.fk_carreras
                    WHERE act_profe='1' AND pk_sinodal='$pk_sinodal' AND pk_sinodal!='$pk_carreras_anterior'";
            $result = @mysql_query($sql) or die(mysql_error());
            if(!$result){
                return false;
            }else{
                return $result;
            }
            
        }       
        
    }
    
    
    
            
       function ConsultaDatosInstitucionBaja(){
        $db =  new database;
        if($db->conectar() == true){
            $sql = "SELECT * FROM tbl_escuela WHERE escuelaActiva='0'";
            $result = @mysql_query($sql) or die(mysql_error());
            if(!$result){
                return false;
            }else{
                return $result;
            }
            
        }       
        
    }
    
            
       function ConsultaDatosInstitucionPorLlavePrimaria($pk_dtgenerales){
        $db =  new database;
        if($db->conectar() == true){
            $sql = "SELECT * FROM tbl_escuela
                    INNER JOIN cat_colonia ON cat_colonia.pk_colonia = tbl_escuela.fk_colonia
                    INNER JOIN cat_municipios ON cat_municipios.pk_ciudad = cat_colonia.fk_municipio
                    INNER JOIN cat_estado ON cat_estado.pk_estado = cat_municipios.fk_estado
                    WHERE escuelaActiva='1' AND pk_dtgenerales='$pk_dtgenerales'";
            $result = @mysql_query($sql) or die(mysql_error());
            if(!$result){
                return false;
            }else{
                return $result;
            }
            
        }       
        
    }
    
    
    
         
    function ConEstados(){
        $db =  new database;
        if($db->conectar() == true){
            $sql = "SELECT * FROM cat_estado WHERE estadoactivo='1'";
            $result = @mysql_query($sql) or die(mysql_error());
            if(!$result){
                return false;
            }else{
                return $result;
            }
            
        }       
        
    }
    

     function ConTurnos(){
        $db =  new database;
        if($db->conectar() == true){
            $sql = "SELECT * FROM cat_turnos WHERE estatusdescripcion='1'";
            $result = @mysql_query($sql) or die(mysql_error());
            if(!$result){
                return false;
            }else{
                return $result;
            }
            
        }       
        
    }
    
    
      function ConMeses(){
        $db =  new database;
        if($db->conectar() == true){
            $sql = "SELECT * FROM cat_meses WHERE estadomeses='1'";
            $result = @mysql_query($sql) or die(mysql_error());
            if(!$result){
                return false;
            }else{
                return $result;
            }
            
        }       
        
    }
    
    
      function ConAnios(){
        $db =  new database;
        if($db->conectar() == true){
            $sql = "SELECT * FROM cat_anios WHERE estado='1'";
            $result = @mysql_query($sql) or die(mysql_error());
            if(!$result){
                return false;
            }else{
                return $result;
            }
            
        }       
        
    }
    
    
    function ConEstadoTitulacion(){
        $db =  new database;
        if($db->conectar() == true){
            $sql = "SELECT * FROM cat_estadoTitulacion WHERE estadoActivo='1'";
            $result = @mysql_query($sql) or die(mysql_error());
            if(!$result){
                return false;
            }else{
                return $result;
            }
            
        }       
        
    }
      
    
     function ConEstadoCivil(){
        $db =  new database;
        if($db->conectar() == true){
            $sql = "SELECT * FROM cat_estadocivil WHERE activo_estadocivil='1'";
            $result = @mysql_query($sql) or die(mysql_error());
            if(!$result){
                return false;
            }else{
                return $result;
            }
            
        }       
        
    }
    
       

    
      function ConEstudiosposgrado(){
        $db =  new database;
        if($db->conectar() == true){
            $sql = "SELECT * FROM cat_estudiosposgrado WHERE activo_estudiosposgrado='1'";
            $result = @mysql_query($sql) or die(mysql_error());
            if(!$result){
                return false;
            }else{
                return $result;
            }
            
        }       
        
    }
    
      function ConRamaPosgrado(){
        $db =  new database;
        if($db->conectar() == true){
            $sql = "SELECT * FROM cat_ramaposgrado WHERE activo_ramaposgrado='1'";
            $result = @mysql_query($sql) or die(mysql_error());
            if(!$result){
                return false;
            }else{
                return $result;
            }
            
        }       
        
    }
    
    
    function Coninstitucioneslabora(){
        $db =  new database;
        if($db->conectar() == true){
            $sql = "SELECT * FROM cat_institucioneslabora WHERE activo_institucioneslabora='1'";
            $result = @mysql_query($sql) or die(mysql_error());
            if(!$result){
                return false;
            }else{
                return $result;
            }
            
        }       
        
    }
       function ConaPuestosmedicina(){
        $db =  new database;
        if($db->conectar() == true){
            $sql = "SELECT * FROM cat_puestosmedicina WHERE activo_puestosmedicina='1'";
            $result = @mysql_query($sql) or die(mysql_error());
            if(!$result){
                return false;
            }else{
                return $result;
            }
            
        }       
        
    }
    
    
     function Conaingresoactual(){
        $db =  new database;
        if($db->conectar() == true){
            $sql = "SELECT * FROM cat_ingresoactual WHERE activo_ingresoactual='1'";
            $result = @mysql_query($sql) or die(mysql_error());
            if(!$result){
                return false;
            }else{
                return $result;
            }
            
        }       
        
    }
    
     
     function Coningresoactual(){
        $db =  new database;
        if($db->conectar() == true){
            $sql = "SELECT * FROM cat_ingresoactual WHERE activo_ingresoactual='1'";
            $result = @mysql_query($sql) or die(mysql_error());
            if(!$result){
                return false;
            }else{
                return $result;
            }
            
        }       
        
    }
    
       function ConEncuesta_calif(){
        $db =  new database;
        if($db->conectar() == true){
            $sql = "SELECT * FROM cat_encuesta_calif WHERE activo_encuesta_calif='1'";
            $result = @mysql_query($sql) or die(mysql_error());
            if(!$result){
                return false;
            }else{
                return $result;
            }
            
        }       
        
    }
    
    
    
       
       function ConGradoSatisfaccion(){
        $db =  new database;
        if($db->conectar() == true){
            $sql = "SELECT * FROM cat_gradosatisfaccion WHERE activo_gradosatisfaccion='1'";
            $result = @mysql_query($sql) or die(mysql_error());
            if(!$result){
                return false;
            }else{
                return $result;
            }
            
        }       
        
    }
    
           function ConAspectoDebilidad(){
        $db =  new database;
        if($db->conectar() == true){
            $sql = "SELECT * FROM cat_aspectodebilidad WHERE activo_aspectodebilidad='1'";
            $result = @mysql_query($sql) or die(mysql_error());
            if(!$result){
                return false;
            }else{
                return $result;
            }
            
        }       
        
    }
    
    
    
    function ConOpciontitulacion(){
        $db =  new database;
        if($db->conectar() == true){
            $sql = "SELECT * FROM cat_opciontitulacion WHERE estatusTitulacion='1'";
            $result = @mysql_query($sql) or die(mysql_error());
            if(!$result){
                return false;
            }else{
                return $result;
            }
            
        }       
        
    }
     function ConTipoGeneracion(){
        $db =  new database;
        if($db->conectar() == true){
            $sql = "SELECT * FROM tbl_tipogeneracion WHERE ActivoTipoGeneracion='1'";
            $result = @mysql_query($sql) or die(mysql_error());
            if(!$result){
                return false;
            }else{
                return $result;
            }
            
        }       
        
    }
    
    
    
    function ConMunicipios($v_estado){
        $db =  new database;
        if($db->conectar() == true){
            $sql = "SELECT * FROM cat_municipios WHERE fk_estado='$v_estado' and ciudadactiva='1' ORDER BY descripcion ASC";
            $result = @mysql_query($sql) or die(mysql_error());
            if(!$result){
                return false;
            }else{
                return $result;
            }
            
        }       
        
    }
    
    
    
    
    
      function ConColonias($v_Municipio){
        $db =  new database;
        if($db->conectar() == true){
            $sql = "SELECT * FROM cat_colonia WHERE fk_municipio='$v_Municipio' and estatus='1' ORDER BY descripcion ASC";
            $result = @mysql_query($sql) or die(mysql_error());
            if(!$result){
                return false;
            }else{
                return $result;
            }
            
        }       
        
    }
    
 
      
      function ConCodigoPostal($v_coloniafracc){
        $db =  new database;
        if($db->conectar() == true){
            $sql = "SELECT * FROM cat_colonia WHERE pk_colonia='$v_coloniafracc' and estatus='1'";
            $result = @mysql_query($sql) or die(mysql_error());
            if(!$result){
                return false;
            }else{
                return $result;
            }
            
        }       
        
    }
    
    
          function ConsultaGeneracionesCatalogo(){
                $db =  new database;
                if($db->conectar() == true){
                    $sql = "SELECT * FROM cat_generacion WHERE activo='0'";
                    $result = @mysql_query($sql) or die(mysql_error());
                    if(!$result){
                        return false;
                    }else{
                        return $result;
                    }

                }       

            }
    
    
    
    function ConsultaGeneraciones(){
        $db =  new database;
        if($db->conectar() == true){
            $sql = "SELECT 
                        cat_generacion.pk_generacion,
                         cat_generacion.TipoGeneracion,
                        cat_generacion.descripcion as GeneracionDescripcion,
                        
                        AnioInicio.descripcion as AnioInicioDescripcion,
                        MesInicio.descripcion as MesIniciodescripcion,
                        
                        AnioFin.descripcion as AnioFinDescripcion,
                        MesFin.descripcion as MesFindescripcion,
                        tbl_tipogeneracion.DescripcionTipoGeneracion
                        
                    FROM cat_generacion 
                    INNER JOIN cat_anios as AnioInicio ON cat_generacion.fk_inicioanios = AnioInicio.pk_anios
                    INNER JOIN cat_meses as MesInicio ON cat_generacion.fk_iniciomes = MesInicio.pk_meses
                    INNER JOIN cat_anios as AnioFin ON cat_generacion.fk_finanios = AnioFin.pk_anios
                    INNER JOIN cat_meses as MesFin ON cat_generacion.fk_finmeses = MesFin.pk_meses
                    
INNER JOIN tbl_tipogeneracion ON tbl_tipogeneracion.Pk_TipoGeneracion = cat_generacion.TipoGeneracion
                    WHERE activo='1' ORDER BY `cat_generacion`.`descripcion` ASC  ";
            $result = @mysql_query($sql) or die(mysql_error());
            if(!$result){
                return false;
            }else{
                return $result;
            }
            
        }       
        
    }
    
    
	     function Contiempoencuentrotrabajo(){
        $db =  new database;
        if($db->conectar() == true){
            $sql = "SELECT * FROM cat_tiempo WHERE estatus='1'";
            $result = @mysql_query($sql) or die(mysql_error());
            if(!$result){
                return false;
            }else{
                return $result;
            }
            
        }       
        
    }
    
    
    
    
     function ConsultaGeneracionesPorLLavePrimaria($pk_generacion){
        $db =  new database;
        if($db->conectar() == true){
            $sql = "SELECT 
                        cat_generacion.pk_generacion,
                        cat_generacion.descripcion as GeneracionDescripcion,
                        
                        AnioInicio.descripcion as AnioInicioDescripcion,
                        MesInicio.descripcion as MesIniciodescripcion,
                        
                        AnioInicio.pk_anios as AnioIniciopk_anios,
                        MesInicio.pk_meses as MesIniciopk_meses,
                        
                        AnioFin.descripcion as AnioFinDescripcion,
                        MesFin.descripcion as MesFindescripcion,
                        
                        AnioFin.pk_anios as AnioFinpk_anios,
                        MesFin.pk_meses as MesFinpk_meses
                        
                    FROM cat_generacion 
                    INNER JOIN cat_anios as AnioInicio ON cat_generacion.fk_inicioanios = AnioInicio.pk_anios
                    INNER JOIN cat_meses as MesInicio ON cat_generacion.fk_iniciomes = MesInicio.pk_meses
                    INNER JOIN cat_anios as AnioFin ON cat_generacion.fk_finanios = AnioFin.pk_anios
                    INNER JOIN cat_meses as MesFin ON cat_generacion.fk_finmeses = MesFin.pk_meses
                    WHERE activo='1' AND pk_generacion='$pk_generacion'";
            $result = @mysql_query($sql) or die(mysql_error());
            if(!$result){
                return false;
            }else{
                return $result;
            }
            
        }       
        
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    //CONSULTAS PARA MODULOS
    //CESAR
    function obtenerNivelestudio()
    {
        $db=new database();
        if($db->conectar()==true){
            $sql="SELECT * FROM  cat_nivelestudio WHERE estadoNivel=1";
            $result = @mysql_query($sql) or die(mysql_error());
            if(!$result){
                return false;
            }else{
                return $result;
            }
        }
        
    }
    
    function obtenerModalidad()
    {
        $db = new database();
        if($db->conectar()==true){
            $sql="SELECT * FROM cat_modalidad WHERE estadoMod=1";
            $result = @mysql_query($sql) or die(mysql_error());
            if(!isset($result)){
                return false;
            }else{
                return $result;
            }
        }
        
    }
    
    function obtenerEscuelas()
    {
        $db=new database();
        if($db->conectar()== true){
            $sql="SELECT * FROM tbl_escuela WHERE escuelaActiva=1";
            $result = @mysql_query($sql) or die(mysql_error());
            if(!isset($result)){
                return false;
            }else{
                return $result;
            }
        }
        
    }
    
    function obtenercarreras($idCarrera){
        $db = new database();
        if($db->conectar()==true){
        $sql = "SELECT * FROM tbl_carreras 
INNER JOIN cat_modalidad ON cat_modalidad.pk_modalidad = tbl_carreras.fk_modalidad
INNER JOIN cat_nivelestudio ON cat_nivelestudio.pk_nivelestudio = tbl_carreras.fk_nivelestudio
INNER JOIN tbl_escuela ON tbl_escuela.pk_dtgenerales = tbl_carreras.fk_dtgenerales AND tbl_carreras.pk_carreras = '$idCarrera'";
        $result = @mysql_query($sql) or die(@mysql_error());
        if(!isset($result)){
            return false;
        }else{
            return $result;
        }
      }
   }
   
   function obtCarreras(){
        $db = new database();
        if($db->conectar()==true){
        $sql = "SELECT * FROM tbl_carreras
INNER JOIN cat_modalidad ON cat_modalidad.pk_modalidad = tbl_carreras.fk_modalidad 
INNER JOIN cat_nivelestudio ON cat_nivelestudio.pk_nivelestudio = tbl_carreras.fk_nivelestudio AND estadoCarrera=0";
        $result = @mysql_query($sql) or die(@mysql_error());
        if(!isset($result)){
            return false;
        }else{
            return $result;
        }
      }
   }
   
   
      function obtCarrerasActivas(){
        $db = new database();
        if($db->conectar()==true){
        $sql = "SELECT * FROM tbl_carreras
INNER JOIN cat_modalidad ON cat_modalidad.pk_modalidad = tbl_carreras.fk_modalidad 
INNER JOIN cat_nivelestudio ON cat_nivelestudio.pk_nivelestudio = tbl_carreras.fk_nivelestudio AND estadoCarrera=1";
        $result = @mysql_query($sql) or die(@mysql_error());
        if(!isset($result)){
            return false;
        }else{
            return $result;
        }
      }
   }
   
   function ConCarrerasporModalidadNivelEstudios($fk_modalidad, $fk_nivelestudio){
       $dbPeon = new database();
       if($dbPeon->conectar() == true ){
           $sql="SELECT * FROM tbl_carreras WHERE estadoCarrera=1 AND fk_modalidad='$fk_modalidad' AND fk_nivelestudio='$fk_nivelestudio'";
           $result = @mysql_query($sql) or die(@mysql_error());
           if(!isset($result)){
               return false;
           }else{
               return $result;
           }
       }
       
   }   
   
   
    function TodasCarreras(){
       $dbPeon = new database();
       if($dbPeon->conectar() == true ){
           $sql="SELECT * FROM tbl_carreras WHERE estadoCarrera=1";
           $result = @mysql_query($sql) or die(@mysql_error());
           if(!isset($result)){
               return false;
           }else{
               return $result;
           }
       }
       
   }   
   
   
   
   function verTrabajadores(){
       $db = new database();
        if($db->conectar()==true){
        $sql = "SELECT * FROM tbl_trabajadores,tbl_carreras,rel_trabajadorecarreras
WHERE tbl_trabajadores.pk_trabajador = rel_trabajadorecarreras.fk_trabajador 
AND tbl_carreras.pk_carreras = rel_trabajadorecarreras.fk_carreras AND rel_trabajadorecarreras.activoPersona = 1";
        $result = @mysql_query($sql) or die(@mysql_error());
        if(!isset($result)){
            return false;
        }else{
            return $result;
        }
      }
       
   }
   
   
     function verTrabajadoresDirectoresReportes($fk_carreras){
       $db = new database();
        if($db->conectar()==true){
        $sql = "SELECT *, CONCAT_WS( ' ', `nombre` , `apaterno` , `amaterno` ) AS NombreCompletoDirector 
               FROM tbl_trabajadores               
               LEFT JOIN rel_trabajadorecarreras ON tbl_trabajadores.pk_trabajador = rel_trabajadorecarreras.fk_trabajador
               LEFT JOIN tbl_carreras ON tbl_carreras.pk_carreras = rel_trabajadorecarreras.fk_carreras
                WHERE 
                rel_trabajadorecarreras.fk_carreras  = '$fk_carreras'
                AND rel_trabajadorecarreras.activoPersona = 1";
        $result = @mysql_query($sql) or die(@mysql_error());
        if(!isset($result)){
            return false;
        }else{
            return $result;
        }
      }
       
   }
   
   
     function verTrabajadoresbaja(){
       $db = new database();
        if($db->conectar()==true){
        $sql = "SELECT * FROM tbl_trabajadores,tbl_carreras,rel_trabajadorecarreras
WHERE tbl_trabajadores.pk_trabajador = rel_trabajadorecarreras.fk_trabajador 
AND tbl_carreras.pk_carreras = rel_trabajadorecarreras.fk_carreras AND rel_trabajadorecarreras.activoPersona = 0";
        $result = @mysql_query($sql) or die(@mysql_error());
        if(!isset($result)){
            return false;
        }else{
            return $result;
        }
      }
       
   }
   
   
   
   function editTrabajador($id){
       $db = new database();
        if($db->conectar()==true){
        $sql = "SELECT * FROM tbl_trabajadores,tbl_carreras,rel_trabajadorecarreras
WHERE tbl_trabajadores.pk_trabajador = rel_trabajadorecarreras.fk_trabajador 
AND tbl_carreras.pk_carreras = rel_trabajadorecarreras.fk_carreras AND rel_trabajadorecarreras.activoPersona = 1";
        $result = @mysql_query($sql) or die(@mysql_error());
        if(!isset($result)){
            return false;
        }else{
            return $result;
        }
      }
       
   }
   
   
   
   
   // INNER JOIN cat_colonia ON cat_colonia.pk_colonia = tbl_alumnos.fk_colonia
  //                  INNER JOIN cat_municipios ON cat_municipios.pk_ciudad = cat_colonia.fk_municipio
  //                  INNER JOIN cat_estado ON cat_estado.pk_estado = cat_municipios.fk_estado
                   
    function ConAlumnosporMatricula($matricula_buscar){
        $db =  new database;
        if($db->conectar() == true){
            $sql = "SELECT *, cat_generacion.descripcion as DescripcionGeneracion,
                    CONCAT_WS( ' ', TRIM(apaterno) , TRIM(amaterno), TRIM(nombre) ) AS NombreCompleto 
                    FROM tbl_alumnos
                    INNER JOIN cat_genero ON cat_genero.pk_genero = tbl_alumnos.fk_genero
                    
                    
                    INNER JOIN tbl_carreras ON tbl_carreras.pk_carreras = tbl_alumnos.fk_carreras
                    INNER JOIN cat_turnos ON cat_turnos.pk_turnos = tbl_alumnos.fk_turnos
                    INNER JOIN cat_anios ON cat_anios.pk_anios = tbl_alumnos.PlanEstudios
                    INNER JOIN cat_generacion ON cat_generacion.pk_generacion = tbl_alumnos.fk_generacion
                    WHERE `matricula` LIKE '%$matricula_buscar%'
                    OR  CONCAT_WS( ' ', TRIM(apaterno) , TRIM(amaterno) )  LIKE '%$matricula_buscar%'
                        GROUP BY matricula ASC
                    ";
            $result = @mysql_query($sql) or die(mysql_error());
            if(!$result){
                return false;
            }else{
                return $result;
            }
            
        }       
        
    }
   
    
    
    
    function ConAlumnosporMatriculaSecretariaEducacion($matricula_buscar){
        $db =  new database;
        if($db->conectar() == true){
            $sql = "SELECT *, cat_generacion.descripcion as DescripcionGeneracion,
                    CONCAT_WS( ' ', `apaterno` , `amaterno` , `nombre` ) AS NombreCompleto 
                    FROM tbl_alumnos
                    INNER JOIN cat_genero ON cat_genero.pk_genero = tbl_alumnos.fk_genero
                    
                    INNER JOIN cat_colonia ON cat_colonia.pk_colonia = tbl_alumnos.fk_colonia
                    INNER JOIN cat_municipios ON cat_municipios.pk_ciudad = cat_colonia.fk_municipio
                    INNER JOIN cat_estado ON cat_estado.pk_estado = cat_municipios.fk_estado
                    
                    INNER JOIN tbl_carreras ON tbl_carreras.pk_carreras = tbl_alumnos.fk_carreras
                    INNER JOIN cat_turnos ON cat_turnos.pk_turnos = tbl_alumnos.fk_turnos
                    INNER JOIN cat_anios ON cat_anios.pk_anios = tbl_alumnos.PlanEstudios
                    INNER JOIN cat_generacion ON cat_generacion.pk_generacion = tbl_alumnos.fk_generacion
                    
                    INNER JOIN tbl_tomadeprotesta ON tbl_tomadeprotesta.fk_alumno = tbl_alumnos.pk_alumno
                    WHERE `matricula` LIKE '%$matricula_buscar%'
                    OR  CONCAT_WS( ' ', TRIM(apaterno) , TRIM(amaterno) )  LIKE '%$matricula_buscar%'
                    ";
            $result = @mysql_query($sql) or die(mysql_error());
            if(!$result){
                return false;
            }else{
                return $result;
            }
            
        }       
        
    }
    
       
    function ConDuracion(){
        $db =  new database;
        if($db->conectar() == true){
            $sql = "SELECT *
                    FROM cat_duracion
                    WHERE StatusDuracion='1'";
            $result = @mysql_query($sql) or die(mysql_error());
            if(!$result){
                return false;
            }else{
                return $result;
            }
            
        }       
        
    }
    
    
    
    function ConDatosAreaFormacion($fk_carreras){
        $db =  new database;
        if($db->conectar() == true){
            $sql = "SELECT *
                    FROM tbl_areasformacion
                    WHERE fk_carreras='$fk_carreras'";
            $result = @mysql_query($sql) or die(mysql_error());
            if(!$result){
                return false;
            }else{
                return $result;
            }
            
        }       
        
    }
    

    function ConAlumnosporLlavePrimaria($pk_alumno){
        $db =  new database;
        if($db->conectar() == true){
            $sql = "SELECT *, cat_generacion.descripcion as DescripcionGeneracion,
                    DATE_FORMAT(FechaNacimiento, '%d/%m/%Y') AS FechaNacimiento,
                    DATE_FORMAT(fechaexpediciontitulo, '%d/%m/%Y') AS fechaexpediciontitulo,
                     DATE_FORMAT(FechaTomaProtesta, '%d/%m/%Y') AS FechaTomaProtesta,
                    DATE_FORMAT(CertificacionProfesionalFecha, '%d/%m/%Y') AS CertificacionProfesionalFecha,
                    DATE_FORMAT(fechaEntregaCredencial, '%d/%m/%Y') AS fechaEntregaCredencial,  
                    tbl_egresados.TipoAcreditacion as TipoAcreditacion,
                    tbl_egresados.fk_ingresoactual as fk_ingresoactualegre,
                    tbl_egresados.fk_gradosatisfaccion as fk_gradosatisfaccionegre,
                    
                    tbl_tomadeprotesta.observacion as observacion,
                    tbl_tomadeprotesta.fk_titulacion,
                    tbl_tomadeprotesta.FolioActa,
                     
                    CONCAT_WS( ' ', `apaterno` , `amaterno` , `nombre` ) AS NombreCompleto 
                    FROM tbl_alumnos
                    
                    LEFT JOIN tbl_egresados ON tbl_egresados.fk_alumnos = tbl_alumnos.pk_alumno
                    LEFT JOIN tbl_tomadeprotesta ON tbl_tomadeprotesta.fk_alumno = tbl_alumnos.pk_alumno
                    LEFT JOIN tbl_encuestamedicina ON tbl_encuestamedicina.fk_alumno = tbl_alumnos.pk_alumno
                    INNER JOIN cat_genero ON cat_genero.pk_genero = tbl_alumnos.fk_genero
                    
                    INNER JOIN cat_colonia ON cat_colonia.pk_colonia = tbl_alumnos.fk_colonia
                    INNER JOIN cat_municipios ON cat_municipios.pk_ciudad = cat_colonia.fk_municipio
                    INNER JOIN cat_estado ON cat_estado.pk_estado = cat_municipios.fk_estado
                    
                    INNER JOIN tbl_carreras ON tbl_carreras.pk_carreras = tbl_alumnos.fk_carreras
                    INNER JOIN cat_turnos ON cat_turnos.pk_turnos = tbl_alumnos.fk_turnos
                    INNER JOIN cat_anios ON cat_anios.pk_anios = tbl_alumnos.PlanEstudios
                    INNER JOIN cat_generacion ON cat_generacion.pk_generacion = tbl_alumnos.fk_generacion
                    WHERE pk_alumno = '$pk_alumno'";
            $result = @mysql_query($sql) or die(mysql_error());
            if(!$result){
                return false;
            }else{
                return $result;
            }
            
        }       
        
    }
      
   
    function ConAlumnosporLlavePrimariaExamenInst($pk_alumno){
        $db =  new database;
        if($db->conectar() == true){
            $sql = "SELECT *, cat_generacion.descripcion as DescripcionGeneracion,
                    DATE_FORMAT(FechaNacimiento, '%d/%m/%Y') AS FechaNacimiento,
                    DATE_FORMAT(fechaaplicacion, '%d/%m/%Y') AS fechaaplicacion,
                    CONCAT_WS( ' ', `apaterno` , `amaterno` , `nombre` ) AS NombreCompleto 
                    FROM tbl_alumnos
                    
                    LEFT JOIN tbl_egresados ON tbl_egresados.fk_alumnos = tbl_alumnos.pk_alumno
                    LEFT JOIN tbl_exainstitucional ON tbl_exainstitucional.fk_alumno = tbl_alumnos.pk_alumno
                    INNER JOIN cat_genero ON cat_genero.pk_genero = tbl_alumnos.fk_genero
                    
                    INNER JOIN cat_colonia ON cat_colonia.pk_colonia = tbl_alumnos.fk_colonia
                    INNER JOIN cat_municipios ON cat_municipios.pk_ciudad = cat_colonia.fk_municipio
                    INNER JOIN cat_estado ON cat_estado.pk_estado = cat_municipios.fk_estado
                    
                    INNER JOIN tbl_carreras ON tbl_carreras.pk_carreras = tbl_alumnos.fk_carreras
                    INNER JOIN cat_turnos ON cat_turnos.pk_turnos = tbl_alumnos.fk_turnos
                    INNER JOIN cat_anios ON cat_anios.pk_anios = tbl_alumnos.PlanEstudios
                    INNER JOIN cat_generacion ON cat_generacion.pk_generacion = tbl_alumnos.fk_generacion
                    WHERE pk_alumno = '$pk_alumno'";
            $result = @mysql_query($sql) or die(mysql_error());
            if(!$result){
                return false;
            }else{
                return $result;
            }
            
        }       
        
    }
    
    
    
     function ConReporteDocumentacionAlumnos($fk_nivelestudio, $fk_modalidad, $fk_carreras, $fechaInicio, $fechaFin){
        $db =  new database;
        if($db->conectar() == true){
            $sql = "SELECT *, cat_generacion.descripcion as DescripcionGeneracion,
                    DATE_FORMAT(FechaNacimiento, '%d/%m/%Y') AS FechaNacimiento,
                    DATE_FORMAT(fechaaplicacion, '%d/%m/%Y') AS fechaaplicacion,
                    DATE_FORMAT(fechaaplicacion, '%Y-%m-%d') AS fechaaplicacionReporte,
                    IF( STRCMP( ActaOriginal, '1' ) , 'No', 'Si' ) as ActaOriginal,
                    IF( STRCMP( ActaCopia, '1' ) , 'No', 'Si' ) as ActaCopia,
                    IF( STRCMP( cbOriginal, '1' ) , 'No', 'Si' ) as cbOriginal,
                    IF( STRCMP( cbCopia, '1' ) , 'No', 'Si' ) as cbCopia,
                    IF( STRCMP( clicOriginal, '1' ) , 'No', 'Si' ) as clicOriginal,
                    IF( STRCMP( clicCopia, '1' ) , 'No', 'Si' ) as clicCopia,
                    IF( STRCMP( curpOriginal, '1' ) , 'No', 'Si' ) as curpOriginal,
                    IF( STRCMP( curpCopia, '1' ) , 'No', 'Si' ) as curpCopia,
                    
                    IF( STRCMP( consservicioOriginal, '1' ) , 'No', 'Si' ) as consservicioOriginal,
                    IF( STRCMP( consservicioCopia, '1' ) , 'No', 'Si' ) as consservicioCopia,
                    IF( STRCMP( reciboOriginal, '1' ) , 'No', 'Si' ) as reciboOriginal,
                    IF( STRCMP( reciboCopia, '1' ) , 'No', 'Si' ) as reciboCopia,
                    IF( STRCMP( triniti, '1' ) , 'No', 'Si' ) as triniti,
                    IF( STRCMP( trinitiCopia, '1' ) , 'No', 'Si' ) as trinitiCopia,
                    
                    CONCAT_WS( ' ', `apaterno` , `amaterno` , `nombre` ) AS NombreCompleto 
                    FROM tbl_alumnos
                    
                    LEFT JOIN tbl_egresados ON tbl_egresados.fk_alumnos = tbl_alumnos.pk_alumno
                    LEFT JOIN tbl_exainstitucional ON tbl_exainstitucional.fk_alumno = tbl_alumnos.pk_alumno
                    LEFT JOIN tbl_resultadoexamen ON tbl_resultadoexamen.fk_alumno = tbl_alumnos.pk_alumno
                    

                    INNER JOIN cat_genero ON cat_genero.pk_genero = tbl_alumnos.fk_genero
                    
                    INNER JOIN cat_colonia ON cat_colonia.pk_colonia = tbl_alumnos.fk_colonia
                    INNER JOIN cat_municipios ON cat_municipios.pk_ciudad = cat_colonia.fk_municipio
                    INNER JOIN cat_estado ON cat_estado.pk_estado = cat_municipios.fk_estado
                    
                    INNER JOIN tbl_carreras ON tbl_carreras.pk_carreras = tbl_alumnos.fk_carreras
                    INNER JOIN cat_turnos ON cat_turnos.pk_turnos = tbl_alumnos.fk_turnos
                    INNER JOIN cat_anios ON cat_anios.pk_anios = tbl_alumnos.PlanEstudios
                    INNER JOIN cat_generacion ON cat_generacion.pk_generacion = tbl_alumnos.fk_generacion
                    WHERE 
                    tbl_alumnos.fk_nivelestudio = '$fk_nivelestudio' AND
                    tbl_alumnos.fk_modalidad = '$fk_modalidad' AND  
                    tbl_alumnos.fk_carreras = '$fk_carreras' AND    
                    tbl_exainstitucional.fechaaplicacion BETWEEN '".$fechaInicio."' and '".$fechaFin."'     
		    ORDER BY tbl_alumnos.apaterno ASC
                    ";
            $result = @mysql_query($sql) or die(mysql_error());
            if(!$result){
                return false;
            }else{
                return $result;
            }
            
        }       
        
    }
    
    
    
     function ConReporteSabanaAutorizaciones($fk_nivelestudio, $fk_modalidad, $fk_carreras, $fechaInicio, $fechaFin){
        $db =  new database;
        if($db->conectar() == true){
            $sql = "SELECT *,  RIGHT( NumeroAutorizacion, 4) AS autorizacion1,
                    cat_generacion.descripcion as DescripcionGeneracion,
                    DATE_FORMAT(FechaNacimiento, '%d/%m/%Y') AS FechaNacimiento,
                    DATE_FORMAT(fechaaplicacion, '%d/%m/%Y') AS fechaaplicacion,
                    DATE_FORMAT(fechaaplicacion, '%Y-%m-%d') AS fechaaplicacionReporte,
                    IF( STRCMP( ActaOriginal, '1' ) , 'No', 'Si' ) as ActaOriginal,
                    IF( STRCMP( ActaCopia, '1' ) , 'No', 'Si' ) as ActaCopia,
                    IF( STRCMP( cbOriginal, '1' ) , 'No', 'Si' ) as cbOriginal,
                    IF( STRCMP( cbCopia, '1' ) , 'No', 'Si' ) as cbCopia,
                    IF( STRCMP( clicOriginal, '1' ) , 'No', 'Si' ) as clicOriginal,
                    IF( STRCMP( clicCopia, '1' ) , 'No', 'Si' ) as clicCopia,
                    IF( STRCMP( curpOriginal, '1' ) , 'No', 'Si' ) as curpOriginal,
                    IF( STRCMP( curpCopia, '1' ) , 'No', 'Si' ) as curpCopia,
                    
                    IF( STRCMP( consservicioOriginal, '1' ) , 'No', 'Si' ) as consservicioOriginal,
                    IF( STRCMP( consservicioCopia, '1' ) , 'No', 'Si' ) as consservicioCopia,
                    IF( STRCMP( reciboOriginal, '1' ) , 'No', 'Si' ) as reciboOriginal,
                    IF( STRCMP( reciboCopia, '1' ) , 'No', 'Si' ) as reciboCopia,
                    IF( STRCMP( triniti, '1' ) , 'No', 'Si' ) as triniti,
                    IF( STRCMP( trinitiCopia, '1' ) , 'No', 'Si' ) as trinitiCopia,
                    
                    CONCAT_WS( ' ', `apaterno` , `amaterno` , `nombre` ) AS NombreCompleto 



                    FROM tbl_alumnos

                  

                    LEFT JOIN tbl_egresados ON tbl_egresados.fk_alumnos = tbl_alumnos.pk_alumno
                    LEFT JOIN tbl_exainstitucional ON tbl_exainstitucional.fk_alumno = tbl_alumnos.pk_alumno
                    LEFT JOIN tbl_resultadoexamen ON tbl_resultadoexamen.fk_alumno = tbl_alumnos.pk_alumno
                    LEFT JOIN tbl_tomadeprotesta ON tbl_tomadeprotesta.fk_alumno = tbl_alumnos.pk_alumno
                    

                    INNER JOIN cat_genero ON cat_genero.pk_genero = tbl_alumnos.fk_genero
                    
                    INNER JOIN cat_colonia ON cat_colonia.pk_colonia = tbl_alumnos.fk_colonia
                    INNER JOIN cat_municipios ON cat_municipios.pk_ciudad = cat_colonia.fk_municipio
                    INNER JOIN cat_estado ON cat_estado.pk_estado = cat_municipios.fk_estado
                    
                    INNER JOIN tbl_carreras ON tbl_carreras.pk_carreras = tbl_alumnos.fk_carreras
                    INNER JOIN cat_turnos ON cat_turnos.pk_turnos = tbl_alumnos.fk_turnos
                    INNER JOIN cat_anios ON cat_anios.pk_anios = tbl_alumnos.PlanEstudios
                    INNER JOIN cat_generacion ON cat_generacion.pk_generacion = tbl_alumnos.fk_generacion
                    WHERE 
                    tbl_alumnos.fk_nivelestudio = '$fk_nivelestudio' AND
                    tbl_alumnos.fk_modalidad = '$fk_modalidad' AND  
                    tbl_alumnos.fk_carreras = '$fk_carreras' AND    
                    tbl_tomadeprotesta.FechaTomaProtesta BETWEEN '".$fechaInicio."' and '".$fechaFin."'     
ORDER BY autorizacion1 ASC
                    ";
            $result = @mysql_query($sql) or die(mysql_error());
            if(!$result){
                return false;
            }else{
                return $result;
            }
            
        }       
        
    }
    
    
       
        
    function ConCantidadAlumnosTitulados($fk_nivelestudio, $fk_modalidad, $fk_carreras, $fk_generacion){
        $db =  new database;
        if($db->conectar() == true){
            $sql = "SELECT COUNT(*) as cantidadTotalEgresados 
                    FROM tbl_alumnos
                    
                    LEFT JOIN tbl_egresados ON tbl_egresados.fk_alumnos = tbl_alumnos.pk_alumno
                    

                    INNER JOIN cat_genero ON cat_genero.pk_genero = tbl_alumnos.fk_genero
                    
                    INNER JOIN cat_colonia ON cat_colonia.pk_colonia = tbl_alumnos.fk_colonia
                    INNER JOIN cat_municipios ON cat_municipios.pk_ciudad = cat_colonia.fk_municipio
                    INNER JOIN cat_estado ON cat_estado.pk_estado = cat_municipios.fk_estado
                    
                    INNER JOIN tbl_carreras ON tbl_carreras.pk_carreras = tbl_alumnos.fk_carreras
                    INNER JOIN cat_turnos ON cat_turnos.pk_turnos = tbl_alumnos.fk_turnos
                    INNER JOIN cat_anios ON cat_anios.pk_anios = tbl_alumnos.PlanEstudios
                    INNER JOIN cat_generacion ON cat_generacion.pk_generacion = tbl_alumnos.fk_generacion
                    WHERE 
                    tbl_alumnos.fk_nivelestudio = '$fk_nivelestudio' AND
                    tbl_alumnos.fk_modalidad = '$fk_modalidad' AND  
                    tbl_alumnos.fk_carreras = '$fk_carreras' AND    
                    tbl_alumnos.fk_generacion = '$fk_generacion' AND 
                     tbl_egresados.fk_estadoTitulacion='1'";
            $result = @mysql_query($sql) or die(mysql_error());
            if(!$result){
                return false;
            }else{
                return $result;
            }
            
        }       
        
    }
    
        
    function ConCantidadAlumnosTituladosNoTitulados($fk_nivelestudio, $fk_modalidad, $fk_carreras, $fk_generacion){
        $db =  new database;
        if($db->conectar() == true){
            $sql = "SELECT COUNT(*) as cantidadTotal
                    FROM tbl_alumnos
                    
                    LEFT JOIN tbl_egresados ON tbl_egresados.fk_alumnos = tbl_alumnos.pk_alumno

                    LEFT JOIN tbl_resultadoexamen ON tbl_resultadoexamen.fk_alumno = tbl_alumnos.pk_alumno
                    LEFT JOIN tbl_tomadeprotesta ON tbl_tomadeprotesta.fk_alumno = tbl_alumnos.pk_alumno
                    

                    INNER JOIN cat_genero ON cat_genero.pk_genero = tbl_alumnos.fk_genero
                    
                    INNER JOIN cat_colonia ON cat_colonia.pk_colonia = tbl_alumnos.fk_colonia
                    INNER JOIN cat_municipios ON cat_municipios.pk_ciudad = cat_colonia.fk_municipio
                    INNER JOIN cat_estado ON cat_estado.pk_estado = cat_municipios.fk_estado
                    
                    INNER JOIN tbl_carreras ON tbl_carreras.pk_carreras = tbl_alumnos.fk_carreras
                    INNER JOIN cat_turnos ON cat_turnos.pk_turnos = tbl_alumnos.fk_turnos
                    INNER JOIN cat_anios ON cat_anios.pk_anios = tbl_alumnos.PlanEstudios
                    INNER JOIN cat_generacion ON cat_generacion.pk_generacion = tbl_alumnos.fk_generacion
                    WHERE 
                    tbl_alumnos.fk_nivelestudio = '$fk_nivelestudio' AND
                    tbl_alumnos.fk_modalidad = '$fk_modalidad' AND  
                    tbl_alumnos.fk_carreras = '$fk_carreras' AND    
                    tbl_alumnos.fk_generacion = '$fk_generacion' 

                     
                    ";
            $result = @mysql_query($sql) or die(mysql_error());
            if(!$result){
                return false;
            }else{
                return $result;
            }
            
        }       
        
    }
    
        
    
    function ConCantidadAlumnosTituladosParaReporte($fk_nivelestudio, $fk_modalidad, $fk_carreras, $fk_generacion, $fk_estadoTitulacion){
        $db =  new database;
        if($db->conectar() == true){
            $sql = "SELECT *,  RIGHT( NumeroAutorizacion, 4) AS autorizacion1,
                    cat_generacion.descripcion as DescripcionGeneracion,
                    DATE_FORMAT(FechaNacimiento, '%d/%m/%Y') AS FechaNacimiento,
         DATE_FORMAT(fechaaplicacion, '%d/%m/%Y') AS fechaaplicacion,
                    DATE_FORMAT(fechaaplicacion, '%Y-%m-%d') AS fechaaplicacionReporte,
                    
                    cat_generacion.descripcion as DescripcionGeneracion,
                    cat_turnos.descripcion as DescripcionTurnos,
                    cat_opciontitulacion.Nombre as NombreOpcionTitulacion, tbl_tomadeprotesta.observacion,
                    CONCAT_WS( ' ', tbl_alumnos.apaterno , tbl_alumnos.amaterno , tbl_alumnos.nombre ) AS NombreCompleto 
                    FROM tbl_alumnos
                    
                    LEFT JOIN tbl_egresados ON tbl_egresados.fk_alumnos = tbl_alumnos.pk_alumno
                    LEFT JOIN tbl_exainstitucional ON tbl_exainstitucional.fk_alumno = tbl_alumnos.pk_alumno
                    LEFT JOIN tbl_resultadoexamen ON tbl_resultadoexamen.fk_alumno = tbl_alumnos.pk_alumno
                    LEFT JOIN tbl_tomadeprotesta ON tbl_tomadeprotesta.fk_alumno = tbl_alumnos.pk_alumno
                    

                    INNER JOIN cat_genero ON cat_genero.pk_genero = tbl_alumnos.fk_genero
                    
                    INNER JOIN cat_colonia ON cat_colonia.pk_colonia = tbl_alumnos.fk_colonia
                    INNER JOIN cat_municipios ON cat_municipios.pk_ciudad = cat_colonia.fk_municipio
                    INNER JOIN cat_estado ON cat_estado.pk_estado = cat_municipios.fk_estado
                    
                    INNER JOIN tbl_carreras ON tbl_carreras.pk_carreras = tbl_alumnos.fk_carreras
                    INNER JOIN cat_turnos ON cat_turnos.pk_turnos = tbl_alumnos.fk_turnos
                    INNER JOIN cat_anios ON cat_anios.pk_anios = tbl_alumnos.PlanEstudios
                    INNER JOIN cat_generacion ON cat_generacion.pk_generacion = tbl_alumnos.fk_generacion
                    LEFT JOIN cat_opciontitulacion ON cat_opciontitulacion.pk_titulacion=tbl_tomadeprotesta.fk_titulacion
                    WHERE 
                    tbl_alumnos.fk_nivelestudio = '$fk_nivelestudio' AND
                    tbl_alumnos.fk_modalidad = '$fk_modalidad' AND  
                    tbl_alumnos.fk_carreras = '$fk_carreras' AND    
                    tbl_alumnos.fk_generacion = '$fk_generacion' AND    
                    tbl_egresados.fk_estadoTitulacion = '$fk_estadoTitulacion'   
                    ";
            $result = @mysql_query($sql) or die(mysql_error());
            if(!$result){
                return false;
            }else{
                return $result;
            }
            
        }       
        
    }
    
    
          
       
    function ConCantidadAlumnosTituladosParaReporteTodasGen($fk_nivelestudio, $fk_modalidad, $fk_carreras){
        $db =  new database;
        if($db->conectar() == true){
            $sql = "SELECT *,  RIGHT( NumeroAutorizacion, 4) AS autorizacion1,
                    cat_generacion.descripcion as DescripcionGeneracion,
                    DATE_FORMAT(FechaNacimiento, '%d/%m/%Y') AS FechaNacimiento,

                    DATE_FORMAT(fechaaplicacion, '%d/%m/%Y') AS fechaaplicacion,
                    DATE_FORMAT(fechaaplicacion, '%Y-%m-%d') AS fechaaplicacionReporte,

                    cat_generacion.descripcion as DescripcionGeneracion, tbl_tomadeprotesta.observacion,

                    cat_generacion.descripcion as DescripcionGeneracion,
                    cat_turnos.descripcion as DescripcionTurnos,
                    cat_opciontitulacion.Nombre as NombreOpcionTitulacion,
                    CONCAT_WS( ' ', tbl_alumnos.apaterno , tbl_alumnos.amaterno , tbl_alumnos.nombre ) AS NombreCompleto 
                    FROM tbl_alumnos
                    
                    LEFT JOIN tbl_egresados ON tbl_egresados.fk_alumnos = tbl_alumnos.pk_alumno
                    LEFT JOIN tbl_exainstitucional ON tbl_exainstitucional.fk_alumno = tbl_alumnos.pk_alumno

                    LEFT JOIN tbl_resultadoexamen ON tbl_resultadoexamen.fk_alumno = tbl_alumnos.pk_alumno
                    LEFT JOIN tbl_tomadeprotesta ON tbl_tomadeprotesta.fk_alumno = tbl_alumnos.pk_alumno
                    

                    LEFT JOIN cat_genero ON cat_genero.pk_genero = tbl_alumnos.fk_genero
                    
                    INNER JOIN cat_colonia ON cat_colonia.pk_colonia = tbl_alumnos.fk_colonia
                    INNER JOIN cat_municipios ON cat_municipios.pk_ciudad = cat_colonia.fk_municipio
                    INNER JOIN cat_estado ON cat_estado.pk_estado = cat_municipios.fk_estado
                    
                    INNER JOIN tbl_carreras ON tbl_carreras.pk_carreras = tbl_alumnos.fk_carreras
                    INNER JOIN cat_turnos ON cat_turnos.pk_turnos = tbl_alumnos.fk_turnos
                    INNER JOIN cat_anios ON cat_anios.pk_anios = tbl_alumnos.PlanEstudios
                    INNER JOIN cat_generacion ON cat_generacion.pk_generacion = tbl_alumnos.fk_generacion
                    LEFT JOIN cat_opciontitulacion ON cat_opciontitulacion.pk_titulacion=tbl_tomadeprotesta.fk_titulacion
                    WHERE 
                    tbl_alumnos.fk_nivelestudio = '$fk_nivelestudio' AND
                    tbl_alumnos.fk_modalidad = '$fk_modalidad' AND  
                    tbl_alumnos.fk_carreras = '$fk_carreras'
		    ORDER BY fk_generacion ASC ";
            $result = @mysql_query($sql) or die(mysql_error());
            if(!$result){
                return false;
            }else{
                return $result;
            }
            
        }       
        
    }
   
    function ConCantidadAlumnosTituladosParaReporteAMBOS($fk_nivelestudio, $fk_modalidad, $fk_carreras, $fk_generacion){
        $db =  new database;
        if($db->conectar() == true){
            $sql = "SELECT *,  RIGHT( NumeroAutorizacion, 4) AS autorizacion1,
                    cat_generacion.descripcion as DescripcionGeneracion,
                    DATE_FORMAT(FechaNacimiento, '%d/%m/%Y') AS FechaNacimiento,

                    DATE_FORMAT(fechaaplicacion, '%d/%m/%Y') AS fechaaplicacion,
                    DATE_FORMAT(fechaaplicacion, '%Y-%m-%d') AS fechaaplicacionReporte,

                    cat_generacion.descripcion as DescripcionGeneracion, tbl_tomadeprotesta.observacion,

                    cat_turnos.descripcion as DescripcionTurnos,
                    cat_opciontitulacion.Nombre as NombreOpcionTitulacion,
                    CONCAT_WS( ' ', tbl_alumnos.apaterno , tbl_alumnos.amaterno , tbl_alumnos.nombre ) AS NombreCompleto 
                    FROM tbl_alumnos
                    
                    LEFT JOIN tbl_egresados ON tbl_egresados.fk_alumnos = tbl_alumnos.pk_alumno

                    LEFT JOIN tbl_exainstitucional ON tbl_exainstitucional.fk_alumno = tbl_alumnos.pk_alumno

                    LEFT JOIN tbl_resultadoexamen ON tbl_resultadoexamen.fk_alumno = tbl_alumnos.pk_alumno
                    LEFT JOIN tbl_tomadeprotesta ON tbl_tomadeprotesta.fk_alumno = tbl_alumnos.pk_alumno
                    

                    INNER JOIN cat_genero ON cat_genero.pk_genero = tbl_alumnos.fk_genero
                    
                    INNER JOIN cat_colonia ON cat_colonia.pk_colonia = tbl_alumnos.fk_colonia
                    INNER JOIN cat_municipios ON cat_municipios.pk_ciudad = cat_colonia.fk_municipio
                    INNER JOIN cat_estado ON cat_estado.pk_estado = cat_municipios.fk_estado
                    
                    INNER JOIN tbl_carreras ON tbl_carreras.pk_carreras = tbl_alumnos.fk_carreras
                    INNER JOIN cat_turnos ON cat_turnos.pk_turnos = tbl_alumnos.fk_turnos
                    INNER JOIN cat_anios ON cat_anios.pk_anios = tbl_alumnos.PlanEstudios
                    INNER JOIN cat_generacion ON cat_generacion.pk_generacion = tbl_alumnos.fk_generacion
                    LEFT JOIN cat_opciontitulacion ON cat_opciontitulacion.pk_titulacion=tbl_tomadeprotesta.fk_titulacion
                    WHERE 
                    tbl_alumnos.fk_nivelestudio = '$fk_nivelestudio' AND
                    tbl_alumnos.fk_modalidad = '$fk_modalidad' AND  
                    tbl_alumnos.fk_carreras = '$fk_carreras' AND    
                    tbl_alumnos.fk_generacion = '$fk_generacion'
 
		    ORDER BY fk_estadoTitulacion, apaterno ASC 

                    ";
            $result = @mysql_query($sql) or die(mysql_error());
            if(!$result){
                return false;
            }else{
                return $result;
            }
            
        }       
        
    }
        
    
    //para la tabla de egresados
    //con todas la generaciones por carreras (lic hugo)
    function ConObtenerGeneracionesTodas($fk_nivelestudio, $fk_modalidad, $fk_carreras){
        $db =  new database;
        if($db->conectar() == true){
            $sql = "SELECT 
                    cat_generacion.descripcion as DescripcionGeneracion,
                    cat_turnos.descripcion as DescripcionTurnos,
                    tbl_alumnos.generacionNumero,
                    tbl_alumnos.fk_generacion
                    FROM tbl_alumnos
                    
                    LEFT JOIN tbl_egresados ON tbl_egresados.fk_alumnos = tbl_alumnos.pk_alumno
                    

                    INNER JOIN cat_genero ON cat_genero.pk_genero = tbl_alumnos.fk_genero
                    
                    INNER JOIN cat_colonia ON cat_colonia.pk_colonia = tbl_alumnos.fk_colonia
                    INNER JOIN cat_municipios ON cat_municipios.pk_ciudad = cat_colonia.fk_municipio
                    INNER JOIN cat_estado ON cat_estado.pk_estado = cat_municipios.fk_estado
                    
                    INNER JOIN tbl_carreras ON tbl_carreras.pk_carreras = tbl_alumnos.fk_carreras
                    INNER JOIN cat_turnos ON cat_turnos.pk_turnos = tbl_alumnos.fk_turnos
                    INNER JOIN cat_anios ON cat_anios.pk_anios = tbl_alumnos.PlanEstudios
                    INNER JOIN cat_generacion ON cat_generacion.pk_generacion = tbl_alumnos.fk_generacion
                    WHERE 
                    tbl_alumnos.fk_nivelestudio = '$fk_nivelestudio' AND
                    tbl_alumnos.fk_modalidad = '$fk_modalidad' AND  
                    tbl_alumnos.fk_carreras = '$fk_carreras'    
                     GROUP BY tbl_alumnos.generacionNumero+0                 ";
            $result = @mysql_query($sql) or die(mysql_error());
            if(!$result){
                return false;
            }else{
                return $result;
            }
            
        }       
        
    }
   
    
    
    
    
    
    
    
    
        function ConReporteDocumentacionAlumnosPorLlavePrimaria($pk_alumno){
        $db =  new database;
        if($db->conectar() == true){
            $sql = "SELECT *, 

                    pre.nombre as NombrePresidente,
                    secre.nombre as NombreSecretario,
                    vo.nombre as NombreVocal,
                    supl.nombre as NombreSuplente,
                    
                    pre.cedula as CedulaPresidente,
                    secre.cedula as CedulaSecretario,
                    vo.cedula as CedulaVocal,
                    supl.cedula as CedulaSuplente,
                    
                    cat_opciontitulacion.Nombre as NombreOpcionTitulacion,
                    
                    cat_generacion.descripcion as DescripcionGeneracion,
                    DATE_FORMAT(FechaNacimiento, '%d/%m/%Y') AS FechaNacimiento,
                    DATE_FORMAT(fechaaplicacion, '%d/%m/%Y') AS fechaaplicacion,
                    DATE_FORMAT(fechaaplicacion, '%Y-%m-%d') AS fechaaplicacionReporte,
                    DATE_FORMAT(FechaTomaProtesta, '%d/%m/%Y') AS FechaTomaProtestaReporte,
                    DATE_FORMAT(FechaExamen, '%d/%m/%Y') AS FechaExamenReporte,
                    DATE_FORMAT(fechaexpediciontitulo, '%d/%m/%Y') AS fechaexpedicionReporte,
 		 	

            DATE_FORMAT(FechaSolicitud, '%d/%m/%Y') AS FechaSolicitudLista,
                   tbl_alumnos.nombre as NombreAlumno,
                   tbl_alumnos.apaterno as ApaternoAlumno,
                   tbl_alumnos.amaterno as AmaternoAlumno,
                    tbl_alumnos.curp as CurpLista,
                    tbl_alumnos.promedio as Promedio,
                   cat_turnos.descripcion as NombreTurno,
                   cat_anios.descripcion as PlanEstudiosNombre
                    
                    FROM tbl_alumnos
                    
                    LEFT JOIN tbl_egresados ON tbl_egresados.fk_alumnos = tbl_alumnos.pk_alumno
                    LEFT JOIN tbl_exainstitucional ON tbl_exainstitucional.fk_alumno = tbl_alumnos.pk_alumno
                    LEFT JOIN tbl_tomadeprotesta ON tbl_tomadeprotesta.fk_alumno = tbl_alumnos.pk_alumno
                    LEFT JOIN tbl_resultadoexamen ON tbl_resultadoexamen.fk_alumno = tbl_alumnos.pk_alumno
                    

                    INNER JOIN cat_genero ON cat_genero.pk_genero = tbl_alumnos.fk_genero
                    INNER JOIN cat_colonia ON cat_colonia.pk_colonia = tbl_alumnos.fk_colonia
                    INNER JOIN cat_municipios ON cat_municipios.pk_ciudad = cat_colonia.fk_municipio
                    INNER JOIN cat_estado ON cat_estado.pk_estado = cat_municipios.fk_estado
                    
                    INNER JOIN tbl_carreras ON tbl_carreras.pk_carreras = tbl_alumnos.fk_carreras
                    INNER JOIN cat_turnos ON cat_turnos.pk_turnos = tbl_alumnos.fk_turnos
                    INNER JOIN cat_anios ON cat_anios.pk_anios = tbl_alumnos.PlanEstudios
                    INNER JOIN cat_generacion ON cat_generacion.pk_generacion = tbl_alumnos.fk_generacion
                    INNER JOIN cat_opciontitulacion ON cat_opciontitulacion.pk_titulacion = tbl_tomadeprotesta.fk_titulacion

                    INNER JOIN cat_duracion ON cat_duracion.Pk_Duracion = tbl_tomadeprotesta.Fk_Duracion
                    INNER JOIN tbl_profesores pre ON pre.pk_sinodal = tbl_tomadeprotesta.presidente 
                    INNER JOIN tbl_profesores secre ON secre.pk_sinodal = tbl_tomadeprotesta.secretario 
                    INNER JOIN tbl_profesores vo ON vo.pk_sinodal = tbl_tomadeprotesta.vocal
                    LEFT JOIN tbl_profesores supl ON supl.pk_sinodal = tbl_tomadeprotesta.suplente
                    
                    WHERE 
                    tbl_alumnos.pk_alumno = '$pk_alumno'     
                    ";
            $result = @mysql_query($sql) or die(mysql_error());
            if(!$result){
                return false;
            }else{
                return $result;
            }
            
        }       
        
    }
    
    
     function ConReporteDocumentacionAlumnosContador($fk_nivelestudio, $fk_modalidad, $fk_carreras, $fechaInicio, $fechaFin){
        $db =  new database;
        if($db->conectar() == true){
            $sql = "SELECT 
                    count(*) as cantidadAlumnos 
                    FROM tbl_alumnos
                    
                    LEFT JOIN tbl_egresados ON tbl_egresados.fk_alumnos = tbl_alumnos.pk_alumno
                    LEFT JOIN tbl_exainstitucional ON tbl_exainstitucional.fk_alumno = tbl_alumnos.pk_alumno
                    LEFT JOIN tbl_resultadoexamen ON tbl_resultadoexamen.fk_alumno = tbl_alumnos.pk_alumno
                    

                    INNER JOIN cat_genero ON cat_genero.pk_genero = tbl_alumnos.fk_genero
                    
                    INNER JOIN cat_colonia ON cat_colonia.pk_colonia = tbl_alumnos.fk_colonia
                    INNER JOIN cat_municipios ON cat_municipios.pk_ciudad = cat_colonia.fk_municipio
                    INNER JOIN cat_estado ON cat_estado.pk_estado = cat_municipios.fk_estado
                    
                    INNER JOIN tbl_carreras ON tbl_carreras.pk_carreras = tbl_alumnos.fk_carreras
                    INNER JOIN cat_turnos ON cat_turnos.pk_turnos = tbl_alumnos.fk_turnos
                    INNER JOIN cat_anios ON cat_anios.pk_anios = tbl_alumnos.PlanEstudios
                    INNER JOIN cat_generacion ON cat_generacion.pk_generacion = tbl_alumnos.fk_generacion
                    WHERE 
                    tbl_alumnos.fk_nivelestudio = '$fk_nivelestudio' AND
                    tbl_alumnos.fk_modalidad = '$fk_modalidad' AND  
                    tbl_alumnos.fk_carreras = '$fk_carreras' AND    
                    tbl_exainstitucional.fechaaplicacion BETWEEN '".$fechaInicio."' and '".$fechaFin."'     
                    ";
            $result = @mysql_query($sql) or die(mysql_error());
            if(!$result){
                return false;
            }else{
                return $result;
            }
            
        }       
        
    }
    
    
    
    
    function ConAlumnosporLlavePrimariaTomaProtesta($pk_alumno){
        $db =  new database;
        if($db->conectar() == true){
            $sql = "SELECT *, cat_generacion.descripcion as DescripcionGeneracion,
                    DATE_FORMAT(FechaNacimiento, '%d/%m/%Y') AS FechaNacimiento,
                    DATE_FORMAT(fechaaplicacion, '%d/%m/%Y') AS fechaaplicacion,
                    DATE_FORMAT(FechaTomaProtesta, '%d/%m/%Y') AS FechaTomaProtesta,
                    DATE_FORMAT(FechaSolicitud, '%d/%m/%Y') AS FechaSolicitud,
                    DATE_FORMAT(FechaExamen, '%d/%m/%Y') AS FechaExamen,
                    tbl_tomadeprotesta.hora as horaTomaProtesta,
					tbl_egresados.noActaExamen,

                    CONCAT_WS( ' ', `apaterno` , `amaterno` , `nombre` ) AS NombreCompleto 
                    FROM tbl_alumnos
                    
                    LEFT JOIN tbl_egresados ON tbl_egresados.fk_alumnos = tbl_alumnos.pk_alumno
                    LEFT JOIN tbl_tomadeprotesta ON tbl_tomadeprotesta.fk_alumno = tbl_alumnos.pk_alumno
                    LEFT JOIN tbl_exainstitucional ON tbl_exainstitucional.fk_alumno = tbl_alumnos.pk_alumno
                    INNER JOIN cat_genero ON cat_genero.pk_genero = tbl_alumnos.fk_genero
                    
                    INNER JOIN cat_colonia ON cat_colonia.pk_colonia = tbl_alumnos.fk_colonia
                    INNER JOIN cat_municipios ON cat_municipios.pk_ciudad = cat_colonia.fk_municipio
                    INNER JOIN cat_estado ON cat_estado.pk_estado = cat_municipios.fk_estado
                    
                    INNER JOIN tbl_carreras ON tbl_carreras.pk_carreras = tbl_alumnos.fk_carreras
                    INNER JOIN cat_turnos ON cat_turnos.pk_turnos = tbl_alumnos.fk_turnos
                    INNER JOIN cat_anios ON cat_anios.pk_anios = tbl_alumnos.PlanEstudios
                    INNER JOIN cat_generacion ON cat_generacion.pk_generacion = tbl_alumnos.fk_generacion
                    WHERE pk_alumno = '$pk_alumno'";
            $result = @mysql_query($sql) or die(mysql_error());
            if(!$result){
                return false;
            }else{
                return $result;
            }
            
        }       
        
    }
   
    
      
    /************Anibal Lopez 08/07/2014**********/
    //Consulta Sinodales Formato de Pago por carrera
    
    function ConReporteSinodalesPago($fk_nivelestudio, $fk_modalidad, $fk_carreras, $fechaUnoPago, $fechaDosPago){
        $db =  new database;
        if($db->conectar() == true){
            $sql = "SELECT *,  
                    DATE_FORMAT(tbl_tomadeprotesta.FechaTomaProtesta, '%d/%m/%Y') AS FechaTomaProtestareporte,
                    CONCAT_WS( ' ', nom.apaterno , nom.amaterno , nom.nombre ) AS NombreCompleto,

                     

                    pre.nombre as NombrePresidente,
                    secre.nombre as NombreSecretario,
                    vo.nombre  as NombreVocal,
                    su.nombre  as NombreSuplente,

                    nom.nombre as NombreAlumno,
                    titu.nombre as NombreTitulacion
                    
                    FROM tbl_tomadeprotesta
            
            
                    INNER JOIN tbl_profesores pre ON pre.pk_sinodal = tbl_tomadeprotesta.presidente
                    INNER JOIN tbl_profesores secre ON secre.pk_sinodal = tbl_tomadeprotesta.secretario
                    INNER JOIN tbl_profesores vo ON vo.pk_sinodal = tbl_tomadeprotesta.vocal
                    INNER JOIN tbl_profesores su ON su.pk_sinodal = tbl_tomadeprotesta.suplente

                    INNER JOIN tbl_alumnos nom ON nom.pk_alumno = tbl_tomadeprotesta.fk_alumno

                    INNER JOIN cat_opciontitulacion titu ON titu.pk_titulacion = tbl_tomadeprotesta.fk_titulacion
       
                    
                    WHERE 
                    nom.fk_nivelestudio = '$fk_nivelestudio' AND
                    nom.fk_modalidad = '$fk_modalidad' AND  
                    nom.fk_carreras = '$fk_carreras' AND    
                    tbl_tomadeprotesta.FechaTomaProtesta BETWEEN '".$fechaUnoPago."' and '".$fechaDosPago."'
                    order by fk_carreras
     
                    ";
            $result = @mysql_query($sql) or die(mysql_error());
            if(!$result){
                return false;
            }else{
                return $result;
            }
            
        }       
        
    } 

 /************Anibal Lopez 11/07/2014**********/
    //Consulta Sinodales Formato de Pago de Todas las carreras    
    function ConReporteSinodalesPagoTodos($fk_nivelestudio, $fk_modalidad, $fechaUnoPago, $fechaDosPago){
        $db =  new database;
        if($db->conectar() == true){
            $sql = "SELECT *,                     
                    DATE_FORMAT(tbl_tomadeprotesta.FechaTomaProtesta, '%d/%m/%Y') AS FechaTomaProtestareporte,
                    CONCAT_WS( ' ', nom.apaterno , nom.amaterno , nom.nombre ) AS NombreCompleto,
                    
                    pre.nombre as NombrePresidente,
                    secre.nombre as NombreSecretario,
                    vo.nombre  as NombreVocal,
                    
            .
                    nom.nombre as NombreAlumno,
                    titu.nombre as NombreTitulacion
                    
                    FROM tbl_tomadeprotesta


            
                    INNER JOIN tbl_alumnos nom ON nom.pk_alumno = tbl_tomadeprotesta.fk_alumno
                    
                    INNER JOIN tbl_carreras  ON tbl_carreras.pk_carreras = nom.fk_carreras
            
                    INNER JOIN cat_opciontitulacion titu ON titu.pk_titulacion = tbl_tomadeprotesta.fk_titulacion
            
                    INNER JOIN tbl_profesores pre ON pre.pk_sinodal = tbl_tomadeprotesta.presidente
                    INNER JOIN tbl_profesores secre ON secre.pk_sinodal = tbl_tomadeprotesta.secretario
                    INNER JOIN tbl_profesores vo ON vo.pk_sinodal = tbl_tomadeprotesta.vocal

                    
WHERE 
 nom.fk_nivelestudio = '$fk_nivelestudio' AND
                    nom.fk_modalidad = '$fk_modalidad' AND  

                     
                    tbl_tomadeprotesta.FechaTomaProtesta BETWEEN '".$fechaUnoPago."' and '".$fechaDosPago."'
                    order by pk_carreras

                    
                    ";
            $result = @mysql_query($sql) or die(mysql_error());
            if(!$result){
                return false;
            }else{
                return $result;
            }
            
        }       
        
    }
    
    

    
    
    function ConsultaCarrerasSinodal($fk_carreras){
        $db =  new database;
        if($db->conectar() == true){
            $sql = "SELECT * FROM tbl_carreras WHERE pk_carreras='$fk_carreras'
                
                ";
            $result = @mysql_query($sql) or die(mysql_error());
            if(!$result){
                return false;
            }else{
                return $result;
            }
            
        }       
        
    }
    
    
     function DirectoresCarreras($fk_carreras){
        $db =  new database;
        if($db->conectar() == true){
            $sql = "SELECT tbl_trabajadores.nombre, nombreCarrera FROM `tbl_trabajadores` 
                INNER JOIN rel_trabajadorecarreras ON rel_trabajadorecarreras.fk_trabajador = tbl_trabajadores.pk_trabajador 
                INNER JOIN tbl_carreras ON tbl_carreras.pk_carreras = rel_trabajadorecarreras.fk_carreras
                
                ";
            $result = @mysql_query($sql) or die(mysql_error());
            if(!$result){
                return false;
            }else{
                return $result;
            }
            
        }       
        
    }




    
    
    
    
    
    #AGREGADO: Ivan Mauricio Meneses Melo Granados		
#FECHA: 23/05/2012 10:13 am 
#MODULO AFECTADO: includes/ajax/Sistema/usuario/Ins_Usuario.php
#DESCRIPCION: Seleccionamos todas las depedencias activas
# @params        
# @return        True ó False en función de la consulta   
     function conCatMenu($Fk_Departamento) {
        $dbPeon = new database;
        if ($dbPeon->conectar() == true) {
            $query = "SELECT * FROM cat_menu WHERE Fk_Departamento='$Fk_Departamento'";
            $result = @mysql_query($query) or die(mysql_error());
            if (!$result)
                return false;
            else
                return $result;
        }
    }

    
      function ConTrabajadoresListar($matricula_buscar){
        $db =  new database;
        if($db->conectar() == true){
            $sql = "SELECT *
                    FROM `tbl_trabajadores` 
                    WHERE estatusTrabajador='1'
                    AND
                    CONCAT_WS( ' ', TRIM(apaterno) , TRIM(amaterno) )  LIKE '%$matricula_buscar%'      
                    GROUP BY nombre ORDER BY puestoLaboral ASC
                    ";
            $result = @mysql_query($sql) or die(mysql_error());
            if(!$result){
                return false;
            }else{
                return $result;
            }
            
        }       
        
    }
    
    
         function ConTrabajadoresLlavePrimaria($pk_trabajador){
        $db =  new database;
        if($db->conectar() == true){
            $sql = "SELECT *
                    FROM `tbl_trabajadores` 
                    LEFT JOIN tbl_usuario_login ON tbl_usuario_login.Fk_trabajador=tbl_trabajadores.Pk_trabajador
                    WHERE estatusTrabajador='1'
                    AND
                    pk_trabajador='$pk_trabajador'
                    ";
            $result = @mysql_query($sql) or die(mysql_error());
            if(!$result){
                return false;
            }else{
                return $result;
            }
            
        }       
        
    }
    
    
    
     #AGREGADO: Ivan Mauricio Meneses Melo Granados
 #FECHA: 11/05/13 11:31 am 
 #MODULO AFECTADO: 
 #DESCRIPCION: colocamos el status del usuario a online
  function ConExisteTrabajadorUsuario($pk_trabajador) {
        $dbLuminarias = new database;
        if ($dbLuminarias->conectar() == true) {
            $query = "SELECT COUNT(*) as existe FROM tbl_usuario_login WHERE Fk_trabajador='$pk_trabajador'";
            $result = @mysql_query($query) or die(mysql_error());
            if (!$result)
                return false;
            else
                return $result;
        }
    }    



    
    //para la tabla de egresados
    //con todas la generaciones por carreras (lic hugo)
    function ConReporteAlumnosTituloExpedido($fk_nivelestudio, $fk_modalidad, $fk_carreras, $fechaInicio, $fechaFin){
        $db =  new database;
        if($db->conectar() == true){
            $sql = "SELECT 
                    cat_generacion.descripcion as DescripcionGeneracion,
                    cat_turnos.descripcion as DescripcionTurnos,
                    cat_opciontitulacion.Nombre as NombreOpcionTitulacion,
                    tbl_alumnos.generacionNumero,
                     DATE_FORMAT(fechaexpediciontitulo, '%d/%m/%Y') AS fechaexpediciontitulo,
                      CONCAT_WS( ' ', tbl_alumnos.apaterno , tbl_alumnos.amaterno , tbl_alumnos.nombre ) AS NombreCompleto,
                      cat_opciontitulacion.Nombre as NombreOpcionTitulacion, pk_titulacion, matricula,
                    tbl_alumnos.fk_generacion
                    FROM tbl_alumnos
                    
                    LEFT JOIN tbl_egresados ON tbl_egresados.fk_alumnos = tbl_alumnos.pk_alumno
                    LEFT JOIN tbl_exainstitucional ON tbl_exainstitucional.fk_alumno = tbl_alumnos.pk_alumno
                    LEFT JOIN tbl_resultadoexamen ON tbl_resultadoexamen.fk_alumno = tbl_alumnos.pk_alumno
                    LEFT JOIN tbl_tomadeprotesta ON tbl_tomadeprotesta.fk_alumno = tbl_alumnos.pk_alumno
                   
                    INNER JOIN tbl_carreras ON tbl_carreras.pk_carreras = tbl_alumnos.fk_carreras
                    INNER JOIN cat_turnos ON cat_turnos.pk_turnos = tbl_alumnos.fk_turnos
                    INNER JOIN cat_anios ON cat_anios.pk_anios = tbl_alumnos.PlanEstudios
                    INNER JOIN cat_generacion ON cat_generacion.pk_generacion = tbl_alumnos.fk_generacion
                    INNER JOIN cat_opciontitulacion ON cat_opciontitulacion.pk_titulacion=tbl_tomadeprotesta.fk_titulacion
                    WHERE 
                    tbl_alumnos.fk_nivelestudio = '$fk_nivelestudio' AND
                    tbl_alumnos.fk_modalidad = '$fk_modalidad' AND  
                    tbl_alumnos.fk_carreras = '$fk_carreras'  AND
                        fechaexpediciontitulo BETWEEN '" . $fechaInicio . "' and '" . $fechaFin . "'
                    ";
            $result = @mysql_query($sql) or die(mysql_error());
            if(!$result){
                return false;
            }else{
                return $result;
            }
            
        }       
        
    }
   
      //para la tabla de egresados
    //con todas la generaciones por carreras (lic hugo)
    function ConReporteAlumnosTituloExpedidoSoloTitulados($fk_nivelestudio, $fk_modalidad, $fk_carreras,/*$fk_generacion,*/ $fechaInicio, $fechaFin){
        $db =  new database;
        if($db->conectar() == true){
            $sql = "SELECT 
                    cat_generacion.descripcion as DescripcionGeneracion,
                    cat_turnos.descripcion as DescripcionTurnos,
                    cat_opciontitulacion.Nombre as NombreOpcionTitulacion,
                    tbl_alumnos.generacionNumero,
                     DATE_FORMAT(fechaexpediciontitulo, '%d/%m/%Y') AS fechaexpediciontitulo,
                      CONCAT_WS( ' ', tbl_alumnos.apaterno , tbl_alumnos.amaterno , tbl_alumnos.nombre ) AS NombreCompleto,
                      cat_opciontitulacion.Nombre as NombreOpcionTitulacion, pk_titulacion, matricula, tbl_alumnos.fk_genero,
                    tbl_alumnos.fk_generacion
                    FROM tbl_alumnos
                    
                    LEFT JOIN tbl_egresados ON tbl_egresados.fk_alumnos = tbl_alumnos.pk_alumno
                    LEFT JOIN tbl_exainstitucional ON tbl_exainstitucional.fk_alumno = tbl_alumnos.pk_alumno
                    LEFT JOIN tbl_resultadoexamen ON tbl_resultadoexamen.fk_alumno = tbl_alumnos.pk_alumno
                    LEFT JOIN tbl_tomadeprotesta ON tbl_tomadeprotesta.fk_alumno = tbl_alumnos.pk_alumno
                   
                    INNER JOIN tbl_carreras ON tbl_carreras.pk_carreras = tbl_alumnos.fk_carreras
                    INNER JOIN cat_turnos ON cat_turnos.pk_turnos = tbl_alumnos.fk_turnos
                    INNER JOIN cat_anios ON cat_anios.pk_anios = tbl_alumnos.PlanEstudios
                    INNER JOIN cat_generacion ON cat_generacion.pk_generacion = tbl_alumnos.fk_generacion
                    INNER JOIN cat_opciontitulacion ON cat_opciontitulacion.pk_titulacion=tbl_tomadeprotesta.fk_titulacion
                    WHERE 
                    tbl_alumnos.fk_nivelestudio = '$fk_nivelestudio' AND
                    tbl_alumnos.fk_modalidad = '$fk_modalidad' AND  
                    tbl_alumnos.fk_carreras = '$fk_carreras'  AND
                        tbl_tomadeprotesta.FechaTomaProtesta BETWEEN '" . $fechaInicio . "' and '" . $fechaFin . "' AND
                     fk_estadoTitulacion='1' 
                    ";
            $result = @mysql_query($sql) or die(mysql_error());
            if(!$result){
                return false;
            }else{
                return $result;
            }
            
        }       
        
    }



    
        function ConsultaCarrerasPorModalidad($fk_nivelestudio, $fk_modalidad){
        $db =  new database;
        if($db->conectar() == true){
            $sql = "SELECT * FROM tbl_carreras
INNER JOIN cat_modalidad ON cat_modalidad.pk_modalidad = tbl_carreras.fk_modalidad 
INNER JOIN cat_nivelestudio ON cat_nivelestudio.pk_nivelestudio = tbl_carreras.fk_nivelestudio AND estadoCarrera=1
AND fk_nivelestudio='$fk_nivelestudio' AND fk_modalidad='$fk_modalidad'";
            $result = @mysql_query($sql) or die(mysql_error());
            if(!$result){
                return false;
            }else{
                return $result;
            }
            
        }       
        
    }
    
    
    
    
    
    
    function ConGeneracionMasAltaPorCarrera($fk_nivelestudio, $fk_modalidad, $fk_carreras){
        $db =  new database;
        if($db->conectar() == true){
            $sql = "SELECT *
                    FROM tbl_alumnos
                    
                    LEFT JOIN tbl_egresados ON tbl_egresados.fk_alumnos = tbl_alumnos.pk_alumno
                    LEFT JOIN tbl_encuestamedicina ON tbl_encuestamedicina.fk_alumno = tbl_alumnos.pk_alumno
                    INNER JOIN cat_genero ON cat_genero.pk_genero = tbl_alumnos.fk_genero
                    INNER JOIN tbl_carreras ON tbl_carreras.pk_carreras = tbl_alumnos.fk_carreras
                    WHERE  tbl_carreras.fk_nivelestudio = '$fk_nivelestudio'
                    AND tbl_carreras.fk_modalidad = '$fk_modalidad'  AND pk_carreras='$fk_carreras'";
            $result = @mysql_query($sql) or die(mysql_error());
            if(!$result){
                return false;
            }else{
                return $result;
            }
            
        }       
        
    }
   
   
    
    
    
    
    function ConCantidadTotalAlumnosTramites($fk_nivelestudio, $fk_modalidad, $fk_carreras){
        $db =  new database;
        if($db->conectar() == true){
            $sql = "SELECT COUNT(*) as cantidadTotal 
                    FROM tbl_alumnos
                    
                    LEFT JOIN tbl_egresados ON tbl_egresados.fk_alumnos = tbl_alumnos.pk_alumno
                    LEFT JOIN tbl_encuestamedicina ON tbl_encuestamedicina.fk_alumno = tbl_alumnos.pk_alumno
                    INNER JOIN cat_genero ON cat_genero.pk_genero = tbl_alumnos.fk_genero
                    INNER JOIN tbl_carreras ON tbl_carreras.pk_carreras = tbl_alumnos.fk_carreras
                    WHERE  tbl_carreras.fk_nivelestudio = '$fk_nivelestudio'
                    AND tbl_carreras.fk_modalidad = '$fk_modalidad'  AND pk_carreras='$fk_carreras'";
            $result = @mysql_query($sql) or die(mysql_error());
            if(!$result){
                return false;
            }else{
                return $result;
            }
            
        }       
        
    }
   
    
    
    
    
    function ConCantidadTotalAlumnosEgresadosTit($fk_nivelestudio, $fk_modalidad, $fk_carreras){
        $db =  new database;
        if($db->conectar() == true){
            $sql = "SELECT COUNT(*) as cantidadTotalEgresados 
                    FROM tbl_alumnos
                    
                    LEFT JOIN tbl_egresados ON tbl_egresados.fk_alumnos = tbl_alumnos.pk_alumno
 LEFT JOIN tbl_encuestamedicina ON tbl_encuestamedicina.fk_alumno = tbl_alumnos.pk_alumno
                    INNER JOIN cat_genero ON cat_genero.pk_genero = tbl_alumnos.fk_genero
                    INNER JOIN tbl_carreras ON tbl_carreras.pk_carreras = tbl_alumnos.fk_carreras
                    WHERE  tbl_carreras.fk_nivelestudio = '$fk_nivelestudio'
                    AND tbl_carreras.fk_modalidad = '$fk_modalidad'  AND pk_carreras='$fk_carreras'
                    AND  fk_estadoTitulacion='1'";
            $result = @mysql_query($sql) or die(mysql_error());
            if(!$result){
                return false;
            }else{
                return $result;
            }
            
        }       
        
    }
   
    
    
      //informacion personal
    function ConReporteAlumnosInformacionBasica($fk_nivelestudio, $fk_modalidad, $fk_carreras, $fk_generacion){
        $db =  new database;
        if($db->conectar() == true){
            $sql = "SELECT
		    cat_genero.descripcion as DescripcionGenero, 
                    cat_generacion.descripcion as DescripcionGeneracion,
                    cat_turnos.descripcion as DescripcionTurnos,
                    cat_opciontitulacion.Nombre as NombreOpcionTitulacion,
                    tbl_alumnos.generacionNumero,
                     DATE_FORMAT(fechaexpediciontitulo, '%d/%m/%Y') AS fechaexpediciontitulo,
                      CONCAT_WS( ' ', tbl_alumnos.apaterno , tbl_alumnos.amaterno , tbl_alumnos.nombre ) AS NombreCompleto,
                      cat_opciontitulacion.Nombre as NombreOpcionTitulacion, pk_titulacion, matricula, tbl_alumnos.fk_genero,
                    tbl_alumnos.fk_generacion,
                    cat_colonia.descripcion as DescripcionColonia,
                    cat_municipios.descripcion as DescripcionMunicipio,
                    cat_estado.descripcion as DescripcionEstado, cod_postal,
                    tbl_alumnos.telefonocelular, tbl_alumnos.telefonofijo, tbl_alumnos.correo,tbl_alumnos.direccion,
                    cat_generacion.descripcion as DescripcionGeneracion,
                    mtriaNombre, mtriaInstitucion, doctoradoNombre, doctoradoInstitucion, especialidadNombre, especialidadInstitucion,
                    estatusTrabajo, correoTrabajo, FechaNacimiento, nombreJefeInmediato,
                    nombreEmpresaTrabajo, puestoTrabajo, direccionTrabajo, telefonoTrabajo, edadEgreso, promedio,
		    cat_anios.descripcion as DescripcionPlan	 

                    FROM tbl_alumnos
                    
                    LEFT JOIN tbl_egresados ON tbl_egresados.fk_alumnos = tbl_alumnos.pk_alumno
                    LEFT JOIN tbl_exainstitucional ON tbl_exainstitucional.fk_alumno = tbl_alumnos.pk_alumno
                    LEFT JOIN tbl_resultadoexamen ON tbl_resultadoexamen.fk_alumno = tbl_alumnos.pk_alumno
                    LEFT JOIN tbl_tomadeprotesta ON tbl_tomadeprotesta.fk_alumno = tbl_alumnos.pk_alumno
                   
                    LEFT JOIN cat_colonia ON cat_colonia.pk_colonia = tbl_alumnos.fk_colonia
                    LEFT JOIN cat_municipios ON cat_municipios.pk_ciudad = cat_colonia.fk_municipio
                    LEFT JOIN cat_estado ON cat_estado.pk_estado = cat_municipios.fk_estado
                    
		    LEFT JOIN cat_genero ON cat_genero.pk_genero = tbl_alumnos.fk_genero
                    INNER JOIN tbl_carreras ON tbl_carreras.pk_carreras = tbl_alumnos.fk_carreras
                    INNER JOIN cat_turnos ON cat_turnos.pk_turnos = tbl_alumnos.fk_turnos
                    LEFT JOIN cat_anios ON cat_anios.pk_anios = tbl_alumnos.PlanEstudios
                    LEFT JOIN cat_generacion ON cat_generacion.pk_generacion = tbl_alumnos.fk_generacion
                    LEFT JOIN cat_opciontitulacion ON cat_opciontitulacion.pk_titulacion=tbl_tomadeprotesta.fk_titulacion
                    
                    WHERE 
                    tbl_alumnos.fk_nivelestudio = '$fk_nivelestudio' AND
                    tbl_alumnos.fk_modalidad = '$fk_modalidad' AND  
                    tbl_alumnos.fk_carreras = '$fk_carreras' AND 
                    tbl_alumnos.fk_generacion='$fk_generacion'
                    order by apaterno
                    ";
            $result = @mysql_query($sql) or die(mysql_error());
            if(!$result){
                return false;
            }else{
                return $result;
            }
            
        }       
        
    }

 //informacion personal
    function ConReporteAlumnosInformacionBasicaExcel($fk_nivelestudio, $fk_modalidad, $fk_carreras){
        $db =  new database;
        if($db->conectar() == true){
            $sql = "SELECT 
                    cat_generacion.descripcion as DescripcionGeneracion,
                    cat_turnos.descripcion as DescripcionTurnos,
                    cat_opciontitulacion.Nombre as NombreOpcionTitulacion,
                    tbl_alumnos.generacionNumero,
                     DATE_FORMAT(fechaexpediciontitulo, '%d/%m/%Y') AS fechaexpediciontitulo,
                      CONCAT_WS( ' ', tbl_alumnos.apaterno , tbl_alumnos.amaterno , tbl_alumnos.nombre ) AS NombreCompleto,
                      cat_opciontitulacion.Nombre as NombreOpcionTitulacion, pk_titulacion, matricula, tbl_alumnos.fk_genero,
                    tbl_alumnos.fk_generacion,
                    cat_colonia.descripcion as DescripcionColonia,
                    cat_municipios.descripcion as DescripcionMunicipio,
                    cat_estado.descripcion as DescripcionEstado, cod_postal,
                    tbl_alumnos.telefonocelular, tbl_alumnos.telefonofijo, tbl_alumnos.correo,tbl_alumnos.direccion,
                    cat_generacion.descripcion as DescripcionGeneracion,
                    mtriaNombre, mtriaInstitucion, doctoradoNombre, doctoradoInstitucion, especialidadNombre, especialidadInstitucion,
                    estatusTrabajo, correoTrabajo, FechaNacimiento, nombreJefeInmediato,
                    nombreEmpresaTrabajo, puestoTrabajo, direccionTrabajo, telefonoTrabajo
                    FROM tbl_alumnos
                    
                    LEFT JOIN tbl_egresados ON tbl_egresados.fk_alumnos = tbl_alumnos.pk_alumno
                    LEFT JOIN tbl_exainstitucional ON tbl_exainstitucional.fk_alumno = tbl_alumnos.pk_alumno
                    LEFT JOIN tbl_resultadoexamen ON tbl_resultadoexamen.fk_alumno = tbl_alumnos.pk_alumno
                    LEFT JOIN tbl_tomadeprotesta ON tbl_tomadeprotesta.fk_alumno = tbl_alumnos.pk_alumno
                   
                    LEFT JOIN cat_colonia ON cat_colonia.pk_colonia = tbl_alumnos.fk_colonia
                    LEFT JOIN cat_municipios ON cat_municipios.pk_ciudad = cat_colonia.fk_municipio
                    LEFT JOIN cat_estado ON cat_estado.pk_estado = cat_municipios.fk_estado
                    
                    INNER JOIN tbl_carreras ON tbl_carreras.pk_carreras = tbl_alumnos.fk_carreras
                    INNER JOIN cat_turnos ON cat_turnos.pk_turnos = tbl_alumnos.fk_turnos
                    LEFT JOIN cat_anios ON cat_anios.pk_anios = tbl_alumnos.PlanEstudios
                    LEFT JOIN cat_generacion ON cat_generacion.pk_generacion = tbl_alumnos.fk_generacion
                    LEFT JOIN cat_opciontitulacion ON cat_opciontitulacion.pk_titulacion=tbl_tomadeprotesta.fk_titulacion
                    
                    WHERE 
                    tbl_alumnos.fk_nivelestudio = '$fk_nivelestudio' AND
                    tbl_alumnos.fk_modalidad = '$fk_modalidad' AND  
                    tbl_alumnos.fk_carreras = '$fk_carreras' 
                    order by apaterno
                    ";
            $result = @mysql_query($sql) or die(mysql_error());
            if(!$result){
                return false;
            }else{
                return $result;
            }
            
        }       
        
    }
    
    


     //para la tabla de egresados
    //con todas la generaciones por carreras (lic hugo)
    function ConReporteAlumnosTituladosPorGeneracion($fk_nivelestudio, $fk_modalidad, $fk_carreras, $fk_generacion){
        $db =  new database;
        if($db->conectar() == true){
            $sql = "SELECT 
                    cat_generacion.descripcion as DescripcionGeneracion,
                    cat_turnos.descripcion as DescripcionTurnos, fk_estadoTitulacion,
                     cat_generacion.descripcion as DescripcionGeneracion,
                    cat_opciontitulacion.Nombre as NombreOpcionTitulacion,
                    tbl_alumnos.generacionNumero,
                     DATE_FORMAT(fechaexpediciontitulo, '%d/%m/%Y') AS fechaexpediciontitulo,
                     DATE_FORMAT(FechaNacimiento, '%d/%m/%Y') AS FechaNacimiento,
                      CONCAT_WS( ' ', tbl_alumnos.apaterno , tbl_alumnos.amaterno , tbl_alumnos.nombre ) AS NombreCompleto,
                      cat_opciontitulacion.Nombre as NombreOpcionTitulacion, pk_titulacion, matricula, tbl_alumnos.fk_genero,
                    tbl_alumnos.fk_generacion,
                     tbl_alumnos.fk_generacion,
                    cat_colonia.descripcion as DescripcionColonia,
                    cat_municipios.descripcion as DescripcionMunicipio,
                    cat_estado.descripcion as DescripcionEstado, cod_postal,
                    tbl_alumnos.telefonocelular, tbl_alumnos.telefonofijo, tbl_alumnos.correo
                    FROM tbl_alumnos
                    
                    LEFT JOIN tbl_egresados ON tbl_egresados.fk_alumnos = tbl_alumnos.pk_alumno
                    LEFT JOIN tbl_exainstitucional ON tbl_exainstitucional.fk_alumno = tbl_alumnos.pk_alumno
                    LEFT JOIN tbl_resultadoexamen ON tbl_resultadoexamen.fk_alumno = tbl_alumnos.pk_alumno
                    LEFT JOIN tbl_tomadeprotesta ON tbl_tomadeprotesta.fk_alumno = tbl_alumnos.pk_alumno
                   
                   
  	            INNER JOIN cat_colonia ON cat_colonia.pk_colonia = tbl_alumnos.fk_colonia
                    INNER JOIN cat_municipios ON cat_municipios.pk_ciudad = cat_colonia.fk_municipio
                    INNER JOIN cat_estado ON cat_estado.pk_estado = cat_municipios.fk_estado

                    INNER JOIN tbl_carreras ON tbl_carreras.pk_carreras = tbl_alumnos.fk_carreras
                    INNER JOIN cat_turnos ON cat_turnos.pk_turnos = tbl_alumnos.fk_turnos
                    INNER JOIN cat_anios ON cat_anios.pk_anios = tbl_alumnos.PlanEstudios
                    INNER JOIN cat_generacion ON cat_generacion.pk_generacion = tbl_alumnos.fk_generacion
                    INNER JOIN cat_opciontitulacion ON cat_opciontitulacion.pk_titulacion=tbl_tomadeprotesta.fk_titulacion
                    WHERE 
                    tbl_alumnos.fk_nivelestudio = '$fk_nivelestudio' AND
                    tbl_alumnos.fk_modalidad = '$fk_modalidad' AND  
                    tbl_alumnos.fk_carreras = '$fk_carreras' AND 
                    tbl_alumnos.fk_generacion='$fk_generacion' AND
                   
                     fk_estadoTitulacion='1'
                      order by apaterno
                    ";
            $result = @mysql_query($sql) or die(mysql_error());
            if(!$result){
                return false;
            }else{
                return $result;
            }
            
        }       
        
    }
    
    
    
    
    
    
     //para la tabla de egresados
    //con todas la generaciones por carreras (lic hugo)
    function ConReporteAlumnosCredencialesTramitadasPorGeneracion($fk_nivelestudio, $fk_modalidad, $fk_carreras, $fk_generacion){
        $db =  new database;
        if($db->conectar() == true){
            $sql = "SELECT 
                    cat_generacion.descripcion as DescripcionGeneracion,
                    cat_turnos.descripcion as DescripcionTurnos, fk_estadoTitulacion,
                     cat_generacion.descripcion as DescripcionGeneracion,
                    cat_opciontitulacion.Nombre as NombreOpcionTitulacion,
                    tbl_alumnos.generacionNumero, fk_estadoTitulacion,
                     DATE_FORMAT(fechaexpediciontitulo, '%d/%m/%Y') AS fechaexpediciontitulo,
                     DATE_FORMAT(FechaNacimiento, '%d/%m/%Y') AS FechaNacimiento,
                      CONCAT_WS( ' ', tbl_alumnos.apaterno , tbl_alumnos.amaterno , tbl_alumnos.nombre ) AS NombreCompleto,
                      cat_opciontitulacion.Nombre as NombreOpcionTitulacion, pk_titulacion, matricula, tbl_alumnos.fk_genero,
                    tbl_alumnos.fk_generacion,
                    cat_colonia.descripcion as DescripcionColonia,
                    cat_municipios.descripcion as DescripcionMunicipio,
                    cat_estado.descripcion as DescripcionEstado, cod_postal,
                    tbl_alumnos.telefonocelular, tbl_alumnos.telefonofijo, tbl_alumnos.correo
                    FROM tbl_alumnos
                    
                    LEFT JOIN tbl_egresados ON tbl_egresados.fk_alumnos = tbl_alumnos.pk_alumno
                    LEFT JOIN tbl_exainstitucional ON tbl_exainstitucional.fk_alumno = tbl_alumnos.pk_alumno
                    LEFT JOIN tbl_resultadoexamen ON tbl_resultadoexamen.fk_alumno = tbl_alumnos.pk_alumno
                    LEFT JOIN tbl_tomadeprotesta ON tbl_tomadeprotesta.fk_alumno = tbl_alumnos.pk_alumno
                   
    INNER JOIN cat_colonia ON cat_colonia.pk_colonia = tbl_alumnos.fk_colonia
                    INNER JOIN cat_municipios ON cat_municipios.pk_ciudad = cat_colonia.fk_municipio
                    INNER JOIN cat_estado ON cat_estado.pk_estado = cat_municipios.fk_estado
                    

                    INNER JOIN tbl_carreras ON tbl_carreras.pk_carreras = tbl_alumnos.fk_carreras
                    INNER JOIN cat_turnos ON cat_turnos.pk_turnos = tbl_alumnos.fk_turnos
                    INNER JOIN cat_anios ON cat_anios.pk_anios = tbl_alumnos.PlanEstudios
                    INNER JOIN cat_generacion ON cat_generacion.pk_generacion = tbl_alumnos.fk_generacion
                    INNER JOIN cat_opciontitulacion ON cat_opciontitulacion.pk_titulacion=tbl_tomadeprotesta.fk_titulacion
                    WHERE 
                    tbl_alumnos.fk_nivelestudio = '$fk_nivelestudio' AND
                    tbl_alumnos.fk_modalidad = '$fk_modalidad' AND  
                    tbl_alumnos.fk_carreras = '$fk_carreras' AND 
                    tbl_alumnos.fk_generacion='$fk_generacion' AND 
                   tbl_egresados.estatusCredencial='1'     
                      order by apaterno
                    ";
            $result = @mysql_query($sql) or die(mysql_error());
            if(!$result){
                return false;
            }else{
                return $result;
            }
            
        }       
        
    }
    
    


      
    function ConCantidadAlumnosNooopTitulados($fk_nivelestudio, $fk_modalidad, $fk_carreras, $fk_generacion){
        $db =  new database;
        if($db->conectar() == true){
            $sql = "SELECT COUNT(*) as cantidadTotalNopTitulados, generacionNumero, 
                cat_generacion.descripcion as DescripcionGeneracion, fechaexpediciontitulo,FechaTomaProtesta
                    FROM tbl_alumnos
                    
                    INNER JOIN tbl_egresados ON tbl_egresados.fk_alumnos = tbl_alumnos.pk_alumno
                    LEFT JOIN tbl_tomadeprotesta ON tbl_tomadeprotesta.fk_alumno = tbl_alumnos.pk_alumno

                    INNER JOIN cat_genero ON cat_genero.pk_genero = tbl_alumnos.fk_genero
                    
                    INNER JOIN cat_colonia ON cat_colonia.pk_colonia = tbl_alumnos.fk_colonia
                    INNER JOIN cat_municipios ON cat_municipios.pk_ciudad = cat_colonia.fk_municipio
                    INNER JOIN cat_estado ON cat_estado.pk_estado = cat_municipios.fk_estado
                    
                    INNER JOIN tbl_carreras ON tbl_carreras.pk_carreras = tbl_alumnos.fk_carreras
                    INNER JOIN cat_turnos ON cat_turnos.pk_turnos = tbl_alumnos.fk_turnos
                    INNER JOIN cat_anios ON cat_anios.pk_anios = tbl_alumnos.PlanEstudios
                    INNER JOIN cat_generacion ON cat_generacion.pk_generacion = tbl_alumnos.fk_generacion
                    WHERE 
                    tbl_alumnos.fk_nivelestudio = '$fk_nivelestudio' AND
                    tbl_alumnos.fk_modalidad = '$fk_modalidad' AND  
                    tbl_alumnos.fk_carreras = '$fk_carreras' AND    
                    tbl_alumnos.fk_generacion = '$fk_generacion' AND 
                     tbl_egresados.fk_estadoTitulacion='2'";
            $result = @mysql_query($sql) or die(mysql_error());
            if(!$result){
                return false;
            }else{
                return $result;
            }
            
        }       
        
    }
   
    
    
    
    
    function ConCantidadAlumnosTituladosNoTituladosGrafica($fk_nivelestudio, $fk_modalidad, $fk_carreras, $fk_generacion){
        $db =  new database;
        if($db->conectar() == true){
            $sql = "SELECT COUNT(*) as cantidadTotal
                    FROM tbl_alumnos
                    
                    LEFT JOIN tbl_egresados ON tbl_egresados.fk_alumnos = tbl_alumnos.pk_alumno
                    LEFT JOIN tbl_exainstitucional ON tbl_exainstitucional.fk_alumno = tbl_alumnos.pk_alumno
                    LEFT JOIN tbl_resultadoexamen ON tbl_resultadoexamen.fk_alumno = tbl_alumnos.pk_alumno
                    LEFT JOIN tbl_tomadeprotesta ON tbl_tomadeprotesta.fk_alumno = tbl_alumnos.pk_alumno
                    

                    INNER JOIN cat_genero ON cat_genero.pk_genero = tbl_alumnos.fk_genero
                    
                    INNER JOIN cat_colonia ON cat_colonia.pk_colonia = tbl_alumnos.fk_colonia
                    INNER JOIN cat_municipios ON cat_municipios.pk_ciudad = cat_colonia.fk_municipio
                    INNER JOIN cat_estado ON cat_estado.pk_estado = cat_municipios.fk_estado
                    
                    INNER JOIN tbl_carreras ON tbl_carreras.pk_carreras = tbl_alumnos.fk_carreras
                    INNER JOIN cat_turnos ON cat_turnos.pk_turnos = tbl_alumnos.fk_turnos
                    INNER JOIN cat_anios ON cat_anios.pk_anios = tbl_alumnos.PlanEstudios
                    INNER JOIN cat_generacion ON cat_generacion.pk_generacion = tbl_alumnos.fk_generacion
                    WHERE 
                    tbl_alumnos.fk_nivelestudio = '$fk_nivelestudio' AND
                    tbl_alumnos.fk_modalidad = '$fk_modalidad' AND  
                    tbl_alumnos.fk_carreras = '$fk_carreras' AND    
                    tbl_alumnos.fk_generacion = '$fk_generacion' 
                     
                    ";
            $result = @mysql_query($sql) or die(mysql_error());
            if(!$result){
                return false;
            }else{
                return $result;
            }
            
        }       
        
    }
    
    
    
    
    function ConCantidadAlumnosTituladosGrafica($fk_nivelestudio, $fk_modalidad, $fk_carreras, $fk_generacion){
        $db =  new database;
        if($db->conectar() == true){
            $sql = "SELECT COUNT(*) as cantidadTotalEgresados, generacionNumero, 
                cat_generacion.descripcion as DescripcionGeneracion, fechaexpediciontitulo,FechaTomaProtesta
                    FROM tbl_alumnos
                    
                    INNER JOIN tbl_egresados ON tbl_egresados.fk_alumnos = tbl_alumnos.pk_alumno
                     LEFT JOIN tbl_tomadeprotesta ON tbl_tomadeprotesta.fk_alumno = tbl_alumnos.pk_alumno

                    INNER JOIN cat_genero ON cat_genero.pk_genero = tbl_alumnos.fk_genero
                    
                    INNER JOIN cat_colonia ON cat_colonia.pk_colonia = tbl_alumnos.fk_colonia
                    INNER JOIN cat_municipios ON cat_municipios.pk_ciudad = cat_colonia.fk_municipio
                    INNER JOIN cat_estado ON cat_estado.pk_estado = cat_municipios.fk_estado
                    
                    INNER JOIN tbl_carreras ON tbl_carreras.pk_carreras = tbl_alumnos.fk_carreras
                    INNER JOIN cat_turnos ON cat_turnos.pk_turnos = tbl_alumnos.fk_turnos
                    INNER JOIN cat_anios ON cat_anios.pk_anios = tbl_alumnos.PlanEstudios
                    INNER JOIN cat_generacion ON cat_generacion.pk_generacion = tbl_alumnos.fk_generacion
                    WHERE 
                    tbl_alumnos.fk_nivelestudio = '$fk_nivelestudio' AND
                    tbl_alumnos.fk_modalidad = '$fk_modalidad' AND  
                    tbl_alumnos.fk_carreras = '$fk_carreras' AND    
                    tbl_alumnos.fk_generacion = '$fk_generacion' AND 
                     tbl_egresados.fk_estadoTitulacion='1'";
            $result = @mysql_query($sql) or die(mysql_error());
            if(!$result){
                return false;
            }else{
                return $result;
            }
            
        }       
        
    }
    
    


function ConAlumnosporLlavePrimariaEncuestaMaestria($pk_alumno){
        $db =  new database;
        if($db->conectar() == true){
            $sql = "SELECT *, cat_generacion.descripcion as DescripcionGeneracion,
                    DATE_FORMAT(FechaNacimiento, '%d/%m/%Y') AS FechaNacimiento,
                    DATE_FORMAT(fechaexpediciontitulo, '%d/%m/%Y') AS fechaexpediciontitulo,
                     DATE_FORMAT(FechaTomaProtesta, '%d/%m/%Y') AS FechaTomaProtesta,
                    tbl_tomadeprotesta.observacion as TipoAcreditacion, tbl_tomadeprotesta.fk_titulacion,
                     tbl_tomadeprotesta.FolioActa,
                    CONCAT_WS( ' ', `apaterno` , `amaterno` , `nombre` ) AS NombreCompleto 
                    FROM tbl_alumnos
                    
                    LEFT JOIN tbl_egresados ON tbl_egresados.fk_alumnos = tbl_alumnos.pk_alumno
                    LEFT JOIN tbl_tomadeprotesta ON tbl_tomadeprotesta.fk_alumno = tbl_alumnos.pk_alumno
                    LEFT JOIN tbl_encuestamaestria ON tbl_encuestamaestria.fk_alumno = tbl_alumnos.pk_alumno
                    INNER JOIN cat_genero ON cat_genero.pk_genero = tbl_alumnos.fk_genero
                    
                    INNER JOIN cat_colonia ON cat_colonia.pk_colonia = tbl_alumnos.fk_colonia
                    INNER JOIN cat_municipios ON cat_municipios.pk_ciudad = cat_colonia.fk_municipio
                    INNER JOIN cat_estado ON cat_estado.pk_estado = cat_municipios.fk_estado
                    
                    INNER JOIN tbl_carreras ON tbl_carreras.pk_carreras = tbl_alumnos.fk_carreras
                    INNER JOIN cat_turnos ON cat_turnos.pk_turnos = tbl_alumnos.fk_turnos
                    INNER JOIN cat_anios ON cat_anios.pk_anios = tbl_alumnos.PlanEstudios
                    INNER JOIN cat_generacion ON cat_generacion.pk_generacion = tbl_alumnos.fk_generacion
                    WHERE pk_alumno = '$pk_alumno'";
            $result = @mysql_query($sql) or die(mysql_error());
            if(!$result){
                return false;
            }else{
                return $result;
            }
            
        }       
        
    }




 
function ConAlumnosporLlavePrimariaEncuestaDoctorado($pk_alumno){
        $db =  new database;
        if($db->conectar() == true){
            $sql = "SELECT *, cat_generacion.descripcion as DescripcionGeneracion,
                    DATE_FORMAT(FechaNacimiento, '%d/%m/%Y') AS FechaNacimiento,
                    DATE_FORMAT(fechaexpediciontitulo, '%d/%m/%Y') AS fechaexpediciontitulo,
                     DATE_FORMAT(FechaTomaProtesta, '%d/%m/%Y') AS FechaTomaProtesta,
                    tbl_tomadeprotesta.observacion as TipoAcreditacion, tbl_tomadeprotesta.fk_titulacion,
                     tbl_tomadeprotesta.FolioActa,
                    CONCAT_WS( ' ', `apaterno` , `amaterno` , `nombre` ) AS NombreCompleto 
                    FROM tbl_alumnos
                    
                    LEFT JOIN tbl_egresados ON tbl_egresados.fk_alumnos = tbl_alumnos.pk_alumno
                    LEFT JOIN tbl_tomadeprotesta ON tbl_tomadeprotesta.fk_alumno = tbl_alumnos.pk_alumno
                    LEFT JOIN tbl_encuestadoctorado ON tbl_encuestadoctorado.fk_alumno = tbl_alumnos.pk_alumno
                    INNER JOIN cat_genero ON cat_genero.pk_genero = tbl_alumnos.fk_genero
                    
                    INNER JOIN cat_colonia ON cat_colonia.pk_colonia = tbl_alumnos.fk_colonia
                    INNER JOIN cat_municipios ON cat_municipios.pk_ciudad = cat_colonia.fk_municipio
                    INNER JOIN cat_estado ON cat_estado.pk_estado = cat_municipios.fk_estado
                    
                    INNER JOIN tbl_carreras ON tbl_carreras.pk_carreras = tbl_alumnos.fk_carreras
                    INNER JOIN cat_turnos ON cat_turnos.pk_turnos = tbl_alumnos.fk_turnos
                    INNER JOIN cat_anios ON cat_anios.pk_anios = tbl_alumnos.PlanEstudios
                    INNER JOIN cat_generacion ON cat_generacion.pk_generacion = tbl_alumnos.fk_generacion
                    WHERE pk_alumno = '$pk_alumno'";
            $result = @mysql_query($sql) or die(mysql_error());
            if(!$result){
                return false;
            }else{
                return $result;
            }
            
        }       
        
    }




#AGREGADO: Anibal Lopez Martinez
 #FECHA: 01/10/14 11:26 am 
 #MODULO AFECTADO: 
 #DESCRIPCION: Primer Boton Reportes de Medicina
     function ConReporteAlumnosEncuentaMedicina($pk_alumno){
		  $db =  new database;
        if($db->conectar() == true){
            $sql = "SELECT *,cat_colonia.descripcion as DescripcionColonia,
                    cat_municipios.descripcion as DescripcionMunicipio,
                    cat_estado.descripcion as DescripcionEstado, cod_postal,
                    tbl_alumnos.telefonocelular, tbl_alumnos.telefonofijo, tbl_alumnos.correo,
					cat_genero.descripcion as DescripcionGenero, 
					
					
					cat_encuesta_calif.descripcion_encuesta_calif as Calif_basica, 
										
					aniosInicio.descripcion as DescripcioInicio,
					aniosFin.descripcion as DescripcionFin, 
					
					DATE_FORMAT(FechaNacimiento, '%d/%m/%Y') AS FechaNacimiento,
                    			DATE_FORMAT(CertificacionProfesionalFecha, '%d/%m/%Y') AS CertificacionProfesionalFecha,
                    					
					CONCAT_WS( ' ', `apaterno` , `amaterno` , `nombre` ) AS NombreCompleto
					 
					FROM tbl_alumnos
                    
					INNER JOIN tbl_encuestamedicina ON tbl_encuestamedicina.fk_alumno = tbl_alumnos.pk_alumno
					INNER JOIN cat_genero ON cat_genero.pk_genero = tbl_alumnos.fk_genero
					
					INNER JOIN cat_colonia ON cat_colonia.pk_colonia = tbl_alumnos.fk_colonia
                    INNER JOIN cat_municipios ON cat_municipios.pk_ciudad = cat_colonia.fk_municipio
                    INNER JOIN cat_estado ON cat_estado.pk_estado = cat_municipios.fk_estado
					
                   	INNER JOIN cat_estadocivil ON cat_estadocivil.Pk_estadocivil = tbl_encuestamedicina.fk_estadocivil
					LEFT JOIN cat_aspectodebilidad ON cat_aspectodebilidad.pk_aspectodebilidad = tbl_encuestamedicina.fk_aspectodebilidad

            		INNER JOIN cat_puestosmedicina ON cat_puestosmedicina.pk_puestosmedicina = tbl_encuestamedicina.fk_puestosmedicina
           			INNER JOIN cat_ingresoactual ON cat_ingresoactual.pk_ingresoactual = tbl_encuestamedicina.fk_ingresoactual
					
           			INNER JOIN cat_encuesta_calif ON cat_encuesta_calif.pk_encuesta_calif = tbl_encuestamedicina.GradoCienciasBasicas
					INNER JOIN cat_gradosatisfaccion ON cat_gradosatisfaccion.pk_gradosatisfaccion = tbl_encuestamedicina.fk_gradosatisfaccion

					INNER JOIN cat_estudiosposgrado ON cat_estudiosposgrado.pk_estudiosposgrado= tbl_encuestamedicina.fk_estudiosposgrado
					INNER JOIN cat_ramaposgrado ON cat_ramaposgrado.pk_ramaposgrado= tbl_encuestamedicina.fk_ramaposgrado

					INNER JOIN cat_anios as aniosInicio ON aniosInicio.pk_anios = tbl_encuestamedicina.AnoInicioLicenciatura
					INNER JOIN cat_anios as aniosFin ON aniosFin.pk_anios = tbl_encuestamedicina.AnoFinLicenciatura

					


					order by apaterno
                    ";        $result = @mysql_query($sql) or die(mysql_error());
            if(!$result){
                return false;
            }else{
                return $result;
       
            }
            
        }       
        
    }

//********************************BOTONES VERDES DE EGRESADOS******************************************//


 #AGREGADO: Anibal Lopez Martinez
 #FECHA: 30/04/2015 6:48 pm 
 #MODULO AFECTADO: REPORTES EGRESADOS
 #DESCRIPCION: BOTON REPORTES EGRESADOS EDAD

     function ConCantidadEgresados($fk_nivelestudio,$fk_modalidad,$fk_carreras,$fk_genereacion){
        $db =  new database;
        if($db->conectar() == true){
            $sql = "SELECT COUNT(*) as cantidadTotalEgresados, cat_generacion.descripcion as DescripcionGeneracion

                    FROM tbl_alumnos
                    
                    INNER JOIN tbl_egresados ON tbl_egresados.fk_alumnos = tbl_alumnos.pk_alumno
                    INNER JOIN tbl_carreras ON tbl_carreras.pk_carreras = tbl_alumnos.fk_carreras
                    INNER JOIN cat_generacion ON cat_generacion.pk_generacion = tbl_alumnos.fk_generacion

WHERE 
                    tbl_alumnos.fk_nivelestudio = '$fk_nivelestudio' AND
                    tbl_alumnos.fk_modalidad = '$fk_modalidad' AND  
                    tbl_alumnos.fk_carreras = '$fk_carreras' AND tbl_alumnos.fk_generacion = '$fk_genereacion'   
";
            $result = @mysql_query($sql) or die(mysql_error());
            if(!$result){
                return false;
            }else{
                return $result;
            }
            
        }       
        
    }
    #AGREGADO: Anibal Lopez Martinez
 #FECHA: 30/04/2015 6:48 pm 
 #MODULO AFECTADO: REPORTES EGRESADOS
 #DESCRIPCION: BOTON REPORTES EGRESADOS EDAD

     function ConCantidadEgresadosHombres($fk_nivelestudio,$fk_modalidad,$fk_carreras,$fk_generacion){
        $db =  new database;
        if($db->conectar() == true){
            $sql = "SELECT COUNT(*) as cantidadTotalEgresadosHombres
                    FROM tbl_alumnos
                    
                    INNER JOIN tbl_egresados ON tbl_egresados.fk_alumnos = tbl_alumnos.pk_alumno
                    INNER JOIN cat_genero ON cat_genero.pk_genero = tbl_alumnos.fk_genero
                    INNER JOIN tbl_carreras ON tbl_carreras.pk_carreras = tbl_alumnos.fk_carreras

                    
                    WHERE                     
                    tbl_alumnos.fk_nivelestudio = '$fk_nivelestudio' AND
                    tbl_alumnos.fk_modalidad = '$fk_modalidad' AND  
                    tbl_alumnos.fk_carreras = '$fk_carreras' AND tbl_alumnos.fk_generacion = '$fk_generacion' AND tbl_alumnos.fk_genero = '1'";
            $result = @mysql_query($sql) or die(mysql_error());
            if(!$result){
                return false;
            }else{
                return $result;
            }
            
        }       
        
    }
    
 #AGREGADO: Anibal Lopez Martinez
 #FECHA: 30/04/2015 6:48 pm 
 #MODULO AFECTADO: REPORTES EGRESADOS
 #DESCRIPCION: BOTON REPORTES EGRESADOS EDAD

     function ConCantidadEgresadosMujeres($fk_nivelestudio,$fk_modalidad,$fk_carreras,$fk_generacion){
        $db =  new database;
        if($db->conectar() == true){
            $sql = "SELECT COUNT(*) as cantidadTotalEgresadosMujeres
                    FROM tbl_alumnos
                    
                    INNER JOIN tbl_egresados ON tbl_egresados.fk_alumnos = tbl_alumnos.pk_alumno
                    INNER JOIN cat_genero ON cat_genero.pk_genero = tbl_alumnos.fk_genero
                    INNER JOIN tbl_carreras ON tbl_carreras.pk_carreras = tbl_alumnos.fk_carreras

                    
                    WHERE                     
					tbl_alumnos.fk_nivelestudio = '$fk_nivelestudio' AND
                    tbl_alumnos.fk_modalidad = '$fk_modalidad' AND  
                    tbl_alumnos.fk_carreras = '$fk_carreras' AND 
					tbl_alumnos.fk_generacion = '$fk_generacion' AND  
					tbl_alumnos.fk_genero = '2'";
            $result = @mysql_query($sql) or die(mysql_error());
            if(!$result){
                return false;
            }else{
                return $result;
            }
            
        }       
        
    }   
    
         #AGREGADO: Anibal Lopez Martinez
 #FECHA: 30/04/2015 6:48 pm 
 #MODULO AFECTADO: REPORTES EGRESADOS
 #DESCRIPCION: BOTON REPORTES EGRESADOS EDAD

     function ConCantidadEgresadosDiecinueve($fk_nivelestudio,$fk_modalidad,$fk_carreras,$fk_generacion){
        $db =  new database;
        if($db->conectar() == true){
            $sql = "SELECT COUNT(*) as cantidadTotalEgresadosDiecinueve
                    FROM tbl_alumnos
                    
                    INNER JOIN tbl_egresados ON tbl_egresados.fk_alumnos = tbl_alumnos.pk_alumno
                    INNER JOIN tbl_carreras ON tbl_carreras.pk_carreras = tbl_alumnos.fk_carreras

                    
                    WHERE                     
                    tbl_alumnos.fk_nivelestudio = '$fk_nivelestudio' AND
                    tbl_alumnos.fk_modalidad = '$fk_modalidad' AND  
                    tbl_alumnos.fk_carreras = '$fk_carreras'  AND tbl_alumnos.fk_generacion = '$fk_generacion' AND
                    tbl_egresados.edadEgreso BETWEEN '0' AND '19' ";
            
            $result = @mysql_query($sql) or die(mysql_error());
            if(!$result){
                return false;
            }else{
                return $result;
            }
            
        }       
        
    }   
    
    
 #AGREGADO: Anibal Lopez Martinez
 #FECHA: 30/04/2015 6:48 pm 
 #MODULO AFECTADO: REPORTES EGRESADOS
 #DESCRIPCION: BOTON REPORTES EGRESADOS EDAD

     function ConCantidadEgresadosVeinte($fk_nivelestudio,$fk_modalidad,$fk_carreras,$fk_generacion){
        $db =  new database;
        if($db->conectar() == true){
            $sql = "SELECT COUNT(*) as cantidadTotalEgresadosVeinte
                    FROM tbl_alumnos
                    
                    INNER JOIN tbl_egresados ON tbl_egresados.fk_alumnos = tbl_alumnos.pk_alumno
                    INNER JOIN tbl_carreras ON tbl_carreras.pk_carreras = tbl_alumnos.fk_carreras

                    
                    WHERE                     
                    tbl_alumnos.fk_nivelestudio = '$fk_nivelestudio' AND
                    tbl_alumnos.fk_modalidad = '$fk_modalidad' AND  
                    tbl_alumnos.fk_carreras = '$fk_carreras'AND  
                    tbl_alumnos.fk_generacion = '$fk_generacion'  AND
                    tbl_egresados.edadEgreso BETWEEN '20' AND '24' ";
            
            $result = @mysql_query($sql) or die(mysql_error());
            if(!$result){
                return false;
            }else{
                return $result;
            }
            
        }       
        
    }
    
    #AGREGADO: Anibal Lopez Martinez
 #FECHA: 30/04/2015 6:48 pm 
 #MODULO AFECTADO: REPORTES EGRESADOS
 #DESCRIPCION: BOTON REPORTES EGRESADOS EDAD

     function ConCantidadEgresadosVeinticinco($fk_nivelestudio,$fk_modalidad,$fk_carreras,$fk_generacion){
        $db =  new database;
        if($db->conectar() == true){
            $sql = "SELECT COUNT(*) as cantidadTotalEgresadosVeinticinco
                    FROM tbl_alumnos
                    
                    INNER JOIN tbl_egresados ON tbl_egresados.fk_alumnos = tbl_alumnos.pk_alumno
                    INNER JOIN tbl_carreras ON tbl_carreras.pk_carreras = tbl_alumnos.fk_carreras

                    
                    WHERE                     
                    tbl_alumnos.fk_nivelestudio = '$fk_nivelestudio' AND
                    tbl_alumnos.fk_modalidad = '$fk_modalidad' AND  
                    tbl_alumnos.fk_carreras = '$fk_carreras' AND  
                    tbl_alumnos.fk_generacion = '$fk_generacion'  AND
                    tbl_egresados.edadEgreso BETWEEN '25' AND '29' ";
            
            $result = @mysql_query($sql) or die(mysql_error());
            if(!$result){
                return false;
            }else{
                return $result;
            }
            
        }       
        
    } 
    
        #AGREGADO: Anibal Lopez Martinez
 #FECHA: 30/04/2015 6:48 pm 
 #MODULO AFECTADO: REPORTES EGRESADOS
 #DESCRIPCION: BOTON REPORTES EGRESADOS EDAD

     function ConCantidadEgresadosTreinta($fk_nivelestudio,$fk_modalidad,$fk_carreras,$fk_generacion){
        $db =  new database;
        if($db->conectar() == true){
            $sql = "SELECT COUNT(*) as cantidadTotalEgresadosTreinta
                    FROM tbl_alumnos
                    
                    INNER JOIN tbl_egresados ON tbl_egresados.fk_alumnos = tbl_alumnos.pk_alumno
                    INNER JOIN tbl_carreras ON tbl_carreras.pk_carreras = tbl_alumnos.fk_carreras

                    
                    WHERE                     
                    tbl_alumnos.fk_nivelestudio = '$fk_nivelestudio' AND
                    tbl_alumnos.fk_modalidad = '$fk_modalidad' AND  
                    tbl_alumnos.fk_carreras = '$fk_carreras' AND  
                    tbl_alumnos.fk_generacion = '$fk_generacion'  AND
                    tbl_egresados.edadEgreso BETWEEN '30' AND '100' ";
            
            $result = @mysql_query($sql) or die(mysql_error());
            if(!$result){
                return false;
            }else{
                return $result;
            }
            
        }       
        
    } 

function ConCantidadEgresadosDiscapacidad($fk_nivelestudio,$fk_modalidad,$fk_carreras,$fk_generacion){
        $db =  new database;
        if($db->conectar() == true){
            $sql = "SELECT COUNT(*) as ConCantidadEgresadosDiscapacidad
                    FROM tbl_alumnos
                    
                    INNER JOIN tbl_egresados ON tbl_egresados.fk_alumnos = tbl_alumnos.pk_alumno
                    INNER JOIN tbl_carreras ON tbl_carreras.pk_carreras = tbl_alumnos.fk_carreras

                    
                    WHERE                     
                    tbl_alumnos.fk_nivelestudio = '$fk_nivelestudio' AND
                    tbl_alumnos.fk_modalidad = '$fk_modalidad' AND  
                    tbl_alumnos.fk_carreras = '$fk_carreras' AND  
                    tbl_alumnos.fk_generacion = '$fk_generacion'  AND
                    tbl_egresados.Discapacidad='1' ";
            
            $result = @mysql_query($sql) or die(mysql_error());
            if(!$result){
                return false;
            }else{
                return $result;
            }
            
        }       
        
    } 
    
    #AGREGADO: Anibal Lopez Martinez
 #FECHA: 04/05/2015 6:26 pm 
 #MODULO AFECTADO: REPORTES EGRESADOS
 #DESCRIPCION: BOTON REPORTES GENERACIÓN PROMEDIO

     function PromedioEgresados($fk_nivelestudio,$fk_modalidad,$fk_carreras,$fk_generacion){
        $db =  new database;
        if($db->conectar() == true){
            $sql = "SELECT AVG(promedio) as Promedio, cat_generacion.descripcion as DescripcionGeneracion 
                    FROM tbl_alumnos
                    
                    INNER JOIN tbl_egresados ON tbl_egresados.fk_alumnos = tbl_alumnos.pk_alumno
                    INNER JOIN tbl_carreras ON tbl_carreras.pk_carreras = tbl_alumnos.fk_carreras
                    INNER JOIN cat_generacion ON cat_generacion.pk_generacion = tbl_alumnos.fk_generacion

WHERE 
                    tbl_alumnos.fk_nivelestudio = '$fk_nivelestudio' AND
                    tbl_alumnos.fk_modalidad = '$fk_modalidad' AND  
                    tbl_alumnos.fk_carreras = '$fk_carreras' AND
                    tbl_alumnos.fk_generacion = '$fk_generacion'";
            
            $result = @mysql_query($sql) or die(mysql_error());
            if(!$result){
                return false;
            }else{
                return $result;
            }
            
        }       
        
    } 
    
        #AGREGADO: Anibal Lopez Martinez
 #FECHA: 04/05/2015 6:56 pm 
 #MODULO AFECTADO: REPORTES EGRESADOS
 #DESCRIPCION: BOTON REPORTES GENERACIÓN PROMEDIO

     function PromedioEgresadosHombres($fk_nivelestudio,$fk_modalidad,$fk_carreras,$fk_generacion){
        $db =  new database;
        if($db->conectar() == true){
            $sql = "SELECT  AVG(promedio) as promedioTotalEgresadosHombres
                    FROM tbl_alumnos
                    
                    INNER JOIN tbl_egresados ON tbl_egresados.fk_alumnos = tbl_alumnos.pk_alumno
                    INNER JOIN cat_genero ON cat_genero.pk_genero = tbl_alumnos.fk_genero
                    INNER JOIN tbl_carreras ON tbl_carreras.pk_carreras = tbl_alumnos.fk_carreras

                    
                    WHERE                     
                    tbl_alumnos.fk_nivelestudio = '$fk_nivelestudio' AND
                    tbl_alumnos.fk_modalidad = '$fk_modalidad' AND  
                    tbl_alumnos.fk_carreras = '$fk_carreras' AND 
					tbl_alumnos.fk_generacion = '$fk_generacion' AND 
					tbl_alumnos.fk_genero = '1'";
            
            $result = @mysql_query($sql) or die(mysql_error());
            if(!$result){
                return false;
            }else{
                return $result;
            }
            
        }       
        
    } 
    
    
 #AGREGADO: Anibal Lopez Martinez
 #FECHA: 04/05/2015 6:56 pm 
 #MODULO AFECTADO: REPORTES EGRESADOS
 #DESCRIPCION: BOTON REPORTES GENERACIÓN PROMEDIO

     function PromedioEgresadosMujeres($fk_nivelestudio,$fk_modalidad,$fk_carreras,$fk_generacion){
        $db =  new database;
        if($db->conectar() == true){
            $sql = "SELECT  AVG(promedio) as promedioTotalEgresadosMujeres
                    FROM tbl_alumnos
                    
                    INNER JOIN tbl_egresados ON tbl_egresados.fk_alumnos = tbl_alumnos.pk_alumno
                    INNER JOIN cat_genero ON cat_genero.pk_genero = tbl_alumnos.fk_genero
                    INNER JOIN tbl_carreras ON tbl_carreras.pk_carreras = tbl_alumnos.fk_carreras

                    
                    WHERE                     
                    tbl_alumnos.fk_nivelestudio = '$fk_nivelestudio' AND
                    tbl_alumnos.fk_modalidad = '$fk_modalidad' AND  
                    tbl_alumnos.fk_carreras = '$fk_carreras' AND 
                    tbl_alumnos.fk_generacion = '$fk_generacion' AND
                    tbl_alumnos.fk_genero = '2'";
            
            $result = @mysql_query($sql) or die(mysql_error());
            if(!$result){
                return false;
            }else{
                return $result;
            }
            
        }       
        
    } 
    
    #AGREGADO: Anibal Lopez Martinez
 #FECHA: 30/04/2015 6:48 pm 
 #MODULO AFECTADO: REPORTES EGRESADOS
 #DESCRIPCION: BOTON REPORTES EGRESADOS PROMEDIO

     function PromedioEgresadosDiecinueve($fk_nivelestudio,$fk_modalidad,$fk_carreras,$fk_generacion){
        $db =  new database;
        if($db->conectar() == true){
            $sql = "SELECT  AVG(promedio) as promedioTotalEgresadosDiecinueve
                    FROM tbl_alumnos
                    
                    INNER JOIN tbl_egresados ON tbl_egresados.fk_alumnos = tbl_alumnos.pk_alumno
                    INNER JOIN tbl_carreras ON tbl_carreras.pk_carreras = tbl_alumnos.fk_carreras

                    
                    WHERE                     
                    tbl_alumnos.fk_nivelestudio = '$fk_nivelestudio' AND
                    tbl_alumnos.fk_modalidad = '$fk_modalidad' AND  
                    tbl_alumnos.fk_carreras = '$fk_carreras'  AND tbl_alumnos.fk_generacion = '$fk_generacion' AND
                    tbl_egresados.edadEgreso BETWEEN '0' AND '19' ";            
            $result = @mysql_query($sql) or die(mysql_error());
            if(!$result){
                return false;
            }else{
                return $result;
            }
            
        }       
        
    }   
    
    
 #AGREGADO: Anibal Lopez Martinez
 #FECHA: 30/04/2015 6:48 pm 
 #MODULO AFECTADO: REPORTES EGRESADOS
 #DESCRIPCION: BOTON REPORTES EGRESADOS PROMEDIO

     function PromedioEgresadosVeinte($fk_nivelestudio,$fk_modalidad,$fk_carreras,$fk_generacion){
        $db =  new database;
        if($db->conectar() == true){
            $sql = "SELECT  AVG(promedio) as promedioTotalEgresadosVeinte
                    FROM tbl_alumnos
                    
                    INNER JOIN tbl_egresados ON tbl_egresados.fk_alumnos = tbl_alumnos.pk_alumno
                    INNER JOIN tbl_carreras ON tbl_carreras.pk_carreras = tbl_alumnos.fk_carreras

                    
                    WHERE                     
                    tbl_alumnos.fk_nivelestudio = '$fk_nivelestudio' AND
                    tbl_alumnos.fk_modalidad = '$fk_modalidad' AND  
                    tbl_alumnos.fk_carreras = '$fk_carreras'AND  
                    tbl_alumnos.fk_generacion = '$fk_generacion'  AND
                    tbl_egresados.edadEgreso BETWEEN '20' AND '24' ";
            
            $result = @mysql_query($sql) or die(mysql_error());
            if(!$result){
                return false;
            }else{
                return $result;
            }
            
        }       
        
    }
    
    #AGREGADO: Anibal Lopez Martinez
 #FECHA: 30/04/2015 6:48 pm 
 #MODULO AFECTADO: REPORTES EGRESADOS
 #DESCRIPCION: BOTON REPORTES EGRESADOS PROMEDIO

     function PromedioEgresadosVeinticinco($fk_nivelestudio,$fk_modalidad,$fk_carreras,$fk_generacion){
        $db =  new database;
        if($db->conectar() == true){
            $sql = "SELECT  AVG(promedio) as promedioTotalEgresadosVeinticinco
                    FROM tbl_alumnos
                    
                    INNER JOIN tbl_egresados ON tbl_egresados.fk_alumnos = tbl_alumnos.pk_alumno
                    INNER JOIN tbl_carreras ON tbl_carreras.pk_carreras = tbl_alumnos.fk_carreras

                    
                    WHERE                     
                    tbl_alumnos.fk_nivelestudio = '$fk_nivelestudio' AND
                    tbl_alumnos.fk_modalidad = '$fk_modalidad' AND  
                    tbl_alumnos.fk_carreras = '$fk_carreras' AND  
                    tbl_alumnos.fk_generacion = '$fk_generacion'  AND
                    tbl_egresados.edadEgreso BETWEEN '25' AND '29' ";
            
            $result = @mysql_query($sql) or die(mysql_error());
            if(!$result){
                return false;
            }else{
                return $result;
            }
            
        }       
        
    } 
    
        #AGREGADO: Anibal Lopez Martinez
 #FECHA: 30/04/2015 6:48 pm 
 #MODULO AFECTADO: REPORTES EGRESADOS
 #DESCRIPCION: BOTON REPORTES EGRESADOS PROMEDIO

     function PromedioEgresadosTreinta($fk_nivelestudio,$fk_modalidad,$fk_carreras,$fk_generacion){
        $db =  new database;
        if($db->conectar() == true){
            $sql = "SELECT AVG(promedio) as promedioTotalEgresadosTreinta
                    FROM tbl_alumnos
                    
                    INNER JOIN tbl_egresados ON tbl_egresados.fk_alumnos = tbl_alumnos.pk_alumno
                    INNER JOIN tbl_carreras ON tbl_carreras.pk_carreras = tbl_alumnos.fk_carreras

                    
                    WHERE                     
                    tbl_alumnos.fk_nivelestudio = '$fk_nivelestudio' AND
                    tbl_alumnos.fk_modalidad = '$fk_modalidad' AND  
                    tbl_alumnos.fk_carreras = '$fk_carreras' AND  
                    tbl_alumnos.fk_generacion = '$fk_generacion'  AND
                    tbl_egresados.edadEgreso BETWEEN '30' AND '100' ";
            
            $result = @mysql_query($sql) or die(mysql_error());
            if(!$result){
                return false;
            }else{
                return $result;
            }
            
        }       
        
    }


 function PromedioEgresadosDiscapacidad($fk_nivelestudio,$fk_modalidad,$fk_carreras,$fk_generacion){
        $db =  new database;
        if($db->conectar() == true){
            $sql = "SELECT AVG(promedio) as PromedioEgresadosDiscapacidad
                    FROM tbl_alumnos
                    
                    INNER JOIN tbl_egresados ON tbl_egresados.fk_alumnos = tbl_alumnos.pk_alumno
                    INNER JOIN tbl_carreras ON tbl_carreras.pk_carreras = tbl_alumnos.fk_carreras

                    
                    WHERE                     
                    tbl_alumnos.fk_nivelestudio = '$fk_nivelestudio' AND
                    tbl_alumnos.fk_modalidad = '$fk_modalidad' AND  
                    tbl_alumnos.fk_carreras = '$fk_carreras' AND  
                    tbl_alumnos.fk_generacion = '$fk_generacion'  AND
                    tbl_egresados.Discapacidad ='1'";
            
            $result = @mysql_query($sql) or die(mysql_error());
            if(!$result){
                return false;
            }else{
                return $result;
            }
            
        }       
        
    }



#AGREGADO: Anibal Lopez Martinez
#FECHA: 24/09/2015 7:23 pm 
#MODULO AFECTADO: REPORTES EGRESADOS
#DESCRIPCION: BOTON REPORTES TITULADOS POR EDAD

     function ConCantidadEgresadosTituladosHombres($fk_nivelestudio,$fk_modalidad,$fk_carreras,$fk_generacion){
        $db =  new database;
        if($db->conectar() == true){
            $sql = "SELECT COUNT(*) as cantidadTotalTituladosHombres
                    FROM tbl_alumnos
                    
                    INNER JOIN tbl_egresados ON tbl_egresados.fk_alumnos = tbl_alumnos.pk_alumno
                    INNER JOIN cat_genero ON cat_genero.pk_genero = tbl_alumnos.fk_genero
                    INNER JOIN tbl_carreras ON tbl_carreras.pk_carreras = tbl_alumnos.fk_carreras

                    
                    WHERE                     
                    tbl_alumnos.fk_nivelestudio = '$fk_nivelestudio' AND
                    tbl_alumnos.fk_modalidad = '$fk_modalidad' AND  
                    tbl_alumnos.fk_carreras = '$fk_carreras' AND 
                    tbl_alumnos.fk_generacion = '$fk_generacion' AND  
                    tbl_alumnos.fk_genero = '1' AND
                    tbl_egresados.fk_estadoTitulacion = '1'";
            $result = @mysql_query($sql) or die(mysql_error());
            if(!$result){
                return false;
            }else{
                return $result;
            }
            
        }       
        
    } 

#AGREGADO: Anibal Lopez Martinez
#FECHA: 24/09/2015 7:23 pm 
#MODULO AFECTADO: REPORTES EGRESADOS
#DESCRIPCION: BOTON REPORTES TITULADOS POR EDAD

     function ConCantidadEgresadosTituladosMujeres($fk_nivelestudio,$fk_modalidad,$fk_carreras,$fk_generacion){
        $db =  new database;
        if($db->conectar() == true){
            $sql = "SELECT COUNT(*) as cantidadTotalTituladosMujeres
                    FROM tbl_alumnos
                    
                    INNER JOIN tbl_egresados ON tbl_egresados.fk_alumnos = tbl_alumnos.pk_alumno
                    INNER JOIN cat_genero ON cat_genero.pk_genero = tbl_alumnos.fk_genero
                    INNER JOIN tbl_carreras ON tbl_carreras.pk_carreras = tbl_alumnos.fk_carreras

                    
                    WHERE                     
                    tbl_alumnos.fk_nivelestudio = '$fk_nivelestudio' AND
                    tbl_alumnos.fk_modalidad = '$fk_modalidad' AND  
                    tbl_alumnos.fk_carreras = '$fk_carreras' AND 
                    tbl_alumnos.fk_generacion = '$fk_generacion' AND  
                    tbl_alumnos.fk_genero = '2' AND
                    tbl_egresados.fk_estadoTitulacion = '1'";

            $result = @mysql_query($sql) or die(mysql_error());
            if(!$result){
                return false;
            }else{
                return $result;
            }
            
        }       
        
    } 

    #AGREGADO: Anibal Lopez Martinez
#FECHA: 24/09/2015 7:23 pm 
#MODULO AFECTADO: REPORTES EGRESADOS
#DESCRIPCION: BOTON REPORTES TITULADOS POR EDAD

     function ConCantidadEgresadosTituladosOpcionUno($fk_nivelestudio,$fk_modalidad,$fk_carreras,$fk_generacion){
        $db =  new database;
        if($db->conectar() == true){
            $sql = "SELECT COUNT(*) as cantidadTotalTituladosOpcionUno
                    FROM tbl_alumnos
                    
                    INNER JOIN tbl_egresados ON tbl_egresados.fk_alumnos = tbl_alumnos.pk_alumno
                    INNER JOIN cat_genero ON cat_genero.pk_genero = tbl_alumnos.fk_genero
                    INNER JOIN tbl_carreras ON tbl_carreras.pk_carreras = tbl_alumnos.fk_carreras

                    
                    WHERE                     
                    tbl_alumnos.fk_nivelestudio = '$fk_nivelestudio' AND
                    tbl_alumnos.fk_modalidad = '$fk_modalidad' AND  
                    tbl_alumnos.fk_carreras = '$fk_carreras' AND 
                    tbl_alumnos.fk_generacion = '$fk_generacion' AND  
                    tbl_egresados.fk_estadoTitulacion = '1' AND
                    tbl_egresados.edadEgreso BETWEEN '0' AND '19' ";            
            $result = @mysql_query($sql) or die(mysql_error());
            if(!$result){
                return false;
            }else{
                return $result;
            }
            
        }       
        
    } 

    #AGREGADO: Anibal Lopez Martinez
#FECHA: 24/09/2015 7:23 pm 
#MODULO AFECTADO: REPORTES EGRESADOS
#DESCRIPCION: BOTON REPORTES TITULADOS POR EDAD

     function ConCantidadEgresadosTituladosOpcionDos($fk_nivelestudio,$fk_modalidad,$fk_carreras,$fk_generacion){
        $db =  new database;
        if($db->conectar() == true){
            $sql = "SELECT COUNT(*) as cantidadTotalTituladosOpcionDos
                    FROM tbl_alumnos
                    
                    INNER JOIN tbl_egresados ON tbl_egresados.fk_alumnos = tbl_alumnos.pk_alumno
                    INNER JOIN cat_genero ON cat_genero.pk_genero = tbl_alumnos.fk_genero
                    INNER JOIN tbl_carreras ON tbl_carreras.pk_carreras = tbl_alumnos.fk_carreras

                    
                    WHERE                     
                    tbl_alumnos.fk_nivelestudio = '$fk_nivelestudio' AND
                    tbl_alumnos.fk_modalidad = '$fk_modalidad' AND  
                    tbl_alumnos.fk_carreras = '$fk_carreras' AND 
                    tbl_alumnos.fk_generacion = '$fk_generacion' AND  
                    tbl_egresados.fk_estadoTitulacion = '1' AND
                    tbl_egresados.edadEgreso BETWEEN '20' AND '24' ";            
            $result = @mysql_query($sql) or die(mysql_error());
            if(!$result){
                return false;
            }else{
                return $result;
            }
            
        }       
        
    } 


        #AGREGADO: Anibal Lopez Martinez
#FECHA: 24/09/2015 7:23 pm 
#MODULO AFECTADO: REPORTES EGRESADOS
#DESCRIPCION: BOTON REPORTES TITULADOS POR EDAD

     function ConCantidadEgresadosTituladosOpcionTres($fk_nivelestudio,$fk_modalidad,$fk_carreras,$fk_generacion){
        $db =  new database;
        if($db->conectar() == true){
            $sql = "SELECT COUNT(*) as cantidadTotalTituladosOpcionTres
                    FROM tbl_alumnos
                    
                    INNER JOIN tbl_egresados ON tbl_egresados.fk_alumnos = tbl_alumnos.pk_alumno
                    INNER JOIN cat_genero ON cat_genero.pk_genero = tbl_alumnos.fk_genero
                    INNER JOIN tbl_carreras ON tbl_carreras.pk_carreras = tbl_alumnos.fk_carreras

                    
                    WHERE                     
                    tbl_alumnos.fk_nivelestudio = '$fk_nivelestudio' AND
                    tbl_alumnos.fk_modalidad = '$fk_modalidad' AND  
                    tbl_alumnos.fk_carreras = '$fk_carreras' AND 
                    tbl_alumnos.fk_generacion = '$fk_generacion' AND  
                    tbl_egresados.fk_estadoTitulacion = '1' AND
                    tbl_egresados.edadEgreso BETWEEN '25' AND '29' ";            
            $result = @mysql_query($sql) or die(mysql_error());
            if(!$result){
                return false;
            }else{
                return $result;
            }
            
        }       
        
    } 

        #AGREGADO: Anibal Lopez Martinez
#FECHA: 24/09/2015 7:23 pm 
#MODULO AFECTADO: REPORTES EGRESADOS
#DESCRIPCION: BOTON REPORTES TITULADOS POR EDAD

     function ConCantidadEgresadosTituladosOpcionCuatro($fk_nivelestudio,$fk_modalidad,$fk_carreras,$fk_generacion){
        $db =  new database;
        if($db->conectar() == true){
            $sql = "SELECT COUNT(*) as cantidadTotalTituladosOpcionCuatro
                    FROM tbl_alumnos
                    
                    INNER JOIN tbl_egresados ON tbl_egresados.fk_alumnos = tbl_alumnos.pk_alumno
                    INNER JOIN cat_genero ON cat_genero.pk_genero = tbl_alumnos.fk_genero
                    INNER JOIN tbl_carreras ON tbl_carreras.pk_carreras = tbl_alumnos.fk_carreras

                    
                    WHERE                     
                    tbl_alumnos.fk_nivelestudio = '$fk_nivelestudio' AND
                    tbl_alumnos.fk_modalidad = '$fk_modalidad' AND  
                    tbl_alumnos.fk_carreras = '$fk_carreras' AND 
                    tbl_alumnos.fk_generacion = '$fk_generacion' AND  
                    tbl_egresados.fk_estadoTitulacion = '1' AND
                    tbl_egresados.edadEgreso BETWEEN '30' AND '100' ";            
            $result = @mysql_query($sql) or die(mysql_error());
            if(!$result){
                return false;
            }else{
                return $result;
            }
            
        }       
        
    } 

     function ConCantidadEgresadosTituladosDiscapacidad($fk_nivelestudio,$fk_modalidad,$fk_carreras,$fk_generacion){
        $db =  new database;
        if($db->conectar() == true){
            $sql = "SELECT COUNT(*) as ConCantidadEgresadosTituladosDiscapacidad
                    FROM tbl_alumnos
                    
                    INNER JOIN tbl_egresados ON tbl_egresados.fk_alumnos = tbl_alumnos.pk_alumno
                    INNER JOIN cat_genero ON cat_genero.pk_genero = tbl_alumnos.fk_genero
                    INNER JOIN tbl_carreras ON tbl_carreras.pk_carreras = tbl_alumnos.fk_carreras

                    
                    WHERE                     
                    tbl_alumnos.fk_nivelestudio = '$fk_nivelestudio' AND
                    tbl_alumnos.fk_modalidad = '$fk_modalidad' AND  
                    tbl_alumnos.fk_carreras = '$fk_carreras' AND 
                    tbl_alumnos.fk_generacion = '$fk_generacion' AND  
                    tbl_egresados.fk_estadoTitulacion = '1' AND
                    tbl_egresados.Discapacidad = '1'";            
            $result = @mysql_query($sql) or die(mysql_error());
            if(!$result){
                return false;
            }else{
                return $result;
            }
            
        }       
        
    } 

	
 
 #AGREGADO: Anibal Lopez Martinez
 #FECHA: 14/09/2015 19:31 pm 
 #MODULO AFECTADO: 
 #DESCRIPCION: BOTON REPORTES EGRESADOS LABORANDO

     function ConCantidadEgresadosLaborando($fk_nivelestudio,$fk_modalidad,$fk_carreras,$fk_genereacion){
        $db =  new database;
        if($db->conectar() == true){
            $sql = "SELECT COUNT(*) as cantidadTotalEgresadosLaborando, cat_generacion.descripcion as DescripcionGeneracion

                    FROM tbl_alumnos
                    
                    INNER JOIN tbl_egresados ON tbl_egresados.fk_alumnos = tbl_alumnos.pk_alumno
                    INNER JOIN tbl_carreras ON tbl_carreras.pk_carreras = tbl_alumnos.fk_carreras
                    INNER JOIN cat_generacion ON cat_generacion.pk_generacion = tbl_alumnos.fk_generacion

WHERE 
                    tbl_alumnos.fk_nivelestudio = '$fk_nivelestudio' AND
                    tbl_alumnos.fk_modalidad = '$fk_modalidad' AND  
                    tbl_alumnos.fk_carreras = '$fk_carreras' AND 
					tbl_alumnos.fk_generacion = '$fk_genereacion' AND
					tbl_egresados.estatusTrabajo = '1'   
";
            $result = @mysql_query($sql) or die(mysql_error());
            if(!$result){
                return false;
            }else{
                return $result;
            }
            
        }       
        
    }
 
 #AGREGADO: Anibal Lopez Martinez
     #FECHA: 14/09/2015 19:31 pm 
 #MODULO AFECTADO: REPORTES EGRESADOS
 #DESCRIPCION: BOTON REPORTES EGRESADOS LABORANDO

     function ConCantidadEgresadosLaborandoMujeres($fk_nivelestudio,$fk_modalidad,$fk_carreras,$fk_generacion){
        $db =  new database;
        if($db->conectar() == true){
            $sql = "SELECT COUNT(*) as cantidadTotalEgresadosLaborandoMujeres
                    FROM tbl_alumnos
                    
                    INNER JOIN tbl_egresados ON tbl_egresados.fk_alumnos = tbl_alumnos.pk_alumno
                    INNER JOIN cat_genero ON cat_genero.pk_genero = tbl_alumnos.fk_genero
                    INNER JOIN tbl_carreras ON tbl_carreras.pk_carreras = tbl_alumnos.fk_carreras

                    
                    WHERE                     
					tbl_alumnos.fk_nivelestudio = '$fk_nivelestudio' AND
                    tbl_alumnos.fk_modalidad = '$fk_modalidad' AND  
                    tbl_alumnos.fk_carreras = '$fk_carreras' AND 
					tbl_alumnos.fk_generacion = '$fk_generacion' AND  
					tbl_egresados.estatusTrabajo = '1' AND
					tbl_alumnos.fk_genero = '2'";
            $result = @mysql_query($sql) or die(mysql_error());
            if(!$result){
                return false;
            }else{
                return $result;
            }
            
        }       
        
    } 
	
	 #AGREGADO: Anibal Lopez Martinez
 #MODULO AFECTADO: REPORTES EGRESADOS
     #FECHA: 14/09/2015 19:31 pm 
 #DESCRIPCION: BOTON REPORTES EGRESADOS LABORANDO

     function ConCantidadEgresadosLaborandoHombres($fk_nivelestudio,$fk_modalidad,$fk_carreras,$fk_generacion){
        $db =  new database;
        if($db->conectar() == true){
            $sql = "SELECT COUNT(*) as cantidadTotalEgresadosLaborandoHombres
                    FROM tbl_alumnos
                    
                    INNER JOIN tbl_egresados ON tbl_egresados.fk_alumnos = tbl_alumnos.pk_alumno
                    INNER JOIN cat_genero ON cat_genero.pk_genero = tbl_alumnos.fk_genero
                    INNER JOIN tbl_carreras ON tbl_carreras.pk_carreras = tbl_alumnos.fk_carreras

                    
                    WHERE                     
					tbl_alumnos.fk_nivelestudio = '$fk_nivelestudio' AND
                    tbl_alumnos.fk_modalidad = '$fk_modalidad' AND  
                    tbl_alumnos.fk_carreras = '$fk_carreras' AND 
					tbl_alumnos.fk_generacion = '$fk_generacion' AND  
					tbl_egresados.estatusTrabajo = '1' AND
					tbl_alumnos.fk_genero = '1'";
            $result = @mysql_query($sql) or die(mysql_error());
            if(!$result){
                return false;
            }else{
                return $result;
            }
            
        }       
        
    } 

 #AGREGADO: Anibal Lopez Martinez
 #FECHA: 22/09/2015 6:48 pm 
 #MODULO AFECTADO: REPORTES EGRESADOS
 #DESCRIPCION: BOTON REPORTES EGRESADOS LABORANDO

     function ConCantidadEgresadosLaborandoUno($fk_nivelestudio,$fk_modalidad,$fk_carreras,$fk_generacion){
        $db =  new database;
        if($db->conectar() == true){
            $sql = "SELECT  empleoencontrar , COUNT(empleoencontrar) as CantidadEgresadosLaborandoUnoaTresMeses
                    FROM tbl_alumnos
                    
                    INNER JOIN tbl_egresados ON tbl_egresados.fk_alumnos = tbl_alumnos.pk_alumno
                    INNER JOIN cat_genero ON cat_genero.pk_genero = tbl_alumnos.fk_genero
                    INNER JOIN tbl_carreras ON tbl_carreras.pk_carreras = tbl_alumnos.fk_carreras

                    
                    WHERE                     
					tbl_alumnos.fk_nivelestudio = '$fk_nivelestudio' AND
                    tbl_alumnos.fk_modalidad = '$fk_modalidad' AND  
                    tbl_alumnos.fk_carreras = '$fk_carreras' AND 
					tbl_alumnos.fk_generacion = '$fk_generacion' AND
                    tbl_egresados.empleoencontrar = '1'";
            $result = @mysql_query($sql) or die(mysql_error());
            if(!$result){
                return false;
            }else{
                return $result;
            }
            
        }       
        
    }

#AGREGADO: Anibal Lopez Martinez
 #FECHA: 23/09/2015 7:18 pm 
 #MODULO AFECTADO: REPORTES EGRESADOS
 #DESCRIPCION: BOTON REPORTES EGRESADOS LABORANDO

     function ConCantidadEgresadosLaborandoDos($fk_nivelestudio,$fk_modalidad,$fk_carreras,$fk_generacion){
        $db =  new database;
        if($db->conectar() == true){
            $sql = "SELECT  empleoencontrar , COUNT(empleoencontrar) as CantidadEgresadosLaborandoTresaSeisMeses
                    FROM tbl_alumnos
                    
                    INNER JOIN tbl_egresados ON tbl_egresados.fk_alumnos = tbl_alumnos.pk_alumno
                    INNER JOIN cat_genero ON cat_genero.pk_genero = tbl_alumnos.fk_genero
                    INNER JOIN tbl_carreras ON tbl_carreras.pk_carreras = tbl_alumnos.fk_carreras

                    
                    WHERE                     
                    tbl_alumnos.fk_nivelestudio = '$fk_nivelestudio' AND
                    tbl_alumnos.fk_modalidad = '$fk_modalidad' AND  
                    tbl_alumnos.fk_carreras = '$fk_carreras' AND 
                    tbl_alumnos.fk_generacion = '$fk_generacion' AND
                    tbl_egresados.empleoencontrar = '2'";
            $result = @mysql_query($sql) or die(mysql_error());
            if(!$result){
                return false;
            }else{
                return $result;
            }
            
        }       
        
    }

 #AGREGADO: Anibal Lopez Martinez
 #FECHA: 23/09/2015 7:18 pm 
 #MODULO AFECTADO: REPORTES EGRESADOS
 #DESCRIPCION: BOTON REPORTES EGRESADOS LABORANDO

     function ConCantidadEgresadosLaborandoTres($fk_nivelestudio,$fk_modalidad,$fk_carreras,$fk_generacion){
        $db =  new database;
        if($db->conectar() == true){
            $sql = "SELECT  empleoencontrar , COUNT(empleoencontrar) as CantidadEgresadosLaborandoSeisMesesaUnAno
                    FROM tbl_alumnos
                    
                    INNER JOIN tbl_egresados ON tbl_egresados.fk_alumnos = tbl_alumnos.pk_alumno
                    INNER JOIN cat_genero ON cat_genero.pk_genero = tbl_alumnos.fk_genero
                    INNER JOIN tbl_carreras ON tbl_carreras.pk_carreras = tbl_alumnos.fk_carreras

                    
                    WHERE                     
                    tbl_alumnos.fk_nivelestudio = '$fk_nivelestudio' AND
                    tbl_alumnos.fk_modalidad = '$fk_modalidad' AND  
                    tbl_alumnos.fk_carreras = '$fk_carreras' AND 
                    tbl_alumnos.fk_generacion = '$fk_generacion' AND
                    tbl_egresados.empleoencontrar = '3'";
            $result = @mysql_query($sql) or die(mysql_error());
            if(!$result){
                return false;
            }else{
                return $result;
            }
            
        }       
        
    }   

 #AGREGADO: Anibal Lopez Martinez
 #FECHA: 23/09/2015 7:18 pm 
 #MODULO AFECTADO: REPORTES EGRESADOS
 #DESCRIPCION: BOTON REPORTES EGRESADOS LABORANDO

     function ConCantidadEgresadosLaborandoCuatro($fk_nivelestudio,$fk_modalidad,$fk_carreras,$fk_generacion){
        $db =  new database;
        if($db->conectar() == true){
            $sql = "SELECT  empleoencontrar , COUNT(empleoencontrar) as CantidadEgresadosLaborandoUnoaDosAnos
                    FROM tbl_alumnos
                    
                    INNER JOIN tbl_egresados ON tbl_egresados.fk_alumnos = tbl_alumnos.pk_alumno
                    INNER JOIN cat_genero ON cat_genero.pk_genero = tbl_alumnos.fk_genero
                    INNER JOIN tbl_carreras ON tbl_carreras.pk_carreras = tbl_alumnos.fk_carreras

                    
                    WHERE                     
                    tbl_alumnos.fk_nivelestudio = '$fk_nivelestudio' AND
                    tbl_alumnos.fk_modalidad = '$fk_modalidad' AND  
                    tbl_alumnos.fk_carreras = '$fk_carreras' AND 
                    tbl_alumnos.fk_generacion = '$fk_generacion' AND
                    tbl_egresados.empleoencontrar = '4'";
            $result = @mysql_query($sql) or die(mysql_error());
            if(!$result){
                return false;
            }else{
                return $result;
            }
            
        }       
        
    }   

 #AGREGADO: Anibal Lopez Martinez
 #FECHA: 23/09/2015 7:18 pm 
 #MODULO AFECTADO: REPORTES EGRESADOS
 #DESCRIPCION: BOTON REPORTES EGRESADOS LABORANDO

     function ConCantidadEgresadosLaborandoCinco($fk_nivelestudio,$fk_modalidad,$fk_carreras,$fk_generacion){
        $db =  new database;
        if($db->conectar() == true){
            $sql = "SELECT  empleoencontrar , COUNT(empleoencontrar) as CantidadEgresadosLaborandoDosAnosenAdelante
                    FROM tbl_alumnos
                    
                    INNER JOIN tbl_egresados ON tbl_egresados.fk_alumnos = tbl_alumnos.pk_alumno
                    INNER JOIN cat_genero ON cat_genero.pk_genero = tbl_alumnos.fk_genero
                    INNER JOIN tbl_carreras ON tbl_carreras.pk_carreras = tbl_alumnos.fk_carreras

                    
                    WHERE                     
                    tbl_alumnos.fk_nivelestudio = '$fk_nivelestudio' AND
                    tbl_alumnos.fk_modalidad = '$fk_modalidad' AND  
                    tbl_alumnos.fk_carreras = '$fk_carreras' AND 
                    tbl_alumnos.fk_generacion = '$fk_generacion' AND
                    tbl_egresados.empleoencontrar = '5'";
            $result = @mysql_query($sql) or die(mysql_error());
            if(!$result){
                return false;
            }else{
                return $result;
            }
            
        }       
        
    }  




#AGREGADO: Anibal Lopez Martinez
#FECHA: 29/03/2016 7:00 pm 
#MODULO AFECTADO: REPORTES EGRESADOS
#DESCRIPCION: BOTON REPORTES EGRESADOS LABORANDO

     function ConCantidadEgresadosLaborandoOpcionUno($fk_nivelestudio,$fk_modalidad,$fk_carreras,$fk_generacion){
        $db =  new database;
        if($db->conectar() == true){
            $sql = "SELECT COUNT(*) as ConCantidadEgresadosLaborandoOpcionUno
                    FROM tbl_alumnos
                    
                    INNER JOIN tbl_egresados ON tbl_egresados.fk_alumnos = tbl_alumnos.pk_alumno
                    INNER JOIN cat_genero ON cat_genero.pk_genero = tbl_alumnos.fk_genero
                    INNER JOIN tbl_carreras ON tbl_carreras.pk_carreras = tbl_alumnos.fk_carreras

                    
                    WHERE                     
                    tbl_alumnos.fk_nivelestudio = '$fk_nivelestudio' AND
                    tbl_alumnos.fk_modalidad = '$fk_modalidad' AND  
                    tbl_alumnos.fk_carreras = '$fk_carreras' AND 
                    tbl_alumnos.fk_generacion = '$fk_generacion' AND  
		    tbl_egresados.estatusTrabajo = '1' AND
                    tbl_egresados.edadEgreso BETWEEN '0' AND '19' ";            
            $result = @mysql_query($sql) or die(mysql_error());
            if(!$result){
                return false;
            }else{
                return $result;
            }
            
        }       
        
    } 

#AGREGADO: Anibal Lopez Martinez
#FECHA: 29/03/2016 7:00 pm 
#MODULO AFECTADO: REPORTES EGRESADOS
#DESCRIPCION: BOTON REPORTES EGRESADOS LABORANDO

     function ConCantidadEgresadosLaborandoOpcionDos($fk_nivelestudio,$fk_modalidad,$fk_carreras,$fk_generacion){
        $db =  new database;
        if($db->conectar() == true){
            $sql = "SELECT COUNT(*) as ConCantidadEgresadosLaborandoOpcionDos
                    FROM tbl_alumnos
                    
                    INNER JOIN tbl_egresados ON tbl_egresados.fk_alumnos = tbl_alumnos.pk_alumno
                    INNER JOIN cat_genero ON cat_genero.pk_genero = tbl_alumnos.fk_genero
                    INNER JOIN tbl_carreras ON tbl_carreras.pk_carreras = tbl_alumnos.fk_carreras

                    
                    WHERE                     
                    tbl_alumnos.fk_nivelestudio = '$fk_nivelestudio' AND
                    tbl_alumnos.fk_modalidad = '$fk_modalidad' AND  
                    tbl_alumnos.fk_carreras = '$fk_carreras' AND 
                    tbl_alumnos.fk_generacion = '$fk_generacion' AND  
		    tbl_egresados.estatusTrabajo = '1' AND
                    tbl_egresados.edadEgreso BETWEEN '20' AND '24' ";            
            $result = @mysql_query($sql) or die(mysql_error());
            if(!$result){
                return false;
            }else{
                return $result;
            }
            
        }       
        
    } 


#AGREGADO: Anibal Lopez Martinez
#FECHA: 29/03/2016 7:00 pm 
#MODULO AFECTADO: REPORTES EGRESADOS
#DESCRIPCION: BOTON REPORTES EGRESADOS LABORANDO


     function ConCantidadEgresadosLaborandoOpcionTres($fk_nivelestudio,$fk_modalidad,$fk_carreras,$fk_generacion){
        $db =  new database;
        if($db->conectar() == true){
            $sql = "SELECT COUNT(*) as ConCantidadEgresadosLaborandoOpcionTres
                    FROM tbl_alumnos
                    
                    INNER JOIN tbl_egresados ON tbl_egresados.fk_alumnos = tbl_alumnos.pk_alumno
                    INNER JOIN cat_genero ON cat_genero.pk_genero = tbl_alumnos.fk_genero
                    INNER JOIN tbl_carreras ON tbl_carreras.pk_carreras = tbl_alumnos.fk_carreras

                    
                    WHERE                     
                    tbl_alumnos.fk_nivelestudio = '$fk_nivelestudio' AND
                    tbl_alumnos.fk_modalidad = '$fk_modalidad' AND  
                    tbl_alumnos.fk_carreras = '$fk_carreras' AND 
                    tbl_alumnos.fk_generacion = '$fk_generacion' AND  
		    tbl_egresados.estatusTrabajo = '1' AND
                    tbl_egresados.edadEgreso BETWEEN '25' AND '29' ";            
            $result = @mysql_query($sql) or die(mysql_error());
            if(!$result){
                return false;
            }else{
                return $result;
            }
            
        }       
        
    } 

#AGREGADO: Anibal Lopez Martinez
#FECHA: 29/03/2016 7:00 pm 
#MODULO AFECTADO: REPORTES EGRESADOS
#DESCRIPCION: BOTON REPORTES EGRESADOS LABORANDO

     function ConCantidadEgresadosLaborandoOpcionCuatro($fk_nivelestudio,$fk_modalidad,$fk_carreras,$fk_generacion){
        $db =  new database;
        if($db->conectar() == true){
            $sql = "SELECT COUNT(*) as ConCantidadEgresadosLaborandoOpcionCuatro
                    FROM tbl_alumnos
                    
                    INNER JOIN tbl_egresados ON tbl_egresados.fk_alumnos = tbl_alumnos.pk_alumno
                    INNER JOIN cat_genero ON cat_genero.pk_genero = tbl_alumnos.fk_genero
                    INNER JOIN tbl_carreras ON tbl_carreras.pk_carreras = tbl_alumnos.fk_carreras

                    
                    WHERE                     
                    tbl_alumnos.fk_nivelestudio = '$fk_nivelestudio' AND
                    tbl_alumnos.fk_modalidad = '$fk_modalidad' AND  
                    tbl_alumnos.fk_carreras = '$fk_carreras' AND 
                    tbl_alumnos.fk_generacion = '$fk_generacion' AND  
		    tbl_egresados.estatusTrabajo = '1' AND
                    tbl_egresados.edadEgreso BETWEEN '30' AND '100' ";            
            $result = @mysql_query($sql) or die(mysql_error());
            if(!$result){
                return false;
            }else{
                return $result;
            }
            
        }       
        
    } 

#AGREGADO: Anibal Lopez Martinez
#FECHA: 29/03/2016 7:00 pm 
#MODULO AFECTADO: REPORTES EGRESADOS
#DESCRIPCION: BOTON REPORTES EGRESADOS LABORANDO

     function ConCantidadEgresadosLaborandoDiscapacidad($fk_nivelestudio,$fk_modalidad,$fk_carreras,$fk_generacion){
        $db =  new database;
        if($db->conectar() == true){
            $sql = "SELECT COUNT(*) as ConCantidadEgresadosLaborandoDiscapacidad
                    FROM tbl_alumnos
                    
                    INNER JOIN tbl_egresados ON tbl_egresados.fk_alumnos = tbl_alumnos.pk_alumno
                    INNER JOIN cat_genero ON cat_genero.pk_genero = tbl_alumnos.fk_genero
                    INNER JOIN tbl_carreras ON tbl_carreras.pk_carreras = tbl_alumnos.fk_carreras

                    
                    WHERE                     
                    tbl_alumnos.fk_nivelestudio = '$fk_nivelestudio' AND
                    tbl_alumnos.fk_modalidad = '$fk_modalidad' AND  
                    tbl_alumnos.fk_carreras = '$fk_carreras' AND 
                    tbl_alumnos.fk_generacion = '$fk_generacion' AND  
		    tbl_egresados.estatusTrabajo = '1' AND
                    tbl_egresados.Discapacidad = '1'";            
            $result = @mysql_query($sql) or die(mysql_error());
            if(!$result){
                return false;
            }else{
                return $result;
            }
            
        }       
        
    } 
                     


/************************************************************************************************************/
//***********************************G R A F I C A S     D  E     M E D I C I N A **************************//	



	  #AGREGADO: Anibal Lopez Martinez
 #FECHA: 29/05/2015 19:03 pm 
 #MODULO AFECTADO: REPORTES MEDICINA 
 #DESCRIPCION: BOTON GRAFICA
     function CantidadAlumnosEncuestaMedicinaGrafica($pk_alumno){
        $db =  new database;
        if($db->conectar() == true){
            $sql = "SELECT descripcion_estudiosposgrado, COUNT( descripcion_estudiosposgrado ) AS cantidad
FROM tbl_encuestamedicina

INNER JOIN cat_estudiosposgrado ON tbl_encuestamedicina.fk_estudiosposgrado = cat_estudiosposgrado.pk_estudiosposgrado
GROUP BY descripcion_estudiosposgrado
                    ";        $result = @mysql_query($sql) or die(mysql_error());
            if(!$result){
                return false;
            }else{
                return $result;
       
            }
            
        }       
        
    }
	
	
		
	  #AGREGADO: Anibal Lopez Martinez
 #FECHA: 27/08/2015 21:19 pm 
 #MODULO AFECTADO: REPORTES MEDICINA 
 #DESCRIPCION: BOTON GRAFICA
     function CantidadAlumnosEncuestaMedicinaGraficaramaposgrado($pk_alumno){
        $db =  new database;
        if($db->conectar() == true){
            $sql = "SELECT descripcion_ramaposgrado, COUNT( descripcion_ramaposgrado ) AS cantidad
FROM tbl_encuestamedicina

INNER JOIN cat_ramaposgrado ON tbl_encuestamedicina.fk_ramaposgrado = cat_ramaposgrado.pk_ramaposgrado
GROUP BY descripcion_ramaposgrado
                    ";        $result = @mysql_query($sql) or die(mysql_error());
            if(!$result){
                return false;
            }else{
                return $result;
       
            }
            
        }       
        
    }
	
		  #AGREGADO: Anibal Lopez Martinez
 #FECHA: 29/08/2015 12:03 pm 
 #MODULO AFECTADO: REPORTES MEDICINA 
 #DESCRIPCION: BOTON GRAFICA
     function CantidadAlumnosEncuestaMedicinaGraficapuesto($pk_alumno){
        $db =  new database;
        if($db->conectar() == true){
				$sql = "SELECT descripcion_puestosmedicina, COUNT( descripcion_puestosmedicina ) AS cantidad
	FROM tbl_encuestamedicina
	
	INNER JOIN cat_puestosmedicina ON tbl_encuestamedicina.fk_puestosmedicina = cat_puestosmedicina.pk_puestosmedicina
	GROUP BY descripcion_puestosmedicina
                    ";        $result = @mysql_query($sql) or die(mysql_error());
            if(!$result){
                return false;
            }else{
                return $result;
       
            }
            
        }       
        
    }
    
 #AGREGADO: Anibal Lopez Martinez
 #FECHA: 01/09/2015 19:31 pm 
 #MODULO AFECTADO: REPORTES MEDICINA 
 #DESCRIPCION: BOTON GRAFICA
     function CantidadAlumnosEncuestaMedicinaGraficaIngresoActual($pk_alumno){
        $db =  new database;
        if($db->conectar() == true){
				$sql = "SELECT descripcion_ingresoactual, COUNT( descripcion_ingresoactual ) AS cantidad
	FROM tbl_encuestamedicina
	
	INNER JOIN cat_ingresoactual ON tbl_encuestamedicina.fk_ingresoactual = cat_ingresoactual.pk_ingresoactual
	GROUP BY descripcion_ingresoactual
                    ";        $result = @mysql_query($sql) or die(mysql_error());
            if(!$result){
                return false;
            }else{
                return $result;
       
            }
            
        }       
        
    }


#AGREGADO: Anibal Lopez Martinez
 #FECHA: 14/01/2016 18:58 pm 
 #MODULO AFECTADO: REPORTES MEDICINA GRAFICA 
 #DESCRIPCION: GENERA LA GRAFICA SI EL EGRESAOD FORMA PARTE DE UN ORGANISMO SOCIAL O PROFESIONAL
     function CantidadAlumnosEncuestaMedicinaGraficaOrganismoSocialProfesional($pk_alumno){
        $db =  new database;
        if($db->conectar() == true){
                $sql = "SELECT PerteneceOrganizacionSocial, COUNT( PerteneceOrganizacionSocial ) AS cantidad
    FROM tbl_encuestamedicina                 
                        GROUP BY PerteneceOrganizacionSocial
";        
                    $result = @mysql_query($sql) or die(mysql_error());
            if(!$result){
                return false;
            }else{
                return $result;
       
            }
            
        }       
        
    }    

 #AGREGADO: Anibal Lopez Martinez
 #FECHA: 22/01/2016 20:00 pm 
 #MODULO AFECTADO: REPORTES MEDICINA GRAFICA 
 #DESCRIPCION: GENERA LA GRAFICA SI EL EGRESAOD CUENTA CON UN CERTIFICADO PROFESIONAL
     function CantidadAlumnosEncuestaMedicinaGraficaCertificacionProfesional($pk_alumno){
        $db =  new database;
        if($db->conectar() == true){
                $sql = "SELECT CertificacionProfesional, COUNT( CertificacionProfesional ) AS cantidad
    FROM tbl_encuestamedicina                 
                        GROUP BY CertificacionProfesional
";        
                    $result = @mysql_query($sql) or die(mysql_error());
            if(!$result){
                return false;
            }else{
                return $result;
       
            }
            
        }       
        
    }     



 /************************************************************************************************************/
//***********************************G R A F I C A S     D  E     E G R E S A D O S **************************//  



  #AGREGADO: Anibal Lopez Martinez
 #FECHA: 30/09/2015 9:28 pm 
 #MODULO AFECTADO: REPORTES EGRESADOS
 #DESCRIPCION: GRAFICAS EGRESADOS

     function GraficaEgresadosLaborando($fk_nivelestudio,$fk_modalidad,$fk_carreras,$fk_generacion){
        $db =  new database;
        if($db->conectar() == true){
            $sql = "SELECT  estatusTrabajo , COUNT(estatusTrabajo) as CantidadEgresadosLaborando
                    FROM tbl_alumnos
                    
                    INNER JOIN tbl_egresados ON tbl_egresados.fk_alumnos = tbl_alumnos.pk_alumno
                    INNER JOIN tbl_carreras ON tbl_carreras.pk_carreras = tbl_alumnos.fk_carreras

                    
                    WHERE                     
                    tbl_alumnos.fk_nivelestudio = '$fk_nivelestudio' AND
                    tbl_alumnos.fk_modalidad = '$fk_modalidad' AND  
                    tbl_alumnos.fk_carreras = '$fk_carreras' AND 
                    tbl_alumnos.fk_generacion = '$fk_generacion' AND
                    tbl_egresados.estatusTrabajo = '1'";
            $result = @mysql_query($sql) or die(mysql_error());
            if(!$result){
                return false;
            }else{
                return $result;
            }
            
        }       
        
    }   



    
 #AGREGADO: Anibal Lopez Martinez
 #FECHA: 30/09/2015 9:28 pm 
 #MODULO AFECTADO: REPORTES EGRESADOS
 #DESCRIPCION: GRAFICAS EGRESADOS 	
    
         function GraficaEgresadosNoLaborando($fk_nivelestudio,$fk_modalidad,$fk_carreras,$fk_generacion){
        $db =  new database;
        if($db->conectar() == true){
            $sql = "SELECT  estatusTrabajo , COUNT(estatusTrabajo) as CantidadEgresadosNoLaborando
                    FROM tbl_alumnos
                    
                    INNER JOIN tbl_egresados ON tbl_egresados.fk_alumnos = tbl_alumnos.pk_alumno
                    INNER JOIN cat_genero ON cat_genero.pk_genero = tbl_alumnos.fk_genero
                    INNER JOIN tbl_carreras ON tbl_carreras.pk_carreras = tbl_alumnos.fk_carreras

                    
                    WHERE                     
                    tbl_alumnos.fk_nivelestudio = '$fk_nivelestudio' AND
                    tbl_alumnos.fk_modalidad = '$fk_modalidad' AND  
                    tbl_alumnos.fk_carreras = '$fk_carreras' AND 
                    tbl_alumnos.fk_generacion = '$fk_generacion' AND
                    tbl_egresados.estatusTrabajo = '2'";
            $result = @mysql_query($sql) or die(mysql_error());
            if(!$result){
                return false;
            }else{
                return $result;
            }
            
        }       
        
    }  


 #AGREGADO: Anibal Lopez Martinez
 #FECHA: 07/02/2016 20:37 pm 
 #MODULO AFECTADO: Graficas Egresados 
 #DESCRIPCION: grafica Egresados
     function CantidadAlumnosEgresadosGraficaIngresoActual($fk_nivelestudio,$fk_modalidad,$fk_carreras,$fk_generacion){
        $db =  new database;
        if($db->conectar() == true){
                $sql = "SELECT descripcion_ingresoactual, COUNT( descripcion_ingresoactual ) AS cantidad
    
    FROM tbl_alumnos
    
    INNER JOIN tbl_egresados ON tbl_egresados.fk_alumnos = tbl_alumnos.pk_alumno
    INNER JOIN cat_ingresoactual ON tbl_egresados.fk_ingresoactual = cat_ingresoactual.pk_ingresoactual

     WHERE                     
                    tbl_alumnos.fk_nivelestudio = '$fk_nivelestudio' AND
                    tbl_alumnos.fk_modalidad = '$fk_modalidad' AND  
                    tbl_alumnos.fk_carreras = '$fk_carreras' AND 
                    tbl_alumnos.fk_generacion = '$fk_generacion' 
                    GROUP BY descripcion_ingresoactual";        

                    $result = @mysql_query($sql) or die(mysql_error());
            if(!$result){
                return false;
            }else{
                return $result;
       
            }
            
        }       
        
    }	


#AGREGADO: Anibal Lopez Martinez
 #FECHA: 07/02/2016 20:37 pm 
 #MODULO AFECTADO: Graficas Egresados 
 #DESCRIPCION: grafica Egresados
     function CantidadAlumnosEgresadosGraficaTiempoEnEmplearse($fk_nivelestudio,$fk_modalidad,$fk_carreras,$fk_generacion){
        $db =  new database;
        if($db->conectar() == true){
                $sql = "SELECT descripcion_tiempo, COUNT( descripcion_tiempo ) AS cantidad
    
    FROM tbl_alumnos
    
    INNER JOIN tbl_egresados ON tbl_egresados.fk_alumnos = tbl_alumnos.pk_alumno
    INNER JOIN cat_tiempo ON tbl_egresados.empleoencontrar = cat_tiempo.pk_tiempo

     WHERE                     
                    tbl_alumnos.fk_nivelestudio = '$fk_nivelestudio' AND
                    tbl_alumnos.fk_modalidad = '$fk_modalidad' AND  
                    tbl_alumnos.fk_carreras = '$fk_carreras' AND 
                    tbl_alumnos.fk_generacion = '$fk_generacion' 
                    GROUP BY descripcion_tiempo";        

                    $result = @mysql_query($sql) or die(mysql_error());
            if(!$result){
                return false;
            }else{
                return $result;
       
            }
            
        }       
        
    }


#AGREGADO: Anibal Lopez Martinez
 #FECHA: 07/02/2016 20:37 pm 
 #MODULO AFECTADO: Graficas Egresados 
 #DESCRIPCION: grafica Egresados
     function CantidadAlumnosEgresadosGraficaPlan($fk_nivelestudio,$fk_modalidad,$fk_carreras,$fk_generacion){
        $db =  new database;
        if($db->conectar() == true){
                $sql = "SELECT plandeestudioscalificacion, COUNT( plandeestudioscalificacion ) AS cantidad
    
    FROM tbl_alumnos
    
    INNER JOIN tbl_egresados ON tbl_egresados.fk_alumnos = tbl_alumnos.pk_alumno

     WHERE                     
                    tbl_alumnos.fk_nivelestudio = '$fk_nivelestudio' AND
                    tbl_alumnos.fk_modalidad = '$fk_modalidad' AND  
                    tbl_alumnos.fk_carreras = '$fk_carreras' AND 
                    tbl_alumnos.fk_generacion = '$fk_generacion' 
                    GROUP BY plandeestudioscalificacion";        

                    $result = @mysql_query($sql) or die(mysql_error());
            if(!$result){
                return false;
            }else{
                return $result;
       
            }
            
        }       
        
    }


#AGREGADO: Anibal Lopez Martinez
 #FECHA: 07/02/2016 20:37 pm 
 #MODULO AFECTADO: Graficas Egresados 
 #DESCRIPCION: grafica Egresados
     function CantidadAlumnosEgresadosGraficaGradodeSatisfaccion($fk_nivelestudio,$fk_modalidad,$fk_carreras,$fk_generacion){
        $db =  new database;
        if($db->conectar() == true){
                $sql = "SELECT descripcion_gradosatisfaccion, COUNT( descripcion_gradosatisfaccion ) AS cantidad
    
    FROM tbl_alumnos
    
    INNER JOIN tbl_egresados ON tbl_egresados.fk_alumnos = tbl_alumnos.pk_alumno
    INNER JOIN cat_gradosatisfaccion ON tbl_egresados.fk_gradosatisfaccion = cat_gradosatisfaccion.pk_gradosatisfaccion


     WHERE                     
                    tbl_alumnos.fk_nivelestudio = '$fk_nivelestudio' AND
                    tbl_alumnos.fk_modalidad = '$fk_modalidad' AND  
                    tbl_alumnos.fk_carreras = '$fk_carreras' AND 
                    tbl_alumnos.fk_generacion = '$fk_generacion' 
                    GROUP BY descripcion_gradosatisfaccion";        

                    $result = @mysql_query($sql) or die(mysql_error());
            if(!$result){
                return false;
            }else{
                return $result;
       
            }
            
        }       
        
    }
    
	
	
	
	//BOTON VERDE EGRESADOSÇ
	
	#AGREGADO: Anibal Lopez Martinez
 #FECHA: 30/09/2015 9:28 pm 
 #MODULO AFECTADO: REPORTES EGRESADOS
 #DESCRIPCION: GRAFICAS EGRESADOS 	
    
         function ReporteAlumnosNoLaborando($fk_nivelestudio,$fk_modalidad,$fk_carreras){
        $db =  new database;
        if($db->conectar() == true){
            $sql = "SELECT *
			,                     
                   
CONCAT_WS( ' ', tbl_alumnos.apaterno , tbl_alumnos.amaterno , tbl_alumnos.nombre ) AS NombreCompleto			
                    FROM tbl_alumnos
                    
                    INNER JOIN tbl_egresados ON tbl_egresados.fk_alumnos = tbl_alumnos.pk_alumno
                    INNER JOIN cat_genero ON cat_genero.pk_genero = tbl_alumnos.fk_genero
                    INNER JOIN tbl_carreras ON tbl_carreras.pk_carreras = tbl_alumnos.fk_carreras

                    
                    WHERE                     
                    tbl_alumnos.fk_nivelestudio = '$fk_nivelestudio' AND
                    tbl_alumnos.fk_modalidad = '$fk_modalidad' AND  
                    tbl_alumnos.fk_carreras = '$fk_carreras' AND 
                    tbl_egresados.estatusTrabajo = '2'";
            $result = @mysql_query($sql) or die(mysql_error());
            if(!$result){
                return false;
            }else{
                return $result;
            }
            
        }       
        
    }  
	
	
	
	#AGREGADO: Anibal Lopez Martinez
 #FECHA: 07/02/2016 20:37 pm 
 #MODULO AFECTADO: Graficas Egresados 
 #DESCRIPCION: grafica Egresados
     function CantidadAlumnosEgresadosGraficaAspectoDebilidad($fk_nivelestudio,$fk_modalidad,$fk_carreras,$fk_generacion){
        $db =  new database;
        if($db->conectar() == true){
                $sql = "SELECT descripcion_aspectodebilidad, COUNT( descripcion_aspectodebilidad ) AS cantidad
    
    FROM tbl_alumnos
    
    INNER JOIN tbl_egresados ON tbl_egresados.fk_alumnos = tbl_alumnos.pk_alumno
    INNER JOIN cat_aspectodebilidad ON tbl_egresados.aspectodebilidad = cat_aspectodebilidad.pk_aspectodebilidad


     WHERE                     
                    tbl_alumnos.fk_nivelestudio = '$fk_nivelestudio' AND
                    tbl_alumnos.fk_modalidad = '$fk_modalidad' AND  
                    tbl_alumnos.fk_carreras = '$fk_carreras' AND 
                    tbl_alumnos.fk_generacion = '$fk_generacion' 
                    GROUP BY descripcion_aspectodebilidad";        

                    $result = @mysql_query($sql) or die(mysql_error());
            if(!$result){
                return false;
            }else{
                return $result;
       
            }
            
        }       
        
    }



	 /************************************************************************************************************/
//***********************************BOTON PARA ALUMNOS FALTANTES **************************//  


 /* #AGREGADO: Anibal Lopez Martinez
 #FECHA: 07/05/2016 11:40 AM 
 #MODULO AFECTADO: REPORTES EGRESADOS
 #DESCRIPCION: GRAFICAS EGRESADOS BOTON ALUMNOS FALTANTES

     function btnAlumnosFaltantesLaboral($fk_nivelestudio,$fk_modalidad,$fk_carreras,$fk_generacion){
        $db =  new database;
        if($db->conectar() == true){
            $sql = "SELECT *, CONCAT_WS( ' ', tbl_alumnos.apaterno , tbl_alumnos.amaterno , tbl_alumnos.nombre ) AS NombreCompleto			
                    FROM tbl_alumnos
                    
                    INNER JOIN tbl_egresados ON tbl_egresados.fk_alumnos = tbl_alumnos.pk_alumno
                    INNER JOIN cat_genero ON cat_genero.pk_genero = tbl_alumnos.fk_genero
                    INNER JOIN tbl_carreras ON tbl_carreras.pk_carreras = tbl_alumnos.fk_carreras

                    
                    WHERE                     
                    tbl_alumnos.fk_nivelestudio = '$fk_nivelestudio' AND
                    tbl_alumnos.fk_modalidad = '$fk_modalidad' AND  
                    tbl_alumnos.fk_carreras = '$fk_carreras' AND 
		    tbl_alumnos.fk_generacion = '$fk_generacion' AND
                    tbl_egresados.estatusTrabajo = ' '";
            $result = @mysql_query($sql) or die(mysql_error());
            if(!$result){
                return false;
            }else{
                return $result;
            }
            
        }       
       
    }   */



 #AGREGADO: Anibal Lopez Martinez
 #FECHA: 12/05/2016 07:40 AM 
 #MODULO AFECTADO: REPORTES EGRESADOS
 #DESCRIPCION: GRAFICAS EGRESADOS RELACION DE ALUMNOS
     function btnListaAlumnos($fk_nivelestudio,$fk_modalidad,$fk_carreras,$fk_generacion){
        $db =  new database;
        if($db->conectar() == true){
            $sql = "SELECT *, 
					
		    CONCAT_WS( ' ', tbl_alumnos.apaterno , tbl_alumnos.amaterno , tbl_alumnos.nombre ) AS NombreCompleto			

                    FROM tbl_alumnos
						
                    INNER JOIN tbl_egresados ON tbl_egresados.fk_alumnos = tbl_alumnos.pk_alumno
		    LEFT JOIN cat_ingresoactual ON tbl_egresados.fk_ingresoactual = cat_ingresoactual.pk_ingresoactual
		    LEFT JOIN cat_tiempo ON tbl_egresados.empleoencontrar = cat_tiempo.pk_tiempo
		    LEFT JOIN cat_gradosatisfaccion ON tbl_egresados.fk_gradosatisfaccion = cat_gradosatisfaccion.pk_gradosatisfaccion
                    LEFT JOIN cat_aspectodebilidad ON tbl_egresados.aspectodebilidad = cat_aspectodebilidad.pk_aspectodebilidad

                    WHERE                     
                    tbl_alumnos.fk_nivelestudio = '$fk_nivelestudio' AND
                    tbl_alumnos.fk_modalidad = '$fk_modalidad' AND  
                    tbl_alumnos.fk_carreras = '$fk_carreras' AND 
					tbl_alumnos.fk_generacion = '$fk_generacion'
";
            $result = @mysql_query($sql) or die(mysql_error());
            if(!$result){
                return false;
            }else{
                return $result;
            }
            
        }       
       
    }   


   
      //para la tabla de egresados
    //con todas la generaciones por carreras (lic hugo)
    function ConReporteAlumnosTituloExpedidoSoloTituladosGeneracion($fk_nivelestudio, $fk_modalidad, $fk_carreras,$fk_generacion){
        $db =  new database;
        if($db->conectar() == true){
            $sql = "SELECT 
                    cat_generacion.descripcion as DescripcionGeneracion,
                    cat_turnos.descripcion as DescripcionTurnos,
                    cat_opciontitulacion.Nombre as NombreOpcionTitulacion,
                    tbl_alumnos.generacionNumero,
                     DATE_FORMAT(fechaexpediciontitulo, '%d/%m/%Y') AS fechaexpediciontitulo,
                      CONCAT_WS( ' ', tbl_alumnos.apaterno , tbl_alumnos.amaterno , tbl_alumnos.nombre ) AS NombreCompleto,
                      cat_opciontitulacion.Nombre as NombreOpcionTitulacion, pk_titulacion, matricula, tbl_alumnos.fk_genero,
                    tbl_alumnos.fk_generacion
                    FROM tbl_alumnos
                    
                    LEFT JOIN tbl_egresados ON tbl_egresados.fk_alumnos = tbl_alumnos.pk_alumno
                    LEFT JOIN tbl_exainstitucional ON tbl_exainstitucional.fk_alumno = tbl_alumnos.pk_alumno
                    LEFT JOIN tbl_resultadoexamen ON tbl_resultadoexamen.fk_alumno = tbl_alumnos.pk_alumno
                    LEFT JOIN tbl_tomadeprotesta ON tbl_tomadeprotesta.fk_alumno = tbl_alumnos.pk_alumno
                   
                    INNER JOIN tbl_carreras ON tbl_carreras.pk_carreras = tbl_alumnos.fk_carreras
                    INNER JOIN cat_turnos ON cat_turnos.pk_turnos = tbl_alumnos.fk_turnos
                    INNER JOIN cat_anios ON cat_anios.pk_anios = tbl_alumnos.PlanEstudios
                    INNER JOIN cat_generacion ON cat_generacion.pk_generacion = tbl_alumnos.fk_generacion
                    INNER JOIN cat_opciontitulacion ON cat_opciontitulacion.pk_titulacion=tbl_tomadeprotesta.fk_titulacion
                    WHERE 
                    tbl_alumnos.fk_nivelestudio = '$fk_nivelestudio' AND
                    tbl_alumnos.fk_modalidad = '$fk_modalidad' AND  
                    tbl_alumnos.fk_carreras = '$fk_carreras'  AND
                    tbl_alumnos.fk_generacion = '$fk_generacion'  AND
                     fk_estadoTitulacion='1' 
                    ";
            $result = @mysql_query($sql) or die(mysql_error());
            if(!$result){
                return false;
            }else{
                return $result;
            }
            
        }       
        
    }



    function ConsultaEmpleadores(){
        $db =  new database;
        if($db->conectar() == true){
            $sql = "SELECT * FROM tbl_empleadores ORDER BY fechaSolicitud DESC ";
            $result = @mysql_query($sql) or die(mysql_error());
            if(!$result){
                return false;
            }else{
                return $result;
            }
            
        }       
        
    }


    function obtenerEmpleadorId($id){
        $db = new database();
        if($db->conectar() == true){
            $sql="SELECT *,DATE_FORMAT(fechaSolicitud, '%d/%m/%Y') AS fechaSolicitud2 
            FROM tbl_empleadores WHERE pk_empleador ='$id'";
            $result = @mysql_query($sql) or die(mysql_error());
            if(!$result){
                return false;
            }else{
                return $result;
            }
        }
    }


///CONSULTA PARA INVITACION DEL SINODAL Y RESPECTIVAS TOMAS DE PROTESTA 
//// POR FECHA DE TOMA

 function tomaProestaSinodalpk($fechaToma, $nivelEetudio, $sinodal){
    $db = new database;
    if($db->conectar() == true){
        $sql = "SELECT 
                a.*, t.FechaTomaProtesta
            FROM
                tbl_profesores p
                    INNER JOIN
                tbl_tomadeprotesta t ON t.presidente = p.pk_sinodal
                    OR t.secretario = p.pk_sinodal
                    OR t.vocal = p.pk_sinodal
                    INNER JOIN
                tbl_alumnos a ON a.pk_alumno = t.fk_alumno
            WHERE
                pk_sinodal = '$sinodal'
                    AND t.FechaTomaProtesta = '$fechaToma'
                    AND a.fk_nivelestudio = '$nivelEetudio'";
        $result = @mysql_query($sql) or die(mysql_error());
        if(!$result){
            return false;
        }else{
            return $result;
        }
    }
    

 }


 function datosSinodalPk($sinodal){
    $db = new database;
    if($db->conectar() == true){
        $sql = "SELECT * FROM tbl_profesores WHERE pk_sinodal = '$sinodal'";
        $result = @mysql_query($sql);
        if(!$result){
            return false;
        }else{
            return $result;
        }

    }
 } 


 function obtenerSustentantesSinodal($sinodal, $rangoFecha, $option, $cargo){
    $db = new database;
    if($db->conectar() == true ){
        $sql = "SELECT 
                CONCAT(a.nombre,' ',a.apaterno,' ',a.amaterno) as nombreAlumno,
                t.hora, t.presidente, t.secretario, t.vocal, t.suplente, 
                c.nombreCarrera
            FROM
                tbl_tomadeprotesta t
                    INNER JOIN
                tbl_alumnos a ON a.pk_alumno = t.fk_alumno
                    INNER JOIN
                tbl_carreras c ON c.pk_carreras = a.fk_carreras
            WHERE
               DATE_FORMAT(t.FechaTomaProtesta, '%d/%m/%Y') = '$rangoFecha'
                    AND t.".$cargo." = '$sinodal' ".$option." ORDER BY t.hora ASC";   
        $result = @mysql_query($sql);
        if(!$result){
            return false;
        }else{
            $rows = array();
            while($resp = @mysql_fetch_object($result)){
                $rows[] = $resp;
            }
            return $rows;
        }
    }
 }


function consutaGenralTodasCarreras($nivel, $modalidad, $estadoTitulo, $carrera){
    $dbLuminarias = new database;
    if ($dbLuminarias->conectar() == true) {
        $sql = "SELECT 
            *
        FROM
            tbl_alumnos a 
        INNER JOIN
            tbl_egresados e ON e.fk_alumnos = a.pk_alumno
        INNER JOIN
            tbl_carreras c ON c.pk_carreras = a.fk_carreras 
            AND e.fk_estadoTitulacion = '$estadoTitulo'
            AND a.fk_nivelestudio = '$nivel'
            AND a.fk_modalidad = '$modalidad'
            AND c.pk_carreras = '$carrera'
        ORDER BY a.generacionSecre DESC";
        $result = @mysql_query($sql) or die(mysql_error());
        if(!$result){
            return false;
        }else{
            $rows = array();
            while($resp = @mysql_fetch_object($result)){
                $rows[] = $resp;
            }
            return $rows;
        }

    }       
} 


///////////////////////////////////////////////////
//////////////////////////////////////////////////////
//////////////////////////////////
/////////////////CESAR ARION ESPINOSA MENDEZ

function verUsuariosOnline(){
    $dbLuminarias = new database;
    if ($dbLuminarias->conectar() == true) {
        $sql = "SELECT 
                u.Pk_Usuario_Login,
                u.Usuario,
                u.Tipo_User,
                u.Usuario_Online,
                u.activo_usuario,
                t.pk_trabajador,
                t.claveTrabajador,
                t.telefono,
                t.puestoLaboral,
                CONCAT(t.nombre,
                        ' ',
                        t.apaterno,
                        ' ',
                        t.amaterno) AS nomCompleto
            FROM
                tbl_usuario_login u
                    INNER JOIN
                tbl_trabajadores t ON t.pk_trabajador = u.Fk_trabajador
            ORDER BY u.Pk_Usuario_Login ASC";
        $resp = @mysql_query($sql) or die(mysql_error());
        if(!$resp){
            return false;
        }else{
            $rows = array();
            while($rs = @mysql_fetch_object($resp)){
                $rows[] = $rs;
            }
            return $rows;
        }    
    }
}


function busquedaPorParametros($opcion){
    $db = new database;
    if ($db->conectar() == true) {
        $sql = "SELECT a.*,c.nombreCarrera,e.fk_estadoTitulacion,e.estatusCredencial FROM tbl_alumnos a
        INNER JOIN tbl_carreras c ON c.pk_carreras = a.fk_carreras
        INNER JOIN tbl_egresados e ON e.fk_alumnos = a.pk_alumno
        WHERE ".$opcion." 
        ORDER BY a.generacionSecre  DESC";
        $resp = @mysql_query($sql) or die(mysql_error());
        if(!$resp){
            return false;
        }else{
            $rows = array();
            while($rs = @mysql_fetch_object($resp)){
                $rows[] = $rs;
            }
            return $rows;
        }    
    }
    
}


function cumples($dia, $mes){
    $db = new database();
    if($db->conectar() == true ){
        $sql = "SELECT *
        FROM tbl_alumnos a
        WHERE MONTH(a.FechaNacimiento) = '$mes' 
        AND DAY(a.FechaNacimiento) = '$dia' 
        AND a.correo != ''
        ORDER BY matricula ASC";
        $resp = @mysql_query($sql) or die(mysql_error());
        if(!$resp){
            return false;
        }else{
            $rows = array();
            while($rs = @mysql_fetch_object($resp)){
                $rows[] = $rs;
            }
            return $rows;
        } 
    }
}


function obtenerAlumnoId($id){
    $db = new database();
    if($db->conectar() == true ){
        $sql = "SELECT tom.*,an.descripcion as planestudio,eg.*,e.descripcion AS desEstado,mun.descripcion AS desMuni,col.descripcion AS desCol,col.cod_postal,gn.descripcion AS descGeneracion,t.descripcion AS descTurno,m.nombreMod,c.clvCarrera,c.nombreCarrera,g.descripcion,a.* 
        FROM tbl_alumnos a
        INNER JOIN cat_genero g ON g.pk_genero = a.fk_genero
        INNER JOIN tbl_carreras c ON c.pk_carreras = a.fk_carreras
        INNER JOIN cat_modalidad m ON m.pk_modalidad = a.fk_modalidad
        INNER JOIN cat_turnos t ON t.pk_turnos = a.fk_turnos
        INNER JOIN cat_generacion gn ON gn.pk_generacion = a.fk_generacion
        INNER JOIN cat_colonia col ON col.pk_colonia = a.fk_colonia
        INNER JOIN cat_municipios mun ON mun.pk_ciudad = col.fk_municipio
        INNER JOIN cat_estado e ON e.pk_estado = mun.fk_estado
        INNER JOIN tbl_egresados eg ON eg.fk_alumnos = a.pk_alumno
        INNER JOIN cat_anios an ON an.pk_anios = a.planEstudios
        INNER JOIN tbl_tomadeprotesta tom ON tom.fk_alumno = a.pk_alumno
        WHERE pk_alumno = '$id' ";
        $resp = @mysql_query($sql) or die(mysql_error());
        if(!$resp){
            return false;
        }else{
            return $rows= @mysql_fetch_assoc($resp);
        }
    }
}


function nomCarrera($id){
    $db = new database();
    if($db->conectar() == true ){
        $sql = "SELECT * FROM tbl_carreras WHERE pk_carreras = '$id' ";
        $resp = @mysql_query($sql) or die(mysql_error());
        if(!$resp){
            return false;
        }else{
            $rows= @mysql_fetch_assoc($resp);
            return $rows['nombreCarrera'];
        }
    }
}

function nomOpciontitulacion($id){
    $db = new database();
    if($db->conectar() == true ){
        $sql = "SELECT * FROM cat_opciontitulacion WHERE pk_titulacion = '$id'";
        $resp = @mysql_query($sql) or die(mysql_error());
        if(!$resp){
            return false;
        }else{
            $rows= @mysql_fetch_assoc($resp);
            return $rows;
        }
    }
}

function nomProfesorSinodal($id){
    $db = new database();
    if($db->conectar() == true ){
        $sql = "SELECT * FROM tbl_profesores WHERE pk_sinodal = '$id'";
        $resp = @mysql_query($sql) or die(mysql_error());
        if(!$resp){
            return false;
        }else{
            $rows= @mysql_fetch_assoc($resp);
            return $rows['nombre'].' <strong>'.$rows['cedula'].'</strong>';
        }
    }
}
 

 function estadoCivilegresado($id){
    $db = new database();
    if($db->conectar() == true ){
        $sql = "SELECT * FROM cat_estadocivil WHERE Pk_estadocivil = '$id'";
        $resp = @mysql_query($sql) or die(mysql_error());
        if(!$resp){
            return false;
        }else{
            $rows= @mysql_fetch_assoc($resp);
            return $rows;
        }
    }
}  


function validarFolioTitulo($id, $folio, $nivel){
   $db = new database();
    if($db->conectar() == true ){
        //$sql = "SELECT * FROM tbl_egresados WHERE noactatitulo = TRIM('$folio') AND fk_alumnos !='$id'";
        $sql="SELECT * FROM tbl_alumnos a, tbl_egresados e 
        WHERE a.pk_alumno != '$id' 
        AND a.pk_alumno = e.fk_alumnos
        AND e.noactatitulo = TRIM('$folio') 
        AND a.fk_nivelestudio = '$nivel'";
        $resp = @mysql_query($sql) or die(mysql_error());
        if(!$resp){
            return false;
        }else{
            $num = @mysql_num_rows($resp);
            if($num != 0){
                return true;
            }else{
                return false;
            }
        }
    } 
}

function updateFolio($id, $folio){
    $db = new database();
    if($db->conectar() == true ){
        $sql = "UPDATE tbl_egresados SET noactatitulo = '$folio' WHERE pk_egresados = '$id'";
        $resp = @mysql_query($sql) or die(mysql_error());
        if(!$resp){
            return false;
        }else{
            return true;
        }
    } 
}

}
?>
