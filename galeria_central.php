<header class="page-heading clearfix">
    <h1 class="heading-title pull-left">Album de Graduacion<small></small></h1>

</header>
<div class="row page-row">
    <?php
    $directory = 'images/Galeria1';
    $dirint = dir($directory);
    while (($archivo = $dirint->read()) !== false) {
        if (eregi("gif", $archivo) || eregi("jpg", $archivo) || eregi("png", $archivo)) {
            ?>
            <a class="prettyphoto col-md-3 col-sm-3 col-xs-6" rel="prettyPhoto[gallery]" title="Acto de Graducion" href="<?php echo $directory . "/" . $archivo ?>">
                <img class="img-responsive img-thumbnail" src="<?php echo $directory . "/" . $archivo ?>" width="220" height="220" alt=""></a>    
                <?php
            }
        }
        $dirint->close();
        ?>
</div>