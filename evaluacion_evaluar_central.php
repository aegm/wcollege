<?php 
	include('administrador_central.php');
	$con=new db;
	if(isset($_POST['evaluar']))
		include('evaluar_examen.php');
?>
<div class="cont_derecho_adm">
    <form action="" method="post" name="formulario1">
    	<fieldset>
        	<legend>Filtro</legend>
           
            
            <select name="filtro" onChange="formulario1.submit()">
            	<option value="contrato" <?php 	if(isset($_POST['filtro']) && $_POST['filtro']=='contrato'){echo 'selected';} ?>>Por Contrato</option>  
                <option value="evaluacion" <?php 	if(isset($_POST['filtro']) && $_POST['filtro']=='evaluacion'){echo 'selected';} ?>>Por Evaluacion</option>
            </select>
            <?php
			if(!isset($_POST['filtro']))
				$_POST['filtro']='contrato';
			if(isset($_POST['contrato']))
				$contrato_valor=$_POST['contrato'];
			else
				$contrato_valor='';
				switch ($_POST['filtro'])
				{
					case 'contrato':echo"<input type='text' name='contrato' value='$contrato_valor'><input type='submit' name='buscar_usuario' value='Buscar'>" ;
									break;
					
					case'evaluacion':$evaluaciones=$con->consulta("SELECT * FROM ee_evaluaciones");?>
									<select name="id_evaluacion" onChange="formulario1.submit()" style="width:auto">
										<?php
										echo "<option value='' $selected></option>";
										while($evaluacion=$con->sig_reg($evaluaciones))
										{
											if(isset($_POST['id_evaluacion']) && $_POST['id_evaluacion']==$evaluacion['id_evaluacion'])
												$selected='selected';
											else
												$selected='';
												echo "<option value='$evaluacion[id_evaluacion]' $selected>$evaluacion[nombre]</option>";
										}?>
									</select>
									<?php
									break;
				}?>
		</fieldset>
        <?php
		switch ($_POST['filtro'])
		{
			case 'contrato':if(isset($_POST['contrato']))
							{
								$evaluaciones_asignadas=$con->consulta("SELECT * FROM ee_evaluacion_asignada
								 WHERE usuario_contrato='$_POST[contrato]' AND estatus='Respondida'");
								if($con->num_filas($evaluaciones_asignadas)){
									echo "<fieldset>";	
									echo"<legend>Evaluaciones Asignadas, Seleccione la que desea evaluar</legend>";
									?>
									<select name="id_evaluacion_asignada" onChange="formulario1.submit()" style="width:auto">
										<?php
										echo "<option value='' $selected></option>";
										while($evaluacion_asignada=$con->sig_reg($evaluaciones_asignadas))
										{
											$evaluaciones=$con->consulta("SELECT * FROM ee_evaluaciones 
											WHERE id_evaluacion='$evaluacion_asignada[id_evaluacion]'");
											$evaluacion=$con->sig_reg($evaluaciones);
											if(isset($_POST['id_evaluacion_asignada']) && $_POST['id_evaluacion_asignada']==$evaluacion_asignada['id'])
												$selected='selected';
											else
												$selected='';
												echo "<option value='$evaluacion_asignada[id]' $selected>$evaluacion[nombre]</option>";
										}?>
									</select>
									<?php
									echo "</fieldset>";	
									
									if(isset($_POST['id_evaluacion_asignada']))
									{
										echo "<fieldset style='text-align:center'>";
										echo"<legend>Evaluación</legend>";	
										   $respuestas=$con->consulta("SELECT * FROM ee_respuestas 
										   WHERE usuario_contrato='$_POST[contrato]' AND id_evaluacion_asignada='$_POST[id_evaluacion_asignada])'");
										   
										   $unico=true;
										   echo "<table>";
										   while($respuesta=$con->sig_reg($respuestas))
										   {
											   if($unico){
													$nombre_eval=$con->consulta("SELECT * FROM ee_evaluaciones 
													WHERE id_evaluacion='$respuesta[id_evaluacion]'");
													$nombre_eval=$con->sig_reg($nombre_eval);
													
													echo "<p>$nombre_eval[nombre]</p>";
													$unico=false;
											   }
											   $pregunta=$con->consulta("SELECT * FROM ee_preguntas WHERE id_pregunta='$respuesta[id_pregunta]'");
											   $pregunta=$con->sig_reg($pregunta);
											   
												   echo "<tr>";
														echo "<td><b>$pregunta[texto]</b></td>";
												   echo "</tr>";
														echo "<td>$respuesta[respuesta]</td>
															  <td><input type='radio' name='nota_$respuesta[id_evaluacion_asignada]_$respuesta[id_respuesta]' value='1'>Buena
															  <input type='radio' name='nota_$respuesta[id_evaluacion_asignada]_$respuesta[id_respuesta]' value='0'>Mala</p></td>";
												   echo "<tr>";
												   
												   echo "</tr>";
										   }
											echo "</table>";
										echo "</fieldset>";	
									}
								}else
									echo "<p>No se produjo ningún resultado debido a los siguientes posibles motivos:</p>El usuario no ha resuelto las evaluaciones que se le han asignado.<br>El usuario no posee evaluaciones en espera de corrección.";
							}
													break;
									
				case'evaluacion':if(isset($_POST['id_evaluacion']))
								{
										
									$usuarios_corregir=$con->consulta("SELECT * FROM ee_evaluacion_asignada 
									WHERE  id_evaluacion=$_POST[id_evaluacion] AND estatus='Respondida'  
									GROUP BY usuario_contrato ORDER BY usuario_contrato ASC");
									if($con->num_filas($usuarios_corregir))
									{
										echo "<fieldset style='text-align:center'>";
										echo"<legend>Usuarios</legend>";
										?>
										
										<select name="usuario_corregir" onChange="formulario1.submit()" style="width:auto">
											<?php
											echo "<option value='' $selected></option>";
											while($usuario_corregir=$con->sig_reg($usuarios_corregir))
											{
												if(isset($_POST['usuario_corregir']) && $_POST['usuario_corregir']==$usuario_corregir['usuario_contrato'])
													$selected='selected';
												else
													$selected='';
													echo "<option value='$usuario_corregir[usuario_contrato]' $selected>$usuario_corregir[usuario_contrato]</option>";
											}?>
										</select>
										<?php
									
										echo "</fieldset>";	
										
										if(isset($_POST['usuario_corregir']))
										{
											echo "<fieldset style='text-align:center'>";
											echo"<legend>Evaluación</legend>";	
											   $respuestas=$con->consulta("SELECT * FROM ee_respuestas WHERE usuario_contrato='$_POST[usuario_corregir]' AND id_evaluacion='$_POST[id_evaluacion])' and estatus='respondida'");
											   $unico=true;
											   echo "<table>";
											   while($respuesta=$con->sig_reg($respuestas))
											   { 
												   if($unico){
														$nombre_eval=$con->consulta("SELECT * FROM ee_evaluaciones WHERE id_evaluacion='$respuesta[id_evaluacion]'");
														$nombre_eval=$con->sig_reg($nombre_eval);
														echo "<p>$nombre_eval[nombre]</p>";
														$unico=false;
												   }
												   $pregunta=$con->consulta("SELECT * FROM ee_preguntas WHERE id_pregunta='$respuesta[id_pregunta]'");
												   $pregunta=$con->sig_reg($pregunta);
													   echo "<tr>";
															echo "<td><b>$pregunta[texto]</b></td>";
													   echo "</tr>";
															echo "<td>$respuesta[respuesta]</td>
																  <td><input type='radio' name='nota_$respuesta[id_evaluacion_asignada]_$respuesta[id_respuesta]' value='1'>Buena
																  <input type='radio' name='nota_$respuesta[id_evaluacion_asignada]_$respuesta[id_respuesta]' value='0'>Mala</p></td>";
													   echo "<tr>";
													   
													   echo "</tr>";
											   }
												echo "</table>";
											echo "</fieldset>";	
										}
									}else
										echo "<p>No se produjo ningún resultado debido a los siguientes posibles motivos:</p>Los usuarios no han resuelto la evaluacion que ha sido leccionada.<br>La evaluacion seleccionada no ha sido asignada a ningun usuario";
								}
								break;
			}
			
			if(isset($unico)&&!$unico){
				echo"<input type='hidden' name='filtro' value='null'>";
				echo"<input type='submit' name='evaluar' value='Evaluar'>";
			}
			
	
				
			?>
    </form>
</div>
