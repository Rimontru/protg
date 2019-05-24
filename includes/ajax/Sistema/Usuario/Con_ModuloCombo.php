<?php
$Ruta = "../../../";
require($Ruta."Config.class.php");  # Cargar datos conexion y otras variables.
require($Ruta."DB.class.php");
require($Ruta."ConsultaDB.class.php");
//creamos el objeto $objempleados de la clase cEmpleado
$Obras =new ConsultaDB;
$Activo = "1";
$Modulos = '<option value="">Elige un Menu</option>
            <option value="1">Alumnos</option>
             <option value="2">Tramites</option>
             <option value="3">Sinodales</option>
             <option value="4">Servicios Escolares</option>
             <option value="5">Egresados</option>
             <option value="6">Herramientas</option>';
echo $Modulos;        
?>
         