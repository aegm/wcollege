<?php
if (isset($_SESSION['wc']['session']) && $_SESSION['wc']['session'])/* SI HAY SESION */ {
    if (!(isset($bd))) {
        require_once('clases/db.class.php');
        $bd = new db;
    }
} else {
    if (( ( isset($_GET['lecc']) && ($_GET['lecc']) && ($_GET['lecc']) > 1) || ( isset($_GET['libro']) && ($_GET['libro']) && ($_GET['libro']) > 1 ))) {
        ?><div class="error">Error: No es posible acceder a la Leccion <?php echo $_GET['lecc'] ?>. Primero debe iniciar sesión.</div><?php
    }
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//
?>
<div class="container">
    <ul class="mega-dropdown row">
        <li class="col-sm-6">
            <ul>
                <li>
                    Reproducir
                </li>
                <div id="news-carousel"  class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="item">
                            <video>
                                <source src="videos/1_1_x264.mp4" type="video/mp4" />
                            </video>
                            <nav>
                                <div id="botones">
                                    <button id="reproducir">Reproducir</button>
                                </div>
                                <div id="barra">
                                    <div id="progreso"></div>
                                </div>
                            </nav>
                        </div>
                    </div>
                </div>
            </ul>
        </li>
        <li class="col-sm-3">
            <ul>
                <li class="dropdown-header">Lession 1</li>
                <li><a href="#">Unique Features</a></li>
                <li><a href="#">Image Responsive</a></li>
                <li><a href="#">Auto Carousel</a></li>
                <li><a href="#">Newsletter Form</a></li>
                <li><a href="#">Four columns</a></li>
                <li class="divider"></li>
                <li class="dropdown-header">Tops</li>
                <li><a href="#">Good Typography</a></li>
            </ul>
        </li>
    </ul>

    <div class="row">
        <div class="col-md-3">
            <img src="images/imgVideos.jpg" width="152" height="234" />
        </div>
        <div class="col-md-6">
            <?php
            $sqllib = $bd->consulta("SELECT libro FROM videos GROUP BY libro ORDER BY libro AND leccion ASC ");
            while ($libro = $bd->sig_reg($sqllib)) {
                ?><span class="title_libro"><?php
                echo ('Nivel' . $libro['libro']);
                $sqlvid = $bd->consulta("SELECT * FROM videos WHERE libro=$libro[libro] ORDER BY leccion ASC ");
                ?></span>
                <div id="div_tabla">
                    <table cellspacing="20" id="tablaexterna"> 
                        <?php
                        $videos = true;
                        while ($videos) {
                            ?>   
                            <tr align="left"><!--fila-->
                                <?php
                                $i = 1;
                                while ($i <= 4 && ($videos = $bd->sig_reg($sqlvid))) {
                                    ?>
                                    <td class="celda_interna_txt"><div class="producto_nom"><img src="images/img_Play.jpg" width="17" height="16" align="absmiddle" />&nbsp;<a href="inicio.php<?php echo "?lugar=videos&libro=$libro[libro]&lecc=$videos[leccion]&dir=videos/$libro[libro]_$videos[leccion].flv"; ?>"><?php echo $videos['nombre']; ?></a></div></td>
                                    <?php
                                    $i++;
                                }
                                ?> 
                            </tr>
                        <?php } ?>
                    </table>
                    <br /> 	
                </div><!--fin div tabla-->
            <?php }
            ?>
        </div> 
    </div>

</div>        

<div class="container">
    <div id="imagen_izq"><img src="images/imgVideos.jpg" width="152" height="234" /></div>
    <div style="float:left; padding-left:40px;"><p>&nbsp;</p>
        <?php
        $sqllib = $bd->consulta("SELECT libro FROM videos GROUP BY libro ORDER BY libro AND leccion ASC ");
        while ($libro = $bd->sig_reg($sqllib)) {
            ?><span class="title_libro"><?php
            echo ('Nivel' . $libro['libro']);
            $sqlvid = $bd->consulta("SELECT * FROM videos WHERE libro=$libro[libro] ORDER BY leccion ASC ");
            ?></span>
            <div id="div_tabla">
                <table cellspacing="20" id="tablaexterna"> 
                    <?php
                    $videos = true;
                    while ($videos) {
                        ?>   
                        <tr align="left"><!--fila-->
                            <?php
                            $i = 1;
                            while ($i <= 4 && ($videos = $bd->sig_reg($sqlvid))) {
                                ?>
                                <td class="celda_interna_txt"><div class="producto_nom"><img src="images/img_Play.jpg" width="17" height="16" align="absmiddle" />&nbsp;<a href="inicio.php<?php echo "?lugar=videos&libro=$libro[libro]&lecc=$videos[leccion]&dir=videos/$libro[libro]_$videos[leccion].flv"; ?>"><?php echo $videos['nombre']; ?></a></div></td>
                                        <?php
                                        $i++;
                                    }
                                    ?> 
                        </tr>
                    <?php } ?>
                </table>
                <br /> 	
            </div><!--fin div tabla-->
        <?php }
        ?>
    </div></div>