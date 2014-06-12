<style>
    table{font-size: 10px;}
</style>

<div class="tabla" style="float:left;">
    <?php
    if (!(isset($bd))) {
        require_once('clases/db.class.php');
        $bd = new db();
    }

    $cant_pag = 20;
    $sql = $bd->consulta("SELECT * FROM valumnos_inscritos where id_curso = " . $_POST['curso']);
    //$num_registros=$bd->num_filas($sql);                        
    ?>
    <table>
        <thead>
            <tr >
                <th class="tabla_cabecera" style="color:#FFF"> <?php echo "Contrato"; ?></th>
                <th class="tabla_cabecera" style="color:#FFF"><?php echo "C.I."; ?></th>
                <th class="tabla_cabecera" style="color:#FFF"><?php echo "Nombre"; ?></th>
                <th class="tabla_cabecera" style="color:#FFF"><?php echo "Apellido"; ?></th>
                <th class="tabla_cabecera" style="color:#FFF"><?php echo "Email"; ?></th>
                <th class="tabla_cabecera" style="color:#FFF"><?php echo "Aula"; ?></th>
            </tr>
        </thead>
        <tbody>
            <?php
            $contador = 1;
            $i = 0;
//$linea=$bd->sig_reg($sql);
            while ($linea = $bd->sig_reg($sql)) {
                ?>
                <tr bgcolor="#efefef" >
                    <td class="contenido_tabla" ><?php echo "<a href='inicio.php?lugar=$lugar_value&contrato=$linea[contrato]&pag=$pag' target='_parent'>" . $linea['contrato'] . "</a>"; ?></td>
                    <td class="contenido_tabla" ><?php echo $linea['cedula']; ?></td>
                    <td class="contenido_tabla" ><?php echo $linea['nombre']; ?></td>
                    <td class="contenido_tabla" ><?php echo $linea['apellido']; ?></td>
                    <td class="contenido_tabla" ><?php echo $linea['email']; ?></td>
                    <td class="contenido_tabla" ><?php echo $linea['aula']; ?></td>

                </tr>
                <?php
                $contador+=1;
                $linea = $bd->sig_reg($sql);
            }
            ?>
        </tbody>
    </table>
