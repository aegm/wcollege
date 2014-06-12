<?php

	
class consulta {
	
	
	
	
	function sql($c){	
	include_once('conexion.php');
		$sql=mysql_query("SELECT * FROM `usuarios` WHERE contrato='".$c."' ",$cnn);
				$row=mysql_fetch_array($sql);

					$nivel1=$row['leccion_aprobada'];
					$intPct=round(  ( ($nivel1*100)/56)  );
				  return $intPct;

	
	}
	
	
	
}


?>