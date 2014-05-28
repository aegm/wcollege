<div class="form-group">
    <div class="formulario_interno"><strong>Contrato:&nbsp; </strong></div>
    <div class="formulario_interno" style="text-align:left"><?php echo $usuario['contrato'] ?>
    </div>
    <div style="clear:both">
    </div>
</div>
<div class="input_text"><div class="formulario_interno"><strong>Clave:&nbsp; </strong></div><div class="formulario_interno" style="text-align:left"><?php echo $usuario['clave'] ?></div><div style="clear:both"></div></div>
<?php
$vencimiento = substr($usuario['vencimiento'], 8, 2) . '-';
$vencimiento.=substr($usuario['vencimiento'], 5, 2) . '-';
$vencimiento.=substr($usuario['vencimiento'], 0, 4);
?>
<div class="input_text">
    <div class="formulario_interno"><strong>Vencimiento:&nbsp;</strong></div> 
    <div class="formulario_interno" style="text-align:left"><?php echo $vencimiento ?></div></div>
<div class="input_text">
    <div class="formulario_interno"><strong>C.I.:&nbsp; </strong></div><div class="formulario_interno" style="text-align:left"><?php echo $usuario['cedula'] ?></div></div>
<div class="input_text">
    <div class="formulario_interno"><strong>Nombre:&nbsp;  </strong></div> 
    <div class="formulario_interno" style="text-align:left"><?php echo $usuario['nombre'] ?></div></div>
<div class="input_text">
    <div class="formulario_interno"><strong>Apellido: </strong>&nbsp;</div> 
    <div class="formulario_interno" style="text-align:left"><?php echo $usuario['apellido'] ?></div></div>
<div class="input_text">
    <div class="formulario_interno"> <strong>Sexo: &nbsp;</strong></div><div class="formulario_interno" style="text-align:left"><?php echo $usuario['sexo'] ?></div></div>
<div class="input_text">
    <div class="formulario_interno"> <strong>Estado:&nbsp;</strong></div> 
    <div class="formulario_interno" style="text-align:left"><?php echo $usuario['estado']; ?></div></div>
<div class="input_text">
    <div class="formulario_interno"><strong>Ciudad:&nbsp;</strong></div> 
    <div class="formulario_interno" style="text-align:left"><?php echo $usuario['ciudad'] ?></div></div>

<div class="input_text">
    <div class="formulario_interno"><strong>Lecciones Aprobadas:&nbsp;</strong></div> 
    <div class="formulario_interno" style="text-align:left"><?php echo $usuario['leccion_aprobada'] ?></div></div>
<div class="input_text">
    <div class="formulario_interno"><strong>Nivel:&nbsp;</strong></div> 
    <div class="formulario_interno" style="text-align:left"><?php
        if ($usuario['nivel'] == 'p') {
            echo ('Profesor');
        } else {
            if ($usuario['nivel'] == 'E') {
                echo ('Estudiante');
            } else {
                if ($usuario['nivel'] == 'a') {
                    echo ('Administrador');
                } else {
                    if ($usuario['nivel'] == 's') {
                        echo ('Super-Administrador');
                    }
                }
            }
        }
        ?></div></div>
<div class="input_text">
    <div class="formulario_interno"><strong>Estatus:&nbsp;</strong></div> 
    <div class="formulario_interno" style="text-align:left"><?php
        if ($usuario['activo'] == 'S' || $usuario['activo'] == 's') {
            echo ('Activo');
        } else {
            if (!isset($s)) {
                echo ('Inactivo');
            }
        }
        ?></div></div>
<?php
$contrato = $usuario['contrato'];
$sql = $bd->consulta("SELECT * FROM email_recomendados where contrato = '$contrato'");
$usuario2 = $bd->sig_reg($sql);
?>
<div class="input_text">
    <div class="formulario_interno"><strong>Telefono Personal:&nbsp;</strong></div> 
    <div class="formulario_interno" style="text-align:left"><?php echo $usuario2['telefonop'] ?></div></div>
<div class="input_text">
    <div class="formulario_interno"><strong>E-mail:&nbsp;</strong></div> 
    <div class="formulario_interno" style="text-align:left"><?php echo $usuario2['email'] ?></div></div> 
<div class="input_text">
    <div class="formulario_interno"><strong>Telefono recomendado 1:&nbsp;</strong></div> 
    <div class="formulario_interno" style="text-align:left"><?php echo $usuario2['telefonor1'] ?></div></div>
<div class="input_text">
    <div class="formulario_interno"><strong>E-mail recomendado 1:&nbsp;</strong></div> 
    <div class="formulario_interno" style="text-align:left"><?php echo $usuario2['email1'] ?></div></div> 
<div class="input_text">
    <div class="formulario_interno"><strong>E-mail recomendado 2:&nbsp;</strong></div> 
    <div class="formulario_interno" style="text-align:left"><?php
        if ($usuario2['email2'])
            echo $usuario2['email2'];
        else
            echo 'N/A';
        ?></div></div> 
<div class="input_text">
    <div class="formulario_interno"><strong>E-mail recomendado 3:&nbsp;</strong></div> 
    <div class="formulario_interno" style="text-align:left"><?php
        if ($usuario2['email2'])
            echo $usuario2['email3'];
        else
            echo 'N/A';
        ?></div></div> 
<div class="input_text">
    <div class="formulario_interno"><strong>Evaluaciones Situacionales:&nbsp;</strong></div> 
    <?php
    $eval_realizadas = $bd->consulta("SELECT * FROM videos_situacionales_evaluados WHERE contrato = '$contrato'");
    $video_html = NULL;
    while ($eval_realizada = $bd->sig_reg($eval_realizadas)) {
        $evaluaciones = $bd->consulta("SELECT * FROM videos_situacionales WHERE id_video_sit = '$eval_realizada[id_video]'");
        $evaluacion = $bd->sig_reg($evaluaciones);
        $video_html.="$evaluacion[nombre],";
    }
    ?>
    <div class="formulario_interno" style="text-align:left"><?php echo $video_html; ?></div></div> 
<div style="clear: both;"></div>
