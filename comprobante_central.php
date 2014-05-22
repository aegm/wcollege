<?php
include('administrador_central.php');
require_once("lib/PHPMailer/class.phpmailer.php");
require_once("lib/plantilla.class.php");
define("SMTP","localhost");
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
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
if(isset($_REQUEST))
    switch ($_POST['form']){
    case 'sol-comprobante':
        //$fecha_actual = UNIX_TIMESTAMP(CURDATE());
        $id_sol = $_POST['id_solicitud'];
        $sql = $bd->consulta("update sol_comprobantes set fecha_programada = UNIX_TIMESTAMP(CURDATE()), estatus_actual = 'G' where id_sol_comp = '$id_sol'");
        
        $sql_2 = $bd->consulta("Select  u.contrato,
                                            u.nombre,
                                            u.apellido,
                                            s.fecha_programada,
                                            u.email
                                    FROM
                                            sol_comprobantes s,
                                            usuarios u
                                    WHERE
                                            u.contrato = s.id_contrato 
                                            and s.id_sol_comp = '$id_sol'");
        $consultar=$bd->sig_reg($sql_2);        
        $titulo = 'Prueba al sistema'; 
                $usuario['usuario']  = $consultar[nombre];
                $usuario['apellido']  = $consultar[apellido];
                $usuario['fecha'] = fecha($consultar[fecha_programada]);
               // $usuario .= $consultar['apellido'];
                $para      = $consultar[email];
		$asunto = "Solicitud de Comprobante.";
			
                $cabeceras  = 'MIME-Version: 1.0' . "\r\n";
                $cabeceras .= 'Content-type: text/html; charset=utf-8' . "\r\n";
                $cabeceras .= 'From: wcollege <webmaster@'.$_SERVER['HTTP_HOST'].'>' . "\r\n";
                
                $html = new plantilla;
                $message = $html->html("plantilla_correo.html",$usuario);
                $mail = new PHPMailer();

			 /*******************************************configuracion de cuenta ****************************************/		
                        $mail->IsSMTP();
                        $mail->SMTPAuth   = true;                  // enable SMTP authentication
                        $mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
                        $mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
                        $mail->Port       = 465;                   // set the SMTP port

                        $mail->Username   = "angeledugo@gmail.com";  // GMAIL username
                        $mail->Password   = "megustaelfutbol";            // GMAIL password
                        

                        $mail->From     = "noresponder@wcollege.com";
                        $mail->FromName = "Washington College";
                //	$mail->Mailer   = "smtp";
                        $mail->Subject    = utf8_decode("Repuesta a solicitud");
                        $mail->AltBody    = "Si no puede ver este ingrese aqui"; //Text Body

                        $mail->MsgHTML(utf8_decode($message));

                        $mail->AddReplyTo("noresponder@wcollege.com","Webmaster");
                        $mail->AddAddress($para);

                        $mail->IsHTML(true); // send as HTML
                        if(!$mail->Send()){
                            echo "Mailer Error: " . $mail->ErrorInfo;
                          } else {
                            echo "Message has been sent";
                            /*$db->execute("INSERT INTO envio_marketing(id_campana_boletin, id_cliente, tipo_marketing)
                                                                                                    VALUE(".$_REQUEST['id_campana'].",".$_REQUEST['id_cliente'].",'C')");*/
                          }
        break;
    }
?>
<div class="cont_derecho_adm">
<p><strong> &nbsp;Administracion de Comprabantes</strong></p>
<form id="frm-fitro" action="" method="post">
    <input type="text" name="txt_filtro" id="txt_filtro"><input type="submit" id="btn_buscar" value="buscar">
</form>
    <div style="width:640px; float:left">
        <?php
        if(isset($_POST['txt_filtro']))
            $completa = "where contrato =".$_POST['txt_filtro'];
        
        $sql = $bd->consulta("select * from v_sol_comprobantes $completa ORDER BY id_comprobante ASC");
     
        
        ?>
        <table class="table" width="100%">
            <thead>
                <tr>
                    <th>Comprobante</th>
                    <th>Contrato</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Email</th>
                    <th>Accion</th>
                </tr>
            </thead>
            <tbody>
                <?php
                   while($consulta = $bd->sig_reg($sql)){
                ?>
                <tr>
                    <td><?=$consulta[id_comprobante]?></td><td><?=$consulta[contrato]?></td><td><?=$consulta[nombre]?></td><td><?=$consulta[apellido]?></td><td><?=$consulta[email]?></td><td><button id="form-comprobante" onclick="javascript:form_comprobante(<?=$consulta[id_sol_comp]?>)">G</button></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
<div id="dialog-form" title="Generar Solicitud">
  <!--p class="validateTips">Este Campo es Requerido.</p-->
  <form id="forma_comprobante"  action="inicio.php?lugar=comprobante" method="post">   
          <div class="input_text"> Fecha de presentacion
              <input type="text" required class="fecha" id="txt_fecha" name="txt_fecha"/>
              <input type="hidden" id="id_solicitud" name="id_solicitud">
              <input type="hidden" id="form" name="form" value="estatus-comprobante">
          </div>
  </form>
</div>
</div>