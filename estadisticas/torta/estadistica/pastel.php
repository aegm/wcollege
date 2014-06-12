<?php session_start();
				include_once('conexion.php');
				$sql=mysql_query("SELECT * FROM `usuarios` WHERE contrato='".$_SESSION['wc']['contrato']."' ",$cnn);
				$row=mysql_fetch_array($sql);

				echo $nivel1=$row['leccion_aprobada'];
				  echo $intPct=round(  ( ($nivel1*100)/56)  );

// Definimos el tamaño de la imagen
$imagen = imagecreate(250,250);
// Color de fondo en formato RGB
$bg = imagecolorallocate($imagen,255,255,255);

//Definimos los arreglos de los Pedazos :P
$estados[0] = "Progreso Academico";
$colores[0] = imagecolorallocate($imagen,149,255,107);
$sombras[0] = imagecolorallocate($imagen,139,184,122);
$valores[0] = 100;

$estados[1] = ".net";
$colores[1] = imagecolorallocate($imagen,255,128,59);
$sombras[1] = imagecolorallocate($imagen,201,77,9);
$valores[1] = 500 ;

$estados[2] = "php";
$colores[2] = imagecolorallocate($imagen,56,136,246);
$sombras[2] = imagecolorallocate($imagen,32,83,152);
$valores[2] = 700 ;

// Sumamos el total de los valores
$total = array_sum($valores); 

// Calculamos el porcentaje y el ángulo de cada valor
for($i=0; $i<count($valores); $i++) {
    $porcentajes[$i] = round((7*100)/15,2);
    $angulos[$i] = round(($porcentajes[$i]*360)/100);
}

// Centro de la gráfica
$cx = 120;
$cy = 65;
// Tamaño del gráfico
$ancho = 200;
$alto = 80; 
// Inicio del ángulo
$inicio = 0; 

// Repetimos 35 veces la gráfica.
for($n=35;$n>0;$n--) {
    for($i=0;$i<count($valores);$i++) {
		imagefilledarc($imagen, $cx, $cy+$n, $ancho, $alto, $inicio, $angulos[$i]+$inicio, $sombras[$i], IMG_ARC_PIE);
        $inicio += $angulos[$i];
    }
}

$gris = imagecolorallocate($imagen,119,119,119);
for($i=0;$i<count($valores);$i++) {
    imagefilledarc($imagen,$cx,$cy,$ancho,$alto,$inicio,$angulos[$i]+$inicio,$colores[$i],IMG_ARC_PIE);
    $inicio += $angulos[$i];
	// Especificación de los colores de cada una de las porsiones
   imagefilledrectangle($imagen, 20, 155+($i*20), 34, 169+($i*20), $colores[$i]);
    imagestring($imagen, 2, 50, 155+($i*20), $estados[$i].": ".$valores[$i]." (".$porcentajes[$i]."%)", $gris);
}

// Creamos la imagen


imagepng($imagen);
imagedestroy($imagen);

?>