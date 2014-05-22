<?php
class comprobante
{
	private $db;
	public $mensaje;
	public $msgTipo;
	public $msgTitle;
	public $datos="";
	public $json="";
	public $estatus;
	
        public function __construct()
	{
		$this->db = new db;
	}
        
        public function solicitar($usr, $comprobante){
            $sql = $this->db->consulta("select * from sol_comprobantes where id_contrato = '$usr' and id_comprobante = '$comprobante'");
           // $sql = $this->db->consulta("select * from sol_comprobantes where id_contrato = '$usr' and id_comprobante = '$comprobante'");
            //die("llego");
            if(!$this->db->num_filas($sql)==0){
                        $this->mensaje = "Ya Realizastes esta Solicitud...";
			$this->msgTipo = "aviso";
                        $this->msgTitle = "Inscripcion Curso Online";
			$this->estatus = false;
			$this->json = json_encode($this);
			
             }else{
               $insertar = $this->db->consulta("INSERT INTO sol_comprobantes (id_contrato, id_comprobante) VALUES('$usr', '$comprobante')");
                 if(!$this->db->my_error){
                     $this->mensaje = "Solicitud Exitosa";
                    $this->msgTipo = "ok";
                    $this->msgTitle = "Solicitud de Comprobante";
                    $this->estatus = true;
                    $this->json = json_encode($this);
                 }
             }
            
        }
}
?>