<?php

require_once("../../../../../includes/Config.class.php");  # Cargar datos conexion y otras variables.
require_once('../../../../../includes/DB.class.php');
require_once('../../../../../includes/ConsultaDB.class.php');
require_once('../../../../../includes/MisFunciones.class.php');
require_once('../../../../../includes/ConvertirNumLetra.php');
require_once('../../../../../includes/DeNumero_a_Letras.php');
require_once('../../../../../mpdf/mpdf.php');


$Obras = new ConsultaDB;
$Funciones = new MisFunciones;
$today = date("d-m-Y");

//obtenemos fecha actual y cambiamos el formato de vista
$fechaActual = strftime("%Y-%m-%d", time());
$fechaActualModificar = explode("-", $fechaActual);
$fechaActualLista = $fechaActualModificar[0] . "-" . $fechaActualModificar[1] . "-" . $fechaActualModificar[2];
$fechaLetras = $Funciones->Fecha2Mayusculas($fechaActualLista);

$fechaDividir = explode("DE", $fechaLetras);
$fechaDia = $fechaDividir[0];
$fechaMes = $fechaDividir[1];
$fechaAnio = $fechaDividir[2];


if (isset($_GET['pk_alumno'])) {


    $pk_alumno = $_GET['pk_alumno'];
    $CicloEscolarPromt = $_GET['CicloEscolarPromt'];


    //DATOS DE LA ESCUELA
    $Result32 = $Obras->ConsultaDatosInsitucionConEstados();
    if ($Result32) {
        $row333 = mysql_fetch_assoc($Result32);

        $nombreInstitucion = $row333['nombreInstitucion'];
        $apodoInstitucion = $row333['apodoInstitucion'];
        $clave = $row333['clave'];
        $direccion = $row333['direccion'];
        $telefono = $row333['telefono'];
        $ciudad = $row333['CiudadEscuela'];
        $estado = $row333['EstadoEscuela'];
        $fechaIncorporacionsecretaria = $row333['fechaIncorporacionSrecetaria'];
        $numerooficio = $row333['noOficio'];
        $registro = $row333['registro'];
        $regimen = $row333['regimen'];
        $paginainternet = $row333['paginaInternet'];
        $lemaescuela = $row333['lemaEscuela'];
    }

    
    




    $result = $Obras->ConReporteDocumentacionAlumnosPorLlavePrimaria($pk_alumno);
    while ($row = mysql_fetch_assoc($result)) {


        //$tomaprotestaLetras = $Funciones->Fecha2Mayusculas($row[FechaTomaProtesta]);
        //$fechaLista = ($row[FechaTomaProtestaReporte]);



        //DATOS DEL DIRECTOR
        $fk_carreras = $row[fk_carreras];
        $Result22 = $Obras->verTrabajadoresDirectoresReportes($fk_carreras);
        if ($Result22) {
            $row222 = mysql_fetch_assoc($Result22);
            $nombreDirector = ($row222[nombre] . " " . $row222[apaterno] . " " . $row222[amaterno]);
            $carreraReporte = ($row222[nombreCarrera]);
            $genero = $row222[fk_genero];
            mysql_free_result($Result22);
        }



       $noacuerdo = $row[noacuerdo];
       $fechaExpedicion = strtolower($row[fechaExpedicion]);
     //  $fechaVigente
//saber si es fecha o vigente 1=fecha 2=vigente
        if($row[TipoRevoe]=='1'){
            
            $fechaVigente="FECHA ";
        }else if($row[TipoRevoe]=='2'){
            $fechaVigente="VIGENTE ";
        }
        
         $apaterno = $row[ApaternoAlumno];
         $amaterno= $row[AmaternoAlumno];
         $nombre= $row[NombreAlumno];
         $curp = $row[curp];
         $matricula = $row[matricula];
         $planestudio = $row[PlanEstudiosNombre];
         $promedio = $row[promedio];
         $letraPromedio = $row[letraPromedio];
        
        
         //sinodales
         $presidente = $row[NombrePresidente];
         $cedula1= $row[CedulaPresidente];
         
         $secretario= $row[NombreSecretario];
         $cedula2= $row[CedulaSecretario];
                 
         $vocal= $row[NombreVocal];
         $cedula3= $row[CedulaVocal];
                 
         $suplente= $row[NombreSuplente];
         $cedula4  = $row[CedulaSuplente];
         
         
         
         
//FECHA DE SOLICITUD $fechasolicitud
//$fechasolicitud = $row[FechaSolicitud];
//FECHA EXAMEN 
//$fechaListaProtesta= $row[FechaExamen];
//TOMA DE PROTESTA 
//$fechaLista= $row[FechaTomaProtestaReporte];

$hora = $row[hora];
$duracion = $row[DescripcionDuracion];
$autorizacion = $row[NumeroAutorizacion];


 $tomaprotestaLetras = $Funciones->Fecha2Mayusculas($row[FechaTomaProtesta]);
        $fechaLista = ($row[FechaTomaProtestaReporte]);

        //obtenemos fecha actual y cambiamos el formato de vista
        //$FechaTomaProtesta = strftime("%Y-%m-%d", time());
        $FechaTomaProtesta = $row['FechaTomaProtesta'];
        $FechaTomaProtestaModificar = explode("-", $FechaTomaProtesta);
        $FechaTomaProtestaLista = $FechaTomaProtestaModificar[0] . "-" . $FechaTomaProtestaModificar[1] . "-" . $FechaTomaProtestaModificar[2];
        $fechaLetras = $Funciones->Fecha2Mayusculas($FechaTomaProtestaLista);





        $fechaDividir = explode("DE", $fechaLetras);
        $fechaDiaProtesta = strtolower(convertir($fechaDividir[0]));
        $fechaMesProtesta =strtolower( $fechaDividir[1]);
        $fechaAnioProtesta = strtolower(convertir($fechaDividir[2]));
        //$fechaAnioProtestaListo=substr($fechaAnio, -6); //Esto devuelve "ndo"
      // $fechaAnioProtestaListo=$fechaAnio;

$xxx = explode(" ", $fechaAnioProtesta);
$fechaAnioProtestaListo=$xxx[2];       
            
$expe=$row[fechaexpediciontitulo];   

         
//ExamenExtraOrdinario        
     
if($row[ExamenExtraOrdinario]=="1"){
    
    $opcionExtraSi="X";
     $opcionExtraNo="";
}
if($row[ExamenExtraOrdinario]=="2"){
     $opcionExtraNo="X";
    $opcionExtraSi="";
}

//fk_carreras
//ingeniero constructor     INGENIERO ZOOTECNISTA ADMINISTRADOR            //sistemas                           civil                       ///medico
if($row[fk_carreras]=="6" || $row[fk_carreras]=="7"  || $row[fk_carreras]=="11" || $row[fk_carreras]=="27" || $row[fk_carreras]=="13"  || $row[fk_carreras]=="12"){
    
    $carrera=$row[nombreCarrera];
}else if($row[fk_carreras]=="2" || $row[fk_carreras]=="29"){
	$carrera=$row[nombreCarrera];
}else{
    $carrera="LICENCIADO EN ".$carrera;
    
}
 

$opcionTitulacion=$row[NombreOpcionTitulacion];
//$opcionTitulacion=$row[NombreOpcionTitulacion];

//$titulo=row[nombreTitulo];
//$titulo=$row[nombreTitulo];

/*$titulo=strtolower_ga($row[nombreTitulo]);
$titulo2 =strtolower($titulo);
$titulo2 =ucwords($titulo2);*/
$NombreTitulo = $row[nombreTitulo];


     //  $fechaVigente
//saber si es fecha o vigente 1=fecha 2=vigente 3=Vigencia
        if($row[TipoRevoe]=='1'){
            
            $fechaVigente="fecha ";
        }else if($row[TipoRevoe]=='2'){
            $fechaVigente="vigencia ";
        }else if ($row[TipoRevoe]=='3'){
            $fechaVigente="vigente";
        }else if($row[TipoRevoe]=='0'){
           $fechaVigente="COLOCAR FECHA/VIGENTE";
	}

//
//    $fechaActual = strftime("%Y-%m-%d", time());
//
//    $fechaActualModificar = explode("-", $fechaActual);
//    $fechaActualLista = $fechaActualModificar[0] . "-" . $fechaActualModificar[1] . "-" . $fechaActualModificar[2];
//
//    $fechaLetras = fechaATexto($fechaActualLista, 'u'); // Devuelve '10 DE AGOSTO DE 1981'
//
//        $fechaDividir = explode("DE", $fechaLetras);
//        $fechaDia = $fechaDividir[0];
//        $fechaMes = $fechaDividir[1];
//        $fechaAnio = $fechaDividir[2];
//        
//        
//
//        $fechaDia = strtolower(convertir($fechaDia));
//        $fechaMes = strtolower($fechaMes);
//        $fechaAnio = strtolower(convertir($fechaAnio));
//        
//
//$fechaDividir = explode("DE", $fechaLetras);
//$fechaDiaProtesta = convertir($fechaDividir[0]);
//$fechaMesProtesta=$fechaDividir[1];
//$fechaAnioProtesta=convertir($fechaDividir[2]);
//    $fechaAnioProtestaListo=substr($fechaAnioProtesta, -5); //Esto devuelve "ndo" 
//
//$NombreTituloShido = ucwords(strtolower($nombreTitulo));    
   
  //comparamos el salon

     if(is_numeric ($salon)==true){
         
         $salonListo=$salon;
     }else{
         $salonListo="DE ".$salon;
         
     }
    
    $html = ' 
<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" media="" />
<style type="text/css">

.Estilo1{
	font-size:24px;
	}

.Estilo2{
	font-size:22px;
	padding:15px;

	}
	
.Estilo3{
	font-size:16px;
	padding:15px;
	}
		
.text {
  line-height: 1.5;
  text-align:justify;
}

	
</style>



</head>

<body>
	<header id="header">
			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>					
					<td>
						<center class="" colspan="10">
							<div align="center" class="">&nbsp;</div>
					  </center>
			  		</td>
		  		</tr><tr>					
					<td>
						<center class="" colspan="10">
							<div align="center" class="">&nbsp;</div>
					  </center>
			  		</td>
		  		</tr>	  		<tr>					
					<td>
						<center class="" colspan="10">
							<div align="center" class="">&nbsp;</div>
					  </center>
			  		</td>
		  		</tr>
				<tr>					
					<td>
						<center class="" colspan="10">
							<div align="center" class="">&nbsp;</div>
					  </center>
			  		</td>
		  		</tr><tr>					
					<td>
						<center class="" colspan="10">
							<div align="center" class="">&nbsp;</div>
					  </center>
			  		</td>
		  		</tr>	  		<tr>					
					<td>
						<center class="" colspan="10">
							<div align="center" class="">&nbsp;</div>
					  </center>
			  		</td>
		  		</tr>		  			  		
		  	</table>
	 	</header> <!-- end of header bar -->
	 	
			<table width="100%" border="0" cellpadding="0" cellspacing="0" class="text">

		  		<tr>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
			  	</tr>
				<tr>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
			  	</tr>
				<tr>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
			  	</tr>
				<tr>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
			  	</tr>
			  	<tr>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
			  	</tr>
		  		<tr>
		  			<td width="60">&nbsp;</td>
					<td width="60">&nbsp;</td>
					<td width="60">&nbsp;</td>
					<td colspan="7">
						<center class="">
							<div align="center" class="Estilo1">Otorga a</div>
					  </center>
			  		</td>
		  		</tr>
		  		<tr>
		  			<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td colspan="7" width="0">&nbsp;</td>
			  	</tr>
		  		<tr>
		  			<td colspan="3" rowspan="7" class="" width="0"><center><img src="../../../../../assets/img/foto.png" width="" height="" /></center></td>
					<td colspan="7" class="Estilo2">
						<center class="">
							<div align="center" class="">'.$nombre.' '.$apaterno.' '.$amaterno.'</div>
					  </center>
			  		</td>
		  		</tr>
		  		<tr>
					<td colspan="7" width="0">&nbsp;</td>			  	
				</tr>

		  		<tr>
		  		
					<td colspan="7">
						<center class="">
							<div align="center" class="Estilo1">El Título de</div>
					  </center>
			  		</td>
		  		</tr>
		  		<tr>
	
					<td colspan="7" width="0">&nbsp;</td>			  	
				</tr>

		  		<tr>

					<td colspan="7" class="Estilo2">
						<center class="">
							<div align="center" class="">'.$NombreTitulo.'</div>
					  </center>
			  		</td>
		  		</tr>
		  		<tr>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td colspan="7" width="0">&nbsp;</td>			  	
				</tr>
		  		<tr>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td colspan="7" width="0">&nbsp;</td>			  	
				</tr>
				<tr>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td colspan="7" width="0">&nbsp;</td>			  	
				</tr>
				
		  		<tr>
		  			<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td colspan="7" rowspan="6" class="Estilo3"  >
					Con reconocimiento de Validez Oficial de Estudios, otorgado por la Secretaría de Educación del Estado de Chiapas, según Acuerdo No. <strong>'.$noacuerdo.'</strong> ' . $fechaVigente . ' <strong>' . $fechaExpedicion.'</strong> en atención a  que terminó los estudios correspondientes, de acuerdo al Plan y Programa de estudios vigente.
			  		</td>
		  		</tr>
		  		
				<tr>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
				</tr>
				<tr>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
				</tr>
				<tr>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
				</tr>
				<tr>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
				</tr>
				<tr>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
				</tr>
				<tr>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td colspan="7" width="0">&nbsp;</td>			  	
				</tr>
				<tr>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td colspan="7" width="0">&nbsp;</td>			  	
				</tr>
				
			  	<tr>
			  		<td colspan="3" rowspan="" width="0"><center><img src="../../../../../assets/img/linea_peq.png" width="170" height="1" /><span></p>Firma del Alumno</span></center></td>
					<td colspan="7" class="Estilo3"  >
					Tuxtla Gutierrez, Chiapas, a los <strong>'.$fechaDiaProtesta.'</strong> dias del <strong>mes de '.$fechaMesProtesta.'</strong> del año dos mil <strong>'.$fechaAnioProtestaListo.'.</strong>	</td>
		  		</tr>
		  		
				<tr>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td colspan="7" width="0">&nbsp;</td>			  	
				</tr>
				<tr>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td colspan="7" width="0">&nbsp;</td>			  	
				</tr>
				<tr>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td colspan="7" width="0">&nbsp;</td>			  	
				</tr>
				<tr>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td colspan="7" width="0">&nbsp;</td>			  	
				</tr>
			  	<tr>
			  		<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td colspan="7" >
						<center class="">
							<div align="center" class="">RECTOR</div>
					  </center>
			  		</td>
		  		</tr>
		  		<tr>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td colspan="7" width="0">&nbsp;</td>			  	
				</tr>
				<tr>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td colspan="7" width="0">&nbsp;</td>			  	
				</tr>
				<tr>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td colspan="7" width="0">&nbsp;</td>			  	
				</tr>
				<tr>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0">&nbsp;</td>
					<td width="0" style="border-top:2px solid black;">&nbsp;</td>
					<td width="0" style="border-top:2px solid black;">&nbsp;</td>
					<td width="0" style="border-top:2px solid black;">&nbsp;</td>
					<td width="0" style="border-top:2px solid black;">&nbsp;</td>
					<td width="0" style="border-top:2px solid black;">&nbsp;</td>
					<td width="0">&nbsp;</td>
				</tr>


			</table>



</body>
</html>
';


    
        
        
        
        
    }
} else {
    $html = "Lo Sentimos No Se Pudo Realizar la Consulta";
}
//echo $html;
ob_start();
$mpdf=new mPDF(
	'',    // mode - default ''
	'Legal',    // format - A4, for example, default ''
	0,     // font size - default 0
	'',    // default font family
	15,    // margin_left
	15,    // margin right
	16,     // margin top
	16,    // margin bottom
	9,     // margin header
	9,     // margin footer
	'L');  // L - landscape, P - portrait); 
$mpdf->AddPage('P', '', '', '', '', '', '', '', '');
$mpdf->WriteHTML($html);
$mpdf->Output("Reporte_VerTitulo_Frente_" . $today.".pdf", 'I');

?> 