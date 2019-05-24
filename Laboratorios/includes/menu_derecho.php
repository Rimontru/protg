<!-- BEGIN SIDEBAR -->
<nav id="page-leftbar" role="navigation">
    <!-- BEGIN SIDEBAR MENU -->
    <ul class="acc-menu" id="sidebar">
       <li id="search">
            <a href="javascript:;"><i class="icon-search opacity-control"></i></a>
            <form />
            <input type="text" class="search-query" placeholder="Buscar..." />
            <button type="submit"><i class="icon-search"></i></button>
            </form>
        </li>
        <li class="divider"></li>
        <li><a href="<?php echo Config::PAG_ADMIN . "?content=home2"; ?>"><i class="icon-home"></i> <span>Inicio</span></a></li>

          <li><a href="javascript:;"><i class="icon-group"></i> <span>Materiales</span></a>
             <ul class="acc-menu">
                <li><a href="<?php echo Config::PAG_ADMIN . "?content=Materiales"; ?>"><span> Alta</span></a></li>
                <li><a href="<?php echo Config::PAG_ADMIN . "?content=MaterialesModificar"; ?>"><span> Modificar</span></a></li>
                 <li><a href="<?php echo Config::PAG_ADMIN . "?content=MaterialesListar"; ?>"><span> Listar</span></a></li>
                 <li><a href="<?php echo Config::PAG_ADMIN . "?content=MaterialesSalidas"; ?>"><span> Salidas</span></a></li>
             </ul>
        </li>
        
        
<!--        
        <li><a href="javascript:;"><i class="icon-gears"></i> <span>Herramientas</span></a>
            <ul class="acc-menu">
                <li><a href="<?php echo Config::PAG_ADMIN . "?content=DatosInstitucion"; ?>"><span>Datos Institución</span></a></li>
                <li><a href="<?php echo Config::PAG_ADMIN . "?content=AltaUser"; ?>"><span>Usuarios</span></a></li>
            </ul>
        </li>-->
        <li><a href="<?php echo Config::PAG_ADMIN . "?content=ReporteLaboratorios"; ?>"><i class="icon-bar-chart"></i> <span>Reportes</span></a>
        </li>

        <li class="divider"></li>
        <li><a href="<?php echo Config::PAG_ADMIN . "?content=salir"; ?>"><i class="icon-reply"></i> <span>Salir</span></a>
        </li>

        </li></ul>
    <!-- END SIDEBAR MENU -->
</nav>