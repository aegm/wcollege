<?php
if (isset($_SESSION['wc']['nivel']) && ($_SESSION['wc']['nivel'] == 'a' || $_SESSION['wc']['nivel'] == 's')) {
    include('administrador_central.php');
    ?>
    <div class="cont_derecho_adm col-md-8">
        <p><strong> &nbsp;</strong></p>

        <div style="width:640px; float:left">	
            <form class="form-inline">
                <fieldset>
                    <legend>Reporte de Usuario por Pais y lecciones aprobadas</legend>
                    <div class="form-group">
                        <label>Pais:</label>
                        <select class="form-control" id="pais" name="pais">
                            <option value="">Seleccione</option>
                            <?php
                            if (!(isset($bd))) {
                                require_once('clases/db.class.php');
                                $bd = new db;
                            }
                            $sql = $bd->consulta("select * from pais");
                            while ($consulta = $bd->sig_reg($sql)) {
                                ?>
                                <option value="<?= $consulta['id_pais'] ?>"><?= $consulta['nombre'] ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <input class="btn btn-primary" type="submit" name="buscar" value="Buscar" />  
                    <input type="hidden" name="lugar" value="<?php echo $_GET['lugar']; ?>"/>   
                </fieldset>
            </form>
        </div>

        <?php
        if ((isset($_POST['buscar']) && $_POST['buscar'] ) && (isset($_POST['pais']) && $_POST['pais']) || (isset($_GET['pais']) && $_GET['pais'])) {
            $lugar_value = 'reporte_lec_aprobadas_estado';
            include('lista_usuarios_lecciones_estado.php');
        }
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