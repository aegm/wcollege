<div style="clear:both"></div>
	<?php
	
	$y=0;
	$txtcont=0;
	$combocont=0;
	$combocont2=0;
	if((isset($_POST['click']) && $_POST['click']))
	{
        $_GET['lecc']=$_POST['lecc'];
		$_GET['lugar']=$_POST['lugar'];
		$_GET['pag']=$_POST['pag'];
	}
		if((isset($_GET['lecc']) && ($_GET['lecc'])))/*SI LECCION ESTA DEFINIDA Y TIENE ALGUN VALOR */
		{
	
	
	
		if((isset($_GET['lecc']) && ($_GET['lecc'])))/*SI LECCION ESTA DEFINIDA Y TIENE ALGUN VALOR */
		{?>
			<div id="txt_leccion">
				<?php	
                $sql=$bd->consulta("SELECT PUNTO FROM contenidos WHERE CODLECCION = $_GET[lecc] GROUP BY PUNTO ");
                $num_puntos=$bd->num_filas($sql);
                ///////////////////////////////////////////////////construccion del titulo de la leccion y definicion del index o variable $pag///////////////////////
                echo "<p align='center'> Lesson $_GET[lecc]</p>";//nº de leccion
                $sql=$bd->consulta("SELECT TITULO FROM leccion WHERE LECCION = $_GET[lecc] ");
                $titulo=$bd->sig_reg($sql);
                echo "<p align='center'> $titulo[TITULO]</p>";//titulo de la leccion
                
                if(isset($_GET['pag']) && $_GET['pag'] )
                        $pag=$_GET['pag'];
                else
                        $pag=1;	
                ///////////////////////////////////////////////////construccion de la leccion///////////////////////////////////////////////////////////////////
                $f= -1;
                $sql=$bd->consulta("SELECT * FROM contenidos WHERE CODLECCION = $_GET[lecc] AND PUNTO=$pag");
                $contenido=$bd->sig_reg($sql);
			?>	
			<form action="inicio.php" method="post">
            <?php
                while ($contenido)
                {	
					if (($contenido['TIPO'] == 'P')||(($contenido['TIPO'] == 'E')&&(!$contenido['COLUMNA']))||(($contenido['TIPO'] == 'T')&&(!$contenido['COLUMNA'])))
                    {
                        if (($contenido['FILA'] <> $f))
                            $f=$contenido['FILA'];
						?><span <?php if ($contenido['TIPO'] == 'P'){echo $contenido['ESTILO'];}?>  ><?php echo $contenido['TEXTO']	;?> </span><?php
                        ?>
                            <br/>
                        <?php
                        $contenido=$bd->sig_reg($sql);
                    }else
                    { 
                            ?>
                            <table width="100%" border="0" cellpadding="5px">
                            
                            <?php
									$i=0;
                                    while (($contenido)&&($contenido['TIPO'] <> 'P'))
                                    {
                                        if (($contenido['FILA'] <> $f))
                                            $f=$contenido['FILA'];  
                                        ?>
                                        <tr>
                                       
                                        <?php
											
											$ejercicio=false;
                                            while(($contenido)&&($contenido['FILA'] == $f)&&($contenido['TIPO'] <> 'P'))
                                            { $i=$i+1; 
												$sql3=$bd->consulta("SELECT * FROM tipo_respuestas WHERE  LECCION = $_GET[lecc] AND PUNTO=$pag ");
												$linea_tipo_resp=$bd->sig_reg($sql3);
												$linea_tipo_resp['TIPO'];
												$sust = array("#30","#40","#50","#20","#3","#4","#5","#6","#8","#10","#9");
											
												$Cadena=$contenido['TEXTO'];
												
												
												if(($contenido['TIPO'] == 'E')&&($ejercicio==false))
                                            			$ejercicio=true;
													
														 
                                                   
												
											/*	if($linea_tipo_resp['TIPO']=='L')
												{
														
													
													 
													//remplazo el valor en la cadena si es que lo hay
													if((isset($_POST['click']) && $_POST['click']))
													{
														$sql3=$bd->consulta("SELECT * FROM respuestas WHERE  LECCION = $_GET[lecc] AND	FILA = $f AND PUNTO=$pag ");
													    $linea3=$bd->sig_reg($sql3);
														
														$verificocadena=$Cadena;
														$verificocadena = str_replace($sust, '<input type="text" name="respuesta'.$txtcont.'"',$verificocadena,$y);//hago esto solo para verificar si hay campo de texto en la cadena a traves del bool
														if($y){
															
															$txtcont+=1;//num de respuesta que luego junto a respuesta sera pasado por post
															if (($linea3['RESPUESTA'])== $_POST['respuesta'.$txtcont]){
																$Cadena = str_replace($sust,'<span style="color:#00F">'. $_POST['respuesta'.$txtcont].'</span>',$Cadena);//meto campo texto dentro de cadena "aqui la respuesta es correcta*****************************************"
															}else{
																if($_POST['respuesta'.$txtcont]=="")
																	$_POST['respuesta'.$txtcont]='---';//asigno --- a las respuestas en blanco
																$Cadena = str_replace($sust,'<span style="color:#C00">'. $_POST['respuesta'.$txtcont].'</span>',$Cadena);//meto campo texto dentro de cadena
															}
														}
													}else{
														$verificocadena=$Cadena;
														$verificocadena = str_replace($sust, '<input type="text" name="respuesta'.$txtcont.'"',$verificocadena,$y);//hago esto solo para verificar si hay campo de texto en la cadena a traves del bool
														if($y){
															$txtcont+=1;//num de respuesta que luego junto a respuesta sera pasado por post
															$Cadena = str_replace($sust, '<input type="text" name="respuesta'.$txtcont.'"',$Cadena);//meto campo texto dentro de cadena
														}
															
													}
												}
												else
												{ */
													include ("campocombo.php");
													
												/*}*///fin if tipo=L
                                                ?>
                                                    <td <?php if($contenido['COLSPAN']>0){?>colspan="<?php echo $contenido['COLSPAN'];?>"<?php } if ($contenido['ESTILO']){echo $contenido['ESTILO'];} if($contenido['TIPO']=='C'){?> bgcolor="#000066" <?php }?> ><span <?php if($contenido['TIPO']=='C'){?> style="color:#FFF; font-weight:bold;"<?php } ?>><?php echo  $Cadena?></span></td>
													     <?php    
														 
												 $contenido=$bd->sig_reg($sql);			 
													
													
													
                                            }//fin while
                                            ?>
                                            
													   
                                        </tr>
                                    <?php		
                                   }//fin while
                             //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
							 
							 ?>
                             
                              		
												   
               					
               
							
                            </table>
                            	<input type="hidden" name="lugar" value="leccion" />
                                                            <input type="hidden" name="contresp" value="<?php echo $contresp;?>" />
														<?php if(!(isset($_POST['click']) && $_POST['click'])&&($ejercicio==true))
														{?>
															<input type="hidden" name="click" value="1" />
                                                            <input type="hidden" name="lecc" value="<?php echo $_GET['lecc'];?>" />
                                                            <input type="hidden" name="pag" value="<?php echo $_GET['pag'];?>" />
															<input type="submit" name="evaluar" value="Evaluar" />	
												  <?php }?>					
                            <?php
                    }//fin if
                }//fin while?>
                </form>
				<?php									
                ////////////////////////////////////////////////////////Anterior y Siguiente//////////////////////////////////////////////////////////////////////
				if((isset($_POST['click']) && $_POST['click'])||(!isset($ejercicio) || $ejercicio==false))
				{?>
                <div id="ant_sig">
                        <?php
                        if(($pag>1)&&(!isset($ejercicio) || $ejercicio==false))
                        {  
                               $paganterior=$pag-1;?> 
                        <!--acontinuacion paso las variables por get, a travez de las anclas ?para declarar, &para separar variables-->
                              <!-- <a class="txt_num_pag" href='inicio.php<?php echo "?lugar=$_GET[lugar]&lecc=$_GET[lecc]&pag=1";?>'> &lt;&lt; </a> &nbsp;&nbsp;-->
                               <a class="txt_num_pag" href='inicio.php<?php echo "?lugar=$_GET[lugar]&lecc=$_GET[lecc]&pag=$paganterior";?>'> < Anterior </a>&nbsp; 	
                  <?php } 
                        /*for($i=1;$i<=$num_puntos;$i++)//aqui se escriben todos los num de pag hasta n
                        {   
                            if($pag==$i)//acontinuacion esto es para resaltar el numero de pag seleccionado por el usuario
                              {?>
                               <a class="txt_num_pag_selec" href='inicio.php<?php echo "?lugar=$_GET[lugar]&lecc=$_GET[lecc]&pag=$i";?>'><?php echo $i;?></a>
                        <?php }
                              else 
                              { ?> 
                               <a class="txt_num_pag" href='inicio.php<?php echo "?lugar=$_GET[lugar]&lecc=$_GET[lecc]&pag=$i";?>'><?php echo $i;?></a>
                        <?php }
                        } */
                        if($pag<$num_puntos)
                        {
                               $pagsiguiente=$pag+1;?> 
                               &nbsp;<a class="txt_num_pag" href='inicio.php<?php echo "?lugar=$_GET[lugar]&lecc=$_GET[lecc]&pag=$pagsiguiente";?>'> Siguiente > </a>
                            <!--   &nbsp;&nbsp;<a class="txt_num_pag" href='inicio.php<?php echo "?lugar=$_GET[lugar]&lecc=$_GET[lecc]&pag=$num_puntos";?>'> >> </a> 		-->									  				  <?php } else{?>
								   
								  <a class="txt_num_pag" href='inicio.php<?php echo "?lugar=lecciones";?>'> Ir al Temario </a> 
								   
								  <?php }?>
            	</div><!--ant_sig-->
         <?php }?>
        	</div><!--txt_leccion-->
		<?php }//fin if
	}else
	{
		if(isset($_GET['lecc']) && ($_GET['lecc']) && ($_GET['lecc']>1) )/*SI NO HAY SESION Y LA LECCION SELECCIONADA ES MAYOR A 1 */
		{
			?><div class="error">Error: No es posible acceder a la Leccion <?php echo $_GET['lecc']?>. Primero debe iniciar sesi&oacute;n.</div><?php
		}
	}