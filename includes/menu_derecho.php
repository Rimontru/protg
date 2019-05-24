<!-- BEGIN SIDEBAR -->
<nav id="page-leftbar" role="navigation">
    <!-- BEGIN SIDEBAR MENU -->
    <ul class="acc-menu" id="sidebar">
        <li><a href="javascript:;"><span><center><h3><b>PROTG v2.0</b></h3></center></span></a></li>
       <!-- <li id="search">
            <i class="icon-eye-open"></i>
            <i href="#"><b>Derechos Reservados &copy; 2018</b></i>
        </li> -->
        <li class="divider"></li>
        <li><a href="<?php echo Config::PAG_ADMIN . "?content=home2"; ?>"><i class="icon-home"></i> <span>Inicio</span></a></li>

          <li><a href="javascript:;"><i class="icon-group"></i> <span>Alumnos</span></a>
             <ul class="acc-menu">
                <li><a href="<?php echo Config::PAG_ADMIN . "?content=Alumnos"; ?>"><span> Alta</span></a></li>
                <li><a href="<?php echo Config::PAG_ADMIN . "?content=AlumnosModificar"; ?>"><span> Consultar/Modificar</span></a></li>
             </ul>
        </li>

        <li><a href="javascript:;"><i class="icon-folder-close"></i> <span>Tramites</span></a>
                    <ul class="acc-menu">
                       <li><a href="javascript:;">Examen Institucional</a>
                            <ul class="acc-menu">
                                <li><a href="<?php echo Config::PAG_ADMIN . "?content=ExamenInstitucional"; ?>">Alta/Modificar</a></li>
                                <li><a href="<?php echo Config::PAG_ADMIN . "?content=ExamenInstitucionalReportes"; ?>">Reportes</a></li>
                            </ul>
                        </li>
                        <li><a href="javascript:;">Toma de Protesta</a>
                            <ul class="acc-menu">
                                <li><a href="<?php echo Config::PAG_ADMIN . "?content=TomaProtesta"; ?>">Alta/Modificar</a></li><!-- TomaProtesta -->
                                <li><a href="<?php echo Config::PAG_ADMIN . "?content=TomaProtestaReportes"; ?>">Reportes</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>



        <li><a href="javascript:;"><i class="icon-briefcase"></i> <span>Sinodales</span></a>
             <ul class="acc-menu">
                <li><a href="<?php echo Config::PAG_ADMIN . "?content=Sinodales"; ?>"><span> Alta</span></a></li>
                <li><a href="<?php echo Config::PAG_ADMIN . "?content=SinodalesModificar"; ?>"><span> Modificar</span></a></li>
                <li><a href="<?php echo Config::PAG_ADMIN . "?content=BajaRecuperacion"; ?>"><span> Baja/Recuperación</span></a></li>
                <li><a href="<?php echo Config::PAG_ADMIN . "?content=ReportesSinodales"; ?>"><span> Reportes</span></a></li>
             </ul>
        </li>

         <li><a href="javascript:;"><i class="icon-bell"></i> <span>Servicios Escolares</span></a>
                    <ul class="acc-menu">
                        <li><a href="<?php echo Config::PAG_ADMIN . "?content=SecretariaEducacion"; ?>"> Completar Datos: Toma de Protesta</a></li>
                        <li><a href="<?php echo Config::PAG_ADMIN . "?content=AsignarFolios"; ?>"> Asignar Folios a Alumnos</a></li>
                        <li><a href="<?php echo Config::PAG_ADMIN . "?content=ReportesExamenIns"; ?>"> Reportes Examen Institucional</a></li>
                        <li><a href="<?php echo Config::PAG_ADMIN . "?content=ReportesSecretaria"; ?>"> Reportes Toma de Protesta</a></li>
                        <li><a href="<?php echo Config::PAG_ADMIN . "?content=TomaProtestaSabana"; ?>"> Sabana (Autorizaciones)</a></li>
                        <li><a href="<?php echo Config::PAG_ADMIN . "?content=CapturaResultados"; ?>"> Captura Resultados Examen</a></li>
                    </ul>
           </li>
        <?php if($_SESSION['usuario_id'] ==55 || $_SESSION['usuario_id']==109 || $_SESSION['usuario_id']==67 || $_SESSION['usuario_id']==72 ){ // sari, karlita, ary, red?>
            <li>
                <a href="javascript:;"><i class="icon-file"></i> <span>Verificación de Docs.</span></a>
                <ul class="acc-menu">
                    <li>
                        <a href="<?php echo Config::PAG_ADMIN . "?content=CertificacionTitulo"; ?>"> Certificación de Titulos</a>
                    </li>
                    <li>
                        <a href="<?php echo Config::PAG_ADMIN . "?content=RegistroTimbres"; ?>"> Registro de Timbres</a>
                    </li>
                    <li>
                        <a href="<?php echo Config::PAG_ADMIN . "?content=ReportesTimbres"; ?>"> Reportes</a>
                    </li>
                </ul>
           </li>
        <?php } #usuarios restringidos?>
            <li><a href="javascript:;"><i class="icon-bookmark"></i> <span>Egresados</span></a>
            <ul class="acc-menu">
                <li><a href="<?php echo Config::PAG_ADMIN . "?content=vi_Egresados"; ?>"><span>Completar Datos</span></a></li>
                <li><a href="<?php echo Config::PAG_ADMIN . "?content=EgresadosReportes"; ?>"><span>Reportes</span></a></li>
                <li><a href="<?php echo Config::PAG_ADMIN . "?content=EncuestaEgresadosMedicina"; ?>"><span>Encuesta Medicina</span></a></li>
                <li><a href="<?php echo Config::PAG_ADMIN . "?content=EncuestaEgresadosMaestria"; ?>"><span>Encuesta Maestria</span></a></li>
	            <li><a href="<?php echo Config::PAG_ADMIN . "?content=EncuestaEgresadosDoctorado"; ?>"><span>Encuesta Doctorado</span></a></li>
                <li><a href="<?php echo Config::PAG_ADMIN . "?content=EncuestaEmpleadores2019"; ?>"><span>Encuesta empleadores 2019</span></a></li>
                <li><a href="<?php echo Config::PAG_ADMIN . "?content=Busqueda"; ?>"><span>Busqueda alumnos finados</span></a></li>
            </ul>
        </li>
        
        <li><a href="javascript:;"><i class="icon-gears"></i> <span>Herramientas</span></a>
            <ul class="acc-menu">
                <li><a href="<?php echo Config::PAG_ADMIN . "?content=DatosInstitucion"; ?>"><span>Datos Institución</span></a></li>
                <li><a href="<?php echo Config::PAG_ADMIN . "?content=Carreras"; ?>"><span>Carreras</span></a></li>

                <li><a href="<?php echo Config::PAG_ADMIN . "?content=SolutionGroup"; ?>"><span>Agrupar Generaciones</span></a></li>

                <li><a href="<?php echo Config::PAG_ADMIN . "?content=Generaciones"; ?>"><span>Generaciones</span></a></li>
                <?php if($_SESSION['usuario_id'] ==55 || $_SESSION['usuario_id']==43 ){ ?>
                <li><a href="<?php echo Config::PAG_ADMIN . "?content=AltaTrabajadores"; ?>"><span>Trabajadores</span></a></li>
                <li><a href="javascript:;">Usuarios</a>
                    <ul class="acc-menu">
                        <li><a href="<?php echo Config::PAG_ADMIN . "?content=Usuarios"; ?>">Usuarios</a></li>
                        <li><a href="<?php echo Config::PAG_ADMIN . "?content=Usuario_Alta"; ?>">Alta</a></li>
                        <li><a href="<?php echo Config::PAG_ADMIN . "?content=Usuario_Modificar"; ?>">Modificar</a></li>
                    </ul>
                </li>
                <li><a href="javascript:;">Extras</a>
                    <ul class="acc-menu">
                        <li><a href="<?php echo Config::PAG_ADMIN . "?content=Full_titulos"; ?>">Titulos Bruto</a></li>
                        <li><a href="<?php echo Config::PAG_ADMIN . "?content=Upload_Alumnos"; ?>">Subir Listas</a></li>
                    </ul>
                </li>
                <?php } ?>
                <li><a href="javascript:;">Empleadores</a>
                    <ul class="acc-menu">
                        <li><a href="<?php echo Config::PAG_ADMIN . "?content=Empleadores"; ?>">Alta</a></li>
                        <li><a href="<?php echo Config::PAG_ADMIN . "?content=EmpleadoresModificar"; ?>">Modificar</a></li>

                        <li><a href="<?php echo Config::PAG_ADMIN . "?content=EmpleadoresReportes"; ?>">Reportes</a></li>
                    </ul>
                </li>
            </ul>
        </li>

        <li><a href="javascript:;"><i class="icon-book"></i> <span>Directorio</span></a>
            <ul class="acc-menu">
                <li>
                  <a href="<?php echo Config::PAG_ADMIN . "?content=RegistroCertificados"; ?>">
                    <span>Registrar Preparatorias</span>
                  </a>
                </li>
            </ul>
        </li>



        <li class="divider"></li>
        <li><a href="<?php echo Config::PAG_ADMIN . "?content=salir"; ?>"><i class="icon-reply"></i> <span>Salir</span></a>
        </li>

        </li></ul>



    <!-- END SIDEBAR MENU -->
</nav>