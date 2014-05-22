<?php
if(isset($_POST['asignar_eval']))
{
	
	
	
	
	//busco el numero de preguntas que tiene la evaluacion que corresponde a la asignada
	$n_preguntas=$con->consulta("SELECT * FROM ee_evaluaciones WHERE id_evaluacion='$_POST[evaluacion_asignada]'");
	$n_pregunta=$con->sig_reg($n_preguntas);
	
	//busco la ultima evaluacion asignada de la misma que deseo asignar, para ver si el estatus es diferente de espera
	$estatus=$con->consulta("SELECT * FROM ee_evaluacion_asignada WHERE id_evaluacion='$_POST[evaluacion_asignada]' AND usuario_contrato='$_POST[contrato_texto]' ORDER BY id DESC LIMIT 1");
	echo $con->my_error;
	$estatu=$con->sig_reg($estatus);
	
	if((($estatu['estatus']=='Corregida' || $estatu['estatus']=='vista') && $estatu['nota']!='1') || !$con->num_filas($estatus))
	{
		$con->consulta("INSERT INTO ee_evaluacion_asignada (id_evaluacion, usuario_contrato,estatus) 
							VALUES 
							('$_POST[evaluacion_asignada]','$_POST[contrato_texto]','Espera')");
							
		
		//busco el id de la ultima evaluacion asignada para luego relacionarlo con cada respuesta					
		$id_eval_asignada=$con->consulta("SELECT * FROM ee_evaluacion_asignada ORDER BY id DESC LIMIT 1");
		$id_eval_asignada=$con->sig_reg($id_eval_asignada);
		//busco las preguntas que corresponden a la eval asignada
			$preguntas_asignadas=$con->consulta("SELECT * FROM ee_preguntas WHERE id_evaluaciones='$_POST[evaluacion_asignada]' ORDER BY RAND() LIMIT 0,$n_pregunta[cantidad_preguntas]");
		while($pregunta_asignada=$con->sig_reg($preguntas_asignadas)){
			
			//inserto cada pregunta en la tabla respuestas, que corresponden a la evaluacion asignada, para que luego sean respondidas por el estudiante
				$con->consulta("INSERT INTO ee_respuestas (id_pregunta,id_evaluacion_asignada, id_evaluacion, usuario_contrato,estatus) 
								VALUES 
								('$pregunta_asignada[id_pregunta]','$id_eval_asignada[id]','$_POST[evaluacion_asignada]','$_POST[contrato_texto]','Espera')");
								echo $con->my_error;
		}
	}else
		echo "<script> alert(\"No se ha podido asignar la siguiente evaluación debido a lo siguiente:\\n\\nYa fué asignada y se encuentra en estado de espera.\\nYa había sido asignada y se encuentra Aprobada.\");</script>";
}
?>