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
        return 'inicio.php';
    }
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
}

if ($form_error) {
    
}try {
    unset($_SESSION[$_POST['form']]);
    header("Location: " . $lang_dir . $ty_redirect_to);
} catch (Exception $e) {
    
}