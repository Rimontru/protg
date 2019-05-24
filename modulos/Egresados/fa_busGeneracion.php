<?php 
$ruat = '../../';
include($ruat.'conf.php');

require($ruat."includes/Config.class.php");  # Cargar datos conexion y otras variables.
require($ruat.'includes/DB.class.php');
include_once($ruat."includes/ConsultaDB.class.php");
$db = new database;		#referenciamos la clase de la base de datos
$db->conectar();
$ConsultaDB = new ConsultaDB();


$fk_nivelestudio = "";
$result = $ConsultaDB->ConsultaNiveldeEstudios();
while ($row = mysql_fetch_assoc($result)) {
    $fk_nivelestudio .= "<option value='$row[pk_nivelestudio]'>$row[descripcion]</option>";
}
mysql_free_result($result);

$Modalidad = "";
$result = $ConsultaDB->obtenerModalidad();
while ($row = mysql_fetch_assoc($result)) {
    $Modalidad .= "<option value='$row[pk_modalidad]'>$row[nombreMod]</option>";
}
mysql_free_result($result);

$Generacion = "";
$result = $ConsultaDB->ConsultaGeneraciones();
while ($row = mysql_fetch_assoc($result)) {
    $Generacion .= "<option value='$row[pk_generacion]'>$row[GeneracionDescripcion]</option>";
}
mysql_free_result($result);

?>


<div class="form-group">
<!--     <label class="col-lg-2 control-label" for="txt_nivelestudio">Nivel de Estudios:</label> -->
    <div class="col-sm-3">
        <select class="form-control :required" name="fk_generacion" id="fk_generacion">
            <option value="0">-- Generaciones --</option>
            <?php
            echo $Generacion;
            ?>
        </select>
    </div>

    <div class="col-lg-2">
        <select class="form-control :required" name="txt_nivelestudio" id="txt_nivelestudio">
        	<option value="">-- Nivel de estudio --</option>
            <?php echo $fk_nivelestudio; ?>
        </select>
    </div>
<!-- </div>

<div class="form-group"> -->
    <!-- <label class="col-lg-2 control-label" for="txt_modalidad">Modalidad:</label> -->
    <div class="col-lg-2">
        <select class="form-control :required" name="txt_modalidad" id="txt_modalidad">
        	<option value="">-- Modalidad --</option>
            <?php echo $Modalidad; ?>
        </select>    
    </div>

<!--     <label class="col-lg-2 control-label" for="txt_carrera">Carreras:</label> -->
    <div class="col-lg-5">
        <select class="form-control :required" name="txt_carrera" id="txt_carrera">
            <option value="">-- Carreras --</option>
        </select>    
    </div>
<!-- </div>
<div class="form-group"> -->
<!--     <label class="col-sm-2 control-label" for="fk_generacion">Generacion</label> -->
    
</div>

<script src="js/Sistema/fn_Busqueda.js"></script>