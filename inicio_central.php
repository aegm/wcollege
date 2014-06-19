<div id="promo-slider" class="slider flexslider">
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
    </ul><!--//slides-->
</div><!--//flexslider-->
<section class="promo box box-dark">        
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
            $curso = $consultar['id'];
            
            $verficar = $bd->consulta("select * from inscripcion_curso i, vcurso_activo c where i.id_persona = '$persona' and i.id_curso = '$curso' and i.id_curso = c.id_curso");
            if ($bd->num_filas($verficar)) {
                //$usr = $bd->sig_reg($sql);
                if (isset($persona) && isset($_SESSION['wc']['usuario'])) {
                    //echo $persona;
                    switch ($curso) {
                        case '5':
                            echo '<a data-step="3" data-intro="Presiona click e Ingresa al aula virtual" class="btn btn-cta" href="connect.php?nivel=1"><i class="fa fa-play-circle"></i> Ingresar Ahora. </a>';
                            break;
                        case '6':
                            echo '<a data-step="3" data-intro="Presiona click e Ingresa al aula virtual"class="btn btn-cta" href="connect.php?nivel=2"><i class="fa fa-play-circle"></i> Ingresar Ahora. </a>';
                            break;
                        case '7';
                            echo '<a data-step="3" data-intro="Presiona click e Ingresa al aula virtual"class="btn btn-cta" href="connect.php?nivel=3"><i class="fa fa-play-circle"></i> Ingresar Ahora. </a>';
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
</section><!--//promo-->
<section class="news">
    <h1 class="section-heading text-highlight"><span class="line">Ultimas Noticias</span></h1>     
    <div class="carousel-controls">
        <a class="prev" href="#news-carousel" data-slide="prev"><i class="fa fa-caret-left"></i></a>
        <a class="next" href="#news-carousel" data-slide="next"><i class="fa fa-caret-right"></i></a>
    </div><!--//carousel-controls--> 
    <div class="section-content clearfix">
        <div id="news-carousel" class="news-carousel carousel slide">
            <div class="carousel-inner">
                <div class="item active"> 
                    <div class="col-md-4 news-item">
                        <h2 class="title"><a href="inicio.php?lugar=noticiasuni">Clases Online!</a></h2>
                        <img class="thumb" src="images/noticias/news-thumb-6.jpg" alt="">
                        <p>Bienvenidos a Washington English College esta nueva interfaz te brindara una mejor experiencia y asi puedas alcanzar tus objetivos como profesional Bilingue .</p>
                        <a class="read-more" href="inicio.php?lugar=noticiasuni">Leer Mas <i class="fa fa-chevron-right"></i></a>
                    </div><!--//news-item-->
                    <div class="col-md-4 news-item">
                        <h2 class="title"><a href="inicio.php?lugar=como">Videos Online</a></h2>
                        <p>Para facilitarte el acceso a nuestras clases en el lugar y el momento que quieras desde la comodidad de tu computadora.</p>
                        <a class="read-more" href="inicio.php?lugar=como">Leer Mas<i class="fa fa-chevron-right"></i></a>
                        <img class="thumb" src="images/noticias/news-thumb-2.jpg" alt="">
                    </div><!--//news-item-->
                    <div class="col-md-4 news-item">
                        <h2 class="title"><a href="inicio.php?lugar=beneficio">Beneficios de la Educación Online</a></h2>
                        <p>El beneficio más evidente de la educación virtual reside en que brinda a estudiantes y profesores mucho más tiempo y flexibilidad en términos de plazos y desplazamientos. </p>
                        <a class="read-more" href="inicio.php?lugar=beneficio">Leer Mas<i class="fa fa-chevron-right"></i></a>
                        <img class="thumb" src="images/noticias/news-thumb-1.jpg" alt="">
                    </div><!--//news-item-->
                </div><!--//item-->
            </div><!--//carousel-inner-->
        </div><!--//news-carousel-->  
    </div><!--//section-content-->     
</section><!--//news-->
<div class="row cols-wrapper">
    <div class="col-md-3">
        <section class="events">
            <h1 class="section-heading text-highlight"><span class="line">Eventos</span></h1>
            <div class="section-content">
                <div class="event-item">
                    <p class="date-label">
                        <span class="month">JUN</span>
                        <span class="date-number">16</span>
                    </p>
                    <div class="details">
                        <h2 class="title">Inicio de Semana Wcollege  </h2>
                        <p class="time"><i class="fa fa-clock-o"></i>09:00am - 18:00pm</p>
                        <p class="location"><i class="fa fa-map-marker"></i>Aula Virtual</p>                            
                    </div><!--//details-->
                </div><!--event-item-->  
                <!--a class="read-more" href="events.html">All events<i class="fa fa-chevron-right"></i></a-->
            </div><!--//section-content-->
        </section><!--//events-->
    </div><!--//col-md-3-->
    <div class="col-md-6">
        <!--section class="course-finder">
            <h1 class="section-heading text-highlight"><span class="line">Course Finder</span></h1>
            <div class="section-content">
                <form class="course-finder-form" action="#" method="get">
                    <div class="row">
                        <div class="col-md-5 col-sm-5 subject">
                            <select class="form-control subject">
                                <option>Choose a subject area</option>
                                <option>Accounting &amp; Finance</option>
                                <option>Biological Sciences</option>
                                <option>Business Studies</option>
                                <option>Computer Science</option>
                                <option>Creative Arts &amp; Media</option>
                                <option>Drama</option>
                                <option>Education</option>
                                <option>Engineering</option>
                                <option>Film Studies</option>
                                <option>Fitness Training</option>
                                <option>Hospitality</option>
                                <option>History</option>
                                <option>International Relations</option>
                                <option>Law</option>
                                <option>Mathematics</option>
                                <option>Music</option>
                                <option>Physics</option>
                                <option>Religion</option>
                                <option>Social Science</option>
                            </select>
                        </div> 
                        <div class="col-md-7 col-sm-7 keywords">
                            <input class="form-control pull-left" type="text" placeholder="Search keywords">
                            <button type="submit" class="btn btn-theme"><i class="fa fa-search"></i></button>
                        </div> 
                    </div>                     
                </form><!--//course-finder-form-->
                <!--a class="read-more" href="courses.html">View all our courses<i class="fa fa-chevron-right"></i></a>
            </div><!--//section-content-->
        <!--/section--><!--//course-finder-->
        <section class="video">
            <h1 class="section-heading text-highlight"><span class="line">Video Tour</span></h1>
            <div class="carousel-controls">
                <a class="prev" href="#videos-carousel" data-slide="prev"><i class="fa fa-caret-left"></i></a>
                <a class="next" href="#videos-carousel" data-slide="next"><i class="fa fa-caret-right"></i></a>
            </div><!--//carousel-controls-->
            <div class="section-content">    
                <div id="videos-carousel" class="videos-carousel carousel slide">
                    <div class="carousel-inner">
                        <div class="item active">
                            <iframe class="video-iframe" src="//www.youtube.com/embed/Mc76aNT3owE?rel=0&amp;wmode=transparent" frameborder="0" allowfullscreen=""></iframe>
                        </div><!--//item-->
                        <div class="item">            
                            <iframe class="video-iframe" src="//www.youtube.com/embed/dyKYWt6ESXc?rel=0&amp;wmode=transparent" frameborder="0" allowfullscreen=""></iframe>
                        </div><!--//item-->
                        <div class="item">            
                            <iframe class="video-iframe" src="//www.youtube.com/embed/m-AMW1oP11A?rel=0&amp;wmode=transparent" frameborder="0" allowfullscreen=""></iframe>
                        </div><!--//item-->
                    </div><!--//carousel-inner-->
                </div><!--//videos-carousel-->                            
                <p class="description">la musica se ha comenzado a introducir en la educacion de los ninos de preescolar. ¿cuales son los beneficios de las canciones infantiles? los beneficios de las canciones infantiles son variados, entre estos podemos resaltar a los siguientes:
                    estimulan el desarrollo intelectual, 
                </p>
                <ul>
                    <li>Estimulan el desarrollo intelectual, auditivo, sensorial, del habla y motriz de los pequeños</li>
                    <li>Incrementan las habilidades de escuchar, memorizar y concentrarse.</li>
                    <li>Alimentan a la imaginación y creatividad de los niños.</li>
                    <li>Potencian la sociabilidad, haciendo que los pequeños se relacionen de mejor forma con sus pares.</li>
                </ul>
            </div><!--//section-content-->
        </section><!--//video-->
    </div>
    <div class="col-md-3">
        <section class="links">
            <h1 class="section-heading text-highlight"><span class="line">Enlaces Rapidos</span></h1>
            <div class="section-content">
                <p><a href="#"><i class="fa fa-caret-right"></i>Donde Estamos</a></p>
                <p><a href="inicio.php?lugar=galeria"><i class="fa fa-caret-right"></i>Galleria</a></p>
                <p><a href="inicio.php?lugar=contacto"><i class="fa fa-caret-right"></i>Contacto</a></p>
            </div><!--//section-content-->
        </section><!--//links-->
        <section class="testimonials">
            <h1 class="section-heading text-highlight"><span class="line"> Testimonios</span></h1>
            <div class="carousel-controls">
                <a class="prev" href="#testimonials-carousel" data-slide="prev"><i class="fa fa-caret-left"></i></a>
                <a class="next" href="#testimonials-carousel" data-slide="next"><i class="fa fa-caret-right"></i></a>
            </div><!--//carousel-controls-->
            <div class="section-content">
                <div id="testimonials-carousel" class="testimonials-carousel carousel slide">
                    <div class="carousel-inner">
                        <div class="item">
                            <blockquote class="quote">                                  
                                <p><i class="fa fa-quote-left"></i>Estoy muy contenta Washington English college me brinda la posiblidad de capacitarme aprovechando la posibilidad y beneficios que 
                                nos brinda la internet, y asi aprender Ingles desde la comodidad de nuestro Hogar.</p>
                            </blockquote>                
                            <div class="row">
                                <p class="people col-md-8 col-sm-3 col-xs-8"><span class="name">Maria Rodriguez</span><br></p>
                                <img class="profile col-md-4 pull-right" src="images/testimonios/profile-1.png" alt="">
                            </div>                               
                        </div><!--//item-->
                        <div class="item active">
                            <blockquote class="quote">
                                <p><i class="fa fa-quote-left"></i>
                                    Washington English College, se ha mantenido a la vanguardia de educación a traves de la internet, trabajando a diario para ofrecernos las mejores herramientas para aprender de manera facil, rapida y comoda.</p>
                            </blockquote>
                            <div class="row">
                                <p class="people col-md-8 col-sm-3 col-xs-8"><span class="name">Marco Antonio</span><br></p>
                                <img class="profile col-md-4 pull-right" src="images/testimonios/profile-2.png" alt="">
                            </div>                 
                        </div><!--//item-->

                    </div><!--//carousel-inner-->
                </div><!--//testimonials-carousel-->
            </div><!--//section-content-->
        </section><!--//testimonials-->
    </div><!--//col-md-3-->
</div><!--//cols-wrapper-->
<section class="awards">
    <div id="awards-carousel" class="awards-carousel carousel slide">
        <div class="carousel-inner">
            <div class="item active">
                <ul class="logos">
                    <li class="col-md-4 col-sm-2 col-xs-4">
                        <a href="#"><img class="img-responsive" src="images/logos/wcollege_new.jpg" alt=""></a>
                    </li>
                    <li class="col-md-4 col-sm-2 col-xs-4">
                        <a href="#"><img class="img-responsive" src="images/logos/kids_new.jpg" alt=""></a>
                    </li>
                    <li class="col-md-4 col-sm-2 col-xs-4">
                        <a href="#"><img class="img-responsive" src="images/logos/school_new.jpg" alt=""></a>
                    </li>          
                </ul><!--//slides-->
            </div><!--//item-->
        </div><!--//carousel-inner-->
        <a class="left carousel-control" href="#awards-carousel" data-slide="prev">
            <i class="fa fa-angle-left"></i>
        </a>
        <a class="right carousel-control" href="#awards-carousel" data-slide="next">
            <i class="fa fa-angle-right"></i>
        </a>

    </div>
</section>
