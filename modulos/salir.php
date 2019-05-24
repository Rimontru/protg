<?
// le damos un mobre a la sesion (por si quisieramos identificarla)
session_name($usuarios_sesion);
// iniciamos sesiones
session_start();

include_once("includes/ConsultaDB.class.php");	   //referenciamos la clase Consultadb en la cual se encuentra todas la consultas del sistema guero
$ConsultaDB = new ConsultaDB();     
$ConsultaDB->UsuarioOffline($_SESSION['usuario_id']);
// destruimos la session de usuarios.
session_destroy();

$parametros_cookies = session_get_cookie_params(); 
setcookie(session_name(),0,1,$parametros_cookies["path"]);

header ("Location: guero.php"); 
?>
