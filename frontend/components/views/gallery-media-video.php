<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\Json;

$this->registerJs("$('#video-gallery').lightGallery({
    thumbnail:true,
    animateThumb: false,
    showThumbByDefault: false,
    mode: 'lg-fade',
    cssEasing : 'cubic-bezier(0.25, 0, 0.25, 1)',

});", yii\web\View::POS_END);
?>

<div id="video-gallery">
    <?php foreach ($gallery->videos as $index => $video): ?>
        <?php echo '
        
        
        <li class="col-xs-12 col-sm-4 col-md-4 '.($index == 0 || $index == 1 ? 'wide-video': '').'" data-poster="https://img.youtube.com/vi/' . ltrim(strstr($video->video, 'v='), 'v=') . '/maxresdefault.jpg" data-src="' . $video->video . '" data-sub-html=".video-desc">
            <a class="selector video-selector">
                <img src="https://img.youtube.com/vi/' . ltrim(strstr($video->video, 'v='), 'v=') . '/mqdefault.jpg"/>
                      <div class="demo-gallery-poster video-gallery-poster">
                                <img src="img/play-button.png">
                           </div>        
                  </a>
             <div class="video-desc video-caption">
              <h4>' . $video->name . '</h4>
             <p>' . $video->description . '</p>
              </div>
              </li>'; ?>
    <?php endforeach; ?>
</div>



