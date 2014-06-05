<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
include_once '../clases/db.class.php';
include_once '../clases/curso.class.php';
include_once '../clases/user.class.php';
include_once '../clases/comprobante.class.php';
include_once '../clases/Gallery.php';

$bd=new db;
switch ($_REQUEST['a'])
{
    case 'grafico':
        $user = new user();
        $user->verificaProgreso();
        $datos['datos'] = array("progreso_one" => $user->progreso_one,"progreso_two" => $user->progreso_two,"progreso_tree" => $user->progreso_tree);
        $datos['estatus'] = true;
        echo json_encode($datos);
        return true;
        break;
    case 'inscribir-curso':
        $curso = new curso;
        $curso->inscribirCurso($_GET['contrato'], $_GET['nivel'],$_GET['pais']);
        echo $curso->json;
        break;
    case 'listar-estado':
        $curso = new curso;
        $curso->estado($_GET['pais']);
        echo $curso->json;
        break;
    case 'listar-ciudades':
        $curso = new curso;
        $curso->ciudad($_GET['estado']);
        echo $curso->json;
        break;
     case 'solicitar-comprobante':
        $compro = new comprobante;
        $compro->solicitar($_GET['usuario'],$_GET['comprobante']);
        echo $compro->json;
        break;
    case 'cargar-imagen':
                   
                    //obtenemos el objeto de la imagen
                    $objFile = $_FILES['file_name'];
                    for($iFile=0;$iFile<count($objFile['name']);$iFile++)
                    {
                        $objcurrentFile = array(
                            'name' => $objFile['name'],
                            'tmp_name' => $objFile['tmp_name'],
                            'size' => $objFile['size']
                        );  
                        $img = new Gallery($objcurrentFile,false);
                        //LE INDICAMOS EL ARCHIVO TEMPORAL 
                        $id = $_SESSION['id'];
                        $img->buscarTmp('../images/Galeria'.$id.'/');
                        
                        //VERIFICAMOS QUE EL ARCHIVO TENGA COMO MAXIMO EL TAMAÑO INDICADO Y TENGA LAS SIGUIENTES EXTENCIONES
                        $img->setMaxFileSizeAllowed(180000000)->setAllowedExtension(array(
                            'jpg',
                            'gif',
                            'png'
                        ));
                        //verificamos si la inspeccion tiene directorio  creado
                         if($img->directoriFile($id)){  
                        if($img->uploadFile()){
                                echo "el archivo a sido subido y su tamaño es de ".$img->getFileSize()." bytes";
                            }else{
                                //verificamos el estatus del error en el caso de que no halla subido el archivo
                                switch ($img->getUploadEstatus())
                                {
                                    case $img->estatusCodeIs('FILE_UPLOADED'):

                                        break;
                                    case $img->estatusCodeIs('FILE_NOT_ESPEFIED'):
                                        echo "Archivo no especificado por favor verifica tu seleccion";
                                        break;
                                    case $img->estatusCodeIs('MAX_FILE_SIZE_ERROR'):
                                        echo "El tamaño del archivo supera el tamaño permitido";
                                        break;
                                }                   
                        }
                         }
                    }
        break;
                                    case 'guardar-evento':
                                        $descrip = $_GET['evento'];
                                        $sql = $bd->consulta("insert into img_subcategorias (id_categoria,descripcion)values('Eventos','$descrip')")or die();

                                        //verificamos el ultimo registro insertado
                                        $ultimo_id = $bd->consulta("SELECT LAST_INSERT_ID() as 'id_categoria' FROM img_subcategorias")or die("asd");
                                        $id=$bd->sig_reg($ultimo_id);  
                                        $id = $id['id_categoria'];
                                        $_SESSION['id'] = $id;
                                        //almacenando la foto
                                        //$sql2 = $bd->consulta("insert into img_fotos (descripcion, id_subcategoria)values('$descrip','$id')")or die("error");
                                        $datos = array();
                                        $datos['estatus'] = true;
                                        $datos['datos'] = $id;
                                        echo json_encode($datos);
                                        break;
                                    case 'cambiar-estatus':
                                        $sql = $bd->consulta("update img_subcategorias set estatus = ".$_GET['estatus']." where id_sub_categoria = ".$_GET['id']);
                                         $datos['estatus'] = true;
                                         echo json_encode($datos);
                                        break;
}


function fecha($fecha,$o = "")
	{
		if(!$fecha)
			return "";
		if(is_numeric($fecha))
			return date("d/m/Y",$fecha);
		else
		{
			$fecha = explode("/",$fecha);
			$fecha = $fecha[2]."-".$fecha[1]."-".$fecha[0];
			return strtotime($fecha);
		}
	}

?>
