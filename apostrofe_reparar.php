<?php
$sqlapostrofe=$bd->consulta("SELECT * FROM respuestas");
	$texto=$bd->sig_reg($sqlapostrofe);
	while($texto)
	{
		$txt=addslashes($texto['RESPUESTA']);
		$bd->consulta("UPDATE respuestas SET 
							   RESPUESTA = '$txt'
							   WHERE ID = '$texto[ID]'");
		$texto=$bd->sig_reg($sqlapostrofe);
	}
?>