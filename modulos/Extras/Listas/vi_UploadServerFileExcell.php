<?php
require_once("includes/PHPExcel/IOFactory.php");

if( isset($_POST) ){
	$target_path = "includes/ajax/Extras/uploadLists/uploadFileExcell/";# se declaran las rutas de los archivos a ocupar
	$path_layout = "vi_readAndviewFileExcell.php";
	$target_path .= basename( $_FILES['uploadedfile']['name']); # es una concatenacion del archivo que se recibe y la ruta
	$unlink_url_file = ("uploadFileExcell/".basename( $_FILES['uploadedfile']['name']));
		if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)){ #funcion de php que sube el archivo y lo guarda en la carpeta enrutada
		$objPHPexcell= PHPEXCEL_IOFactory::load($target_path); #objeto que lee el archivo

		$objPHPexcell->setActiveSheetIndex(0); #se inicializa la hoja del archivo

		$noRows = $objPHPexcell->setActiveSheetIndex(0)->getHighestRow(); #obtiene el numero de filas

		$html1="
				<table style='width:100%;'>
					<thead>
						<tr>
							<th>#</th>
							<th>Matricula</th>
							<th>Nombre</th>
							<th>A. paterno</th>
							<th>A. materno</th>
							<th>Genero</th>
							<th>Colonia</th>
							<th>Postal</th>
							<th>Carrera</th>
							<th>Nivel</th>
							<th>Mod</th>
							<th>Turno</th>
							<th>Plan</th>
							<th>Gen</th>
							<th>#Gen</th>
							<th>CURP</th>
						</tr>
					</thead>
					<tbody>

				";
			$i=1;
			while($i <= $noRows){

				$matricula[$i] = $objPHPexcell->getActiveSheet()->getCell('A'.$i)->getCalculatedValue();
				$nombre[$i] = $objPHPexcell->getActiveSheet()->getCell('B'.$i)->getCalculatedValue();
				$paterno[$i] = $objPHPexcell->getActiveSheet()->getCell('C'.$i)->getCalculatedValue();
				$materno[$i] = $objPHPexcell->getActiveSheet()->getCell('D'.$i)->getCalculatedValue();
				$fk_genero[$i] = $objPHPexcell->getActiveSheet()->getCell('E'.$i)->getCalculatedValue();
				$fk_colonia[$i] = $objPHPexcell->getActiveSheet()->getCell('F'.$i)->getCalculatedValue();
				$c_postal[$i] = $objPHPexcell->getActiveSheet()->getCell('G'.$i)->getCalculatedValue();
				$fk_carrera[$i] = $objPHPexcell->getActiveSheet()->getCell('H'.$i)->getCalculatedValue();
				$fk_nivel_estudio[$i] = $objPHPexcell->getActiveSheet()->getCell('I'.$i)->getCalculatedValue();
				$fk_modalidad[$i] = $objPHPexcell->getActiveSheet()->getCell('J'.$i)->getCalculatedValue();
				$fk_turnos[$i] = $objPHPexcell->getActiveSheet()->getCell('K'.$i)->getCalculatedValue();
				$plan_estudios[$i] = $objPHPexcell->getActiveSheet()->getCell('L'.$i)->getCalculatedValue();
				$fk_generacion[$i] = $objPHPexcell->getActiveSheet()->getCell('M'.$i)->getCalculatedValue();
				$gene_num[$i] = $objPHPexcell->getActiveSheet()->getCell('N'.$i)->getCalculatedValue();
				$edad[$i] = $objPHPexcell->getActiveSheet()->getCell('O'.$i)->getCalculatedValue();
				$curp_alu[$i] = $objPHPexcell->getActiveSheet()->getCell('P'.$i)->getCalculatedValue();

			$i++;
			}


			#inicializamos la posicion 0 para indexacion estetica y real empezando con la primer posicion
			$mat='00000000'; $nom='null'; $pat='null'; $mtn='null'; $sex='null'; $col='null'; $cod='null';
			$car='null'; $nve='null'; $mod='null'; $tur='null'; $ple='null'; $gen='null'; $geN='null'; $edd='null'; $curp='null';

			$a=1;
				while($a <= $noRows){

					$mat .= '|'.$matricula[$a];
					$nom .= '|'.$nombre[$a];
					$pat .= '|'.$paterno[$a];
					$mtn .= '|'.$materno[$a];
					$sex .= '|'.$fk_genero[$a];
					$col .= '|'.$fk_colonia[$a];
					$cod .= '|'.$c_postal[$a];
					$car .= '|'.$fk_carrera[$a];
					$nve .= '|'.$fk_nivel_estudio[$a];
					$mod .= '|'.$fk_modalidad[$a];
					$tur .= '|'.$fk_turnos[$a];
					$ple .= '|'.$plan_estudios[$a];
					$gen .= '|'.$fk_generacion[$a];
					$geN .= '|'.$gene_num[$a];
					$edd .= '|'.$edad[$a];
					$curp .= '|'.$curp_alu[$a];

				$a++;
				}

				$stringArrayDatas='mat='.$mat.'&nom='.$nom.'&pat='.$pat.'&mtn='.$mtn.'&sex='.$sex.'&col='.$col.'&cod='.$cod.'&car='.$car.'&nve='.$nve.'&mod='.$mod.'&tur='.$tur.'&ple='.$ple.'&gen='.$gen.'&geN='.$geN.'&edd='.$edd.'&curp='.$curp.'&unlink_url_file='.$unlink_url_file;


			$html4="";
			$x=1;
			while($x <= $noRows){
						$html2="<tr>";
							$col1= "<td>".$x."</td>";
							$col2= "<td>".$matricula[$x]."</td>";
							$col3= "<td>".$nombre[$x]."</td>";
							$col4= "<td>".$paterno[$x]."</td>";
							$col5= "<td>".$materno[$x]."</td>";
							$col6= "<td>".$fk_genero[$x]."</td>";
							$col7= "<td>".$fk_colonia[$x]."</td>";
							$col8= "<td>".$c_postal[$x]."</td>";
							$col9= "<td>".$fk_carrera[$x]."</td>";
							$col10="<td>".$fk_nivel_estudio[$x]."</td>";
							$col11="<td>".$fk_modalidad[$x]."</td>";
							$col12="<td>".$fk_turnos[$x]."</td>";
							$col13="<td>".$plan_estudios[$x]."</td>";
							$col14="<td>".$fk_generacion[$x]."</td>";
							$col15="<td>".$gene_num[$x]."</td>";
							$col16="<td>".$curp_alu[$x]."</td>";
						$html3= "</tr>";

				$html4 .= $html2.$col1.$col2.$col3.$col4.$col5.$col6.$col7.$col8.$col9.$col10.$col11.$col12.$col13.$col14.$col15.$col16.$html3;
			$x++;
			}
			$html5="</tbody></table>";


		}
		else{
			echo "Ha ocurrido un error, trate de nuevo!";
		}
}
	include($path_layout);

	exit();
?>
