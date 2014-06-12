<?php
include('administrador_central.php');
if (!(isset($bd))) {
    require_once('clases/db.class.php');
    $bd = new db();
}
?>
<div class="cont_derecho_adm col-md-8">
    <div style="width:640px; float:left">
        <form action="inicio.php" method="post" class="form-inline">
            <fieldset>
                <legend>Listado de Alumno inscritos por nivel y cursos activos</legend>
                <div class="form-group">
                    <label>Cursos:</label>
                    <select class="form-control" id="curso" name="curso">
                        <option value="">Seleccione</option>
                        <?php
                        $sql = $bd->consulta("select * from vcurso_activo");
                        while ($consulta = $bd->sig_reg($sql)) {
                            ?>
                            <option value="<?= $consulta['id_curso'] ?>"><?= $consulta['nombre'] . ' ' . $consulta['fecha_ini'] ?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
                <input class="btn btn-primary" type="submit" name="buscar" value="Buscar" />  
                <a href="#" onclick="javascript:exportar($('#curso').val())">Exportar</a>
                <input type="hidden" name="lugar" value="<?php echo $_GET['lugar']; ?>"/>    
            </fieldset>    
        </form>
        <?php
        if ((isset($_POST['buscar']) && $_POST['buscar'] ) && (isset($_POST['curso']) && $_POST['curso']) || (isset($_GET['curso']) && $_GET['curso'])) {
            $lugar_value = 'reporte_alumnos_inscritos';
            include('lista_alumnos_inscritos.php');
        }
        ?>

    </div>
</div>