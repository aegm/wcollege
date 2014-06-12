<?php 
session_start();
				include_once('conexion.php');
				$sql=mysql_query("SELECT * FROM `usuarios` WHERE contrato='".$_SESSION['wc']['contrato']."' ",$cnn);
				$usuario=mysql_fetch_array($sql);

			if($usuario['leccion_aprobada']>=7 || $usuario['leccion_aprobada']>=15)
			{
					if($usuario['leccion_aprobada']>=7)
					{
						
						 $com=$com+1; ?>
			  <?php }
					if($usuario['leccion_aprobada']>=15)
					{
						 $com=$com+1;?>
			  <?php }
			  		if($usuario['leccion_aprobada']>=20)
					{
						 $com=$com+1;?>
			  <?php }
			  		if($usuario['leccion_aprobada']>=25)
					{
						 $com=$com+1;?>
			  <?php }
			  		if($usuario['leccion_aprobada']>=32)
					{
						 $com=$com+1;?>
				
			  <?php }
			  		if($usuario['leccion_aprobada']>=40)
					{
						 $com=$com+1;?>
					
			  <?php }
			  		if($usuario['leccion_aprobada']>=49)
					{
						 $com=$com+1;
						
					}
			}?>
					
		
           
 
<?php
	if ($com>=1) {
 $promedio=round((100/7)*$com);
 
}else{
$promedio=0;	
}
?>

       <table width="746" height="88" border="0" align="center"  cellpadding="1" cellspacing="1"  >
  <tr align="center" valign="middle"> 
    <td height="27" colspan="4"></td>
  </tr>
  <tr  > 
    <td width="26" height="58" align="right" valign="middle"> 
      <div align="center"><font color="#000000" size="2" face="Verdana, Arial, Helvetica, sans-serif" class="letra"><b><?php echo "Conversacional"; ?></b></font></div></td>
    <td width="31" align="right" valign="middle"><span class="letra">0%</span></td>
    <td width="497" height="58"><table width="478" border="0" bordercolor="#FFFFFF" bgcolor="#FFFFFF">
        <tr>
          <td bgcolor="#CCCCCC"><font size="1" face="Verdana, Arial, Helvetica, sans-serif">

				      <table width="<?php printf("%2.2f",$promedio); ?>%"   height="38px" style=" background:url(images/percentPix.jpg);">
                     
              <tr >
                <td  align="center">  <strong><font size="2" color="#FFFFFF" face="Arial, Helvetica, sans-serif"> <?php echo $promedio; ?>&nbsp;%</font></strong>
               
                     </td>
              </tr>
            </table>
                   </font></td>
        </tr>
      </table></td>
    <td width="179" class="letra">100%</td>
  </tr>
</table>
