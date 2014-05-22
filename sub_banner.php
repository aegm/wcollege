<div id="subbanner">
      		<div class="margen_menu"></div>
            <div style="float:left"><a href="#" class="rolloverinstituto"></a></div>
            <div style="float:left"><a href="#" class="rolloverdondestamos"></a></div>
            <!--<div style="float:left"><a href="<?php /*echo 'inicio.php?lugar=foro';*/echo '#'; ?>" target="foro" class="rolloverforo"></a></div>-->
            <div style="float:left"><a href="<?php echo 'inicio.php?lugar=galeria';?>" class="rollovergaleria"></a></div>
            <?php if((isset($_SESSION['wc']['session'])))
			{?>
            	<div style="float:left"><a href="<?php echo 'inicio.php?lugar=descargas';?>" class="rolloverdescarga"></a></div>
            <?php 
			}?>
            <div style="float:left"><a href="<?php echo 'inicio.php?lugar=contactenos';?>" class="rollovercontacto"></a></div>
            <?php if(isset($_SESSION['wc']['nivel']) && ($_SESSION['wc']['nivel']=='a' || $_SESSION['wc']['nivel']=='s'|| $_SESSION['wc']['nivel']=='p')) {?>
            <div style="float:left"><a href="libro_demo.php" class="link"> |  LIBRO VIRTUAL</a></div>
            <?php } ?>
             
            
            <!--<div id="bottomPeople"><img src="images/bottomPeople.jpg"/></div>-->
      </div><!--Aqui termina el "subbanner"-->
      <div id="menuinferior">
            <?php echo " <a href='inicio.php?lugar=inicio' style='text-decoration:none; float:left;' class='txtmenuinferior' ><span >Inicio</span></a>";?>
            <?php echo " <a href='inicio.php?lugar=lecciones&lecc=#' style='text-decoration:none; float:left;' class='txtmenuinferior'><span >Temario</span></a>";?>
            <?php echo " <a href='inicio.php?lugar=evaluaciones' style='text-decoration:none; float:left;' class='txtmenuinferior'><span >Evaluar</span></a>";?>
            <?php echo " <a href='inicio.php?lugar=vocabulario' style='text-decoration:none; float:left;' class='txtmenuinferior'><span >Vocabulario</span></a>";?>
            <?php echo " <a href='inicio.php?lugar=videos' style='text-decoration:none; float:left;' class='txtmenuinferior'><span >Videos</span></a>";?>
</div><!--Aqui termina el "menuinferior"-->
<?php include('login_de_usuario.php');/*muestra el formulario para iniciar session en el lugar especificado antes de ser llamado*/ ?>

