<?php
$con = new db;
include('perfil_central.php');
?>
<div class="col-md-8">
    <?php
    if ("no ha aprobado este video") {
        $preguntas = $con->consulta("SELECT * FROM videos_situacionales_preg WHERE id_vid_sit='$_GET[video]' ORDER BY numero");
        echo "<div style='float:left;'>";
        echo"<form action='inicio.php?lugar=evaluar_video_situacional_resp&video=$_GET[video]' method='post'>";
        while ($pregunta = $con->sig_reg($preguntas)) {
            $respuestas = $con->consulta("SELECT * FROM videos_situacionales_resp WHERE id_preg='$pregunta[id_preguntas_sit]'");
            echo $pregunta['pregunta'];
            echo "<br>";
            echo"<select class='form-control' name='respuesta_$pregunta[numero]' style='width:auto'>";
            while ($respuesta = $con->sig_reg($respuestas)) {
                echo"<option value='$respuesta[id_respuesta]'>$respuesta[respuesta]</option>";
            }
            echo"</select>";
            echo "<br>";
        }
        
        echo"<div class='form-group'><input type='submit' name='evaluacion_situacional' value='Evaluar' class='form-group'></div>";
        echo"</form>";
        echo "</div>";
    }
    ?>
</div>