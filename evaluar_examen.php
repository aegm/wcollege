<?php
$acumular=0;
$contar=0;
$flag=true;
foreach ($_POST as $campo => $valor)
{
	$dato=explode('_',$campo);
	if($dato[0]=='nota'){
		if($flag)
		{
			$flag=false;
			$eval_asignada=$dato[1];
		}
		$con->consulta("UPDATE ee_respuestas SET nota='$valor',
												 estatus='Corregida'
												 WHERE id_respuesta='$dato[2]'");
		$acumular+=$valor;
		$contar+=1;
	}
	
}
$definitivas=$con->consulta("SELECT * FROM ee_respuestas WHERE id_evaluacion_asignada='$eval_asignada'");
$acumulada=0;
while($definitiva=$con->sig_reg($definitivas))
{
	$acumulada+=$definitiva['nota'];
}
if($acumulada==$con->num_filas($definitivas))//acumulada es igual al numero de preguntas asignadas?
	$definitiva=1;
else
	$definitiva=0;
$con->consulta("UPDATE ee_evaluacion_asignada SET nota='$definitiva',
												  estatus='Corregida'
												  WHERE id='$eval_asignada'");	
					echo $con->my_error;
?>