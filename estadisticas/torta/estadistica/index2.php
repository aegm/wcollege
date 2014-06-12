<?php
include_once('conexion.php');
$sql=mysql_query("SELECT * FROM `usuarios` WHERE contrato='0035497' ",$cnn);
$row=mysql_fetch_array($sql);


?>
<html>
<head>
<title></title>
<style type="text/css">
.Form 
{
	text-align: right;
	vertical-align: middle;
	word-spacing: 0px;
	display: table;
	margin: 0px;
	padding: 0px;
	border: 0px none;
	clear: both;
}
a:link 
{
	color: #CCCCCC;
	text-decoration: none;
}
a:visited 
{
	color: #CCCCCC;
	text-decoration: none;
	}
a:hover 
{
	color: #CCCCCC;
	text-decoration: none;
}
a:active 
{
	color: #CCCCCC;
	text-decoration: none;
}
.Tablaforo 
{
	border-top-width: thin;
	border-right-width: thin;
	border-bottom-width: thin;
	border-left-width: thin;
	border-top-style: none;
	border-right-style: solid;
	border-bottom-style: solid;
	border-left-style: solid;
	border-right-color: #006600;
	border-bottom-color: #006600;
	border-left-color: #006600;
}
BODY 
{ 
	scrollbar-3d-light-color:#669966;
    scrollbar-arrow-color:#000000;
    scrollbar-base-color:#669966;
    scrollbar-dark-shadow-color:#669966;
    scrollbar-face-color:#9EBE9E;
    scrollbar-highlight-color:#9EBE9E;
    scrollbar-shadow-color:#eeeeee;
	
}
.letra {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: bold;
}
</style>
</head>
<body link="#336699" vlink="#336600" alink="#336699" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="629" height="88" border="0" align="center" cellpadding="1" cellspacing="1"  >
  <tr align="center" valign="middle"> 
    <td height="27" colspan="4"></td>
  </tr>
  <tr  > 
    <td width="51" height="58" align="right" valign="middle"> 
      <div align="center"><font color="#000000" size="2" face="Verdana, Arial, Helvetica, sans-serif" class="letra"><b><?php echo "Nivel 1"; ?></b></font></div></td>
    <td width="29" align="right" valign="middle"><span class="letra">0%</span></td>
    <td width="478" height="58"><table width="478" border="0" bordercolor="#FFFFFF" bgcolor="#FFFFFF">
        <tr>
          <td bgcolor="#CCCCCC"><font size="1" face="Verdana, Arial, Helvetica, sans-serif">
           <?php
		   if ($row['leccion_aprobada']==0) 
		   {
			 ?>
             
              <table width="0px" height="38px">
              <tr >
                <td  align="center"></td>
              </tr>
            </table>
            
             
             <?php  
		   }else{
		   ?>
				<?php if($row['leccion_aprobada']==0){ 
					//empty
						}else{ 
						 
				  if ($row['leccion_aprobada']<=15)
						{ 
				  	 $intPct1=round(  ( ($row['leccion_aprobada']*100)/15)  );
				  ?>
				  <strong><font size="2" color="#FFFFFF" face="Arial, Helvetica, sans-serif"> <?php echo $intPct1; ?>&nbsp;%</font></strong>
                     <table width="<?php printf("%2.2f",$intPct1); ?>%"   background="percentPix.jpg" height="38px">
                     
              <tr >
                <td  align="center">
                     </td>
              </tr>
            </table>
					  <?php
					}else{
						echo '
						 <table width="100%"   background="percentPix.jpg" height="38px">
								 
						  <tr >
							<td  align="center">
								 </td>
						  </tr>
						</table>
						';
						
					}
						?>		
                        
                        
                        
                        
                        
                        
                        
                        <?php
					if ( ($row['leccion_aprobada']<=25) )
						{
						?>
                                <strong>
                                    <font size="2" color="#FFFFFF" face="Arial, Helvetica, sans-serif"> 
                                        <?php
                                            $resta=($row['leccion_aprobada']-15);
                                         echo $resultado=round(  ( ($resta*100)/10)  ); ?>&nbsp;%
                                </font>
                                </strong>
                                 <table width="<?php printf("%2.2f",$resultado); ?>%"   background="percentPix.jpg" height="38px">
                                 
                          <tr >
                            <td  align="center">
                                 </td>
                          </tr>
                        </table>
				  <?php 	}else{
					      	  				$resta=($row['leccion_aprobada']-25);
					  				 echo $resultado=round(  ( ($resta*100)/31)  );
					  			if (($row['leccion_aprobada']>=26))
								{
										echo '
											<table width="100%"   background="percentPix.jpg" height="38px">
													 
											  <tr >
												<td  align="center">
													 </td>
											  </tr>
											</table>
											 '; 
					  					echo '
											<table width="'.printf("%2.2f",$resultado).'%"   background="percentPix.jpg" height="38px">
													 
											  <tr >
												<td  align="center">
													 </td>
											  </tr>
											</table>
											 '; 
								
										}else{
							
											echo '
											 <table width="100%"   background="percentPix.jpg" height="38px">
													 
											  <tr >
												<td  align="center">
													 </td>
											  </tr>
											</table>
											';
											}
							}
						?>		
                        
				  
				    
               
            
            <?php
		   }
		   }
			?>
          </font></td>
        </tr>
      </table></td>
    <td width="58" class="letra">100%</td>
  </tr>
</table>

</body>
</html>
