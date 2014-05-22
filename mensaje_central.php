<?php
include('administrador_central.php');

if($_POST['titulo_mensaje']&&$_POST['mensaje'])
{
    $title = $_POST['titulo_mensaje'];
    $mensaje = $_POST['mensaje'];
    $sql = $bd->consulta("update  mensajes set title = '$title', mensaje = '$mensaje'") or die ("error");;
}

$sql = $bd->consulta("select * from mensajes");
$mensaje=$bd->sig_reg($sql);
?>
<div class="cont_derecho_adm">
<p><strong> &nbsp;Administrador Principal de Mensajes</strong></p>
<div style="width:640px; float:left">
    <form action="inicio.php?lugar=mensaje" method="post">
        <div class="input_text">Titulo del Mensaje
            <textarea cols="50" id="titulo_mensaje" name="titulo_mensaje" value=""><?=$mensaje['title']?></textarea>
        </div>
        <div class="input_text">Mensaje Principal
            <textarea cols="50" id="mensaje" name="mensaje"><?=$mensaje['mensaje']?></textarea>
        </div>
        <div class="input_text" ><input type="submit" name="agregar" value="Guardar"  /></div>
    </form>
</div>
</div>