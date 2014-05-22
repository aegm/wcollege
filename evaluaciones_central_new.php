<?php
/**
 * Created by PhpStorm.
 * User: Ing. Angel Gonzalez
 * Date: 13/05/14
 * Time: 05:05 PM
 */
require_once('clases/db.class.php');
$bd = new db;
$contrato = $_SESSION['wc']['usuario'];
$sql = $bd->consulta("SELECT leccion_aprobada FROM usuarios WHERE contrato = '$contrato'");
while ($leccion = $bd->sig_reg($sql)) {
    $leccion_aprobada = $leccion['leccion_aprobada'];
}
switch ($leccion_aprobada) {
    case $leccion_aprobada <= 15 :
        $ini = 1;
        $nivel = 1;
        break;
    case $leccion_aprobada > 15 :
        $ini = 15;
        $nivel = 2;
    case $leccion_aprobada > 25:
        $ini = 25;
        $nivel = 3;
        break;
}

function esPar($numero) {
    $resto = $numero % 2;
    if (($resto == 0) && ($numero != 0)) {
        return true;
    } else {
        return false;
    }
}

function validarCadena($texto) {
    $valores = array('#5');
    $cadena = explode(' ', $texto);
    if (in_array($cadena, $valores)) {
        $dato = implode(' ', $cadena);
    }

    return $dato;
}
?>
<div class="container">
    <header class="page-heading clearfix">
        <h1 class="heading-title pull-left">Evaluaciones Online! - <?php echo strtoupper($nivel); ?></h1>
    </header>
    <div class="row">
        <div class="col-md-12">
            <div class="panel-group" id="accordion">
                <?php
                $sql = $bd->consulta("select * from leccion WHERE LECCION BETWEEN $ini AND $leccion_aprobada");
                while ($consulta = $bd->sig_reg($sql)) {
                    ?>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $consulta['LECCION'] ?>" class="collapsed">
                                    Lección <?php echo $consulta['LECCION'] . ' - ' . $consulta['TITULO'] . ' - ' . $consulta['EJERCICIOS'] ?>
                                </a>
                            </h4>
                        </div>
                        <?php
                        $sql_ejercicio = $bd->consulta("SELECT * FROM contenidos WHERE CODLECCION=$consulta[LECCION] AND  PUNTO = $consulta[EJERCICIOS] ORDER BY ID");
                        ?>
                        <div id="collapse<?php echo $consulta['LECCION'] ?>" class="panel-collapse collapse">
                            <div class="panel-body">
                                <form>

                                    <?php
                                    $fila_ant = 1;
                                    $colum = 0;
                                    $caja = '<div class="col-md-4"> 
                                                     <select> </select> 
                                                     </div>';
                                    while ($ejercicio = $bd->sig_reg($sql_ejercicio)) {
                                        $texto = $ejercicio['TEXTO'];
                                        $tipo = $ejercicio['TIPO'];
                                        $fila = $ejercicio['FILA'];
                                        $columna = $ejercicio['COLUMNA'];
                                        if ($tipo == 'C') {
                                            if ($columna == '1') {
                                                echo "<div class='col-md-4'>
                                                     <label>" . $texto . "</label>
                                                     </div>";
                                            }
                                            if ($columna == '2' && $fila_ant == $fila) {
                                                echo $caja;
                                                echo "<div class='col-md-4'>
                                                     <label>" . validarCadena($texto) . "</label>
                                                     </div>";
                                            }
                                        }
                                        $fila_ant = $fila;
                                    }
                                    ?>   


                                </form>

                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
