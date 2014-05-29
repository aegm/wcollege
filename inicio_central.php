<?php
//print_r($_SESSION);
require_once('clases/db.class.php');
$bd = new db();
if (isset($_SESSION['wc']['session'])) {
    $usr = $_SESSION['wc']['usuario'];
    $sql = $bd->consulta("select * from usuarios where contrato = '$usr'");
    $valor = $bd->sig_reg($sql);
    if ($valor['email'] == null || $valor['email'] == '') {
        $nombre = $valor['nombre'];
        $apellido = $valor['apellido'];
        $usr = $valor['contrato'];
        echo '<div id="myModal" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <a class="" data-dismiss="modal">
                            <img src="images/logoWEC.png">
                        </a>
                    </div>    
                    <div class="modal-body">
                        <h4 class="">BIENVENIDO ' . $nombre . ' ' . $apellido . '</h4>
                        <form action="form_process.php" method="POST">
                            <fieldset>
                                <legend>
                                    Completa tu registro en el siguiente Formulario
                                </legend>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input name ="txt_correo" class="form-control">
                                </div>
                                <input type="hidden" name="form" value="primera-vez" />
                                <input type="hidden" name="usuario" value="<?php echo $usr; ?>" />
                                <div class="form-group">
                                    <input type="submit" class="btn btn-primary" />
                                </div>

                            </fieldset>
                        </form>
                    </div>
                    <div class="modal-footer">

                    </div>

                </div><!-- /.modal-content -->
            </div>
        </div>';
    }
} else {
    echo '<div id="myModal" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <a class="" data-dismiss="modal">
                        <img src="images/logoWEC.png">
                    </a>
                </div>
                <div class="modal-body">
                    <h4 class="">Nueva Interfaz</h4>
                    <p>Bienvenidos a Washington English College hemos realizdo algunos cambios para brindarte una mejor experiencia educativa.</p>
                    <p>Para Cualquier información o consulta ingresa al chat que se encuentra en la parte superior derecha. </p>
                </div>
                <div class="modal-footer">
                    <div class="btn-group">
                        <button class="btn btn-danger" data-dismiss="modal">Continuar</button>
                    </div>
                </div>

            </div><!-- /.modal-content -->
        </div>
    </div>';
}
?>

<div class="container">
    <div class="slider flexslider">
        <ul class="slides">
            <li>
                <img src="images/slide-3.jpg" />
                <p class="flex-caption">
                    <span class="main">Capacitacion profesional Bilingüe</span>
                    <br>
                    <span class="secondary clearfix">
                        Washington English College te brinda la oportunidad de ser un profesional Bilingüe. 
                    </span>
                </p>
            </li>
            <li>
                <img src="images/chat.jpg" />
                <p class="flex-caption">
                    <span class="main">Estudia desde la Comodidad de Tu Casa</span>
                    <br>
                    <span class="secondary clearfix">Aprende Inglés desde la comodidad de tu casa, Práctico, Fácil y Divertido </span>
                </p>
            </li>
        </ul>
    </div>
    <!--Flexslider-->
    <section class="aula-virtual box box-dark">
        <div class="col-md-9">
            <h1 class="section-heading">Aula Virtual</h1>
            <p>Convierte en un Profesional Bilingüe desde la comodidad de tu casa 
                Ingresa Ahora al Sistema o contactanos para mayor Información la educacion del futuro en Tus Manos  </p>
        </div>
        <div class="col-md-3">
            <?php
            if (isset($_SESSION['wc']['usuario']) && $_SESSION['wc']['usuario'] != 'admin') {

                $persona = $_SESSION['wc']['usuario'];
                $buscar = $bd->consulta("select id from v_user_aula u, vcursos c where contrato = '$persona' and u.aula = c.Libro")or die("Asd");
                $consultar = $bd->sig_reg($buscar);
                //print_r($consulta);
                $curso = $consultar[id];

                $verficar = $bd->consulta("select * from inscripcion_curso i, vcurso_activo c where i.id_persona = '$persona' and i.id_curso = '$curso' and i.id_curso = c.id_curso");
                if ($bd->num_filas($verficar)) {
                    //$usr = $bd->sig_reg($sql);
                    if ($usr) {
                        switch ($curso) {
                            case '5':
                                echo '<a class="btn btn-cta" href="connect.php?nivel=1"><i class="fa fa-play-circle"></i> Ingresar Ahora. </a>';
                                break;
                            case '6':
                                echo '<a class="btn btn-cta" href="connect.php?nivel=2"><i class="fa fa-play-circle"></i> Ingresar Ahora. </a>';
                                break;
                            case '7';
                                echo '<a class="btn btn-cta" href="connect.php?nivel=3"><i class="fa fa-play-circle"></i> Ingresar Ahora. </a>';
                                break;
                        }
                    }
                } else {
                    $sql = $bd->consulta("select * from  vcursos where id = '$curso'");
                    $curso = $bd->sig_reg($sql);
                    $id = $curso['id'];
                    $pais = $curso['pais'];

                    echo '<a class="btn btn-cta" onclick="inscribir(' . $persona . ',' . $id . ',' . $pais . ')"><i class="fa fa-play-circle"></i> Inscribirse Ahora. </a>';
                }
            }
            ?>
        </div>
    </section>
    <!--Aula Virtual-->
    <section class="news">
        <h1 class="section-heading"><span class="line">Ultimas Noticias</span></h1>
        <div class="carousel carousel-control">
            <a class="prev" href="#news-carousel" data-slide="prev"><i class="fa fa-caret-left"></i></a>
            <a class="next" href="#news-carousel" data-slide="next"><i class="fa fa-caret-right"></i></a> 
        </div>
        <div class="section-content clearfix">
            <div id="news-carousel" class="news-carousel carousel slide">
                <div class="carousel-inner">
                    <div class="item active"> 
                        <div class="col-md-6 news-item">
                            <h2 class="title"><a href="news-single.html">Clases Online!</a></h2>
                            <p>Bienvenidos a Washington English College esta nueva interfaz te brindara una mejor experiencia y asi puedas alcanzar tus objetivos como profesional Bilingue .</p>
                            <!--a class="read-more" href="#">Leer Mas <i class="fa fa-chevron-right"></i></a-->
                            <img class="thumb" src="images/principal.png" alt="" style="width: 160px; height: 125px;">
                        </div><!--//news-item-->
                        <div class="col-md-6 news-item">
                            <h2 class="title"><a href="news-single.html">Videos Online</a></h2>
                            <object class="thumb" id="player" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" name="player" width="160" height="134">
                                <param name="movie" value="player.swf">
                                <param name="allowfullscreen" value="true">
                                <param name="allowscriptaccess" value="always">
                                <param name="flashvars" value="file=bienvenida.flv&amp;image=preview.jpg&amp;controlbar=none">
                                <embed type="application/x-shockwave-flash" id="player2" name="player2" src="player.swf" width="160" height="134" allowscriptaccess="always" allowfullscreen="true" flashvars="file=bienvenida.flv&amp;image=preview.jpg&amp;controlbar=none">
                            </object>
                            <p>Para facilitarte el acceso a nuestras clases en el lugar y el momento que quieras desde la comodidad de tu computadora.</p>
                            <!--a class="read-more" href="#">Leer Mas <i class="fa fa-chevron-right"></i></a-->                
                        </div><!--//news-item-->

                        <!--//news-item-->
                    </div><!--//item-->
                    <!--//item-->
                </div><!--//carousel-inner-->
            </div><!--//news-carousel-->  
        </div>
    </section>
    <!-- //News -->
    <div class="col-md-12">
        <section class="awards">
            <div class="items">
                <ul class="logos">
                    <li class="col-md-4 col-sm-2 col-xs-4"><img src="images/logos/Logo-01g.jpg" ></li>
                    <li class="col-md-4 col-sm-2 col-xs-4"><img src="images/logos/Logo-solog.jpg"></li>
                    <li class="col-md-4 col-sm-2 col-xs-4"><img src="images/logos/LogowSchoolg.jpg"></li>
                </ul>
            </div>
        </section>
    </div>    
    <!-- //Awards -->
</div>