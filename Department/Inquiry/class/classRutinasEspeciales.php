<?php

class rutinasEspeciales{
	
	public function finDiasPorMes($mes,$anhio){ #feb 2020 biciesto
		$year = 2016;
	      for($i=1; $i<=20; $i++){
	        $aniosBiciestos[$i] = $year + 4; 
	      }
		foreach ($aniosBiciestos as $value) {
			if($anhio != $value){
				$numDias= array('01'=>'31', '02'=>'28', '03'=>'31', '04'=>'30', '05'=>'31', '06'=>'30', '07'=>'31', '08'=>'31', '09'=>'30', '10'=>'31', '11'=>'30', '12'=>'31');
				 $return = ($numDias[$mes]);
			}
			else{
				$numDias= array('01'=>'31', '02'=>'29', '03'=>'31', '04'=>'30', '05'=>'31', '06'=>'30', '07'=>'31', '08'=>'31', '09'=>'30', '10'=>'31', '11'=>'30', '12'=>'31');
				 $return = ($numDias[$mes]);
			}
		}
		return $return;			
	}
	public function nextmes($mes){
		$zero='0';
		if($mes<10){
			$mes+=1;
			$nMes=$zero.$mes;
			return($nMes);
		}
		else{
			$mes+=1;
			return($mes);
		}
	}
	
	public function getRealIP() {
		if (!empty($_SERVER['HTTP_CLIENT_IP']))
			return $_SERVER['HTTP_CLIENT_IP'];
		
		if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
			return $_SERVER['HTTP_X_FORWARDED_FOR'];
		
		return $_SERVER['REMOTE_ADDR'];
	}


	  function getUserIP(){
        $client  = @$_SERVER['HTTP_CLIENT_IP'];
        $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
        $remote  = $_SERVER['REMOTE_ADDR'];

        if(filter_var($client, FILTER_VALIDATE_IP)){
            $ip = $client;
        }elseif(filter_var($forward, FILTER_VALIDATE_IP)){
            $ip = $forward;
        }else{
            $ip = $remote;
        }
        return $ip;
    }

	public function diferenciaentreFechas($register,$tiempo){
		$today=date('Y-m-d'); #actual
		$old=$register; #fecha en que vence la licencia
			$fechoy=explode("-",$today);
				$diaHoy=$fechoy[2];
				$mesHoy=$fechoy[1];
				$anoHoy=$fechoy[0];
			$fechfin=explode("-",$old);
				$diaFin=$fechfin[2];
				$mesFin=$fechfin[1];
				$anoFin=$fechfin[0];
		switch($tiempo){
			case 1: #licencia de prueba
				if($mesHoy>=$mesFin && $diaHoy>=$diaFin)
					return 0;
				else
					return 1;
			break;
			
			case 2:#licencia pagada
				if($anoHoy>=$anoFin && $mesHoy>=$mesFin && $diaHoy>=$diaFin)
					return 0;
				else
					return 1;
			break;
		
		}
	}
	
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
		
		public function Hora0102($hora){
			$h=explode(":",$hora);
			if($h[2]=='01'){
			  return  str_replace(':01',' am',$hora);
			}
			else{
				return  str_replace(':02',' pm',$hora);
			}
		}
		
		public function Hora0102PDF($hora){
			$h=explode(":",$hora);
			if($h[2]=='01'){
			  return  str_replace(':01',' am de la ma&ntilde;ana',$hora);
			}
			else{
				return  str_replace(':02',' pm de la tarde',$hora);
			}
		}

	public function getDataPCUserOn(){
	  	$client  = @$_SERVER['HTTP_CLIENT_IP'];
   		$namePC = gethostbyaddr($_SERVER['REMOTE_ADDR']);
	    $macAddress = str_replace('Medios desconectados', '',exec('getmac'));
	    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
	    $remote  = $_SERVER['REMOTE_ADDR'];
		    if(filter_var($client, FILTER_VALIDATE_IP)){
		        $ip = $client;
		    }elseif(filter_var($forward, FILTER_VALIDATE_IP)){
		        $ip = $forward;
		    }else{
		        $ip = $remote;
		    }
	  return $namePC.'|'.$ip.'|'.$macAddress;
	}

	public function prepareStringSQLorderOFarray($arrayStringForInsert){
		$campo = NULL;
		$valor = NULL;
		foreach ($arrayStringForInsert as $nameField => $value) { 
			$campo .= "'".$nameField."',"; # este me sirve solo para updates o deletes

			if ( empty($value) ) { # si un valor de dato es vacio lo complementamos
			 	if ( is_numeric($value) ) { # y sea un numero, le ponemos 0
			 		$value = 0;
			 		$valor .= $value.',';
			 	}else { # y sea un string, le ponemos simbolo vacío
			 		$value = '--'; #Ø
			 		$valor .= "'".$value."',";
			 	}
			} 
			else { # en caso qe nu este vacio
				if ( is_numeric($value) ) { # y sea un numero
					$valor .= $value.',';
				}else {# y no sea un numero
					$valor .= "'".mysql_real_escape_string($value)."',";
				}
			}
		}
	return $campo.'|'.$valor;
	}

	public function prepareStringSQLorderOfArrayFinal($arrayStringForInsert, $action){
		$campo = NULL; $valor = NULL;
		switch ( $action ) {
			case 1: # retorna cadena para hacer un INSERT
				foreach ($arrayStringForInsert as $nameField => $value) { 

					if ( empty($value) ) { # si un valor de dato es vacio lo complementamos
					 	if ( is_numeric($value) ) { # y sea un numero, le ponemos 0
					 		$value = 0;
					 		$valor .= $value.',';
					 	}else { # y sea un string, le ponemos eso
					 		$value = '--';
					 		$valor .= "'".$value."',";
					 	}
					} 
					else { # en caso qe nu este vacio
						if ( is_numeric($value) ) { # y sea un numero
							$valor .= $value.',';
						}else {# y no sea un numero
							$valor .= "'".$value."',";
						}
					}
				}
			break;
			
			case 2: # retorna cadena para hacer un UPDATE
				foreach ($arrayStringForInsert as $nameField => $value) { 
					$campo = $nameField."="; # este me sirve solo para updates o deletes

					if ( empty($value) ) { # si un valor de dato es vacio lo complementamos
					 	if ( is_numeric($value) ) { # y sea un numero, le ponemos 0
					 		$value = 0;
					 		$valor .= $campo.$value.',';
					 	}else { # y sea un string, le ponemos eso
					 		$value = '--';
					 		$valor .= $campo."'".$value."',";
					 	}
					} 
					else { # en caso qe nu este vacio
						if ( is_numeric($value) ) { # y sea un numero
							$valor .= $campo.$value.',';
						}else {# y no sea un numero
							$valor .= $campo."'".$value."',";
						}
					}
				}
			break;
		}
	return $valor;
	}


	public function generateSiglasToName($strNomb){
		$sigs = NULL;
		$nombre = $strNomb;
		$arX = explode(' ', $nombre);
		foreach ($arX as $value) {
			$ext = substr($value, 0, 1);
			$sigs .= strtoupper($ext);
		}

	return $sigs;
	}


///////////////////////////// OTHERS FUNCTIONS /////////////////////////////


  var $salida;

  #Funcion que indicamos la fecha actual 	

  function Fecha() {
      date_default_timezone_set("America/Mexico_City");
      $dia = date("d");
      $mes = date("m");
      $year = date("Y");
      $matmes = array("01" => 'Enero', "02" => 'Febrero', "03" => 'Marzo', "04" => 'Abril',
          "05" => 'Mayo', "06" => 'Junio', "07" => 'Julio', "08" => 'Agosto', "09" => 'Septiembre',
          "10" => 'Octubre', "11" => 'Noviembre', "12" => 'Diciembre');

      return $this->salida = "Tuxtla GutiÃ©rrez, Chiapas; " . $matmes[$mes] . " " . $dia . " de " . $year;
  }

  #Funcion que indicamos la fecha actual 	
  function Fecha2($Fecha) {
      date_default_timezone_set("America/Mexico_City");
      $datos = explode("-", $Fecha);
      $dia = $datos[2];
      $mes = $datos[1];
      $year = $datos[0];
      $matmes = array("01" => 'Enero', "02" => 'Febrero', "03" => 'Marzo', "04" => 'Abril',
          "05" => 'Mayo', "06" => 'Junio', "07" => 'Julio', "08" => 'Agosto', "09" => 'Septiembre',
          "10" => 'Octubre', "11" => 'Noviembre', "12" => 'Diciembre');

      return $this->salida = $dia . " de " . $matmes[$mes] . " de " . $year;
  }

   function Fechaformato($Fecha) {
      date_default_timezone_set("America/Mexico_City");
      $datos = explode("/", $Fecha);
      $dia = $datos[0];
      $mes = $datos[1];
      $year = $datos[2];
      $matmes = array("01" => 'Enero', "02" => 'Febrero', "03" => 'Marzo', "04" => 'Abril',
          "05" => 'Mayo', "06" => 'Junio', "07" => 'Julio', "08" => 'Agosto', "09" => 'Septiembre',
          "10" => 'Octubre', "11" => 'Noviembre', "12" => 'Diciembre');

      return $this->salida = $dia . " de " . $matmes[$mes] . " de " . $year;
  }
    
  function Fecha2Mayusculas($Fecha) {
      $datos = explode("-", $Fecha);
      $dia = $datos[2];
      $mes = $datos[1];
      $year = $datos[0];
      $matmes = array("01" => 'ENERO', "02" => 'FEBRERO', "03" => 'MARZO', "04" => 'ABRIL',
          "05" => 'MAYO', "06" => 'JUNIO', "07" => 'JULIO', "08" => 'AGOSTO', "09" => 'SEPTIEMBRE',
          "10" => 'OCTUBRE', "11" => 'NOVIEMBRE', "12" => 'DICIEMBRE');

      return $this->salida = $dia . " DE " . $matmes[$mes] . " DE " . $year;
  }

  #Cortamos La Fecha que se encuentra en la posicion=0 y Hora que se encuentra en la posicion=1

  function CortarFecha($Fecha_Hora, $Posicion, $Caracter) {
      $Fecha = explode($Caracter, $Fecha_Hora);
      return $Fecha[$Posicion];
  }

  #Funcion que nos permite extraer los Key de un texto

  function tag_key($texto) {
      $content = str_replace(array("
	", "\r\n", "\n", "\n\n", ",", ".", ',', ')', '(', '.', "'", '"', '<', '>', ';', '!', '?', '/', '-', '_', '[', ']', ':', '+', '=', '#', '$', '"', 'ï¿½', '>', '<', chr(10), chr(13), chr(9)), "", $texto);
      $ketxt = preg_replace('/ {2,}/si', " ", $content);
      $t = explode(" ", $ketxt);
      $total = count($t);
      $tg = "";
      $i = 0;
      foreach ($t as $v) {
          $i++;
          $coma = ($i < $total - 1) ? ", " : " ";
          $tg .= (strlen($v) >= 5 && strlen($v) <= 8) ? ($v . $coma) : "";
      }
      $tag = strtolower($tg);
      return ($tag);
  }

  #Funcion que nos permite generar nombre en microtime

  function GenerarNom($Extencion) {
      $NuNom1 = explode(".", microtime());
      $NuNom2 = explode(" ", $NuNom1[1]);
      $NuevoNombre = $NuNom2[0] . $Extencion;

      return $NuevoNombre;
  }

  #Funcion que nos permite quitar el $ y las , a los montos

  function LimpiarMonto($Monto) {
      $this->salida = str_replace(',', '', $Monto);
      $this->salida = str_replace('$', '', $this->salida);
      return $this->salida;
  }

  function Fecha3($Fecha) {
      date_default_timezone_set("America/Mexico_City");
      $datos = explode("-", $Fecha);
      $dia = $datos[2];
      $mes = $datos[1];
      $year = $datos[0];
      $matmes = array("01" => 'Enero', "02" => 'Febrero', "03" => 'Marzo', "04" => 'Abril',
          "05" => 'Mayo', "06" => 'Junio', "07" => 'Julio', "08" => 'Agosto', "09" => 'Septiembre',
          "10" => 'Octubre', "11" => 'Noviembre', "12" => 'Diciembre');

      return $this->salida = $dia . " de " . $matmes[$mes] . " del " . $year;
  }

  function FechaCero($Fecha) {
      date_default_timezone_set("America/Mexico_City");
      $datos = explode("-", $Fecha);
            if (substr($datos[2],0,1) == '0') {
                $dia = substr($datos[2],1);
            } else { 
                $dia = $datos[2];
            }
      $mes = $datos[1];
      $year = $datos[0];
      $matmes = array("01" => 'Enero', "02" => 'Febrero', "03" => 'Marzo', "04" => 'Abril',
          "05" => 'Mayo', "06" => 'Junio', "07" => 'Julio', "08" => 'Agosto', "09" => 'Septiembre',
          "10" => 'Octubre', "11" => 'Noviembre', "12" => 'Diciembre');

      return $this->salida = $dia . " de " . $matmes[$mes] . " del " . $year;
  }

  function DosenUno($Array) {
      foreach ($Array as $nombre_campo => $valor) {
          $valor = utf8_decode($valor); // decodifico al ut8 para asentos y Ã±
          $valor = trim($valor); // le quito espacios vacios
          $asignacion = "\$" . $nombre_campo . "='" . $valor . "';";
          //echo $asignacion;                      
          return $this->salida = eval($asignacion);
      }
  }


  //Convertir Cadena a minusculas respetando acentos
  function str_to_min($c) {
      $cadena = strtr(strtolower($c), "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÜÚ", "àáâãäåæçèéêëìíîïðñòóôõöøùüú");
            #$cadena = ucwords(strtolower($cadena));
      return($cadena);
  }

  //Convertir Cadena a mayusculas respetando acentos
  function str_to_may($c) {
      $cadena = strtr(strtoupper($c), "àáâãäåæçèéêëìíîïðñòóôõöøùüú", "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÜÚ");
        #  $cadena = ucwords(strtolower($cadena));
      return($cadena);
  }

  function ConteoDias($fecha1, $fecha2) {
      $datetime1 = date_create($fecha1);
      $datetime2 = date_create($fecha2);
      $interval = date_diff($datetime1, $datetime2);
      return $interval->format('%a');
  }

  function Iniciales($cadena) {
      $p = 1;
      $c = '';
      for ($i = 0; $i < strlen($cadena); $i++) {
          if ($cadena[$i] != " " && $p == 1) {
              $c.= $cadena[$i];
              $p = 0;
          }
          if ($cadena[$i] == " ")
              $p = 1;
      }
      return $c;
  }

  function Porcentaje($total, $parte) {
      return round($parte / $total * 100, 2);
  }

  function alfabetico($valor) {
      $permitidos = '/^[A-Z Ã¼ÃœÃ¡Ã©Ã­Ã³ÃºÃÃ‰ÃÃ“ÃšÃ±Ã‘]{1,50}$/i';
      if (empty($valor)) {
          return true; // Campo vacio no validar
      } else {
          if (preg_match($permitidos, $valor)) {
              return true; // Campo permitido 
          } else {
              return false; // Error uno de los caracteres no hace parte de la expresiÃ³n regular 
          }
      }
  }
    
    
    
  public function tiempo_transcurrido($fecha_nacimiento, $fecha_control)
	{
   $fecha_actual = $fecha_control;
   
   if(!strlen($fecha_actual))
   {
      $fecha_actual = date('d/m/Y');
   }

   // separamos en partes las fechas 
   $array_nacimiento = explode ( "/", $fecha_nacimiento ); 
   $array_actual = explode ( "/", $fecha_actual ); 

   $anos =  $array_actual[2] - $array_nacimiento[2]; // calculamos aÃ±os 
   $meses = $array_actual[1] - $array_nacimiento[1]; // calculamos meses 
   $dias =  $array_actual[0] - $array_nacimiento[0]; // calculamos dÃ­as 

   //ajuste de posible negativo en $dÃ­as 
   if ($dias < 0) 
   { 
      --$meses; 

      //ahora hay que sumar a $dias los dias que tiene el mes anterior de la fecha actual 
      switch ($array_actual[1]) { 
         case 1: 
            $dias_mes_anterior=31;
            break; 
         case 2:     
            $dias_mes_anterior=31;
            break; 
         case 3:  
            
    $bisiesto=false; 
   //probamos si el mes de febrero del aÃ±o actual tiene 29 dÃ­as 
     if (checkdate(2,29,$array_actual[2])) 
     { 
      $bisiesto=true; 
   } 
             
            if ($bisiesto) 
            { 
               $dias_mes_anterior=29;
               break; 
            }
            
            
            
            else 
            { 
               $dias_mes_anterior=28;
               break; 
            } 
         case 4:
            $dias_mes_anterior=31;
            break; 
         case 5:
            $dias_mes_anterior=30;
            break; 
         case 6:
            $dias_mes_anterior=31;
            break; 
         case 7:
            $dias_mes_anterior=30;
            break; 
         case 8:
            $dias_mes_anterior=31;
            break; 
         case 9:
            $dias_mes_anterior=31;
            break; 
         case 10:
            $dias_mes_anterior=30;
            break; 
         case 11:
            $dias_mes_anterior=31;
            break; 
         case 12:
            $dias_mes_anterior=30;
            break; 
      } 

      $dias=$dias + $dias_mes_anterior;

      if ($dias < 0)
      {
         --$meses;
         if($dias == -1)
         {
            $dias = 30;
         }
         if($dias == -2)
         {
            $dias = 29;
         }
      }
   }

   //ajuste de posible negativo en $meses 
   if ($meses < 0) 
   { 
      --$anos; 
      $meses=$meses + 12; 
   }

   $tiempo[0] = $anos;
   $tiempo[1] = $meses;
   $tiempo[2] = $dias;

   return $tiempo;
	}


  function Capital($nombre)
  {
      // aca definimos un array de articulos (en minuscula)
      // aunque lo puedes definir afuera y declararlo global aca
      $articulos = array('0' => 'a', '1' => 'de', '2' => 'del', '3' => 'la', '4' => 'los', '5' => 'las', '6' => 'en', '7' => 'con', '8' => 'por', '9' => 'y', '10' => 'un', '11' => 'mi');
      // explotamos el nombre
      $palabras = explode(' ', $nombre);
      // creamos la variable que contendra el nombre
      // formateado
      $nuevoNombre = '';
      // parseamos cada palabra
      foreach($palabras as $elemento)
      {
          // si la palabra es un articulo
          if(in_array(trim($elemento), $articulos))
              {
              // concatenamos seguido de un espacio
              $nuevoNombre .= $elemento." ";
              } else {
              // sino, es un nombre propio, por lo tanto aplicamos
              // las funciones y concatenamos seguido de un espacio
              $nuevoNombre .= ucfirst($elemento)." ";
              }
      }

      return trim($nuevoNombre);
  }  


	/**
	* funcion para convertir un numero a decimal con X digitos
	* @param String $number
	* @param Int $digitos cantidad de digitos a mostrar
	* @return Float
	*/
	function truncateFloat($number, $digitos)
	{
	    $raiz = 10;
	    $multiplicador = pow ($raiz,$digitos);
	    $resultado = ((int)($number * $multiplicador)) / $multiplicador;
	    return number_format($resultado, $digitos);
	 
	}

  function calculaEdadPerson($fecha_nacimiento){
    
    $birth = $fecha_nacimiento; // nacimiento
    $fbir = explode('-', $birth); // particionamos la fecha f[0]=año f[1]=mes f[2]=dia
    $bir = array(
        'a'=>$fbir[0],
        'm'=>$fbir[1],
        'd'=>$fbir[2]
        );
    $edad = date('Y') - $bir['a']; // nos basamos en el año para obtener la edad actual 
    if( $bir['m'] >= date('m') ){ // mes cumple es mayor o igual al actual
      if( $bir['d'] < date('d') ){ //dia cumple es menor al actual aun faltan dias
        $edad--;
        return $edad;

      }else if( $bir['d'] >= date('d') ) // dia cumple es mayor o igual al actual ya los cumplio
        return $edad; //

    }else{ // mes cumple es menor actual faltan meses 
      $edad--;
      return $edad;
    }
  }


} // THIS CLOSE CLASS




 /*echo $_SERVER['REMOTE_ADDR']; #obtiene mi ip del servidor
  echo gethostname(), php_uname('n'); #funciones obtiene mi sesion de usuario
  echo gethostbyaddr($_SERVER['REMOTE_ADDR']); #obtiene el nombre de mi PC mediante la IP
echo exec('getmac');
  echo system('arp -an');
  echo getHostByName(getHostName()); #muestra mi direccion ipv4 conectada*/
