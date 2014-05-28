<?php
session_start();

require_once 'clases/db.class.php';
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
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Washington English College</title>
        <meta name="description" content="Washington English College, Aprende Ingles desde la comodidad de tu tu casa es practico rapido y divertido. comienza hoy mismo.">
        <meta name="keywords" content="cómo funciona Washington English College, aprende ingles online, aprende inglés on line,  washington english college">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/themes/start/jquery-ui.css">
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css">
        <link rel="stylesheet" href="plugins/flexslider/flexslider.css">
        <style>
            body {
                padding-top: 50px;
                padding-bottom: 20px;
            }
        </style>
        <link rel="stylesheet" href="css/bootstrap-theme.min.css">
        <link rel="stylesheet" href="css/main.css">

        <!--script src="js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script-->
    </head>
    <body class="home-page">
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        <div class="wrapper">
            <header class="header">
                <div class="header-main container">
                    <h1 class="logo col-md-4 col-sm-4">
                        <img src="images/logoWEC.png">
                    </h1>
                    <div class="info col-md-4 col-sm-4">
                        <img src="images/topPeople_new.png" class="people">
                    </div>
                    <div class="info col-md-4 col-sm-4">

                        <ul class="menu-top navbar-right">
                            <!--li class="divider">
                                <a>El Instituto</a>
                            </li-->
                            <li class="divider">
                                <a id="where">Donde Estamos</a>
                            </li>
                            <li class="divider">
                                <a href="#">Galeria</a>
                            </li>
                            <li class="">
                                <a href="inicio.php?lugar=contacto"> Contactenos</a>
                            </li>
                        </ul>
                        <?php if (isset($_SESSION['wc']['session'])) { ?>
                            <div class="contact pull-right">
                                <a href="http://chatserver.comm100.com/BBS.aspx?siteId=29538&planId=622" onclick=" comm100_Chat();
                                            return false;
                                   " id="blink" class="chat"><i class="fa fa-wechat"></i> Chat Online! </a>
                                <script src="http://chatserver.comm100.com/js/LiveChat.js?siteId=29538&planId=622"type="text/javascript"></script>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </header>
            <nav class="main-nav collapse navbar-collapse" role="navigation">
                <div class="container">
                    <ul class="nav navbar-nav">
                        <li class="active nav-item">
                            <a href="inicio.php?lugar=inicio">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a href="inicio.php?lugar=lecciones&lecc=#">Temario</a>
                        </li>
                        <?php if (isset($_SESSION['wc']['session']) && $_SESSION['wc']['session']) { ?>
                            <li class="nav-item">
                                <a href="inicio.php?lugar=descargas">Descargas</a>
                            </li>
                            <li class="nav-item">
                                <a href="inicio.php?lugar=evaluaciones">Evaluar</a>
                            </li>
                            <li class="nav-item">
                                <a href="inicio.php?lugar=vocabulario">Vocabulario</a>
                            </li>
                        <?php } ?>
                        <li class="nav-item">
                            <a href="inicio.php?lugar=videos">Videos</a>
                        </li>
                    </ul>
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

                            <li class="dropdown nav-item light-blue">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-user fa-fw"></i>
                                    Bienvenido <?php echo $_SESSION['wc']['nombre']; ?> 
                                    <b class="caret"></b>
                                </a>
                                <ul class="dropdown-menu" style="padding: 15px;min-width: 248px;">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <?php if ($_SESSION['wc']['nivel'] == 'E') { ?>
                                                <li class="light-black">
                                                    <a href="inicio.php?lugar=perfil"> 
                                                        <i class="ace-icon fa fa-cog"></i>
                                                        Mis Datos
                                                    </a>
                                                </li>

                                            <?php } ?>
                                            <?php if ($_SESSION['wc']['nivel'] == 's' || $_SESSION['wc']['nivel'] == 'p') { ?>
                                                <li class="light-black">
                                                    <a href="inicio.php?lugar=administrador"> 
                                                        <i class="ace-icon fa fa-cog"></i>
                                                        Administrador
                                                    </a>
                                                </li>    
                                            <?php } ?>
                                            <!--li class="light-black">
                                                <a href="#"> 
                                                    <i class="ace-icon fa fa-user"></i>
                                                    Perfil
                                                </a>
                                            </li-->
                                            <li class="divider"></li>
                                            <li class="light-black">
                                                <a href="cerrar_session.php?lugar=inicio"> 
                                                    <i class="ace-icon fa fa-power-off"></i>
                                                    Logout
                                                </a>
                                            </li>
                                        </div>
                                </ul>
                            <?php } ?>    
                    </ul>
                </div>
            </nav>

            <div class="chat_content">
                <!img id="SnapABug_bImg" style="position: relative; left: -4px;" src="https://commondatastorage.googleapis.com/code.snapengage.com/btn/chat_orange_left_es.png" alt="Ayuda" border="0" onmouseover="SnapABug.buttonOver();" onmouseout="SnapABug.buttonOut();">
                <ul class="share-inner-wrp">
                    <li class="home button-wrap">
                        <a href="inicio.php?lugar=inicio">Inicio</a>
                    </li>
                    <li class="tem button-wrap">
                        <a href="inicio.php?lugar=lecciones&lecc=#">Temario</a>
                    </li>
                    <?php
                    if (isset($_SESSION['wc']['nivel'])) {
                        ?>
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
                    <?php } ?>
                </ul>
            </div>
            <!--aside></aside-->
            <!-------------Inicio del Contenido-->
            <?php
            include("cont_central.php");
            ?>
            <footer class="footer">
                <div class="footer-content">
                    <div class="container">
                        <div class="row">
                            <!--div class="footer-col col-md-3 col-sm-4">
                            <!--div class="footer-col-inner">
                                <h3>Acerca De</h3>
                                <ul>
                                    <li>
                                        <a>
                                            <i class="fa fa-caret-right"></i>
                                            Politica de Privacidad
                                        </a>
                                    </li>
                                    <li>
                                        <a>
                                            <i class="fa fa-caret-right"></i>
                                            Terminos y condiciones
                                        </a>
                                    </li>
                                </ul>
                            </div-->
                            <!--/div-->
                            <div class="col-md-8 col-sm-8">
                                <img src="images/Title_traductor.jpg" style="padding:0px;"/>
                                <?php include('traductor.html'); ?>
                                <!--div class="footer-col-inner">
                                    <h3>Unete a nuestro Boletin Informativo</h3>
                                    <p>Suscríbete para recibir nuestro boletín semanal directamente en tu bandeja correo</p>
                                    <form class="subscribe-form">
                                        <div class="form-group">
                                            <input type="email" class="form-control" placeholder="Escribe tu Email">
                                        </div>
                                        <input class="btn btn-theme btn-subscribe" type="submit" value="Subscribe">
                                    </form>

                                </div-->        
                            </div>
                            <div class="col-md-3 col-sm-4">
                                <div class="footer-col-inner">
                                    <h3>Contacto </h3>
                                    <div class="row">
                                        <p class="adr clearfix col-md-12 col-sm-4">
                                            <i class="fa fa-map-marker pull-left"></i>        
                                            <span class="adr-group pull-left">       
                                                <span class="street-address">Washignton College</span><br>
                                                <span class="region">Av. Bolivar Norte Torre Banaven</span><br>
                                                <span class="postal-code">Oficina 222</span><br>
                                                <span class="country-name">Valencia - Venezuela</span>
                                            </span>
                                        </p>
                                        <!--p class="tel col-md-12 col-sm-4"><i class="fa fa-phone"></i> 0800 123 4567 </p-->
                                        <p class="email col-md-12 col-sm-4"><i class="fa fa-envelope"></i><a href="inicio.php?lugar=contacto"> info@washingtoncollege.com.ve</a></p>  
                                    </div> 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bottom-bar">
                    <div class="container">
                        <div class="row">
                            <small class="copyright col-md-12 col-sm-12 col-xs-12">Copyright 2010 Washington English Institute RIF: J-31541069-9 | Todos los derechos Reservados <!--a href="#">Donec sed odio</a--></small>
                        </div>
                    </div>
                </div>
            </footer>
        </div> <!-- /container -->        
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.0.min.js"><\/script>')</script>

        <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
        <script src="plugins/flexslider/jquery.flexslider-min.js"></script>
        <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
        <script type="text/javascript" src="plugins/gmaps/gmaps.js"></script>
        <script src="lib/main.js"></script>
        <script src="plugins/fshare/fshare.js"></script>
        <?php
        if ($_GET['lugar'] == "lecciones" || $_GET['lugar'] == "leccion") {
            echo '<script type="text/javascript" src="lib/jwplayer/jwplayer.js"></script>';
            echo '<script src="lib/leccion.js"></script>';
        }
        if ($_GET['lugar'] == "contacto")
            echo '<script src="lib/maps.js"></script>';

        if ($_GET['lugar'] == "agregar_usuario")
            echo '<script src="lib/new_user.js"></script>';
        ?>

        <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
        <script>
                                    (function(b, o, i, l, e, r) {
                                        b.GoogleAnalyticsObject = l;
                                        b[l] || (b[l] =
                                                function() {
                                                    (b[l].q = b[l].q || []).push(arguments)
                                                });
                                        b[l].l = +new Date;
                                        e = o.createElement(i);
                                        r = o.getElementsByTagName(i)[0];
                                        e.src = '//www.google-analytics.com/analytics.js';
                                        r.parentNode.insertBefore(e, r)
                                    }(window, document, 'script', 'ga'));
                                    ga('create', 'UA-3987227-9');
                                    ga('send', '_trackPageview');
        </script>
    </body>
</html>
