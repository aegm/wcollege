<?php
if (isset($_SESSION['wc']['nivel']) && ($_SESSION['wc']['nivel'] == 'E' )) {
    include('perfil_central.php');
    if (!(isset($bd))) {
        require_once('clases/db.class.php');
        $bd = new db;
    }
    //consultando el aula de acceso del usuario
    $usr = $_SESSION['wc']['usuario'];
    $sql = $bd->consulta("select * from v_user_aula where contrato = '$usr'");
    $usuario = $bd->sig_reg($sql);
    $aula = $usuario['aula'];

    //REVISANDO CURSOS DISPONIBLES EN EL AULA BUSCADA
    $html = '';
    $curso = $bd->consulta("select * from vcursos where libro = '$aula'");
    while ($cursos = $bd->sig_reg($curso)) {
        $html .= "<tr>";
        $html .= "<td>$cursos[Curso]</td><td>" . fecha($cursos['fecha_ini']) . "</td><td>" . fecha($cursos['fecha_fin']) . "</td><td>$cursos[Categoria]</td><td><a onclick=javascript:inscribir('$usr','$cursos[id]','$cursos[pais]')>Inscribirse en el Aula</a></td>";
        $html .= "</tr>";
    }
    ?>

    <div class="aula_virtual col-md-8">
        <h2>Horario Aula Virtual</h2>
        <div style="float: left; width: 50%">
            <a style="text-decoration: none;" target="blank" href="http://www.washingtoncollege.com.ve/downloads/aula_one.pdf"><img width="80%" height="20%" src="images/aulas/Aula1.png" /></a>
        </div>
        <div style="width: 40%; float: left;">            
            <a style="text-decoration: none;" target="blank" href="http://www.washingtoncollege.com.ve/downloads/aula_two_three.pdf"><img width="100%" height="60%" src="images/aulas/Aula23.png" /></a>
        </div>
        <div style="clear: both;"></div>
        <br>
        <h2>Cursos Disponibles </h2>
        <table class="table">
            <thead>
                <tr>
                    <th>
                        Nombre del Curso
                    </th>
                    <th>
                        Fecha de Inicio
                    </th>
                    <th>
                        Fecha fin
                    </th>
                    <th>
                        tipo de Curso
                    </th>
                    <!--th>
                        Horarios
                    </th-->
                    <th>
                        Accion
                    </th>
                </tr>
            </thead>
            <tbody>
                <?= $html ?>
            </tbody>    
        </table>  
    </div>
    <?php
}

function fecha($fecha, $o = "") {
    if (!$fecha)
        return "";
    if (is_numeric($fecha))
        return date("d/m/Y", $fecha);
    else {
        $fecha = explode("/", $fecha);
        $fecha = $fecha[2] . "-" . $fecha[1] . "-" . $fecha[0];
        return strtotime($fecha);
    }
}
?>

