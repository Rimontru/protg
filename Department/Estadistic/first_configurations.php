<?php
$fullPathsSistem="clases/pathSistem/fullPaths.php";
/*session_start();
if(!isset($_SESSION['usuario']) || $_SESSION['menu_log']==0){
	header("Location:login.php");
}
else{}
*/
	include($fullPathsSistem); #contiene tadas las urls php requeridas
	include($path_page_h);
	include($path_page_c);
	include($path_page_f);

?>
