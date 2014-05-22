<?php
$con=new db;
include('perfil_central.php');
	echo "<div style='float:left; width:748px; height:auto;'>";
	$i=1;
	$buenas=0;
	while(isset($_POST['respuesta_'.$i]))
	{
		$respuesta=$_POST['respuesta_'.$i];
		$respuestas=$con->consulta("SELECT * FROM videos_situacionales_resp WHERE id_respuesta='$respuesta'");
		$resp=$con->sig_reg($respuestas);
		
		$preguntas=$con->consulta("SELECT * FROM videos_situacionales_preg WHERE id_preguntas_sit='$resp[id_preg]'");
		$preg=$con->sig_reg($preguntas);
		
		echo $preg['pregunta']."<br>";
		if($resp['buena']){
			
			echo "<p style='color:blue;'>".$resp['respuesta']."</p><br>";
			$buenas++;
			
		}else
			echo  "<p style='color:red;'>".$resp['respuesta']."</p><br>";
		$i++;
	}
	?>
    <a href="inicio.php?lugar=videos_situacionales">Continuar</a>
    <?php
	$aprobado=100;
	$num_resp=$i-1;
	$total_nota=$buenas*100/$num_resp;
	
	if($total_nota==$aprobado){
	$contrato=$_SESSION['wc']['contrato'];
		$existe=$con->consulta("SELECT * FROM videos_situacionales_evaluados WHERE contrato=$contrato AND id_video=$_GET[video]");
		if(!$con->num_filas($existe))
			$con->consulta("INSERT INTO videos_situacionales_evaluados (contrato,id_video,nota)VALUES('$contrato','$_GET[video]','1') ");
	}
	echo "</div>";
?>