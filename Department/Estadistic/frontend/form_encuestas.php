<?php
session_start();
$loadPreg=array(
1=>'¿Cómo califica nuestro servicio?',
2=>'¿Los espacios  de atención al cliente están aseados, ventilados y el nivel del ruido es adecuado?',
3=>'¿La tención que se le prestó es oportuna y a tiempo?',
4=>'¿Cuando se acerca a nuestras oficinas encuentra al personal amable, capacitado y dispuesto a colaborarle respetuosamente?',
5=>'¿Los horarios de atención al público son puntuales, adecuados y respetados?',
6=>'¿La atención a sus dudas, sugerencias, observaciones y dificultades es amable, inmediata, clara y receptiva?',
7=>'¿Telefónicamente el servicio es amable, puntual y eficiente?',
8=>'¿Ha llenado las expectativas por las cuales usted eligió nuestro servicio?'
);

if(isset($_GET) && !empty($_GET)){
	extract($_GET);
		$pregunta=$request;
}
else{
	$pregunta=1;
}
?>
<center>
<img src="images/banners/Banner Iesch 2014.png" style="width:100%;"/>
<div class="panel panel-primary" style="width:90%;margin-top:10%;">
    <div class="panel-heading">
       	<b><font size="+1">Dedique unos minutos a completar esta pequeña encuesta</b>
        <i class="fa fa-check-square-o fa-1x" style="float:right;"></i> 
    </div>
</center>
    <div class="panel-body">
        <form id="form_preguntas_No_Se_Ocupa">
        <fieldset>
            <legend style="color:#0066FF; margin-top:24%;"><?php echo $loadPreg[$pregunta];?></legend><center>
            <br />
                <table  style="width:70%; text-align:center;">
                	<tr>
                        <td>
                        	<i class="em em-relaxed" onclick="GetValOptionEmoji(<?php echo '4,'.$pregunta?>);" id="btn_emoji"></i><br />
                        	EXCELENTE
                        </td>
                        <td>
                        	<i class="em em-relieved" onclick="GetValOptionEmoji(<?php echo '3,'.$pregunta?>);" id="btn_emoji"></i><br />
                        	BUENO
                        </td>
                         <td>
                        	<i class="em em-neutral_face" onclick="GetValOptionEmoji(<?php echo '2,'.$pregunta?>);" id="btn_emoji"></i><br />
                        	REGULAR
                        </td>
                        <td>
                        	<i class="em em-angry" onclick="GetValOptionEmoji(<?php echo '1,'.$pregunta?>);" id="btn_emoji"></i><br />
                        	MALO
                        </td>
                    </tr>
                </table>
       	</fieldset> 
       	</form>
    </div>
</div>
<style>
.em{
	width:100px;
	height:100px;
}
.em:hover{
	cursor:pointer;
	border-radius: 50%;
	-webkit-box-shadow: 0px 0px 10px rgba(74, 74, 74, 0.75);
	-moz-box-shadow:    0px 0px 10px rgba(74, 74, 74, 0.75);
	box-shadow:         0px 0px 10px rgba(74, 74, 74, 0.75);
	-webkit-transition: all 1s ease-in-out;
	-moz-transition: all 1s ease-in-out;
	-webkit-transform: scale(1.2);
	-moz-transform: scale(1.2);
}
</style>
