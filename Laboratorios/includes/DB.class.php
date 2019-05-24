<?php
class database{
	
    private $conexion;
    public $conectado;
    private $registro;

    /**
     * Realiza la conexión con la base de datos
     * @params        string Nombre de la base de datos, string Nombre del host, string Usuario para acceder, string Clave del usuario
     * @return        True or False en función de su éxito
     */
    function conectar()
    {		
        $this->conectado = false;

        if ($this->conexion = mysql_connect(Config::DB_HOST, Config::DB_USER, Config::DB_PASS))
        {
            if (mysql_select_db(Config::DB_NAME,$this->conexion)) 
            {
                $this->conectado = true;
            }
        }    
        return $this->conectado;
    }
   
    /**Cierra la conexion con la base de datos**/
    function desconectar(){
        mysql_close($this->conexion);
    }
	
	public function fetch_array($consulta){
    	return mysql_fetch_array($consulta);
	}
	
	public function num_rows($consulta){
		return mysql_num_rows($consulta);
	}
	
	public function getTotalConsultas(){
		return $this->total_consultas;
	}
	
	public function consulta($consulta){
		$this->total_consultas++;
		$resultado = mysql_query($consulta,$this->conexion);
		if(!$resultado){
			echo 'MySQL Error: ' . mysql_error();
		exit;
		}
	  return $resultado;
	}
	
}
    
?>