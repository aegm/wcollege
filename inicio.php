<?php
session_start();

require_once 'clases/db.class.php';
$bd = new db();
if (isset($_POST['lugar']) && $_POST['lugar']) {
    $_GET['lugar'] = $_POST['lugar'];
    if (isset($_POST['lecc']) && $_POST['lecc'])
        $_GET['lecc'] = $_POST['lecc'];
    else
        $_SESSION['wc']['nota_pagina'] = 0;
    if (isset($_POST['libro']) && $_POST['libro'])
        $_GET['libro'] = $_POST['libro'];
    if (isset($_POST['dir']) && $_POST['dir'])
        $_GET['dir'] = $_POST['dir'];
    if (isset($_POST['pag']) && $_POST['pag'])
        $_GET['pag'] = $_POST['pag'];
}else {
    if (!(isset($_GET['lugar']) && $_GET['lugar']))
        $_GET['lugar'] = 'inicio'; /* defino el index lugar si el usuario no ha seleccionado uno */
    if (!(isset($_GET['lecc']) && $_GET['lecc'])) {
        $_GET['lecc'] = '#'; /* defino el index lecc si el usuario no ha seleccionado uno */
        $_SESSION['wc']['nota_pagina'] = 0;
    }
    if (!(isset($_GET['libro']) && $_GET['libro']))
        $_GET['libro'] = '#';
    if (!(isset($_GET['dir']) && $_GET['dir']))
        $_GET['dir'] = '#';
    if (!(isset($_GET['pag']) && $_GET['pag']))
        $_GET['pag'] = '1';
}
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <html lang="es-ES"><!--<![endif]--><head>
            <title>Washington English College</title>
            <!-- Meta -->
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta name="description" content="Washington English College, Aprende Ingles desde la comodidad de tu tu casa es practico rapido y divertido. comienza hoy mismo.">
            <meta name="keywords" content="cómo funciona Washington English College, aprende ingles online, aprende inglés on line,  washington english college">
            <meta name="author" content="Washington English College<">    
            <link rel="shortcut icon" href="favicon.ico">  
            <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" type="text/css">   
            <!-- Global CSS -->
            <link rel="stylesheet" href="css/bootstrap.min.css">   

            <!-- Plugins CSS -->    
            <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css">
            <link rel="stylesheet" href="plugins/flexslider/flexslider.css">
            <link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/themes/start/jquery-ui.css">
            <!--link rel="stylesheet" href="assets/plugins/pretty-photo/css/prettyPhoto.css"--> 
            <link href="plugins/intro/introjs-royal.css.css" rel="stylesheet">
            <link href="plugins/intro/introjs.css" rel="stylesheet">

            <!-- Theme CSS -->  
            <link id="theme-style" rel="stylesheet" href="css/styles.css">

            <?php
            if ($_GET['lugar'] == "galeria")
                echo '<link rel="stylesheet" href="plugins/prettyPhoto/prettyPhoto.css" type="text/css" media="screen" charset="utf-8" />';
            ?>
            <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
            <!--[if lt IE 9]>
              <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
              <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
            <![endif]-->
            <script async="" src="//www.google-analytics.com/analytics.js"></script><script>
                (function(i, s, o, g, r, a, m) {
                    i['GoogleAnalyticsObject'] = r;
                    i[r] = i[r] || function() {
                        (i[r].q = i[r].q || []).push(arguments)
                    }, i[r].l = 1 * new Date();
                    a = s.createElement(o),
                            m = s.getElementsByTagName(o)[0];
                    a.async = 1;
                    a.src = g;
                    m.parentNode.insertBefore(a, m)
                })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

                ga('create', 'UA-24707561-9', '3rdwavemedia.com');
                ga('send', 'pageview');

            </script>
        </head> 

        <body class="home-page" cz-shortcut-listen="true">
            <?php
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
                                    <div class="form-group">
                                        <label>Telefono</label>
                                        <input name ="txt_telefono" class="form-control">
                                    </div>
                                    <input type="hidden" name="form" value="primera-vez" />
                                    <input type="hidden" name="usuario" value='.$usr.' />
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
            }/* else {
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
                            <p>Para Cualquier información o consulta ingresa al chat que se encuentra en la parte derecha o ingresa tus datos en el formulario de contacto. </p>
                        </div>
                        <div class="modal-footer">
                            <div class="btn-group">
                                <button class="btn btn-danger" data-dismiss="modal">Continuar</button>
                            </div>
                        </div>

                    </div><!-- /.modal-content -->
                </div>
            </div>';
            }?*/
            ?>
            <div class="wrapper">
                <!-- ******HEADER****** --> 
                <header class="header">  
                    <div class="header-main container">
                        <h1 class="logo col-md-4 col-sm-4">
                            <a href="index.html">
                                <img id="logo" src="images/logos/Logo-01.jpg" alt="Logo">
                                </h1><!--//logo-->           
                                <div class="info col-md-8 col-sm-8">
                                    <ul class="menu-top navbar-right hidden-xs">
                                        <li class="divider"><a id="where">Donde estamos</a></li>
                                        <li class="divider"><a href="inicio.php?lugar=galeria">Galeria</a></li>
                                        <li><a href="inicio.php?lugar=contacto">Contactanos</a></li>
                                    </ul><!--//menu-top-->
                                    <br>
                                    <div class="contact pull-right">
                                        <p class="email"><i class="fa fa-envelope"></i><a href="#">info@washingtoncollege.com.ve</a></p>
                                    </div><!--//contact-->
                                </div><!--//info-->
                                </div><!--//header-main-->
                                </header><!--//header-->

                                <!-- ******NAV****** -->
                                <nav class="main-nav" role="navigation">
                                    <div class="container">
                                        <div class="navbar-header">
                                            <button class="navbar-toggle collapsed" type="button" data-toggle="collapse" data-target="#navbar-collapse">
                                                <span class="sr-only">Toggle navigation</span>
                                                <span class="icon-bar"></span>
                                                <span class="icon-bar"></span>
                                                <span class="icon-bar"></span>
                                            </button><!--//nav-toggle-->
                                        </div><!--//navbar-header-->            
                                        <div class="navbar-collapse collapse" id="navbar-collapse" style="height: 0px;">
                                            <ul class="nav navbar-nav">
                                                <?php if (isset($_GET['lugar']) && $_GET['lugar'] == 'inicio' ? $active = 'active' : $active = '')  ?>
                                                <li class="<?php echo $active ?> nav-item">
                                                    <a href="inicio.php?lugar=inicio">Inicio</a>
                                                </li>
                                                <?php if (isset($_SESSION['wc']['session']) && $_SESSION['wc']['session']) { ?>
                                                    <?php if (isset($_GET['lugar']) && $_GET['lugar'] == 'lecciones' ? $active = 'active' : $active = '')  ?>
                                                    <li class="<?php echo $active ?> nav-item">
                                                        <a href="inicio.php?lugar=lecciones&lecc=#">Temario</a>
                                                    </li>

                                                    <?php if ($_GET['lugar'] == 'descargas' ? $active = 'active' : $active = '')  ?>
                                                    <li class="<?php echo $active ?> nav-item">
                                                        <a href="inicio.php?lugar=descargas">Descargas</a>
                                                    </li>
                                                    <?php if ($_GET['lugar'] == 'evaluaciones' ? $active = 'active' : $active = '')  ?>
                                                    <li class="<?php echo $active ?> nav-item">
                                                        <a href="inicio.php?lugar=evaluaciones">Evaluar</a>
                                                    </li>
                                                    <?php if ($_GET['lugar'] == 'vocabulario' ? $active = 'active' : $active = '')  ?>
                                                    <li class="<?php echo $active ?> nav-item">
                                                        <a href="inicio.php?lugar=vocabulario">Vocabulario</a>
                                                    </li>
                                                <?php } ?>
                                                <?php if (isset($_GET['lugar']) && $_GET['lugar'] == 'videos' ? $active = 'active' : $active = '')  ?>    
                                                <li class="<?php echo $active ?> nav-item">
                                                    <a href="inicio.php?lugar=videos">Videos</a>
                                                </li>
                                            </ul><!--//nav-->
                                            <ul class="nav navbar-nav navbar-right">
                                                <?php
                                                if (!isset($_SESSION['wc']['session'])) {
                                                    ?>
                                                    <li class="dropdown nav-item">
                                                        <a href="" class="dropdown-toggle" data-toggle="dropdown">Login <b class="caret"></b></a>
                                                        <ul class="dropdown-menu" style="padding: 15px;min-width: 250px;">
                                                            <li>
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <form class="form" role="form" method="post" action="form_process.php" accept-charset="UTF-8" id="login-nav">
                                                                            <div class="form-group">
                                                                                <label class="sr-only" for="exampleInputEmail2">Matricula</label>
                                                                                <input type="text" class="form-control" id="txt_matricula" name="txt_matricula" placeholder="Matricula" required>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label class="sr-only" for="txt_clave" name="txt_clave">Password</label>
                                                                                <input type="password" name="txt_clave" class="form-control" id="exampleInputPassword2" placeholder="Clave" required>
                                                                            </div>
                                                                            <input type="hidden" name="form" value="login">
                                                                            <div class="form-group">
                                                                                <button type="submit" class="btn btn-primary btn-block">Entrar</button>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                            <li class="divider"></li>
                                                            <!--li>
                                                                <input class="btn btn-primary btn-block" type="button" id="sign-in-google" value="Sign In with Google">
                                                                <input class="btn btn-primary btn-block" type="button" id="sign-in-twitter" value="Sign In with Twitter">
                                                            </li-->
                                                        </ul>
                                                    </li>

                                                <?php } else { ?>
                                                    <li class="nav-item dropdown">
                                                        <a class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="0" data-close-others="false" href="#">
                                                            <i class="fa fa-user fa-fw"></i> Bienvenido <?php echo $_SESSION['wc']['nombre']; ?> <i class="fa fa-angle-down"></i></a>
                                                        <ul class="dropdown-menu">
                                                            <?php if ($_SESSION['wc']['nivel'] == 'E') { ?>
                                                                <li><a href="inicio.php?lugar=perfil"><i class="fa fa-file-text"></i>  Mis Datos</a></li>
                                                            <?php } ?>
                                                            <?php if ($_SESSION['wc']['nivel'] == 's' || $_SESSION['wc']['nivel'] == 'p') { ?>
                                                                <li class="light-black">
                                                                    <a href="inicio.php?lugar=administrador"> 
                                                                        <i class="ace-icon fa fa-cog"></i>
                                                                        Administrador
                                                                    </a>
                                                                </li>    
                                                            <?php } ?>
                                                            <li class="light-black">
                                                                <a href="cerrar_session.php?lugar=inicio"> 
                                                                    <i class="ace-icon fa fa-power-off"></i>
                                                                    Logout
                                                                </a>
                                                            </li>                                                
                                                        </ul>
                                                    </li>
                                                    <li class="divider"></li>

                                            </div>
                                            </ul>
                                            </li>
                                        <?php } ?>    
                                        </ul>        


                                    </div><!--//navabr-collapse-->
                                </nav><!--//main-nav-->
                                <?php
                                if (isset($_SESSION['wc']['nivel'])) {
                                ?>
                                <div class="chat_content" data-step="2" data-intro="Iconos de acceso Rapido">
                                    <!img id="SnapABug_bImg" style="position: relative; left: -4px;" src="https://commondatastorage.googleapis.com/code.snapengage.com/btn/chat_orange_left_es.png" alt="Ayuda" border="0" onmouseover="SnapABug.buttonOver();" onmouseout="SnapABug.buttonOut();">
                                    <ul class="share-inner-wrp">
                                        
                                            <li class="home button-wrap">
                                                <a href="inicio.php?lugar=inicio">Inicio</a>
                                            </li>
                                            <li class="tem button-wrap">
                                                <a href="inicio.php?lugar=lecciones&lecc=#">Temario</a>
                                            </li>

                                            <li class="admin button-wrap">
                                                <?php if ($_SESSION['wc']['nivel'] == 'E') { ?>
                                                    <a href="inicio.php?lugar=perfil">Perfil</a>
                                                <?php } ?>
                                                <?php if ($_SESSION['wc']['nivel'] == 's' || $_SESSION['wc']['nivel'] == 'p') { ?>
                                                    <a href="inicio.php?lugar=administrador">Administrador</a>
                                                <?php } ?>
                                            </li>
                                            <?php if ($_SESSION['wc']['nivel'] == 'E') { ?>
                                                <li class="time button-wrap">
                                                    <a href="inicio.php?lugar=servicios">Horario</a>
                                                </li>
                                            <?php } ?>
                                        
                                    </ul>
                                </div>
                                <?php } ?>
                                <!-- ******CONTENT****** --> 
                                <div class="content container">
                                    <?php
                                    include("cont_central.php");
                                    ?>
                                </div><!--//content-->
                                </div><!--//wrapper-->
                                <!-- ******FOOTER****** --> 
                                <footer class="footer">
                                    <div class="footer-content">
                                        <div class="container">
                                            <div class="row">
                                                <div class="footer-col col-md-3 col-sm-4 about">
                                                    <div class="footer-col-inner">
                                                        <h3>Coorporativo</h3>
                                                        <ul>
                                                            <li><a href="inicio.php?lugar=mision"><i class="fa fa-caret-right"></i>Misión</a></li>
                                                            <!--li><a href="contact.inicio.php?lugar=vision"><i class="fa fa-caret-right"></i>Visión</a></li-->
                                                        </ul>
                                                    </div><!--//footer-col-inner-->
                                                </div><!--//foooter-col-->
                                                <div class="footer-col col-md-6 col-sm-8 newsletter">
                                                    <div class="footer-col-inner">
                                                        <h3>Unete a nuestro Boletin Informativo</h3>
                                                        <p>Suscríbete para recibir nuestro boletín semanal directamente en tu bandeja correo</p>
                                                        <form class="subscribe-form" action="form_process.php">
                                                            <div class="form-group">
                                                                <input type="email" class="form-control" placeholder="Enter your email">
                                                            </div>
                                                            <input class="btn btn-theme btn-subscribe" type="submit" value="Subscribe">
                                                        </form>

                                                    </div><!--//footer-col-inner-->
                                                </div><!--//foooter-col--> 
                                                <div class="footer-col col-md-3 col-sm-12 contact">
                                                    <div class="footer-col-inner">
                                                        <h3>Contacto</h3>
                                                        <div class="row">
                                                            <p class="adr clearfix col-md-12 col-sm-4">
                                                                <i class="fa fa-map-marker pull-left"></i>        
                                                                <span class="adr-group pull-left">       
                                                                    <span class="street-address">Washignton College</span><br>
                                                                    <span class="region">Av. Bolivar Norte Torre Banaven</span><br>
                                                                    <span class="postal-code">Oficina 202</span><br>
                                                                    <span class="country-name">Valencia - Venezuela</span>
                                                                </span>
                                                            </p>
                                                            <p class="email col-md-12 col-sm-4"><i class="fa fa-envelope"></i><a href="#">info@washingtoncollege.com.ve</a></p>  
                                                        </div> 
                                                    </div><!--//footer-col-inner-->            
                                                </div><!--//foooter-col-->   
                                            </div>   
                                        </div>        
                                    </div><!--//footer-content-->
                                    <div class="bottom-bar">
                                        <div class="container">
                                            <div class="row">
                                                <small class="copyright col-md-6 col-sm-12 col-xs-12">
                                                    Copyright 2010 Washington English Institute RIF: J-31541069-9 | Todos los derechos Reservados</small>
                                                <ul class="social pull-right col-md-6 col-sm-12 col-xs-12">
                                                    <li><a href="https://twitter.com/wecvenezuela"><i class="fa fa-twitter"></i></a></li>
                                                    <!--li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                                    <li><a href="#"><i class="fa fa-youtube"></i></a></li>
                                                    <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                                    <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                                    <li><a href="#"><i class="fa fa-pinterest"></i></a></li>
                                                    <li><a href="#"><i class="fa fa-skype"></i></a></li> 
                                                    <li class="row-end"><a href="#"><i class="fa fa-rss"></i></a></li-->
                                                </ul><!--//social-->
                                            </div><!--//row-->
                                        </div><!--//container-->
                                    </div><!--//bottom-bar-->
                                </footer><!--//footer-->

                                <!-- *****CONFIGURE STYLE****** -->  
                                <?php
                                if (isset($_SESSION['wc']['session'])) {
                                    ?>
                                    <div data-step="1" data-intro="Haz click en el icono e ingresa al chat online" data-position='left' class="config-wrapper">
                                        <div class="config-wrapper-inner">
                                            <a id="config-trigger" class="config-trigger" href="#"><i class="fa fa-comments-o"></i></a>
                                            <div id="config-panel" class="config-panel">
                                                <h3 style="color: #000; text-align:center;">Chat Online</h3>
                                                <p> <br />
                                                    de lunes a viernes de 9 am. a 12 pm.<br> 
                                                    1 pm. a 6 pm.<br />
                                                    S&aacute;bados de 9 am. a 12 pm.
                                                    <br>
                                                    de 1:00 pm a 3:00pm 
                                                </p>
                                                <br>
                                                <a href="http://www.comm100.com/livechat/" onclick=" comm100_Chat();
                                                        return false;
                                                   " target="_blank" title = "Live Chat Live Help Software for Website">
                                                    <img id="comm100_ButtonImage" src="http://washingtoncollege.com.ve/images/Chat_off_line.png" border="0px" alt="Live Chat Live Help Software for Website" />
                                                </a>
                                                <script src="http://chatserver.comm100.com/js/LiveChat.js?siteId=29538&planId=622"type="text/javascript"></script>
                                                <a id="config-close" class="close" href="#"><i class="fa fa-times-circle"></i></a>
                                            </div><!--//configure-panel-->
                                        </div><!--//config-wrapper-inner-->
                                    </div><!--//config-wrapper-->
                                <?php } ?>
                                <!-- Javascript -->          
                                <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
                                <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
                                <!--script type="text/javascript" src="assets/plugins/jquery-migrate-1.2.1.min.js"></script-->
                                <script type="text/javascript" src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script> 
                                <!--script type="text/javascript" src="assets/plugins/bootstrap-hover-dropdown.min.js"></script> 
                                <script type="text/javascript" src="assets/plugins/back-to-top.js"></script>
                                <script type="text/javascript" src="assets/plugins/jquery-placeholder/jquery.placeholder.js"></script>
                                <script type="text/javascript" src="assets/plugins/pretty-photo/js/jquery.prettyPhoto.js"></script-->
                                <script type="text/javascript" src="plugins/flexslider/jquery.flexslider-min.js"></script>
                                <script src="plugins/fshare/fshare.js"></script>
                                <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
                                <script type="text/javascript" src="plugins/gmaps/gmaps.js"></script>
                                <script type="text/javascript" src="plugins/intro/intro.js"></script>
                                <!--script type="text/javascript" src="assets/plugins/jflickrfeed/jflickrfeed.min.js"></script--> 
                                <script type="text/javascript" src="lib/main.js"></script>            
                                <?php
                                if ($_GET['lugar'] == "inicio" && isset($_SESSION['wc'])) {
                                    ?>
                                    <script>
                                                    $(function() {
                                                        //introJs().setOption('showBullets', false).start();
                                                    })
                                    </script>
                                <?php } ?>
                                <?php
                                if ($_GET['lugar'] == "lecciones" || $_GET['lugar'] == "leccion") {
                                    echo '<script type="text/javascript" src="lib/jwplayer/jwplayer.js"></script>';
                                    echo '<script src="lib/leccion.js"></script>';
                                }
                                if ($_GET['lugar'] == "contacto")
                                    echo '<script src="lib/maps.js"></script>';

                                if ($_GET['lugar'] == "agregar_usuario")
                                    echo '<script src="lib/new_user.js"></script>';

                                if ($_GET['lugar'] == "galeria") {
                                    echo '<script src="plugins/prettyPhoto/jquery.prettyPhoto.js"></script>';
                                    echo '<script src="lib/galeria.js"></script>';
                                }
                                if ($_GET['lugar'] == "progreso") {
                                    echo '<script src="plugins/easyPieChart/jquery.easypiechart.js"></script>';
                                }
                                if ($_GET['lugar'] == "venta") {
                                    echo '<script src="plugins/charts/js/Chart.js"></script>';
                                    echo '<script src="lib/ventas.js"></script>';
                                }
                                ?>


                                <div id="topcontrol" title="Scroll Back to Top" style="position: fixed; bottom: 5px; right: 5px; opacity: 0; cursor: pointer;"><i class="fa fa-angle-up"></i></div></body></html>