<?php
require_once('../../../../mpdf/mpdf.php');
require_once('../../../../includes/MisFunciones.class.php');

die(1);
$cnx = mysql_connect('localhost', 'root', 'iesch-red');
$db = mysql_select_db('db_users_protg', $cnx);
$db = mysql_query ("SET NAMES 'utf8'");


$query = "SELECT * FROM cat_usuarios WHERE estatus = 1";
$result = mysql_query($query, $db);
$row = mysql_fetch_assoc($result);
var_dump($row);