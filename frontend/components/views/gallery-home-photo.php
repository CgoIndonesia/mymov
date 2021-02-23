<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\Json;

$this->registerJs("$('#photo-gallery').lightGallery({
    thumbnail:true,
    animateThumb: false,
    showThumbByDefault: false,
    mode: 'lg-fade',
    cssEasing : 'cubic-bezier(0.25, 0, 0.25, 1)',

});", yii\web\View::POS_END);
?>
<?php foreach ($gallery->photos as $index => $photo): ?>
    <div id="caption<?= $index; ?>" style="display:none">
        <h4><?= $photo->name; ?></h4>
    </div>
<?php endforeach; ?>
<div id="photo-gallery">
    <?php foreach ($gallery->photos as $index => $photo): ?>
        <?php echo '   
        <a class="col-sm-3 selector" href="/uploads/gallery/' . $photo->image . '" data-sub-html="#caption' . $index . '">
                         <img class="img-responsive" src="/uploads/gallery/thumbs_370x280/' . $photo->image . '" />             
                        <div class="demo-gallery-poster">
                                <img src="/img/zoom.png">
                            </div>
          </a>           
        '; ?>
    <?php endforeach; ?>
</div>



