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
<?php
if (isset($_SESSION['wc']['nivel']) && ($_SESSION['wc']['nivel'] == 'a' || $_SESSION['wc']['nivel'] == 's' || $_SESSION['wc']['nivel'] == 'p')) {
    include('administrador_central.php');
    ?>	
    <div class="col-md-9">


        <form action="inicio.php" method="post">
            <fieldset>
                <legend>Modificar Usuario</legend>
                <div class="form-group"> 
                    <label>
                        Contrato:
                    </label>    
                    <input class="form-control" type="text" name="contrato" value="<?php
                    if (isset($_GET['contrato']) && $_GET['contrato']) {
                        echo $_GET['contrato'];
                    }
                    ?>" />

                </div>
                <div class="form-group"> 
                    <input class="btn btn-default" type="submit" name="buscar" value="Buscar"/>
                </div>    
                <input type="hidden" name="lugar" value="<?php echo $_GET['lugar']; ?>" />
            </fieldset>
        </form>
        <?php
        // $lugar_value='modificar_usuario';
        //include('tabla.php');


        if (isset($_POST['modificar']) && $_POST['modificar']) {
            if (!(isset($bd))) {
                require_once('clases/db.class.php');
                $bd = new db;
            }
            if ($_SESSION['wc']['nivel'] <> 'p') {
                $vencimiento = substr($_POST['vencimiento'], 6, 4) . '-';
                $vencimiento.=substr($_POST['vencimiento'], 3, 2) . '-';
                $vencimiento.=substr($_POST['vencimiento'], 0, 2);

                if (isset($_POST['nivel']) && ($_POST['nivel'] == 'E')) {
                    $bd->consulta("UPDATE usuarios SET 
                                                                           cedula = '$_POST[cedula]', 
                                                                           nombre = '$_POST[nombre]', 
                                                                           apellido = '$_POST[apellido]', 
                                                                           sexo = '$_POST[sexo]', 
                                                                           nivel = '$_POST[nivel]', 
                                                                           vencimiento = '$vencimiento', 
                                                                           email = '$_POST[email]',
                                                                           clave = '$_POST[clave]', 
                                                                           activo = '$_POST[activo]', 
                                                                           estado = '$_POST[estado]', 
                                                                           ciudad = '$_POST[ciudades]',
                                                                           leccion_aprobada= '$_POST[leccion_aprobada]'
                                                                           WHERE contrato = '$_POST[contrato2]'");
                } else {
                    if (isset($_POST['nivel']) && ($_POST['nivel'] == 'a')) {
                        $bd->consulta("UPDATE usuarios SET 
                                                                           cedula = '$_POST[cedula]', 
                                                                           nombre = '$_POST[nombre]', 
                                                                           apellido = '$_POST[apellido]', 
                                                                           sexo = '$_POST[sexo]', 
                                                                           nivel = 'a', 
                                                                           vencimiento = NULL, 
                                                                           email = '$_POST[email]',
                                                                           clave = '$_POST[clave]', 
                                                                           activo = '$_POST[activo]', 
                                                                           estado = '$_POST[estado]', 
                                                                           ciudad = '$_POST[ciudades]',
                                                                           leccion_aprobada= '$_POST[leccion_aprobada]'
                                                                           WHERE contrato = '$_POST[contrato2]'");
                    } else {
                        $bd->consulta("UPDATE usuarios SET 
                                                                           cedula = '$_POST[cedula]', 
                                                                           nombre = '$_POST[nombre]', 
                                                                           apellido = '$_POST[apellido]', 
                                                                           sexo = '$_POST[sexo]', 
                                                                           nivel = 's', 
                                                                           vencimiento = NULL, 
                                                                           email = '$_POST[email]',
                                                                           clave = '$_POST[clave]', 
                                                                           activo = 'S', 
                                                                           estado = '$_POST[estado]', 
                                                                           ciudad = '$_POST[ciudades]',
                                                                           leccion_aprobada= '$_POST[leccion_aprobada]'
                                                                           WHERE contrato = '$_POST[contrato2]'");
                    }
                }
                $bd->consulta("UPDATE email_recomendados SET 
                                                                           telefonop = '$_POST[telefonop]', 
                                                                           email = '$_POST[email]', 
                                                                           telefonor1 = '$_POST[telefonor1]', 
                                                                           email1 = '$_POST[email1]', 
                                                                           email2 = '$_POST[email2]', 
                                                                           email3 = '$_POST[email3]'															   
                                                                           WHERE contrato = '$_POST[contrato2]'");
            } else {
                $bd->consulta("UPDATE usuarios SET 
                                                                           leccion_aprobada= '$_POST[leccion_aprobada]'
                                                                           WHERE contrato = '$_POST[contrato2]'");
            }
            /* if($sql){
              echo ('Datos modificados con exito');
              }else{
              echo ('Error');
              } */
        }
        ?>


        <form action="inicio.php?lugar=modificar_usuario" method="post" onsubmit="MM_validateForm('data', '', 'R', 'cedula', '', 'R', 'nombre', '', 'R', 'apellido', '', 'R', 'sexo', '', 'R', 'leccion_aprobada', '', 'R', 'clave', '', 'RisNum');
                    return document.MM_returnValue" >
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
                          if ($sql2 && $sql3) {
                              $usuario = $bd->sig_reg($sql2);
                              $usuario2 = $bd->sig_reg($sql3);
                              if (!(isset($usuario) && $usuario['contrato']))
                                  echo('No se encontro ningun registro correspondiente al contrato suministrado');
                          }else {
                              echo('No se encontro ningun registro correspondiente al contrato suministrado');
                          }
                      }
                      if (isset($usuario) && $usuario['contrato']) {
                          if (($_SESSION['wc']['nivel'] == 's') || (isset($_SESSION['wc']['nivel']) && ($_SESSION['wc']['nivel'] == 'a' || ($_SESSION['wc']['nivel'] == 'p' && $usuario['nivel'] <> 'p')) && $usuario['nivel'] <> 's' && $usuario['nivel'] <> 'a')) {
                              ?>

                        <div id="formulario_adm">

                            <div class="input_text" class="form-group">
                                <label>Contrato:</label>
                                <input class="form-control" name="contrato2"  type="text" id="contrato2" value="<?php echo $usuario['contrato'] ?>" readonly="readonly"/>
                            </div>
                            <?php
                            $vencimiento = substr($usuario['vencimiento'], 8, 2) . '-';
                            $vencimiento.=substr($usuario['vencimiento'], 5, 2) . '-';
                            $vencimiento.=substr($usuario['vencimiento'], 0, 4);
                            ?>
                            <div class="form-group"> 
                                <label>Vencimiento:</label>
                                <input class="form-control" type="text" id="data" name="vencimiento" readonly="readonly" value="<?php echo $vencimiento ?>"/><br/>
                               
                        <div class="form-group">
                            <label>C.I.:</label>
                            <input class="form-control" name="cedula"  type="text" id="cedula" value="<?php echo $usuario['cedula'] ?>" <?php if ($_SESSION['wc']['nivel'] == 'p') { ?>readonly="readonly"<?php } ?>/></div>
                        <div class="form-group">
                            <label>Nombre:</label>
                            <input name="nombre" class="form-control"type="text" id="nombre" value="<?php echo $usuario['nombre'] ?>" <?php if ($_SESSION['wc']['nivel'] == 'p') { ?>readonly="readonly"<?php } ?> /></div>
                        <div class="form-group">
                            <label>Apellido:</label>
                            <input class="form-control" name="apellido"  type="text" id="apellido" value="<?php echo $usuario['apellido'] ?>" <?php if ($_SESSION['wc']['nivel'] == 'p') { ?>readonly="readonly"<?php } ?>/></div>

                        <div class="form-group"> 
                            <label>Sexo:</label>
                            M <input  type="radio" name="sexo"  value="M" <?php if (isset($usuario['sexo']) && $usuario['sexo'] == 'M') { ?>checked="chacked" <?php }if ($_SESSION['wc']['nivel'] == 'p') { ?> disabled="disabled"<?php } ?>/>
                            F  <input  type="radio" name="sexo" value="F" <?php if (isset($usuario['sexo']) && $usuario['sexo'] == 'F') { ?>checked="chacked" <?php }if ($_SESSION['wc']['nivel'] == 'p') { ?> disabled="disabled"<?php } ?>/>
                        </div>
                        <!--MODIFICADOR DEL PAIS-->
                        <div class="form-group">
                            <label>Pais:</label>
                            <select class="form-control" id="pais" name="pais">
                                <option value="">Seleccione</option>
                                <?php
                                $sql = $bd->consulta("select * from pais");
                                while ($consulta = $bd->sig_reg($sql)) {
                                    if ($consulta['id_pais'] == $usuario['pais'])
                                        $variable = "selected";
                                    else
                                        $variable = "";
                                    ?>
                                    <option value="<?= $consulta['id_pais'] ?>"<?= $variable ?>><?= $consulta['nombre'] ?></option>
                                    <?php
                                }
                                ?>
                            </select>

                        </div>  

                        <!--Estados-->
                        <div class="form-group"> 
                            <label>Estado:</label>
                            <select id="estado" name="estado" class="form-control">
                                <option value="">Seleccione</option>
                                <?php
                                $sql = $bd->consulta("select * from estados where id_pais = " . $usuario['pais']);
                                while ($consultas = $bd->sig_reg($sql)) {
                                    if ($consultas['id_estado'] == $usuario['estado'])
                                        $variable = "selected";
                                    else
                                        $variable = "";
                                    ?>
                                    <option value="<?= $consultas['id_estado'] ?>"<?= $variable ?>><?= $consultas['nombre'] ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <!--Ciudades -->
                        <div class="form-group"> 
                            <label>Ciudad:</label>
                            <select class="form-control" id="ciudades" name="ciudades">
                                <option value="">Seleccione</option>
                                <?php
                                $sql = $bd->consulta("select * from ciudades where id_estado = " . $usuario['estado']);
                                while ($consultas = $bd->sig_reg($sql)) {
                                    if ($consultas['id_ciudad'] == $usuario['ciudad'])
                                        $variable = "selected";
                                    else
                                        $variable = "";
                                    ?>
                                    <option value="<?= $consultas['id_ciudad'] ?>"<?= $variable ?>><?= $consultas['nombre'] ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>

                        <div class="form-group"> 
                            <label>Telefono Personal:</label>
                            <input class="form-control" name="telefonop"  type="text" id="telefonop" value="<?php echo $usuario2['telefonop'] ?>" <?php if ($_SESSION['wc']['nivel'] == 'p') { ?>readonly="readonly"<?php } ?>/></div>
                        <div class="form-group"> 
                            <label>E-mail Personal:</label>
                            <input class="form-control"name="email"  type="text" id="email" value="<?php echo $usuario2['email'] ?>" <?php if ($_SESSION['wc']['nivel'] == 'p') { ?>readonly="readonly"<?php } ?>/></div>
                        <?php if ($_SESSION['wc']['nivel'] <> 'p') {
                            ?>
                            <div class="form-group" > Telefono recomendado 1:
                                <input class="form-control" name="telefonor1"  type="text" id="telefonor1" value="<?php echo $usuario2['telefonor1'] ?>" <?php if ($_SESSION['wc']['nivel'] == 'p') { ?>readonly="readonly"<?php } ?>/></div>
                            <div class="form-group" > E-mail recomendado 1:
                                <input class="form-control" name="email1"  type="text" id="email1" value="<?php echo $usuario2['email1'] ?>" <?php if ($_SESSION['wc']['nivel'] == 'p') { ?>readonly="readonly"<?php } ?>/></div>
                            <div class="form-group"> E-mail recomendado 2:
                                <input class="form-control" name="email2"  type="text" id="email2" value="<?php echo $usuario2['email2'] ?>" <?php if ($_SESSION['wc']['nivel'] == 'p') { ?>readonly="readonly"<?php } ?>/></div>
                            <div class="form-group"> E-mail recomendado 3:
                                <input class="form-control" name="email3"  type="text" id="email3" value="<?php echo $usuario2['email2'] ?>" <?php if ($_SESSION['wc']['nivel'] == 'p') { ?>readonly="readonly"<?php } ?>/></div>
                        <?php } ?>
                        <div class="form-group"> 
                            <label>Lecciones Aprobadas:</label>
                            <input class="form-control" name="leccion_aprobada"  type="text" id="leccion_aprobada" value="<?php echo $usuario['leccion_aprobada'] ?>"/></div><br/>
                        <?php if ($_SESSION['wc']['nivel'] <> 'p') {
                            ?>
                            <?php if ($usuario['nivel'] <> 's') { ?>
                                <div class="input_text"> 
                                    <input  type="radio" name="nivel" checked="checked" value="E" />Estaudiante 
                                    <input  type="radio" name="nivel" value="p" <?php if ($usuario['nivel'] == 'p') { ?>checked="chacked" <?php } ?>/> Profesor
                                    <input  type="radio" name="nivel" value="a"<?php if ($usuario['nivel'] == 'a') { ?>checked="chacked" <?php } ?>/>Administrador
                                </div>
                            <?php } ?>
                            <br/>
                            <div class="form-group" style="padding-top:25px;"> Clave:
                                <input class="form-control" name="clave" type="text" id="clave" value="<?php echo $usuario['clave'] ?>"/></div>
                            <?php if ($usuario['nivel'] <> 's') {
                                ?>    
                                <div class="input_text"> Activo:
                                    <input  type="radio" name="activo" value="S" <?php
                                    if ($usuario['activo'] == 'S' || $usuario['activo'] == 's') {
                                        $s = true;
                                        ?>checked="checked" <?php } ?>/></div>
                                <div class="input_text"> Inactivo:
                                    <input  type="radio" name="activo" value="N" <?php if (!isset($s)) { ?>checked="checked" <?php } ?>/></div>
                                <?php
                            }
                        }
                        ?>   
                            <div class="form-group" ><input class="btn btn-primary" type="submit" name="modificar" value="Aceptar" /></div>


                        <?php
                    } else
                        echo ('Por motivos de seguridad, el usuario seleccionado no puede ser modificado');
                }
                ?> </div>	  
            <?php
        }
        ?>
    <input type="hidden" name="lugar" value="<?php echo $_GET['lugar']; ?>" />

    </form>
    <?php
    $lugar_value = 'modificar_usuario';
    include('tabla.php');
    ?>




    </div>
    <?php
}else {
    echo('Error, este usuario no tiene acceso al modulo Administrativo');
}
?>	