<?php ////////////////////////////////borrar espacios de respuestas/////////////////////////////////
$sqlborrar=$bd->consulta("SELECT * FROM respuestas");
$texto=$bd->sig_reg($sqlborrar);
while($texto)
	{	
		if($texto['RESPUESTA']<>""){
			
			$espacio=0;
			$resp=$texto['RESPUESTA'];
			$tamaño=strlen($resp);
			/*echo $tamaño;
			echo $resp[0];
			echo $resp[$tamaño-1];*/
		
			$PRIMERO=$resp[0];
			$ult=$tamaño-1;
			$ULTIMO=$resp[$ult];
			
			
			
			if($PRIMERO==" " && $ULTIMO==" ")
			{
				$resp=substr($resp, 1,$tamaño-1);
				$espacio=1;
				
			}else
			{
				if($PRIMERO==" ")
				{
					$resp=substr($resp, 1,$tamaño);
					$espacio=1;
					
				}else
				{	
					
					if($ULTIMO==" ")
					{
						$resp=substr($resp, 0,$tamaño-1);
						$espacio=1;
						
					}	
				}
			}
			if($espacio==1){
				$resp=str_replace("'","\'",$resp);
				$bd->consulta("UPDATE respuestas SET RESPUESTA= '$resp'
								WHERE ID= '$texto[ID]'");
			}
		}
	
	$texto=$bd->sig_reg($sqlborrar);
	}
	?>