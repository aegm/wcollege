<?php
if (isset($_SESSION['wc']['nivel']) && ($_SESSION['wc']['nivel'] == 'E')) {
    ?>  
    <div class="col-md-4">
        <div class="panel panel-danger">
            <div class="panel-heading">
                <h3 class="panel-title">Perfil de Usuario</h3>
            </div>
            <div class="panel-body">
                <ul class="list-group">
                    <li class="list-group-item"><a href="inicio.php?lugar=datos_personales"><span>Datos personales</span></a></li>
                    <!--li class="list-group-item"><a href="inicio.php?lugar=comprobantes"><span>Comprobantes</span></a></li-->
                    <li class="list-group-item"><a href="inicio.php?lugar=usuario_evaluaciones"><span>Evaluación escrita</span></a></li>
                    <li class="list-group-item"><a href="inicio.php?lugar=videos_situacionales"><span>Evaluacion en video</span></a></li>
                    <li class="list-group-item"><a href="inicio.php?lugar=servicios"><span>Servicios</span></a></li>
                </ul>
            </div>
            <div class="panel-footer"></div>
        </div>
    </div> 

    <?php
} else {
    echo('Error, este usuario no tiene acceso al modulo Perfil de usuario');
}
?>	