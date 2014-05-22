<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="styles/styles.css" rel="stylesheet" type="text/css" />
<title>Comprobante</title>
</head>
<body style="background-color:#FFF; background-image:url(images/comprobante_bg.jpg); background-repeat:no-repeat; font-family:Arial, Helvetica, sans-serif">
<?php 
session_start();
if(!(isset($bd)))
	{
		require_once('clases/db.class.php');
		$bd=new db;	
	}
if(isset($_SESSION['wc']['nivel']) && ($_SESSION['wc']['nivel']=='E' ))
{	

	
	$contrato=$_SESSION['wc']['contrato'];
	$sql=$bd->consulta("SELECT * FROM usuarios where contrato = $contrato");
	$usuario=$bd->sig_reg($sql);
	
	if ($_GET['aprobada']<=15){ 
		$lecc_comp= $_GET['aprobada'];
		$libro='Libro 1'; 
	}else 
		if($_GET['aprobada']>15 && $_GET['aprobada']<=25){ 
			$lecc_comp= $_GET['aprobada'];
			$libro='Libro 2';  
		}else 
			if($_GET['aprobada']>25) {
				$lecc_comp= $_GET['aprobada']-25;
				$libro='Libro 3'; 
			}
	
	
	  ?>
      		
	  		 
	
	<div id="comprobante">
    	<p><strong> &nbsp;Comprobante Para la prueba oral Leccion <?php  echo $lecc_comp.' '.$libro;?></strong></p>
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
                    $contrato=$_SESSION['wc']['contrato'];
                    $sql=$bd->consulta("SELECT * FROM email_recomendados where contrato = $contrato");
                    $usuario=$bd->sig_reg($sql);  
                ?>
        <div class="input_text">
          <div class="formulario_interno"><strong>Telefono Personal:&nbsp;</strong></div> 
          <div class="formulario_interno" style="text-align:left"><?php echo $usuario['telefonop']  ?></div></div>
        <div class="input_text">
          <div class="formulario_interno"><strong>E-mail:&nbsp;</strong></div> 
          <div class="formulario_interno" style="text-align:left"><?php echo $usuario['email']  ?></div></div>  
          
  
	</div>	
	
	<?php 
}else{
	echo('Error, este usuario no tiene acceso al modulo Perfil de usuario');
}?>	
</body></html>