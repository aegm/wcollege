<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 * @utor : Ing. Angel Gonzalez
 * observaciones del objeto
 */
class Gallery
{
    private $folderTemp;
    private $imgExt = array();
    private $imgFile;
    private $fileLocation;
    private $filePrefix;
    private $iMaxFileSizeAllowed;
    private $estatusUpload;
    public $datos = "";
    public $json;
    const UPLOADING_ERROR=1,FILE_UPLOADED = 2,NOT_ALLOWED_EXT = 3,MAX_FILE_SIZE_ERROR = 4, FILE_NOT_ESPEFIED = 5;

    

    public function __construct($file,$blnFilePrefix = true) {
        
        $this->filePrefix = ($blnFilePrefix)?substr(md5(uniqid(rand())),0,6):'';
        $this->imgFile = $file;
    }
    public function estatusCodeIs($constante)
    {
        switch ($constante){
            case 'FILE_UPLOADED':
                return self::FILE_UPLOADED;
                break;
            case 'FILE_NOT_SPECIFIED':
                return self::FILE_NOT_ESPEFIED;
                break;
            case 'MAX_FILE_SIZE_ERROR':
                return self::MAX_FILE_SIZE_ERROR;
                break;
            case 'NOT_ALLOWED_EXT':
                return self::NOT_ALLOWED_EXT;
                break;
            default :
                return -1;
        }
    }
    private function setImageTemp($strPath){
        //indicandole el lugar de almacenamieno de la imagen temporal
        $this->fileLocation = $strPath.$this->filePrefix.$this->imgFile['name'];
        return $this;
    }
    
    public function buscarTmp($path){
        self::setImageTemp($path);
        $this->folderTemp = $path;
        return $this;
    }
    
    public function getMaxFileSizeAllowed(){
        return $this->iMaxFileSizeAllowed;
    }
    
    public function setMaxFileSizeAllowed($iMaxFileSizeAllowed)
    {
        $this->iMaxFileSizeAllowed = $iMaxFileSizeAllowed;
        return $this;
    }
    
    public function setAllowedExtension(array $imgExt){
        $this->imgExt = $imgExt;
        return $this;
    }
    
    private function isAllowedExtension()
    {
       //verifcamos a traves de comparacion de array si existe la extencion
        //print_r($this->imgFile);
        return (in_array(pathinfo($this->imgFile['name'],PATHINFO_EXTENSION), $this->imgExt));
    }
    
    public function uploadFile()
    {
        
        //verificamos que venga un archivo 
        if($this->imgFile['name']!= ''){
            if($this->isAllowedExtension())
            {
                //verifcamos que el tamaño permitido sea menor que el tamaño del objeto
                if($this->getFileSize() > $this->getMaxFileSizeAllowed()){
                    $this->estatusUpload = self::MAX_FILE_SIZE_ERROR;
                    return false;
                }else{
                    //die($this->fileLocation);
                    //viamos el archivo a la carpeta temporal y validamos el envio usando copy
                   
                    if(move_uploaded_file($this->imgFile['tmp_name'], $this->fileLocation))
                    {
                        //die($this->fileLocation);
                        rename($this->fileLocation, $this->folderTemp.$_SESSION['id'].'.jpg');
                        // die($this->fileLocation);
                        $this->estatusUpload = self::FILE_UPLOADED;
                        return true;
                    }else{
                        $this->estatusUpload = self::UPLOADING_ERROR;
                        return false;
                                
                    }
                }
            }else{
                $this->estatusUpload = self::NOT_ALLOWED_EXT;
                return false;
            }
        }else{
            $this->estatusUpload = self::FILE_NOT_ESPEFIED;
            return false;
        }   
    }
    
    public function getFileSize()
    {
        return $this->imgFile['size'];
    }
    public function getUploadEstatus()
    {
        return $this->estatusUpload;
    }
    
    public function directoriFile($dir){
        //verficamos si el directorio existes 
        $directorio = '../images/Galeria'.$dir.'/';
        if(file_exists($directorio)){
            echo "si existe";
            return true;
        }else{
           //CREAMOS EL DIRECTORIO 
            mkdir ($directorio,0755);
            //VERIFICAMOS QUE LOS QUE SE CREO ES UN DIRECTORIO O CARPETA 
            if(is_dir($directorio))
            {
               // echo "si es un directorio creado";
                return true;
            }else{
                $this->estatusUpload = self::FILE_UPLOADED;
                return false;
            }
        }
    }
    public function getImagesGallery(){
        $directory = $this->folderTemp;
        if(is_dir($directory)){
            $archivos = scandir($directory);    
             $cantidad = count($archivos);
                    for ($i = 0; $i < $cantidad; $i++){
                        if($archivos[$i] != '.' && $archivos[$i] !='..' && $archivos[$i]!='Thumbs.db' && $archivos[$i] != '.svn'){
                              $data['datos'][] = $this->fileLocation.'/'.$archivos[$i];
                        $this->datos['images'][] = $archivos[$i];
                        }
                        
                    }
                  
        }
        
        $this->json = json_encode($data);
          return true;
    }
}

