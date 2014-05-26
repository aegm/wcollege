
<?php
if (isset($_SESSION['wc']['nombre']) && ($_SESSION['wc']['nivel'] == 'a' || $_SESSION['wc']['nivel'] == 's')) {
    include('administrador_central.php');
    ?>
    <script type="text/javascript">
    <!--
        function MM_validateForm() { //v4.0
            if (document.getElementById) {
                var i, p, q, nm, test, num, min, max, errors = '', args = MM_validateForm.arguments;
                for (i = 0; i < (args.length - 2); i += 3) {
                    test = args[i + 2];
                    val = document.getElementById(args[i]);
                    if (val) {
                        nm = val.name;
                        if ((val = val.value) != "") {
                            if (test.indexOf('isEmail') != -1) {
                                p = val.indexOf('@');
                                if (p < 1 || p == (val.length - 1))
                                    errors += '- ' + nm + ' must contain an e-mail address.\n';
                            } else if (test != 'R') {
                                num = parseFloat(val);
                                if (isNaN(val))
                                    errors += '- ' + nm + ' must contain a number.\n';
                                if (test.indexOf('inRange') != -1) {
                                    p = test.indexOf(':');
                                    min = test.substring(8, p);
                                    max = test.substring(p + 1);
                                    if (num < min || max < num)
                                        errors += '- ' + nm + ' must contain a number between ' + min + ' and ' + max + '.\n';
                                }
                            }
                        } else if (test.charAt(0) == 'R')
                            errors += '- ' + nm + ' is required.\n';
                    }
                }
                if (errors)
                    alert('The following error(s) occurred:\n' + errors);
                document.MM_returnValue = (errors == '');
            }
        }
    //-->
    </script>
    <div class="col-md-8">
        <?php
        $error = 0;
        if (!(isset($bd))) {
            require_once('clases/db.class.php');
            $bd = new db;
        }

        if ($_GET['estatus'] == "registrado") {
            $sql = $bd->consulta("SELECT * FROM usuarios WHERE contrato = '$_GET[contrato]'");
            if ($linea = $bd->sig_reg($sql)) {
                $contrato = $_GET[contrato];
                $clave = $linea['clave']
                        ?>
                <script type="text/javascript">
                    alert("Usuario Agregado con Exito, CLAVE: <?php echo $clave; ?> ");
                </script>
               
                <?php
                $error = 1;
            }



            if ($error == 0) {

                $vencimiento = substr($_POST['vencimiento'], 6, 4) . '-';
                $vencimiento.=substr($_POST['vencimiento'], 3, 2) . '-';
                $vencimiento.=substr($_POST['vencimiento'], 0, 2);

                $keygen = ($_POST['contrato'] / 2 + intval($_POST['contrato'] / 3.3)) / 2;
                $keygen = intval($keygen);


                $bd->consulta("INSERT INTO usuarios (contrato,cedula,nombre,apellido,sexo,nivel,vencimiento,clave,activo,estado,ciudad,leccion_aprobada,pais) VALUES ('$_POST[contrato]','$_POST[cedula]','$_POST[nombre]','$_POST[apellido]','$_POST[sexo]','$_POST[nivel]','$vencimiento','$keygen','$_POST[activo]','$_POST[estado]','$_POST[ciudad]','$_POST[leccion_aprobada]','$_POST[pais]')");
                ?>
                <script type="text/javascript">
                    alert("Usuario Agregado con Exito, CLAVE: <?php echo $keygen; ?> ");
                </script>
                <?php
                unset($_POST['cedula']);
                unset($_POST['contrato']);
                unset($_POST['nombre']);
                unset($_POST['apellido']);
                unset($_POST['sexo']);
                unset($_POST['vencimiento']);
                unset($_POST['clave']);
                unset($_POST['activo']);
                unset($_POST['cedula']);
                unset($_POST['ciudad']);
                unset($_POST['nivel']);
                unset($_POST['pais']);
            }
        }
        ?>
        <form role='form' action="form_process.php" method="post" onsubmit="MM_validateForm('cedula', '', 'RisNum', 'nombre', '', 'R', 'apellido', '', 'R', 'contrato', '', 'RisNum', 'clave', '', 'RisNum');
                return document.MM_returnValue">
            <fieldset>
                <legend>Agregar Usuario</legend>
                <div class="form-group">
                    <label>C.I.:</label>
                    <input class="form-control" name="cedula"  type="text" id="cedula" value="<?php if (isset($_POST['cedula'])) echo $_POST['cedula'] ?>" />
                </div>
                <div class="form-group">
                    <label>Nombre</label>
                    <input name="nombre" class="form-control"  type="text" id="nombre"value="<?php if (isset($_POST['nombre'])) echo $_POST['nombre'] ?>" />
                </div>
                <div class="form-group">
                    <label>Apellido</label>
                    <input name="apellido" class="form-control"  type="text" id="apellido"value="<?php if (isset($_POST['apellido'])) echo $_POST['apellido'] ?>" />
                </div>
                <div class="form-group">
                    <label>Sexo</label>
                    M <input  type="radio" name="sexo" checked="checked" value="M" />
                    F  <input  type="radio" name="sexo" value="F" <?php if (isset($_POST['sexo']) && $_POST['sexo'] == 'F') { ?>checked="chacked" <?php } ?>/>
                </div>
                <div class="form-group">
                    <label>Pais</label>

                    <select id="pais" name="pais" class="form-control">
                        <option value="">Seleccione</option> 
                        <?php
                        $sql = $bd->consulta("select * from pais");
                        while ($consulta = $bd->sig_reg($sql)) {
                            ?>
                            <option value="<?= $consulta['id_pais'] ?>"><?= $consulta['nombre'] ?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Estado</label>
                    <?php include('estados_venezuela.php'); ?>
                </div>
                <div class="form-group">
                    <label>Ciudad</label>
                    <select id="ciudades" class="form-control">
                        <option value=""> Seleccione</option>

                    </select>
                </div>
                <div class="form-group">
                    <label>Vencimiento</label>
                    <input class="form-control" type="text" id="data"   name="vencimiento" value="<?php echo (date("d") . '-' . date("m") . '-' . (date("Y") + 1)); ?>"/>
                </div>
                <div class="form-group">
                    <input  type="radio" name="nivel" checked="checked" value="E" />Estaudiante 
                    <input  type="radio" name="nivel" value="p" <?php if (isset($_POST['nivel']) && $_POST['nivel'] == 'p') { ?>checked="chacked" <?php } ?>/> Profesor
                    <?php
                    if (($_SESSION['wc']['nivel'] == 's')) {
                        ?>
                        <input  type="radio" name="nivel" value="a"<?php if (isset($_POST['nivel']) && $_POST['nivel'] == 'a') { ?>checked="chacked" <?php } ?>/>Administrador
                    <?php } ?>
                </div>
                <div class="form-group">
                    <label>Contrato</label>
                    <input class="form-control"name="contrato"  type="text" id="contrato" value="<?php if (isset($_POST['contrato'])) echo $_POST['contrato'] ?>"/>
                </div>
                <div class="form-group">
                    <label>Activo</label>
                    <input  type="radio" name="activo" checked="checked" value="S" />
                    <label>Inactivo</label>
                    <input  type="radio" name="activo" value="N" <?php if (isset($_POST['activo']) && $_POST['activo'] == 'N') { ?>checked="chacked" <?php } ?>/>
                </div>
                <input type="hidden" name="leccion_aprobada" value="0" />
                <input type="hidden" name="lugar" value="<?php echo $_GET['lugar']; ?>" />
                <input type="hidden" name="form" value="agregar-usuario" />
                <input type="submit" class="btn btn-primary" name="agregar" value="Aceptar"  />
                <?php
            } else {
                echo('Error, este usuario no tiene acceso al modulo Administrativo');
            }
            ?>	
        </fieldset>
    </form>
    <br><br>
</div>    
