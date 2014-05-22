<?php
header("Cache-Control: public"); 
header('Content-Type: text/csv; charset=utf-8');
 // definimos el tipo MIME y la codificación 
header('Content-Disposition: attachment; filename=datos.csv');
$aula = $_REQUEST['aula'];

require_once('clases/db.class.php');
$bd=new db; // Conexion a nuestra BD  
$csv_end = "  
";  
$csv_sep = ",";  
$csv_file = "C:\\prueba\\datos.csv";  
$csv="";

$sql = $bd->consulta("SELECT * from valumnos_inscritos where id_curso = '$aula'");  

echo "first-name, last-name, login, email, password"."\n";;
while($consulta = $bd->sig_reg($sql))  
{  
    echo $consulta['nombre'].$csv_sep.$consulta['apellido'].$csv_sep.$consulta['contrato'].$csv_sep.$consulta['email'].$csv_sep.$consulta['clave'].$csv_end;   
}   
$actualiza = $bd->consulta("update  inscripcion_curso SET estatus = 'G' where id_curso = '$aula' and estatus = 'P'");  
//Generamos el csv de todos los datos  
if (!$handle = fopen($csv_file, "w")) {  
    echo "Cannot open file";  
    exit;  
}  
if (fwrite($handle, utf8_decode($csv)) === FALSE) {  
    echo "Cannot write to file";  
    exit;  
}  

// Forzamos que el archivo se descargue con un nombre definido 
fclose($handle);  

?>  
