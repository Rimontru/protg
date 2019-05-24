<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <title>Protg v2.0</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="description" content="PROTG" />
        <meta name="author" content="Ing. Mauricio Melo Granados / Ing. Cesar Espinosa Mendez" />

        <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600' rel='stylesheet' type='text/css' />
        <link href="assets/css/styles.min.css" rel='stylesheet' type='text/css' />
        <link href="assets/css/animate.css" rel='stylesheet' type='text/css' />

        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

</head>




        <body class="focusedform">

        <div class="verticalcenter ">
            <center><img src="assets/img/ICO_PROTG5.png" alt="PROTG" title="PROTG"  width="150" height="" class="animated fadeInDown"/></center><p></p>
            <div class="panel panel-primary animated fadeInDown">
                <div class="panel-body">
                    <!--<h4 class="text-center" style="margin-bottom: 25px;">Sistema de Muestreo Aleatorio</h4>-->

                    <form action="<? echo Config::PAG_ADMIN . "?content=home2"; ?>" method='post' class="form-horizontal" style="margin-bottom: 0px !important;" />
                    <div class="form-group">
                        <div class="col-sm-12">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="icon-user"></i></span>
                                <input type="text" class="form-control " name="Usuario" id="Usuario" placeholder="Usuario" required />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="icon-lock"></i></span>
                                <input type="password" class="form-control "  name="Pass" id="Pass" placeholder="Contraseña" required />
                            </div>
                        </div>
                    </div>

                    <p class="center span5">
                        <button name='Entrar' type='submit' class='btn btn-primary btn-block'>Entrar</button>
                    </p>
                    </form>
                    <?
                    // Mostrar error de Autentificación.
                    include ("includes/Mensaje_Error.inc.php");
                    if (isset($_GET['error_login'])) {
                        $error = $_GET['error_login'];
                        echo"<div class='alert alert-dismissable alert-danger'>Error: $error_login_ms[$error]</div>";
                    }
                    ?>

                </div>

            </div>
        </div>


</body>
</html>