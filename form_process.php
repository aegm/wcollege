<?php

/*
 * Archivo Creado por el Ing. Angel Gonzalez.
 * Fecha 05/05/2014 
 * Funciona Como contralador para acceder a cierta informacion y dar repuesta segun el caso
 */

session_start();
require_once './lib/funciones.php';
require_once 'clases/db.class.php';
require_once 'clases/user.class.php';

function login($txt_matricula, $txt_clave) {
    $user = new user();
    if (!$user->login($txt_matricula, $txt_clave)) {
        die("asd");
    } else {
        die("asd");
        return 'inicio.php';
    }
}

function send_mail($para, $origen, $asunto, $mensaje, $css = "") {
    ini_set("SMTP", "mail.washingtoncollege.com.ve");
    ini_set("sendmail_from", $origen);


    $cabeceras .= "From: $origen" . "\r\n";

    return mail($para, $asunto, $mensaje, $cabeceras);
}

if (isset($_POST) && count($_POST))
    $form_error = false;

foreach ($_POST as $i => $valor)
    $$i = escapar($valor);

switch ($_POST['form']) {
    case 'login' :
        if (!$ty_redirect_to = login($txt_matricula, $txt_clave)) {
            $form_error = true;
        }
        break;
    case 'mail':
        if(isset($_POST)){
            $mensaje = "Nombre: $txt_nombre";
            $mensaje .= "Empresa: $txt_empresa";
            $mensaje .= "Cargo: $txt_cargo";
            $mensaje .= "Email: $txt_email";
            $mensaje .= "Telefono: $txt_telefono";
            $mensaje .= "Mensaje: $txt_mensaje";
            $para1='info@washingtoncollege.com.ve';            
            $formenviado = send_mail($para1,"$txt_email","Contacto Online","$mensaje");   
            if($formenviado){
                echo "Mensaje Enviado";
                $ty_redirect_to =  'inicio.php';
            }else{
                echo "Ha Ocurrido Un Error";
                $ty_redirect_to =  'inicio.php?lugar=contacto';
            }
                        
        }
        break;
}

if ($form_error) {
    
}try {
    unset($_SESSION[$_POST['form']]);
    header("Location: " . $lang_dir . $ty_redirect_to);
} catch (Exception $e) {
    
}

