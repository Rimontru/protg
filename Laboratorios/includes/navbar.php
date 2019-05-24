
<div class="navbar navbar-inverse navbar-fixed-top">
	
	<div class="navbar-inner">
		
		<div class="container">
			
			<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
				<i class="icon-cog"></i>
			</a>
			
			<a class="brand" href="<?php echo Config::PAG_ADMIN . "?content=home2"; ?>">
				Sistema de Inventario de Laboratorios Quimicos <sup>1.0</sup>
			</a>		
			
			<div class="nav-collapse collapse">
				<ul class="nav pull-right">
					
			
					<li class="dropdown">
						
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<i class="icon-user"></i> 
							<?php echo $_SESSION['nombre_usuario']; ?>
							<b class="caret"></b>
						</a>
						
						<ul class="dropdown-menu">
							
							<li class="divider"></li>
							<li><a href="<?php echo Config::PAG_ADMIN . "?content=salir"; ?>">Salir</a></li>
						</ul>
						
					</li>
				</ul>
			
				
				
			</div><!--/.nav-collapse -->	
	
		</div> <!-- /container -->
		
	</div> <!-- /navbar-inner -->
	
</div> <!-- /navbar -->
    



    
<div class="subnavbar">

	<div class="subnavbar-inner">
	
		<div class="container">
			
			<a class="btn-subnavbar collapsed" data-toggle="collapse" data-target=".subnav-collapse">
				<i class="icon-reorder"></i>
			</a>

			<div class="subnav-collapse collapse">
				<ul class="mainnav">
				
					<li class="active">
						<a href="<?php echo Config::PAG_ADMIN . "?content=home2"; ?>">
							<i class="icon-home"></i>
							<span>Inicio</span>
						</a>	    				
					</li>
					
					<li class="dropdown">					
						<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
							<i class="icon-th"></i>
							<span>Materiales</span>
							<b class="caret"></b>
						</a>	    					
						<ul class="dropdown-menu">
							<li><a href="<?php echo Config::PAG_ADMIN . "?content=Materiales"; ?>">Alta</a></li>
							<li><a href="<?php echo Config::PAG_ADMIN . "?content=MaterialesModificar"; ?>">Modificar</a></li>
							<li><a href="<?php echo Config::PAG_ADMIN . "?content=MaterialesListar"; ?>">Listar</a></li>
							<li><a href="<?php echo Config::PAG_ADMIN . "?content=MaterialesSalidas"; ?>">Salidas</a></li>
						</ul> 				
					</li>
					
					<li>						 
                                                <a href="<?php echo Config::PAG_ADMIN . "?content=ReporteLaboratorios"; ?>">
							<i class="icon-copy"></i>
							<span>Reportes</span>
						</a>	                                            
					</li>
					
					<li>						 
                                                <a href="<?php echo Config::PAG_ADMIN . "?content=salir"; ?>">
							<i class="icon-signout"></i>
							<span>Salir</span>
						</a>	                                            
					</li>
				
				</ul>
			</div> <!-- /.subnav-collapse -->

		</div> <!-- /container -->
	
	</div> <!-- /subnavbar-inner -->

</div> <!-- /subnavbar -->
    