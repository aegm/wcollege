<?php
include('administrador_central.php');
?>
<div class="cont_derecho_adm">
    <p><strong> &nbsp;Listado de Alumno inscritos por nivel y cursos activos</strong></p>
<div style="width:640px; float:left">	
<form action="inicio.php" method="post">
                    <div class="input_text">Cursos:
                    <select id="curso" name="curso">
                        <option value="">Seleccione</option>
                    <?php $sql = $bd->consulta("select * from vcurso_activo");
                        while($consulta = $bd->sig_reg($sql))
                        {
                        ?>
                        <option value="<?=$consulta['id_curso']?>"><?=$consulta['nombre'].' '.$consulta['fecha_ini']?></option>
                        <?php
                        }   
                    ?>
                    </select>
                    </div>


    <input type="submit" name="buscar" value="Buscar" />  
    <a href="#" onclick="javascript:exportar($('#curso').val())">Exportar</a>
    <input type="hidden" name="lugar" value="<?php echo $_GET['lugar'];?>"/>      
</form>
    <?php 
	
	
		if ((isset($_POST['buscar']) && $_POST['buscar'] )&&(isset($_POST['curso']) && $_POST['curso'])||(isset($_GET['curso']) && $_GET['curso']))
		{
			$lugar_value='reporte_alumnos_inscritos';
				include('lista_alumnos_inscritos.php'); 
		}?>
    
</div>
</div>