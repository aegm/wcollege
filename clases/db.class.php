<?php 

/*define("DB_HOST","mysql500.ixwebhosting.com");
define("DB_NAME","C243473_curso");
define("DB_USER","C243473_curso");
define("DB_PORT","3306");
define("DB_PASS","CisneroS2010");*/
define("DB_HOST","localhost");
define("DB_NAME","wcollege");
define("DB_USER","root");
define("DB_PORT","3306");
define("DB_PASS","");
class db
{
	private $dbhost;
	private $dbport;
	private $dbname;
	private $dbuser;
	private $dbpass;
	public $dblink;
	public $mensaje;
	public $my_error;
	public $num_error;
	public function __construct($dbhost=DB_HOST, $dbport=DB_PORT, $dbname=DB_NAME, $dbuser=DB_USER, $dbpass=DB_PASS)
	{
		$this->dbhost=$dbhost;
		$this->dbport=$dbport;
		$this->dbname=$dbname;
		$this->dbuser=$dbuser;
		$this->dbpass=$dbpass;
		$this->dblink=@mysql_connect("$dbhost:$dbport",$dbuser,$dbpass);
		if($this->dblink)
		{
			if(mysql_select_db($this->dbname,$this->dblink))
				$this->mensaje="La conexi&oacute;n a $dbname, ha sido exitosa.";
			else
				$this->mensaje="No se pudo seleccionar la base de datos: $dbname.";
			$this->my_error=mysql_error($this->dblink);
			$this->num_error=mysql_errno($this->dblink);
		}
		else
			$this->mensaje="Error al conectarse a la base de datos. ($dbhost)";
	}
	public function getHost()
	{
		return $this->dbhost;
	}
	public function getName()
	{
		return $this->dbname;
	}
	public function consulta($query)
	{
		mysql_query("SET CHARACTER SET utf8",$this->dblink);
		mysql_query("SET NAMES utf8",$this->dblink);
		$result=mysql_query($query,$this->dblink);
		if($result)
			$this->mensaje="La consulta: '$query' se ha realizado con &eacute;xito.";
		else
			$this->mensaje="Error en la consulta.";
		$this->my_error=mysql_error($this->dblink);
		$this->num_error=mysql_errno($this->dblink);
		return $result;
	}
	public function sig_reg($result)
	{	
		return mysql_fetch_assoc($result);
	}
	public function num_filas($sql)
	{
		return mysql_num_rows($sql);
	}
	public function __destruct()
	{
		@mysql_close($this->dblink);
	}
}
?>