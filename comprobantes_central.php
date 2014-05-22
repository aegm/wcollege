<?php 

if(isset($_SESSION['wc']['nivel']) && ($_SESSION['wc']['nivel']=='E'))
{	include('perfil_central.php');
	$contrato=$_SESSION['wc']['contrato'];
	$sql=$bd->consulta("SELECT * FROM usuarios where contrato = $contrato");
	$usuario=$bd->sig_reg($sql);
	?>
<script type="text/javascript">
<!--
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
//-->
</script>
<!-- C O M P R O B A N T E S -->
<div id="formulario_adm" style="text-align: center;">
    <h2>Solicitud de Comprabantes Disponible</h2>
    <?php
    if($usuario['leccion_aprobada']>=7 || $usuario['leccion_aprobada']>=15)
    {
    $usr  = $usuario['contrato'];
    $sql = $bd->consulta("SELECT * FROM usuario_comprobante WHERE contrato = '$usr' ORDER BY comprobante ASC");
    ?>		
    <table class="table" style="width: 100%;">
        <thead>
            <tr>
                <th>Listado de Comprobantes</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while($consulta = $bd->sig_reg($sql)){
            ?>
            <tr>
                <td>Comprantes para la prueba Oral Lección <?=$consulta['comprobante']?></td>
                <td><a onclick="solicitar(<?=$usuario['contrato']?>,<?=$consulta['comprobante']?>)">Solicitar</a></td>
            </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
    <?php
    }
    ?>
</div>
    <!--div id="formulario_adm" style="text-align:center">
    		<?php
			if($usuario['leccion_aprobada']>=7 || $usuario['leccion_aprobada']>=15)
			{
					if($usuario['leccion_aprobada']>=7)
					{?>
					<ul onClick="MM_openBrWindow('comprobante.php?aprobada=7','Comprobante','toolbar=yes,width=600px,height=450px')"><a href="#">Comprobante Para la prueba oral Leccion 7 Libro 1</a></ul>
			  <?php }
					if($usuario['leccion_aprobada']>=15)
					{?>
					<ul onClick="MM_openBrWindow('comprobante.php?aprobada=15','Comprobante','toolbar=yes,width=600px,height=450px')"><a href="#">Comprobante Para la prueba oral Leccion 15 Libro 1</a></ul>
			  <?php }
			  		if($usuario['leccion_aprobada']>=20)
					{?>
					<ul onClick="MM_openBrWindow('comprobante.php?aprobada=20','Comprobante','toolbar=yes,width=600px,height=450px')"><a href="#">Comprobante Para la prueba oral Leccion 20 Libro 2</a></ul>
			  <?php }
			  		if($usuario['leccion_aprobada']>=25)
					{?>
					<ul onClick="MM_openBrWindow('comprobante.php?aprobada=25','Comprobante','toolbar=yes,width=600px,height=450px')"><a href="#">Comprobante Para la prueba oral Leccion 25 Libro 2</a></ul>
			  <?php }
			  		if($usuario['leccion_aprobada']>=32)
					{?>
					<ul onClick="MM_openBrWindow('comprobante.php?aprobada=32','Comprobante','toolbar=yes,width=600px,height=450px')"><a href="#">Comprobante Para la prueba oral Leccion 7 Libro 3</a></ul>
			  <?php }
			  		if($usuario['leccion_aprobada']>=40)
					{?>
					<ul onClick="MM_openBrWindow('comprobante.php?aprobada=40','Comprobante','toolbar=yes,width=600px,height=450px')"><a href="#">Comprobante Para la prueba oral Leccion 15 Libro 3</a></ul>
			  <?php }
			  		if($usuario['leccion_aprobada']>=49)
					{?>
					<ul onClick="MM_openBrWindow('comprobante.php?aprobada=49','Comprobante','toolbar=yes,width=325px,height=400px')"><a href="#">Comprobante Para la prueba oral Leccion 24  Libro 3</a></ul>
			  <?php }
	  		}else
			{?><ul>No posee comprobante de ningun tipo</ul><?php }?>
           
    </div-->
<?php 
}else{
echo('Error, este usuario no tiene acceso al modulo Perfil de usuario');
}?>	






