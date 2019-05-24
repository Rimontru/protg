<?php
/**
 * fechaATexto()
 *
 * Devuelve la cadena de texto asociada a la fecha ingresada
 *
 * @param   string fecha (cadena con formato XXXX-XX-XX)
 * @param   string formato (puede tomar los valores 'l', 'u', 'c')
 * @return  string  fecha_en_formato_texto
 */
function mes($num){
    /**
     * Creamos un array con los meses disponibles.
     * Agregamos un valor cualquiera al comienzo del array para que los números coincidan
     * con el valor tradicional del mes. El valor "Error" resultará útil
     **/
    $meses = array('Error', 'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
        'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
 
    /**
     * Si el número ingresado está entre 1 y 12 asignar la parte entera.
     * De lo contrario asignar "0"
     **/
    $num_limpio = $num >= 1 && $num <= 12 ? intval($num) : 0;
    return $meses[$num_limpio];
}

 
function fechaATexto($fecha, $formato = 'c') {
 
    // Validamos que la cadena satisfaga el formato deseado y almacenamos las partes
    if (ereg("([0-9]{4})-([0-9]{1,2})-([0-9]{1,2})", $fecha, $partes)) {
        // $partes[0] contiene la cadena original
        // $partes[1] contiene el año
        // $partes[2] contiene el número de mes
        // $partes[3] contiene el número del día
        $mes = ' de ' . mes($partes[2]) . ' de '; // Corregido!
        if ($formato == 'u') {
            $mes = strtoupper($mes);
        } elseif ($formato == 'l') {
            $mes = strtolower($mes);
        }
        return $partes[3] . $mes . $partes[1];
 
    } else {
        // Si hubo problemas en la validación, devolvemos false
        //return false;
        return "error";
    }
}
 
/**
 * timestampATexto()
 *
 * Devuelve la cadena de texto asociada a la fecha ingresada
 *
 * @param   string timestamp (cadena con formato XXXX-XX-XX XX:XX:XX)
 * @param   string formato (puede tomar los valores 'l', 'u', 'c')
 * @return  string  fecha_en_formato_texto
 */
 
function timestampATexto($timestamp, $formato = 'c') {
 
    // Buscamos el espacio dentro de la cadena o salimos
    if (strpos($timestamp, " ") === false){
        return false;
    }
 
    // Dividimos la cadena en el espacio separador
    $timestamp = explode(" ", $timestamp);
 
    // Como la primera parte es una fecha, simplemente llamamos a fechaATexto()
    if (fechaATexto($timestamp[0])) {
        $conjuncion = ' a las ';
        if ($formato == 'u') {
            $conjuncion = strtoupper($conjuncion);
        }
        return fechaATexto($timestamp[0], $formato) . $conjuncion;
    }
}

//// Declaramos algunas variables de prueba
//$fecha = '1981-08-10';
//$timestamp = '1981-08-10 05:30:46';
// 
//echo fechaATexto($fecha, 'u'); // Devuelve '10 DE AGOSTO DE 1981'
//echo fechaATexto($fecha, 'l'); // Devuelve '10 de agosto de 1981'
//echo fechaATexto($fecha); // Devuelve '10 de Agosto de 1981'
//echo timestampATexto($timestamp, 'u'); // Devuelve '10 DE AGOSTO DE 1981 A LAS 05:30:46'
//echo timestampATexto($timestamp, 'l'); // Devuelve '10 de agosto de 1981 a las 05:30:46'
//echo timestampATexto($timestamp); // Devuelve '10 de Agosto de 1981 a las 05:30:46'
?>