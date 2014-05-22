<?php
class imagen
{
	public $x;
	public $y;
	public $mensaje;
	public $error;
	public function __construct()
	{
		//imagecreatetruecolor();
		
	}
	public function thumbnail($original,$tamaño,$dx=0,$dy=0)
	{
		switch($this->extension($original))
		{
			case "png":
				$original = imagecreatefrompng($original);
			break;
			/*case "bmp":
				$original = $this->ImageCreateFromBMP($original);
			break;*/
			case "jpg":
				$original = imagecreatefromjpeg($original);
			break;
			/*default:
				$this->mensaje="formato de imagen incorrecto...";
				$this->error="error";
				return false;*/
		}
		$ancho = $ancho_d = imagesx($original);
		$alto = $alto_d = imagesy($original);
		if($tamaño)
		{
			$lados=$this->proporcion($ancho,$alto,$tamaño);
			$ancho_d=$lados['x'];
			$alto_d=$lados['y'];
		}
		$thumb = imagecreatetruecolor($ancho_d,$alto_d);
		imagecopyresampled($thumb,$original,0,0,$dx,$dy,$ancho_d,$alto_d,$ancho,$alto);

		return $thumb;
	}
	public function resize($img,$tamaño,$path,$nombre,$dx=0,$dy=0)
	{
		$imagen=$this->thumbnail($img,$tamaño,$dx,$dy);
		return imagejpeg($imagen,$nombre.".jpg",100);	
	}
	public function extension($archivo)
	{
		$ext=explode(".",$archivo);
		return $ext[1];
	}
	public function logo($thumb,$logo)
	{
		$logo = imagecreatefrompng($logo);
		imagecopyresampled($thumb,$logo,0,0,0,0,100,20,100,20);
		return $thumb;
	}
	public function proporcion($x,$y,$tamaño)
	{
		if($x>$y)
		{
			$mayor=$x;
			$menor=$y;
			$ancho=$tamaño;
			$alto="";
		}
		else
		{
			$mayor=$y;
			$menor=$x;
			$alto=$tamaño;
			$ancho="";
		}
		if($mayor>$tamaño)
		{
			//echo "mayor: $mayor<br>";
			//echo "menor: $menor<br>";
			$menor=$menor*$tamaño/$mayor;
			//echo "menor sin ceil: $menor<br>";
			$menor=ceil($menor);
			//echo "menor final: $menor<br>";
			if($ancho)
				$alto=$menor;
			else
				$ancho=$menor;
			$lados = array();
			$lados['x']=$ancho;
			$lados['y']=$alto;
			//print_r($lados);
			return $lados;
		}
		else
		{
			$lados = array();
			$lados['x']=$x;
			$lados['y']=$y;
			//print_r($lados);
			return $lados;
		}
	}
}
?>