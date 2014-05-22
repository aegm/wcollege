<div class="container">
    <?php
//session_start();		
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////	
    if (isset($_SESSION['wc']['session']) && $_SESSION['wc']['session'])/* SI HAY SESION */ {
        $_SESSION['wc']['leccion'] = 0;
        /* aqui defino la clase y el objeto bd, ya que si no hay session, mas abajo la defino en login_de_usuario. */
        /* lo hago adentro de la condicion para que no se defina dos veces */
        if (!(isset($bd))) {
            require_once('clases/db.class.php');
            $bd = new db;
        }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        ?>

        <?php
        $contrato = $_SESSION['wc']['usuario'];
        $sql_permitir_evaluar = $bd->consulta("SELECT leccion_aprobada FROM usuarios WHERE contrato = '$contrato'");
        $leccion_aprobada = $bd->sig_reg($sql_permitir_evaluar);

        $sql = $bd->consulta("SELECT * FROM leccion");
        $leccion = $bd->sig_reg($sql);
        $leccion = $bd->sig_reg($sql);
        ?>
        <div class="row">
            <div class="col-md-4">
                <div id="imagen_izq"><img src="images/imgEvaluar.jpg" width="152" height="260" /></div>
            </div
            <div class="col-md-4">
                <p class="nivel">&nbsp;</p>
                <?php
                while ($leccion) {
                    if ($leccion_aprobada['leccion_aprobada'] + 1 >= $leccion['LECCION']) {
                        ?>
                        <ul class="nivel">NIVEL<?php echo $leccion['NIVEL']; ?><!--muestra el nivel 1-->
                            <ul>
                                <?php
                                $nivel = $leccion['NIVEL'];
                                while ($leccion && $nivel == $leccion['NIVEL'] && $leccion_aprobada['leccion_aprobada'] + 1 >= $leccion['LECCION']) {
                                    $sql_ejercicio = $bd->consulta("SELECT PUNTO FROM contenidos WHERE CODLECCION=$leccion[LECCION] AND TIPO = 'E'  ");
                                    $pag_ejercicio = $bd->sig_reg($sql_ejercicio);
                                    ?>		
                                    <a class="txt_central" href="inicio.php<?php echo "?lugar=leccion&lecc=$leccion[LECCION]&pag=$pag_ejercicio[PUNTO]&valor=1"; ?>">LECCIÓN <?php
                                        if ($leccion['LECCION'] <= 25)
                                            echo $leccion['LECCION'] . " - " . $leccion['TITULO'];
                                        else
                                            echo $leccion['leccion2'] . " - " . $leccion['TITULO'];
                                        ?></a><br />
                                    <!--muestra las lecciones de cada nivel-->
                                    <?php
                                    $leccion = $bd->sig_reg($sql);
                                }//fin while
                                ?>
                            </ul>
                        </ul>

                        <?php
                    } else
                        $leccion = $bd->sig_reg($sql);
                }//fin while
            }
            ?>
        </div>
            <br><br>
    </div>
