<script type="text/javascript">
    function confirmDelete(dir) {
        if (confirm("¿Esta seguro que desea eliminar el registro seleccionado? Si La evaluacion seleccionada contiene preguntas o ha sido asignada a un estudiante, No se Eliminara dicha evaluación")) {
            document.location = dir;
        }
    }
</script>
<?php
$con = new db;
include('eval_desarrollo_accion.php');
/* if (isset($_GET['editar']))
  {
  $accion='Editar';
  $editar_evaluaciones=$con->consulta("SELECT * FROM ee_evaluaciones WHERE id_evaluacion='$_GET[id]'");
  $editar_evaluacion=$con->sig_reg($editar_evaluaciones);
  $_POST['eval_rango']=$editar_evaluacion['rango'];
  $_POST['eval_titulo']=$editar_evaluacion['nombre'];
  $_POST['eval_cant_preguntas']=$editar_evaluacion['cantidad_preguntas'];
  }else{
  //eliminar
  } */

$evaluaciones = $con->consulta("SELECT * FROM ee_evaluaciones");
$html = "<div id='lista_evaluaciones'>
				<table class='table table-striped'>
					<tr>
							<td colspan='4'><b>TITULO DE LA EVALUACION PREGUNTAS</b></td>
					</tr>";

while ($evaluacion = $con->sig_reg($evaluaciones)) {
    $html.="<tr>
							<td>$evaluacion[nombre]</td>
							<td><center>$evaluacion[cantidad_preguntas]</center></td>
							<td><a href='inicio.php?lugar=nombres_evaluaciones&accion=Editar&id=$evaluacion[id_evaluacion]'>editar</a></td>
							<td><a href='javascript:confirmDelete(\"inicio.php?lugar=nombres_evaluaciones&accion=Eliminar&id=$evaluacion[id_evaluacion]\")' >eliminar</a></td>
									</tr>";
}
$html.="</table>
		   </div>";
echo $html;
?>
<form action="inicio.php?lugar=nombres_evaluaciones" method="post">
    <div class="form-group">
        <label>Titulo de la Evaluación:</label>
        <input class="form-control" type="text" name="eval_titulo" value="<?php if (isset($_POST['eval_titulo'])) echo $_POST['eval_titulo']; ?>" > 
    </div>
    <div class="form-group">
        <label>Preguntas:</label>
        <input class="form-control" type="text" name="eval_cant_preguntas" value="<?php if (isset($_POST['eval_cant_preguntas'])) echo $_POST['eval_cant_preguntas']; ?>" size="2"  > 
    </div>
    <div class="form-group">
        <input type="hidden" name="id" value="<?php if (isset($_GET['id'])) echo $_GET['id']; ?>">
        <input class="btn btn-primary" type="submit" name="accion" value="<?php echo $_POST['accion'] ?>">
    </div>
</form>