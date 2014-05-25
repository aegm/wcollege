<?php
	
                                        function send_mail($para, $origen, $asunto, $mensaje,$css="")
                                        {
                                            ini_set("SMTP","mail.washingtoncollege.com.ve");
                                            ini_set("sendmail_from",$origen);
                                            
                                         
											$cabeceras .= "From: $origen" . "\r\n";
                                            
                                            return mail($para, $asunto, $mensaje, $cabeceras);	
                                        }
                                      if(isset($_POST['enviarclick']) && $_POST['enviarclick'] )
                                      {
                                        $nom=$_POST['nombre'];
                                        $empre=$_POST['empresa'];
                                        $cargo=$_POST['cargo'];
                                        $email=$_POST['email'];
                                        $pais=$_POST['pais'];
                                        $ciudad=$_POST['ciudad'];
                                        $telf=$_POST['telefono'];
                                        $coment=$_POST['comentario'];
                                        $mensaje ="
Nombre: $nom 
Empresa: $empre 
Cargo: $cargo 
Pais: $pais 
Ciudad: $ciudad 
Telefono: $telf 

Comentario: $coment";
												   $para1='info@washingtoncollege.com.ve';
												  /* $para2='';
												   $paratotal="$para1, $para2";*/
                                        $formenviado = send_mail($para1,"$email","Contacto Online","$mensaje");
                                        if ($formenviado)
                                        {
                                            ?> 
                                            <script type="text/javascript" language="javascript"> 
                                                alert ("La Informacion Fue Enviada Correctamente");
                                            </script>						
                                           <?php
                                        }
                                        else
                                        {
                                            ?>
                                            <script type="text/javascript" language="javascript"> 
                                                alert ("Ha Ocurrido un Problema con el Envio, Intentelo de Nuevo ");
                                            </script>
                                            <?php
                                        }
                                      }
                  ?>
                                            <script type="text/javascript">
<!--
function MM_validateForm() { //v4.0
  if (document.getElementById){
    var i,p,q,nm,test,num,min,max,errors='',args=MM_validateForm.arguments;
    for (i=0; i<(args.length-2); i+=3) { test=args[i+2]; val=document.getElementById(args[i]);
      if (val) { nm=val.name; if ((val=val.value)!="") {
        if (test.indexOf('isEmail')!=-1) { p=val.indexOf('@');
          if (p<1 || p==(val.length-1)) errors+='- '+nm+' must contain an e-mail address.\n';
        } else if (test!='R') { num = parseFloat(val);
          if (isNaN(val)) errors+='- '+nm+' must contain a number.\n';
          if (test.indexOf('inRange') != -1) { p=test.indexOf(':');
            min=test.substring(8,p); max=test.substring(p+1);
            if (num<min || max<num) errors+='- '+nm+' must contain a number between '+min+' and '+max+'.\n';
      } } } else if (test.charAt(0) == 'R') errors += '- '+nm+' is required.\n'; }
    } if (errors) alert('The following error(s) occurred:\n'+errors);
    document.MM_returnValue = (errors == '');
} }
//-->
                                            </script>
                                                			 
			
 
        
                		<div id="contenido">
                                <div id="info_general"><!--aqui adentro va la informacion-->
                                		<div align="center">
                                                <p><strong>VALENCIA</strong><br />
                                                Av. Bolívar Norte, Torre Banaven, Piso 2, Ofc. 2-02, <br />
                                                Telefonos: 0241-990.42.96 / 996.06.85 / 996.07.00 / 995.79.99
                                                </p>
                                                <p><strong>INSTITUTO VALENCIA</strong><br />
                                                Av. Bolívar Norte, Torre Banaven, Piso 2, Ofc. 2-08/10, <br />
                                                Telefonos: 0241-618.17.80 / 619.68.29
                                                </p>
                                                <p><strong>MARACAY</strong><br />
                                                Urb. la Soledad, 3era calle. Qta. Nro. 26, Detras de Mc. Donald's.<br />
						Telefonos: (0243)-232.17.12
                                                </p>                                                
                                                <p><strong>Correo Electr&oacute;nico: </strong><br />
                                                <A href="#">info @ washingtoncollege.com.ve</A></p>
                  						</div>
                        				<div align="center"> 
                            					<strong><p>"Para mayor información, llene el siguiente formulario y nos pondremos en contacto con usted a la mayor brevedad posible".</p></strong>
                            			</div>
                                        
                                        <div id="formulario" >
                                            <form action="inicio.php" method="post" style="text-align:center" onsubmit="MM_validateForm('nombre','','R','Email','','RisEmail','telefono','','RisNum','comentario','','R');return document.MM_returnValue">
                                             
                                                
                                                <div style="width:500px; height:auto; padding-left:220px">
                                                    <div id="formulario1_1">  
                                                        <div>Nombre y Apellido: <input name="nombre" type="text" 
                                                                class="inputstyle" id="nombre" size=22 maxlength="40"></div>
                                                        <div>Empresa: <input type="text" 
                                                                class="inputstyle" name="empresa" size=22 maxlength="40"></div>
                                                        <div>Cargo: <input type="text" 
                                                                class="inputstyle" name="cargo" size=22 maxlength="40"></div>
                                                        <div>E-mail: <input name="email" type="text" 
                                                                class="inputstyle" id="Email" size=22 maxlength="40"></div>
                                                    </div> 
                                                     
                                                    <div  id="formulario1_2">
                                                        <div>País:<input type="text" 
                                                            class="inputstyle" name="pais" size=22 maxlength="40"></div>
                                                        <div>Ciudad: <input type="text" 
                                                            class="inputstyle" name="ciudad" size=22 maxlength="40"></div>
                                                        <div>Teléfono: <input name="telefono" type="text" 
                                                            class="inputstyle" id="telefono" size=22 maxlength="40"></div>
                                                    </div> 
                                                    <div style="clear:both"></div>    
                                                </div>
                                                    
                                                    <div style="clear:both"></div>    
                                                    <div class="comentario" > 
                                                            <p><strong>Comentario</strong></p>
                                                            <textarea name="comentario" cols=50 rows=7 class="inputstyle" id="comentario"></textarea>
                                                            <p><STRONG>Su petición será confirmada por tel&eacute;fono o correo electr&oacute;nico.</STRONG></p>
                                                    </div>
                                                   
                                                        <div class="botones"> 
                                            
                                                               	<p> <input type="hidden" name="enviarclick" value="1" />
                                                                    <input type="hidden" name="lugar" value="<?php echo $_GET['lugar'];?>" />
                                                                <INPUT name=Enviar type=submit class="TextoNormPeq" id=enviar value=Enviar> 
                                                                <INPUT name=Borrar type=reset class="TextoNormPeq" id=Borrar value=Borrar></p>
                                                            
                                                        </div>     
                                                	
                                                
                                            </form> 
                                            <div style="clear:both"></div>    
                                        </div> <!--hasta aqui adentro id formulario--> 
                                        <div style="clear:both"></div> 
                        		</div>
               		    </div>
        		
           
       