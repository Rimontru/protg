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
    function EliminarMateriales($Pk_material){
	$dbGuero = new database;	   			
	if($dbGuero->conectar()==true){
		$query = "UPDATE tbl_material
                          SET ActivoMaterial='0'
                          WHERE  Pk_material= '$Pk_material'";
		 $result = @mysql_query($query) or die (mysql_error());
		 if (!$result){
		   return false;
		 }else{
				return $result; 
			}					  
	 	} 
	}     
        
        
                 
    
}
?>