<?php

//Este Archivo contiene dotas la clases que usaremos en el sistema
class MisFunciones {

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
//            $cadena = ucwords(strtolower($cadena));
        return($cadena);
    }

    //Convertir Cadena a mayusculas respetando acentos
    function str_to_may($c) {
        $cadena = strtr(strtoupper($c), "àáâãäåæçèéêëìíîïðñòóôõöøùüú", "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÜÚ");
//            $cadena = ucwords(strtolower($cadena));
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





}

function strtolower_ga($a) {
    return strtr(mb_strtolower($a,"UTF-8"), array(
	  "ma" => "Ma",
	  "desarrollo" => "Desarrollo",
	  "so" => "So",
	  "ad" => "Ad",
	  "p" => "P",
	  "ed" => "Ed",
	  "su" => "Su",
	  "ev" => "Ev",
	  "fi" => "Fi",
 	  "impuestos" => "Impuestos",
	  "civ" => "Civ",
	  "pe" => "Pe",
	  "publicidad" => "Publicidad",
	  "cons" => "Cons",
	  "for" => "For",
	  "epi" => "Epi",
	  "sa" => "Sa",
	  "amparo" => "Amparo",
	  "sistemas" => "Sistemas",
	  "cie" => "Cie",
	  "cor" => "Cor",
	  "lab" => "Lab",
	  "especialidad" => "Especialidad",
	  "especial" => "Especial",
	  "doce" => "Doce",
	  "enf" => "Enf",
	  "cri" => "Cri",
	  "derecho" => "Derecho",
	  
    ));
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

?>