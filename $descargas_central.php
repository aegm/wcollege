<?php 
if((isset($_SESSION['wc']['session'])))
{	?>
    <center>
        <div style="font-size:18px;">
            <p style="font-size:24px">PUEDES DESCARGAR LOS SIGUIENTES ARCHIVOS</p>
            <?php 
           /* echo "<a href='downloads.php?doc=libros.pdf'>LIBROS</a><br>";*/
            echo "<a href='downloads.php?doc=downloads/Libro3_WEC.pdf'>English Book Level III</a><br>";
            //echo "<a href='downloads.php?doc=Videos.pdf'>VIDEOS</a><br>";
            
            ?>
        </div>
    </center>
	<?php 
}else
{
	?>
	<script type="text/javascript">
    alert("Error: Debe Iniciar session para poder descargar archivos");
    </script>
    <?php	
}?>