<?php
session_start();
if((isset($_SESSION['wc']['session'])))
{	
        set_time_limit(0); 
        ini_set('memory_limit', '300M');
        $root = "downloads/";
        $file = basename($_GET['doc']);
       
        $path = $root.$file;
        $type = '';
        if (is_file($path)) {
            $size = filesize($path);
            if (function_exists('mime_content_type')) {
            $type = mime_content_type($path);
            }else if (function_exists('finfo_file')) {
                $info = finfo_open(FILEINFO_MIME);
                $type = finfo_file($info, $path);
                finfo_close($info);
            }
            if ($type == '') {
            $type = "application/force-download";
            }   
            
            header ("Content-Type: $type");
            header("Content-Disposition: attachment; filename=$file");
            header("Content-Transfer-Encoding: binary");
            header ("Content-Length: ".filesize($file));
            ob_clean(); 
            flush();
            readfile($path);
            exit;
        }else{
            flush();
            die("El archivo no existe.");
        }
}else
{
	die("El archivo no existe.");
}
?>