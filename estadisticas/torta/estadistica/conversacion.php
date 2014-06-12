	<?php 
session_start();
				include_once('conexion.php');
				$sql=mysql_query("SELECT * FROM `videos_situacionales_evaluados` WHERE contrato='".$_SESSION['wc']['contrato']."' ",$cnn);
				while($row=mysql_fetch_array($sql)){
				$nota=$row['nota'];
				
				$contar=$contar+1;
							
							
						
										} 
					$total=round(  ( ($contar*100)/5)  );
					$_SESSION['total_conversacion']=$contar;
					 
				  ?>
                  <table width="712" height="88" border="0" align="center" cellpadding="1" cellspacing="1"  >
  <tr align="center" valign="middle"> 
    <td height="27" colspan="4"></td>
  </tr>
  <tr  > 
    <td width="47" height="58" align="right" valign="middle"> 
      <div align="center"><font color="#000000" size="2" face="Verdana, Arial, Helvetica, sans-serif" class="letra"><b><?php echo "Comprensión"; ?></b></font></div></td>
    <td width="21" align="right" valign="middle"><span class="letra">0%</span></td>
    <td width="478" height="58"><table width="478" border="0" bordercolor="#FFFFFF" bgcolor="#FFFFFF">
        <tr>
          <td bgcolor="#CCCCCC"><font size="1" face="Verdana, Arial, Helvetica, sans-serif">

				      <table width="<?php printf("%2.2f",$total); ?>%"   style="background:url(images/percentPix.jpg);"height="38px">
                     
              <tr >
                <td  align="center">  <strong><font size="2" color="#FFFFFF" face="Arial, Helvetica, sans-serif"> <?php echo $total; ?>&nbsp;%</font></strong>
               
                     </td>
              </tr>
            </table>
                   </font></td>
        </tr>
      </table></td>
    <td width="153" class="letra">100%</td>
  </tr>
</table>

					  <?php
					
					?>
   