<?php
//Este Archivo contiene todas las consultas que usaremos en el sistema
require('DB.class.php');

class EliminarDB{
 //constructor	
 function EliminarDB($IdUsuario, $Ip, $CatOMod, $Registro){
    $this->IdUsuario = $IdUsuario;
    $this->Ip = $Ip;    
    $this->CatOMdo = $CatOMod;
    $this->Registro = $Registro;
 }
 
  //************************ Ivan Mauricio Meneses Melo Granados ********************//
    
    function EliminarInstitucion($pk_dtgenerales){
	$dbGuero = new database;	   			
	if($dbGuero->conectar()==true){
		$query = "UPDATE tbl_escuela SET escuelaActiva='0' WHERE  pk_dtgenerales= '$pk_dtgenerales'";
		 $result = @mysql_query($query) or die (mysql_error());
		 if (!$result){
		   return false;
		 }else{
				return $result; 
			}					  
	 	} 
	}     
 
        
        function RecuperarBajaInstitucion($pk_dtgenerales){
	$dbGuero = new database;	   			
	if($dbGuero->conectar()==true){
		$query = "UPDATE tbl_escuela SET escuelaActiva='1' WHERE  pk_dtgenerales= '$pk_dtgenerales'";
		 $result = @mysql_query($query) or die (mysql_error());
		 if (!$result){
		   return false;
		 }else{
				return $result; 
			}					  
	 	} 
	}     
 
        
        
      function EliminarGeneracion($pk_generacion){
	$dbGuero = new database;	   			
	if($dbGuero->conectar()==true){
		$query = "UPDATE cat_generacion SET activo='0' WHERE  pk_generacion= '$pk_generacion'";
		 $result = @mysql_query($query) or die (mysql_error());
		 if (!$result){
		   return false;
		 }else{
				return $result; 
			}					  
	 	} 
	}   
        
        
        
        
     function RecuperarBajaGeneracion($pk_generacion){
	$dbGuero = new database;	   			
	if($dbGuero->conectar()==true){
		$query = "UPDATE cat_generacion SET activo='1' WHERE  pk_generacion= '$pk_generacion'";
		 $result = @mysql_query($query) or die (mysql_error());
		 if (!$result){
		   return false;
		 }else{
				return $result; 
			}					  
	 	} 
	}   
        
        
        
            
    function EliminarSinodales($pk_sinodal, $pk_carreras){
	$dbGuero = new database;	   			
	if($dbGuero->conectar()==true){
		$query = "UPDATE tbl_profesores
                          INNER JOIN rel_profesorcarrera ON rel_profesorcarrera.fk_sinodal = tbl_profesores.pk_sinodal

                          SET rel_profesorcarrera.activoRel='0'
                          WHERE  tbl_profesores.pk_sinodal= '$pk_sinodal' 
                          AND rel_profesorcarrera.fk_carreras='$pk_carreras'
   
                          ";
		 $result = @mysql_query($query) or die (mysql_error());
		 if (!$result){
		   return false;
		 }else{
				return $result; 
			}					  
	 	} 
	}     
        
        
                 
    function EliminarSinodalesBaja($pk_sinodal, $pk_carreras){
	$dbGuero = new database;	   			
	if($dbGuero->conectar()==true){
		$query = "UPDATE tbl_profesores
                          INNER JOIN rel_profesorcarrera ON rel_profesorcarrera.fk_sinodal = tbl_profesores.pk_sinodal

                          SET rel_profesorcarrera.activoRel='1'
                          WHERE  tbl_profesores.pk_sinodal= '$pk_sinodal' 
                          AND rel_profesorcarrera.fk_carreras='$pk_carreras'
   ";
		 $result = @mysql_query($query) or die (mysql_error());
		 if (!$result){
		   return false;
		 }else{
				return $result; 
			}					  
	 	} 
	}     
 
 
            
      
//************************ cesar  ********************//        
    function EliminarCarrera($idCarrera){
        $dbPeon = new database;	   			
        if($dbPeon->conectar()==true){
            $sql = "UPDATE tbl_carreras SET estadoCarrera='0' WHERE pk_carreras= '$idCarrera'";
            $result = @mysql_query($sql) or die (mysql_error());
            if (!$result){
                return false;
            }else{
                return $result; 
            }					  
        }
        
    } 
    
     function Recuperarcarrera($idCarrera){
        $dbPeon = new database;	   			
        if($dbPeon->conectar()==true){
            $sql = "UPDATE tbl_carreras SET estadoCarrera='1' WHERE pk_carreras= '$idCarrera'";
            $result = @mysql_query($sql) or die (mysql_error());
            if (!$result){
                return false;
            }else{
                return $result; 
            }					  
        }
        
    }
    
    
    function EliminaUser($id){
        $dbPeon = new database();
        if($dbPeon->conectar() == true){
            $sql="UPDATE rel_trabajadorecarreras SET activoPersona='0' WHERE pk_rel_trbajadorescarreras = '$id'";
            $result = @mysql_query($sql);
                if(!$result){
                    return false;
                }else{
                    return $result;
                }
        }
    }
    
    
       function Recuperarusuarios($idUser){
        $dbPeon = new database;	   			
        if($dbPeon->conectar()==true){
            $sql = "UPDATE rel_trabajadorecarreras SET activoPersona='1' WHERE pk_rel_trbajadorescarreras = '$idUser'";
            $result = @mysql_query($sql) or die (mysql_error());
            if (!$result){
                return false;
            }else{
                return $result; 
            }					  
        }
        
    }

/////*********************************Anibal**********************//

    function EliminarEmpleador($idEmpleador){
        $dbPeon = new database;	   			
        if($dbPeon->conectar()==true){
            $sql = "DELETE FROM tbl_empleadores WHERE pk_empleador= '$idEmpleador'";
            $result = @mysql_query($sql) or die (mysql_error());
            if (!$result){
                return false;
            }else{
                return $result; 
            }					  
        }
        
    } 
    
}
?>