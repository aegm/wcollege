<!--*******************************************librerias*******************************************************-->
<link href="styles/base.css" type="text/css" rel="stylesheet">
<!--script src="JS/jquery-1.4.2.min.js" type="text/javascript"></script>
<script src="JS/jquery-ui-1.8.4.custom.min.js" type="text/javascript"/></script>
<link rel="stylesheet" href="development-bundle/themes/custom-theme/jquery.ui.all.css" type="text/css" media="all"/-->

<!--**********************************************scripts****************************************************-->    
<!--script src="JS/carrusel.js" type="text/javascript"/></script-->
	<script type="text/javascript" src="lib/jquery.jcarousel.min.js"></script>
        <script type="text/javascript" src="lib/jquery.pikachoose.min.js"></script>
<!--**********************************************style-scripts****************************************************--> 
<script>
$(document).ready(function(){    
     $(function(){
                $("#pikame").PikaChoose({autoPlay:true, transition:[5]});

    });
})
</script>
<style type="text/css">
	 #demo-frame > div.demo { padding: 10px !important;  }
    .scroll-pane { overflow: auto; width: 600px; float:left; }
    .scroll-content { width: 2440px; float: left; }/*10 imagenes por cada 1220px de ancho*/
    .scroll-content-item { width: 100px; height: 100px; float: left; margin: 10px; font-size: 3em; line-height: 96px; text-align: center; }
    * html .scroll-content-item { display: inline; } /* IE6 float double margin bug */
    .scroll-bar-wrap { clear: left; padding: 0 4px 0 2px; margin: 0 -1px -1px -1px; }
    .scroll-bar-wrap .ui-slider { background: none; border:0; height: 2em; margin: 0 auto;  }
    .scroll-bar-wrap .ui-handle-helper-parent { position: relative; width: 100%; height: 100%; margin: 0 auto; }
    .scroll-bar-wrap .ui-slider-handle { top:.2em; height: 11px; }
    .scroll-bar-wrap .ui-slider-handle .ui-icon { margin: -8px auto 0; position: relative; top: 50%; }
    .ui-widget-header {background:none; border:none;}
</style>
<?php    
if(!(isset($bd)))
{
	require_once('clases/db.class.php');
	$bd=new db;	
}
if(isset($_GET['categ']) && $_GET['categ'] && isset($_GET['subcateg']) && $_GET['subcateg'] )
{
	$categ=$_GET['categ'];
	$subcateg=$_GET['subcateg'];	
}else
{
	$categ='Eventos';
	$subcateg=1;	
}

$fotos=$bd->consulta("SELECT DISTINCT
							img_fotos.id_img,
							img_fotos.descripcion,
							img_fotos.id_subcategoria
						FROM img_fotos
						Inner Join img_subcategorias ON img_fotos.id_subcategoria = img_subcategorias.id_sub_categoria
						WHERE
							img_subcategorias.id_categoria =  '$categ' AND
							img_fotos.id_subcategoria =  '$subcateg'");
$num_fotos=$bd->num_filas($fotos);  
$foto=$bd->sig_reg($fotos);  

?>		
<div id="galeria">	
<div class="pikachoose">
    <ul id="pikame">
       <?php
      if(isset($_GET['subcateg'])){
          require_once('clases/Gallery.php');
          $img = new Gallery(null, false);
          $id = $_GET['subcateg'];
          $img->buscarTmp('images/Galeria'.$id.'/');
          $img->getImagesGallery();
          
          foreach ($img->datos['images'] as $valor)
          {
              echo '<li><a href="#"><img src="images/Galeria'.$id.'/'.$valor.'"/></a><span>Visita nuestros eventos</span></li>';
          }
      }
      /*while($foto)
      {
      $i++;
      echo '<li><a href="#"><img src="images/Galeria'.$subcateg.'/img'.$foto["id_img"].'.jpg"/></a><span>Visita nuestros eventos</span></li>';
      //echo "<img src='thumbnail.php?foto=images/Galeria".$subcateg."/img".$foto['id_img'].".jpg&tamano=100' border='none'/>";
       $foto=$bd->sig_reg($fotos); 
      } */?>
</ul>
</div> 	
    <!--div id="cont_imagen_ampliada">  
        <div class="imagen_ampliada">
             
        </div> 
    </div-->

    <div style="clear:both"></div> 
</div>
<div id="titulo_categoria"><?php echo $categ;?></div>
<div id="sub_categorias">
	<?php
    $subcategorias=$bd->consulta("SELECT * FROM img_subcategorias WHERE id_categoria =  '$categ' and estatus = 1");
	while ($subcategoria=$bd->sig_reg($subcategorias))
	{
		if($subcateg==$subcategoria['id_sub_categoria'])
			echo "<p><a href='inicio.php?lugar=galeria&subcateg=$subcategoria[id_sub_categoria]&categ=$subcategoria[id_categoria]' id='$subcateg' style='font-weight:bold;background-color:#D5EAFF;'>$subcategoria[descripcion]</a></p>";
		else
			echo "<p><a href='inicio.php?lugar=galeria&subcateg=$subcategoria[id_sub_categoria]&categ=$subcategoria[id_categoria]' id='$subcateg'>$subcategoria[descripcion]</a></p>";
	}
	?>
</div>








