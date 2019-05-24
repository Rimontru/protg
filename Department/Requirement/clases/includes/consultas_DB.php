<?php
$db = new conexion;
class consultas{
	
	public function verPeriodos(){
		$db = new conexion;
		$sql="SELECT * FROM cat_periodos";
		$result=$db->executeQuery($sql);
		if(!$result){
			return false;
		}
		else{
			return $result;
		}
	}
	
	public function verPeriodoPDF($fech_periodo){
		$db = new conexion;
		$sql="SELECT * FROM cat_periodos WHERE fecha_inicial='".$fech_periodo."'";
		$result=$db->executeQuery($sql);
		if(!$result){
			return false;
		}
		else{
			return $result;
		}
	}
	
	public function verPreguntas(){
		$db = new conexion;
		$sql="SELECT * FROM cat_preguntas";
		$result=$db->executeQuery($sql);
		if(!$result){
			return false;
		}
		else{
			return $result;
		}
	}
	
	public function verPreguntaPDF($pk_pregunta){
		$db = new conexion;
		$sql="SELECT * FROM cat_preguntas WHERE pk_pregunta=".$pk_pregunta;
		$result=$db->executeQuery($sql);
		if(!$result){
			return false;
		}
		else{
			return $result;
		}
	}
	
	public function CuentaRespuestasPorNoDePregunta($pregunta,$periodo){
	 $per=explode('|',$periodo); $inicial=$per[0]; $final=$per[1];
	$db = new conexion;
		$exe=1;
		if($exe==1){
			$sql="
			SELECT COUNT(*) AS MALO 
			FROM rel_encuestas 
			WHERE fk_opcion=".$exe."
			AND fk_pregunta=".$pregunta." 
			AND fecha_registro 
			BETWEEN '".$inicial."' AND '".$final."'";
				$result=$db->executeQuery($sql);
				$row=$db->getRows($result);
				$MA=$row['MALO'];
			$exe++;
		}
		if($exe==2){
			$sql="
			SELECT COUNT(*) AS REGULAR 
			FROM rel_encuestas 
			WHERE fk_opcion=".$exe."
			AND fk_pregunta=".$pregunta." 
			AND fecha_registro 
			BETWEEN '".$inicial."' AND '".$final."'";
				$result=$db->executeQuery($sql);
				$row=$db->getRows($result);
				$RE=$row['REGULAR'];
			$exe++;
		}
		if($exe==3){
			$sql="
			SELECT COUNT(*) AS BUENO 
			FROM rel_encuestas 
			WHERE fk_opcion=".$exe." 
			AND fk_pregunta=".$pregunta."
			AND fecha_registro 
			BETWEEN '".$inicial."' AND '".$final."'";
				$result=$db->executeQuery($sql);
				$row=$db->getRows($result);
				$BU=$row['BUENO'];
			$exe++;
		}
		if($exe==4){
			$sql="
			SELECT COUNT(*) AS EXCELENTE 
			FROM rel_encuestas 
			WHERE fk_opcion=".$exe."
			AND fk_pregunta=".$pregunta." 
			AND fecha_registro 
			BETWEEN '".$inicial."' AND '".$final."'";
				$result=$db->executeQuery($sql);
				$row=$db->getRows($result);
				$EX=$row['EXCELENTE'];
			$exe++;
		}
		if(!$result){
			return false;
		}
		elseif($exe==5){
			return $MA.'|'.$RE.'|'.$BU.'|'.$EX;
		}
	}
	
	function CuentaEltotalDePersonasPorPeriodo($periodo){
		$per=explode('|',$periodo); $inicial=$per[0]; $final=$per[1];
		$db = new conexion;
		$sql="
			SELECT
			COUNT(pk_encuesta) AS TotalPersonas
			FROM(
			SELECT *
			FROM rel_encuestas
			WHERE fecha_registro
			BETWEEN '".$inicial."' AND '".$final."'
			GROUP BY pk_encuesta)
			AS new_tbl_group";
		$result=$db->executeQuery($sql);
		if(!$result){
			return false;
		}
		else{
			return $result;
		}
	}
	
	
}#fin clase
?>
	
