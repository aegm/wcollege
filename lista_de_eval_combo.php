<script type="text/javascript">
    function cambiar_y_submit(objeto, texto, formulario) {
        objeto.value = texto;
        formulario.submit();
    }
    function submit(objeto) {
        objeto.submit();

    }
    function validar(form) {
        if (form.texto.value != '') {
            var submitt = true;
        } else {
            var submitt = false;
        }

        return submitt;

    }
    function confirmDelete1(dir, objeto, texto, formulario) {
        if (confirm("¿Esta seguro que desea eliminar el registro seleccionado? Si La Pregunta seleccionada pertenece a una evaluación que ha sido asignada a un estudiante, No se Eliminara dicha pregunta"))
        {
            document.location = dir;
        }
    }
    function confirmDelete2(dir, objeto, texto, formulario) {
        return confirm("¿Esta seguro que desea eliminar los registros seleccionados? Solo se Eliminaran las preguntas que \"no\" pertenecen a una evaluación que haya sido asignada a un estudiante.");
    }
</script>
<?php
$con = new db;
if ((isset($_POST['evaluacion']) && $_POST['evaluacion']))
    $eval = $_POST['evaluacion'];
else
if ((isset($_GET['evaluacion']) && $_GET['evaluacion']))
    $eval = $_GET['evaluacion'];
else
    $eval = false;
include('eval_desarrollo_preguntas_accion.php');
$evaluaciones = $con->consulta("SELECT * FROM ee_evaluaciones");
$html = "<form name='formulario1' action='inicio.php?lugar=eval_desarrollo_preguntas' method='post' onsubmit='return validar(this)'>";
$html .= "<div class='form-group'><label>Evaluacion: </label>";
//select evaluacion
$html.="<select class='form-control' style='width:auto;' name='evaluacion' onChange='pregunta=window.pregunta ? window.pregunta : false; pregunta.value=0; this.form.submit(); '>";

$html.="<option value='0' selected ></option>";
$html .= '</div>';

while ($evaluacion = $con->sig_reg($evaluaciones)) {
    if ($eval == $evaluacion['id_evaluacion'])
        $selected = 'selected';
    else
        $selected = '';
    $html.="<option value='$evaluacion[id_evaluacion]' $selected >$evaluacion[nombre]</option>";
}
$html.="</select>";

if ($eval) {
    $num_preguntas = $con->consulta("SELECT cantidad_preguntas FROM ee_evaluaciones WHERE id_evaluacion='$eval'");
    $num_preguntas = $con->sig_reg($num_preguntas);

    $mostrar_preguntas = $con->consulta("SELECT * FROM ee_preguntas WHERE id_evaluaciones='$eval'");
    //preguntas que ya estan registradas
    $html.="<div id='lista_preguntas'>
					<div><p>Para poder asignar esta evaluacion a un estudiande, debe agregar al menos $num_preguntas[cantidad_preguntas] pregunta(s)<p>
					<table>
						<tr>
								<td><b>PREGUNTAS</b></td>
						</tr>";
    $j = 1;

    while ($mostrar_pregunta = $con->sig_reg($mostrar_preguntas)) {

        $html.="<tr>
											<td><input type='checkbox' name='id_$j' value='$mostrar_pregunta[id_pregunta]' /></td>
											<td>$mostrar_pregunta[texto]</td>
											<td><a href='inicio.php?lugar=eval_desarrollo_preguntas&accion=Editar&id=$mostrar_pregunta[id_pregunta]&evaluacion=$eval'>editar</a></td>
											<td><a href='javascript:confirmDelete1(\"inicio.php?lugar=eval_desarrollo_preguntas&accion=Eliminar&id=$mostrar_pregunta[id_pregunta]&evaluacion=$eval\")' >eliminar</a></td>
										</tr>";

        $j++;
    }
    if ($con->num_filas($mostrar_preguntas))
        $html.="<tr><td><a name='eliminar_varios' href='#' onclick='if (confirmDelete2(\"#\")){cambiar_y_submit(formulario1.accion2,\"Eliminar\",formulario1);}'>Eliminar</a></td></tr>";






    $html.="</table>
				</div>";
    if (isset($_POST['texto']))
        $texto = $_POST['texto'];
    else
        $texto = NULL;
    if (isset($_GET['id']))
        $id_pregunta = $_GET['id'];
    else
        $id_pregunta = NULL;
    if ($_POST['accion'] == 'Eliminar')
        $_POST['accion'] = 'Aceptar';

    $html.= "<p>
					Escriba la Pregunta:
					<input type='text' name='texto' style='width:auto' value='$texto' >
					<input type='hidden' name='id' value='$id_pregunta'>
					<input type='submit' name='accion' value='$_POST[accion]'>
					<input type='hidden' name='accion2' value=''>
				</p>";

    //}
}
$html.="</form>";

echo $html;
