<?php
define('PATH', '../');
define('URL','paths/urlPHP.php');
include(PATH.URL);
include(PATH.sourcesPHP::_paramsDB);
include(PATH.sourcesPHP::_conexDB);

$objConex = new classConexionDB();
$_openConx = $objConex::conexionDB();

$_sql = "SELECT (MAX(pk_encuesta)+1) AS lastId FROM rel_encuestas";
$_result = @mysql_query( $_sql, $_openConx );
$_row = @mysql_fetch_array( $_result );

$pk_encuesta = $_row['lastId'];

$jsondata = array();


if ( isset($_POST) ){
extract($_POST);


$fk_pregunta = -1; #corrijo el index de mi pregunta
$arrayOp = explode(',',$options);

foreach ($arrayOp AS $fk_opcion) {	
	$fk_pregunta++;
	$_sql = 'INSERT INTO rel_encuestas VALUES 
	(
	'.$pk_encuesta.',
	'.$fk_persona.',
	'.$fk_pregunta.',	
	"'.date('Y-m-d').'",
	'.$fk_opcion.',
	1
	)';
	@mysql_query( $_sql, $_openConx );
}
		
	$_sql = 'INSERT INTO tbl_comentarios VALUES (
	"NULL",
	'.$pk_encuesta.',
	"'.trim($comment).'"
	)';
	$_result = @mysql_query( $_sql, $_openConx );
		if ($_result) {
			$jsondata['status'] = '_success'; 
			$jsondata['msg'] = 'Se le agradece el tiempo prestado, los datos se guardaron correctamente';

		} else {

			$jsondata['status'] = '_fail';
			$jsondata['msg'] = mysql_error(); 
		}

/*
$jsondata['params'] = $pk_encuesta;
*/
} else {

	$jsondata['status'] = '_fail'; 
	$jsondata['msg'] = 'No se recibieron parametros...';
}


echo json_encode($jsondata); #mandamos el objeto
