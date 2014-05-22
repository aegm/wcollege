<script src="Scripts/swfobject_modified.js" type="text/javascript"></script>
<div class="central1"><!--<img src="images/DisenoWash.jpg" />-->
  <object id="FlashID" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="710" height="210">
    <param name="movie" value="images/FlaWEC.swf" />
    <param name="quality" value="high" />
    <param name="wmode" value="opaque" />
    <param name="swfversion" value="6.0.65.0" />
    <!-- This param tag prompts users with Flash Player 6.0 r65 and higher to download the latest version of Flash Player. Delete it if you don’t want users to see the prompt. -->
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
               	      de lunes a viernes de 9 am. a 7 pm.<br />
               	      S&aacute;bados de 9 am. a 3 pm.</b></p>
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
            <img src="images/imgVideo.jpg" width="189" height="143" />
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
