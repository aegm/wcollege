<?php 
	if((isset($_POST['accion'])&&$_POST['accion']))
		$accion=$_POST['accion'];
	else
		if (isset($_GET['accion']) && $_GET['accion'] )
			$accion=$_GET['accion'];
			else
				$accion=NULL;
	switch ($accion) //en caso de que la accion venga tanto por post como por get
	{
		case 'Agregar'://AGREGAR SOLO VIENE POR POST POR LO TANTO PROCEDO A INSERTAR DIRECTAMENTE
					$con->consulta("INSERT INTO ee_evaluaciones 
										(nombre, cantidad_preguntas) 
										VALUES 
										('$_POST[eval_titulo]','$_POST[eval_cant_preguntas]')");
					$_POST['accion']='Agregar';
					$_POST['eval_titulo']=NULL;
					$_POST['eval_cant_preguntas']=NULL;
					break;
		case 'Editar'://editar viene tanto por post como por get por lo tanto debo preguntar cual de las dos es, si es post, procedo a hacer update
					if(isset($_POST['accion'])&&$_POST['accion'])// en caso de que venga la opcion de editar por post, indica que hay que hacer update
					{
						$con->consulta("UPDATE ee_evaluaciones SET  
												nombre='$_POST[eval_titulo]', 
												cantidad_preguntas='$_POST[eval_cant_preguntas]' 
												WHERE id_evaluacion='$_POST[id]'");
						
						$_POST['eval_titulo']=NULL;
						$_POST['eval_cant_preguntas']=NULL;
						$_POST['accion']='Agregar';
					}else{//sino, indica que viene por get y hay que solo mostrar los datos
						$_POST['accion']='Editar';
						$editar_evaluaciones=$con->consulta("SELECT * FROM ee_evaluaciones WHERE id_evaluacion='$_GET[id]'");
						$editar_evaluacion=$con->sig_reg($editar_evaluaciones);
						$_POST['eval_titulo']=$editar_evaluacion['nombre'];
						$_POST['eval_cant_preguntas']=$editar_evaluacion['cantidad_preguntas'];
					}
					break;
		case 'Eliminar'://ELIMINAR viene solo por get, pero igual debo preguntar si esta seguro de eliminar
					$eliminar=true;//esta opcion viene dada por el usuario al preguntarle si esta seguro de eliminar
					
					
				/*	echo "<div class='error'><span class='ui-icon ui-icon-alert' style='float:left; margin:0 7px 20px 0;'></span><p>Esta seguro de que desea Eliminar la evaluacion seleccionada</p></div>";*/
					if($eliminar==true){
						$con->consulta("DELETE FROM ee_evaluaciones WHERE  id_evaluacion='$_GET[id]'");
					}
					
					$_POST['accion']='Agregar';// sa esigna agregar, porque despues de eliminar debe quedar asi para la proxima accion
					$_POST['eval_titulo']=NULL;
					$_POST['eval_cant_preguntas']=NULL;
					break;
		default:
		  			$_POST['accion']='Agregar';
	}
?>