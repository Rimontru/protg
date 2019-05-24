<?php
class conexion {
    private $conex=NULL;
    public $_error;
	
    public function conexion(){
		$this->conex=mysql_connect(paramsDB::DB_HOST, paramsDB::DB_USER, paramsDB::DB_PASS);
        mysql_select_db(paramsDB::DB_NAME, $this->conex);
		mysql_query(paramsDB::DB_CHARACTERS);
    }
	
	public function desconexion(){
        mysql_close($this->conex);
    }
	
    public function executeQuery($sql){
        $this->_error="0";
		//$sql=mysql_real_escape_string($sql);
		if(!$vals=mysql_query($sql, $this->conex))
		{
			$this->_error=mysql_error();
			return($this->_error);
		}
		else
			return $vals;
    }									/*GET=OBTENER   POST=ENVIAR  ROW=FILA  FIELD=CAMPO ROW FETCHED= FILA RECUPERADA*/

    public function getRows($resultado){         /*HA OBTENIDO FILAS*/
        $rows=mysql_fetch_assoc($resultado);
        return $rows;
    }
	
	public function getNRows($resultado){        /*HA OBTENIDO UN NUMERO DE FILAS QUE EXISTAN CON EL TIPO DE BUSQUEDA*/
		return(mysql_num_rows($resultado));
	}
	
    public function getIdName($table){
        $sql="SELECT * FROM " . $tabla;
        $result=mysql_query($sql,$this->conex);
        return(mysql_field_name($result,0));
    }
    public function getExist($table,$fieldName,$value){
      $sql="SELECT * FROM " . $table . " WHERE " . $fieldName . "='" . $value . "'";
      $result=mysql_query($sql,$this->conex);
      if(mysql_num_rows($result)>0)
         return(1);
      else
         return(0);
    }
    public function genIndex($table,$noField)
	{
        $sql="SELECT * FROM " . $table;
        $registros=mysql_query($sql,$this->conex);
        if (mysql_num_rows($registros)==0)
        {
            return(1);
        }
        else
        {
            $sql1="SELECT MAX(" . mysql_field_name($registros,$noField) . ") FROM " . $table;
            $registros1=mysql_query($sql1,$this->conex) or die ($this->_error="ERROR al encontrar el maximo: " . mysql_error());
            $reg=mysql_fetch_array($registros1);
            $numid=$reg[mysql_field_name($registros1,0)];
            return($numid + 1);
        }
    }
	
	public function genIndexFecha($table,$noField,$anhio,$noFieldAnhio)
	{
		$sql="SELECT * FROM " . $table . " WHERE " . $noFieldAnhio . "=" . $anhio;
        $registros=mysql_query($sql,$this->conex);
        if (mysql_num_rows($registros)==0)
        {
            return(1);
        }
        else
        {
            $sql1="SELECT MAX(" . mysql_field_name($registros,$noField) . ") FROM " . $table . " WHERE " . $noFieldAnhio . "=" . $anhio;
            $registros2=mysql_query($sql1,$this->conex) or die ($this->_error="ERROR al encontrar el maximo: " . mysql_error());
            $reg=mysql_fetch_array($registros2);
            $numid=$reg[mysql_field_name($registros2,0)];
            return($numid + 1);
        }
	}

	//FUNCIONES PARA EJECUTAR LAS TRANSACCIONES
	public function execQueryTrans($sql)
	{
		if(!mysql_query($sql, $this->conex))
		{
			$this->_error= "en la consulta: " . $sql . " [" . mysql_error() . "]";
			return(0);
		}
		else
			return (1);
    }
	//************************************************************
	public function startTransaction()
    {
	    if(mysql_query("START TRANSACTION"))
			return(1);
		else
			return(0);
    }
 	//************************************************************
	public function breakTransaction()
    {
	    $msg = "Transaccion abortada debido a un error ";
    	mysql_query("ROLLBACK");
    	return($msg);
    }
 	//************************************************************
	public function commitTransaction()
    {
	    mysql_query("COMMIT");
    }
	
	//*************************************************************
	public function id_ultimo()
	{
		return @mysql_insert_id();  
	} 
	
	//*************************************************************
	
	public function getQueryInsertForm($table,$cadena)
	{
		$campos= explode('|',$cadena);
		
		foreach($campos as &$valor)
		{
			$s= explode('=',$valor);
			$fields.=$s[0] . ",";
			$values.="'" . $s[1] . "',";
		}
		$fields=trim($fields,',');
		$values=trim($values,',');
		$query="INSERT INTO " . $table . "(". $fields . ") VALUES (" . $values . ")" ;
		return($query);
	}
	
	public function getQueryUpdateForm($table,$cadena,$nomId,$id,$tipo)
	{
		$campos= explode('|',$cadena);
		
		foreach($campos as &$valor)
		{
			$s= explode('=',$valor);
			$fields.=$s[0] . "='" . $s[1] . "',";
		}
		$fields=trim($fields,',');
		if($tipo=='n')
			$query="UPDATE " . $table . " SET ". $fields . " WHERE " .$nomId . " = " . $id;
		else
			$query="UPDATE " . $table . " SET ". $fields . " WHERE " .$nomId . " = '" . $id . "'";
		return($query);
	}
	
	public function getQueryDelete($table,$nomId,$id,$tipo)
	{
		if($tipo=='n')
			$query="DELETE FROM " . $table . " WHERE " . $nomId . " = " . $id;
		else
			$query="DELETE FROM " . $table . " WHERE " . $nomId . " = '" . $id . "'";
		return($query);
	}
	
	public function getQueryBlock($table,$nomId,$id,$tipo){
		if($tipo=='n')
			$query="UPDATE " . $table . " SET edo=0 WHERE " . $nomId . " = " . $id;
		else
			$query="UPDATE " . $table . " SET edo=0 WHERE " . $nomId . " = '" . $id . "'";
		return($query);
	}
}#Fin de la clase conexion
class funEspecial{
	public function FormatoHora($hora){
		$hr=explode(":",$hora);
		$hor=$hr[0];
		$index=substr($hor,0,1);
		$min=$hr[1];
		if($index==0 || $hor==00 || $hor==10 || $hor==11){
			$newHora=$hor.":".$min." am";
				return $newHora;
		}
		else{
			$arrayConver=array
			('12'=>12,'13'=>1,'14'=>2,'15'=>3,'16'=>4,'17'=>5,'18'=>6,'19'=>7,'20'=>8,'21'=>9,'22'=>10,'23'=>11,'24'=>12);
			$conv=$arrayConver;
			$newHora=$conv[$hor].":".$min." pm";
				return $newHora;
		}
	}
	
	public function acentua($string){
		$Mystring = strtr($string, "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÜÚ", "àáâãäåæçèéêëìíîïðñòóôõöøùüú");
		return $Mystring;
	}
}
?>
	
