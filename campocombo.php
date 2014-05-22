<?php
$sql2=$bd->consulta("SELECT * FROM respuestas WHERE  LECCION = $_GET[lecc] AND	FILA = $f AND PUNTO=$pag ORDER BY ID");

														$parte=1;
														$opciones=$bd->sig_reg($sql2);
														$yy="";
														$num_resp_linea=0;
														$nota_linea=1;
														$hay_eval=0;
														
														while($opciones)
														{
														
															  /*if (strstr($Cadena,'#40'))
															  {
																		$yy='#40';
															  }
															  else	*/						
																/*if (strstr($Cadena,'#4')){
																		$yy='#4';
																}
																else	*/											
																	if (strstr($Cadena,'#8') && strstr($Cadena,'#5')){
																		if (strpos($Cadena,'#5') > strpos($Cadena,'#8'))
																		{
																			$yy='#8';
																		}
																		else{
																			$yy='#5';
																		}
																	}
																	else
																		if (strstr($Cadena,'#8')){
																					$yy='#8';
																		}
																		else							
																			if (strstr($Cadena,'#6')){
																						$yy='#6';
																			}
																			/*else																
																				if (strstr($Cadena,'#5')){
																						$yy='#5';
																				}*/
																				else
																					if (strstr($Cadena,'#10')){
																								$yy='#10';
																					}
																					/*	else
																						if (strstr($Cadena,'#30')){
																									$yy='#30';
																						}
																					    else
																						if (strstr($Cadena,'#3')){
																									$yy='#3';
																						}*/
																						else
																							if (strstr($Cadena,'#7')){
																										$yy='#7';
																							}
																							else
																							if (strstr($Cadena,'#35')){
																										$yy='#35';
																							}
																							else
																								if (strstr($Cadena,'#12')){
																											$yy='#12';
																								}
																								else
																									if (strstr($Cadena,'#13')){
																												$yy='#13';
																									}
																									else
																									if (strstr($Cadena,'#11')){
																												$yy='#11';
																									}
																									else
																										if (strstr($Cadena,'#9')){
																												$yy='#9';
																										}else{
																											$indice=0;
																											$encontrado=false;
																											while ((isset($sust["$indice"])) && ($encontrado==false))
																											{		
																												if (strstr($Cadena,$sust["$indice"]))
																												{
																													$yy=$sust["$indice"];
																													$encontrado=true;
																													
																													
																												}
																												$indice+=1;	
																											}
																										
																										}
																										
																if (isset($yy) && $yy<>""){											
																	
																	$combocont+=1;
																	$xx='<select name="respuesta'.$combocont.'" style="width:auto">'; 
																	//aqui se crea el combo 
																	$xx.='<option></option>';
																	while(($opciones)&&($parte==$opciones['PARTE']))
																	{																				
																		$xx.='<option >'. $opciones['RESPUESTA'] .' </option>';
																		$opciones=$bd->sig_reg($sql2);
																	} 
																		
																	$xx.='</select>';
																	$cadena_repuesto=$Cadena;
																	$Cadena = str_replace($yy, $xx,$Cadena,$y);
																	
																}else
																{
																	while(($opciones)&&($parte==$opciones['PARTE']))
																	{																				
																		
																		$opciones=$bd->sig_reg($sql2);
																	} 
																	
																	
																	
																}
																
														
														
																												
															if((isset($_POST['click']) && $_POST['click']))
															{
																if($y && $yy<>"")
																{	
																	$hay_eval=1;
																	$sql4=$bd->consulta("SELECT * FROM respuestas WHERE  LECCION = $_GET[lecc] AND	FILA = $f AND PUNTO=$pag AND PARTE=$parte ORDER BY ID ");
																	$opciones4=$bd->sig_reg($sql4);
																	$num_resp_linea+=1;
																	$salir=1;
																	$combocont2+=1;
																	while (($opciones4)&&($parte==$opciones4['PARTE'])&& $salir)
																	{				
																	   if (isset($_POST['respuesta'.$combocont2]))	
																	   {
																			if (($opciones4['RESPUESTA']== stripslashes($_POST['respuesta'.$combocont2]))&&($opciones4['BUENA']==1))
																			{
																				
																				$Cadena = str_replace($yy,'<span style="color:#00F">'. stripslashes($_POST['respuesta'.$combocont2]).'</span>',$cadena_repuesto);
																				$salir=0;
																			}else
																			{
																				if ((($opciones4['RESPUESTA']==stripslashes($_POST['respuesta'.$combocont2]))&&($opciones4['BUENA']<>1))||(($_POST['respuesta'.$combocont2])==""))
																				{
																					$respuestabd=$opciones4['RESPUESTA'];
																					$respuestaselect=$_POST['respuesta'.$combocont2];
																					if(!$_POST['respuesta'.$combocont2])
																					{
																						$_POST['respuesta'.$combocont2]='---';
																					}//asigno --- a las respuestas en blanco
																					
																					$Cadena = str_replace($yy,'<span style="color:#C00">'. stripslashes($_POST['respuesta'.$combocont2]).'</span>',$cadena_repuesto);
																					
																					$salir=0;
																					$nota_linea=0;
																				}else
																					$Cadena.=$opciones4['RESPUESTA'].stripslashes($_POST['respuesta'.$combocont2]);
																		
																			}//fin if rescpuesta correcta
																	   }else
																	   {
																		
																			$_POST['respuesta'.$combocont2]='---';//asigno --- a las respuestas en blanco
																			$Cadena = str_replace($yy,'<span style="color:#C00">'. stripslashes($_POST['respuesta'.$combocont2]).'</span>',$cadena_repuesto);
																			$salir=0;
																			$nota_linea=0;
																	   }
																		$opciones4=$bd->sig_reg($sql4);
																	}//fin while parte
																
																	
																}//FIN IF Y
															}//FIN IF CLICK
															
															$parte=$opciones['PARTE'];
														}//fin while opciones
														if($hay_eval==1){
															$num_lineas+=1;
															$nota_acum_lineas= $nota_acum_lineas+$nota_linea;        
															}	