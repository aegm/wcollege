<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<!--**********************************************************************************-->

</head>
         
                            
<?php
	
						
///////////////////////////////////si hay sesion//////////////////////////////////////

		if(isset($_SESSION['wc']['session']) && $_SESSION['wc']['session'])
		{	?><div id="sesion_espacio"><?php
					echo "<div id='cerrar_sesion'><a href='cerrar_session.php?lugar=inicio'>Cerrar Sesión</a></div>";
					?><div id="nom_usuario"><?php echo $_SESSION['wc']['nombre'];?></div><?php
					
					
						if(isset($_SESSION['wc']['nivel']) && ($_SESSION['wc']['nivel']=='a' || $_SESSION['wc']['nivel']=='s'))
						{?>
								<a href="<?php echo 'inicio.php?lugar=administrador';?>" class="txtmenuinferior"><span>Administrador</span></a>
				  <?php }   
						if(isset($_SESSION['wc']['nivel']) && ($_SESSION['wc']['nivel']=='E'))
						{?>
								<a href="<?php echo 'inicio.php?lugar=perfil';?>" class="txtmenuinferior"><span>Mis Datos</span></a>
				  <?php }
						if(isset($_SESSION['wc']['nivel']) && ($_SESSION['wc']['nivel']=='p'))
						{?>
								<a href="<?php echo 'inicio.php?lugar=administrador';?>" class="txtmenuinferior" ><span>Profesor</span></a>
				  <?php } ?>
		  	</div>
		<?php	
		}else{

//////////////////////////////////////formulario////////////////////////////////////////			 
?>

       		 <div id="areamensaje">
                <form action="inicio.php" method="post">
                			<div class="txtmenuinferiorderecho" style="float:left">INGRESA AQUI</div>
                            <div class="txtmenuinferiorderecho" style="float:left; font-weight:normal; font-size:10px; ">CONTRATO:</div>
                            <div id="inputusuario"><input name="contrato" type="text" class="inputlogin" size="15" /></div>
                            <div class="txtmenuinferiorderecho" style="float:left; font-weight:normal; font-size:10px; ;">CLAVE:</div>
                            <div id="inputusuario"><input name="clave" type="password" class="inputlogin" size="15" /></div>
                   			<div style="float:left;"><input class="botonentrar" type="submit" value="Entrar" /></div>
                            <input type="hidden" name="aceptar2" value="1" />
                            
                            <input type="hidden" name="lugar" value="<?php echo $_GET['lugar'];?>" />
                            <input type="hidden" name="lecc" value="<?php echo $_GET['lecc'];?>" />
                            <input type="hidden" name="libro" value="<?php echo $_GET['libro'];?>" />
                            <input type="hidden" name="dir" value="<?php echo $_GET['dir'];?>" />
                            <input type="hidden" name="pag" value="<?php echo $_GET['pag'];?>" />
                            
                </form>
             </div><!--Aqui termina el "areamensaje"--> 
<?php

		}

						if(isset($_POST['aceptar2']) && $_POST['aceptar2'])
						{
							
								foreach($_POST as $post => $valor)
									$$post=$valor;
								/*$pass=md5($pass);*/
								/*$sql=$bd->consulta("SELECT * FROM usuarios WHERE contrato='$contrato' && clave='$clave'");
								$sql2=$bd->consulta("SELECT * FROM email_recomendados WHERE contrato='$contrato'");*/
								if (!(isset($usuario) && $usuario['contrato']))
								{
									?>
									<script type="text/javascript">
									alert("Error: CONTRATO o CLAVE incorrecto");
									</script>
						  <?php }
						}	
					?>