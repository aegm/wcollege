<?php
session_start();
								/*$_SESSION['wc']['contrato']='16581408';*/
include_once('nivel1.php');

include_once('nivel2.php');

include_once('nivel3.php');


include_once('conversacion.php');

include_once('conexion.php');
		$sql=mysql_query("SELECT * FROM `usuarios` WHERE contrato='".$_SESSION['wc']['contrato']."' ",$cnn);
				$row=mysql_fetch_array($sql);

			//$nivel1=(56-$row['leccion_aprobada']);
			 $n=$row['leccion_aprobada']+$_SESSION['total_conversacion'];
				$intPct=round(  ( ($n*100)/61)  );
				
			 $_SESSION['intPct']=$intPct;
			 if ($intPct==0)
			 {
				 
			 }else{
			 $cantidadtotal=100-$intPct;
	$_SESSION['n']=$cantidadtotal;
			 }
?><div align="center"><img src="pastelsql.php" /></div>

