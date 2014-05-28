<div class="tabla" style="float:left;">
    <?php
    if (!(isset($bd))) {
        require_once('clases/db.class.php');
        $bd = new db;
    }

    if ((isset($_POST['buscar']) && $_POST['buscar'])) {
        $estado = $_POST['pais'];
    } else {
        $estado = $_GET['pais'];
    }
    $cant_pag = 20;
    $sql = $bd->consulta("SELECT * FROM usuarios WHERE pais='$estado'ORDER BY leccion_aprobada   DESC ");
    $num_registros = $bd->num_filas($sql);
    if (isset($_GET['pag']) && $_GET['pag']) {
        $pag = $_GET['pag'];
        $inicio = $cant_pag * ($pag - 1);
        $fin = $cant_pag * $pag;
        $sql = $bd->consulta("SELECT * FROM usuarios WHERE pais='$estado' ORDER BY leccion_aprobada  DESC limit $inicio,$fin");
    } else {
        $pag = 1;
        $inicio = 0;
        $fin = $cant_pag;
        $sql = $bd->consulta("SELECT * FROM usuarios WHERE pais='$estado' ORDER BY leccion_aprobada  DESC limit $inicio,$fin");
    }
    ?>




    <table class="table table-striped">
        <thead>

            <tr >
                <th class="tabla_cabecera" style="color:#FFF"> <?php echo "Contrato"; ?></th>
                <th class="tabla_cabecera" style="color:#FFF"><?php echo "C.I."; ?></th>
                <th class="tabla_cabecera" style="color:#FFF"><?php echo "Nombre"; ?></th>
                <th class="tabla_cabecera" style="color:#FFF"><?php echo "Apellido"; ?></th>
                <th class="tabla_cabecera" style="color:#FFF"><?php echo "Pais"; ?></th>
                <th class="tabla_cabecera" style="color:#FFF"><?php echo "Estatus"; ?></th>
                <th class="tabla_cabecera" style="color:#FFF"><?php echo "Lecciones"; ?></th>
            </tr>
        </thead>
        <tbody>
            <?php
            $contador = 1;
            $i = 0;
            $linea = $bd->sig_reg($sql);

            while (($linea) && ($contador <= $cant_pag)) {
                ?>
                <tr bgcolor="#efefef" >
                    <td class="contenido_tabla" ><?php echo "<a href='inicio.php?lugar=$lugar_value&contrato=$linea[contrato]&pag=$pag' target='_parent'>" . $linea['contrato'] . "</a>"; ?></td>
                    <td class="contenido_tabla" ><?php echo $linea['cedula']; ?></td>
                    <td class="contenido_tabla" ><?php echo $linea['nombre']; ?></td>
                    <td class="contenido_tabla" ><?php echo $linea['apellido']; ?></td>
                    <td class="contenido_tabla" ><?php echo $linea['pais']; ?></td>
                    <td class="contenido_tabla" ><?php
                        if ($linea['activo'] == 'N' || $linea['activo'] == 'n') {
                            echo 'Inactivo';
                        } else {
                            echo 'Activo';
                        }
                        ?></td>
                    <td class="contenido_tabla" ><?php echo $linea['leccion_aprobada']; ?></td>


                </tr>
                <?php
                $contador+=1;
                $linea = $bd->sig_reg($sql);
            }
            ?>
        </tbody>
    </table>



</div>
<div id="ant_sig2">
    <?php
    $lugar = $lugar_value;
    include('ant_sig_2.php');
    ?>
</div>