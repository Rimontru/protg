<?php

//Este Archivo contiene todas los INSERT que usaremos en el sistema
require('DB.class.php');

class InsertarDB {
    /* Atributos publicos */

    public $IdUsuario = "";
    public $Ip = "";
    public $Registro = "";
    public $CatOMod = "";

    //constructor	
    function InsertarDB($IdUsuario, $Ip, $CatOMod, $Registro) {

        $this->IdUsuario = $IdUsuario;
        $this->Ip = $Ip;
        $this->CatOMdo = $CatOMod;
        $this->Registro = $Registro;
    }

    function InsHistorialAcceso($IdUsuario, $IP, $CatOMod, $Registro) {
        $dbGuero = new database;
        if ($dbGuero->conectar() == true) {
            $query = "INSERT INTO tbl_historial_acceso  VALUES ('', '$IdUsuario', CURDATE(), CURTIME(), '$IP', '$CatOMod', '$Registro')";
            $result = @mysql_query($query) or die(mysql_error());
            if (!$result)
                return false;
            else
                return true;
        }
    }
    
    #AGREGADO: Ivan Mauricio Meneses Melo Granados
    #FECHA: 30/01/13 10:53 pm
    #MODULO AFECTADO: includes/ajax/Sistema/Usuario/Ins_Usuario.php
    #DESCRIPCION: Inserta un nuevo Registro en la Tabla Tbl_Usuario_Login
    # @params        $Zona
    # @return        True o False en funcion de la consulta
    function InsUsuarios($Usuario,$Password,$Nombre,$Fk_Empresa,$Correo){
            $dbPeon = new database;
       if($dbPeon->conectar()==true){
            $query = "INSERT INTO tbl_usuario_login VALUES ('NULL', '$Usuario', '$Password', UPPER('$Nombre'), 'Normal', '1', '$Correo', '0','$Fk_Empresa')";
            $result = @mysql_query($query);
            $Pk_Usuario_Login = mysql_insert_id();
            if (!$result) {
                return false;
            } else {
                if ($this->InsHistorialAcceso($this->IdUsuario, $this->Ip, $this->CatOMdo, $this->Registro))
                    return $Pk_Usuario_Login;
                else
                    return false;
            }
       }
     }

     #AGREGADO: Ivan Mauricio Meneses Melo Granados
    #FECHA: 30/01/13 10:53 pm
    #MODULO AFECTADO: includes/ajax/Sistema/Usuario/Ins_Usuario.php
    #DESCRIPCION: Inserta un nuevo Registro en la Tabla Tbl_Usuario_Login
    # @params        $Zona
    # @return        True o False en funcion de la consulta
    function InsRel_Login_Permisos($Fk_Usuario_Login,$Fk_CatMenu, $FkTituloMenu){
            $dbPeon = new database;
       if($dbPeon->conectar()==true){
            $query = "INSERT INTO rel_login_permisos VALUES ('NULL', '$Fk_Usuario_Login', '$Fk_CatMenu', '$FkTituloMenu')";
            $result = @mysql_query($query);
        if (!$result){
               return false;
        }else{
           if($this->InsHistorialAcceso($this->IdUsuario, $this->Ip, $this->CatOMdo, $this->Registro))
               return true;
           else
               return false;       
        }
       }
     }
 






     function InsMaterial($fk_laboratorios, $fk_clasematerial, $DescripcionMaterial, $CantidadMaterial, $MedidasMaterial, $Fk_TipoMaterial, $MarcaMaterial, $Fk_EstadoMaterial,$ObservacionesMaterial, $Almacenado, $Uso, $fk_frecuenciauso, $NumeroInventario, $Fk_UnidadMedida) {
        $dbPeon = new database;
        if ($dbPeon->conectar() == true) {
            $query = "INSERT INTO tbl_material VALUES ('','$fk_laboratorios', '$fk_clasematerial', '$DescripcionMaterial', '$CantidadMaterial', '$Fk_UnidadMedida', '$MedidasMaterial', '$Fk_TipoMaterial', '$MarcaMaterial', '$Fk_EstadoMaterial','$ObservacionesMaterial', '$Almacenado', '$Uso', '$fk_frecuenciauso', '$NumeroInventario', 1)";
            $result = @mysql_query($query) or die(mysql_error());
            if (!$result) {
                return false;
            } else {
                if ($this->InsHistorialAcceso($this->IdUsuario, $this->Ip, $this->CatOMdo, $this->Registro))
                    return true;
                else
                    return false;
            }
        }
    }

    
    
    

}

?>