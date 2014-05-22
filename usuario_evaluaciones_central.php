<?php
$con = new db;
if (isset($_SESSION['wc']['nivel']) && ($_SESSION['wc']['nivel'] == 'E')) {
    include('perfil_central.php');
    ?>
    <div class="col-md-8">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Evaluaciones Corregidas</h3>
            </div>
            <div class="panel-body">
                <?php
                $session_contrato = $_SESSION['wc']['usuario'];
                //busco las evaluaciones asignadas corregidas
                $eval_corregidas = $con->consulta("SELECT * FROM ee_evaluacion_asignada WHERE usuario_contrato='$session_contrato' AND estatus='Corregida'");
                echo $con->my_error;
                echo "<table class='table'>";
                echo"<tr style='background-color:#069; color:#fff;'>";
                echo"<td><b>NOMBRE DE LA EVALUACIÓN</b></td><td><b>CALIFICACIÓN</b></td>";
                echo"</tr>";
                while ($eval_corregida = $con->sig_reg($eval_corregidas)) {
                    //busco el nombre de la evaluacion asignada en la tabla evaluacion
                    $nom_evaluacion = $con->consulta("SELECT * FROM ee_evaluaciones WHERE id_evaluacion='$eval_corregida[id_evaluacion]'");
                    $nom_evaluacion = $con->sig_reg($nom_evaluacion);
                    if ($eval_corregida['nota'] == 1)
                        $nota = "Aprobado";
                    else
                        $nota = "Reprobado";
                    echo"<tr>";
                    echo"<td>$nom_evaluacion[nombre]</td><td>$nota</td>";
                    echo"</tr>";
                }
                echo "</table>";
                ?>
            </div>
            <div class="panel-footer"></div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Evaluaciones Resueltas, en espera de correción</h3>
            </div>
            <div class="panel-body">
                <?php
                $session_contrato = $_SESSION['wc']['usuario'];
                //busco las evaluaciones asignadas corregidas
                $eval_corregidas = $con->consulta("SELECT * FROM ee_evaluacion_asignada WHERE usuario_contrato='$session_contrato' AND estatus='Respondida'");
                echo $con->my_error;
                echo "<table id='tabla_evaluaciones_asignadas' class='table'>";
                echo"<tr style='background-color:#069; color:#fff;'>";
                echo"<td><b>NOMBRE DE LA EVALUACIÓN</b></td>";
                echo"</tr>";
                while ($eval_corregida = $con->sig_reg($eval_corregidas)) {
                    //busco el nombre de la evaluacion asignada en la tabla evaluacion
                    $nom_evaluacion = $con->consulta("SELECT * FROM ee_evaluaciones WHERE id_evaluacion='$eval_corregida[id_evaluacion]'");
                    $nom_evaluacion = $con->sig_reg($nom_evaluacion);
                    echo"<tr>";
                    echo"<td>$nom_evaluacion[nombre]</td>";
                    echo"</tr>";
                }
                echo "</table>";
                ?>
            </div>
            <div class="panel-footer"></div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Resolver Evaluación</h3>
            </div>
            <div class="panel-body">
                <?php
                $session_contrato = $_SESSION['wc']['usuario'];
                //busco las evaluaciones asignadas corregidas
                $eval_corregidas = $con->consulta("SELECT * FROM ee_evaluacion_asignada WHERE usuario_contrato='$session_contrato' AND estatus='Espera'");
                echo "<form name='resolver' action='inicio.php?lugar=eval_resolver' method='post'>";
                echo "<p>Seleccione la Evaluación</p>";
                echo "<p>Tenga en cuenta que sera evaluado con limite de tiempo una vez que carge la evaluacion seleccionada</p>";
                echo "<select name='eval_resolver' onChange='resolver.submit()'>";
                echo"<option value=''> </option>";
                while ($eval_corregida = $con->sig_reg($eval_corregidas)) {
                    //busco el nombre de la evaluacion asignada en la tabla evaluacion
                    $nom_evaluacion = $con->consulta("SELECT * FROM ee_evaluaciones WHERE id_evaluacion='$eval_corregida[id_evaluacion]'");
                    $nom_evaluacion = $con->sig_reg($nom_evaluacion);
                    echo"<option value='$eval_corregida[id]'>$nom_evaluacion[nombre]</option>";
                }
                echo "</select>";
                echo"</form>";
                ?>
            </div>
            <div class="panel-footer"></div>
        </div>
    </div>
    <?php
    /*     * ************************************************************************************************************************************** */
}