<?php 

if(isset($_SESSION['wc']['nivel']) && ($_SESSION['wc']['nivel']=='E' ))
{	

	include('perfil_central.php');
	$contrato=$_SESSION['wc']['contrato'];
	echo $_SESSION['wc']['contrato'];
	
	$sql=$bd->consulta("SELECT * FROM usuarios where contrato = '$contrato'");
	$usuario=$bd->sig_reg($sql);
	echo $usuario['leccion_aprobada'];
	?>
	<p><strong> &nbsp;Datos Personales</strong></p>
	
	<div id="formulario_adm">
    
		<div class="input_text"><div class="formulario_interno"><strong>Contrato:&nbsp; </strong></div><div class="formulario_interno" style="text-align:left"><?php echo $usuario['contrato']?></div><div style="clear:both"></div></div>
<div class="input_text">
  <div class="formulario_interno"><strong>C.I.:&nbsp; </strong></div><div class="formulario_interno" style="text-align:left"><?php echo $usuario['cedula']?></div></div>
<div class="input_text">
  <div class="formulario_interno"><strong>Nombre:&nbsp;  </strong></div> 
  <div class="formulario_interno" style="text-align:left"><?php echo $usuario['nombre'] ?></div></div>
<div class="input_text">
  <div class="formulario_interno"><strong>Apellido: </strong>&nbsp;</div> 
  <div class="formulario_interno" style="text-align:left"><?php echo $usuario['apellido'] ?></div></div>
<div class="input_text">
  <div class="formulario_interno"> <strong>Sexo: &nbsp;</strong></div><div class="formulario_interno" style="text-align:left"><?php echo $usuario['sexo'] ?></div></div>
<div class="input_text">
  <div class="formulario_interno"> <strong>Estado:&nbsp;</strong></div> 
  <div class="formulario_interno" style="text-align:left"><?php echo $usuario['estado']; ?></div></div>
<div class="input_text">
  <div class="formulario_interno"><strong>Ciudad:&nbsp;</strong></div> 
  <div class="formulario_interno" style="text-align:left"><?php echo $usuario['ciudad']  ?></div></div>
                                <?php
                                $vencimiento=substr($usuario['vencimiento'], 8, 2).'-';
                                $vencimiento.=substr($usuario['vencimiento'], 5, 2).'-';
                                $vencimiento.=substr($usuario['vencimiento'], 0, 4);
                                ?>
                                <div class="input_text">
                                  <div class="formulario_interno"><strong>Vencimiento:&nbsp;</strong></div> 
                                  <div class="formulario_interno" style="text-align:left"><?php echo $vencimiento  ?></div></div>
                                <div class="input_text">
                                  <div class="formulario_interno"><strong>Lecciones Aprobadas:&nbsp;</strong></div> 
                                  <div class="formulario_interno" style="text-align:left"><?php echo $usuario['leccion_aprobada']  ?></div></div>
                                <!--<div class="input_text">
                                  <div class="formulario_interno"><strong>Nivel:&nbsp;</strong></div> 
                                  <div class="formulario_interno" style="text-align:left"><?php /*if($usuario['nivel']=='p'){echo ('Profesor');}else{if($usuario['nivel']=='E'){echo ('Estudiante');}else{if($usuario['nivel']=='a'){echo ('Administrador');}else{if($usuario['nivel']=='s'){echo ('Super-Administrador');}}}} */ ?></div></div>-->
                                <div class="input_text">
                                  <div class="formulario_interno"><strong>Estatus:&nbsp;</strong></div> 
                                  <div class="formulario_interno" style="text-align:left"><?php if($usuario['activo']=='S' || $usuario['activo']=='s'){echo ('Activo');}else{if(!isset($s)){echo ('Inactivo');}}  ?></div></div>
	</div>	
	
	<?php 
}else{
	echo('Error, este usuario no tiene acceso al modulo Perfil de usuario');
}?>	