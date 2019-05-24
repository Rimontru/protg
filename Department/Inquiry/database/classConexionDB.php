<?php
class classConexionDB{
	# declare variables	
	public function conexionDB(){
		
		$_conex = mysql_connect(paramsDB::DB_HOST, paramsDB::DB_USER, paramsDB::DB_PASS) or die('_error: '.mysql_error());
    	if(!mysql_select_db(paramsDB::DB_NAME, $_conex)){
    		return FALSE;
    	}else {
    		@mysql_query(paramsDB::DB_CHARACTERS, $_conex);
			return $_conex;
    	}
	}
}#Fin de la clase conexion