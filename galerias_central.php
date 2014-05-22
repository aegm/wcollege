<?php
if(isset($_SESSION['wc']['nombre']) && ($_SESSION['wc']['nivel']=='a' || $_SESSION['wc']['nivel']=='s'))
{
include('administrador_central.php');
require_once 'clases/Gallery.php';
switch ($_REQUEST['form']){
    case 'agregar-evento':
        require_once('clases/db.class.php');
        $bd = new db;
        $descrip = $_POST['txt_evento'];
        $sql = $bd->consulta("insert into img_subcategorias (id_categoria,descripcion)values('Eventos','$descrip')")or die("error");
        
        //verificamos el ultimo registro insertado
        $ultimo_id = $bd->consulta("SELECT LAST_INSERT_ID() as 'id_categoria' FROM img_subcategorias");
        $id=$bd->sig_reg($ultimo_id);  
        $id = $id['id_categoria'];
        $img = new Gallery(null,false);
        $img->buscarTmp('images/Galeria'.$id.'/');
        if($img->directoriFile()){
            $img->fullUploadLocation();
        }
        break;
}
?>
<style>
#queue {
	border: 1px solid #E5E5E5;
	height: 177px;
	overflow: auto;
	margin-bottom: 10px;
	padding: 0 3px 3px;
	width: 300px;
}
</style>
<div id="formulario_adm">
    <form action="inicio.php?lugar=galerias" style="text-align:left;" method="post">
        <h3>Administracion de Eventos</h3>
        <div class="input_text">Nombre del Evento
            <textarea type="text" required id="txt_evento" name="txt_evento" cols='40' > </textarea>
        </div>
        <div id="queue"></div>
		<input id="file_upload" name="file_upload" type="file" multiple="true">
		<!--a style="position: relative; top: 8px;" href="javascript:$('#file_upload').uploadifive('upload')">Subir Archivos</a-->
        <input type="hidden" id="form" name="form" value="agregar-evento">
        <br><br>
        <div>
            <input type="hidden" name="a" value="guardar-evento">
                   <button type="button" class="button" id="btn_guardar_evento">Guardar</button>
            <button type="reset">Restablecer</button>
        </div>    
    </form>
    <div id="listado de Eventos">
	<?php
        require_once('clases/db.class.php');
        $subcategorias=$bd->consulta("SELECT * FROM img_subcategorias order by estatus ASC");
	?>
        <table class="tabla" style="width: 100%;">
        <thead>
            <tr>
                <th>Id</th>
                <th>Tipo</th>
                <th>Descripcion</th>
                <th>Estatus</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $selected = "";
            $opciones = array("1"=>"Activo","2"=>"Inactivo");
            $max = count($opciones);
             $cant = 1;
            while ($subcategoria=$bd->sig_reg($subcategorias))
              {
                              
            ?>
            <tr>
                <td><?=$subcategoria[id_sub_categoria]?></td>
                <td><?=$subcategoria[id_categoria]?></td>
                <td><?=$subcategoria[descripcion]?></td>
               
                <td><select id="<?echo $cant?>_slt_estatus_evento" name="slt_estatus" onchange="javascript:actualiza_estatus(<?=$subcategoria[id_sub_categoria]?>,document.getElementById('<?echo $cant._slt_estatus_evento?>').value)">
                        <option value>Seleccione</option>
                        <?php 
                        foreach($opciones as $valor => $campo)
                        {
                            if($valor == $subcategoria[estatus])
                                $selected = "selected";
                            else
                                $selected = "";
                                        
                            echo "<option value='$valor' $selected>$campo</option>";   
                        }
                        /*for ($i = 0; $i < $max; $i++)
                        {
                            $opcion = $opciones[$i];
                         echo "<option value='$opcion'></option>";   
                        }*/
                        ?>
                       
                    </select></td>
            </tr>
            
            <?php
              }
            ?>
        </tbody>
    </table>
        <br>
</div>
</div>
<br>

<?php 
}
?>