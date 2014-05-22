
<?php
$con = new db;
include('perfil_central.php');
if (isset($_POST['evaluacion_situacional'])) {
    include('evaluar_video_situacional.php');
}
?>
<div class="col-md-8">
    <?php
    $videos = $con->consulta("SELECT * FROM videos_situacionales");
    while ($video = $con->sig_reg($videos)) {
        ?>
        <article class="news-item page-row has-divider clearfix row">       
            <figure class="thumb col-md-2 col-sm-3 col-xs-4">
                <a href='inicio.php?lugar=ver_video_situacional&video=<?php echo $video['id_video_sit'] ?>&url=<?php echo $video['url'] ?>'>
                    <img src='thumbnail.php?foto=images/<?php echo $video['url'] ?>.jpg&tamano=150' class="img-responsive" border='none'/>

                </a>    
            </figure>
            <div class="details col-md-10 col-sm-9 col-xs-8">
                <h4 class="title"><a href="news-single.html"><?php echo $video['nombre'] ?></a></h4>
                <p>
                    <?php
                    $contrato = $_SESSION['wc']['usuario'];
                    $videos_aprobados = $con->consulta("SELECT * FROM videos_situacionales_evaluados WHERE contrato=$contrato AND id_video=$video[id_video_sit]");
                    if (!$con->num_filas($videos_aprobados))
                        echo "<a style = 'color:#f48e8f;'href='inicio.php?lugar=evaluar_video_situacional&video=$video[id_video_sit]'>Este Video se encuentra por Evaluar</a>";
                    else
                        echo "<a  style = 'color:#000;'>Este Video se encuentra Aprobado</a>";
                    ?>
                </p>
                <?php echo "<a class='btn btn-theme read-more' href='inicio.php?lugar=ver_video_situacional&video=$video[id_video_sit]&url=$video[url]'>Ver <i class='fa fa-chevron-right'></i></a>"; ?>
            </div>
        </article>
    <?php } ?>
</div>
