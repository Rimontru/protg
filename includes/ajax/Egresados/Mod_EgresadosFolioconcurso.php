<?php
$Ruta = "../../";
require($Ruta."Config.class.php");
require($Ruta."ModificacionDB.class.php");
require($Ruta."ConsultaDB.class.php");


session_name("PROTG2");                      // usamos la sesion de nombre definido.
session_start();                            // Iniciamos el uso de sesiones

$Consulta = new ConsultaDB;


if (empty( $_POST['pk_alumno']) || empty($_POST['folioConcurso']) || empty($_POST['matricula']) ) {
    echo "2|No se encontraron datos correctos";    
}
else{
	$pk_alumno = $_POST['pk_alumno'];
	$folioconcurso = $_POST['folioConcurso'];
		
		
	$acceso= ValidaFolioExistenteEgresado($pk_alumno);
	if($acceso==1){
		$result = ModificarFolioConcursoEgresados($pk_alumno, $folioconcurso);
		  if ($result){        
			  echo "1|Se Guardo Correctamente";
		  } 
		  else{
			  echo "2|Error al Guardar ";
		  }
	}	
	else{
	  echo "2|Ya existe un folio de concurso";
	}
}//fin del else empty
?>
