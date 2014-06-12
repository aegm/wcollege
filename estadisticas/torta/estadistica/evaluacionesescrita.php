	<?php 
session_start();
				include_once('conexion.php');
				$valor = '';
                                $c = '';
                                $sql=mysql_query("SELECT * FROM `ee_evaluacion_asignada` WHERE usuario_contrato='".$_SESSION['wc']['contrato']."' and nota<>'0'",$cnn);
				while($row=mysql_fetch_array($sql)){
				  $c=$c+1;
                                  $valor = $valor + $row['nota'];
				}
					 $p=(($valor*100)/$c );
				  ?>

       <table width="662" height="88" border="0" align="center"  cellpadding="1" cellspacing="1"  >
  <tr align="center" valign="middle"> 
    <td height="27" colspan="4"></td>
  </tr>
  <tr  > 
    <td width="26" height="58" align="right" valign="middle"> 
      <div align="center"><font color="#000000" size="2" face="Verdana, Arial, Helvetica, sans-serif" class="letra"><b><?php echo "Gramatica"; ?></b></font></div></td>
    <td width="31" align="right" valign="middle"><span class="letra">0%</span></td>
    <td width="530" height="58"><table width="478" border="0" bordercolor="#FFFFFF" bgcolor="#FFFFFF">
        <tr>
          <td bgcolor="#CCCCCC"><font size="1" face="Verdana, Arial, Helvetica, sans-serif">

				      <table width="<?php printf("%2.2f",$p); ?>%"   height="38px" style=" background:url(images/percentPix.jpg);">
                     
              <tr >
                <td  align="center">  <strong><font size="2" color="#FFFFFF" face="Arial, Helvetica, sans-serif"> <?php echo round($p); ?>&nbsp;%</font></strong>
               
                     </td>
              </tr>
            </table>
                   </font></td>
        </tr>
      </table></td>
    <td width="146" class="letra">100%</td>
  </tr>
</table>
