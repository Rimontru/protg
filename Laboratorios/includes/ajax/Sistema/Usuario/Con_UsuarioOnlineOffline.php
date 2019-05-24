<?php

$Ruta = "../../../";
require($Ruta . "Config.class.php");
require($Ruta . "ModificacionDB.class.php");
require($Ruta . "ConsultaDB.class.php");

session_name("Guero");                      // usamos la sesion de nombre definido.
session_start();                            // Iniciamos el uso de sesiones
extract($_POST);

$Consulta=new ConsultaDB();
$Tablita="<table border='0' id='TablaUsuariosOnline' class='tablesorter'>
               <thead>
                   <tr>
                        <td>Usuario:</td>
                        <td>Departamento:</td>
                        <td>Status:</td>
                   </tr>
               </thead>
               <tbody>";

if(isset($OnlineOffline)){
     $result=$Consulta->ConUsuarioLogin();
    while($row = mysql_fetch_assoc($result)){
        
        if($row['Usuario_Online']=='1'){
            $Tablita.="<tr><td align='left'>".$row['Usuario']."</td><td align='left'>".utf8_encode($row['Departamento'])."</td>  <td align='left'><img with='30px' height='30px' src='img/opciones/online.png'></td></tr>";
        }else{
//            $Tablita.="<tr><td align='left'>".$row['Usuario']."</td><td align='left'>".utf8_encode($row['Departamento'])."</td>  <td align='left'><img with='30px' height='30px' src='img/opciones/offline.png'></td></tr>";
        }

    }
    $Tablita.="</tbody></table>";
    echo $Tablita;
    echo "<script>
            $('#TablaUsuariosOnline').tablesorter({
			widgets        : ['zebra', 'columns'],
			usNumberFormat : false,
			sortReset      : true,
			sortRestart    : true
		});      
          </script>";
}
?>
