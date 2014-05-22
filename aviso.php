<style>
    h2{color: white; }
    h3{font-weight: normal;color: white;
        }
    
    .separador{border-bottom: 2px #ff1e2d solid; float: left; width: 100%; }
    #aviso_img{
        background-color: #00309d;
        width: 100%;    
    }
    
    #aviso_img #area_title{
         float: left;
         width:53%;
         background-color: #00309d;
         line-height: 36px;
         text-align: center;   
            
    }
    
    #aviso_img #area_img{
         float: left;
         width:35%;
         background-color:#000068;
       
    }
    #aviso_img #area_msg{
         float: left;
         background-color:#00309d;
         height: 100%;
         width:95.8%;
         padding: 2%;
         text-align: right;
        
    }
   
    
</style>
<?php
    if(!(isset($bd)))
	require_once('clases/db.class.php');
	$bd=new db;	
	
        $sql = $bd->consulta("select * from mensajes where estatus = '1'");
          while($mensaje = $bd->sig_reg($sql)){
          $html .= "<div id='aviso_img'>";
          $html .= "<div id='area_title'><h2>".$mensaje[title]."</h2></div>";
          $html .= "<div id='area_img'><img src='images/logo.png'></div><br><br>";
          $html .= "<div id='' class='separador'></div>";
          $html .= "<div id='area_msg'><h3>".$mensaje[mensaje]."</h3></div>";
          $html .= "<div id='cerrar_aviso' class='cerrar_aviso'><span>Cerrar</span</div>";
          $html .= "</div>";
          
          $html .= "</div>";
          }
 
?>

    <div id="fonto_de_aviso" class="fonto_de_aviso" onclick="hideLightbox('fondo_de_aviso','aviso')"></div> <!--fondo transparente oscuro-->
     
    <div id="aviso" class="aviso" onclick="hideLightbox('fonto_de_aviso','aviso')">
       
        <?php
            echo $html;
        ?>
         
        <!--img id="aviso_img" src="images/Pop_Up.jpg"/--><!--aqui va el aviso-->
    </div> 
    
    <script type="text/javascript">
        showLightbox('fonto_de_aviso','aviso');<!--********************ventana******************-->
    </script>