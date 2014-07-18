<?php
if (isset($_SESSION['wc']['nivel']) && ($_SESSION['wc']['nivel'] == 'E' )) {
    if (!(isset($bd))) {
        require_once('clases/db.class.php');
        $bd = new db;
    }
    include('perfil_central.php');
    $contrato = $_SESSION['wc']['usuario'];
    $_SESSION['wc']['usuario'];

    $sql = $bd->consulta("SELECT * FROM usuarios where contrato = '$contrato'");
    $usuario = $bd->sig_reg($sql);
    $usuario['leccion_aprobada'];

    $vencimiento = substr($usuario['vencimiento'], 8, 2) . '-';
    $vencimiento.=substr($usuario['vencimiento'], 5, 2) . '-';
    $vencimiento.=substr($usuario['vencimiento'], 0, 4);
    ?>
    <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 toppad" >


        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <?php echo $usuario['nombre'] . ' ' . $usuario['apellido'] ?>
                </h3>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-3 col-lg-3 " align="center"> <img alt="User Pic" src="https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=100" class="img-circle"> </div>

                    <!--<div class="col-xs-10 col-sm-10 hidden-md hidden-lg"> <br>
                      <dl>
                        <dt>DEPARTMENT:</dt>
                        <dd>Administrator</dd>
                        <dt>HIRE DATE</dt>
                        <dd>11/12/2013</dd>
                        <dt>DATE OF BIRTH</dt>
                           <dd>11/12/2013</dd>
                        <dt>GENDER</dt>
                        <dd>Male</dd>
                      </dl>
                    </div>-->
                    <div class=" col-md-9 col-lg-9 "> 
                        <table class="table table-user-information">
                            <tbody>
                                <tr>
                                    <td>Contrato:</td>
                                    <td><?php echo $usuario['contrato'] ?></td>
                                </tr>
                                <tr>
                                    <td>Cedula:</td>
                                    <td><?php echo $usuario['cedula'] ?></td>
                                </tr>
                                <tr>
                                    <td>Nombre y Apellido</td>
                                    <td><?php echo $usuario['nombre'] . ' ' . $usuario['apellido']; ?></td>
                                </tr>

                                <tr>
                                <tr>
                                    <td>Sexo</td>
                                    <td><?php echo $usuario['sexo'] ?></td>
                                </tr>
                                <tr>
                                    <td>Fecha Vencimiento Contrato</td>
                                    <td><?php echo $vencimiento ?></td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td><a href=""><?php echo $usuario['email'] ?></a></td>
                                </tr>
                            <td>Lecciones Aprobadas</td>
                            <td><?php echo $usuario['leccion_aprobada']; ?>
                            </td>

                            </tr>

                            </tbody>
                        </table>

                        <!--a href="#" class="btn btn-primary">My Sales Performance</a>
                        <a href="#" class="btn btn-primary">Team Sales Performance</a-->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div style="clear: both;"></div>





    <?php
} else {
    echo('Error, este usuario no tiene acceso al modulo Perfil de usuario');
}
?>	