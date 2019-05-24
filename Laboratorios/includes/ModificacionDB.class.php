<?php
//Este Archivo contiene todas las consultas que usaremos en el sistema web del Guero
//Fecha: 24/Enero/2013 17:03 pm 
require('InsertarDB.class.php');
#require("ModificacionM.class.php");

//class ModificacionDB extends ModificacionM {
class ModificacionDB extends InsertarDB {
    //constructor	
    function ModificacionDB($IdUsuario, $Ip, $CatOMod, $Registro) {
        $this->IdUsuario = $IdUsuario;
        $this->Ip = $Ip;
        $this->CatOMdo = $CatOMod;
        $this->Registro = $Registro;
    }
    
    
          
    function ModificarMateriales($Pk_material, $fk_laboratorios, $fk_clasematerial, $DescripcionMaterial, $CantidadMaterial, $MedidasMaterial, $Fk_TipoMaterial, $MarcaMaterial, $Fk_EstadoMaterial, $ObservacionesMaterial, $Almacenado, $Uso, $fk_frecuenciauso, $NumeroInventario, $Fk_UnidadMedida)
    {
        $dbPeon = new database();    
        if ($dbPeon->conectar() == true) {
            $query = "UPDATE tbl_material SET fk_laboratorios='$fk_laboratorios', fk_clasematerial='$fk_clasematerial', DescripcionMaterial='$DescripcionMaterial', CantidadMaterial='$CantidadMaterial', MedidasMaterial='$MedidasMaterial', Fk_TipoMaterial='$Fk_TipoMaterial', MarcaMaterial='$MarcaMaterial', Fk_EstadoMaterial='$Fk_EstadoMaterial', ObservacionesMaterial='$ObservacionesMaterial', Almacenado='$Almacenado', Uso='$Uso', fk_frecuenciauso='$fk_frecuenciauso', NumeroInventario='$NumeroInventario', Fk_UnidadMedida='$Fk_UnidadMedida'  WHERE Pk_material='$Pk_material'";
                        
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

    
    
              
    function ModificarSalidasMateriales($Pk_material, $CantidadSalida)
    {
        $dbPeon = new database();    
        if ($dbPeon->conectar() == true) {
            $query = "UPDATE tbl_material SET CantidadMaterial='$CantidadSalida'  WHERE Pk_material='$Pk_material'";
                        
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