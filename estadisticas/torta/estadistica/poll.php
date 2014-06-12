
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
</style>
</head>
<body link="#336699" vlink="#336600" alink="#336699" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="466" height="87" border="0" cellpadding="1" cellspacing="1" bgcolor="#999999">
  <tr align="center" valign="middle" bgcolor="#33CC66"> 
    <td height="27" colspan="2"><strong><font color="#000000" size="2" face="Verdana, Arial, Helvetica, sans-serif">Porcentaje </font></strong><?
	    
		echo $intPct1=((7*100)/15);
		
		 ?> %   </td>
  </tr>
  <tr bgcolor="cccccc"> 
    <td width="107" height="26" align="right" valign="middle"> 
      <div align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif" color="#000000"><b><? echo "Nivel 1"; ?></b></font></div></td>
    <td width="352" height="26"><font size="1" face="Verdana, Arial, Helvetica, sans-serif">&nbsp;&nbsp;</font>
<table width="200" border="1" bordercolor="#FFFFFF" bgcolor="#FFFFFF">
        <tr>
          <td><font size="1" face="Verdana, Arial, Helvetica, sans-serif">
            <table width="<?php printf("%2.2f",$intPct1); ?>%"  border="2" bgcolor="#000000">
              <tr >
                <td ></td>
              </tr>
            </table>
          </font></td>
        </tr>
      </table></td>
  </tr>
  <tr align="center" valign="top" bgcolor="#33CC66"> 
    <td height="30" colspan="2" valign="middle"> 
      <div align="center"><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><a href="javascript:window.close();"><b> 
    Cerrar</b></a></font></div></td>
  </tr>
</table>
</body>
</html>
