<header class="navbar navbar-inverse navbar-fixed-top" role="banner">
    <a id="leftmenu-trigger" class="pull-left" data-toggle="tooltip" data-placement="bottom" title="Toggle Left Sidebar"></a>

    <!--        <div class="navbar-header pull-left">
                <a class="navbar-brand" href="index.php">Avant</a>
            </div>-->

    <ul class="nav navbar-nav pull-right toolbar">
        <li class="dropdown">
            <a href="#" class="dropdown-toggle username" data-toggle="dropdown"><span class="hidden-xs"><?php  echo " ".$_SESSION['nombre_usuario']." "; ?><i class="icon-caret-down icon-scale"></i></span><img src="assets/demo/avatar/PROTG.png" alt="Dangerfield" /></a>
            <ul class="dropdown-menu userinfo arrow">
                <li class="username">
                    <a href="#">
                        <div class="pull-left"><img class="userimg" src="assets/demo/avatar/PROTG.png" alt="Jeff Dangerfield" /></div>
                        <div class="pull-right"><h5><?php  echo " ".$_SESSION['nombre_usuario']." "; ?></h5><small><span><?php  echo " ".$_SESSION['usuario_login']." "; ?></span></small></div>
                    </a>
                </li>
                <li class="userlinks">
                    <ul class="dropdown-menu">
<!--                        <li><a href="#">Edit Profile <i class="pull-right icon-pencil"></i></a></li>
                        <li><a href="#">Account <i class="pull-right icon-cog"></i></a></li>
                        <li><a href="#">Help <i class="pull-right icon-question-sign"></i></a></li>-->
                        <!--<li class="divider"></li>-->
                        <li><a href="<?php echo Config::PAG_ADMIN . "?content=salir"; ?>" class="text-right">Salir</a></li>
                    </ul>
                </li>
            </ul>
        </li>

    </ul>
</header>