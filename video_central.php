<div class="">
    <?php
    if ((isset($_SESSION['wc']['session']) && $_SESSION['wc']['session'] ) || (isset($_GET['lecc']) && ($_GET['lecc']) && ($_GET['lecc'] == 1)))/* SI HAY SESION */ {
        ?>
        <div class="col-md-3"> 
            <div id="imagen_izq"><img src="images/imgVideos.jpg" width="152" height="234" /></div>
        </div>    
        <div class="col-md-8" id="middle" align="center">
            <br/>
            <br/>
            <?php
            if (!(isset($bd))) {
                require_once('clases/db.class.php');
                $bd = new db;
            }
            $sqltitulo = $bd->consulta("SELECT * FROM leccion WHERE NIVEL=$_GET[libro] AND leccion2=$_GET[lecc]");
            $titulo = $bd->sig_reg($sqltitulo);
            echo ('Nivel' . $_GET['libro']);
            ?>
            <br/><br/>
            <?php
            echo ('Leccion ' . $_GET['lecc'] . ' - ' . $titulo['TITULO']);
            ?>
            <br/>
            <br/>



            <script src="Scripts/swfobject_modified.js" type="text/javascript"></script>
            <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="320" height="240" id="FLVPlayer">
                <param name="movie" value="FLVPlayer_Progressive.swf" />
                <param name="quality" value="high">
                <param name="wmode" value="opaque">
                <param name="scale" value="noscale">
                <param name="salign" value="lt">
                <param name="FlashVars" value="&amp;MM_ComponentVersion=1&amp;skinName=Clear_Skin_2&amp;streamName=videos/<?php echo ($_GET['libro'] . '_' . $_GET['lecc']) ?>&amp;autoPlay=true&amp;autoRewind=false" />
                <param name="swfversion" value="8,0,0,0">
                <!-- Esta etiqueta param indica a los usuarios de Flash Player 6.0 r65 o posterior que descarguen la versión más reciente de Flash Player. Elimínela si no desea que los usuarios vean el mensaje. -->
                <param name="expressinstall" value="Scripts/expressInstall.swf">
                <!-- La siguiente etiqueta object es para navegadores distintos de IE. Ocúltela a IE mediante IECC. -->
                <!--[if !IE]>-->
                <object type="application/x-shockwave-flash" data="FLVPlayer_Progressive.swf" width="320" height="240">
                    <!--<![endif]-->
                    <param name="quality" value="high">
                    <param name="wmode" value="opaque">
                    <param name="scale" value="noscale">
                    <param name="salign" value="lt">
                    <param name="FlashVars" value="&amp;MM_ComponentVersion=1&amp;skinName=Clear_Skin_2&amp;streamName=videos/<?php echo ($_GET['libro'] . '_' . $_GET['lecc']) ?>&amp;autoPlay=true&amp;autoRewind=false" />
                    <param name="swfversion" value="8,0,0,0">
                    <param name="expressinstall" value="Scripts/expressInstall.swf">
                    <!-- El navegador muestra el siguiente contenido alternativo para usuarios con Flash Player 6.0 o versiones anteriores. -->
                    <div>
                        <h4>El contenido de esta página requiere una versión más reciente de Adobe Flash Player.</h4>
                        <p><a href="http://www.adobe.com/go/getflashplayer"><img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Obtener Adobe Flash Player" /></a></p>
                    </div>
                    <!--[if !IE]>-->
                </object>
                <!--<![endif]-->
            </object>
            <script type="text/javascript">
                <!--
            swfobject.registerObject("FLVPlayer");
                //-->
            </script>
        </div>
        <?php
    } else {
        ?>
        <div class="error">Error: No es posible acceder a la Leccion <?php echo $_GET['lecc'] ?>. Primero debe iniciar sesión.</div>
    <?php } ?>
</div>