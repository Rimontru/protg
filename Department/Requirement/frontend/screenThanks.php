<?php 
if(isset($_GET) && !empty($_GET)){
extract($_GET);
}
?>
<div class="panel-body">
    <form id="form_comentario">
        <fieldset>
            <legend style="color:#0066FF;" title="ESCRIBE LO QUE QUIERAS" id="comentario">
            	Se le agradece el tiempo prestado, para comentarios y/o sugerencias escribela, nos encantaría saberla
            </legend>
            <center>
            <br />
                <table  style="width:70%; text-align:center;">
                	<tr>
                    	<td>
                        	<textarea class="form-control" name="comentarios"></textarea>
                            <input type="hidden" name="fk_encuesta" value="<?php echo $fk_encuesta?>"/>
                        </td>
                    </tr>
                    <tr><td>&nbsp;</td></tr>
                    <tr>
                    	<td>
                        	<input type="button" class="btn btn-success"  
                            value="ENVIAR COMENTARIOS"
                            title="TOCA PARA ENVIAR"
                            onclick="InsertNewComentarioByFkEncuesta();"
                            id="btn_cometario"/>
                        </td>
                    </tr>
                    <tr><td>&nbsp;</td></tr>
                    <tr>
                    	<td>
                    		<legend style="color:#0066FF;font-size:16px;">
            					¡Nueva encuesta! solo toca la carita
            				</legend>
            			</td>
                    </tr>
                    <tr>
                    	<td>
    						<a href="javascript: cargaPantalla(pathFrontInit,screenPrincipal);">
                            	<img src="img/frontend/Gif_gracias.gif" title="TOCA PARA GENERAR NUEVA ENCUESTA" class="img-thumbnail"/>
                            </a>
                        </td>
                    </tr>
                    <tr>
                    	<td>
    						
                        </td>
                    </tr>
                </table>
       	</fieldset> 
    </form>
</div>
<style>
</style>