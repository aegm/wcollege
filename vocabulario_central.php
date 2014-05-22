
<?php

function uniqueRand($n, $min = 0, $max = null) {
    if ($max === null)
        $max = getrandmax();
    $array = range($min, $max);
    $return = array();
    $keys = array_rand($array, $n);
    foreach ($keys as $key)
        $return[] = $array[$key];
    return $return;
}
?>

<div style="clear:both"></div>
<div class="container">
    <div id="imagen_izq" class="col-md-3"><img src="images/imgVocabulario.jpg" width="184" height="259" /></div>
    <?php
    if (isset($_SESSION['wc']['session']) && $_SESSION['wc']['session'])/* SI HAY SESION */ {
        if (!(isset($bd))) {
            require_once('clases/db.class.php');
            $bd = new db;
        }


        $i = 0;
        $eval = " ";
        $num = uniqueRand(10, 1, 231);
        ?>

    <div class="col-lg-6" style="text-align: left;">

            <?php ?>
            <form action="inicio.php" method="post"><?php
                while ($i < 10) {



                    if (!(isset($_POST['click']) && $_POST['click'])) {
                        $sql = $bd->consulta("SELECT * FROM respglosario WHERE  PALABRA = $num[$i]");
                        $linea = $bd->sig_reg($sql);
                        $palabra = $linea['PALABRA2'];
                        ?>
                        <input type="hidden" name="<?php echo ('palabra' . $i); ?>" value="<?php echo $palabra; ?>" />
                        <?php
                        $combo = '<select class="form-control" name="respuesta' . $i . '">';
                        $combo.='<option value=0></option>';
                        while ($linea) {
                            $combo.='<option>' . $linea['RESPUESTA'] . ' </option>';
                            $linea = $bd->sig_reg($sql);
                        }
                        $combo.='</select>';
                        $i+=1;
                    } else {

                        $palabra = $_POST['palabra' . $i];

                        $combo = $_POST['respuesta' . $i];
                        $i+=1;
                        $sql1 = $bd->consulta("SELECT BUENA FROM respglosario WHERE PALABRA2 = '$palabra' AND RESPUESTA='$combo' ");
                        $linea = $bd->sig_reg($sql1);

                        if ($linea['BUENA'] == 1)
                            $eval = "Buena";
                        else
                            $eval = "Mala";
                    }
                    ?>
                    <div class="form-group"><?php echo $palabra . (" "); ?>	<span <?php if ($linea['BUENA'] == 1) { ?> style="color:blue; font-weight:bold"<?php } else { ?>style="color:#900;font-weight:bold"<?php } ?>><?php echo $combo; ?></span>

                    </div>
                    <?php
                }//fin while $i<10
                ////////////////////////////////////////////////////////Anterior y Siguiente//////////////////////////////////////////////////////////////////////
                ?>
                <input type="hidden" name="lugar" value="vocabulario" />
                <?php if (!(isset($_POST['click']) && $_POST['click'])) {
                    ?>
                    <input type="hidden" name="click" value="1" />
                    <br>
                    <input type="submit" name="evaluar" value="Evaluar" />
                    <br><br>
                <?php } else { ?>
                    <input type="hidden" name="click" value="0" />
                    <input type="submit" name="evaluar" value="Siguiente" />	

                <?php } ?>
            </form>

        </div>
    </div>
    <?php
} else {
    ?><div class="error">Error: No es posible acceder a Vocabulario. Primero debe iniciar sesi&oacute;n.</div><?php
}
		////////////////////////////////////////////////////////////////////////////////////////////////////////
				  		


