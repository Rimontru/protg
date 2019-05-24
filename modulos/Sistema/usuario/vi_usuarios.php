<?php
$users = $ConsultaDB->verUsuariosOnline();
?>
<div id="page-content">
    <div id="wrap">
        <div id="page-heading">
            <ol class="breadcrumb">
                <li><a href="<?php echo Config::PAG_ADMIN . "?content=home2"; ?>">Inicio</a></li>
                <li class="active">Usuarios</li>
            </ol>

            <h1>Usuarios</h1>
            <div class="options">
                <div class="btn-toolbar">
                    <div class="btn-group hidden-xs">
                        <a href="#" class="btn btn-muted dropdown-toggle" data-toggle="dropdown">
                            <i class="icon-cloud-download"></i>
                            <span class="hidden-sm"> Exportar como  </span>
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- <li><a href="#">Archivo de Texto (*.txt)</a></li>
                            <li><a href="#">Excel (*.xlsx)</a></li> -->
                            <li><a href="includes/ajax/Egresados/Reportes/reporteUsuariosNuevosPRO.php" target="_blank">PDF (*.pdf)</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="panel panel-midnightblue">
                <div class="panel-heading">
                    <h4>Lista de Usuarios</h4>
                </div>

                <div class="panel-body collapse in">
                    <?php if($users != 0){ ?>
                    <table class="table table-condensed" id="users">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>CLAVE</th>
                                <th>NOMBRE</th>
                                <th>USUARIO</th>
                                <th>TELEFONO</th>
                                <th>TIPO DE USUARIO</th>
                                <th>ESTADO</th>
                                <th>ACCIÓN</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $cont = 0;
                                foreach ($users as $value) {
                                $stadoUser = ($value->activo_usuario != 0) ? '<span class="label label-success">Activo</span>':'<span class="label label-danger">Inactivo</span>';
                                $online = ($value->Usuario_Online != 0) ? '<img src="assets/img/status-icon.png" title="En linea">':'<img src="assets/img/status-busy-icon.png" title="Desconectado">';
                                $accion = ($value->Usuario_Online != 0)? "<a onclick=\"cerrarSesion('".$value->Pk_Usuario_Login."')\" class=\"btn btn-danger btn-sm\">Cerrar sesión</a>" : "<a class=\"btn btn-default btn-sm\">Desconectado</a>" ;
                                if($value->Usuario_Online == 1){
                                    $cont++;
                                }
                        ?>
                            <tr>
                                <td><?php echo $online; ?></td>
                                <td><?php echo $value->claveTrabajador; ?></td>
                                <td><?php echo $value->nomCompleto; ?></td>
                                <td><?php echo $value->Usuario; ?></td>
                                <td><?php echo $value->telefono; ?></td>
                                <td><?php echo $value->Tipo_User; ?></td>
                                <td><?php echo $stadoUser; ?></td>
                                <td><?php echo $accion; ?></td>
                            </tr>
                        <?php
                                }
                            ?>
                        </tbody>
                        <caption class="alert alert-dismissable alert-success"><b><?php echo $cont ?></b> Usuario(s) en linea.</caption>
                    </table>
                    <?php }else{ ?>
                    <div class="alert alert-dismissable alert-warning">
                        <strong>Alerta!</strong> No existen registros en la Base de datos, comunicate con el administrador del sistema.
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    </div>
                    <?php } ?>
                </div>
            </div>

        </div> <!-- container -->
    </div> <!--wrap -->
</div>
        <script>
    $(document).ready(function() {
            $("#users").dataTable( {
                    "sDom": "<\'row\'<\'span8\'l><\'span8\'f>r>t<\'row\'<\'span8\'i><\'span8\'p>>", "sPaginationType": "bootstrap","oLanguage":{
                        "sLengthMenu": "Mostrar _MENU_"
                        }
                    } );
                } );
 </script>