<?php
session_start();
//require_once('clases/db.class.php');
//$bd=new db;
//include_once("funciones/inic_session.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <style type="text/css">@import url(jscalendar-1.0/calendar-blue2.css);</style>

        <link href="styles/styles.css" rel="stylesheet" type="text/css" />
        <link href="http://code.jquery.com/ui/1.10.3/themes/flick/jquery-ui.css" type="text/css" rel="stylesheet">

            <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
            <?php
            require_once('clases/db.class.php');
            $bd = new db;
            $bdc = new db;
            include_once("funciones/inic_session.php");



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


            unset($leccionT);
            if (isset($_POST['lecc']) && $_POST['lecc'] && $_POST['lecc'] > 0) {
                $sqlleccion = $bd->consulta("SELECT * FROM leccion WHERE LECCION='$_POST[lecc]'");
                $leccionT = $bd->sig_reg($sqlleccion);
            } else {
                if (isset($_GET['lecc']) && $_GET['lecc'] && $_GET['lecc'] > 0) {
                    $sqlleccion = $bd->consulta("SELECT * FROM leccion WHERE LECCION='$_GET[lecc]'");
                    $leccionT = $bd->sig_reg($sqlleccion);
                }
            }



            if (isset($leccionT) || $_GET['lugar'] == 'inicio' || $_GET['lugar'] == 'lecciones' || $_GET['lugar'] == 'evaluaciones' || $_GET['lugar'] == 'videos') {
                ?>
                                    <!--<script type="text/javascript">
                            var url = "http://tradukka.com/";
                            var rtl = [];
                            rtl[0] = 'ar';
                            rtl[1] = 'iw';
                            rtl[2] = 'yi';
                            </script>
                            <script type="text/javascript" src="Tradukka%20_%20Translation%20in%20real%20time_files/jsapi"></script>
                            <script type="text/javascript">google.load('language','1');</script><script src="Tradukka%20_%20Translation%20in%20real%20time_files/a" type="text/javascript"></script><script src="Tradukka%20_%20Translation%20in%20real%20time_files/defaultes.js" type="text/javascript"></script>
                            <script type="text/javascript">google.load('jquery','1.3.2');</script><script src="Tradukka%20_%20Translation%20in%20real%20time_files/jquery_004.js" type="text/javascript"></script>
                            <script type="text/javascript" src="Tradukka%20_%20Translation%20in%20real%20time_files/jquery_003.js"></script>
                            <script type="text/javascript" src="Tradukka%20_%20Translation%20in%20real%20time_files/jquery.js"></script>
                            <script type="text/javascript" src="Tradukka%20_%20Translation%20in%20real%20time_files/jquery_002.js"></script>
                            <script type="text/javascript" src="Tradukka%20_%20Translation%20in%20real%20time_files/common.js"></script>
                            <script type="text/javascript" src="Tradukka%20_%20Translation%20in%20real%20time_files/en.js"></script>
                            <link rel="shortcut icon" href="http://tradukka.com/favicon.ico">
                            
                            <link media="all"  href="Tradukka%20_%20Translation%20in%20real%20time_files/hi.css" type="text/css" rel="stylesheet">-->
            <?php }
            ?>

            <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
            <script type="text/javascript">

                function showLightbox(fondo, mensaje) {
                    document.getElementById(fondo).style.display = 'block';
                    document.getElementById(mensaje).style.display = 'block';

                }

                function hideLightbox(fondo, mensaje) {
                    document.getElementById(fondo).style.display = 'none';
                    document.getElementById(mensaje).style.display = 'none';

                }
            </script>

            <?php
///////////////////////////completar registro////////////////////////////////////
//include("borrar_espacios.php");	

            include("DESACTIVAR_VENCIDOS.PHP");


            /* $bd->consulta("UPDATE usuarios SET 
              leccion_aprobada = 0
              WHERE leccion_aprobada IS NULL");
             */


            if (isset($_POST['registrado']) && $_POST['registrado']) {

                if (!(isset($bd2))) {
                    require_once('clases/db.class.php');
                    $bd2 = new db;
                }
                $bd2->consulta("UPDATE usuarios SET 
							   activo = 'S',
							   email = '$_POST[Email_Personal]',
							   estado = '$_POST[estado]',
							   ciudad ='$_POST[ciudades]',
                                                           pais = '$_POST[pais]'
							   WHERE contrato = '$_POST[contrato]'");
                /* $bd2->consulta("INSERT INTO email_recomendados 
                  (contrato,email,email1,email2,email3,telefonor1,telefonop) VALUES
                  ('$_POST[contrato]','$_POST[Email_Personal]','$_POST[Email_Referido_1]','$_POST[email2]','$_POST[email3]','$_POST[Telefono_Personal]','$_POST[Telefono_referido_1]')"); */
                ?>
                <script type="text/javascript">
                    hideLightbox();
                </script>
                <?php
                include_once("funciones/inic_session.php");
                $sql = $bd->consulta("SELECT * FROM usuarios WHERE contrato=$_POST[contrato]");
                $usuario = $bd->sig_reg($sql);
                iniciar_session($usuario['contrato'], $usuario['clave'], $usuario['nombre'], $usuario['apellido'], $usuario['nivel'], $_GET['lugar'], $_GET['lecc'], $_GET['libro'], $_GET['dir'], $_GET['pag']);
            }



///////////////////////////////////////registro/////////////////////////////////////////////////////

            if (isset($_POST['aceptar']) && $_POST['aceptar']) {
                header("location: inicio.php?lugar=$_GET[lugar]&aceptar2=$_POST[aceptar]&lecc=$_GET[lecc]&libro=$_GET[libro]&dir=$_GET[dir]&pag=$_GET[pag]");
            }

///////////////////////////lecciones, evaluaciones, videos///////////////////////////////////

            if (isset($_SESSION['wc']['session']) && $_SESSION['wc']['session'] && isset($_GET['lugar']))/* SI HAY SESION */ {
                if (isset($_GET['lugar']) && ($_GET['lugar']) == 'lecciones')/* SI HAY SESION */ {
                    if (isset($_GET['lecc']) && ($_GET['lecc']) && ($_GET['lecc'] >= 1) && isset($_GET['valor']) && !isset($_GET['pag']))
                        header("Location: inicio.php?lugar=leccion&lecc=$_GET[lecc]");
                    else
                    if (isset($_GET['lecc']) && ($_GET['lecc']) && ($_GET['lecc'] >= 1) && isset($_GET['valor']) && isset($_GET['pag']))
                        header("Location: inicio.php?lugar=leccion&lecc=$_GET[lecc]&pag=$_GET[pag]");
                }else {
                    if (isset($_GET['lugar']) && ($_GET['lugar']) == 'videos')/* SI HAY SESION */ {
                        if ((isset($_GET['lecc']) && ($_GET['lecc'])) && ($_GET['lecc'] >= 1))
                            header("Location: inicio.php?lugar=video&libro=$_GET[libro]&lecc=$_GET[lecc]&dir=$_GET[dir]");
                    }
                }
            }else {
                if (isset($_GET['lugar']) && ($_GET['lugar']) == 'lecciones')/* SI HAY SESION */ {
                    if ((isset($_GET['lecc']) && ($_GET['lecc']) && ($_GET['lecc'] == 1)) && isset($_GET['valor']))
                        header("Location: inicio.php?lugar=leccion&lecc=$_GET[lecc]");
                }else {
                    if (isset($_GET['lugar']) && ($_GET['lugar']) == 'videos')/* SI HAY SESION */ {
                        if ((isset($_GET['lecc']) && ($_GET['lecc']) && ($_GET['lecc'] == 1) && isset($_GET['libro']) && ($_GET['libro']) && ($_GET['libro'] == 1))) {
                            header("Location: inicio.php?lugar=video&libro=$_GET[libro]&lecc=$_GET[lecc]&dir=$_GET[dir]");
                        }
                    }
                }
            }

            ///////////////////////////////////////inicio de sesion///////////////////////////////
            if (isset($_POST['aceptar2']) && $_POST['aceptar2']) {

                foreach ($_POST as $post => $valor)
                    $$post = $valor;
                /* $pass=md5($pass); */

                $sql = $bd->consulta("SELECT * FROM usuarios WHERE contrato='$contrato' && clave='$clave'");
                //$sql2=$bd->consulta("SELECT * FROM email_recomendados WHERE contrato='$contrato'");
                $usuario = $bd->sig_reg($sql);
                //$usuario2=$bd->sig_reg($sql2);
                if (isset($usuario) && $usuario['contrato'] && $usuario['activo'] <> 'n' && $usuario['activo'] <> 'N') {
                    ?>
                    <!--**********************************************************************************-->

                    <div id="fade" class="fadebox"></div>  <!--fondo transparente oscuro--> 
                    <div id="over" class="overbox">
                        <?php include('completar_registro_central.php'); ?>
                    </div> 
                    <!--**********************************************************************************-->                   
                    <?php
                    if (!$sql || !$usuario || !$usuario['email'] || !$usuario['estado']) {
                        ?>
                        <script type="text/javascript">
                            showLightbox('fade', 'over');<!--********************ventana de registro (div)******************-->

                        </script>


                        <?php
                    } else {

                        if ($usuario && ($usuario['activo'] == 's' || $usuario['activo'] == 'S' )) {

                            iniciar_session($usuario['contrato'], $usuario['clave'], $usuario['nombre'], $usuario['apellido'], $usuario['nivel'], $_GET['lugar'], $_GET['lecc'], $_GET['libro'], $_GET['dir'], $_GET['pag']);
                            include('aviso.php'); //avisos de ultima hora
                        } else {
                            ?>
                            <script type="text/javascript">
                                alert("Error: Su contrato ha vencido");
                            </script>
                            <?php
                        }
                    }
                } else {
                    if (isset($usuario) && $usuario['contrato']) {
                        ?><script type="text/javascript">
                                        alert("Error: Su contrato ha vencido");
                        </script>
                        <?php
                    }
                }
            } else {
                if (isset($_GET['aceptar2']) && $_GET['aceptar2'] && isset($_SESSION['wc']['session']) && $_SESSION['wc']['session']) {
                    include('aviso.php'); //avisos de ultima hora
                }
            }
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
            ?>



            <title>Washinton English College-<?php
                if (isset($leccionT)) {
                    echo $leccionT['TITULO'];
                } else {
                    if ($_GET['lugar'] == 'inicio') {
                        echo 'Inicio';
                    } else {
                        if ($_GET['lugar'] == 'lecciones') {
                            echo 'Temario';
                        } else {
                            if ($_GET['lugar'] == 'evaluaciones') {
                                echo 'Evaluaciones';
                            } else {
                                if ($_GET['lugar'] == 'vocabulario') {
                                    echo 'Vocabulario';
                                } else {
                                    if ($_GET['lugar'] == 'videos') {
                                        echo 'Videos';
                                    }
                                }
                            }
                        }
                    }
                }
                ?></title>
            <!--***********************calendario*******************************************************--> 
            <script type="text/javascript" src="jscalendar-1.0/calendar.js"></script>
            <script type="text/javascript" src="jscalendar-1.0/lang/calendar-en.js"></script>
            <script type="text/javascript" src="jscalendar-1.0/calendar-setup.js"></script>
            <script type="text/javascript" src="lib/jwplayer/jwplayer.js"></script>
            <link href="jscalendar-1.0/calendar-blue.css" rel="stylesheet" type="text/css" />
            <link href="lib/uploadfive/uploadifive.css" rel="stylesheet" type="text/css" />
            <!--****************************************************************************************--> 

            <script  src="http://code.jquery.com/jquery-1.9.1.js"></script>
            <script  src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
            <script  src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.13/i18n/jquery.ui.datepicker-es.js"></script>
            <script src="lib/uploadfive/jquery.uploadifive.js"></script>
            <script type="text/javascript">
                            $(document).ready(function() {
                                $(function() {
                                    $("#tabs").tabs().addClass("ui-tabs-vertical ui-helper-clearfix");
                                    $("#tabs li").removeClass("ui-corner-top").addClass("ui-corner-left");
                                });
                                $('#btn_guardar_evento').click(function() {
                                    var evento = $('#txt_evento').val();
                                    $.ajax({
                                        type: "GET",
                                        cache: false,
                                        dataType: "json",
                                        url: "ajax/ajax.php",
                                        data: 'a=guardar-evento&evento=' + evento,
                                        success: function(data) {
                                            if (data.estatus)
                                            {
                                                $('#file_upload').uploadifive('upload');
                                            }
                                        }
                                    });
                                });

                                $('#pais').change(function() {
                                    var pais = $('#pais').val();
                                    $.ajax({
                                        type: "GET",
                                        cache: false,
                                        dataType: "json",
                                        url: "ajax/ajax.php",
                                        data: 'a=listar-estado&pais=' + pais,
                                        success: function(data) {
                                            if (data.estatus)
                                            {
                                                var lineas = '';
                                                lineas += ('<option value="">Seleccione</option>');
                                                $.each(data.datos, function(i, valor) {
                                                    lineas += '<option value="' + valor.id_estado + '">' + valor.nombre + '</option>';
                                                });
                                                $('#estado').html(lineas);
                                            }
                                        }
                                    });
                                });
                                $('#estado').change(function() {
                                    var ciudad = $('#estado').val();
                                    $.ajax({
                                        type: "GET",
                                        cache: false,
                                        dataType: "json",
                                        url: "ajax/ajax.php",
                                        data: 'a=listar-ciudades&estado=' + ciudad,
                                        success: function(data) {
                                            if (data.estatus)
                                            {
                                                var lineas = '';
                                                lineas += ('<option value="">Seleccione</option>');
                                                $.each(data.datos, function(i, valor) {
                                                    lineas += '<option value="' + valor.id_estado + '">' + valor.nombre + '</option>';
                                                });
                                                $('#ciudades').html(lineas);
                                            }
                                        }
                                    });
                                });

                                $(function() {
                                    $("#dialog-form").dialog({
                                        autoOpen: false,
                                        height: 250,
                                        width: 450,
                                        modal: true,
                                        buttons: {
                                            "Guardar": function() {
                                                $('#forma_comprobante').submit();
                                            }
                                        }
                                    });
                                    var maxfecha = new Date();
                                    var hasta = (new Date()).getFullYear();
                                    var Rdesde = hasta - 150;
                                    var desde = new Date(Rdesde, 1);
                                    $.datepicker.setDefaults($.datepicker.regional['es']);

                                    $(".fecha").datepicker({
                                        disabled: false,
                                        changeMonth: true,
                                        changeYear: true,
                                        minDate: desde,
                                        //maxDate: maxfecha,
                                        yearRange: Rdesde + ':' + hasta
                                    });
                                });
                                $(function() {
                                    $('#file_upload').uploadifive({
                                        'auto': false,
                                        'fileObjName': 'file_name',
                                        'checkScript': '../lib/uploadfive/check-exists.php',
                                        'formData': {'a': 'cargar-imagen'},
                                        'queueID': 'queue',
                                        'uploadScript': 'ajax/ajax.php',
                                        'onUploadComplete': function(file, data) {
                                        }
                                    });

                                    //INICIALIZANDO EL PLUGIN DE LA GALERIA DE IMAGENES

                                });

                            })
                            function actualiza_estatus(id, estatus)
                            {
                                var estatus = estatus;
                                $.ajax({
                                    type: "GET",
                                    cache: false,
                                    dataType: "json",
                                    url: "ajax/ajax.php",
                                    data: 'a=cambiar-estatus&estatus=' + estatus + '&id=' + id,
                                    success: function(data) {
                                        if (data.estatus)
                                        {
                                            alert("Se ha Cambiado el estatus Correctamente");
                                            location.reload();
                                        }
                                    }
                                });
                            }

                            //DIALOGO GENERA PARA FORMA QUE PERMITE ALMACENAR LA FECHA DEL REGISTRO DE LOS COMPROBANTES

                            function form_comprobante(id) {
                                var sol = id;
                                $("#dialog-form").dialog("open");
                                $('#id_solicitud').val(sol);
                            }
                            function procesa_comprobante(id) {
                                var sol = id;
                                $("#dialog-form").dialog("open");
                                $('#id_solicitud').val(sol);
                            }
                            function exportar(id) {
                                window.open('http://www.washingtoncollege.com.ve/exportar_csv.php?aula=' + id);
                            }
                            var _gaq = _gaq || [];
                            _gaq.push(['_setAccount', 'UA-3987227-9']);
                            _gaq.push(['_trackPageview']);

                            (function() {
                                var ga = document.createElement('script');
                                ga.type = 'text/javascript';
                                ga.async = true;
                                ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
                                var s = document.getElementsByTagName('script')[0];
                                s.parentNode.insertBefore(ga, s);
                            })();

                            function inscribir(id, nivel, pais) {
                                $.ajax({
                                    type: "GET",
                                    cache: false,
                                    dataType: "json",
                                    url: "ajax/ajax.php",
                                    data: 'a=inscribir-curso&contrato=' + id + '&nivel=' + nivel + '&pais=' + pais,
                                    success: function(data) {
                                        if (data.estatus)
                                            alert(data.mensaje);
                                        else
                                            alert(data.mensaje);
                                    }
                                });
                            }
                            function solicitar(id, compro) {
                                $.ajax({
                                    type: "GET",
                                    cache: false,
                                    dataType: "json",
                                    url: "ajax/ajax.php",
                                    data: 'a=solicitar-comprobante&usuario=' + id + '&comprobante=' + compro,
                                    success: function(data) {
                                        if (data.estatus)
                                            alert(data.mensaje);
                                        else
                                            alert(data.mensaje);
                                    }
                                });

                            }
            </script>

    </head>
    <body style="background-color:#B4B4B4;">

        <div id="main">
            <div id="topHead">
            </div>
            <div id="medium">
                <?php
//if(isset($_SESSION['wc']['session']) && $_SESSION['wc']['session'])/*SI HAY SESION*/
//	$_GET['lugar']=$_SESSION['wc']['lugar'];
//else

                include("banner_sup.php");

                include("sub_banner.php"); /* contiene el formulario para iniciar session en la pag inicio.php */
                include("cont_central.php");
                include("pie.php");
                ?>
                <div style="clear:both;"></div>
            </div><!--AQUI TERMINA EL medium-->

            <div style="clear: both;"></div>
        </div><!--AQUI TERMINA EL MAIN-->

    </body>
</html>