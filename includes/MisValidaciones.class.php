<?php
//Este Archivo contiene funciones para las validaciones

class MisValidaciones{

        #FECHA: 12/02/13 03:33 pm
        #MODULO AFECTADO: includes/ajax/usuario/Ins_Usuario.php
        #DESCRIPCION: Validamos que el nombre del usuario tenga minimo 4 caracteres y sean miniscula y mayuscula
        # @params        $nombre = contiene el nombre del usuario
        # @return        True o False en función de la validacion
	function ValidaUsuario($Nombre){

            if(strlen($Nombre) < 4)                                       #NO cumple longitud minima
                    return false;
            else if(!preg_match("/^[a-zA-Z]+$/", $Nombre))                #SI longitud pero NO solo caracteres A-z
                    return false;
                else                                                    # SI longitud, SI caracteres A-z
                    return true;
        }

        #AGREGADO: Adonai Samai  Rodríguez Pérez
        #FECHA: 12/02/13 03:37 pm
        #MODULO AFECTADO: includes/ajax/usuario/Ins_Usuario.php
        #DESCRIPCION: Validamos que el password del usuario tenga minimo 5 caracteres y menor 12 caracteres
        # @params        $password1 = contiene el password del usuario
        # @return        True o False en función de la validacion
        function ValidaPassword1($Password1){

                if(strlen($Password1) < 5 || strlen($Password1) > 12)   #NO tiene minimo de 5 caracteres o mas de 12 caracteres
                        return false;
                else if(!preg_match("/^[0-9a-zA-Z]+$/", $Password1))    # SI longitud, NO VALIDO numeros y letras
                        return false;
                    else                                                # SI rellenado, SI email valido
                        return true;
        }

        #FECHA: 12/02/13 03:50 pm
        #MODULO AFECTADO: includes/ajax/usuario/Ins_Usuario.php
        #DESCRIPCION: Validamos que el password1 y password2 conincidan
        # @params        $password1 = contiene el password del usuario, $password2 = contiene el password de confirmacion del usuario
        # @return        True o False en función de la validacion
        function ValidaPassword2($Password1, $Password2){

                if($Password1 != $Password2)                            #NO coinciden Retornamos False
                        return false;
                else
                        return true;                                    #SI coinciden Retornamos True
        }

        #AGREGADO: Adonai Samai  Rodríguez Pérez
        #FECHA: 12/02/13 03:58 pm
        #MODULO AFECTADO: includes/ajax/usuario/Ins_Usuario.php
        #DESCRIPCION: Validamos que el email conincidan
        # @params        $password1 = contiene el password del usuario, $password2 = contiene el password de confirmacion del usuario, se comparan
        # @return        True o False en función de la validacion
        function ValidaEmail($Email){

                if(strlen($Email) == 0)                                         #NO hay nada escrito
                        return false;
                else if(filter_var($Email, FILTER_VALIDATE_EMAIL) && preg_match('/@.+\./', $Email))    # SI escrito, NO VALIDO email
                        return false;
                    else                                                        # SI rellenado, SI email valido
                        return true;
        }

        #AGREGADO: Adonai Samai  Rodríguez Pérez
        #FECHA: 12/02/13 11:30 pm
        #MODULO AFECTADO: includes/ajax/usuario/Ins_Usuario.php
        #MODULO AFECTADO: includes/ajax/IngCostos/Concurso/AsignacionDirecta/Ins_AsignacionDirecta.php
        #DESCRIPCION: Validamos que el monto sea igual o mayor a 4 y menor que 12
        # @params        $Monto = contiene el Monto ej 123456789.00 ó 0.00 obligamos que introduzcan el (0.00)
        # @return        True o False en función de la validacion
        function ValidaMonto($Monto){

                if(strlen($Monto) < 4 || strlen($Monto) > 12)                                       #NO cumple longitud minima y maxima
                    return false;
                else if(!preg_match("/^(([0-9]{1,9})\.([0-9]{2}))$/", $Monto))                #SI longitud pero NO solo caracteres A-z
                        return false;
                    else                                                                               # SI longitud, SI caracteres A-z
                        return true;
        }

        #AGREGADO: Adonai Samai  Rodríguez Pérez
        #FECHA: 13/02/13 12:05 am
        #MODULO AFECTADO: includes/ajax/Pgo/Ins_Pgo.php
        #MODULO AFECTADO: includes/ajax/IngCostos/Concurso/AsignacionDirecta/Ins_AsignacionDirecta.php
        #DESCRIPCION: Validamos que el No Oficio sea Mayor a 1
        # @params        $NoOficio = contiene el No. Oficio
        # @return        True o False en función de la validacion
        function ValidaNoOficio($NoOficio){

                if(strlen(trim($NoOficio)) == 0 )                                                     #NO cumple longitud minima
                    return false;
                else                                                                               # SI longitud, SI caracteres A-z
                    return true;
        }

        #AGREGADO:
        #FECHA: 12/02/13 12:19 pm
        #MODULO AFECTADO: includes/ajax/Pgo/Ins_Pgo.php
        #DESCRIPCION: Validamos la Fecha que Coincidan de acuerdo al formato (aaaa-mm-dd) ej. (2012-02-23)
        # @params        $Fecha = contiene la fecha
        # @return        True o False en función de la validacion

        function ValidaFecha($Fecha){

                if(strlen($Fecha) < 10)                                                    #NO cumple longitud minima y maxima
                    return false;
                else if(!preg_match("/^(\d{4})-(\d{2})-(\d{2})$/", $Fecha))                #SI longitud pero NO solo caracteres A-z
                        return false;
                    else                                                                   # SI longitud, SI caracteres A-z
                        return true;
        }
        #AGREGADO:
        #FECHA: 21/03/13 06:03 pm
        #MODULO AFECTADO: includes/ajax/IngCostos/PadronContratista/Ins_PadronContratista.php
        #DESCRIPCION: Validamos que el texto se a menor al Valor indicado de acuerdo a los caractes
        # @params        $Observaciones = Contiene el texto a validar, $Valor es num. de caracteres a validar
        # @return        True o False en función de la validacion
        function ValidaNumCaracteres($Valor, $Cadena){
                    $Cadena = trim($Cadena);
                   if(strlen($Cadena) <= 0)                                         #NO hay nada escrito
                        return false;
                    else if(!strlen($Cadena) <= $Valor)    # SI escrito, NO VALIDO email                                                                                    # SI rellenado, SI email valido
                            return true;
                         else
                             return false;
        }


        #AGREGADO:
        #FECHA: 13/02/13 03:58 pm
        #MODULO AFECTADO: includes/ajax/Pgo/Ins_Pgo.php
        #DESCRIPCION: Validamos que el email conincidan
        # @params        $Cadena = contiene el texto
        # @return        True o False en función de la validacion
        function ValidaCadenaVacia($Cadena){
                    $Cadena = trim($Cadena);
                   if(strlen($Cadena) <= 0)                                         #NO hay nada escrito
                        return false;
                    else if(!preg_match("/^[0-9]$/", $Cadena))    # SI escrito, NO VALIDO email                                                                                    # SI rellenado, SI email valido
                            return true;
                         else
                             return false;
        }

        #AGREGADO:
        #FECHA: 13/02/13 03:58 pm
        #MODULO AFECTADO: includes/ajax/Pgo/Ins_Pgo.php
        #DESCRIPCION: Validamos que el email conincidan
        # @params        $Cadena = contiene los numeros
        # @return        True o False en función de la validacion
        function ValidaNumeros($Cadena){
                    $Cadena = trim($Cadena);
                   if(strlen($Cadena) <= 0)                                         #NO hay nada escrito
                        return false;
                    else if(preg_match("/^[0-9]+$/", $Cadena))
                            return true;
                         else
                            return false;
        }

        #FECHA: 13/02/13 01:00 pm
        #MODULO AFECTADO: includes/ajax/Pgo/Ins_Pgo.php
        #DESCRIPCION: Validamos que la Cantidad de Obra
        # @params        $Cadena = contiene la Cantidad de la Obra
        # @return        True o False en función de la validacion
        function ValidaCantObra($Cadena){
                    $Cadena = trim($Cadena);
                   if(strlen($Cadena) <= 0)                                         #NO hay nada escrito
                        return false;
                    else if($Cadena == 0)
                            return false;
                        else if(preg_match("/^[0-9]{1,2}$/", $Cadena))    # SI escrito, NO VALIDO                                                                                     # SI rellenado, SI email valido
                            return true;
                         else
                             return false;
        }

        #FECHA: 13/02/13 01:20 pm
        #MODULO AFECTADO: includes/ajax/Pgo/Ins_Pgo.php
        #DESCRIPCION: Validamos que el IdObra
        # @params        $Cadena = contiene la Cantidad de la Obra
        # @return        True o False en función de la validacion
        function ValidaIdObra($Cadena){
                    $Cadena = trim($Cadena);
                   if(strlen($Cadena) <= 0)                                         #NO hay nada escrito
                        return false;
                    else if(preg_match("/^[1-9]{1,2}$/", $Cadena))    # SI escrito, NO VALIDO                                                                                     # SI rellenado, SI email valido
                            return true;
                         else
                             return false;
        }

        #AGREGADO:
        #FECHA: 13/02/13 03:58 pm
        #MODULO AFECTADO: includes/ajax/Pgo/Ins_Pgo.php
        #DESCRIPCION: Validamos que el email conincidan
        # @params        $Cadena = contiene los numeros
        # @return        True o False en función de la validacion
        function Valida0_9Numeros($Cadena){
                    $Cadena = trim($Cadena);
                   if(strlen($Cadena) <= "")                                         #NO hay nada escrito
                        return false;
                    else if(preg_match("/^[0-9]+$/", $Cadena))    # SI escrito, NO VALIDO                                                                                     # SI rellenado, SI email valido
                            return true;
                         else
                             return false;
        }

        function ValidaTexto($Texto){
            $Texto = trim($Texto);
                   if(strlen($Texto) <= "")                                      #NO cumple longitud minima
                    return false;
//            else if(!preg_match("/^[0-9a-zA-ZáéíóúÁÉÍÓÚäëïöüÄËÏÖÜàèìòùÀÈÌÒÙñÑ\s\'\:\.\,\;\#\%\=\!\?\¡\¿\&\/\°\(\)-]+$/", $Texto))                #SI longitud pero NO solo caracteres A-z
//                    return false;
                else                                                    # SI longitud, SI caracteres A-z
                    return true;
        }

        function ValidaMedidas($Medidas){
               $Medidas = trim($Medidas);
                   if(strlen($Medidas) <= "")                                        #NO cumple longitud minima y maxima
                    return false;
                else if(!preg_match("/^(([0-9]{1,9})\.([0-9]{2}))$/", $Medidas))                #SI longitud pero NO solo caracteres A-z
                        return false;
                    else                                                                               # SI longitud, SI caracteres A-z
                        return true;
        }

        function ValidaGPS($Medidas){
               $Medidas = trim($Medidas);
                   if(strlen($Medidas) <= "")                                        #NO cumple longitud minima y maxima
                    return false;
                else if(!preg_match("/^-?[0-9]+(\.[0-9]{1,9})?$/", $Medidas))                #SI 16.219949,-93.873138
                        return false;
                    else                                                                               # SI longitud, SI caracteres A-z
                        return true;
        }

        function ValidaTelefono($Telefono){
               $Telefono = trim($Telefono);
                   if(strlen($Telefono) <= "")                                        #NO cumple longitud minima y maxima
                    return false;
                else if(!preg_match("/^[0-9]{10}$/", $Telefono))                #SI 16.219949,-93.873138
                        return false;
                    else                                                                               # SI longitud, SI caracteres A-z
                        return true;
        }

	function ValidaHora($Hora){
               $Hora = trim($Hora);
                   if(strlen($Hora) <= "")                                        #NO cumple longitud minima y maxima
                    return false;
                else if(!preg_match("/^(0[1-9]|1\d|2[0-3]):([0-5]\d) (AM|PM)$/", $Hora))                #SI 16.219949,-93.873138
                        return false;
                    else                                                                               # SI longitud, SI caracteres A-z
                        return true;
        }

        public function filtar($texto){
            if(!is_array($texto)){
                return $this->procesar($texto);
            }else{
                $texto = array_ap(array($this,'procesar'), $texto);
                return $texto;
            }
        }

        private function procesar($t){
            if(is_string($t)){
                $t = mysql_real_escape_string($t);
            }

            if(is_int($t)){
                $t = (int)$t;
            }
            return $t;
        }


    static public function is_procedencia($string){
        return(preg_match("/^[A-Z0-9Ñ\s\.]+$/", $string) ) ? true : false;
    }

    static public function is_mm_aaaa($string){
        return(preg_match("/^[0-9]{2}\/[0-9]{4}+$/", $string) ) ? true : false;
    }

    static public function is_cedula_prof($string){
        return( preg_match("/^[0-9]{7,9}+$/", $string) ) ? true : false;
    }

    static public function is_curp($string){
        return( preg_match("/^[A-Z0-9]{16,20}+$/", $string) ) ? true : false;
    }


}
?>
