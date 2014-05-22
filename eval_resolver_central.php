
<SCRIPT LANGUAGE = "JavaScript">
<!--
		var secs
		var timerID = null
		var timerRunning = false
		var delay = 1000
		
		function InitializeTimer()
		{
			// Set the length of the timer, in seconds
			secs = 1800
			StopTheClock()
			StartTheTimer()
		}
		
		function StopTheClock()
		{
			if(timerRunning)
				clearTimeout(timerID)
			timerRunning = false
		}
		
		function StartTheTimer()
		{
			if (secs==0)
			{
				StopTheClock()
				document.getElementById("tiempo").innerHTML=secs
				// Here's where you put something useful that's
				// supposed to happen after the allotted time.
				// For example, you could display a message:
				var examen="examen";
				var tiempo_fuera='tiempo_fuera';
				document.examen.tiempo_fuera.value='1';
				alert("tiempo fuera");
				document.examen.submit();
				
				
			}
			else
			{
				self.status = secs
				secs = secs - 1
				timerRunning = true
				document.getElementById("tiempo").innerHTML=secs+1
				timerID = self.setTimeout("StartTheTimer()", delay)
				
			}
		}
		//-->
</SCRIPT>


<?php
$con=new db;

	
	
	
	//se le asigna nota 0 antes de empesar el examen por si se sale entes de tiempo
	$ya_visto=$con->consulta("SELECT * FROM ee_evaluacion_asignada WHERE id='$_POST[eval_resolver]'");
	$ya_visto=$con->sig_reg($ya_visto);
		if ($ya_visto['estatus']!='Respondida')
		{
			if (isset($_POST['enviar_respuestas'])&& $_POST['enviar_respuestas'])
			{
				$timer=60;
				if (!$_SESSION['wc']['timer'])
					$_SESSION['wc']['timer']=$timer;
				
				foreach ($_POST as $campo => $valor)
				{ 
					$dato=explode('_',$campo);
					if($dato[0]=='respuesta'){
						$con->consulta("UPDATE ee_respuestas SET estatus='Respondida',
																 respuesta='$valor'
																 WHERE id_evaluacion_asignada='$dato[1]' AND id_pregunta='$dato[2]'");
					}
					$con->consulta("UPDATE ee_evaluacion_asignada SET estatus='Respondida'
																  WHERE id='$dato[1]'");
					
									
				}
				echo "<p>Las respuestas ingresadas fueron almacenadas con exito, en poco tiempo sera revisado y evaluado.</p>";
			}else{
			
				if($ya_visto['estatus']!='vista')
				{
					$con->consulta("UPDATE ee_evaluacion_asignada SET estatus='vista' WHERE id='$_POST[eval_resolver]'");
					
					//aqui las preguntas y espacio para responder, con tiempo de evaluacion 
					echo"<div style='text-align:right;padding-top:20px; padding-right:20px;text-align:right;'>Tiempo: <label  id='tiempo' >0</label> seg</div>";
					
					$_SESSION['wc']['timer']=0;
					$preguntas=$con->consulta("SELECT
														ee_evaluaciones.id_evaluacion,
														ee_evaluaciones.rango,
														ee_evaluaciones.nombre,
														ee_evaluaciones.cantidad_preguntas
													FROM
														ee_evaluaciones
													Inner Join ee_evaluacion_asignada ON ee_evaluacion_asignada.id_evaluacion = ee_evaluaciones.id_evaluacion
													WHERE
														ee_evaluacion_asignada.id =  '$_POST[eval_resolver]'");
					$pregunta=$con->sig_reg($preguntas);
					?>
					<form style="padding:20px" name="examen" action="inicio.php?lugar=eval_resolver" method="post">
						<?php
						echo"<p><b><center>$pregunta[nombre]</center></b></p>";
						
						$respuestas=$con->consulta("SELECT * FROM ee_respuestas WHERE id_evaluacion_asignada='$_POST[eval_resolver]' ");
						$contador=0;
						while($respuesta=$con->sig_reg($respuestas))
						{
							$pregunta_nombre=$con->consulta("SELECT * FROM ee_preguntas WHERE id_pregunta='$respuesta[id_pregunta]' ");
							$pregunta_nombre=$con->sig_reg($pregunta_nombre);
							$contador++;
							echo"<p>$contador.) $pregunta_nombre[texto]</p>";
							echo"<p>R$contador.) <input type='text' name='respuesta_$_POST[eval_resolver]_$pregunta_nombre[id_pregunta]'></p>";
							//name de la respuesta lleva: respuesta-numero_eval_asignada-id_pregunta
							
						}
						echo "<input type='hidden' name='eval_resolver' value='$_POST[eval_resolver]'>";
						echo "<input type='submit' name='enviar_respuestas' value='Enviar'>";//aqui toca ver a donde va esta informacion, creo que debo crear una pagina en donde diga que ha finalizado la evaluacion. y luego un boton de continuar
						echo "<input type='hidden' name='tiempo_fuera' value='0'>";
						?>
					</form>
					<script type="text/javascript">InitializeTimer();</script>	
					<?php
				}else
				{
					echo "<p>Ud. no puede realizar esta eval, ya ha sido vista</p>";
				}
			}
				
		}else
			echo "<p>Ud. no puede realizar esta eval, ya ha sido Vista y Respondida</p>";
	
	?>
