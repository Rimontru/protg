<?php 
if(isset($_GET) && !empty($_GET)){
extract($_GET);
}
?>
<center>
<div class="panel panel-primary" style="width:90%;margin-top:1%;">
    <div class="panel-heading">
       	<b><font size="+1">Se le agradece el tiempo prestado</b>
        <i class="fa fa-check-square-o fa-1x" style="float:right;"></i> 
    </div>
</center>
    <div class="panel-body">
    <form id="form_comentario">
        <fieldset>
            <legend style="color:#0066FF;font-size:16px;" title="ESCRIBE LO QUE QUIERAS" id="comentario">
            	Para comentarios y/o sugerencias escribela, nos encantaría saberla
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
    						<img src="images/frontend/Gif_gracias.gif" 
                            id="img_thanks" 
                            title="TOCA PARA GENERAR NUEVA ENCUESTA"
                            onclick="cargaPantalla(pathFrontInit,screenPrincipal);"
                            />
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
</div>
<style>
#img_thanks{
	width: 400px;
	height: 400px;
	margin:0 auto;
	border-radius: 50%;
	-webkit-box-shadow: 0px 0px 10px rgba(74, 74, 74, 0.75);
	-moz-box-shadow:    0px 0px 10px rgba(74, 74, 74, 0.75);
	box-shadow:         0px 0px 10px rgba(74, 74, 74, 0.75);
	-webkit-transition: all 1s ease-in-out;
	-moz-transition: all 1s ease-in-out;
}
#img_thanks:hover{
	cursor:pointer;
}
</style>