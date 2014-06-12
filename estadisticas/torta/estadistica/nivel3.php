<?php
session_start();
include_once('conexion.php');
$sql = mysql_query("SELECT * FROM `usuarios` WHERE contrato='" . $_SESSION['wc']['contrato'] . "' ", $cnn);
$row = mysql_fetch_array($sql);

$nivel1 = $row['leccion_aprobada'];
if ($nivel1 <= 26) {

    $intPct = "0";
} else {
    if ($nivel1 >= 56) {
        $intPct = "100";
        $cantidad3 = $intPct;
    } else {


        if (($nivel1 >= 26) or ( $nivel1 <= 56)) {
            $resta = ($row['leccion_aprobada'] - 25);
            $intPct = round(( ($resta * 100) / 31));
            $cantidad3 = $intPct;
        }
    }
}
$_SESSION['cantidad_nivel3'] = $cantidad3;
?>
<table width="629" height="88" border="0" align="center" cellpadding="1" cellspacing="1"  >
    <tr align="center" valign="middle"> 
        <td height="27" colspan="4"></td>
    </tr>
    <tr  > 
        <td width="51" height="58" align="right" valign="middle"> 
            <div align="center"><font color="#000000" size="2" face="Verdana, Arial, Helvetica, sans-serif" class="letra"><b><?php echo "Nivel 3"; ?></b></font></div></td>
        <td width="29" align="right" valign="middle"><span class="letra">0%</span></td>
        <td width="478" height="58"><table width="478" border="0" bordercolor="#FFFFFF" bgcolor="#FFFFFF">
                <tr>
                    <td bgcolor="#CCCCCC"><font size="1" face="Verdana, Arial, Helvetica, sans-serif">

                        <table width="<?php printf("%2.2f", $intPct); ?>%"   style="background:url(images/percentPix.jpg);"height="38px">

                            <tr >
                                <td  align="center">  <strong><font size="2" color="#FFFFFF" face="Arial, Helvetica, sans-serif"> <?php echo $intPct; ?>&nbsp;%</font></strong>

                                </td>
                            </tr>
                        </table>
                        </font></td>
                </tr>
            </table></td>
        <td width="58" class="letra">100%</td>
    </tr>
</table>


