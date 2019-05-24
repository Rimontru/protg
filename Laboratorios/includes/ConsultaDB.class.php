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
#DESCRIPCION: Seleccionamos todos los Usuarios de Tbl_Usuario_Login
# @params        
# @return        True ó False en función de la consulta 
function ConUsuarioLoginDatosPanel($usuario) {
        $dbIP = new database;
        if ($dbIP->conectar() == true) {
            $query = "SELECT * FROM Tbl_Usuario_Login 
INNER JOIN cat_departamento ON tbl_usuario_login.Fk_Departamento=Cat_Departamento.Pk_Departamento 
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
            $query="SELECT *, tbl_usuario_login.Nombre as NombreUsuarioNormal, cat_titulos_menu.Nombre AS NombreMenu
                    FROM Tbl_Usuario_Login
                    LEFT JOIN rel_login_permisos ON tbl_usuario_login.Pk_Usuario_Login = rel_login_permisos.Fk_Usuario_Login
                    LEFT JOIN cat_menu ON rel_login_permisos.Fk_CatMenu = Cat_Menu.idMenu
                    LEFT JOIN cat_titulos_menu ON cat_Titulos_Menu.idTituloMenu = rel_login_permisos.FkTituloMenu
                    WHERE Usuario = '$nombreUser'
                    AND Cat_Menu.idMenu != '7'
                    GROUP BY NombreMenu";
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
            $query = "SELECT * FROM cat_titulos_menu WHERE idTituloMenu!='5' ";
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
                          WHERE tbl_usuario_login.Pk_usuario_login = '$IdUsuario'
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
    
    
        
    function ConTipoMaterial(){
        $db =  new database;
        if($db->conectar() == true){
            $sql = "SELECT * FROM cat_tipomaterial WHERE ActivoTipoMaterial='1'";
            $result = @mysql_query($sql) or die(mysql_error());
            if(!$result){
                return false;
            }else{
                return $result;
            }
            
        }       
        
    }
    
    
      function ConLaboratorios(){
        $db =  new database;
        if($db->conectar() == true){
            $sql = "SELECT * FROM tbl_laboratorios WHERE ActivoLaboratorios='1'";
            $result = @mysql_query($sql) or die(mysql_error());
            if(!$result){
                return false;
            }else{
                return $result;
            }
            
        }       
        
    }
    
      function ConEstadoMaterial(){
        $db =  new database;
        if($db->conectar() == true){
            $sql = "SELECT * FROM cat_estadomaterial WHERE Activo_EstadoMaterial='1'";
            $result = @mysql_query($sql) or die(mysql_error());
            if(!$result){
                return false;
            }else{
                return $result;
            }
            
        }       
        
    }
    
    
    function Confrecuenciauso(){
        $db =  new database;
        if($db->conectar() == true){
            $sql = "SELECT * FROM cat_frecuenciauso WHERE activo_frecuenciauso='1'";
            $result = @mysql_query($sql) or die(mysql_error());
            if(!$result){
                return false;
            }else{
                return $result;
            }
            
        }       
        
    }
    
    
    
    
        
    function Conclasematerial(){
        $db =  new database;
        if($db->conectar() == true){
            $sql = "SELECT * FROM cat_clasematerial WHERE activo_clasematerial='1'";
            $result = @mysql_query($sql) or die(mysql_error());
            if(!$result){
                return false;
            }else{
                return $result;
            }
            
        }       
        
    }
    
    
     function Conunidadmedida(){
        $db =  new database;
        if($db->conectar() == true){
            $sql = "SELECT * FROM cat_unidadmedida WHERE Activo_UnidadMedida='1'";
            $result = @mysql_query($sql) or die(mysql_error());
            if(!$result){
                return false;
            }else{
                return $result;
            }
            
        }       
        
    }
       #FECHA: 22/01/14 15:23 pm 
    #DESCRIPCION: obtenemos los si existen registros
    # @return        True ó False en función de la consulta 
    function ConsultaMaterialesListadoAdmin(){
        $dbLuminarias = new database;
        if ($dbLuminarias->conectar() == true) {
            $query = "SELECT * FROM tbl_material
                      INNER JOIN tbl_laboratorios ON tbl_laboratorios.pk_laboratorios = tbl_material.fk_laboratorios
                      INNER JOIN cat_clasematerial ON cat_clasematerial.pk_clasematerial=tbl_material.fk_clasematerial
                      INNER JOIN cat_tipomaterial ON cat_tipomaterial.Pk_TipoMaterial =tbl_material.Fk_TipoMaterial
                      INNER JOIN cat_estadomaterial ON cat_estadomaterial.Pk_EstadoMaterial =tbl_material.Fk_EstadoMaterial
                      INNER JOIN cat_frecuenciauso ON cat_frecuenciauso.pk_frecuenciauso = tbl_material.fk_frecuenciauso
                      INNER JOIN cat_unidadmedida ON cat_unidadmedida.Pk_UnidadMedida = tbl_material.fk_UnidadMedida
                    WHERE ActivoMaterial='1' 
                     ";
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
    function ConsultaMaterialesListado($fk_laboratorios){
        $dbLuminarias = new database;
        if ($dbLuminarias->conectar() == true) {
            $query = "SELECT * FROM tbl_material
                      INNER JOIN tbl_laboratorios ON tbl_laboratorios.pk_laboratorios = tbl_material.fk_laboratorios
                      INNER JOIN cat_clasematerial ON cat_clasematerial.pk_clasematerial=tbl_material.fk_clasematerial
                      INNER JOIN cat_tipomaterial ON cat_tipomaterial.Pk_TipoMaterial =tbl_material.Fk_TipoMaterial
                      INNER JOIN cat_estadomaterial ON cat_estadomaterial.Pk_EstadoMaterial =tbl_material.Fk_EstadoMaterial
                      INNER JOIN cat_frecuenciauso ON cat_frecuenciauso.pk_frecuenciauso = tbl_material.fk_frecuenciauso
                      INNER JOIN cat_unidadmedida ON cat_unidadmedida.Pk_UnidadMedida = tbl_material.fk_UnidadMedida
                      WHERE fk_laboratorios='$fk_laboratorios' AND ActivoMaterial='1' 
                     ";
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
    function ConsultaMaterialesListadoReporteExcel($Parametros){
        $dbLuminarias = new database;
        if ($dbLuminarias->conectar() == true) {
            $query = "SELECT * FROM tbl_material
                      INNER JOIN tbl_laboratorios ON tbl_laboratorios.pk_laboratorios = tbl_material.fk_laboratorios
                      INNER JOIN cat_clasematerial ON cat_clasematerial.pk_clasematerial=tbl_material.fk_clasematerial
                      INNER JOIN cat_tipomaterial ON cat_tipomaterial.Pk_TipoMaterial =tbl_material.Fk_TipoMaterial
                      INNER JOIN cat_estadomaterial ON cat_estadomaterial.Pk_EstadoMaterial =tbl_material.Fk_EstadoMaterial
                      INNER JOIN cat_frecuenciauso ON cat_frecuenciauso.pk_frecuenciauso = tbl_material.fk_frecuenciauso
                      INNER JOIN cat_unidadmedida ON cat_unidadmedida.Pk_UnidadMedida = tbl_material.fk_UnidadMedida
                      WHERE tbl_material.ActivoMaterial='1' AND Pk_material!='' $Parametros
                     ";
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
    function ConsultaMaterialesListadoBusqueda($fk_laboratorios, $matricula_buscar){
        $dbLuminarias = new database;
        if ($dbLuminarias->conectar() == true) {
            $query = "SELECT * FROM tbl_material
                      INNER JOIN tbl_laboratorios ON tbl_laboratorios.pk_laboratorios = tbl_material.fk_laboratorios
                      INNER JOIN cat_clasematerial ON cat_clasematerial.pk_clasematerial=tbl_material.fk_clasematerial
                      INNER JOIN cat_tipomaterial ON cat_tipomaterial.Pk_TipoMaterial =tbl_material.Fk_TipoMaterial
                      INNER JOIN cat_estadomaterial ON cat_estadomaterial.Pk_EstadoMaterial =tbl_material.Fk_EstadoMaterial
                      INNER JOIN cat_frecuenciauso ON cat_frecuenciauso.pk_frecuenciauso = tbl_material.fk_frecuenciauso
                      INNER JOIN cat_unidadmedida ON cat_unidadmedida.Pk_UnidadMedida = tbl_material.fk_UnidadMedida
                      WHERE fk_laboratorios='$fk_laboratorios' AND ActivoMaterial='1' AND DescripcionMaterial LIKE '%$matricula_buscar%'
                    
                    ";
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
    function ConsultaMaterialesListadoBusquedaAdmin($matricula_buscar){
        $dbLuminarias = new database;
        if ($dbLuminarias->conectar() == true) {
            $query = "SELECT * FROM tbl_material
                      INNER JOIN tbl_laboratorios ON tbl_laboratorios.pk_laboratorios = tbl_material.fk_laboratorios
                      INNER JOIN cat_clasematerial ON cat_clasematerial.pk_clasematerial=tbl_material.fk_clasematerial
                      INNER JOIN cat_tipomaterial ON cat_tipomaterial.Pk_TipoMaterial =tbl_material.Fk_TipoMaterial
                      INNER JOIN cat_estadomaterial ON cat_estadomaterial.Pk_EstadoMaterial =tbl_material.Fk_EstadoMaterial
                      INNER JOIN cat_frecuenciauso ON cat_frecuenciauso.pk_frecuenciauso = tbl_material.fk_frecuenciauso
                      INNER JOIN cat_unidadmedida ON cat_unidadmedida.Pk_UnidadMedida = tbl_material.fk_UnidadMedida
                      WHERE ActivoMaterial='1' AND DescripcionMaterial LIKE '%$matricula_buscar%'
                    
                    ";
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
    function ConsultaMaterialesLlavePrimaria($Pk_material){
        $dbLuminarias = new database;
        if ($dbLuminarias->conectar() == true) {
            $query = "SELECT * FROM tbl_material
                      INNER JOIN tbl_laboratorios ON tbl_laboratorios.pk_laboratorios = tbl_material.fk_laboratorios
                      INNER JOIN cat_clasematerial ON cat_clasematerial.pk_clasematerial=tbl_material.fk_clasematerial
                      INNER JOIN cat_tipomaterial ON cat_tipomaterial.Pk_TipoMaterial =tbl_material.Fk_TipoMaterial
                      INNER JOIN cat_estadomaterial ON cat_estadomaterial.Pk_EstadoMaterial =tbl_material.Fk_EstadoMaterial
                      INNER JOIN cat_frecuenciauso ON cat_frecuenciauso.pk_frecuenciauso = tbl_material.fk_frecuenciauso
                      WHERE Pk_material='$Pk_material'
                     ";
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
    function ConsultaClaseMaterialesCantidadHOMEUser($fk_laboratorios){
        $dbLuminarias = new database;
        if ($dbLuminarias->conectar() == true) {
            $query = "SELECT *  FROM tbl_material
                      INNER JOIN tbl_laboratorios ON tbl_laboratorios.pk_laboratorios = tbl_material.fk_laboratorios
                      INNER JOIN cat_clasematerial ON cat_clasematerial.pk_clasematerial=tbl_material.fk_clasematerial
                      INNER JOIN cat_tipomaterial ON cat_tipomaterial.Pk_TipoMaterial =tbl_material.Fk_TipoMaterial
                      INNER JOIN cat_estadomaterial ON cat_estadomaterial.Pk_EstadoMaterial =tbl_material.Fk_EstadoMaterial
                      INNER JOIN cat_frecuenciauso ON cat_frecuenciauso.pk_frecuenciauso = tbl_material.fk_frecuenciauso
                      WHERE fk_laboratorios='$fk_laboratorios'
                     ";
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
    function ConsultaClaseMaterialesCantidadHOMEAdmin(){
        $dbLuminarias = new database;
        if ($dbLuminarias->conectar() == true) {
            $query = "SELECT *  FROM tbl_material
                      INNER JOIN tbl_laboratorios ON tbl_laboratorios.pk_laboratorios = tbl_material.fk_laboratorios
                      INNER JOIN cat_clasematerial ON cat_clasematerial.pk_clasematerial=tbl_material.fk_clasematerial
                      INNER JOIN cat_tipomaterial ON cat_tipomaterial.Pk_TipoMaterial =tbl_material.Fk_TipoMaterial
                      INNER JOIN cat_estadomaterial ON cat_estadomaterial.Pk_EstadoMaterial =tbl_material.Fk_EstadoMaterial
                      INNER JOIN cat_frecuenciauso ON cat_frecuenciauso.pk_frecuenciauso = tbl_material.fk_frecuenciauso
                  
                     ";
            $result = @mysql_query($query) or die(mysql_error());
            if (!$result)
                return false;
            else
                return $result;
        }
    }
}
?>