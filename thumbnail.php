<?php
	require_once('clases/imagen.class.php');
	/*$id=$_GET['id'];*/
	$foto=$_GET['foto'];
	$tamano=NULL;
	if(isset($_GET['tamano']))
		$tamano=$_GET['tamano'];
	$imagen= new imagen;
	
	$thumb=$imagen->thumbnail($foto,$tamano);
	//$thumb=$imagen->logo($thumb,"logo.png");
	if($thumb)
	{
		header('Content-Type: image/jpg');
		imagejpeg($thumb);
	}
	else
	{
		echo $imagen->mensaje;
	}
?>