<?php
session_start();
include("../clases/includes/params_DB.php");
include("../clases/includes/conexion_DB.php");

$exe = new conexion();

$loadPreg = array();
$i = 1;
$sql = "SELECT * FROM cat_preguntas WHERE activo=1";
$result = $exe->executeQuery($sql);
    while( $row = $exe->getRows($result) ){
         $loadPreg[$i] = $row['desc_pregunta'];
    $i++;
    }
    mysql_free_result($result);

if(isset($_GET) && !empty($_GET)){
	extract($_GET);
		$pregunta=$request;
}
else{
	$pregunta=1;
}
?>
<legend><?php echo $loadPreg[$pregunta];?></legend><center>
<br />
    <table  class="col-sm-12 col-md-12">
    	<tr>
            <td>
            	<i class="em em-relaxed img-responsive" onclick="GetValOptionEmoji(<?php echo '4,'.$pregunta?>);" id="btn_emoji"></i><br />
            	EXCELENTE
            </td>
            <td>
            	<i class="em em-relieved img-responsive" onclick="GetValOptionEmoji(<?php echo '3,'.$pregunta?>);" id="btn_emoji"></i><br />
            	BUENO
            </td>
             <td>
            	<i class="em em-neutral_face img-responsive" onclick="GetValOptionEmoji(<?php echo '2,'.$pregunta?>);" id="btn_emoji"></i><br />
            	REGULAR
            </td>
            <td>
            	<i class="em em-angry img-responsive" onclick="GetValOptionEmoji(<?php echo '1,'.$pregunta?>);" id="btn_emoji"></i><br />
            	MALO
            </td>
        </tr>
    </table>

<style>
.em{
	width:100px;
	height:100px;
}
td{
    text-align: center;
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

legend{
    color:#0066FF;
}

</style>
