<?php

$Ruta = "../../";
require($Ruta . "Config.class.php");
require($Ruta . 'DB.class.php');
require($Ruta . "ConsultaDB.class.php");
require($Ruta . "MisFunciones.class.php");

$Funciones = new MisFunciones();
$Consulta = new ConsultaDB;
$jsondata = array();

session_name("PROTG2");                      // usamos la sesion de nombre definido.
session_start();                            // Iniciamos el uso de sesiones
extract($_POST);
$fk_laboratorios = $_SESSION['fk_laboratorios'];


 $Tipo_User=$_SESSION['Tipo_User'];
 
$Material=0;
$Reactivos=0;
$Equipo=0;
        
        
if (empty($_POST['ClaseMaterial'])) {
    $jsondata['Error'] = "Error al Consultar";
} else {
    extract($_POST);

     if($Tipo_User=="Administrador"){
       $Result = $Consulta->ConsultaClaseMaterialesCantidadHOMEAdmin();
    }else{
        $fk_laboratorios = $_SESSION['fk_laboratorios'];
        $Result = $Consulta->ConsultaClaseMaterialesCantidadHOMEUser($fk_laboratorios);

    }
 
    $NumRow = mysql_num_rows($Result);
    if ($NumRow>=1) {
        while($row = mysql_fetch_assoc($Result)){
        
                if($row['fk_clasematerial']=='1'){
                     $Material=$Material+1;
                }else  if($row['fk_clasematerial']=='2'){
                    $Reactivos=$Reactivos+1;
                }else  if($row['fk_clasematerial']=='3'){
                    $Equipo=$Equipo+1;
                }
                
               
                if($Tipo_User=="Administrador"){
                  $LaboratorioAcceso="Todos los Laboratorios";
               }else{
                    $LaboratorioAcceso=$row['DescripcionLaboratorios'];

               }
                
        }
        
            $jsondata['Material'] = $Material;           
            $jsondata['Reactivos'] = $Reactivos;
            $jsondata['Equipo'] = $Equipo;
            $jsondata['LaboratorioAcceso'] = $LaboratorioAcceso;
            
            $jsondata['error'] = "ok";
             
        mysql_free_result($Result);
    } else {
           $jsondata['error'] = "Error al Consultar";
    }
     echo json_encode($jsondata);
    exit;
}


?>