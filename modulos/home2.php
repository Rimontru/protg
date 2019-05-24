<?php 

$permitidos = array( 108, 104, 55 ); 
    
if(isset($_POST['fechacumple'])){
    $fechaBus =  $_POST['fechacumple'];
}else{
    $fechaBus = '';
}
?>

  <link href="assets/css/styles.min.css" rel="stylesheet" type='text/css' media="all" />
    <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600' rel='stylesheet' type='text/css' />

     
        <link href='assets/demo/variations/default.css' rel='stylesheet' type='text/css' media='all' id='styleswitcher' /> 
    
            <link href='assets/demo/variations/default.css' rel='stylesheet' type='text/css' media='all' id='headerswitcher' /> 
    
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries. Placeholdr.js enables the placeholder attribute -->
    <!--[if lt IE 9]>
        <script type="text/javascript" src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/respond.js/1.1.0/respond.min.js"></script>
        <script type="text/javascript" src="assets/plugins/charts-flot/excanvas.min.js"></script>
        <link rel="stylesheet" href="assets/css/ie8.css">
    <![endif]-->

    <!-- The following CSS are included as plugins and can be removed if unused-->

<link rel='stylesheet' type='text/css' href='assets/plugins/form-daterangepicker/daterangepicker-bs3.css' /> 
<link rel='stylesheet' type='text/css' href='assets/plugins/fullcalendar/fullcalendar.css' /> 
<link rel='stylesheet' type='text/css' href='assets/plugins/form-markdown/css/bootstrap-markdown.min.css' /> 
<link rel='stylesheet' type='text/css' href='assets/plugins/codeprettifier/prettify.css' /> 
<link rel='stylesheet' type='text/css' href='assets/plugins/form-toggle/toggles.css' /> 

<div id="page-content">
    <div id='wrap'>
        <div id="page-heading">
            <ol class="breadcrumb">
                <li class='active'><a href="<?php echo Config::PAG_ADMIN . "?content=home2"; ?>">Inicio</a></li>
            </ol>

            <h1>Programa de Titulación y Grado</h1>
            <!-- <div class="options">
                <div class="btn-toolbar">
                    <button class="btn btn-default">
                        <span class="hidden-xs hidden-sm"><div id="fechesita"></div></span>
                    </button>
                </div>
            </div> -->
        </div>


        <div class="container">



            <div class="tab-content">
                <div class="tab-pane active" id="domshortcuttiles">
                    <div class="row">
                        <div class="col-md-2">
                            <a href="<?php echo Config::PAG_ADMIN . "?content=Alumnos"; ?>"  class="shortcut-tiles tiles-success">
                                <div class="tiles-body">
                                    <div class="pull-left"><i class="icon-group"></i></div>

                                </div>
                                <div class="tiles-footer">
                                   <br> Alumnos
                                </div>
                            </a>
                        </div>
                        <div class="col-md-2">
                            <a href="<?php echo Config::PAG_ADMIN . "?content=ExamenInstitucional"; ?>"  class="shortcut-tiles tiles-info">
                                <div class="tiles-body">
                                    <div class="pull-left"><i class="icon-tasks"></i></div>
                                    <div class="pull-right"><span class="badge"></span></div>
                                </div>
                                <div class="tiles-footer">
                                    <br>Exámen Inst.
                                </div>
                            </a>
                        </div>
                        <div class="col-md-2">
                            <a href="<?php echo Config::PAG_ADMIN . "?content=TomaProtesta"; ?>"  class="shortcut-tiles tiles-orange">
                                <div class="tiles-body">
                                    <div class="pull-left"><i class="icon-credit-card"></i></div>
                                    <div class="pull-right"><span class="badge"></span></div>
                                </div>
                                <div class="tiles-footer">
                                    <br>Toma de Protesta
                                    
                                </div>
                            </a>
                        </div>
                        
                        <div class="col-md-2">
                            <a href="<?php echo Config::PAG_ADMIN . "?content=Sinodales"; ?>" class="shortcut-tiles tiles-magenta">
                                <div class="tiles-body">
                                    <div class="pull-left"><i class="icon-suitcase"></i></div>
                                    <div class="pull-right"><span class="badge"></span></div>
                                </div>
                                <div class="tiles-footer">
                                   <br> Sinodales
                                </div>
                            </a>
                        </div>
                        <div class="col-md-2">
                            <a href="<?php echo Config::PAG_ADMIN . "?content=vi_Egresados"; ?>" class="shortcut-tiles tiles-midnightblue">
                                <div class="tiles-body">
                                    <div class="pull-left"><i class="icon-eye-open"></i></div>
                                    <div class="pull-right"><span class="badge"></span></div>
                                </div>
                                <div class="tiles-footer">
                                   <br> Egresados
                                </div>
                            </a>
                        </div>
                        <div class="col-md-2">
                            <a href="<?php echo Config::PAG_ADMIN . "?content=EgresadosReportes"; ?>" class="shortcut-tiles tiles-green">
                                <div class="tiles-body">
                                    <div class="pull-left"><i class="icon-bar-chart"></i></div>
                                    <div class="pull-right"><span class="badge"></span></div>
                                </div>
                                <div class="tiles-footer">
                                   <br> Reportes Egresados
                                </div>
                            </a>
                        </div>
                        <!--<div class="col-md-2">
                            <a href="" class="shortcut-tiles tiles-green" onclick="filtro_egresados();">
                                <div class="tiles-body">
                                    <div class="pull-left"><i class="icon-bar-chart"></i></div>
                                    <div class="pull-right"><span class="badge"></span></div>
                                </div>
                                <div class="tiles-footer">
                                   <br> filtro egresados
                                </div>
                            </a>
                        </div>-->
                    </div>
                    
                    
                    
                </div>
               
            </div>
            
            <?php 
            if(in_array($_SESSION['usuario_id'], $permitidos)){
                if($fechaBus != ''){
                    $f = explode("/", $fechaBus);
                    $dia = $f[0];
                    $mes = $f[1];
                }else{
                    $fechaBus = date("d/m/Y");
                    $dia = date("d");
                    $mes = date("m");
                }
                $rowCumples = $ConsultaDB->cumples($dia, $mes);
                
            ?>

            <form class="form-horizontal" method="post" action="<? echo Config::PAG_ADMIN . "?content=home2"; ?>">
                <div class="form-group">
                    <div class="col-lg-2">
                        <input type="text" value="<? echo $fechaBus; ?>" class="form-control :apostrofe" placeholder="99/99/9999"  name="fechacumple" id="fechacumple" />
                    </div>
                    <div class="col-lg-1"><button class="btn btn-primary"><i class=" icon-search"></i> Buscar</button></div>
                </div>
            </form>
            <div class="row">
                <div class="col-lg-10">
                    <div class="panel gray">
                        <div class="panel-heading rounded-bottom">
                                <h4><li class="icon-gift"></li> Cumpleañeros <small id="fechesita"><? echo $Funciones->Fechaformato($fechaBus); ?></small></h4>
                                <div class="options">  
                                    <button class="btn btn-muted" title="Enviar Correo de Felicitaciones"><i class="icon-envelope-alt"></i> Enviar</button>
                                    <div class="btn-group hidden-xs">
                                        <a href="#" class="btn btn-muted dropdown-toggle" data-toggle="dropdown"><i class="icon-cloud-download"></i><span class="hidden-xs hidden-sm hidden-md"> Exportar como</span> <span class="caret"></span></a>
                                        <ul class="dropdown-menu">
                                            <li><a style="cursor: pointer" onclick="reporteExcelcumple()">Archivo e Excel (*.xlsx)</a></li>
                                            <li><a style="cursor: pointer" onclick="reporteExcel()">Archivo PDF (*.pdf)</a></li>
                                        </ul>
                                    </div>
                                    <a href="javascript:;" class="panel-collapse"><i class="icon-chevron-up"></i></a>
                                </div>
                        </div>
                        <div class="panel-body collapse">
                            <div class="table-responsive" style="overflow-x:auto">
                                <?php if($rowCumples){ ?>
                                <table class="table table-condensed table-striped table-hover" id="alumno">
                                    <thead>
                                        <tr>
                                            <th><input type="checkbox" id="select-all" /></th>
                                            <th>Matricula</th>
                                            <th>Nombre</th>
                                            <th>E-mail</th>
                                            <th>Celular</th>
                                        </tr>
                                    </thead>
                                    <tbody class="selects">
                                        <?php $cont=0;
                                         foreach ($rowCumples as $key) { ?>
                                        <tr>
                                            <td><input type="checkbox" class="" /></td>
                                            <td><?php echo $key->matricula?></td>
                                            <td><?php echo $key->nombre.' '.$key->apaterno.' '.$key->amaterno; ?></td>
                                            <td><?php echo $key->correo; ?></td>
                                            <td><?php echo $key->telefonocelular; ?></td>
                                        </tr>
                                        <?php
                                            $cont++;
                                         } 
                                         if($cont == 1 ) $leyenda = "Registro"; else $leyenda = "Registros";
                                          ?>
                                    </tbody>
                                    <tfoot>
                                        <tr class="active">
                                            <td colspan="4" class="text-left">
                                                <label for="action" style="margin-bottom:0"><?php echo $cont.' '.$leyenda; ?></label>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                                <?php }else{ ?>
                                <div class="alert alert-dismissable alert-info">
                                    <strong>Ups!</strong> No tenemos cumpleañeros el dia de hoy.
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php 
            
        } ?>
        </div> <!-- container -->
    </div> <!--wrap -->
</div> <!-- page-content -->

<script type='text/javascript'> 
    $('a.panel-collapse').click(function() {
        $(this).children().toggleClass("icon-chevron-down icon-chevron-up");
        $(this).closest(".panel-heading").next().toggleClass("in");
        $(this).closest(".panel-heading").toggleClass('rounded-bottom');
        return false;
    });
	
	/*function filtro_egresados(){
		
		window.open('modulos/rptErrores.php');
	}	*/
</script> 
