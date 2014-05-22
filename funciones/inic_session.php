<?php function iniciar_session($contrato,$clave,$nombre,$apellido,$nivel,$lugar,$lecc,$libro,$direccion,$pag)
	{
		$_SESSION['wc']['session']=true;
		$_SESSION['wc']['nombre']=$nombre. ' '. $apellido;
		$_SESSION['wc']['nivel']=$nivel;
		$_SESSION['wc']['nota_pagina']=0;
		$_SESSION['wc']['leccion']=0;
		$_SESSION['wc']['contrato']=$contrato;
		
	
	}
?>