<?php
session_start();

include("consulta.php");
$consulta=new consulta();
$consulta->c=$_SESSION['wc']['contrato'];

$resultado=$consulta->sql($consulta->c);

$_SESSION['num']=$resultado;

?>