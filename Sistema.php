<?php
//error_reporting(E_ALL);

include('conf.php');
require("includes/MisFunciones.class.php");
require("includes/Config.class.php");  # Cargar datos conexion y otras variables.
require('includes/DB.class.php');
    $Funciones = new MisFunciones();
	$db = new database;		#referenciamos la clase de la base de datos
	$db->conectar();			#usamos el metodo conectar

    if (!empty($_GET['content']))
            $modulo = $_GET['content'];
    else
            $modulo = MODULO_DEFECTO;

    if (empty($conf[$modulo]))
                    $modulo = MODULO_DEFECTO;
    if (empty($conf[$modulo]['layout']))
                    $conf[$modulo]['layout'] = LAYOUT_DEFECTO;

    $path_layout = LAYOUT_PATH.'/'.$conf[$modulo]['layout'];
    $path_modulo = MODULO_PATH.'/'.$conf[$modulo]['archivo'];

    if (file_exists($path_layout))
            include( $path_layout );
    else
            if (file_exists( $path_modulo ))
                include( $path_modulo );
            else
                    die('Error al cargar el módulo <b>'.$modulo.'</b>. No existe el archivo <b>'.$conf[$modulo]['archivo'].'</b>');
?>
<html lang="es">
<head>
<meta charset="utf-8">
<title>PROTG v2.0</title>


</head>
<body>
<script>


</body>
</html>






