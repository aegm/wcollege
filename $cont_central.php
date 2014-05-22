<div class="central">
	<?php
	
		if(isset($_GET['lugar']) && $_GET['lugar']<>'inicio.php' )
				include($_GET['lugar']. '_central.php');
				?>
       
       <?php if ($_GET['lugar']=="inicio"||$_GET['lugar']=="lecciones"||$_GET['lugar']=="leccion"||$_GET['lugar']=="evaluaciones"||$_GET['lugar']=="videos"||$_GET['lugar']=="video"){?>
       		<div id="traductor">
                <div style="padding-left:10px; padding-top:25px; width:200px; height:419px">
                   
                        
                         <img src="images/Title_traductor.jpg" style="padding:0px;"/>
                        <?php include('traductor.html');?>	
                        
                </div>
	   		</div>
    	<?php }?>		
</div>
