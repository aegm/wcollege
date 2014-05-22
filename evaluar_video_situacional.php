<?php
	$i=1;
	$buenas=0;
	while(isset($_POST['respuesta_'.$i]))
	{
		$respuesta=$_POST['respuesta_'.$i];
		$respuestas=$con->consulta("SELECT * FROM videos_situacionales_resp WHERE id_respuesta=$respuesta AND buena");
		
		if($con->num_filas($respuestas))
			$buenas++;
		$i++;
	}
	$aprobado=100;
	$num_resp=$i-1;
	$total_nota=$buenas*100/$num_resp;
	
	if($total_nota==$aprobado){
	$contrato=$_SESSION['wc']['contrato'];
		$existe=$con->consulta("SELECT * FROM videos_situacionales_evaluados WHERE contrato=$contrato AND id_video=$_GET[video]");
		if(!$con->num_filas($existe))
			$con->consulta("INSERT INTO videos_situacionales_evaluados (contrato,id_video,nota)VALUES('$contrato','$_GET[video]','1') ");
	}
	
?>