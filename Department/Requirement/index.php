<?php $head="headers.php"; include($head); ?>
<body id="page-top">
<?php if( !$_GET['_page'] ) {?>
<nav id="mainNav" class="navbar navbar-default navbar-fixed-top hidden-xs">
    <div class="container col-xs-12 col-sm-12">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
            </button>
            <a class="navbar-brand page-scroll" href="#page-top">Nuetros Servicios</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                 <li>
                    <a class="page-scroll" href="/Department/Inquiry">Encuesta</a>
                </li>
                <!--<li>
                    <a class="page-scroll" href="#wallpeaper">Eventos</a>
                </li>
                <li>
                    <a class="page-scroll" href="#contact">Contacto</a>
                </li>
                <li>
                    <a href="#" data-toggle="modal" data-target="#myModal">Egresados</a>
                </li>
                <li>
                    <a class="page-scroll" href="#">Acceder</a>
                </li> -->
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->
</nav>

<nav class="navbar navbar-default navbar-fixed-top hidden-sm hidden-md hidden-lg">
    <ul class="nav navbar-nav">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="text-align: right;">Nuetros Servicios
          <span class="caret"></span>
          </a>
          <ul class="dropdown-menu">
            <li>
                <a class="page-scroll" href="/Department/Inquiry">Encuesta</a>
            </li>
            <!--<li>
                <a class="page-scroll" href="#wallpeaper">Eventos</a>
            </li>
            <li>
                <a class="page-scroll" href="#contact">Contacto</a>
            </li>
            <li>
                <a href="#" data-toggle="modal" data-target="#myModal">Egresados</a>
            </li>
            <li>
                <a class="page-scroll" href="#">Acceder</a>
            </li> -->
          </ul>
        </li>
    </ul>
</nav>
<!--
<header style="margin-bottom: 0px;">
    <div class="container col-xs-12 col-sm-12">
        <div class="row">
            <div class="col-sm-12">
                <div class="header-content">
                    <div class="header-content-inner">
                        <h2>
                            Ayudenos a mejorar... Dedique unos minutos a completar esta pequeña escuesta. La información es tratada de forma confidencial con fines de calidad.
                        </h2>
                        <center>
                        <a href="/Department/Inquiry" class="btn btn-outline btn-xl page-scroll">LLenar encuesta ahora!</a>
                        </center>
                    </div>
                </div>
            </div>
             <div class="col-sm-5">
                <div class="device-container">
                    <div class="device-mockup iphone6_plus portrait white">
                        <div class="device">
                            <div class="screen">
                                <!-- Demo image for screen mockup, you can put an image here, some HTML, an animation, video, or anything else! //
                                <img src="img/frontend/LastScreen.png" class="img-responsive" alt="...">
                            </div>
                            <div class="button">
                                <!-- You can hook the "home button" to some JavaScript events or just remove it //
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>-->
<?php } ?>
<section id="encuesta" class="features" style="margin-top: -5%;">
    <div class="container">
        <?php
            if ( empty($_GET['_page']) )
               include 'pages/list.php';
            else
                include 'pages/'.$_GET['_page'].'.php';
        ?>
    </div>
</section>
<?php if( !$_GET['_page'] ) {?>
<section id="wallpeaper" class="cta">
    <div class="cta-content">
        <div class="container">
            <h2>Llenar Encuesta</h2>
            <a href="/Department/Inquiry" class="btn btn-outline btn-xl page-scroll">Ir ahora!</a>
        </div>
    </div>
    <div class="overlay"></div>
</section>

<section id="contact" class="contact bg-success">
    <div class="container">
        <h2>Siguenos <i class="fa fa-heart"></i> Social Media!</h2>
        <ul class="list-inline list-social">
            <li class="social-twitter">
                <a href="http://twitter.com/ieschiapas" target="_blank"><i class="fa fa-twitter"></i></a>
            </li>
            <li class="social-facebook">
                <a href="https://www.facebook.com/Iesch?fref=ts" target="_blank"><i class="fa fa-facebook"></i></a>
            </li>
            <li class="social-google-plus">
                <a href="https://plus.google.com/u/0/104953365296856528279/" target="_blank"><i class="fa fa-google-plus"></i></a>
            </li>
        </ul>
    </div>
</section>
<?php } ?>
<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
<div class="modal-dialog modal-sm">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal">&times;</button>
      <h4 class="modal-title">SEGUIMIENTO A EGRESADOS</h4>
    </div>

    <div class="modal-body">
        <a href="http://www.iesch.edu.mx/tuxtla/estudiantes/egresados/formato-de-egresados/" target="_blank">
            *Formato de Egresados
        </a></br>
        <a href="http://www.iesch.edu.mx/tuxtla/estudiantes/egresados/formato-de-egresados-maestria/" target="_blank">
            *Formato de Egresados Maestría
        </a></br>
        <a href="http://www.iesch.edu.mx/tuxtla/estudiantes/egresados/formato-de-egresados-doctorado/" target="_blank">
            *Formato de Egresados Doctorado
        </a></br>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
    </div>
  </div>
</div>
</div>

<!-- <footer>
    <div class="container">
        <p>&copy; 2018 Universidad Salazar. All Rights Reserved.</p>
        <ul class="list-inline">
            <li>
                <a href="#">Privacy</a>
            </li>
            <li>
                <a href="#">Free Source</a>
            </li>
            <li>
                <a href="javascript: showInfo();">Acerca de</a>
            </li>
        </ul>
    </div>
</footer> -->
<?php $footer="footers.php";  include($footer); ?>