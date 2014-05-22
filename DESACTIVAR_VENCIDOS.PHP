<?php
					if(!(isset($bd)))
					{
						require_once('clases/db.class.php');
						$bd=new db;	
					}
					 $fecha = (date("Y").'-'.date("m").'-'.date("d")); 
					 $fecha2 = ((date("Y")+2).'-'.date("m").'-'.date("d")); 
						$bd->consulta("UPDATE usuarios SET 
													   activo = 'N'
													   WHERE vencimiento < '$fecha' OR vencimiento > '$fecha2'");
						$bd->consulta("UPDATE usuarios SET 
													   activo = 'S'
													   WHERE vencimiento >= '$fecha' AND vencimiento <= '$fecha2'");


?>
