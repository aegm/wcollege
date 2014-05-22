<?php
if (isset($_SESSION['wc']['nivel']) && ($_SESSION['wc']['nivel'] == 'a' || $_SESSION['wc']['nivel'] == 's')) {
    include('administrador_central.php');
    ?>
    <div class="cont_derecho_adm col-md-8">
        <p><strong> &nbsp;</strong></p>

        <div style="width:640px; float:left">	
            <form action="inicio.php" method="post">
                <fieldset>
                    <legend>Estado de cuenta de Usuarios</legend>
                    <div class="form-group">
                        <label>Contrato:</label>
                        <input class="form-control"type="text" name="contrato" value="<?php
                        if (isset($_GET['contrato']) && $_GET['contrato']) {
                            echo $_GET['contrato'];
                        }
                        ?>" />

                    </div>
                    <input class="btn btn-primary" type="submit" name="buscar" value="Buscar"/>
                    <input type="hidden" name="lugar" value="<?php echo $_GET['lugar']; ?>" />
                </fieldset>

            </form>	
        </div>    

    </div>
    <?php
    $lugar_value = 'usuario_estado';
    include('tabla.php');
    ?>


    <div id="formulario_adm">
        <form action="inicio.php" method="post">
            <?php
            if ((isset($_POST['buscar']) && $_POST['buscar'] ) || (isset($_GET['contrato']) && $_GET['contrato'])) {

                if (isset($_GET['contrato']) && $_GET['contrato']) {
                    if (!(isset($bd))) {
                        require_once('clases/db.class.php');
                        $bd = new db;
                    }

                    $sql = $bd->consulta("SELECT * FROM usuarios where contrato='$_GET[contrato]'");
                    $usuario = $bd->sig_reg($sql);
                    $sql2 = $bd->consulta("SELECT * FROM email_recomendados where contrato = '$_GET[contrato]'");
                    $usuario2 = $bd->sig_reg($sql2);
                } else {
                    if (!(isset($bd))) {
                        require_once('clases/db.class.php');
                        $bd = new db;
                    }

                    $sql2 = $bd->consulta("SELECT * FROM usuarios where contrato='$_POST[contrato]'");
                    $sql3 = $bd->consulta("SELECT * FROM email_recomendados where contrato = '$_POST[contrato]'");
                    if ($sql2) {
                        $usuario = $bd->sig_reg($sql2);
                        $usuario2 = $bd->sig_reg($sql3);
                        if (!(isset($usuario) && $usuario['contrato']))
                            echo('No se encontro ningun registro correspondiente al contrato suministrado');
                    }else {
                        echo('No se encontro ningun registro correspondiente al contrato suministrado');
                    }
                }
                if (isset($usuario) && $usuario['contrato']) {
                    if (($_SESSION['wc']['nivel'] == 's') || (isset($_SESSION['wc']['nivel']) && $_SESSION['wc']['nivel'] == 'a' && $usuario['nivel'] <> 's' && $usuario['nivel'] <> 'a')) {
                        ?>





                        <?php
                        include('usuario_datos.php');
                    } else
                        echo ('Por motivos de seguridad, el usuario seleccionado no se puede accesar');
                }
            }
            ?>
            <input type="hidden" name="lugar" value="<?php echo $_GET['lugar']; ?>" />
        </form>

    </div>	
    <div id="tabla" style="overflow:auto">
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







                                    <!--<iframe  src="tabla.php" name="tabla" scrolling="auto" width="590px;" height="400px;" frameborder="0">

                                    </iframe>-->

    </div>    

    </div>
    <?php
} else {
    echo('Error, este usuario no tiene acceso al modulo Administrativo');
}
?>	