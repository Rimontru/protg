<?php 
$Ruta = "../../";
require($Ruta . "Config.class.php");  # Cargar datos conexion y otras variables.
require($Ruta . "InsertarDB.class.php");
require($Ruta . "ConsultaDB.class.php");
require($Ruta . "MisValidaciones.class.php");

extract($_POST);
$Consulta = new ConsultaDB;

$row = $Consulta->obtenerAlumnoId($id);
$date = date_create($row['FechaTomaProtesta']);
$fSolicitud = date_create($row['FechaSolicitud']);
$fExa = date_create($row['FechaExamen']);
$fechaExpeTitulo = date_create($row['fechaexpediciontitulo']);
$fechaEntregaCredencial = date_create($row['fechaEntregaCredencial']);

if($row['fk_estadoTitulacion'] == 1){
  $stdTitulacion = 'Titulado';
}else if($row['fk_estadoTitulacion'] == 2){
  $stdTitulacion = 'No Titulado';
}else{
  $stdTitulacion = 'No aplica';
}

if($row['estatusTrabajo'] == 1){
  $trabaj = "Si";
}else{
  $trabaj = "No";
}

if($row['estatusCredencial'] == 1){
  $stdCredencial = 'Entregada';
}else if($row['estatusCredencial'] == 2){
  $stdCredencial = 'No entregada';
}else{
  $stdCredencial = '';
}

//OBTENER OPCION DE TITULACION
$titulacion = $Consulta->nomOpciontitulacion($row['fk_titulacion']);

//OBTENER EL ESTADO CIVIL
$estCivil = $Consulta->estadoCivilegresado($row['fk_estadocivil_egresados']);

if($row){
  echo '';
	echo '<div class="row"><img src="profile-photos/'.$row['matricula'].'/'.$row['matricula'].'.jpg" class="img-circle" style="position:absolute; top:10px; right:30px;float:right"><div class="col-lg-12">';
	echo '<h4>'.utf8_encode($row['nombre'].' '.$row['apaterno'].' '.$row['amaterno']).'</h4>';
	echo '<dl class="dl-horizontal">
              <dt>Matricula:</dt>
              <dd>'.$row['matricula'].'. </dd>
              
              <dt>Fecha de Nacimiento:</dt>
              <dd>'.$row['FechaNacimiento'].'.</dd>
              
              <dt>E-mail:</dt>
              <dd>'.$row['correo'].'.</dd>
              
              <dt>Teléfono:</dt>
              <dd>'.$row['telefonofijo'].'.</dd>
              
              <dt>Celular:</dt>
              <dd>'.$row['telefonocelular'].'.</dd>
              
              <dt>Curp:</dt>
              <dd>'.$row['curp'].'.</dd>
              
              <dt>Dirección:</dt>
              <dd>'.$row['direccion'].'.</dd>
              
              <dt>Codigo Postal:</dt>
              <dd>'.$row['codigopostal'].'.</dd>

              <dt>Colonia:</dt>
              <dd>'.$row['desCol'].'.</dd>

              <dt>Municipio:</dt>
              <dd>'.$row['desMuni'].'.</dd>
              
              <dt>Estado:</dt>
              <dd>'.$row['desEstado'].'.</dd>
            </dl>';

	echo '</div></div>';	

	echo '<div class="row"><div class="col-lg-12">';
	echo '<h4>'.utf8_encode($row['nombreCarrera']).'</h4>';	
	echo '<dl class="dl-horizontal">
              <dt>Modalidad:</dt>
              <dd>'.$row['nombreMod'].'.</dd>
              
              <dt>Turno:</dt>
              <dd>'.$row['descTurno'].'.</dd>
              
              <dt>Plan de Estudio:</dt>
              <dd>'.$row['planestudio'].'.</dd>
              
              <dt>Promedio:</dt>
              <dd>'.$row['promedio'].'.</dd>
              
              <dt>Letra Promedio:</dt>
              <dd>'.$row['letraPromedio'].'.</dd>
              
              <dt>Generación:</dt>
              <dd>'.$row['descGeneracion'].'.</dd>
              
              <dt>Número de Generación :</dt>
              <dd>'.$row['generacionNumero'].'.</dd>
            </dl>';
    echo '</div></div>';	

    echo '<div class="row"><div class="col-lg-12">';
	echo '<h4>TOMA DE PROTESTA</h4>';	
	echo '<dl class="dl-horizontal">
              <dt>Fecha:</dt>
              <dd>'.date_format($date, 'd/m/Y').'.</dd>
              
              <dt>Hora:</dt>
              <dd>'.$row['hora'].'.</dd>
              
              <dt>Salón:</dt>
              <dd>'.$row['salon'].'.</dd>
              
              <dt>Opción Titulación:</dt>
              <dd>'.$titulacion['Nombre'].'.</dd>';

      if($row['fk_titulacion'] == 7 || $row['fk_titulacion'] == 10 || $row['fk_titulacion'] == 12 ){        
        echo '<dt>Nombre Tesis:</dt>
              <dd>'.$row['nombreTesis'].'.</dd>';
      }        
      echo '<dt>Presidente:</dt>
              <dd>'.$Consulta->nomProfesorSinodal($row['presidente']).'.</dd>
              
              <dt>Secretario:</dt>
              <dd>'.$Consulta->nomProfesorSinodal($row['secretario']).'.</dd>

              <dt>Vocal:</dt>
              <dd>'.$Consulta->nomProfesorSinodal($row['vocal']).'.</dd>

              <dt>Fecha Solicitud:</dt>
              <dd>'.date_format($fSolicitud, 'd/m/Y').'.</dd>

              <dt>Fecha Examen:</dt>
              <dd>'.date_format($fExa, 'd/m/Y').'.</dd>

              <dt>Número de Autorización:</dt>
              <dd>'.$row['NumeroAutorizacion'].'.</dd>

              <dt>Folio Acta:</dt>
              <dd>'.$row['FolioActa'].'.</dd>

              <dt>Folio de Timbre de Acta:</dt>
              <dd>'.$row['folioTimbreActa'].'.</dd>
            </dl>';
    echo '</div></div>';	

    echo '<div class="row"><div class="col-lg-12">';
	echo '<h4>DATOS DE EGERESADO</h4>';	
	echo '<dl class="dl-horizontal">
              <dt>Estado Titulación:</dt>
              <dd>'.$stdTitulacion.'.</dd>
              
              <dt>Trabajo: </dt>
              <dd>'.$trabaj.'.</dd>
              
              <dt>Maestria: </dt>
              <dd>'.$row['mtriaNombre'].'.</dd>
              
              <dt>Doctorado: :</dt>
              <dd>'.$row['doctoradoNombre'].'.</dd>
              
              <dt>Especialidad: </dt>
              <dd>'.$row['especialidadNombre'].'.</dd>
              
              <dt>Folio Titulo:</dt>
              <dd>'.$row['noactatitulo'].'.</dd>
              
              <dt>Folio. Timbre Titulo:</dt>
              <dd>'.$row['folioTimbreTitulo'].'.</dd>

              <dt>Fecha Expedición de Titulo:</dt>
              <dd>'.date_format($fechaExpeTitulo, 'd/m/Y').'.</dd>

              <dt>Credencial Entregada:</dt>
              <dd>'.$stdCredencial.'.</dd>

              <dt>Edad de Egreso:</dt>
              <dd>'.$row['edadEgreso'].'.</dd>

              <dt>Fecha Entregad de Credencial:</dt>
              <dd>'.date_format($fechaEntregaCredencial, 'd/m/Y').'.</dd>

              <dt>Estado Civil:</dt>
              <dd>'.$estCivil['descripcion_estadocivil'].'.</dd>
            
            </dl>';
    echo '</div></div>';
}


?>