<?php 

include('conexion.php');
	
	$sql=mysql_query("SELECT * FROM usuarios where contrato = '7777'",$cnn);
	$usuario=mysql_fetch_array($sql);
	?>
    		<?php
			if($usuario['leccion_aprobada']>=7 || $usuario['leccion_aprobada']>=15)
			{
					if($usuario['leccion_aprobada']>=7)
					{
						 $c=$c+1;
						?>
				
			  <?php }
					if($usuario['leccion_aprobada']>=15)
					{
						 $c=$c+1;
						?>
				
			  <?php }
			  		if($usuario['leccion_aprobada']>=20)
					{ $c=$c+1;?>
					
			  <?php }
			  		if($usuario['leccion_aprobada']>=25)
					{  $c=$c+1;?>
				
			  <?php }
			  		if($usuario['leccion_aprobada']>=32)
					{  $c=$c+1;?>
				
			  <?php }
			  		if($usuario['leccion_aprobada']>=40)
					{  $c=$c+1;?>
				
			  <?php }
			  		if($usuario['leccion_aprobada']>=49)
					{  $c=$c+1;?>
				
			  <?php }
			
	  		}else{
				?> <?php }?>
           
    </div>
    
    
<?php 
 $promedio=round((100/7)*$c);
?>	

       <table width="746" height="48" border="0" align="center"  cellpadding="1" cellspacing="1"  >
  <tr  > 
    <td width="26" height="46" align="right" valign="middle"> 
      <div align="center"><font color="#000000" size="2" face="Verdana, Arial, Helvetica, sans-serif" class="letra"><b><?php echo "Conversacional"; ?></b></font></div></td>
    <td width="31" align="right" valign="middle"><span class="letra">0%</span></td>
    <td width="497" height="46"><table width="478" border="0" bordercolor="#FFFFFF" bgcolor="#FFFFFF">
        <tr>
          <td height="40" bgcolor="#CCCCCC"><font size="1" face="Verdana, Arial, Helvetica, sans-serif">

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