<?
// Motor autentificación usuarios.
// checa página que lo llama para devolver errores a dicha página.

if(isset($_SERVER['HTTP_REFERER'])){
$url = explode("?",$_SERVER['HTTP_REFERER']);
$pag_referida=$url[0];
$redir=$pag_referida;

	// chequear si se llama directo al script.
	if($_SERVER['HTTP_REFERER'] == ""){
		die ("Error Codigo 1: Acceso Incorrecto!");
		exit;
	}  
}else{
	die ("Error Codigo 1: Acceso Incorrecto**!");
	//echo  $_SERVER['HTTP_REFERER'];
	exit;
}
// Chequeamos si se está autentificandose un usuario por medio del formulario
if (isset($_POST['Usuario']) && isset($_POST['Pass'])) {

// Conexión base de datos.
// si no se puede conectar a la BD salimos del scrip con error 0 y
// redireccionamos a la pagina de error.

// Outputs: Is your name O\'reilly?
 $Usuario = addslashes($_POST['Usuario']);    
    
// realizamos la consulta a la BD para chequear datos del Usuario.
$usuario_consulta = mysql_query("SELECT * FROM tbl_usuario_login 
                                INNER JOIN rel_usuario_laboratorios ON tbl_usuario_login.Pk_Usuario_Login=rel_usuario_laboratorios.fk_Usuario_Login
                                WHERE Usuario='".$Usuario."' 
                                 AND activo_usuario = 1") or die (mysql_error());
#(header ("Location:  ".Config::PAG_ADMIN."&error_login=1"));
//$sql = "SELECT * FROM $sql_tabla WHERE usuario='".$_POST['user']."'";
 // miramos el total de resultado de la consulta (si es distinto de 0 es que existe el usuario)
 if (mysql_num_rows($usuario_consulta) != 0) {

    // eliminamos barras invertidas y dobles en sencillas
    $login = stripslashes($_POST['Usuario']);
    // encriptamos el password en formato md5 irreversible.
    $password = md5($_POST['Pass']);

    // almacenamos datos del Usuario en un array para empezar a chequear.
 	$usuario_datos = mysql_fetch_array($usuario_consulta);
  
    // liberamos la memoria usada por la consulta, ya que tenemos estos datos en el Array.
    mysql_free_result($usuario_consulta);
    
    // chequeamos el nombre del usuario otra vez contrastandolo con la BD
    // esta vez sin barras invertidas, etc ...
    // si no es correcto, salimos del script con error 4 y redireccionamos a la
    // página de error.
    if ($login != $usuario_datos['Usuario']) {
       	header ("Location: ".Config::PAG_ADMIN."?error_login=4");
		exit;}

    // si el password no es correcto ..
    // salimos del script con error 3 y redireccinamos hacia la página de error
    if ($password != $usuario_datos['Password']) {
        header ("Location: ".Config::PAG_ADMIN."?error_login=3");
	    exit;}
		
	// Paranoia: destruimos las variables login y password usadas
    unset($login);
    unset($password);

    // En este punto, el usuario ya esta validado.
    // Grabamos los datos del usuario en una sesion.    
     // le damos un mobre a la sesion.
    session_name($usuarios_sesion);
    
    //ini_set("session.cookie_lifetime",8*60*60);  
    //ini_set("session.gc_maxlifetime",8*60*60);   
    ini_set("session.cookie_lifetime","36000");  
    ini_set("session.gc_maxlifetime","36000");   
     // incia sessiones    
    session_start();
    
    // Paranoia: decimos al navegador que no "cachee" esta página.
    session_cache_limiter('nocache,private');
       
    // Asignamos variables de sesión con datos del Usuario para el uso en el
    // resto de páginas autentificadas.

    // definimos usuarios_id como IDentificador del usuario en nuestra BD de usuarios
    $_SESSION['usuario_id']=$usuario_datos['Pk_Usuario_Login'];
     $_SESSION['fk_laboratorios']=$usuario_datos['fk_laboratorios'];
    // definimos usuario_nivel con el Nivel de acceso del usuario de nuestra BD de usuarios
    $_SESSION['Tipo_User']=$usuario_datos['Tipo_User'];
    
    // definimos usuario_nivel con el Nivel de acceso del usuario de nuestra BD de usuarios
    $_SESSION['usuario_direccion']=$usuario_datos['Pk_Direcciones'];
    
    //definimos usuario_nivel con el Nivel de acceso del usuario de nuestra BD de usuarios
    $_SESSION['usuario_login']=$usuario_datos['Usuario'];    

    //definimos usuario_password con el password del usuario de la sesión actual (formato md5 encriptado)
    $_SESSION['usuario_password']=$usuario_datos['Password'];
    
    //definimos el nombre del usuario completo
    $_SESSION['nombre_usuario']=$usuario_datos['nombre']." ".$usuario_datos['apaterno']." ".$usuario_datos['amaterno'];  

    
    $_SESSION['Fk_Empresa']=$usuario_datos['Fk_Empresa'];  


    // Hacemos una llamada a si mismo (scritp) para que queden disponibles
    // las variables de session en el array asociado $HTTP_...
    //$pag=$_SERVER['PHP_SELF'];
    header ("Location: ".Config::PAG_ADMIN."?content=home2");
    exit;
    
   } else {
      // si no esta el nombre de usuario en la BD o el password ..
      // se devuelve a pagina q lo llamo con error
      header ("Location: ".Config::PAG_ADMIN."?error_login=2");
      exit;}
} else {

// -------- Chequear sesión existe -------
// usamos la sesion de nombre definido.
session_name($usuarios_sesion);
// Iniciamos el uso de sesiones
session_start();

// Chequeamos si estan creadas las variables de sesión de identificación del usuario,
// El caso mas comun es el de una vez "matado" la sesion se intenta volver hacia atras
// con el navegador.

    if (!isset($_SESSION['usuario_login']) && !isset($_SESSION['usuario_password'])){
    // Borramos la sesion creada por el inicio de session anterior
    session_destroy();
    $parametros_cookies = session_get_cookie_params(); 
    setcookie(session_name(),0,1,$parametros_cookies["path"]);
    //die ("Error Codigo. 2 - Acceso incorrecto!");
        header ("Location: Sistema.php"); 
    exit;
    }
}
?>
