<script>
    $(function() {

        $.ajax({
            url: pathSistema + 'FechaActual.php',
            type: 'post',
            data: "Fechesita=Fechesita",
            success: function(data) {
                if (data != "") {
                    $("#fechesita").html(data);

                }
            }
        });
        
        
         $.ajax({
            url: pathSistema + 'CantidadClaseMaterial.php',
            type: 'post',
            data: "ClaseMaterial=ClaseMaterial",
            dataType: 'json',
            success: function(data) {
                if (data != "") {
                    $("#ClaseMaterialMaterial").html(data.Material);
                    $("#ClaseMaterialReactivos").html(data.Reactivos);
                    $("#ClaseMaterialEquipo").html(data.Equipo);
                    $("#LaboratorioAcceso").html(data.LaboratorioAcceso);

                }
            }
        });

    });
</script>
<div class="row">
      	 
      	<div class="span6">
      		
      		<div class="widget stacked">
					
				<div class="widget-header">
					<i class="icon-star"></i>
                                        <h3>Bienvenido</h3>
				</div> <!-- /widget-header -->
				
				<div class="widget-content">
                                        <span class="stat-value"><div id="LaboratorioAcceso">ss</div></span>									
                                        <br>
					<div class="stats">
						
                                          
                                                   
                                                
						<div class="stat">
                                                    <span class="stat-value"><div id="ClaseMaterialMaterial"></div></span>									
							Material    
						</div> <!-- /stat -->
						
						<div class="stat">
							<span class="stat-value"><div id="ClaseMaterialReactivos"></div></span>									
							Reactivos           
						</div> <!-- /stat -->
						
						<div class="stat">
							<span class="stat-value"><div id="ClaseMaterialEquipo"></div></span>									
							Equipo
						</div> <!-- /stat -->
						
					</div> <!-- /stats -->
					
					
					
					
				</div> <!-- /widget-content -->
					
			</div> <!-- /widget -->	
			
			
	    </div> <!-- /span6 -->
      	
      	
      	<div class="span6">	
      		
      		
      		<div class="widget stacked">
					
				<div class="widget-header">
					<i class="icon-bookmark"></i>
                                        <h3 id="fechesita" style="float: right; margin-top: 8px;"></h3>
				</div> <!-- /widget-header -->
				
				<div class="widget-content">
					
					<div class="shortcuts">
											</div> <!-- /shortcuts -->	
				
				</div> <!-- /widget-content -->
				
			</div> <!-- /widget -->
      		
      		
								
	      </div> <!-- /span6 -->
      	
      </div> <!-- /row -->