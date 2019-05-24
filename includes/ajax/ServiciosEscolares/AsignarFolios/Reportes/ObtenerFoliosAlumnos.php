<?php
$Ruta = "../../../../";
require($Ruta . "Config.class.php");
require($Ruta . 'DB.class.php');
require($Ruta . "ConsultaDB.class.php");
require($Ruta . "MisFunciones.class.php");

$Funciones = new MisFunciones();
$consult = new ConsultaDB();

extract($_POST);


if(empty($fk_nivelestudio)){
   echo "<script type='text/javascript'>alertify.error('Seleccione el Nivel de Estudios');</script>";     
   exit();
}


if(empty($fk_modalidad)){
   echo "<script type='text/javascript'>alertify.error('Seleccione la Modalidad');</script>";    
   exit();
}


if(empty($fk_carreras)){
   echo "<script type='text/javascript'>alertify.error('Seleccione la Carrera');</script>";       
   exit();
}


if(empty($rangoFechas)){
   echo "<script type='text/javascript'>alertify.error('Seleccione un rango de fechas');</script>";  
   exit();
}


    $fechaSQL = explode("-",$rangoFechas);
    $fechaInicio=trim($fechaSQL[0]);
    $fechaFin=trim($fechaSQL[1]);
    
  //  01/07/2014 - 31/07/2014
    $fechaSQL = explode("/",$fechaInicio);
    $fechaInicio=$fechaSQL[2]."-".$fechaSQL[1]."-".$fechaSQL[0];   

    $fechaSQL = explode("/",$fechaFin);
    $fechaFin=$fechaSQL[2]."-".$fechaSQL[1]."-".$fechaSQL[0];   
    
    
$result = $consult->ConReporteDocumentacionAlumnos($fk_nivelestudio, $fk_modalidad, $fk_carreras, $fechaInicio, $fechaFin);
if ( mysql_num_rows( $result ) > 0 ) {
    echo '
        <table width="370"  border="0">';
    while ( $row = mysql_fetch_assoc( $result ) ) {
      echo ' <!--//<div class="form-group">
                //<label class="col-md-3 control-label" for="matricula_desc"> <font color="red">IDTramite</font> </label>
                //<div class="col-sm-6">
                  //  <input type="text" class="form-control" disabled="" value="' . $row["Pk_ExamenInstitucional"] . '"/>
                //</div>-->
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label" for="matricula_desc"><font color="green">Matricula</font></label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" disabled="" value="' . $row["matricula"] . '"/>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label" for="matricula_desc">Nombre</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" disabled="" value="' . $row["NombreCompleto"] . '"/>
                </div>
            </div>
            <!--<div class="form-group">
                <label class="col-md-3 control-label" for="matricula_desc">Matricula</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" disabled="" value="' . $row["matricula"] . '"/>
                </div>
            </div>-->
            <div class="form-group">
                <label class="col-md-3 control-label" for="matricula_desc">No. Folio</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control"  name="folioinstitucional[' . $row["Pk_ExamenInstitucional"] . ']" value="' . $row["folioInstitucional"] . '">
                </div>
            </div>

  ';
   echo '<input type="hidden" name="id[]" value="' . $row["Pk_ExamenInstitucional"] . '">  ' . "\n";
  
      
    }
    echo '</table>
       
         ';

}
 
 
 ?>