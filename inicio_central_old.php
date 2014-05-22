<script src="Scripts/swfobject_modified.js" type="text/javascript"></script>
<div style="float: left; width: 40%; border:1px solid #0000cd; border-radius: 15px 15px;margin:2%;">
     <?php
     
        require_once('clases/db.class.php');
	$db=new db;	
        $sql = $db->consulta("select * from vinscripcion where id_persona = ".$_SESSION['wc']['contrato']." order by fecha_inscripcion desc limit 1");
        $usr=$bd->sig_reg($sql); 
        
        if($usr){  
            switch ($usr['id_curso']){
                case '5':
                    echo "<a style='text-align: center; padding-left: 4%;' href='connect.php?nivel=1'>Ingresa aqui al Aula virtual 1...</a>";
                    break;
                case '6':
                    echo "<a style='text-align: center; padding-left: 4%;' href='connect.php?nivel=2'>Ingresa aqui al Aula virtual 2...</a>";
                    break;
                case '7';
                    echo "<a style='text-align: center; padding-left: 4%;' href='connect.php?nivel=3'>Ingresa aqui al Aula virtual 3...</a>";
                    break;
                   }
        }
        ?>
    <br>
    <!--a style="text-align: center; padding-left: 4%;" href="connect.php?nivel=">Ingresa aqui al Aula virtual...</a-->
    <br><br>
    <img src="images/imgVideo.png" style="float: left;" />
    <p>Ya se encuentra disponible el aula virtual Para mayor Información sobre Horarios <a href="inicio.php?lugar=servicios">ingresa Aqui</a>
    y enterate de los mejores cursos     Online !!
    </p>
</div>
<div class="central1"><!--<img src="images/DisenoWash.jpg" />-->
  <object id="FlashID" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="710" height="210">
    <param name="movie" value="images/FlaWEC.swf" />
    <param name="quality" value="high" />
    <param name="wmode" value="opaque" />
    <param name="swfversion" value="6.0.65.0" />
    <!-- This param tag prompts users with Flash Player 6.0 r65 and higher to download the latest version of Flash Player. Delete it if you don�t want users to see the prompt. -->
    <param name="expressinstall" value="Scripts/expressInstall.swf" />
    <!-- Next object tag is for non-IE browsers. So hide it from IE using IECC. -->
    <!--[if !IE]>-->
    <object type="application/x-shockwave-flash" data="images/FlaWEC.swf" width="710" height="210">
      <!--<![endif]-->
      <param name="quality" value="high" />
      <param name="wmode" value="opaque" />
      <param name="swfversion" value="6.0.65.0" />
      <param name="expressinstall" value="Scripts/expressInstall.swf" />
      <!-- The browser displays the following alternative content for users with Flash Player 6.0 and older. -->
      <div>
        <h4>Content on this page requires a newer version of Adobe Flash Player.</h4>
        <p><a href="http://www.adobe.com/go/getflashplayer"><img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player" width="112" height="33" /></a></p>
      </div>
      <!--[if !IE]>-->
    </object>
    <!--<![endif]-->
  </object>
<div id="contVideo">
	<?php if(isset($_SESSION['wc']['session']) && $_SESSION['wc']['session']){ ?>
    
        <div style="float:left; padding-left:30px"><!-- BEGIN Comm100 Live Chat Button Code --><div>
            <div id="comm100_LiveChatDiv">
              <p>
                <a href="http://www.comm100.com/livechat/" onclick=" comm100_Chat();return false; " target="_blank" title = "Live Chat Live Help Software for Website">
                    <img id="comm100_ButtonImage" src="http://chatserver.comm100.com/BBS.aspx?siteId=29538&planId=622" border="0px" alt="Live Chat Live Help Software for Website" />
                </a>
                <script src="http://chatserver.comm100.com/js/LiveChat.js?siteId=29538&planId=622"type="text/javascript"></script>
              </p>
            </div>
            
           <div id="comm100_track" style="z-index:99;">
                
                	<center>
                	  <p style="font-size:12px; font-family:Arial, Helvetica, sans-serif;color:#555"><b>Horario de atenci&oacute;n: <br />
               	      de lunes a viernes de 9 am. a 12 pm. 1 pm. a 6 pm.<br />
               	      S&aacute;bados de 9 am. a 12 pm.</b>
               	      <br>
               	      <b>1:00 pm a 3:00 pm</b></p>
                	</center>
                	<span style="font-size:12px; font-family:Arial, Helvetica, sans-serif;color:#555"> 
                    <!--<a href="http://www.comm100.com/livechat/" style="text-decoration:none;color:#555" target="_blank"><b>&nbsp;&nbsp;Live Chat</b></a> by 
                    <a href="http://www.comm100.com/" style="text-decoration:none;color:#009999;" target="_blank">Comm100</a>-->
                </span>
            </div>
        </div><!-- End Comm100 Live Chat Button Code -->
        </div>
        <div style="float:left; margin-left:10px; width:140px; font-weight:normal" class="nivel">
          <p><strong>Chatee con nuestros profesores.<br />
            </strong>Presente examenes <br />
                o aclare dudas con nuestro servicio<br />
            de CHAT en vivo. </p>
        </div>
        <div style="float:left; width:269px; padding-left:40px;"><img src="images/imgLibros.jpg" />
        </div>
    <?php 
 	}
 	else
	{
	?>     
        <div style="float:left; padding-left:30px">
            <!--<img src="images/imgVideo.jpg" width="189" height="143" />-->
            <object id="player" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" name="player" width="180" height="134">
		<param name="movie" value="player.swf" />
		<param name="allowfullscreen" value="true" />
		<param name="allowscriptaccess" value="always" />
		<param name="flashvars" value="file=bienvenida.flv&image=preview.jpg&controlbar=none" />
		<embed
			type="application/x-shockwave-flash"
			id="player2"
			name="player2"
			src="player.swf" 
			width="180" 
			height="134"
			allowscriptaccess="always" 
			allowfullscreen="true"
			flashvars="file=bienvenida.flv&image=preview.jpg&controlbar=none"            
		/>
	</object>
        </div>
        <div style="float:left; margin-left:10px; width:140px; font-weight:normal" class="nivel">
            <strong>Videos On-Line</strong> para facilitarte el acceso a nuestras clases en el lugar y el momento que quieras desde la comodidad de tu computadora.
        </div>
        <div style="float:left; width:269px; padding-left:40px;">
            <img src="images/imgLibros.jpg" />
        </div>
	<?php 
	}
	?>     
</div>
<div align="center" style="padding-top:5px;"><img src="images/Text_Facil_Rapido.jpg" width="546" height="63" /></div>

</div>

<script type="text/javascript">
<!--
swfobject.registerObject("FlashID");
//-->
</script>
