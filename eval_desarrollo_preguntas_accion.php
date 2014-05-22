<?php 
	if((isset($_POST['accion'])&&$_POST['accion']))
		$accion=$_POST['accion'];
	else
		if (isset($_GET['accion']) && $_GET['accion'] )
			$accion=$_GET['accion'];
		else
			if (isset($_POST['accion2']) && $_POST['accion2'] )
				$accion=$_POST['accion2'];
			else
				$accion=NULL;
	switch ($accion) //en caso de que la accion venga tanto por post como por get
	{
		case 'Agregar'://AGREGAR SOLO VIENE POR POST POR LO TANTO PROCEDO A INSERTAR DIRECTAMENTE
					$con->consulta("INSERT INTO ee_preguntas 
										(texto, id_evaluaciones) 
										VALUES 
										('$_POST[texto]','$_POST[evaluacion]')");
					$_POST['accion']='Agregar';
					$_POST['texto']=NULL;
					break;
		case 'Editar'://editar viene tanto por post como por get por lo tanto debo preguntar cual de las dos es, si es post, procedo a hacer update
					if(isset($_POST['accion'])&&$_POST['accion'])// en caso de que venga la opcion de editar por post, indica que hay que hacer update
					{
						$con->consulta("UPDATE ee_preguntas SET 
												texto='$_POST[texto]', 
												id_evaluaciones='$_POST[evaluacion]' 
												WHERE id_pregunta='$_POST[id]'");
						$_POST['texto']=NULL;
						$_POST['accion']='Agregar';
					}else{//sino, indica que viene por get y hay que solo mostrar los datos
						$_POST['accion']='Editar';
						$editar_preguntas=$con->consulta("SELECT * FROM ee_preguntas WHERE id_pregunta='$_GET[id]'");
						$editar_pregunta=$con->sig_reg($editar_preguntas);
						$_POST['texto']=$editar_pregunta['texto'];
						
					}
					
					break;
		case 'Eliminar'://ELIMINAR viene solo por get, pero igual debo preguntar si esta seguro de eliminar
					$eliminar=true;//esta opcion viene dada por el usuario al preguntarle si esta seguro de eliminar
					
					
					/*echo "<div class='error'><span class='ui-icon ui-icon-alert' style='float:left; margin:0 7px 20px 0;'></span><p>Esta seguro de que desea Eliminar la evaluacion seleccionada</p></div>";*/
					if($eliminar==true){
						if($_POST)
						{
							foreach ( $_POST as $campo => $valor)
							{
								$dato=explode('_',$campo);
								if($dato[0]=='id')
									$con->consulta("DELETE FROM ee_preguntas WHERE  id_pregunta='$valor'");
							}
						}else
							$con->consulta("DELETE FROM ee_preguntas WHERE  id_pregunta='$_GET[id]'");
					}
					
					$_POST['accion']='Agregar';// sa esigna agregar, porque despues de eliminar debe quedar asi para la proxima accion
					$_POST['texto']=NULL;
					break;
		default:
		  			$_POST['accion']='Agregar';
	}
?>