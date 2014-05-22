<?php
require_once('clases/db.class.php');
$bd = new db;
?>
<div class="container">
    <div class="row">
        <div class="col-md-2">
            <div id="imagen_izq"><img src="images/imgLecciones.jpg" width="152" height="260" /></div>
        </div>
        <?php
        $sql = $bd->consulta("SELECT * FROM leccion");
        $nivel_anterior = 0;
        ?>
        <div class="col-md-10">
            <div class="row">
            <?php
            while ($leccion  = $bd->sig_reg($sql)) {
                ?>
                <h2>
                    <?php if ($nivel_anterior != $leccion['NIVEL']) { ?>
                        <div class="col-lg-12">
                            <h2>NIVEL <?php echo $leccion['NIVEL']; ?> </h2>
                        </div>
                    <?php } ?>
                    <?php if($leccion['LECCION'] != 0) {?>
                    <div class="col-md-6">
                    <div id="audio" class="blockquote-box blockquote-primary clearfix">
                        <div class="square pull-left">
                            <span class="fa fa-headphones fa-lg"></span>
                        </div>
                        <h4>NIVEL <?php echo $leccion['LECCION'] ?></h4>
                        <p>
                            <?php echo $leccion['TITULO'];  ?>
                        </p>
                    </div>
                    </div>
                    <?php } ?>
                </h2>
                <?php
                $nivel_anterior = $leccion['NIVEL'];
            }
            ?>
        </div>
        <div class="col-md-3">

        </div>

    </div>

</div>
<div id="audio">
    <div id="player_audio"></div>
</div>
<script>
    $('.audio_lesson').click(function() {
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
    });
</script>