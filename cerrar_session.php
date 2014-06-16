<?php

session_start();

//para destruir las variables de la session
$_SESSION = array();
//Finalmente destruimos la session
session_destroy();
header("location: " . $_GET['lugar'] . '.php?lugar='.$_GET['lugar']);
?>