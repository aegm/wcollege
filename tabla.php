<div class="col-md-12">

    <div class="tabla" style="float:left;">
        <?php
        if (!(isset($bd))) {
            require_once('clases/db.class.php');
            $bd = new db;
        }

        if (isset($_GET['filtro']) && $_GET['filtro'])
            $filtro = $_GET['filtro'];
        else
            $filtro = 'contrato';
        $cant_pag = 500;
        $sql = $bd->consulta("SELECT * FROM usuarios ORDER BY $filtro ASC ");
        $num_registros = $bd->num_filas($sql);
        if (isset($_GET['pag']) && $_GET['pag']) {
            $pag = $_GET['pag'];
            $inicio = $cant_pag * ($pag - 1);
            $fin = $cant_pag * $pag;
            $sql = $bd->consulta("SELECT * FROM usuarios ORDER BY $filtro ASC limit $inicio,$fin");
        } else {
            $pag = 1;
            $inicio = 0;
            $fin = $cant_pag;
            $sql = $bd->consulta("SELECT * FROM usuarios ORDER BY $filtro ASC limit $inicio,$fin");
        }
        ?>




        <table class="table table-striped">
            <thead>

                <tr >
                    <th class="tabla_cabecera" > <?php echo "<a class='txt_tabla_cabecera 'href='inicio.php?lugar=$lugar_value&filtro=contrato' target='_parent'>Contrato</a>"; ?></th>
                    <th class="tabla_cabecera" ><?php echo "<a class='txt_tabla_cabecera ' href='inicio.php?lugar=$lugar_value&filtro=cedula' target='_parent'>C.I.</a>"; ?></th>
                    <th class="tabla_cabecera" ><?php echo "<a class='txt_tabla_cabecera ' href='inicio.php?lugar=$lugar_value&filtro=nombre' target='_parent'>Nombre</a>"; ?></th>
                    <th class="tabla_cabecera" ><?php echo "<a class='txt_tabla_cabecera ' href='inicio.php?lugar=$lugar_value&filtro=apellido' target='_parent'>Apellido</a>"; ?></th>
                    <th class="tabla_cabecera" ><?php echo "<a class='txt_tabla_cabecera ' href='inicio.php?lugar=$lugar_value&filtro=estado' target='_parent'>Estado</a>"; ?></th>
                    <th class="tabla_cabecera" ><?php echo "<a class='txt_tabla_cabecera ' href='inicio.php?lugar=$lugar_value&filtro=activo' target='_parent'>Estatus</a>"; ?></th>
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
                        <td class="contenido_tabla" ><?php echo "<a href='inicio.php?lugar=$lugar_value&contrato=$linea[contrato]&pag=$pag&filtro=$filtro' target='_parent'>" . $linea['contrato'] . "</a>"; ?></td>
                        <td class="contenido_tabla" ><?php echo $linea['cedula']; ?></td>
                        <td class="contenido_tabla" ><?php echo $linea['nombre']; ?></td>
                        <td class="contenido_tabla" ><?php echo $linea['apellido']; ?></td>
                        <td class="contenido_tabla" ><?php echo $linea['estado']; ?></td>
                        <td class="contenido_tabla" ><?php
                            if ($linea['activo'] == 'N' || $linea['activo'] == 'n') {
                                echo 'Inactivo';
                            } else {
                                echo 'Activo';
                            }
                            ?></td>


                    </tr>


                    <?php
                    $contador+=1;
                    $linea = $bd->sig_reg($sql);
                }
                ?>
            </tbody>
        </table>



    </div>


</div>

<div class="col-md-12" id="ant_sig2">
    <label>
        Filtrar por:
    </label>
    <?php
    $lugar = $lugar_value;
    include('ant_sig.php');
    ?>
</div
<br><br><br>