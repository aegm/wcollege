<?php
class curso
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
	//*****************************************************
	
        public function guardar($txt_nombre, $txt_descripcion, $fecha_inicio, $fecha_fin, $slt_docente, $slt_precio, $slt_libro,$slt_tipo)
        {
            
            $sql = $this->db->query("INSERT INTO curso (nombre, fecha_ini, fecha_fin, id_docente, id_precio, descripcion,libro, id_tipo ) 
                                                 VALUES('$txt_nombre','$fecha_inicio','$fecha_fin','$slt_docente','$slt_precio','$txt_descripcion', $slt_libro, '$slt_tipo' )")or die($sql);
            
            if(!$sql)//si no hay errores
            {
                $this->mensaje = "Se registro el curso correctamente...";
		$this->msgTipo = "ok";
		$this->estatus = true;
	
            }
                 $this->json = json_encode($this);
		return $this->estatus;
        }  
         public function listar($id_libro)
         {
             if($id_libro)
                 $completa_sql = "where Libro = '$id_libro'";
             
             $sql = $this->db->query("select * from vcursos $completa_sql");
             if($sql->num_rows==0)
             {
                        $this->mensaje = "No se encontraron Cursos...";
			$this->msgTipo = "aviso";
			$this->estatus = false;
			$this->json = json_encode($this);
			return $this->estatus;
             }
             while($cursos=$sql->fetch_assoc())
		{
		 $cursos['Fecha De Inicio'] = fecha($cursos['Fecha De Inicio']);
                 $cursos['Fecha Fin'] = fecha($cursos['Fecha Fin']);	
                 
                 $this->datos[]=array_map("utf8_decode",$cursos);
		}
             //$this->datos = $sql->all();
		$this->mensaje = "Se ha listado los registros correctamente...";
		$this->msgTipo = "ok";
		$this->estatus = true;
		$this->json = json_encode($this);
		return $this->estatus;
         }
         
         public function generaOrden($curso,$persona)
         {
             $sql = "select * from ordenes_compra where id_persona = '$persona'";
             $verificar = $this->db->query($sql);
             if($verificar->num_rows==0)
             {
                 $fecha_actual = date("d/m/Y");
                 $fecha_unix = fecha($fecha_actual);
                 $insert = $this->db->query("INSERT INTO ordenes_compra (id_persona,id_estatus, fecha_creacion)VALUES('$persona','1','$fecha_unix')");
                 if(!$this->db->errno)//si no hay errores
                 {   
                 //obteniendo el ultimo id
                    $orden=$this->db->query("SELECT LAST_INSERT_ID() as 'id_orden' FROM ordenes_compra");
                    $orden=$orden->fetch_assoc();
                    $orden=$orden['id_orden'];
                    
                    $query = $this->db->query("insert into cursos_ordenes values ('$curso', '$orden')");
                     if($this->db->errno)//si no hay errores
                    {
                        $this->mensaje = "Ocurrio un error no se pudo generar la orden...";
			$this->msgTipo = "aviso";
			$this->estatus = false;
			$this->json = json_encode($this);
			return $this->estatus;
                     }
                 }
             }
         }
         
         public function listarOrden($id_persona){
             
              $sql = $this->db->query("select * from vordenes_pendienrtes where id_persona = '$id_persona'");
             if($sql->num_rows==0)
             {
                        $this->mensaje = "No se encontraron Cursos...";
			$this->msgTipo = "aviso";
			$this->estatus = false;
			$this->json = json_encode($this);
			return $this->estatus;
             }
             while($cursos=$sql->fetch_assoc())
		{
		 
                 $this->datos[]=$cursos;
		}
             //$this->datos = $sql->all();
		$this->mensaje = "Se ha listado los registros correctamente...";
		$this->msgTipo = "ok";
		$this->estatus = true;
		$this->json = json_encode($this);
		return $this->estatus;
         }
         
         public function inscribirCurso($persona,$curso,$pais){
             
             //VERIFICAMOS NO ESTAR INSCRITOS 
             $verficar = $this->db->consulta("select * from inscripcion_curso where id_persona = '$persona' and id_curso = '$curso'");
             
             if(!$this->db->num_filas($verficar)==0){
                        $this->mensaje = "Ya te Encuentras inscrito en el curso...";
			$this->msgTipo = "aviso";
                        $this->msgTitle = "Inscripcion Curso Online";
			$this->estatus = false;
			$this->json = json_encode($this);
			
             }else{
                $fecha_actual = date("d/m/Y");
                $fecha_unix = fecha($fecha_actual);
                $sql = $this->db->consulta("INSERT INTO inscripcion_curso (id_persona,id_curso, fecha_inscripcion,pais)VALUES('$persona','$curso','$fecha_unix','$pais')");
                if(!$this->db->my_error){
                $this->mensaje = "Inscripcion Exitosa";
		$this->msgTipo = "ok";
                $this->msgTitle = "Inscripcion Curso Online";
		$this->estatus = true;
		$this->json = json_encode($this);
                }
             }
		return $this->estatus;
         }
         
         public function alumnosInscritos(){
              $sql = $this->db->query("select * from vinscripciones");
             if($sql->num_rows==0)
             {
                        $this->mensaje = "No se encontraron Cursos...";
			$this->msgTipo = "aviso";
			$this->estatus = false;
			$this->json = json_encode($this);
			return $this->estatus;
             }
             while($cursos=$sql->fetch_assoc())
		{
		 $cursos['Fecha de Inscripcion'] = fecha($cursos['Fecha de Inscripcion']);
                 $this->datos[]=$cursos;
		}
             //$this->datos = $sql->all();
		$this->mensaje = "Se ha listado los registros correctamente...";
		$this->msgTipo = "ok";
		$this->estatus = true;
		$this->json = json_encode($this);
		return $this->estatus;
         }
         
         public function estado($pais)
         {
               $sql = $this->db->consulta("select * from estados where id_pais ='$pais'");
            
                while($consulta =  $this->db->sig_reg($sql))
		{
		 $this->datos[]=$consulta;
		}
             //$this->datos = $sql->all();
		$this->mensaje = "Se ha listado los registros correctamente...";
		$this->msgTipo = "ok";
		$this->estatus = true;
		$this->json = json_encode($this);
		return $this->estatus;
         }
          public function ciudad($estado)
         {
               $sql = $this->db->consulta("select * from ciudades where id_estado ='$estado'");
            
                while($consulta =  $this->db->sig_reg($sql))
		{
		 $this->datos[]=$consulta;
		}
             //$this->datos = $sql->all();
		$this->mensaje = "Se ha listado los registros correctamente...";
		$this->msgTipo = "ok";
		$this->estatus = true;
		$this->json = json_encode($this);
		return $this->estatus;
         }


         //************************************************************************
}
?>