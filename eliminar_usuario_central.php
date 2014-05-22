
<?php 
if(isset($_SESSION['wc']['nivel']) && ($_SESSION['wc']['nivel']== 's'))
{
	include('administrador_central.php');
	?>
 <div class="cont_derecho_adm">
	<p><strong> &nbsp;Eliminar Usuario</strong></p>
	<?php 
		if (isset($_POST['eliminar']) && $_POST['eliminar']){
			if(!(isset($bd)))
						{
							require_once('clases/db.class.php');
							$bd=new db;	
						}
						  
							$bd->consulta("DELETE FROM usuarios WHERE contrato = '$_POST[contrato2]'");
							$bd->consulta("DELETE FROM email_recomendados WHERE contrato = '$_POST[contrato2]'");
		}
		
			
	?>
 <div style="width:640px; float:left">	
   <form action="inicio.php" method="post">
                        <div class="input_text"  > Contrato:
                        <input type="text" name="contrato" value="<?php if (isset($_GET['contrato']) && $_GET['contrato']){ echo $_GET['contrato'];}?>" />
                        <input type="submit" name="buscar" value="Buscar"/></div>
                        <input type="hidden" name="lugar" value="<?php echo $_GET['lugar'];?>" />
   </form>	
</div>


                
                
	
		<form action="inicio.php" method="post">
		
				
			<?php
				if ((isset($_POST['buscar']) && $_POST['buscar'] )||(isset($_GET['contrato']) && $_GET['contrato']))
				{
				
					if (isset ($_GET['contrato']) && $_GET['contrato'])
					{
						if(!(isset($bd)))
						{
							require_once('clases/db.class.php');
							$bd=new db;	
						}
									  
						$sql=$bd->consulta("SELECT * FROM usuarios where contrato='$_GET[contrato]'");
						$usuario=$bd->sig_reg($sql);
					
					}else
					{
						if(!(isset($bd)))
						{
							require_once('clases/db.class.php');
							$bd=new db;	
						}
									  
						$sql2=$bd->consulta("SELECT * FROM usuarios where contrato='$_POST[contrato]'");
						
						if($sql2){
							$usuario=$bd->sig_reg($sql2);
							if(!(isset($usuario) && $usuario['contrato']))
								echo('No se encontro ningun registro correspondiente al contrato suministrado');
						}else{
							echo('No se encontro ningun registro correspondiente al contrato suministrado');}
					}
					if(isset($usuario) && $usuario['contrato']){
			
					 if($usuario['nivel']<>'s')
					 {?>
                     	<div id="formulario_adm">
						<div class="input_text">Contrato:
						<input  type="text" name="contrato2" value="<?php echo $usuario['contrato']?>" readonly="readonly"/></div>
                        <?php
                        $vencimiento=substr($usuario['vencimiento'], 8, 2).'-';
                        $vencimiento.=substr($usuario['vencimiento'], 5, 2).'-';
                        $vencimiento.=substr($usuario['vencimiento'], 0, 4);
						?>
						<div class="input_text"> Vencimiento:
						<input  type="" name="vencimiento" value="<?php echo $vencimiento ?>"readonly="readonly"/></div>
						<div class="input_text">CI:
						<input  type="text" name="cedula" value="<?php echo $usuario['cedula']?>" readonly="readonly"/></div>
						<div class="input_text">Nombre:
						<input  type="text" name="nombre" value="<?php echo $usuario['nombre'] ?>" readonly="readonly"/></div>
						<div class="input_text">Apellido:
						<input  type="text" name="apellido" value="<?php echo $usuario['apellido'] ?>"readonly="readonly"/></div>
						<div class="input_text"> Sexo:
						<input  type="text" name="sexo" value="<?php echo $usuario['sexo'] ?>"readonly="readonly"/></div>
                        <div class="input_text"> Estado:
						<input  type="text" name="estado" value="<?php echo $usuario['estado']  ?>"readonly="readonly"/></div>
                        <div class="input_text"> Ciudad:
						<input  type="text" name="ciudad" value="<?php echo $usuario['ciudad']  ?>"readonly="readonly"/></div>
                        
					   
						
						
						<div class="input_text" style="padding-top:25px;"> Clave:
						<input type="text" name="clave" value="<?php echo $usuario['clave'] ?>"readonly="readonly"/></div>
					   
						 <div class="input_text"> Activo:
						<input  type="radio" name="activo" value="S" <?php if($usuario['activo']=='S' || $usuario['activo']=='s'){ $s=true;?>checked="checked" <?php } ?> disabled="disabled"/></div>
						 <div class="input_text"> Inactivo:
						<input  type="radio" name="activo" value="N" <?php if(!isset($s)){ ?>checked="checked" <?php } ?> disabled="disabled"/></div>
						<p><strong> "&#191;Esta suguro que desea eliminar este Usuario?"</strong></p>
						 <div class="input_text" ><input type="submit" name="eliminar" value="Eliminar" /></div>
				  
			
			<?php
					 }else
								echo ('Por motivos de seguridad, el usuario seleccionado no puede ser Eliminado');
				   }?>
				   </div>
                <?php   
				}
				 
			?>
			 <input type="hidden" name="lugar" value="<?php echo $_GET['lugar'];?>" />
		</form>
        <?php
		$lugar_value='eliminar_usuario';
				include('tabla.php');?>
		
	</div>	
	<div id="tabla" style="overflow:auto">
		<?php 
		if(!(isset($bd)))
			{
				require_once('clases/db.class.php');
				$bd=new db;	
			}
			
		  
												if(isset($_GET['filtro'])&&$_GET['filtro'])
													$filtro=$_GET['filtro'];
												else
													$filtro='contrato';
												$cant_pag=500;
												$sql = $bd->consulta ("SELECT * FROM usuarios ORDER BY $filtro ASC ");
												$num_registros=$bd->num_filas($sql);
												if(isset($_GET['pag']) && $_GET['pag'] )
													{
														$pag=$_GET['pag'];
														$inicio = $cant_pag*($pag-1);
														$fin = $cant_pag*$pag;
														$sql = $bd->consulta ("SELECT * FROM usuarios ORDER BY $filtro ASC limit $inicio,$fin");
														
													}
													else
													{
														$pag=1;
														$inicio=0;
														$fin=$cant_pag;
														$sql = $bd->consulta("SELECT * FROM usuarios ORDER BY $filtro ASC limit $inicio,$fin");				
														
													}
			
			
					?>
					
		<!--<iframe  src="tabla.php" name="tabla" scrolling="auto" width="590px;" height="400px;" frameborder="0">
			
		</iframe>-->
		
	  
		
</div>
<?php 
}else{
	echo('Error, este usuario no tiene acceso al modulo Administrativo');
}?>	