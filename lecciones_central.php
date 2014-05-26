<?php
//session_start();
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if (isset($_SESSION['wc']['session']) && $_SESSION['wc']['session'])/* SI HAY SESION */ {
    $_SESSION['wc']['leccion'] = 0;
    /* aqui defino la clase y el objeto bd, ya que si no hay session, mas abajo la defino en login_de_usuario. */
    /* lo hago adentro de la condicion para que no se defina dos veces */
} else {
    if (isset($_GET['lecc']) && ($_GET['lecc']) && ($_GET['lecc'] > 1))/* SI NO HAY SESION Y LA LECCION SELECCIONADA ES MAYOR A 1 */ {
        ?><script type="text/javascript">
                    alert("Error: No es posible acceder a la Leccion <?php echo $_GET['lecc'] ?>. Primero debe iniciar sesi\xf3n.");
        </script><?php
    }
}
if (!(isset($bd))) {
    require_once('clases/db.class.php');
    $bd = new db;
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$sql = $bd->consulta("SELECT * FROM leccion");
$leccion = $bd->sig_reg($sql);
$leccion = $bd->sig_reg($sql);
?>
<div class="container">
    <div class="row">
        <div id="imagen_izq" class="col-md-2">
            <img src="images/imgLecciones.jpg" width="152" height="260" />
        </div>
        <div style="float:left" class="col-md-6">
            <p>&nbsp;</p>
            <?php
            while ($leccion) {
                ?>

                <ul class="nivel">NIVEL<?php echo $leccion['NIVEL']; ?><!--muestra el nivel 1-->
                    <ul>

                        <?php
                        $nivel = $leccion['NIVEL'];
                        while ($leccion && $nivel == $leccion['NIVEL']) {
                            ?>
                            <a class="txt_central" href="inicio.php<?php echo "?lugar=leccion&lecc=$leccion[LECCION]&valor=1"; ?>">LECCIÓN <?php
                    if ($leccion['LECCION'] <= 25)
                        echo $leccion['LECCION'] . " - " . $leccion['TITULO'];
                    else
                        echo $leccion['leccion2'] . " - " . $leccion['TITULO'];
                            ?></a>
                            <img id="<?php echo $leccion['audio_leccion'] ?>" class="audio_lesson" src="images/audio.png" width="20px" height="20px"/>
                            <br />


                            <?php
                            $leccion = $bd->sig_reg($sql);
                        }//fin while
                        ?>
                    </ul>
                </ul>
                <?php
            }//fin while
            ?>
        </div>
    </div>
</div>
<div id="audio">
    <div id="player_audio"></div>
</div>
<script>
    /*$('.audio_lesson').click(function() {
        var id = this.id.split('/');
        var carpeta = id[0];
        var cd = id[1];
        var pista = id[2];
        var file = carpeta + '/' + cd + '/' + pista;


        jwplayer("player_audio").setup({
            flashplayer: "lib/jwplayer/player.swf",
            file: file,
            controlbar: 'bottom',
            autostart: true,
            height: 24,
            width: 250
        });

        $('#audio').dialog({
            title: 'Reproductor',
            autoOpen: true,
            resizable: true,
            modal: false,
            width: 'auto',
            buttons: {
                Cerrar: function() {
                    $(this).html('<div id="player_audio"></div>');
                    $(this).dialog('close');
                }
            }
        });
    });*/
</script>