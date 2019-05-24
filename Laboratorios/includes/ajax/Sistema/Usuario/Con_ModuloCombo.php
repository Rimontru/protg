<?php
$Ruta = "../../../";
require($Ruta."Config.class.php");  # Cargar datos conexion y otras variables.
require($Ruta."DB.class.php");
require($Ruta."ConsultaDB.class.php");
//creamos el objeto $objempleados de la clase cEmpleado
$Obras =new ConsultaDB;
$Activo = "1";
$Modulos = '<option value="">Elige un Menu</option>
            <option value="1">Clientes</option>
             <option value="2">Productos</option>
             <option value="3">Facturaci&oacute;n</option>
             <option value="4">Listar Facturas</option>';
echo $Modulos;        
?>
         