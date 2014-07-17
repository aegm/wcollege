<?php
$paso = 0;
if ((isset($_SESSION['wc']['session']) && $_SESSION['wc']['session'] ) || (isset($_GET['lecc']) && ($_GET['lecc']) && ($_GET['lecc'] == 1)))/* SI HAY SESION */ {
    ?>

    <?php
    if (!(isset($bd))) {
        require_once('clases/db.class.php');
        $bd = new db;
    }
    $y = 0;
    $txtcont = 0;
    $combocont = 0;
    $combocont2 = 0;
    $nota_acum_lineas = 0;
    $nota_pag = 0;
    $num_lineas = 0;
    if (isset($_SESSION['wc']['session']))
        $contrato = $_SESSION['wc']['usuario'];
    if ((isset($_POST['click']) && $_POST['click'])) {
        $_GET['lecc'] = $_POST['lecc'];
        $_GET['lugar'] = $_POST['lugar'];
        $_GET['pag'] = $_POST['pag'];
    }
    //if((isset($_GET['lecc']) && ($_GET['lecc'])))/*SI LECCION ESTA DEFINIDA Y TIENE ALGUN VALOR */
    // {



    if ((isset($_GET['lecc']) && ($_GET['lecc'])))/* SI LECCION ESTA DEFINIDA Y TIENE ALGUN VALOR */ {
        if (isset($_SESSION['wc']['leccion']) && $_SESSION['wc']['leccion'] == 0) {
            $_SESSION['wc']['leccion'] = $_GET['lecc'];
            $nota_acum_lineas = 0;
        } else {
            if (isset($_SESSION['wc']['leccion']) && $_SESSION['wc']['leccion'] <> $_GET['lecc']) {
                $_SESSION['wc']['leccion'] = $_GET['lecc'];
                $_SESSION['wc']['nota_pagina'] = 0;
                $nota_acum_lineas = 0;
            }
        }
        ?>
        <div id="txt_leccion" class="container" >
            <div class="col-md-9">
                <?php
                $sql = $bd->consulta("SELECT PUNTO FROM contenidos WHERE CODLECCION = $_GET[lecc] GROUP BY PUNTO ORDER BY ID");
                $num_puntos = $bd->num_filas($sql);
                ///////////////////////////////////////////////////construccion del titulo de la leccion y definicion del index o variable $pag///////////////////////
                $sql_lecc = $bd->consulta("SELECT * FROM leccion WHERE LECCION = $_GET[lecc]");
                $linea_leccion = $bd->sig_reg($sql_lecc);
                $nivel = $linea_leccion['NIVEL'];
                $lecc2 = $linea_leccion['leccion2'];
                $audio = $linea_leccion['audio_leccion'];
                echo "<strong><p align='center'>NIVEL $nivel,  Lesson $lecc2 <img id='$audio' class='audio_lesson' src='images/audio.png'></p></strong>"; //n� de leccion
                $sql = $bd->consulta("SELECT TITULO FROM leccion WHERE LECCION = $_GET[lecc] ");
                $titulo = $bd->sig_reg($sql);
                echo "<p align='center'><strong> $titulo[TITULO]</strong></p>"; //titulo de la leccion

                if (isset($_GET['pag']) && $_GET['pag'])
                    $pag = $_GET['pag'];
                else
                    $pag = 1;
                ///////////////////////////////////////////////////construccion de la leccion///////////////////////////////////////////////////////////////////
                $f = -1;
                $sql = $bd->consulta("SELECT * FROM contenidos WHERE CODLECCION = $_GET[lecc] AND PUNTO=$pag ORDER BY ID");
                $contenido = $bd->sig_reg($sql);
                $sqleval = $bd->consulta("SELECT * FROM contenidos WHERE CODLECCION = $_GET[lecc] AND PUNTO=$pag ORDER BY ID"); //sqleval y eval son para usarlas mas abajo sin da�ar a sql ni a contenido
                $eval = $bd->sig_reg($sqleval);
                ?>

                <form action="inicio.php" method="post">

                    <?php
                    while ($contenido) {
                        if (($contenido['TIPO'] == 'P') || (($contenido['TIPO'] == 'E') && (!$contenido['COLUMNA'])) || (($contenido['TIPO'] == 'T') && (!$contenido['COLUMNA']))) {
                            if (($contenido['FILA'] <> $f))
                                $f = $contenido['FILA'];
                            ?><div style=" float:left; width:680px; <?php if ($contenido['TIPO'] == 'T') { ?>text-align:center; font-weight:bold;<?php } ?>"><span <?php
                            if ($contenido['TIPO'] == 'P') {
                                echo $contenido['ESTILO'];
                            }
                            ?>  ><?php echo $contenido['TEXTO']; ?> </span></div><?php ?>
                            <br/>
                            <?php
                            $contenido = $bd->sig_reg($sql);
                        } else {
                            ?>
                            <table width="100%" border="0" cellpadding="5px" class="table" style="text-align: center;">

                                <?php
                                $i = 0;

                                while (($contenido) && ($contenido['TIPO'] <> 'P' && $contenido['TIPO'] <> 'T')) {
                                    if (($contenido['FILA'] <> $f))
                                        $f = $contenido['FILA'];
                                    ?>
                                    <tr>

                                        <?php
                                        while (($contenido) && ($contenido['FILA'] == $f) && ($contenido['TIPO'] <> 'P')) {
                                            $i = $i + 1;
                                            $sql3 = $bd->consulta("SELECT * FROM tipo_respuestas WHERE  LECCION = $_GET[lecc] AND PUNTO=$pag ");
                                            $linea_tipo_resp = $bd->sig_reg($sql3);

                                            $sust = array("#30", "#40", "#50", "#20", "#3", "#4", "#5", "#6", "#8", "#10", "#9");

                                            $Cadena = $contenido['TEXTO'];

                                            while ($eval && $paso == 0) {

                                                if (($eval['TIPO'] == 'E')) {
                                                    $ejercicio = 1;
                                                    $paso = 1;
                                                } else {
                                                    $ejercicio = 0;
                                                }
                                                $eval = $bd->sig_reg($sqleval);
                                            }






                                            /* 	if($linea_tipo_resp['TIPO']=='L')
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

                                            /* } *///fin if tipo=L
                                            ?>
                                            <td <?php if ($contenido['COLSPAN'] > 0) { ?>colspan="<?php echo $contenido['COLSPAN']; ?>"<?php
                                            } if ($contenido['ESTILO']) {
                                                echo $contenido['ESTILO'];
                                            } if ($contenido['TIPO'] == 'C') {
                                                ?> bgcolor="#000066" <?php } ?> ><span <?php if ($contenido['TIPO'] == 'C') { ?> style="color:#FFF; font-weight:bold;"<?php } ?>><?php echo $Cadena; ?></span></td>
                                                                                         <?php
                                                                                         $contenido = $bd->sig_reg($sql);
                                                                                     }//fin while
                                                                                     ?>


                                    </tr>
                                    <?php
                                }//fin while
                                //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                                ?>






                            </table>

                            <input type="hidden" name="lugar" value="leccion" />
                            <input type="hidden" name="contresp" value="<?php echo $contresp; ?>" />

                            <?php if (!(isset($_POST['click']) && $_POST['click']) && ($ejercicio == 1)) {
                                ?>
                                <input type="hidden" name="click" value="1" />
                                <input type="hidden" name="lecc" value="<?php echo $_GET['lecc']; ?>" />
                                <input type="hidden" name="pag" value="<?php echo $_GET['pag']; ?>" />
                                <p><input type="submit" name="evaluar" value="Evaluar" />	</p>
                            <?php } ?>					
                            <?php
                        }//fin if
                    }//fin while
                    if ((isset($hay_eval) && $hay_eval == 1) || (isset($nota_acum_lineas)) && $nota_acum_lineas >= 1) {
                        if (($nota_acum_lineas) >= ($num_lineas))
                            $nota_pag = 1;
                        else
                            $nota_pag = 0;
                    }
                    if (isset($_SESSION['wc']['leccion']) && $_SESSION['wc']['leccion'] == $_GET['lecc'] && $nota_pag) {
                        $_SESSION['wc']['nota_pagina'] = $_SESSION['wc']['nota_pagina'] + $nota_pag;
                    }
                    ?>
                </form>

                <?php
                ////////////////////////////////////////////////////////Anterior y Siguiente//////////////////////////////////////////////////////////////////////
                if ((isset($_POST['click']) && $_POST['click']) || (!isset($ejercicio) || $ejercicio == 0)) {
                    ?>

                    <div id="ant_sig"><div style="float:left; width:400px;">
                            <?php
                            if (($pag > 1) && (!isset($ejercicio) || $ejercicio == 0)) {
                                $paganterior = $pag - 1;
                                ?> 
                                <!--acontinuacion paso las variables por get, a travez de las anclas ?para declarar, &para separar variables-->
                                      <!-- <a class="txt_num_pag" href='inicio.php<?php echo "?lugar=$_GET[lugar]&lecc=$_GET[lecc]&pag=1"; ?>'> &lt;&lt; </a> &nbsp;&nbsp;-->
                                <a class="txt_num_pag" href='inicio.php<?php echo "?lugar=$_GET[lugar]&lecc=$_GET[lecc]&pag=$paganterior"; ?>'> < Anterior </a>&nbsp; 	
                                <?php
                            }
                            /* for($i=1;$i<=$num_puntos;$i++)//aqui se escriben todos los num de pag hasta n
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
                            $pag_rep = $pag + 1;
                            $sql_rep = $bd->consulta("SELECT * FROM contenidos WHERE CODLECCION = $_GET[lecc] AND PUNTO=$pag_rep");
                            $contenido_rep = $bd->sig_reg($sql_rep);
                            $ejercicio_rep = 0;
                            while ($contenido_rep = $bd->sig_reg($sql_rep)) {
                                if ($contenido_rep['TIPO'] == 'E') {
                                    $ejercicio_rep = 1;
                                }
                            }
                            if (($pag < $num_puntos && $ejercicio_rep == 0) || (isset($_POST['click']) && $_POST['click'] && $pag < $num_puntos)) {
                                $pagsiguiente = $pag + 1;
                                ?> 
                                &nbsp;<a class="txt_num_pag" href='inicio.php<?php echo "?lugar=$_GET[lugar]&lecc=$_GET[lecc]&pag=$pagsiguiente"; ?>'> Siguiente > </a>
                             <!--   &nbsp;&nbsp;<a class="txt_num_pag" href='inicio.php<?php echo "?lugar=$_GET[lugar]&lecc=$_GET[lecc]&pag=$num_puntos"; ?>'> >> </a> 		-->									  				  <?php } else { ?>

                                                                                                                                                                <!--  <a class="txt_num_pag" href='inicio.php<?php echo "?lugar=lecciones"; ?>'> Ir al Temario </a>--> 

                                <?php
                            }
                            if (isset($_POST['click']) && $_POST['click'] && $pag >= $num_puntos) {
                                $sql_nota = $bd->consulta("SELECT * FROM respuestas WHERE LECCION = $_GET[lecc]");
                                $ejercicio_bd = $bd->sig_reg($sql_nota);



                                $cont_ejercicios_leccion = 1;
                                $ejercicio_comparar = $ejercicio_bd['PUNTO'];
                                while ($ejercicio_bd) {
                                    if ($ejercicio_bd['PUNTO'] <> $ejercicio_comparar) {
                                        $cont_ejercicios_leccion+=1;
                                        $ejercicio_comparar = $ejercicio_bd['PUNTO'];
                                    }
                                    $ejercicio_bd = $bd->sig_reg($sql_nota);
                                }




                                if ($_SESSION['wc']['nota_pagina'] >= ($cont_ejercicios_leccion)) {
                                    $sql_permitir_evaluar = $bd->consulta("SELECT leccion_aprobada FROM usuarios WHERE contrato = $contrato");
                                    $leccion_aprobada = $bd->sig_reg($sql_permitir_evaluar);
                                    if ($leccion_aprobada['leccion_aprobada'] + 1 == $_GET['lecc']) {
                                        $nota = 1;
                                        $bd->consulta("UPDATE usuarios SET 
																   leccion_aprobada = '$_GET[lecc]'
																   WHERE contrato = '$contrato'");
                                    } else
                                        $nota = 0;
                                } else
                                    $nota = 0;
                                ?><a href="inicio.php?lugar=lecciones&lecc=#" class="txt_num_pag"> Finalizar  </a><?php
                            }
                            ?><p></div><?php
                        if ((!isset($ejercicio) || $ejercicio == 0) && (isset($_SESSION['wc']['session']))) {

                            $sql_tipo = $bd->consulta("SELECT * FROM contenidos WHERE CODLECCION = $_GET[lecc] AND TIPO='E' ORDER BY ID LIMIT 1 ");
                            $pag_punto = $bd->sig_reg($sql_tipo);
                            $pagevaluacion = $pag_punto['PUNTO'];
                            $sql_permitir_evaluar = $bd->consulta("SELECT leccion_aprobada FROM usuarios WHERE contrato = '$contrato'");
                            $leccion_aprobada = $bd->sig_reg($sql_permitir_evaluar);
                            if ($leccion_aprobada['leccion_aprobada'] + 1 >= $_GET['lecc']) {
                                ?>
                                &nbsp;<div style="float:right; width:auto; padding-right:30px;"><a class="txt_num_pag" style="color:#C00; text-decoration:underline;" href='inicio.php<?php echo "?lugar=$_GET[lugar]&lecc=$_GET[lecc]&pag=$pagevaluacion"; ?>' > Evaluar Lecci&oacute;n </a> <p></div>
                                <?php
                            }
                        }
                        ?>

                    </div><!--ant_sig-->


                <?php } ?>
            </div><!--txt_leccion-->
            <div id="audio">
                <div id="player_audio"></div>
            </div>
            <section class="col-md-3">
                <div class="section-heading"></div>
                <div class="section-content">
                    <img src="images/Title_traductor.jpg" style="padding:0px;"/-->
                         <?php include('traductor.html'); ?>
                </div>
            </section>
        </div>
        <?php
        //}fin if
    } else {
        if (isset($_GET['lecc']) && ($_GET['lecc']) && ($_GET['lecc'] > 1))/* SI NO HAY SESION Y LA LECCION SELECCIONADA ES MAYOR A 1 */ {
            ?><script type="text/javascript">
                alert("Error: No es posible acceder a la Leccion <?php echo $_GET['lecc'] ?>. Primero debe iniciar sesi�n.");
            </script><?php
        }
    }
} else {
    ?>
    <script type="text/javascript">
        alert("Error: No es posible acceder a la Leccion <?php echo $_GET['lecc'] ?>. Primero debe iniciar sesi\xf3n.");
    </script>
<?php } ?>
