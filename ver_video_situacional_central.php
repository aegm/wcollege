<script src="Scripts/swfobject_modified.js" type="text/javascript"></script>
<?php
$con = new db;
include('perfil_central.php');


$videos = $con->consulta("SELECT * FROM videos_situacionales WHERE id_video_sit='$_GET[video]'");
$video = $con->sig_reg($videos);
echo "<div class='col-md-8'>";
echo "<div>$video[nombre]<br>";
?>
<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="342" height="291" id="FLVPlayer">
    <param name="movie" value="FLVPlayer_Progressive.swf" />
    <param name="quality" value="high" />
    <param name="wmode" value="opaque" />
    <param name="scale" value="noscale" />
    <param name="salign" value="lt" />
    <param name="FlashVars" value="&amp;MM_ComponentVersion=1&amp;skinName=Halo_Skin_3&amp;streamName=videos/<?php echo $_GET['url']; ?>&amp;autoPlay=true&amp;autoRewind=false" />
    <param name="swfversion" value="8,0,0,0" />
    <!-- Esta etiqueta param indica a los usuarios de Flash Player 6.0 r65 o posterior que descarguen la versión más reciente de Flash Player. Elimínela si no desea que los usuarios vean el mensaje. -->
    <param name="expressinstall" value="Scripts/expressInstall.swf" />
    <!-- La siguiente etiqueta object es para navegadores distintos de IE. Ocúltela a IE mediante IECC. -->
    <!--[if !IE]>-->
    <object type="application/x-shockwave-flash" data="FLVPlayer_Progressive.swf" width="342" height="291">
        <!--<![endif]-->
        <param name="quality" value="high" />
        <param name="wmode" value="opaque" />
        <param name="scale" value="noscale" />
        <param name="salign" value="lt" />
        <param name="FlashVars" value="&amp;MM_ComponentVersion=1&amp;skinName=Halo_Skin_3&amp;streamName=videos/<?php echo $_GET['url']; ?>&amp;autoPlay=true&amp;autoRewind=false" />
        <param name="swfversion" value="8,0,0,0" />
        <param name="expressinstall" value="Scripts/expressInstall.swf" />
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
    swfobject.registerObject("FLVPlayer");
</script>


<?php
echo"</div>";
$contrato = $_SESSION['wc']['usuario'];
$videos_aprobados = $con->consulta("SELECT * FROM videos_situacionales_evaluados WHERE contrato=$contrato AND id_video=$_GET[video]");
if (!$con->num_filas($videos_aprobados))
    echo "<a href='inicio.php?lugar=evaluar_video_situacional&video=$_GET[video]'>Evaluar</a>";
echo "</div>";
?>








