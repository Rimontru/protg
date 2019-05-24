<?php
$Ruta = "../../";
require($Ruta . "Config.class.php");  # Cargar datos conexion y otras variables.
require($Ruta . "InsertarDB.class.php");
require($Ruta . "ConsultaDB.class.php");
require($Ruta . "MisValidaciones.class.php");

extract($_POST);
$Consulta = new ConsultaDB;


$mtdo = $_POST["cmb_search"];
switch ($mtdo) {
    case 1:
        $opcion = "CONCAT(TRIM(a.nombre),' ',TRIM(a.apaterno),' ',TRIM(a.amaterno)) LIKE '%".$txt_parametro."%'";
        break;
    case 2:
        $opcion = "a.matricula LIKE '%".$txt_parametro."%'";
        break;
    case 3:
        if(isset($txt_carrera) && isset($txt_nivelestudio) && isset($txt_modalidad) && isset($fk_generacion)){
            $opcion = " a.fk_carreras = '$txt_carrera' AND a.fk_nivelestudio = '$txt_nivelestudio' AND a.fk_modalidad='$txt_modalidad' AND a.fk_generacion = '$fk_generacion' ";
        }else{
            $opcion = " a.fk_carreras = '' AND a.fk_nivelestudio = '' AND a.fk_modalidad='' AND a.fk_generacion = '' ";
        }
        break;
    case 4:
        $opcion = "a.Activo_Alumno = ".$txt_parametro;
        break;

}
$rows = $Consulta->busquedaPorParametros($opcion);
$cont = 0;
if($rows){ 
    echo "<table class='table table-striped table-hover table-condensed'>
    <thead>
        <tr>
            <th><center>Matricula</center></th>
            <th><center>Nombre</center></th>
            <th><center>E-mail</center></th>
            <th><center>Cel.</center></th>
            <th><center>Carrera</center></th>
            <th><center>Titulado</center></th>
            <th><center>Credencial</center></th>
            <th><center>Num. Generación</center></th>
            <th><center>Estatus</center></th>            
            <th><center>Acciones</center></th>
        </tr>
    </thead>
    <tbody>";
    foreach ($rows as $val) {
        if($val->fk_estadoTitulacion == 1){
            $stdTitulo = "Titulado";
        }else if($val->fk_estadoTitulacion == 2){
            $stdTitulo = "No Titulado";
        }else{
            $stdTitulo = "No Aplica";
        }
        if($val->estatusCredencial == 1){
            $creden = "Si";
        }else if($val->estatusCredencial == 2){
            $creden = "No";
        }else{
            $creden = "";
        }
        if($val->Activo_Alumno == 2 ) 
            $status = '<font color="red">Difunto</font>'; 
        else $status= '<font color="green">Vivo</font>';

        echo "<tr>
            <td align='left'>".$val->matricula."</td>
            <td>".$val->nombre." ".$val->apaterno." ".$val->amaterno."</td>
            <td>".$val->correo."</td>
            <td>".$val->telefonocelular."</td>
            <td>".$val->nombreCarrera."</td>
            <td><center>".$stdTitulo."</center></td>
            <td><center>".$creden."</center></td>
            <td><center>".$val->generacionNumero."</center></td>
            <td><center>".$status."</center></td>
            <td>
                <a data-toggle='modal' href='#myDetalles' type='button' class='btn btn-default' title='Ver Detallles' onclick='detalleAlumno(".$val->pk_alumno.")'><i class='icon-zoom-in'></i></a>
            </td>
        </tr>";
        $cont++;
    }
    echo "
            <tr>
                <td>

                </td>
            </tr>
        </tbody>
        <caption>Resultado de la Busqueda <b>".$cont."</b> Registro(s) encontrados</caption>";
    ?>
    <div class="options">
                <div class="btn-toolbar">
                    <div class="btn-group hidden-xs">
                        <a href="#" class="btn btn-muted dropdown-toggle" data-toggle="dropdown">
                            <i class="icon-cloud-download"></i>
                            <span class="hidden-sm"> Exportar como  </span>
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- <li><a href="#">Excel (*.xlsx)</a></li> -->
                            <li><a href="#" id="reportePorBusqueda">PDF (*.pdf)</a></li>
                        </ul>
                    </div>
                </div>
            </div>
    <?php     
    echo "</table>";
}else{
    echo '<div class="alert alert-dismissable alert-info">
    <strong>Ups!</strong> No se encontró ninguna coincidencia.
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>';
}

?>
<script>
    $("#reportePorBusqueda").click(function(){
        type_search = $("#txt_parametro").val();
        if (type_search == 2) {
           window.open('../../../includes/ajax/Egresados/Reportes/ReporteSeguimientoDifuntos.php?type_search=2');
        }
    });
