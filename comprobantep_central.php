<?php
include('administrador_central.php');
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
    case 'estatus-comprobante':
        //$fecha_actual = UNIX_TIMESTAMP(CURDATE());
        $id_sol = $_POST['id_solicitud'];
        $estatus = $_POST['slt_estatus'];
        $sql = $bd->consulta("update sol_comprobantes SET  estatus_actual = '$estatus' where id_sol_comp = '$id_sol'");
        break;
    }
?>
<div class="cont_derecho_adm">
<p><strong> &nbsp;Administracion de Comprabantes</strong></p>
    <div style="width:640px; float:left">
        <?php
        $sql = $bd->consulta("select * from v_sol_comp_proce ORDER BY id_comprobante ASC");
     
        
        ?>
        <table class="table" width="100%">
            <thead>
                <tr>
                    <th>Comprobante</th>
                    <th>Contrato</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Email</th>
                    <th>Fecha Programada</th>
                    <th>Accion</th>
                </tr>
            </thead>
            <tbody>
                <?php
                   while($consulta = $bd->sig_reg($sql)){
                ?>
                <tr>
                    <td><?=$consulta[id_comprobante]?></td><td><?=$consulta[contrato]?></td><td><?=$consulta[nombre]?></td><td><?=$consulta[apellido]?></td><td><?=$consulta[email]?></td><td><?=fecha($consulta[fecha_programada])?></td><td><button id="form-comprobante"onclick="javascript:procesa_comprobante(<?=$consulta[id_sol_comp]?>)">T</button></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
<div id="dialog-form" title="Generar Solicitud">
  <!--p class="validateTips">Este Campo es Requerido.</p-->
  <form id="forma_comprobante"  action="inicio.php?lugar=comprobantep" method="post">   
          <div class="input_text"> Fecha de presentacion
              <select id="slt_estatus" name="slt_estatus" required="">
                  <option value="">Seleccione</option>
                  <option value="A">Aprobado</option>
              </select>
              <input type="hidden" id="id_solicitud" name="id_solicitud">
              <input type="hidden" id="form" name="form" value="estatus-comprobante">
          </div>
  </form>
</div>
</div>