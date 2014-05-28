<?php
if (isset($_SESSION['wc']['nivel']) && ($_SESSION['wc']['nivel'] == 'E' )) {
    if (!(isset($bd))) {
        require_once('clases/db.class.php');
        $bd = new db;
    }
    include('perfil_central.php');
    $contrato = $_SESSION['wc']['usuario'];
    $_SESSION['wc']['usuario'];

    $sql = $bd->consulta("SELECT * FROM usuarios where contrato = '$contrato'");
    $usuario = $bd->sig_reg($sql);
    $usuario['leccion_aprobada'];
    ?>
    <div class="col-md-8">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">&nbsp;Datos Personales</h3>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-sm-2 control-label">Contrato:&nbsp; </label>
                    <label><?php echo $usuario['contrato'] ?></label>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">C.I.:&nbsp;</label>
                    <label> <?php echo $usuario['cedula'] ?></label>  
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Nombre:&nbsp;</label>
                    <label> <?php echo $usuario['nombre'] ?></label>  
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Apellido:</label>
                    <label><?php echo $usuario['apellido'] ?></label>  
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Sexo: &nbsp; </label>
                    <label><?php echo $usuario['sexo'] ?></label>  
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Estado:&nbsp;</label>
                    <label> <?php echo $usuario['estado'] ?></label>  
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Ciudad:&nbsp; </label>
                    <label><?php echo $usuario['ciudad'] ?></label>  
                </div>

                <?php
                $vencimiento = substr($usuario['vencimiento'], 8, 2) . '-';
                $vencimiento.=substr($usuario['vencimiento'], 5, 2) . '-';
                $vencimiento.=substr($usuario['vencimiento'], 0, 4);
                ?>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Vencimiento:&nbsp;</label>
                    <label> <?php echo $vencimiento ?></label>  
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Lecciones Aprobadas:&nbsp; </label>
                    <label><?php echo $usuario['leccion_aprobada']; ?></label>  
                </div>
                <!--<div class="input_text">
                  <div class="formulario_interno"><strong>Nivel:&nbsp;</strong></div> 
                  <div class="formulario_interno" style="text-align:left"><?php /* if($usuario['nivel']=='p'){echo ('Profesor');}else{if($usuario['nivel']=='E'){echo ('Estudiante');}else{if($usuario['nivel']=='a'){echo ('Administrador');}else{if($usuario['nivel']=='s'){echo ('Super-Administrador');}}}} */ ?></div></div>-->
                <div class="form-group">
                    <label class="col-sm-2 control-label">Estatus:&nbsp; </label>
                    <label>
                        <?php
                        if ($usuario['activo'] == 'S' || $usuario['activo'] == 's') {
                            echo ('Activo');
                        } else {
                            if (!isset($s)) {
                                echo ('Inactivo');
                            }
                        }
                        ?>
                    </label>  
                </div>
            </div>
            <div class="formulario_interno">
                <?php ?>
                <strong><a href="inicio.php?lugar=progreso">Ve Tu Progreso</a></strong></div> 
        </div>
    </div>
    <div style="clear: both;"></div>





    <?php
} else {
    echo('Error, este usuario no tiene acceso al modulo Perfil de usuario');
}
?>	