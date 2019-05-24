<?php
/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   vi_GroupGeneraciones.php                           :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: anonymous <anonymous@student.42.fr>        +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2018/02/06 10:35:37 by anonymous         #+#    #+#             */
/*   Updated: 2018/02/06 11:28:23 by anonymous        ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */
###@MonkyDevelopper!###

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

$NivelEstudio = "";
$result = $ConsultaDB->obtenerNivelestudio();
while ($row = mysql_fetch_assoc($result)) {
    $NivelEstudio .= "<option value='$row[pk_nivelestudio]'>$row[descripcion]</option>";
}
mysql_free_result($result);


?>
<div id="page-content">
    <div id='wrap'>
        <div id="page-heading">
            <ol class="breadcrumb">
                <li><a href="<?php echo Config::PAG_ADMIN . "?content=home2"; ?>">Inicio</a></li>
                <li><a href="#">Herramientas</a></li>
                <li class="active">Auxiliar: Agrupar</li>
            </ol>

            <h1>Agrupar Generaciones</h1>
            <div class="options">
                <div class="btn-toolbar">
                    <div class="btn-group hidden-xs"></div>
                    <a href="#" class="btn btn-muted"><i class="icon-cog"></i></a>
                </div>
            </div>
        </div>

        <div class="container">

            <div class="panel">
                <div class="panel-heading">
                    <h4><i class="icon-cloud"></i>Agrupar Gen.</h4>
                    <div class="options">
                        <ul class="nav nav-tabs">
                            <li class="active">
                                <a href="#home1" data-toggle="tab"> Agrupar Gen.</a>
                            </li>


                        </ul>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="tab-content">
                        <div class="tab-pane active" id="home1">




                            <div class="col-md-12">

                                <!--start row 1-->      
                                <div class="row">
                                    

                                    <!--Inicia boxReporte sinodales porcarrera-->
                                    <div class="col-md-12">
                                        <div class="panel panel-midnightblue">
                                            <div class="panel-heading">
                                                <h4>Agrupar Generaciones  </h4>
                                                <div class="options">

                                                </div>
                                            </div>
                                              <form action="#" class="form-horizontal" name="f_completar_datos_generaciones" id="f_completar_datos_generaciones" />
                                               <div class="panel-body collapse in"> 
                                                       <div class="form-group">
                                                            <label class="col-sm-3 control-label" for="fk_nivelestudio">Nivel de Estudios:</label>
                                                            <div class="col-sm-6">
                                                                <select class="form-control :required" name="fk_nivelestudio" id="fk_nivelestudio">
                                                                    <option value="">-- Seleccione --</option>
                                                                    <?php
                                                                    echo $NivelEstudio;
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div> 

                                                        <div class="form-group">
                                                            <label class="col-sm-3 control-label" for="fk_modalidad">Modalidad:</label>
                                                            <div class="col-sm-6">
                                                                <select class="form-control :required" name="fk_modalidad" id="fk_modalidad">
                                                                    <option value="">-- Seleccione --</option>
                                                                    <?php
                                                                    echo $Modalidad;
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div> 

                                                          <div class="form-group">
                                                            <label class="col-sm-3 control-label" for="fk_modalidad">Carreras:</label>
                                                            <div class="col-sm-6">
                                                                <select class="form-control :required" name="fk_carreras" id="fk_carreras">
                                                                    <option value="">-- Seleccione --</option>
                                                                   
                                                                </select>
                                                            </div>
                                                        </div> 
                                                   
                                               
                                                   
                                                     <div class="form-group">
                                                            <label class="col-sm-3 control-label" for="fk_generacion">Generacion</label>
                                                            <div class="col-sm-6">
                                                                <select class="form-control :required" name="fk_generacion" id="fk_generacion">
                                                                    <option value="">-- Seleccione --</option>
                                                                    <?php
                                                                    echo $Generacion;
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div>    

                                                        <div class="form-group">
                                                            <label class="col-sm-3 control-label" for="">Plan de estudio</label>
                                                            <div class="col-sm-6">
                                                                <input type="text" class="form-control :required :apostrofe"  name="desc_planestudios" id="desc_planestudios" title="ESTE CAMPO ES REQUERIDO" autofocus/>
                                                            </div>
                                                        </div>


                                                        <div class="form-group">
                                                            <label class="col-sm-3 control-label" for="">No. de semestres</label>
                                                            <div class="col-sm-6">
                                                                <input type="text" class="form-control :required :apostrofe"  name="no_sem" id="no_sem" title="ESTE CAMPO ES REQUERIDO" autofocus/>
                                                            </div>
                                                        </div>



                                                        <div class="form-group">
                                                            <label class="col-sm-3 control-label" for="">Cupo del grupo</label>
                                                            <div class="col-sm-6">
                                                                <input type="text" class="form-control :required :apostrofe"  name="total_grupo" id="total_grupo" title="ESTE CAMPO ES REQUERIDO" autofocus/>
                                                            </div>
                                                        </div>                                            
                                                   
                                                        
                                                   
                                                   
                                                   
                                                   
<center> 
                                                          <button name="completarGeneraciones" id="completarGeneraciones" class="btn btn-primary start" type="submit">
                                                            <i class="fa fa-save"></i>
                                                            <span>Completar Datos</span>
                                                        </button> 
    
                                                        <!--End Boton Sinodal-->    
                                                </fieldset>  
                                                            
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div><!--End Row 1-->
                            <!--ANTES DE ESTO PUEDES METER TODOS LOS CONTENEDORES QUE KIERAS-->
                    </div>
                </div>
            </div>
        </div>
    </div>

</div> <!-- container -->
</div> <!--wrap -->
</div> <!-- page-content -->



</div>

<link rel='stylesheet' type='text/css' href='assets/plugins/codeprettifier/prettify.css' /> 
<link rel='stylesheet' type='text/css' href='assets/plugins/form-toggle/toggles.css' /> 