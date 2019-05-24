<?php
$usuarios_sesion = "PROTG2";
if (isset($_GET['content'])) {
    $pcompleta = $_GET['content'];
} else {
    $pcompleta = '';
}

if (($pcompleta == 'salir')) {
    include('modulos/salir.php');
}



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
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>InLab v1</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="description" content="Control de Inventarios" />
        <meta name="author" content="Ing. Mauricio Melo Granados" />

        <!--<link href="assets/css/styles.min.css" rel="stylesheet" type='text/css' media="all" />-->
        <!--<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600' rel='stylesheet' type='text/css' />-->


        <!--<link href='assets/demo/variations/default.css' rel='stylesheet' type='text/css' media='all' id='styleswitcher' />--> 

        <!--        <link href='assets/demo/variations/default.css' rel='stylesheet' type='text/css' media='all' id='headerswitcher' /> -->


        <!--        <link rel='stylesheet' type='text/css' href='assets/plugins/form-daterangepicker/daterangepicker-bs3.css' /> 
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
                <link rel='stylesheet' type='text/css' href='assets/js/jqueryui.css' /> -->

        <link href="./css/bootstrap.min.css" rel="stylesheet" />
        <link href="./css/bootstrap-responsive.min.css" rel="stylesheet" />

        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600" rel="stylesheet" />
        <link href="./css/font-awesome.min.css" rel="stylesheet" />        

        <link href="./css/ui-lightness/jquery-ui-1.10.0.custom.min.css" rel="stylesheet" />

        <link href="./css/base-admin-2.css" rel="stylesheet" />
        <link href="./css/base-admin-2-responsive.css" rel="stylesheet" />

        <link href="./css/pages/dashboard.css" rel="stylesheet" />   

        <link href="./css/custom.css" rel="stylesheet" />
        <link rel='stylesheet' type='text/css' href='./js/datatables/dataTables.css' /> 

        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link href="assets/img/favicon.ico" rel="icon" type="image/x-icon">
      
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="./js/libs/jquery-1.8.3.min.js"></script>
        <script src="./js/libs/jquery-ui-1.10.0.custom.min.js"></script>
        <script src="./js/libs/bootstrap.min.js"></script>
        
        
         <!-- datatables -->   
        <script type='text/javascript' src='./js/datatables/jquery.dataTables.js'></script> 
        <script type='text/javascript' src='./js/datatables/dataTables.bootstrap.js'></script> 
        <script type='text/javascript' src='./js/datatables/demo-datatables.js'></script> 

        <!-- JS alerts -->   
        <script type='text/javascript' src='./js/alertify.js-0.3.11/lib/alertify.min.js'></script> 
        <link rel='stylesheet' type='text/css' href='./js/alertify.js-0.3.11/themes/alertify.core.css' /> 
        <link rel='stylesheet' type='text/css' href='./js/alertify.js-0.3.11/themes/alertify.default.css' /> 

      


        <!--<script src="./js/Application.js"></script>-->

<!--        <script src="./js/charts/area.js"></script>
        <script src="./js/charts/donut.js"></script>-->


  <!-- JS propios -->           
        <script src="js/Sistema/ExpiredSession.js"></script>
        <script src="js/Sistema/Ruta.js"></script>   
        <script src="js/Sistema/Sistema.js"></script>   
        <script src="js/Sistema/Sistema_Alta.js"></script>
        <script src="js/Sistema/Sistema_Modificacion.js"></script>      
        <script src="js/Sistema/Sistema_Eliminar.js"></script>
        <script src="js/Sistema/Sistema_Consulta.js"></script>
        <script src="js/Sistema/vanadium_es.js"></script>


    </head>
    <body>
        <?php
        if (!(($pcompleta == 'home') or ($pcompleta == ''))) {
            include("includes/navbar.php");
        }
        ?>    
        <div class="main">
            <div class="container" id="page-container">
                <?php
//        if (!(($pcompleta == 'home') or ($pcompleta == ''))) {
//            include("includes/menu_derecho.php");
//        }


                if (file_exists($path_modulo))
                    include( $path_modulo );
                else
                    die('Error al cargar el mdulo <b>' . $modulo . '</b>. No existe el archivo <b>' . $conf[$modulo]['archivo'] . '</b>');
                ?>



            </div>
        </div>






      <?php
        if (!(($pcompleta == 'home') or ($pcompleta == ''))) {
            
            echo '<div class="footer">		
                        <div class="container">		
                            <div class="row">			
                                <div id="footer-copyright" class="span6">
                                    &copy; 2014 Instituto de Estudios Superiores de Chiapas
                                </div> <!-- /span6 -->			
                                <div id="footer-terms" class="span6">
                                    Design <a href="http://www.webdesignchiapas.com.mx" target="_blank">Ing. Mauricio Melo </a>
                                </div> <!-- /.span6 -->			
                            </div> <!-- /row -->		
                        </div> <!-- /container -->	
                    </div> <!-- /footer -->';
            
            
        }
        ?>  

        




    </body>
</html>