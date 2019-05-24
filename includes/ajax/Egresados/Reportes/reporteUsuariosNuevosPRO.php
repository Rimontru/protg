<?php
require_once('../../../../mpdf/mpdf.php');
require_once('../../../../includes/MisFunciones.class.php');

$cnx = mysql_connect("localhost", "root", "iesch-red");
$db = mysql_select_db("db_users_protg", $cnx);
$db = mysql_query ("SET NAMES 'utf8'");


$query = "SELECT * FROM  cat_usuarios WHERE estatus = 1";
$result = mysql_query($query, $cnx);

$table = '';
$func = new MisFunciones;


while( $row = mysql_fetch_assoc($result) )
{
  $table .= '
    <table width="100%" border="0" align="center" cellspacing="0">
      <tr>
        <td align="right"><b>Tuxtla Gutiérrez, Chiapas</b></td>
      </tr>
      <tr>
        <td align="right"><b>'.$func->Fecha2(date('Y-m-d')).'</b></td>
      </tr>
    </table>

    <table width="100%" border="0" style="text-align:justify;" cellspacing="0">
      <tr><td><b>C. '.$row['nombre'].'</b></td></tr>
      <tr><td>'.$row['puesto'].'.</td></tr>
      <tr><td>'.$row['departamento'].'.</td></tr>
      <tr><td>&nbsp;</td></tr>
      <tr>
        <td>
          Por medio del presente me dirijo a usted, para asignarle su usuario y contraseña del sistema "Programa de Titulación y Grado" (PROTG). En donde podrá realizar los trámites correspondientes de los alumnos egresados. Los permisos otorgados son de acuerdo al puesto de trabajo, que desempeña actualmente dentro de la institución.
        </td>
      </tr>
      <tr><td>&nbsp;</td></tr>
      <tr><td>Usuario: <b>'.$row['username'].'</b></td></tr>
      <tr><td>Contraseña: <b>'.$row['password'].'</b></td></tr>
      <tr><td>&nbsp;</td></tr>
      <tr><td>&nbsp;</td></tr>
    </table>
    <table width="100%" border="0" align="center" cellspacing="0">
      <tr>
        <td>Sin otro particular, le envío un cordial saludo.</td>
      </tr>
      <tr><td align="center">&nbsp;</td></tr>
      <tr><td align="center">Atentamente</td></tr>
      <tr><td>&nbsp;</td></tr>
      <tr><td align="center">Ing. Victor Hugo Santiago Gordillo</td></tr>
      <tr><td align="center">Red Interna</td></tr>
      <tr><td>&nbsp;</td></tr>
      <tr><td>&nbsp;</td></tr>
      <tr><td>&nbsp;</td></tr>
      <tr><td>&nbsp;</td></tr>
    </table>

    <table width="100%" border="0" align="center" cellspacing="0">
      <tr>
        <td align="right"><b>Tuxtla Gutiérrez, Chiapas</b></td>
      </tr>
      <tr>
        <td align="right"><b>'.$func->Fecha2(date('Y-m-d')).'</b></td>
      </tr>
    </table>

    <table width="100%" border="0" style="text-align:justify;" cellspacing="0">
      <tr><td><b>C. '.$row['nombre'].'</b></td></tr>
      <tr><td>'.$row['puesto'].'.</td></tr>
      <tr><td>'.$row['departamento'].'.</td></tr>
      <tr><td>&nbsp;</td></tr>
      <tr>
        <td>
          Por medio del presente me dirijo a usted, para asignarle su usuario y contraseña del sistema "Programa de Titulación y Grado" (PROTG). En donde podrá realizar los trámites correspondientes de los alumnos egresados. Los permisos otorgados son de acuerdo al puesto de trabajo, que desempeña actualmente dentro de la institución.
        </td>
      </tr>
      <tr><td>&nbsp;</td></tr>
      <tr><td>Usuario: <b>'.$row['username'].'</b></td></tr>
      <tr><td>Contraseña: <b>'.$row['password'].'</b></td></tr>
      <tr><td>&nbsp;</td></tr>
      <tr><td>&nbsp;</td></tr>
    </table>
    <table width="100%" border="0" align="center" cellspacing="0">
      <tr>
        <td>Sin otro particular, le envío un cordial saludo.</td>
      </tr>
      <tr><td align="center">&nbsp;</td></tr>
      <tr><td align="center">Atentamente</td></tr>
      <tr><td>&nbsp;</td></tr>
      <tr><td align="center">Ing. Victor Hugo Santiago Gordillo</td></tr>
      <tr><td align="center">Red Interna</td></tr>
      <tr><td>&nbsp;</td></tr>
      <tr><td>&nbsp;</td></tr>
      <tr><td>&nbsp;</td></tr>
    </table>
  ';
}

$mpdf = new mPDF();

$html='
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<style>
  body{font-family:Arial; font-size:14px;}
</style>
<body>';


$foot='
</body>
</html>
';

$res = $hmtl.$head.$table.$foot;


//$mpdf->AddPage('P','','','','','','','','','','');
$mpdf->WriteHTML($res);
$mpdf->Output("ReporteUsuariosActules". uniqid() .'.pdf', 'I');
