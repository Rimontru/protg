<?php
$real=('../');
include($real."clases/pathSistem/fullPaths.php"); #contiene tadas las urls php requeridas
require_once($real.$params_db);
require_once($real.$conexion_db);
require_once($real.$consultas_db);
require_once($real.$editor_txt);
require_once($real.$conversor_txt);
require_once($real.$validador_cad);

#llamadas MyClass Full
$db= new conexion(); 
$cons= new consultas();
?>
<div class="panel panel-primary">
    <div class="panel-heading">
        Generar Reportes 
        <i class="fa fa-refresh fa-1x" style="float:right;"></i> 
    </div>
    <div class="panel-body">
    	<form id="form_imprimeReporte">
            <table>
                <tr>
                    <td>
                        <label>Periodo</label>
                    </td>
                    <td>
                        <select class="form-control" name="periodo">
                        <?php
                            echo '<option value="NULL">---------------------seleccione---------------------</option>'.
                            $result=$cons->verPeriodos();
                            while($row=$db->getRows($result)){ extract($row);
                                $fechPer='a'.$fecha_inicial.'|'.'a'.$fecha_final;
                                echo '<option value="'.$fechPer.'">'.$descripcion_periodo.'</option>';
                            }
                        ?>
                        </select>
                    </td>
                    <td>
                        <select class="form-control" name="anio">
                        <?php
                            echo '<option value=" ">---------------------seleccione---------------------</option>';
                            for($anio=2017; $anio<=2025; $anio++){
                                echo '<option value="'.$anio.'">'.$anio.'</option>';
                            }
                        ?>                                    </select>
                    </td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>
                        <label>Preguntas</label>
                    </td>
                    <td>
                        <select class="form-control" name="pregunta">
                        <?php
                            echo '<option value=" ">---------------------seleccione---------------------</option>'.
                            $result=$cons->verPreguntas();
                            while($row=$db->getRows($result)){ extract($row);
                                echo '<option value="'.$pk_pregunta.'">'.$num_pregunta.'. '.$desc_pregunta.'</option>';
                            }
                        ?>
                        </select>
                    </td>
                    <td>&nbsp;</td>
                </tr>
                <input class="btn btn-primary" type="button" value="Generar" onclick="generaReporteEncuestaPDF()"/>
                
            </table>
        </form>
    </div>
</div>