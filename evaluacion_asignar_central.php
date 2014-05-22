<?php 
	include('administrador_central.php');
	$con=new db;
	include ('eval_asignar_accion.php');
?>
<div class="cont_derecho_adm">
    <form action="" method="post">
    	<fieldset>
        	<legend>Contrato</legend>
            <p><input type="text" name="contrato_texto" value="<?php if(isset($_POST['contrato_texto'])) echo $_POST['contrato_texto']; ?>">
            <input type="submit" name="contrato_submit" value="Buscar"></p>
            <?php
			
			if(isset($_POST['contrato_submit']))
			{
				$contratos=$con->consulta("SELECT * FROM usuarios WHERE contrato='$_POST[contrato_texto]'");
				if($con->num_filas($contratos))
				{
					$contrato=$con->sig_reg($contratos);
					echo "<p><b>Estudiante: </b>$contrato[nombre] $contrato[apellido]</p>";
				}
			}
			?>
        </fieldset>
        <?php
		if((isset($contratos) && $con->num_filas($contratos)) || isset($_POST['asignar_eval']) )
		{
			$evaluaciones_asignadas=$con->consulta("SELECT * FROM ee_evaluacion_asignada WHERE usuario_contrato='$_POST[contrato_texto]' ORDER BY id_evaluacion");
			
				echo "<fieldset>";
					echo"<legend>Evaluaciones asignadas </legend>";
					if($con->num_filas($evaluaciones_asignadas))
					{	
						$usuario=$con->consulta("SELECT * FROM usuarios WHERE contrato='$_POST[contrato_texto]'");
						$usuario=$con->sig_reg($usuario);
						echo $usuario['nombre']." ".$usuario['apellido'];
						
						echo "<table id='tabla_evaluaciones_asignadas'>";
						echo"<tr style='background-color:#069; color:#fff;'>";
						echo"<td><b>NOMBRE DE LA EVALUACIÓN</b></td><td><b>ESTADO</b></td><td><b>NOTA</b></td>";
						echo"</tr>";
						while($evaluacion_asignada=$con->sig_reg($evaluaciones_asignadas))
						{
							$nombre_eval_asignadas=$con->consulta("SELECT * FROM ee_evaluaciones WHERE id_evaluacion='$evaluacion_asignada[id_evaluacion]'");
							$nombre_eval_asignada=$con->sig_reg($nombre_eval_asignadas);
							if($nombre_eval_asignada){
								if($evaluacion_asignada['nota']=='1')
									$nota='Aprobado';
								else
									if($evaluacion_asignada['nota']=='0')
										$nota='Reprobado';
									else
										$nota='';
								echo"<tr>";
								echo"<td>$nombre_eval_asignada[nombre]</td><td>$evaluacion_asignada[estatus]</td><td>$nota</td>";
								echo"</tr>";
							}
						}
						echo "</table>";
					}else
						echo "<p>Ninguna</p>";
				echo "</fieldset>";
				echo"<p><b>Seleccione la evaluación que desea asignar:</b></p>";
				echo"<p><b>NOTA:</b> A continuación solo aparecerán las evaluaciones que tengan el mínimo de preguntas requeridas por el Profesor.</p>";
				$nombre_evaluaciones=$con->consulta("SELECT * FROM ee_evaluaciones");?>
                <select name="evaluacion_asignada" style="width:auto">
                    <?php
					echo "<option value='' ></option>";
                    while($nombre_evaluacione=$con->sig_reg($nombre_evaluaciones))
                    {
						if($nombre_evaluacione['id_evaluacion']==$_POST['evaluacion_asignada'])
						 	$selected='selected';
						else
							$selected='';
						$num_preguntas=$con->consulta("SELECT * FROM ee_preguntas WHERE id_evaluaciones='$nombre_evaluacione[id_evaluacion]'");
						if($con->num_filas($num_preguntas)==$nombre_evaluacione['cantidad_preguntas'])
                        echo "<option $selected value='$nombre_evaluacione[id_evaluacion]' >$nombre_evaluacione[nombre]</option>";
                    }
                    ?>
                </select>
                <input type="submit" name="asignar_eval" value="Asignar">
                <?php
			
		}else
			if(isset($_POST['contrato_submit']))
			echo"<p>No se produjo ningun resultado, El contrato introducido no existe.</p>";
		?>
    </form>
</div>