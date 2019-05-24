<?php
$usuarios_sesion = "PROTG2";
date_default_timezone_set('America/Mexico_City');
setlocale(LC_ALL,"es_ES");
if (isset($_GET['content'])) {
    $pcompleta = $_GET['content'];
} else {
    $pcompleta = '';
}

if (($pcompleta == 'salir')) {
    include('modulos/salir.php');
}

 include('reportes_protg.php');


if ($pcompleta == 'home' or $pcompleta == '') {
    header("Cache-Control: no-cache, must-revalidate");   // No almacenar en el cache del navegador esta pagina.
    header("Pragma: no-cache");
}

include_once("includes/ConsultaDB.class.php");
$ConsultaDB = new ConsultaDB();     //creamos el objeto $ConsultaDB a partir de la clase ConsultaDB

if ($pcompleta != 'home' and $pcompleta != '') {
    require("includes/aut_verifica.inc.php");
//                $nivel_acceso=37;
//                if ($nivel_acceso <= $_SESSION['usuario_departamento']){
//                        header ("Location: $redir?error_login=5");
//                        exit;
//                }
    $_SESSION['IP'] = $_SERVER['REMOTE_ADDR'];

    /* Obtenemos los permisos del usuario logeado */
    if ($_SESSION['Tipo_User'] != "Administrador") {
        $resultMenu = $ConsultaDB->ConMenuXIdUsuario($_SESSION['usuario_id'], $pcompleta);
        $num = mysql_num_rows($resultMenu);
        mysql_free_result($resultMenu);

        if ($num == 0) {
            $path_modulo = MODULO_PATH . '/' . $conf['PermisoDenegado']['archivo'];
        }
    }//fin del if
    $ConsultaDB->UsuarioOnline($_SESSION['usuario_id']);
}
?>
<!doctype html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <title>Programa de Titulación y Grado| 2.0</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="description" content="PROTG" />
        <meta name="author" content="Ing. Ricardo Elias Mondragon Trujillo" />

        <link href="assets/css/styles.min.css" rel="stylesheet" type='text/css' media="all" />
        <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600' rel='stylesheet' type='text/css' />


        <link href='assets/demo/variations/default.css' rel='stylesheet' type='text/css' media='all' id='styleswitcher' />

        <link href='assets/demo/variations/default.css' rel='stylesheet' type='text/css' media='all' id='headerswitcher' />


        <link rel='stylesheet' type='text/css' href='assets/plugins/form-daterangepicker/daterangepicker-bs3.css' />
        <link rel='stylesheet' type='text/css' href='assets/plugins/fullcalendar/fullcalendar.css' />
        <link rel='stylesheet' type='text/css' href='assets/plugins/form-markdown/css/bootstrap-markdown.min.css' />
        <link rel='stylesheet' type='text/css' href='assets/plugins/codeprettifier/prettify.css' />
        <link rel='stylesheet' type='text/css' href='assets/plugins/form-toggle/toggles.css' />
        <link rel='stylesheet' type='text/css' href='assets/plugins/datatables/dataTables.css' />
        <link rel='stylesheet' type='text/css' href='assets/plugins/codeprettifier/prettify.css' />
        <link rel='stylesheet' type='text/css' href='assets/plugins/form-toggle/toggles.css' />
        <link rel='stylesheet' type='text/css' href='assets/plugins/form-select2/select2.css' />
        <link rel='stylesheet' type='text/css' href='assets/plugins/form-multiselect/css/multi-select.css' />
        <link rel='stylesheet' type='text/css' href='assets/plugins/jqueryui-timepicker/jquery.ui.timepicker.css' />
        <link rel='stylesheet' type='text/css' href='assets/plugins/form-daterangepicker/daterangepicker-bs3.css' />
        <link rel='stylesheet' type='text/css' href='assets/js/jqueryui.css' />
        <link rel='stylesheet' type='text/css' href='assets/css/modal.css' />


        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link href="assets/img/iconos/protg_icon.ico" rel="icon" type="image/x-icon">

        <script type='text/javascript' src='assets/js/jquery-1.10.2.min.js'></script>
        <script type='text/javascript' src='assets/js/jqueryui-1.10.3.min.js'></script>

        <script type='text/javascript' src='assets/js/bootstrap.min.js'></script>
        <script type='text/javascript' src='assets/js/enquire.js'></script>
        <script type='text/javascript' src='assets/js/jquery.cookie.js'></script>
        <script type='text/javascript' src='assets/js/jquery.touchSwipe.min.js'></script>
        <script type='text/javascript' src='assets/js/jquery.nicescroll.min.js'></script>
        <script type='text/javascript' src='assets/plugins/codeprettifier/prettify.js'></script>
        <script type='text/javascript' src='assets/plugins/easypiechart/jquery.easypiechart.min.js'></script>
        <script type='text/javascript' src='assets/plugins/sparklines/jquery.sparklines.min.js'></script>
        <script type='text/javascript' src='assets/plugins/form-toggle/toggle.min.js'></script>
        <script type='text/javascript' src='assets/plugins/form-wysihtml5/wysihtml5-0.3.0.min.js'></script>
        <script type='text/javascript' src='assets/plugins/form-wysihtml5/bootstrap-wysihtml5.js'></script>
        <script type='text/javascript' src='assets/plugins/fullcalendar/fullcalendar.min.js'></script>
        <script type='text/javascript' src='assets/plugins/form-daterangepicker/daterangepicker.min.js'></script>
        <script type='text/javascript' src='assets/plugins/form-daterangepicker/moment.min.js'></script>
        <script type='text/javascript' src='assets/plugins/charts-flot/jquery.flot.min.js'></script>
        <script type='text/javascript' src='assets/plugins/charts-flot/jquery.flot.resize.min.js'></script>
        <script type='text/javascript' src='assets/plugins/charts-flot/jquery.flot.orderBars.min.js'></script>
        <script type='text/javascript' src='assets/demo/demo-index.js'></script>

        <script type='text/javascript' src='assets/plugins/form-toggle/toggle.min.js'></script>
        <script type='text/javascript' src='assets/plugins/form-inputmask/jquery.inputmask.bundle.min.js'></script>
        <script type='text/javascript' src='assets/demo/demo-mask.js'></script>

        <script type='text/javascript' src='assets/plugins/quicksearch/jquery.quicksearch.min.js'></script>
        <script type='text/javascript' src='assets/plugins/form-typeahead/typeahead.min.js'></script>
        <script type='text/javascript' src='assets/plugins/form-select2/select2.min.js'></script>
        <script type='text/javascript' src='assets/plugins/form-autosize/jquery.autosize-min.js'></script>
        <script type='text/javascript' src='assets/plugins/form-ckeditor/ckeditor.js'></script>
        <script type='text/javascript' src='assets/plugins/form-multiselect/js/jquery.multi-select.min.js'></script>
        <script type='text/javascript' src='assets/demo/demo-formcomponents.js'></script>
        <script type='text/javascript' src='assets/plugins/form-colorpicker/js/bootstrap-colorpicker.min.js'></script>
        <script type='text/javascript' src='assets/plugins/jqueryui-timepicker/jquery.ui.timepicker.min.js'></script>



        <script type='text/javascript' src='assets/js/placeholdr.js'></script>
        <script type='text/javascript' src='assets/js/application.js'></script>
        <script type='text/javascript' src='assets/demo/demo.js'></script>



       <!-- datatables -->
        <script type='text/javascript' src='assets/plugins/datatables/jquery.dataTables.js'></script>
        <script type='text/javascript' src='assets/plugins/datatables/dataTables.bootstrap.js'></script>
        <script type='text/javascript' src='assets/demo/demo-datatables.js'></script>

        <!-- google maps -->
        <!--<script type='text/javascript' src='http://maps.google.com/maps/api/js?sensor=true'></script>-->
<!--        <script type='text/javascript' src='assets/plugins/gmaps/gmaps.js'></script>
        <script type='text/javascript' src='assets/demo/demo-gmaps.js'></script> -->

        <!-- JS alerts -->
        <script type='text/javascript' src='assets/js/alertify.js-0.3.11/lib/alertify.min.js'></script>
        <link rel='stylesheet' type='text/css' href='assets/js/alertify.js-0.3.11/themes/alertify.core.css' />
        <link rel='stylesheet' type='text/css' href='assets/js/alertify.js-0.3.11/themes/alertify.default.css' />

        <!-- JS propios -->
        <script src="js/Sistema/ExpiredSession.js"></script>
        <script src="js/Sistema/Ruta.js"></script>
        <script src="js/Sistema/Sistema.js"></script>
        <script src="js/Sistema/Sistema_Alta.js"></script>
        <script src="js/Sistema/Sistema_Modificacion.js"></script>
        <script src="js/Sistema/Sistema_Eliminar.js"></script>
        <script src="js/Sistema/Sistema_Consulta.js"></script>

          <script src="js/Sistema/Sistema_C.js"></script>
        <script src="js/Sistema/Sistema_Alta_C.js"></script>
        <script src="js/Sistema/Sistema_Modificacion_C.js"></script>
        <script src="js/Sistema/Sistema_Eliminar_C.js"></script>
        <script src="js/Sistema/Sistema_Consulta_C.js"></script>
        <script type="text/javascript" src="js/plupload-2.1.2/js/plupload.full.min.js"></script>

        <script src="js/Sistema/vanadium_es.js"></script>
        <script src="js/Sistema/fn_Funciones.js"></script>
        <script src="js/Sistema/fn_Busqueda.js"></script>
        <script src="js/Sistema/Sistema_newGeneration.js"></script>

    </head>
    <body>

    <?php
    if (!(($pcompleta == 'home') or ($pcompleta == ''))) {
        include("includes/navbar.php");
    }
    ?>

    <div id="page-container">
    <?php
     if (!(($pcompleta == 'home') or ($pcompleta == ''))) {
        include("includes/menu_derecho.php");
    }


    if (file_exists($path_modulo))
        include( $path_modulo );
    else
        die('Error al cargar el mdulo <b>' . $modulo . '</b>. No existe el archivo <b>' . $conf[$modulo]['archivo'] . '</b>');
    ?>

        <!-- Modal
        <div id="ModalPrincipal" class="ventana">
            <div id="Close" style="text-align: right;right: 16px;">
                <li class="icon-remove icon-2x" onClick="$('#ModalPrincipal').css('display','none'); $('#contenido_modal').html('');" style="cursor:pointer" title="Cerrar"></li>
            </div>
            <div id="contenido_modal" ></div>
        </div>


        <footer role="contentinfo">
            <div class="clearfix">
                <ul class="list-unstyled list-inline">
                    <li>Derechos Reservados &copy; 2018</li>
                    li class="pull-right"><a href="javascript:;" id="back-to-top">Top <i class="icon-arrow-up"></i></a></li
                    <button class="pull-right btn btn-inverse btn-xs" id="back-to-top" style="margin-top: -1px; text-transform: uppercase;"><i class="icon-arrow-up"></i></button>
                </ul>
            </div>
        </footer>

    </div>-->
    <div class="row"><b>
        <div class="col-md-4 text-center">Derechos Reservados &copy; 2018</div>
        <div class="col-md-4 text-center">INSTITUTO DE ESTUDIOS SUPERIORES DE CHIAPAS</div>
        <div class="col-md-4 text-center"><?php echo date('l').',    '.date('d/M/Y'); ?></div></b>
    </div>
</body>
</html>
