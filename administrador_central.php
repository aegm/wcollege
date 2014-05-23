
<div class="col-md-3">
    <div class="panel-group" id="accordion">
        <?php if ($_SESSION['wc']['nivel'] == 's') { ?>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" class="collapsed">
                            Usuario
                        </a>
                    </h4>
                </div>
                <div id="collapseOne" class="panel-collapse collapse">
                    <div class="panel-body">
                        <table class="table">
                            <tr>
                                <td>
                                    <span class="fa fa-user"></span><a href="inicio.php?lugar=agregar_usuario"> Agregar</a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="fa fa-refresh"></span><a href="http://www.jquery2dotnet.com"> Modificar</a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="fa fa-eraser"></span><a href="http://www.jquery2dotnet.com"> Eliminar</a>
                                </td>

                        </table>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" class="collapsed">
                            Evaluación
                        </a>
                    </h4>
                </div>
                <div id="collapseTwo" class="panel-collapse collapse">
                    <div class="panel-body">
                        <table class="table">
                            <tr>
                                <td>
                                    <span class="fa fa-plus-square"></span><a href="inicio.php?lugar=nombres_evaluaciones"> Agregar Evaluación</a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="fa fa-plus-square-o"></span><a href="inicio.php?lugar=eval_desarrollo_preguntas"> Crear Pregunta</a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="fa fa-magic"></span><a href="inicio.php?lugar=evaluacion_asignar"> Asignacion Evaluación</a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="fa fa-flag"></span><a href="inicio.php?lugar=evaluacion_evaluar"> Evaluar Examen</a>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseTree" class="collapsed">
                            Reportes
                        </a>
                    </h4>
                </div>
                <div id="collapseTree" class="panel-collapse collapse">
                    <div class="panel-body">
                        <table class="table">
                            <tr>
                                <td>
                                    <span class="fa fa-users"></span><a href="inicio.php?lugar=usuario_estado&pag=1"> Usuarios</a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="fa fa-print"></span><a href="inicio.php?lugar=reporte_lec_aprobadas_estado&pag=1"> Usuarios por Pais</a>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseFour">
                            Aula Virtual
                        </a>
                    </h4>
                </div>
                <div id="collapseFour" class="panel-collapse collapse">
                    <div class="panel-body">
                        <table class="table">
                            <tr>
                                <td>
                                    <span class="fa fa-file-text-o"></span><a href="inicio.php?lugar=alum_inscrip"> Alumnos Inscritos</a>
                                </td>
                            </tr>
                            <!--tr>
                                <td>
                                    <span class="fa fa-info"></span><a href="reporte_lec_aprobadas_estado&pag=1"> Invitaciones</a>
                                </td>
                            </tr-->

                        </table>
                    </div>
                </div>
            </div>
            <!--div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseFive">
                            Administrar
                        </a>
                    </h4>
                </div>
                <div id="collapseFive" class="panel-collapse collapse">
                    <div class="panel-body">
                        <table class="table">
                            <tr>
                                <td>
                                    <span class="glyphicon glyphicon-pencil text-primary"></span><a href="http://www.jquery2dotnet.com">Agregar</a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="glyphicon glyphicon-flash text-success"></span><a href="http://www.jquery2dotnet.com">Modificar</a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="glyphicon glyphicon-file text-info"></span><a href="http://www.jquery2dotnet.com">Eliminar</a>
                                </td>

                        </table>
                    </div>
                </div>
            </div-->
            <div style="clear: both;"></div>
        <?php } ?>
    </div></div>