<?php
#AGREGADO: Ivan Mauricio Melo Granados
#FECHA: 29/05/2014 
$fk_nivelestudio = "";
$result = $ConsultaDB->ConsultaNiveldeEstudios();
while ($row = mysql_fetch_assoc($result)) {
    $fk_nivelestudio .= "<option value='$row[pk_nivelestudio]'>$row[descripcion]</option>";
}
mysql_free_result($result);


$Carreras = "";
$result = $ConsultaDB->ConsultaCarreras();
while ($row = mysql_fetch_assoc($result)) {
    $Carreras .= "<option name='Pk_carreras[]' value='$row[pk_carreras]'>$row[clvCarrera]</option>";
}
mysql_free_result($result);
?>

<script>
    $(function() {
        $.ajax({
            url: pathSinodales + 'lista_DatosSinodalesEliminar.php',
            type: 'post',
            data: "ListaSinodales=ListaSinodales",
            success: function(data) {
                if (data != "") {
                    $("#Lista").html(data);
                }
            }

        });//fin ajax 


        //dados de baja
        $.ajax({
            url: pathSinodales + 'lista_DatosSinodalesBaja.php',
            type: 'post',
            data: "ListaSinodales=ListaSinodales",
            success: function(data) {
                if (data != "") {
                    $("#ListaBaja").html(data);
                }
            }

        });//fin ajax 




    });


</script>  

<div id="page-content">
    <div id='wrap'>
        <div id="page-heading">
            <ol class="breadcrumb">
                <li><a href="<?php echo Config::PAG_ADMIN . "?content=home2"; ?>">Inicio</a></li>
                <li class="active">Sinodales</li>
            </ol>

            <h1>Sinodales</h1>
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
                    <h4><i class="icon-cloud"></i> Baja/Recuperación Sinodales</h4>
                    <div class="options">
                        <ul class="nav nav-tabs">
                
                            <li class="active">
                                <a href="#listadosinodales" data-toggle="tab">  Listado Sinodales</a>
                            </li>
                            <li>
                                <a href="#profile1" data-toggle="tab">  Recuperar Baja</a>
                            </li>

                        </ul>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="tab-content">

                       <div class="tab-pane active"  id="listadosinodales">
                            <div id="Lista"></div>  




                        </div>



                        <div class="tab-pane" id="profile1">
                            <div id="ListaBaja"></div>  




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
