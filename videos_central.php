<?php
if (isset($_SESSION['wc']['session']) && $_SESSION['wc']['session'])/* SI HAY SESION */ {
    
} else {
    if (( ( isset($_GET['lecc']) && ($_GET['lecc']) && ($_GET['lecc']) > 1) || ( isset($_GET['libro']) && ($_GET['libro']) && ($_GET['libro']) > 1 ))) {
        ?><div class="error">Error: No es posible acceder a la Leccion <?php echo $_GET['lecc'] ?>. Primero debe iniciar sesión.</div><?php
    }
}
if (!(isset($bd))) {
    require_once('clases/db.class.php');
    $bd = new db;
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//
?> <div class="central1">
    <div class="col-lg-3">
        <div id="imagen_izq"><img src="images/imgVideos.jpg" width="152" height="234" /></div>
    </div>
    <div style="float:left; padding-left:40px;" class="col-md-8"><p>&nbsp;</p>
        <?php
        /* @var $sqllib type */
        $sqllib = $bd->consulta("SELECT libro FROM videos GROUP BY libro ORDER BY libro AND leccion ASC ")or die($sqllib);
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
                                <td class="celda_interna_txt"><div class="producto_nom"><img src="images/img_Play.jpg" width="17" height="16" align="absmiddle" />&nbsp;<a href="inicio.php<?php echo "?lugar=video&libro=$libro[libro]&lecc=$videos[leccion]&dir=videos/$libro[libro]_$videos[leccion].flv"; ?>"><?php echo $videos['nombre']; ?></a></div></td>
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