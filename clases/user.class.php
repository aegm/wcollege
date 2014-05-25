<?php
define("SISTEMA", "wc");

class user {

    private $con;
    public $usuario;
    public $nivel;
    public $nota_pagina;
    public $leccion;
    private $session = FALSE;
    public $mensaje;
    public $error;

    public function __construct() {
        $this->con = new db;
        if (isset($_SESSION[SISTEMA]['usuario'])) {
            $this->usuario = $_SESSION[SISTEMA]['usuario'];
            $this->nombre = $_SESSION[SISTEMA]['nombre'];
            $this->ultima = $_SESSION[SISTEMA]['ultima'];
            $this->session = $_SESSION[SISTEMA]['session'];
            $this->standby = $_SESSION[SISTEMA]['standby'];
            $this->mensaje = "Se cargo el usuario desde la session:";
        } else
            $this->session = FALSE;
    }

    public function agregar($nombre, $usuario, $clave) {
        if (!$usuario || !$nombre) {
            $this->mensaje = "Los Campos con (*) son obligatorios...";
            return false;
        }
        if (!$clave)
            $clave = RandomString(5, 1, 1, 0);
        $ultima = strtotime("now");
        $this->con->query("INSERT INTO usuarios VALUES (
		'$usuario',
		'$clave',
		'$nombre',
		'$ultima')");
        if ($this->con->num_error == 1062) {
            $this->error = "error";
            $this->mensaje = "El usuario ya existe, por favor elija otro";
            return false;
        }
        if ($this->con->num_error == 0) {
            $this->error = "ok";
            $this->mensaje = "Se ha registrado el usuario con exito...";
            $mensaje = "Usuario: $usuario <br>Clave: $clave";
            /* if(!send_mail($correo,"freedombusiness@hotmail.com","Registro de usuario", $mensaje))
              {
              $this->mensaje="No se pudo enviar el correo en estos momentos...";
              return false;
              } */
        } else {
            $this->mensaje = "El usuario no se pudo registrar..." . $this->con->my_error;
            return false;
        }
    }

    public function eliminar($usuario) {
        $this->con->query("DELETE FROM usuarios WHERE usuario='$usuario'");
        if ($this->con->num_error == 0) {
            $this->mensaje = "El usuario: $usuario, ha sido eliminado correctamente...";
            return true;
        } else {
            $this->mensaje = "ERROR al eliminar el usuario: $usuario...";
            return true;
        }
    }

    public function login($usuario, $clave) {

        $sql = $this->con->consulta("select * from usuarios where contrato = '$usuario' AND clave = $clave")or die("error");
        if ($consulta = $this->con->sig_reg($sql)) {

            $this->session = $_SESSION[SISTEMA]['session'] = true;
            $this->usuario = $_SESSION[SISTEMA]['usuario'] = $consulta['contrato'];
            $this->nombre = $_SESSION[SISTEMA]['nombre'] = $consulta['nombre'] . ' ' . $consulta['apellido'];
            $this->standby = $_SESSION[SISTEMA]['standby'] = strtotime("now");
            $this->nivel = $_SESSION['wc']['nivel'] = $consulta['nivel'];
            $this->nota_pagina = $_SESSION['wc']['nota_pagina'] = 0;
            $this->leccion = $_SESSION['wc']['leccion'] = $consulta['leccion_aprobada'];

            $this->mensaje = "Se ha iniciado session con exito...";
            $this->error = "ok";
            return true;
        } else {
            $this->error = "error";
            $this->mensaje = "El usuario y la contrase&ntilde;a son incorrectos...";
            return false;
        }
    }

    public function cargar() {
        $users = $this->con->query("SELECT * FROM usuarios WHERE usuario='$this->usuario'");
        if ($user = $this->con->a($users)) {
            $this->nombre = $user['nombre'];
            $this->ultima = $user['ultima'];
            $this->mensaje = "Usuario cargado...";
            return true;
        } else {
            $this->mensaje = "Usuario no encontrado...";
            return false;
        }
    }

    public function listar_cargos() {
        $SQL = $this->con->query("SELECT * FROM cargos WHERE ID_cargo>='$this->cargo'");
        if ($this->con->num_error == 0) {
            $this->mensaje = "Se obtuvo la lista de cargos...";
            return $SQL;
        } else {
            $this->mensaje = "No se obtuvo la lista de cargos...";
            return false;
        }
    }

    public function session() {
        return $this->session;
    }

    public function standby() {
// 		$standby=(strtotime("now") - $this->standby);
// 		if($standby>=15*60)
// 		{
        ?>
        <!--<script>
                alert("El sistema ha sido cerrado automaticamente por inactividad");
                parent.location.href = 'cerrar_session.php';
        </script>-->
        <?php
// 		}
// 		else
// 			$_SESSION[SISTEMA]['standby']=strtotime("now");
    }

    public function cambiar_pass($clave_actual, $clave) {
        if (!$this->session) {
            $this->mensaje = "No hay session...";
            $this->error = "error";
        } else {
            $usuarios = $this->con->query("SELECT * FROM usuarios WHERE usuario='$this->usuario' AND clave='$clave_actual'");
            if (!$this->con->a($usuarios)) {
                $this->mensaje = "La contrase&ntilde;a actual es incorrecta...";
                $this->error = "error";
                return false;
            } else {
                $this->con->query("UPDATE usuarios SET clave='$clave' WHERE usuario='$this->usuario'");
                $this->mensaje = "Su contrase&ntilde;a ha sido cambiada con exito...";
                $this->error = "ok";
                return true;
            }
        }
    }

    public function listarAlumnoAula($usuario) {
        if (isset($usuario))
            $sql = $this->con->consulta("select * from v_user_aula where contrato = '$usuario'");
        if ($this->con->num_error == 0) {
            $this->mensaje = "Se obtuvo la lista de cargos...";
            return $sql;
        } else {
            $this->mensaje = "No se obtuvo la lista de cargos...";
            return false;
        }
    }

    public function logout() {
        foreach ($_SESSION[SISTEMA] as $i => $valor)
            unset($_SESSION[SISTEMA][$i]);
    }

    public function __destruct() {
        
    }

}

/* $usuario=new user;
  $usuario->agregar("admin","Gilberto Lopez","123");

  $pass=md5("123");
  $usuario->login("admin",$pass);
  echo $usuario->mensaje;

  if($usuario->session())
  echo "User: iniciada";
  else
  echo "User: cerrada";
  if(isset($_SESSION[SISTEMA]['usuario']))
  echo "\nesta definida";
  else
  echo "\nno esta definida"; */
?>